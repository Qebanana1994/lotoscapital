<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::namespace ('Api')->name('api.')->group(function () {
    Route::get('get-countries', function () {
        $c        = json_decode(file_get_contents(resource_path('views/partials/country.json')));
        $notify[] = 'General setting data';
        foreach ($c as $k => $country) {
            $countries[] = [
                'country'      => $country->country,
                'dial_code'    => $country->dial_code,
                'country_code' => $k,
            ];
        }
        return response()->json([
            'remark'  => 'country_data',
            'status'  => 'success',
            'message' => ['success' => $notify],
            'data'    => [
                'countries' => $countries,
            ],
        ]);
    });

    Route::namespace ('Auth')->group(function () {
        Route::post('login', 'LoginController@login');
        Route::post('register', 'RegisterController@register');

        Route::controller('ForgotPasswordController')->group(function () {
            Route::post('password/email', 'sendResetCodeEmail')->name('password.email');
            Route::post('password/verify-code', 'verifyCode')->name('password.verify.code');
            Route::post('password/reset', 'reset')->name('password.update');
        });
    });

    Route::middleware('auth:sanctum')->group(function () {

        //authorization
        Route::controller('AuthorizationController')->group(function () {
            Route::get('authorization', 'authorization')->name('authorization');
            Route::get('resend-verify/{type}', 'sendVerifyCode')->name('send.verify.code');
            Route::post('verify-email', 'emailVerification')->name('verify.email');
            Route::post('verify-mobile', 'mobileVerification')->name('verify.mobile');
            Route::post('verify-g2fa', 'g2faVerification')->name('go2fa.verify');
        });

        Route::middleware(['check.status'])->group(function () {
            Route::post('user-data-submit', 'UserController@userDataSubmit')->name('data.submit');
            Route::post('save/device/token', 'UserController@getDeviceToken')->name('add.device.token');

            Route::middleware('registration.complete')->group(function () {
                Route::controller('UserController')->group(function () {
                    Route::get('dashboard', 'dashboard');
                    Route::get('user-info', 'userInfo');

                    Route::post('profile-setting', 'submitProfile');
                    Route::post('change-password', 'submitPassword');

                    //KYC
                    Route::get('kyc-form', 'kycForm')->name('kyc.form');
                    Route::post('kyc-submit', 'kycSubmit')->name('kyc.submit');

                    //Report
                    Route::any('deposit/history', 'depositHistory')->name('deposit.history');
                    Route::get('transactions', 'transactions')->name('transactions');

                    Route::get('my-referrals', 'myReferrals');
                    Route::post('balance-transfer', 'balanceTransfer');

                });

                // Withdraw
                Route::controller('WithdrawController')->group(function () {
                    Route::get('withdraw-method', 'withdrawMethod')->name('withdraw.method')->middleware('kyc');
                    Route::post('withdraw-request', 'withdrawStore')->name('withdraw.money')->middleware('kyc');
                    Route::post('withdraw-request/confirm', 'withdrawSubmit')->name('withdraw.submit')->middleware('kyc');
                    Route::get('withdraw/history', 'withdrawLog')->name('withdraw.history');
                });

                // Payment
                Route::controller('PaymentController')->group(function () {
                    Route::get('deposit/methods', 'methods')->name('deposit');
                    Route::post('deposit/insert', 'depositInsert')->name('deposit.insert');
                    Route::get('deposit/confirm', 'depositConfirm')->name('deposit.confirm');
                    Route::get('deposit/manual', 'manualDepositConfirm')->name('deposit.manual.confirm');
                    Route::post('deposit/manual', 'manualDepositUpdate')->name('deposit.manual.update');
                });

                Route::controller('InvestController')->prefix('invest')->group(function () {
                    Route::get('/', 'invest');
                    Route::get('plans', 'allPlans');
                    Route::post('store', 'storeInvest');
                });

            });
        });

        Route::get('logout', 'Auth\LoginController@logout');
    });

    Route::controller('FrontendController')->group(function () {
        Route::get('logo-favicon', 'logoFavicon');
        Route::get('language/{code}', 'language');
        Route::get('general-setting', 'generalSetting');
        Route::get('policy', 'policy');
        Route::get('faq', 'faq');
    });

});

Route::group(['prefix' => '/webhooks'], function () {
    Route::any('freekassa', function (\Illuminate\Http\Request $request) {
//        function getIP() {
//            if(isset($_SERVER['HTTP_X_REAL_IP'])) return $_SERVER['HTTP_X_REAL_IP'];
//            return $_SERVER['REMOTE_ADDR'];
//        }
//
//        if (!in_array(getIP(), array('168.119.157.136', '168.119.60.227', '138.201.88.124', '178.154.197.79'))) die("hacking attempt!");
        logger(json_encode($request->all()));
        $deposit = \App\Models\Deposit::query()->where('trx', $request->get('MERCHANT_ORDER_ID'))->first();
        if (!$deposit) {
            logger('Error: ' . json_encode($request->all()));
            return false;

        }

        $user = \App\Models\User::query()->where('id', $deposit->user_id)->first();
        if (!$user) {
            logger('Error user: ' . json_encode($request->all()));
            return false;

        }

        $deposit->status = 1;
        $deposit->save();

        $user->deposit_wallet = $user->deposit_wallet + $request->get('AMOUNT');
        $user->save();

        return true;
    });

    Route::any('paykassa', function (\Illuminate\Http\Request $request) {
        $deposit = \App\Models\Deposit::query()->where('trx', $request->get('order_id'))->first();
        if ($request->get('type') != 'sci_confirm_order') {
            logger('Error paykassa:asd ' . json_encode($request->all()));
            return false;
        }
        if (!$deposit) {
            logger('Error paykassa: ' . json_encode($request->all()));
            return false;
        }
        $user = \App\Models\User::query()->where('id', $deposit->user_id)->first();
        if (!$user) {
            logger('Error user: ' . json_encode($request->all()));
            return false;

        }
        $deposit->status = 1;
        $deposit->save();

        $user->deposit_wallet = $user->deposit_wallet + $deposit->amount;
        $user->save();

//        W8o8dePErsyvTCj9WFEOis4ktWy9ALE3
//        25600
    });
});
Route::get('/freekassa', function () {
    echo (new \App\Service\FreekassaService())->send();
});

Route::get('/paykassa', function () {
    echo (new \App\Service\PaykassaService())->getBalance();
});
