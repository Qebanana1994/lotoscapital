<?php

namespace App\Http\Controllers\Gateway\Paykassa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaykassaController extends Controller
{
    public function invoice()
    {
        $paykassa = new \Paykassa\PaykassaSCI(
            "26476",
            "Mr1iiyoJVQFe3rqZc862UmqxOIxoctT9",
            false,
        );

        $res = $paykassa->checkOrderIpn($_POST['private_hash']);

        if ($res['error']) {
            echo $res['message'];
            // actions in case of an error
        } else {

            $deposit = \App\Models\Deposit::query()->where('trx', str_replace('Order ID: ', '', $res['data']['order_id']))->firstOrFail();

            $user = \App\Models\User::query()->find($deposit->user_id);

            $plan = \App\Models\Plan::with('timeSetting')->whereHas('timeSetting', function ($time) {
                $time->where('status', 1);
            })->where('status', 1)->findOrFail('1');

            $deposit->update([
                'status' => 1,
            ]);

            $hyip = new \App\Lib\HyipLab($user, $plan);

            $hyip->invest($deposit->amount, 'deposit_wallet', 0, false);
        }
    }

    public function success($id)
    {
        return "This is success Page $id";
    }

    public function fail($id)
    {
        return "This is fail Page $id";
    }

    public function transaction()
    {
        return 'This is information Page transaction';
    }
}
