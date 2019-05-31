<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class MarcasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        $marcas = ['HP', 'IBM', 'Microsoft', 'DELL', 'Lenovo', 'Otros'];
        foreach ($marcas as $key => $value) {
            DB::table('marcas')->insert([
                'nombre' => $value,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }

        for ($conta = 0; $conta < 30; $conta++) {
            DB::table('marcas')->insert([
                'nombre' => 'Marca'.str_random(5),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }
    }
}

