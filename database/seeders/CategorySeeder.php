<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Category::query()->delete();

        $categories = [
            [
                'id' => 1,
                'name' => 'Pizza',
                'image' => 'https://i.pinimg.com/736x/76/ea/8c/76ea8c6b4ab71fda3e7c3b170f36fa12.jpg',
            ],
            [
                'id' => 2,
                'name' => 'Burger',
                'image' => 'https://i.pinimg.com/736x/eb/cb/c6/ebcbc6aaa9deca9d6efc1efc93b66945.jpg',
            ],
            [
                'id' => 3,
                'name' => 'Drinks',
                'image' => 'https://i.pinimg.com/736x/46/1a/67/461a67ae7e9b83e3b557a573c7ff0b7f.jpg',
            ],
            [
                'id' => 4,
                'name' => 'Desserts',
                'image' => 'https://i.pinimg.com/736x/f4/de/a3/f4dea3e8cbb21d792ca452be26e88c4a.jpg',
            ],
            [
                'id' => 5,
                'name' => 'Cakes',
                'image' => 'https://i.pinimg.com/1200x/7a/2c/28/7a2c28c58f70b88e6fed0008e0121771.jpg',
            ],
            [
                'id' => 6,
                'name' => 'Biryani',
                'image' => 'https://i.pinimg.com/736x/79/53/fb/7953fbcd346daad06ae3afe79db15b3c.jpg',
            ],
            [
                'id' => 7,
                'name' => 'vegetable Biryani',
                'image' => 'https://i.pinimg.com/736x/3c/b2/0a/3cb20aee662b8f7c7da49b5368f8882f.jpg',
            ],
        ];

        foreach ($categories as $category) {
            \App\Models\Category::create($category);
        }
    }
}
