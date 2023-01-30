<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Client list') }}
        </h2>
    </x-slot>

    <div class="clients-container">
        @foreach($clients as $client)
            <ul class="mt-2">
                <li>Name: {{ $client->name }}</li>
                <li>Phone: {{ $client->phone }}</li>
                <li>Email: {{ $client->email }}</li>
            </ul>
            <div class="flex justify-center mt-2">
                <x-primary-button class="btn btn-primary mr-2 text-center" id="{{ 'btn-'.$client->id }}"
                                  onClick="toggleAddresses({{ $client->id }})">
                    Show Addresses
                </x-primary-button>
                <form action="{{ route('clients.show', $client->id) }}" method="GET">
                    @csrf
                    <x-primary-button>
                        Open Deliveries
                    </x-primary-button>
                </form>
            </div>
            <hr class="mt-2">
        @endforeach
        {{ $clients->links() }}
    </div>

    <div class="addresses-container">
        @foreach($clients as $client)
            <div class="w-1/2">
                <div class="client-addresses" id="{{ 'addresses-'.$client->id }}" style="display: none;">
                    <h2 class="text-center font-semibold">Addresses</h2>
                    @if($addresses->where('client_id', $client->id)->count() > 0)
                        @foreach($addresses as $address)
                            @if($address->client_id == $client->id)
                                <ul class="mt-2">
                                    <li>{{ $address->title }}</li>
                                </ul>
                            @endif
                        @endforeach
                    @else
                        <p class="text-center mt-2">No addresses found</p>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    <script>
        let current_client = null;

        function toggleAddresses(clientId) {
            let btn = document.getElementById('btn-' + clientId);
            let addresses = document.getElementById('addresses-' + clientId);

            if (current_client === clientId) {
                addresses.style.display = "none";
                btn.innerHTML = "Show Address";
                current_client = null;
            } else {
                if (current_client) {
                    let previous_addresses = document.getElementById('addresses-' + current_client);
                    previous_addresses.style.display = "none";
                    let previous_btn = document.getElementById('btn-' + current_client);
                    previous_btn.innerHTML = "Show Address";
                }
                current_client = clientId;
                addresses.style.display = "block";
                btn.innerHTML = "Hide Address";
            }
        }
    </script>
</x-app-layout>
