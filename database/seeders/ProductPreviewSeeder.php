<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVariant; // Pastikan Model ini di-import
use App\Models\Category;
use Illuminate\Support\Str;

class ProductPreviewSeeder extends Seeder
{
    public function run()
    {
        // 1. Ambil ID kategori yang sudah dibuat sebelumnya
        $tshirt = Category::where('slug', 't-shirt')->first();
        $hoodie = Category::where('slug', 'hoodies')->first();
        $sweater = Category::where('slug', 'sweater')->first();

        // 2. Data Produk Contoh dengan tambahan Varian (Size & Color)
        $products = [
            [
                'category_id' => $tshirt->id,
                'name' => 'Classic Black T-Shirt',
                'price' => 50000,
                'image' => 'https://i.pinimg.com/1200x/65/16/06/65160636d9691e787ecd7d3d2c10a0d8.jpg',
                'variants' => [
                    ['size' => 'S', 'color' => 'Black', 'code' => '#000000', 'stock' => 10],
                    ['size' => 'M', 'color' => 'Black', 'code' => '#000000', 'stock' => 10],
                    ['size' => 'L', 'color' => 'Black', 'code' => '#000000', 'stock' => 10],
                    ['size' => 'XL', 'color' => 'Black', 'code' => '#000000', 'stock' => 10],
                ]
            ],

            [
                'category_id' => $tshirt->id,
                'name' => 'Classic White T-Shirt',
                'price' => 50000,
                'image' => 'https://i.pinimg.com/1200x/d5/57/ae/d557ae3b3b803d4d687664fac03dea9b.jpg',
                'variants' => [
                    ['size' => 'S', 'color' => 'White', 'code' => '#FFFFFF', 'stock' => 10],
                    ['size' => 'M', 'color' => 'White', 'code' => '#FFFFFF', 'stock' => 10],
                    ['size' => 'L', 'color' => 'White', 'code' => '#FFFFFF', 'stock' => 10],
                    ['size' => 'XL', 'color' => 'White', 'code' => '#FFFFFF', 'stock' => 10],
                ]
            ],

            [
                'category_id' => $tshirt->id,
                'name' => 'Classic Cyan T-Shirt',
                'price' => 50000,
                'image' => 'https://i.pinimg.com/1200x/9b/85/6d/9b856d327ad0cfb7595555fe38c19824.jpg',
                'variants' => [
                    ['size' => 'S', 'color' => 'Cyan', 'code' => '#ADD8E6', 'stock' => 10],
                    ['size' => 'M', 'color' => 'Cyan', 'code' => '#ADD8E6', 'stock' => 10],
                    ['size' => 'L', 'color' => 'Cyan', 'code' => '#ADD8E6', 'stock' => 10],
                    ['size' => 'XL', 'color' => 'Cyan', 'code' => '#ADD8E6', 'stock' => 10],
                ]
            ],

            [
                'category_id' => $tshirt->id,
                'name' => 'Classic Lavender T-Shirt',
                'price' => 50000,
                'image' => 'https://i.pinimg.com/736x/26/c2/69/26c269c37c30e40048a4a90ac57671b2.jpg',
                'variants' => [
                    ['size' => 'S', 'color' => 'Lavender', 'code' => '#CBC3E3', 'stock' => 10],
                    ['size' => 'M', 'color' => 'Lavender', 'code' => '#CBC3E3', 'stock' => 10],
                    ['size' => 'L', 'color' => 'Lavender', 'code' => '#CBC3E3', 'stock' => 10],
                    ['size' => 'XL', 'color' => 'Lavender', 'code' => '#CBC3E3', 'stock' => 10],
                ]
            ],

            [
                'category_id' => $hoodie->id,
                'name' => 'Premium Black Hoodie',
                'price' => 125000,
                'image' => 'https://i.pinimg.com/1200x/90/f6/5a/90f65a07c5e35d2f64ca7751438d3387.jpg',
                'variants' => [
                    ['size' => 'S', 'color' => 'Black', 'code' => '#000000', 'stock' => 10],
                    ['size' => 'M', 'color' => 'Black', 'code' => '#000000', 'stock' => 10],
                    ['size' => 'L', 'color' => 'Black', 'code' => '#000000', 'stock' => 10],
                    ['size' => 'XL', 'color' => 'Black', 'code' => '#000000', 'stock' => 10],
                ]
            ],

            [
                'category_id' => $hoodie->id,
                'name' => 'Premium White Hoodie',
                'price' => 125000,
                'image' => 'https://i.pinimg.com/736x/81/dc/8e/81dc8e46911c02ff4c2c6c8181f32534.jpg',
                'variants' => [
                    ['size' => 'S', 'color' => 'White', 'code' => '#FFFFFF', 'stock' => 10],
                    ['size' => 'M', 'color' => 'White', 'code' => '#FFFFFF', 'stock' => 10],
                    ['size' => 'L', 'color' => 'White', 'code' => '#FFFFFF', 'stock' => 10],
                    ['size' => 'XL', 'color' => 'White', 'code' => '#FFFFFF', 'stock' => 10],
                ]
            ],

            [
                'category_id' => $hoodie->id,
                'name' => 'Premium Brown Hoodie',
                'price' => 125000,
                'image' => 'https://i.pinimg.com/1200x/80/cb/d3/80cbd37d3e9b2806504994244b01b0b7.jpg',
                'variants' => [
                    ['size' => 'S', 'color' => 'Brown', 'code' => '#964B00', 'stock' => 10],
                    ['size' => 'M', 'color' => 'Brown', 'code' => '#964B00', 'stock' => 10],
                    ['size' => 'L', 'color' => 'Brown', 'code' => '#964B00', 'stock' => 10],
                    ['size' => 'XL', 'color' => 'Brown', 'code' => '#964B00', 'stock' => 10],
                ]
            ],

            [
                'category_id' => $hoodie->id,
                'name' => 'Premium Green Hoodie',
                'price' => 125000,
                'image' => 'https://i.pinimg.com/736x/9f/ec/a5/9feca5e22b880642ce289111a1f6292d.jpg',
                'variants' => [
                    ['size' => 'S', 'color' => 'Green', 'code' => '#355749', 'stock' => 10],
                    ['size' => 'M', 'color' => 'Green', 'code' => '#355749', 'stock' => 10],
                    ['size' => 'L', 'color' => 'Green', 'code' => '#355749', 'stock' => 10],
                    ['size' => 'XL', 'color' => 'Green', 'code' => '#355749', 'stock' => 10],
                ]
            ],
        ];

        foreach ($products as $p) {
            // Simpan Produk Utama
            $product = Product::create([
                'category_id' => $p['category_id'],
                'name' => $p['name'],
                'slug' => Str::slug($p['name']),
                'description' => 'High quality custom apparel for Apparify. Comfortable material and premium durability.',
                'base_price' => $p['price'],
                'is_active' => true,
            ]);

            // Simpan Gambar Produk
            ProductImage::create([
                'product_id' => $product->id,
                'image_path' => $p['image'],
                'is_primary' => true,
                'sort_order' => 1
            ]);

            // Simpan Varian Produk (Size & Color)
            foreach ($p['variants'] as $v) {
                ProductVariant::create([
                    'product_id' => $product->id,
                    'size' => $v['size'],
                    'color' => $v['color'],
                    'color_code' => $v['code'], // Simpan kode hex warna
                    'stock' => $v['stock'],
                    'additional_price' => 0 // Harga dasar sama untuk semua ukuran
                ]);
            }
        }
    }
}