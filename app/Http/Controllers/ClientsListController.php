<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Client;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ClientsListController
{
    public function index(): View
    {
        $clients = Client::all();
        $addresses = Address::all();

        return view('clients.list', [
            'clients' => $clients->toQuery()->paginate(5),
            'addresses' => $addresses
        ]);
    }

    public function show(Client $client): View
    {
        $deliveries = DB::table('deliveries')
            ->join('routes', 'deliveries.route_id', '=', 'routes.id')
            ->join('delivery_lines', 'deliveries.id', '=', 'delivery_lines.delivery_id')
            ->join('addresses', 'deliveries.address_id', '=', 'addresses.id')
            ->join('clients', 'addresses.client_id', '=', 'clients.id')
            ->select('addresses.title', 'routes.date', 'deliveries.id', 'deliveries.status',
                DB::raw('SUM(delivery_lines.price * delivery_lines.quantity) as price_sum')
            )
            ->groupBy('addresses.title', 'routes.date', 'deliveries.id')
            ->where('clients.id', '=', $client->id)
            ->get();

        return view('deliveries.list', [
            'client' => $client,
            'deliveries' => $deliveries
        ]);
    }
}
