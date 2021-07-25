<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;
use App\Models\District;
use App\Models\City;

class CountriesCitiesDistrictsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $country = new Country();
        $country->name = 'Thailand';
        $country->save();

        $city = new City();
        $city->name = 'Phuket';
        $city->country_id = 1;
        $city->save();

        $city = new City();
        $city->name = 'Samui';
        $city->country_id = 1;
        $city->save();

        $phuketDistricts = [
            'airport',
            'phukettown',
            'panwa',
            'rawai',
            'naiharn',
            'chalong',
            'kata',
            'karon',
            'patong',
            'kamala',
            'surin',
            'bangtao',
            'naiton',
            'naiyang',
            'maikao',
            'pangna',
        ];

        $samuiDistricts = [
            'chaweng',
            'lamai',
            'lipanoi',
            'nathon',
            'bangpo',
            'maenam',
            'bophut',
            'choengmon',
            'huathanon',
            'airport',
            'bangkao',
            'talingnam',
            'bantai',
            'bangrak',
            'thalang',
            'tritrang',
            'kathu',
        ];

        foreach ($phuketDistricts as $district) {
            District::create(['name' => $district, 'city_id' => 1]);
        }

        foreach ($samuiDistricts as $district) {
            District::create(['name' => $district, 'city_id' => 2]);
        }
    }
}
