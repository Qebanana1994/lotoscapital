<?php

namespace App\Http\Controllers\Gateway\Freekassa;

use App\Models\Deposit;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Gateway\PaymentController;
use App\Models\Gateway;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProcessController extends Controller
{
    private const PAYSCIURL = 'https://pay.freekassa.ru/';


    /**
     * Базовая интерпретация запроса на оплату для фрикассы.
     * */
    public static function process($deposit): bool|string
    {
        //Этот метод вызывает форму оплаты с выбором методов. Если нужно фиксировать метод, то есть параметр [i], или следующая функция.
        $freeKassa = json_decode($deposit->gatewayCurrency()->gateway_parameter);
        $data = [
            'm'=> $freeKassa->project_id,
            'o' => $deposit->trx,
            'oa' => round($deposit->final_amo,2),
            'em' => Auth::user()->email,
            'currency' => $deposit->method_currency,
            'pay' => 'Оплатить'

        ];
        //ksort($data);
        $sign = md5($freeKassa->project_id.':'.$data['oa'].':'.$freeKassa->secret_key.':'.$data['currency'].':'.$data['o']);
        $data['s'] = $sign;
        $send['val'] = $data;
        $send['view'] = 'user.payment.redirect';
        $send['method'] = 'get';
        $send['url'] =  self::PAYSCIURL.'?'.http_build_query($data);

        return json_encode($send);
    }

    public static function process_OLD($deposit): bool|string
    {
        // оставлю этот вариант процесса - тут вместо общей формы идет оплата через конктретный метод (карты/киви/прочее)
        $request = new Request();
        $freeKassa = json_decode($deposit->gatewayCurrency()->gateway_parameter);
        $data = [
            'shopId'=> $freeKassa->project_id,
            'i' => 1,
            'nonce'=> time(),
            '' => $deposit->trx,
            'amount' => round($deposit->final_amo,2),
            'email' => Auth::user()->email,
            'ip' => $request->ip(),
            'currency' => $deposit->method_currency

        ];
        ksort($data);
        $sign = hash_hmac('sha256', implode('|', $data), $freeKassa->api_key);
        $data['signature'] = $sign;

        $request = json_encode($data);
        $response = self::sendToApi('orders/create', $request);

        $send['view'] = '';
        $send['redirect'] =  isset($response['location']) ;
        $send['redirect_url'] = $response['location'] ?? '';

        return json_encode($send);
    }

    public static function withdraw($withdraw): ?array
    {
        $request = new Request();

        $freeKassa = json_decode(Gateway::where('alias', 'Freekassa')->first()->gateway_parameters );
        $data = [
            'shopId'=> $freeKassa->project_id->value,
            'i' => 6,
            'nonce'=> time(),
            'paymentId' => $withdraw->trx,
            'amount' => round($withdraw->final_amount,2),
            'email' => Auth::user()->email,
            'ip' => $request->ip(),
            'currency' => $withdraw->currency
        ];
        ksort($data);
        $sign = hash_hmac('sha256', implode('|', $data), $freeKassa->api_key->value);
        $data['signature'] = $sign;

        $request = json_encode($data);
        $response = self::sendToApi('withdrawals/create', $request);
        return $response;
    }

    public function ipn(Request $request)
    {
        if (isset($request->MERCHANT_ORDER_ID) && isset($request->SIGN)) {
            Log::info(json_encode($request->all()));
            $deposit = Deposit::where('trx', $request->MERCHANT_ORDER_ID)->firstORFail();
            $FreeKassa = json_decode($deposit->gatewayCurrency()->gateway_parameter);
            $sign_hash = md5($FreeKassa->project_id . ':' . round($deposit->final_amo, 2) . ':' . $FreeKassa->secret_key_second . ':' . $deposit->trx);
            if ($request->m_sign != $request->m_sign) {
                Log::error('Payment:FAILED_SIGN'.json_encode($request->all()));
                //$notify[] = ['error', 'The digital signature did not matched'];
                response()->json($notify, 400);
            } else {

                if ($request->AMOUNT == getAmount($deposit->final_amo) && $deposit->status == '0') {
                    PaymentController::userDataUpdate($deposit);
                    $notify[] = ['success', 'Успешная оплата'];
                    return 'YES';
                    //return to_route(gatewayRedirectUrl())->withNotify($notify);
                    //return to_route(gatewayRedirectUrl(true))->withNotify($notify);
                } else {
                    response()->json(['error'=>'paynent failed'], 400);
                }
            }
        } else {
            Log::error('Payment:FAILED'.json_encode($request->all()));
           // $notify[] = ['error', 'Payment failed'];
        }
        $notify[] = ['info', 'Проверяется статус платежа. Обновите страницу чтобы увидеть изменения.'];
        return to_route(gatewayRedirectUrl())->withNotify($notify);
    }

    public static function sendToApi ($method,$data) : array
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.freekassa.ru/v1/'.$method);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_FAILONERROR, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $result = trim(curl_exec($ch));
        curl_close($ch);
        return json_decode($result, true);
    }

}
