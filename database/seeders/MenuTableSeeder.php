<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menus = [
            [
                'title' => 'Guest side menu',
                'role_id' => NULL,
                'component_id' => '9',
                'description' => 'Menu for unregistered users.',
            ],
            [
                'title' => 'Registered side menu',
                'role_id' => '1',
                'component_id' => '9',
                'description' => 'Menu for registered users activated or not.',
            ],
            [
                'title' => 'Admin side menu',
                'role_id' => '2',
                'component_id' => '9',
                'description' => 'Admin menu.',
            ],
            [
                'title' => 'Author side menu.',
                'role_id' => '6',
                'component_id' => '9',
                'description' => 'Author menu',
            ]
        ];

        foreach ($menus as $i) {
            $menu = new Menu();
            $menu->title = $i['title'];
            $menu->role_id = $i['role_id'];
            $menu->component_id = $i['component_id'];
            $menu->description = $i['description'];
            $menu->save();
        }
    }
}
