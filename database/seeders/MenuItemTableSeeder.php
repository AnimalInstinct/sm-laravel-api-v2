<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MenuItem;

class MenuItemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menuItems = [
            //Guest 1
            ['title' => 'home', 'description' => 'HomePage.', 'url' => '/', 'menu_id' => '1'],
            // ['title'=>'','description'=>'','url'=>'/','menu_id'=>'1'],
            //Registered 2
            // ['title'=>'','description'=>'','url'=>'/','menu_id'=>'2'],
            //Admin 3
            ['title' => 'dashboard', 'description' => 'Dashboard', 'url' => '/admin', 'menu_id' => '3'],
            ['title' => 'settings', 'description' => 'Settings', 'url' => '/admin', 'menu_id' => '3'],
            // ['title'=>'','description'=>'','url'=>'','menu_id'=>'3'],
            //Author 4
            ['title' => 'pages', 'description' => 'Pages', 'url' => '/admin/pages', 'menu_id' => '4'],
            // ['title'=>'','description'=>'','url'=>'/','menu_id'=>'4'],
        ];


        foreach ($menuItems as $i) {
            $menuItem = new MenuItem();
            $menuItem->title = $i['title'];
            $menuItem->description = $i['description'];
            $menuItem->url = $i['url'];
            $menuItem->menu_id = $i['menu_id'];
            $menuItem->save();
        }
    }
}
