<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use App\Models\Referral;
use App\Models\ReferralStat;
use App\Models\User;
use Illuminate\Http\Request;

class ReferralController extends Controller
{
    public function index()
    {
        $pageTitle       = 'Manage Referral';
        $referrals       = Referral::get();
        $commissionTypes = [
            'deposit_commission'       => 'Deposit Commission',
            'invest_commission'        => 'Invest Commission',
            'invest_return_commission' => 'Interest Commission',
        ];
        return view('admin.referral.index', compact('pageTitle', 'referrals', 'commissionTypes'));
    }

    public function status($type)
    {
        return GeneralSetting::changeStatus(1, $type);
    }

    public function list () {

        $pageTitle       = 'Manage Referral';
        $referrals = ReferralStat::with(['user','refTransactions'])->paginate();
        $info = json_decode(json_encode(getIpInfo()), true);
        $mobileCode = @implode(',', $info['code']);
        $countries = json_decode(file_get_contents(resource_path('views/partials/country.json')));

        return view('admin.referral.list', compact('pageTitle','referrals', 'mobileCode', 'countries'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'percent'         => 'required',
            'percent*'        => 'required|numeric',
            'commission_type' => 'required|in:deposit_commission,invest_commission,invest_return_commission',
        ]);
        $type = $request->commission_type;

        Referral::where('commission_type', $type)->delete();

        for ($i = 0; $i < count($request->percent); $i++) {
            $referral                  = new Referral();
            $referral->level           = $i + 1;
            $referral->percent         = $request->percent[$i];
            $referral->commission_type = $request->commission_type;
            $referral->save();
        }

        $notify[] = ['success', 'Referral commission setting updated successfully'];
        return back()->withNotify($notify);
    }
}
