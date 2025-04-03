<x-layout>
    <x-slot:heading>
        Audit Page
    </x-slot:heading>

    <div class="space-y-4">
        @if(session('success') || session('error'))
            @if(session('success'))
                <div class="bg-green-500 text-white p-4 rounded-md">
                    {{ session('success') }}
                </div>
            @elseif(session('error'))
                <div class="bg-red-500 text-white p-4 rounded-md">
                    {{ session('error') }}
                </div>
            @endif
        @endif

        <div class="bg-white p-6 overflow-hidden shadow-xl sm:rounded-lg">
            {{-- <x-button href="/audits/create">Add Audit</x-button> --}}
            <x-modal></x-modal>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-2 py-1">
                                Title
                            </th>
                            <th scope="col" class="px-2 py-1">
                                Name
                            </th>
                            <th scope="col" class="px-2 py-1">
                                Product Control #
                            </th>
                            <th scope="col" class="px-2 py-1">
                                Basket #
                            </th>
                            <th scope="col" class="px-2 py-1">
                                Serial #
                            </th>
                            <th scope="col" class="px-2 py-1">
                                Tracking #
                            </th>
                            <th scope="col" class="px-2 py-1">
                                Status
                            </th>
                            {{-- <th scope="col">
                                Action
                            </th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($audits as $audit)
                            <tr
                                class="{{ $loop->odd ? 'bg-gray-100' : 'bg-white' }} text-center border-b-2 border-gray-200">
                                <td class="px-2 py-1 text-gray-500">{{ $audit->title }}</td>
                                <td class="px-2 py-1 text-gray-500">{{ $audit->item->name }}</td>
                                <td class="px-2 py-1 text-gray-500">{{ $audit->product_control_no }}</td>
                                <td class="px-2 py-1 text-gray-500">{{ $audit->basket_no }}</td>
                                <td class="px-2 py-1 text-gray-500">{{ $audit->serial_no }}</td>
                                <td class="px-2 py-1 text-gray-500">{{ $audit->tracking->tracking_no }}</td>
                                <td class="px-2 py-1 text-gray-500">{{ $audit->status }}</td>
                                {{-- <td class="text-gray-500">
                                    <x-button href="/audits/{{ $audit->id }}/edit">Edit</x-button>
                                </td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-2">
                {{ $audits->links() }}
            </div>
        </div>
    </div>
</x-layout>