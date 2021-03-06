<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FundraiserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('fundraisers')->insert([
            'title' => 'Na schronisko dla piesków',  // do usuniecia
            'description' => 'Pomóż Nam uratować krakowskie schronisko dla psów **"Kundelek"**!',
            'user_id' => '1',
            'category_id' => '6',
            'stop_date' => '2022-02-20 15:00:0',
            'amount_to_be_raised' => '5000',
            'amount_raised' => '3000',
            'created_at' => \Carbon\Carbon::now()->toDateTimeString()
        ]);

        DB::table('fundraisers')->insert([
            'title' => 'Na schronisko dla kotków',
            'description' => 'Pomóż Nam uratować krakowskie schronisko dla kotów **"Łapka"**!',
            'user_id' => '1',
            'category_id' => '6',
            'stop_date' => '2022-03-20 15:00:0',
            'amount_to_be_raised' => '10000',
            'amount_raised' => '5450.45',
            'created_at' => \Carbon\Carbon::now()->toDateTimeString()
        ]);

        DB::table('fundraisers')->insert([
            'title' => 'Na schronisko dla królików',
            'description' => 'Pomóż Nam uratować krakowskie schronisko dla królików **"Łapka"**!',
            'user_id' => '1',
            'category_id' => '6',
            'stop_date' => '2022-09-20 15:00:0',
            'amount_to_be_raised' => '20000',
            'amount_raised' => '2000.45',
            'created_at' => \Carbon\Carbon::now()->toDateTimeString()
        ]);
        DB::table('fundraisers')->insert([
            'title' => 'Na melanż',
            'description' => 'Poratuj kierowniku **"PLS"**!',
            'user_id' => '1',
            'category_id' => '9',
            'stop_date' => '2022-09-20 15:00:0',
            'amount_to_be_raised' => '250000',
            'amount_raised' => '240000',
            'created_at' => \Carbon\Carbon::now()->toDateTimeString()
        ]);

    }
}
