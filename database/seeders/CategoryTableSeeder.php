<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = new Category();
        $category->published = "1";
        $category->title = "Pages";
        $category->description = "Default category created during installation process...";
        $category->alias = "pages";
        $category->save();
    }
}
