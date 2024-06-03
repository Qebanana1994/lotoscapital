<?php

namespace App\Http\Controllers\Gateway\Paykassa;

use App\Models\GatewayCurrency;
use Paykassa\PaykassaAPI;
use Paykassa\PaykassaSCI;

class ProcessController
{
    public static $config = [
        "merchant_id" => "26476",
        "merchant_password" => "Mr1iiyoJVQFe3rqZc862UmqxOIxoctT9",
        "api_id" => "29072",
        "api_password" => "QehamkiRmIHHwEcedCQ6WOccb6GorqMX",
        "config" => [
            "test_mode" => false,
        ],
    ];

    public static function process($deposit)
    {
        $paykassa = new PaykassaSCI(
            self::$config['merchant_id'],
            self::$config['merchant_password'],
            self::$config['config']['test_mode'],
        );

        $systemName = '';

        $systems = PaykassaSCI::getPaymentSystems();

        foreach ($systems as $system => $info) {
            foreach ($info['currency_list'] as $currency) {
                if ($currency == $deposit->method_currency) {
                    $systemName = $system;
                    $rate = GatewayCurrency::query()->where('currency', $currency)->first()->rate;
                    $amount = $deposit->amount * $rate;
                }
                if ($deposit->method_currency == 'USDT') {
                    $systemName = 'tron_trc20';
                    $rate = GatewayCurrency::query()->where('currency', 'USDT')->first()->rate;
                    $amount = $deposit->amount * $rate;
                }
            }
        }

        $trx = session()->get('Track');

        $response = $paykassa->createOrder(
            $amount,
            $systemName,
            $deposit->method_currency,
            'Order ID: '  . $trx,
        );

        $send['val'] = [
            'hash' => $response['data']['params']['hash'],
        ];
        $send['view'] = 'user.payment.redirect';
        $send['method'] = 'get';
        $send['url'] =  $response['data']['url'];

        return json_encode($send);
    }

    public static function withdraw($withdraw, $request)
    {
        $wallet = $withdraw->withdraw_information[0]->value;

        $system = $withdraw->withdraw_information[0]->system;

        $systems = PaykassaSCI::getPaymentSystems();

        $paykassa = new PaykassaAPI(
            self::$config['api_id'],
            self::$config['api_password'],
            self::$config['config']['test_mode'],
        );

        foreach ($systems as $systemName => $value) {
            foreach ($value['currency_list'] as $currency) {
                if (strtoupper($withdraw->currency) == $currency && strtolower($value['system']) == $system) {
                    $system = $systemName;
                }
            }
        }

        $params = [
            "merchant_id" => self::$config['merchant_id'],
            "wallet" => [
                "address" => $wallet,
                "tag" => "",
            ],
            "amount" => $withdraw->amount,
            "system" => $system,
            "currency" => strtoupper($withdraw->currency),
            "comment" => $request->details,
            "priority" => "medium", // low, medium, high
        ];

        $send = $paykassa->sendMoney(
            $params["merchant_id"],
            $params["wallet"],
            $params["amount"],
            $params["system"],
            $params["currency"],
            $params["comment"],
            $params["priority"]
        );

        return $send;
    }
}
