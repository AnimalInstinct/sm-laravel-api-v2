<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Component;

class ComponentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $components = [
            ["title" => "Components", "description" => "Components.", "base_url" => "/admin/components", "icon_id" => "1", "model" => "App\Models\Component"],
            ["title" => "Users", "description" => "Users component.", "base_url" => "/admin/users", "icon_id" => "2", "model" => "App\Models\User"],
            ["title" => "Roles", "description" => "Roles component.", "base_url" => "/admin/roles", "icon_id" => "3", "model" => "App\Models\Role"],
            ["title" => "Permissions", "description" => "Permissions component.", "base_url" => "/admin/permissions", "icon_id" => "4", "model" => "App\Models\Permission"],
            ["title" => "Pages", "description" => "Pages component.", "base_url" => "/admin/pages", "icon_id" => "5", "model" => "App\Models\Page"],
            ["title" => "Categories", "description" => "Categories component", "base_url" => "/admin/categories", "icon_id" => "6", "model" => "App\Models\Category"],
            ["title" => "HomePage", "description" => "Home page component.", "base_url" => "/", "icon_id" => "7", "model" => ""],
            ["title" => "NavBar", "description" => "Navigation bar on top.", "base_url" => "#", "icon_id" => "8", "model" => ""],
            ["title" => "SideNav", "description" => "Navigation slides left.", "base_url" => "#", "icon_id" => "9", "model" => ""],
            ["title" => "Menus", "description" => "Menus component", "base_url" => "/admin/menus", "icon_id" => "10", "model" => "App\Models\Menu"],
            ["title" => "MenuItems", "description" => "Menu items", "base_url" => "/admin/menuitems", "icon_id" => "11", "model" => "App\Models\MenuItem"],
            ["title" => "Authorization", "description" => "Authorization", "base_url" => "#", "icon_id" => "12", "model" => ""],
            ["title" => "Images", "description" => "Images component.", "base_url" => "/admin/images", "icon_id" => "13", "model" => "App\Models\Image"],
            ["title" => "Languages", "description" => "Languages", "base_url" => "/admin/languages", "icon_id" => "14", "model" => "App\Models\Language"],
            ["title" => "Translations", "description" => "", "base_url" => "/admin/translations", "icon_id" => "15", "model" => "App\Models\Translation"],
            ["title" => "Sites", "description" => "", "base_url" => "/admin/sites", "icon_id" => "16", "model" => "App\Models\Site"],
            // ["title"=>"","description"=>"","base_url"=>""],
        ];
        foreach ($components as $comp) {
            $component = new Component();
            $component->title = $comp['title'];
            $component->description = $comp['description'];
            $component->display_image_id = $comp['icon_id'];
            $component->base_url = $comp['base_url'];
            $component->model = $comp['model'];
            $component->save();
        };
    }
}
