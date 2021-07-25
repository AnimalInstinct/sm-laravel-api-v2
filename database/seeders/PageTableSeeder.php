<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;

class PageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $page = new Page();
        $page->published = "1";
        $page->title = "Welcome";
        $page->description = "Тестовая страница по умолчанию.";
        $page->alias = "welcome";
        $page->site_id = "1";
        $page->language_id = "1";
        $page->save();

        $page = new Page();
        $page->published = "1";
        $page->title = "Welcome";
        $page->description = "Default page created during installation process.";
        $page->alias = "welcome";
        $page->site_id = "1";
        $page->language_id = "2";
        $page->save();
    }
}
