<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserAndTipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory(3)->create();

        $faker = \Faker\Factory::create();

        $api = 'https://wbinary.com/api/fipe/eb13596d33d4b89ead7e58c5b8d6f866';
        $client = new \GuzzleHttp\Client();

        $brandVehicles = [
            'motos' => json_decode($client->get("$api/motos/brands")->getBody()->getContents(), true)['data'],
            'carros' => json_decode($client->get("$api/carros/brands")->getBody()->getContents(), true)['data'],
            'caminhoes' => json_decode($client->get("$api/caminhoes/brands")->getBody()->getContents(), true)['data'],
        ];

        foreach (range(1, 3) as $user) {
            sleep(2);
            foreach (range(1, 10) as $i) {
                $type   = array_rand($brandVehicles, 1);
                $brand  = $brandVehicles[$type][array_rand($brandVehicles[$type], 1)];
                $models = json_decode($client->get("$api/{$brand['id']}/models")->getBody()->getContents(), true)['data'];
                $model  = $models[array_rand($models, 1)];
                $years  = json_decode($client->get("$api/{$model['fipe']}/year")->getBody()->getContents(), true)['data'];
                $year   = $years[array_rand($years, 1)];

                User::inRandomOrder()->first()->tips()->create([
                    'type' => $type,
                    'brand' => $brand['name'],
                    'model' => $model['name'],
                    'fipe' => $model['fipe'],
                    'year' => $year,
                    'observation' => $faker->sentence()
                ]);
            }
        }
    }
}
