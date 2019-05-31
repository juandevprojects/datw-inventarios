<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class MonitorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($conta = 0; $conta < 10; $conta++) {
            DB::table( 'monitors')->insert([
                'numero' => str_random(10),
                'idmarca' => random_int(1, 6),
                'modelo' => str_random(10),
                'idubicacion' => random_int(1, 6),
                'tpmon' => str_random(20),
                'numserie' => str_random(15),
                'tamano' => str_random(20),
                'observaciones' => str_random(150),
                'tienedvi' => random_int(0, 1),
                'tienehdmi' => random_int(0, 1),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),

            ]);
        }
    }
}
