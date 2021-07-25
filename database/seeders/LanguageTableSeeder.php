<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Language;

class LanguageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $language = new Language();
        $language->name = 'Russian';
        $language->locale = 'ru';
        $language->save();

        $language = new Language();
        $language->name = 'English';
        $language->locale = 'en';
        $language->save();
    }
}
