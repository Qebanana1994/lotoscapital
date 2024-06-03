<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
    use HasFactory;

    protected $fillable = [
        'total_users',
        'total_deposits',
        'total_withdraws',
    ];

    public static function getCountUsers()
    {
        return Statistic::query()->first('total_users')->total_users;
    }

    public static function getUsersInfo()
    {
        return Statistic::query()->get(['users_title as title', 'users_description as desc'])[0];
    }

    public static function getRangeUsers()
    {
        return Statistic::query()->get(['users_min as min', 'users_max as max'])[0];
    }

    public static function getAmountDeposits()
    {
        return Statistic::query()->first('total_deposits')->total_deposits;
    }

    public static function getDepositsInfo()
    {
        return Statistic::query()->get(['deposits_title as title', 'deposits_description as desc'])[0];
    }


    public static function getRangeDeposits()
    {
        return Statistic::query()->get(['deposits_min as min', 'deposits_max as max'])[0];
    }

    public static function getAmountWithdraws()
    {
        return Statistic::query()->first('total_withdraws')->total_withdraws;
    }

    public static function getWithdrawsInfo()
    {
        return Statistic::query()->get(['withdraws_title as title', 'withdraws_description as desc'])[0];
    }

    public static function getRangeWithdraws()
    {
        return Statistic::query()->get(['withdraws_min as min', 'withdraws_max as max'])[0];
    }

    public static function updateStatistics()
    {
        self::query()->increment('total_users', rand(self::getRangeUsers()->min, self::getRangeUsers()->max));
        self::query()->increment('total_deposits', rand(self::getRangeDeposits()->min, self::getRangeDeposits()->max));
        self::query()->increment('total_withdraws', rand(self::getRangeWithdraws()->min, self::getRangeWithdraws()->max));
    }
}
