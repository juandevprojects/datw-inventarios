<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UbicacionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ubicaciones = ['Atención al Cliente', 'Depósito 1', 'Oficina C', 'Administración', 'Gerencia', 'Depósito 2'];
        foreach ( $ubicaciones as $key => $value) {
            DB::table( 'ubicacions')->insert([
                'nombre' => $value,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }
    }
}
