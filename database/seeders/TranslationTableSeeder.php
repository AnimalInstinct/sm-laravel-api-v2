<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Translation;

class TranslationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $translations = [
            //HomePage
            ['alias' => 'welcome', 'translation' => 'Добро пожаловать', 'language_id' => '1', 'component_id' => '7'],
            ['alias' => 'welcome', 'translation' => 'Welcome', 'language_id' => '2', 'component_id' => '7'],
            ['alias' => 'welcome_text', 'translation' => 'Это пример страницы.', 'language_id' => '1', 'component_id' => '7'],
            ['alias' => 'welcome_text', 'translation' => 'This is example page.', 'language_id' => '2', 'component_id' => '7'],
            //Authorization
            ['alias' => 'login', 'translation' => 'Вход', 'language_id' => '1', 'component_id' => '10'],
            ['alias' => 'login', 'translation' => 'Login', 'language_id' => '2', 'component_id' => '10'],
            ['alias' => 'logout', 'translation' => 'Выход', 'language_id' => '1', 'component_id' => '10'],
            ['alias' => 'logout', 'translation' => 'Logout', 'language_id' => '2', 'component_id' => '10'],
            ['alias' => 'profile', 'translation' => 'Профиль', 'language_id' => '1', 'component_id' => '10'],
            ['alias' => 'profile', 'translation' => 'Profile', 'language_id' => '2', 'component_id' => '10'],
            //SideNav
            ['alias' => 'home', 'translation' => 'На главную', 'language_id' => '1', 'component_id' => '9'],
            ['alias' => 'home', 'translation' => 'Home', 'language_id' => '2', 'component_id' => '9'],
            ['alias' => 'login', 'translation' => 'Вход', 'language_id' => '1', 'component_id' => '9'],
            ['alias' => 'login', 'translation' => 'Login', 'language_id' => '2', 'component_id' => '9'],
            ['alias' => 'logout', 'translation' => 'Выход', 'language_id' => '1', 'component_id' => '9'],
            ['alias' => 'logout', 'translation' => 'Logout', 'language_id' => '2', 'component_id' => '9'],
            ['alias' => 'profile', 'translation' => 'Профиль', 'language_id' => '1', 'component_id' => '9'],
            ['alias' => 'profile', 'translation' => 'Profile', 'language_id' => '2', 'component_id' => '9'],
            ['alias' => 'settings', 'translation' => 'Настройки', 'language_id' => '1', 'component_id' => '9'],
            ['alias' => 'settings', 'translation' => 'Settings', 'language_id' => '2', 'component_id' => '9'],
            ['alias' => 'pages', 'translation' => 'Статьи', 'language_id' => '1', 'component_id' => '9'],
            ['alias' => 'pages', 'translation' => 'Pages', 'language_id' => '2', 'component_id' => '9'],
            ['alias' => 'en', 'translation' => 'Анг', 'language_id' => '1', 'component_id' => '9'],
            ['alias' => 'en', 'translation' => 'EN', 'language_id' => '2', 'component_id' => '9'],
            ['alias' => 'ru', 'translation' => 'Рус', 'language_id' => '1', 'component_id' => '9'],
            ['alias' => 'ru', 'translation' => 'RU', 'language_id' => '2', 'component_id' => '9'],
            ['alias' => 'English', 'translation' => 'Английский', 'language_id' => '1', 'component_id' => '9'],
            ['alias' => 'English', 'translation' => 'English', 'language_id' => '2', 'component_id' => '9'],
            ['alias' => 'Russian', 'translation' => 'Русский', 'language_id' => '1', 'component_id' => '9'],
            ['alias' => 'Russian', 'translation' => 'Russian', 'language_id' => '2', 'component_id' => '9'],
            ['alias' => 'dashboard', 'translation' => 'Статистика', 'language_id' => '1', 'component_id' => '9'],
            ['alias' => 'dashboard', 'translation' => 'Dashboard', 'language_id' => '2', 'component_id' => '9'],
            // ['alias'=>'','translation'=>'','language_id'=>'','component_id'=>''],
            // ['alias'=>'','translation'=>'','language_id'=>'','component_id'=>''],
            // ['alias'=>'','translation'=>'','language_id'=>'','component_id'=>''],


            // ['alias'=>'','translation'=>'','language_id'=>'','component_id'=>''],
        ];
        foreach ($translations as $trans) {
            $translation = new Translation();
            $translation->alias = $trans['alias'];
            $translation->translation = $trans['translation'];
            $translation->language_id = $trans['language_id'];
            $translation->component_id = $trans['component_id'];
            $translation->save();
        }
    }
}
