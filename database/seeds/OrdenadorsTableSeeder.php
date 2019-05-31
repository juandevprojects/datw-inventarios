<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;


class OrdenadorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($conta = 0; $conta < 10; $conta++) {
            DB::table( 'ordenadors')->insert([
                'numero'=> str_random(10),
                'idmarca'=> random_int(1,6),
                'modelo'=>str_random(10),
                'idubicacion'=> random_int(1, 6),
                'tppc'=>str_random(10),
                'numserie'=> str_random(15),
                'red' => str_random(20),
                'maclan' => str_random(2).':' . str_random(2) . ':'. str_random(2) . ':' . str_random(2) . ':' . str_random(2) . ':' . str_random(2),
                'iplan' => random_int(1, 255).'.' . random_int(1, 255) . '.' . random_int(1, 255) . '.' . random_int(1, 255),
                'macwifi' => str_random(2) . ':' . str_random(2) . ':' . str_random(2) . ':' . str_random(2) . ':' . str_random(2) . ':' . str_random(2),
                'ipwifi' => random_int(1, 255) . '.' . random_int(1, 255) . '.' . random_int(1, 255) . '.' . random_int(1, 255),
                'hd1' => str_random(10),
                'observaciones'=> str_random(150),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),

            ]);
        }
    }
}
