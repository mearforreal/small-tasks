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
        // Create root categories
        $category1 = Category::create(['title' => 'Техническая поддержка']);
        $category2 = Category::create(['title' => 'Отдел продаж']);

        // Create subcategories for Root Category 1
        $subcategory1_1 = $category1->childrenCategories()->create(['title' => 'Сервер']);
        $subcategory1_2 = $category1->childrenCategories()->create(['title' => 'Аппаратное обеспечение']);

        // // Create sub-subcategories for Subcategory 1.1
        // $subSubcategory1_1_1 = $subcategory1_1->children()->create(['name' => 'Sub-subcategory 1.1.1']);
        // $subSubcategory1_1_2 = $subcategory1_1->children()->create(['name' => 'Sub-subcategory 1.1.2']);

        // Create subcategories for Root Category 2
        $subcategory2_1 = $category2->childrenCategories()->create(['title' => 'Возврат']);
        $subcategory2_2 = $category2->childrenCategories()->create(['title' => 'Услуги']);
    }
}
