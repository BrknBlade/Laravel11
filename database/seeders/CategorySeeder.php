<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create(['name' => 'Compartir coche']);
        Category::create(['name' => 'Oferta  y demanda de empleo']);
        Category::create(['name' => 'Clases particulares']);
        Category::create(['name' => 'Cuidado de personas mayores']);
        Category::create(['name' => 'Limpieza']);
        Category::create(['name' => 'Compra/Venta articulos segunda mano']);
        Category::create(['name' => 'Oficios']);
    }
}
