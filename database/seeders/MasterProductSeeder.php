<?php

namespace Database\Seeders;

use App\Models\MasterProduct;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MasterProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MasterProduct::factory()->withImage()->count(30)->create();
    }
}
