<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;


class SoftwaresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($conta = 0; $conta < 10; $conta++) {
            DB::table('softwares')->insert([
                'descripcion' => str_random(80),
                'idmarca' => random_int(1, 6),
                'modelo' => str_random(10),
                'tpsoft' => str_random(10),
                'numserie' => str_random(15),
                'licencia' => str_random(25),
                'actualizar'  => random_int(0, 1),
                'origen' => str_random(50),
                'hd' => str_random(50),
                'observaciones' => str_random(150),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }
    }
}
