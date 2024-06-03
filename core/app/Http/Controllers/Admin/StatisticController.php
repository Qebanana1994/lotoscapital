<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Deposit;
use App\Models\Statistic;
use App\Models\User;
use App\Models\Withdrawal;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    public function index()
    {
        $users = Statistic::getCountUsers();

        $realUsers = User::query()->count();

        $usersInfo = Statistic::getUsersInfo();

        $usersRange = Statistic::getRangeUsers();

        $deposits = number_format(Statistic::getAmountDeposits(), 0, '', '');

        $realDeposits = number_format(Deposit::query()->where('status', 1)->sum('amount'), 0, '', '');

        $depositsInfo = Statistic::getDepositsInfo();

        $depositsRange = Statistic::getRangeDeposits();

        $withdraws = number_format(Statistic::getAmountWithdraws(), 0, '', '');

        $realWithdraws = number_format(Withdrawal::query()->where('status', 1)->sum('amount'), 0, '', '');

        $withdrawsInfo = Statistic::getWithdrawsInfo();

        $withdrawsRange = Statistic::getRangeWithdraws();

        $pageTitle = __('Статистика Проекта');

        return view('admin.statistics.index', compact(['users', 'realUsers', 'usersInfo', 'usersRange', 'deposits', 'realDeposits', 'depositsInfo', 'depositsRange', 'withdraws', 'realWithdraws', 'withdrawsInfo', 'withdrawsRange', 'pageTitle']));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "total_users" => ['required', 'int', 'min:1'],
            "users_title" => ['required', 'string', 'min:1'],
            "users_description" => ['required', 'string', 'min:1'],
            "users_min" => ['required', 'int', 'min:1'],
            "users_max" => ['required', 'int', 'min:1'],
            "total_deposits" => ['required', 'int', 'min:1'],
            "deposits_title" => ['required', 'string', 'min:1'],
            "deposits_description" => ['required', 'string', 'min:1'],
            "deposits_min" => ['required', 'int', 'min:1'],
            "deposits_max" => ['required', 'int', 'min:1'],
            "total_withdraws" => ['required', 'int', 'min:1'],
            "withdraws_title" => ['required', 'string', 'min:1'],
            "withdraws_description" => ['required', 'string', 'min:1'],
            "withdraws_min" => ['required', 'int', 'min:1'],
            "withdraws_max" => ['required', 'int', 'min:1'],
        ]);

        $response = Statistic::query()->update($validated);

        if (!$response) {
            $notify[] = ['error', 'Error updating statistics'];
            return back()->withNotify($notify);
        }

        $notify[] = ['success', 'Statistics settings updated successfully'];
        return back()->withNotify($notify);
    }
}
