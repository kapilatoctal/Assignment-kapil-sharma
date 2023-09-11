<?php

namespace Database\Seeders;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategoryTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tag::factory()->count(10)->create();

        $data['categories'] = [
            'Food' => [
                'Dairy',
                'Eggs',
                'Meat-Poultry'
            ],
            'Travel' => [
                'domestic tourism',
                'inbound tourism',
                'outbound tourism'
            ],
            'Health' => [
                'Nutrition',
                'Ayurveda',
                'Mental health'
            ],
            'Lifestyle' => [
                'Photography',
                'Finance',
                'Gardening',
            ],
            'Fashion' => [
                'Gothic',
                'Streetwear',
                'Preppy'
            ],
        ];
        foreach ($data['categories'] as $key => $cat) {
            $category = Category::create(['name' => $key]);
            foreach ($cat as $sub) {
                $subcategory[] = Category::create(['name' => $sub, 'parent_id' => $category->id]);
            }
        }
    }
}
