<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ImpresorasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($conta = 0; $conta < 10; $conta++) {
            DB::table('impresoras')->insert([
                'numero' => str_random(10),
                'idmarca' => random_int(1, 6),
                'modelo' => str_random(10),
                'idubicacion' => random_int(1, 6),
                'tpimpresora' => str_random(10),
                'numserie' => str_random(15),
                'red' => str_random(20),
                'memoria' => random_int(1, 5000),
                'serie' => random_int(0, 1),
                'usb' => random_int(0, 1),
                'wifi' => random_int(0, 1),
                'paralelo' => random_int(0, 1),
                'ethernet' => random_int(0, 1),
                'observaciones' => str_random(150),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }
    }
}

