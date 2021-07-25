<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(LanguageTableSeeder::class);
        $this->call(TranslationTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(PageTableSeeder::class);
        $this->call(ComponentTableSeeder::class);
        $this->call(CountriesCitiesDistrictsSeeder::class);
        $this->call(MenuTableSeeder::class);
        $this->call(MenuItemTableSeeder::class);
        $this->call(ImageTableSeeder::class);
        $this->call(SiteTableSeeder::class);
    }
}
