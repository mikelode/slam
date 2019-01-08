<?php

use Illuminate\Database\Seeder;

class ContadorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cod_contador')->insert([
            'last_giu' => 'GI1900000',
            'last_pecosa' => 'PS1900000',
            'last_cpi' => 'CPI20190000',
            'last_cps' => 'CPS20190000',
            'last_nea' => 'NE1900000',
            'anio' => '2019'
        ]);
    }
}
