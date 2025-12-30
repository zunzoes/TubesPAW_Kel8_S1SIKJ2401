<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category; // Pastikan Model Category di-import
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Daftar kategori yang ingin kamu tambahkan
        $categories = [
            'T-Shirt',
            'Hoodies',
            'Sweater'
        ];

        foreach ($categories as $name) {
            Category::updateOrCreate(
                // Cek berdasarkan slug agar tidak ada data ganda
                ['slug' => Str::slug($name)], 
                // Data yang diisi/diperbarui
                ['name' => $name]
            );
        }
    }
}