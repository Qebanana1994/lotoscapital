<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReferralStat extends Model
{
    protected $fillable = [
        'user_id',
    ];

    public function User () {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

}
