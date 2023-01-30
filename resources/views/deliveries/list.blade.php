<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Delivery') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div>
                        Client: {{ $client->name }} /
                        Phone: {{ $client->phone }} /
                        Email: {{ $client->email }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if($deliveries->count() > 0)
                    <table class="table-auto w-full">
                        <thead>
                        <tr>
                            <th class="text-s border font-bold text-gray-700 p-2">
                                Address
                            </th>
                            <th class="text-s border font-bold text-gray-700 p-2">
                                Date
                            </th>
                            <th class="text-s border font-bold text-gray-700 p-2">
                                Price
                            </th>
                            <th class="text-s border font-bold text-gray-700 p-2">
                                Status
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($deliveries as $delivery)
                                    <tr>
                                        <td class="border px-1 py-1 text-center">{{ $delivery->title }}</td>
                                        <td class="border px-1 py-1 text-center">{{ $delivery->date }}</td>
                                        <td class="border px-1 py-1 text-center">€ {{ $delivery->price_sum }}</td>
                                        @if($delivery->status == 1)
                                            <td class="border px-1 py-1 text-center">Created</td>
                                        @elseif($delivery->status == 2)
                                            <td class="border px-1 py-1 text-center">In progress</td>
                                        @elseif($delivery->status == 3)
                                            <td class="border px-1 py-1 text-center">Delivered</td>
                                        @endif
                                    </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @else
                        <div class="text-center">
                            <h1 class="text-2xl">No deliveries found</h1>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
