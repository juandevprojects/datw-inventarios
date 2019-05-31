<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class SoftpcsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($conta = 0; $conta < 10; $conta++) {
            DB::table('soft_pcs')->insert([
                'idpc'  => random_int(1, 10),
                'idsoft' => random_int(1, 10),
                'fechainst' => Carbon::now()->format('Y-m-d'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }
    }
}
