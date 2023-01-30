<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ReportsController
{
    public function deliveryTypes(): View
    {
        $clients = DB::table('clients')
            ->select('clients.name', 'addresses.title',
                DB::raw('COUNT(CASE WHEN deliveries.type = 1 THEN 1 END) as type_1_count'),
                DB::raw('COUNT(CASE WHEN deliveries.type = 2 THEN 1 END) as type_2_count'))
            ->join(DB::raw("(SELECT client_id, address_id FROM addresses JOIN deliveries ON addresses.id = deliveries.address_id
            WHERE type IN (1, 2) GROUP BY client_id, address_id HAVING COUNT(DISTINCT type) = 2) as client_addresses"), function ($join) {
                $join->on('clients.id', '=', 'client_addresses.client_id');
            })
            ->join('addresses', 'client_addresses.address_id', '=', 'addresses.id')
            ->join('deliveries', 'addresses.id', '=', 'deliveries.address_id')
            ->groupBy('clients.name', 'addresses.title')
            ->havingRaw('type_1_count > 0 AND type_2_count > 0')
            ->get();

        return view('deliveries.type', [
            'clients' => $clients
        ]);
    }

    public function deliveryHistory(): View
    {
        $deliveries = DB::table('deliveries')
            ->join('routes', 'deliveries.route_id', '=', 'routes.id')
            ->join('delivery_lines', 'deliveries.id', '=', 'delivery_lines.delivery_id')
            ->join('addresses', 'deliveries.address_id', '=', 'addresses.id')
            ->join('clients', 'addresses.client_id', '=', 'clients.id')
            ->select('clients.name', 'addresses.title', 'delivery_lines.item',
                DB::raw('SUM(delivery_lines.price * delivery_lines.quantity) as price_sum')
            )
            ->groupBy('clients.name', 'addresses.title', 'delivery_lines.item')
            ->get();

        return view('deliveries.history', [
            'deliveries' => $deliveries
        ]);
    }

    public function inactiveClients(): View
    {
        $clients = DB::table('clients')
            ->join('addresses', 'clients.id', '=', 'addresses.client_id')
            ->leftJoin('deliveries', function ($join) {
                $join->on('deliveries.address_id', '=', 'addresses.id')
                    ->where('deliveries.type', '=', 1);
            })
            ->whereNull('deliveries.id')
            ->select('clients.name', 'addresses.title', 'addresses.id')
            ->get();

        return view('clients.inactive', [
            'clients' => $clients
        ]);
    }
}
