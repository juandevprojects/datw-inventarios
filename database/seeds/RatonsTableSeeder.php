<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class RatonsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($conta = 0; $conta < 10; $conta++) {
            DB::table('ratons')->insert([
                'numero' => str_random(10),
                'idmarca' => random_int(1, 6),
                'modelo' => str_random(10),
                'idubicacion' => random_int(1, 6),
                'tpraton' => str_random(10),
                'numserie' => str_random(15),
                'observaciones' => str_random(150),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }
    }
}
