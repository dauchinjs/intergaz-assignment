<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Address;
use App\Models\Client;
use App\Models\Delivery;
use App\Models\DeliveryLine;
use App\Models\Route;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $amount = 100;

        $clients = Client::factory($amount)->create();
        $addresses = Address::factory($amount)->create();
        $routes = Route::factory($amount)->create();
        $deliveries = Delivery::factory($amount)->create();
        $deliveryLines = DeliveryLine::factory($amount)->create();

        foreach ($clients as $client) {
            $client->addresses()->saveMany($addresses->random(5));
        }

        foreach ($deliveries as $delivery) {
            $delivery->deliveryLines()->saveMany($deliveryLines->random(5));

        }

        foreach ($routes as $route) {
            $route->deliveries()->saveMany($deliveries->random(5));
        }
    }
}
