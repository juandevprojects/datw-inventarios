<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->truncaTablas(['marcas', 'ubicacions', 'ordenadors', 'monitors', 'teclados', 'ratons', 'softwares', 'components', 'impresoras', 'dispreds', 'soft_pcs']);
        $this->call(MarcasTableSeeder::class);
        $this->call(UbicacionsTableSeeder::class);
        $this->call(OrdenadorsTableSeeder::class);
        $this->call(MonitorsTableSeeder::class);
        $this->call(TecladosTableSeeder::class);
        $this->call(RatonsTableSeeder::class);
        $this->call(SoftwaresTableSeeder::class);
        $this->call(ComponentsTableSeeder::class);
        $this->call(ImpresorasTableSeeder::class);
        $this->call(DispredsTableSeeder::class);
        $this->call(SoftpcsTableSeeder::class);
    }

    protected function truncaTablas(array $tablas)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        foreach ($tablas as $tabla) {
            DB::table($tabla)->truncate();
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}

