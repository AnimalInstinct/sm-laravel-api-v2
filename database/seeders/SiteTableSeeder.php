<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Site;

class SiteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sites = [
            ["domain" => "default", "alias" => "default", "title" => "default", "description" => "Default site", "display_image_id" => ""],
            // ["title"=>"","description"=>"","base_url"=>""],
        ];
        foreach ($sites as $s) {
            $site = new Site();
            $site->alias = $s['domain'];
            $site->alias = $s['alias'];
            $site->title = $s['title'];
            $site->description = $s['description'];
            $site->display_image_id = $s['display_image_id'];
            $site->save();
        };
    }
}
