<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('gateways')->truncate();
        DB::table('gateways')->insert([
            'name' => 'Freekassa',
            'alias' => 'Freekassa',
            'status' => 1,
            'gateway_parameters' => '{"api_key":{"title":"Merchant api key","global":true,"value":"-------------------"},"secret_key":{"title":"Secret Key","global":true,"value":"-------------------"},"secret_key_second":{"title":"Secret Key Second","global":true,"value":"--------------"}}',
            'supported_currencies' => '{"USD":"USD","RUB":"RUB"}',
            'extra' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //не нужен такой вариант
    }
};
