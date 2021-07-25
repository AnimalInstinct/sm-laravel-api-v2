<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Image;

class ImageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = '/storage/images/';
        $images = [
            ['path' => $path, 'name' => 'Components.svg', 'imageable_type' => 'App\Component', 'imageable_id' => '1'],
            ['path' => $path, 'name' => 'Users.svg', 'imageable_type' => 'App\Component', 'imageable_id' => '2'],
            ['path' => $path, 'name' => 'Roles.svg', 'imageable_type' => 'App\Component', 'imageable_id' => '3'],
            ['path' => $path, 'name' => 'Permissions.svg', 'imageable_type' => 'App\Component', 'imageable_id' => '4'],
            ['path' => $path, 'name' => 'Pages.svg', 'imageable_type' => 'App\Component', 'imageable_id' => '5'],
            ['path' => $path, 'name' => 'Categories.svg', 'imageable_type' => 'App\Component', 'imageable_id' => '6'],
            ['path' => $path, 'name' => 'HomePage.svg', 'imageable_type' => 'App\Component', 'imageable_id' => '7'],
            ['path' => $path, 'name' => 'NavBar.svg', 'imageable_type' => 'App\Component', 'imageable_id' => '8'],
            ['path' => $path, 'name' => 'SideNav.svg', 'imageable_type' => 'App\Component', 'imageable_id' => '9'],
            ['path' => $path, 'name' => 'Menus.svg', 'imageable_type' => 'App\Component', 'imageable_id' => '10'],
            ['path' => $path, 'name' => 'MenuItems.svg', 'imageable_type' => 'App\Component', 'imageable_id' => '11'],
            ['path' => $path, 'name' => 'Authorization.svg', 'imageable_type' => 'App\Component', 'imageable_id' => '12'],
            ['path' => $path, 'name' => 'Images.svg', 'imageable_type' => 'App\Component', 'imageable_id' => '13'],
            ['path' => $path, 'name' => 'Languages.svg', 'imageable_type' => 'App\Component', 'imageable_id' => '14'],
            ['path' => $path, 'name' => 'Translations.svg', 'imageable_type' => 'App\Component', 'imageable_id' => '15'],
            ['path' => $path, 'name' => 'Sites.svg', 'imageable_type' => 'App\Component', 'imageable_id' => '16'],
            // ['path'=>'', 'name'=>''],
        ];
        foreach ($images as $img) {
            $image = new Image();
            $image->path = $img['path'];
            $image->name = $img['name'];
            $image->imageable_type = $img['imageable_type'];
            $image->imageable_id = $img['imageable_id'];
            $image->save();
        };
    }
}
