<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Delivery History') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class="table-auto w-full">
                        <thead>
                        <tr>
                            <th class="text-s border font-bold text-gray-700 p-2">
                                Client
                            </th>
                            <th class="text-s border font-bold text-gray-700 p-2">
                                Address
                            </th>
                            <th class="text-s border font-bold text-gray-700 p-2">
                                Product
                            </th>
                            <th class="text-s border font-bold text-gray-700 p-2">
                                Price
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($deliveries as $delivery)
                                <tr>
                                    <td class="border px-1 py-1 text-center">{{ $delivery->name }}</td>
                                    <td class="border px-1 py-1 text-center">{{ $delivery->title }}</td>
                                    <td class="border px-1 py-1 text-center">{{ $delivery->item }}</td>
                                    <td class="border px-1 py-1 text-center">€ {{ $delivery->price_sum }}</td>
                                </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
