<x-layout>
    <x-slot:heading>
        Audit Page
    </x-slot:heading>

    <div class="space-y-4">
        <div class="bg-white p-6 overflow-hidden shadow-xl sm:rounded-lg">
            @if(session('success'))
                <div class="bg-green-500 text-white p-4 rounded-md">
                    {{ session('success') }}
                </div>
            @elseif(session('error'))
                <div class="bg-red-500 text-white p-4 rounded-md">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="/audits">
                <span class="block text-sm/6 font-medium text-gray-900">Enter Data:</span>
                @csrf
                <div class="overflow-x-auto flex justify-start items-end gap-4">
                    <textarea class="border" name="audit_data" id="audit_data" rows="4" cols="50"></textarea>
                    <button type="submit"
                        class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-blue-500 border border-gray-300 leading-5 rounded-md text-white hover:text-gray-100 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-100 transition ease-in-out duration-150">Submit</button>
                </div>
            </form>
        </div>

        <div class="bg-white p-6 overflow-hidden shadow-xl sm:rounded-lg">
            {{-- <x-button href="/audits/create">Add Audit</x-button> --}}
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-2 py-1">
                                Title
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
                            {{-- <th scope="col">
                                Action
                            </th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($audits as $audit)
                            <tr
                                class="{{ $loop->odd ? 'bg-gray-100' : 'bg-white' }} text-center border-b-2 border-gray-200">
                                <td class="px-2 py-1 text-gray-500">{{ $audit['title'] }}</td>
                                <td class="px-2 py-1 text-gray-500">{{ $audit['product_control_no'] }}</td>
                                <td class="px-2 py-1 text-gray-500">{{ $audit['basket_no'] }}</td>
                                <td class="px-2 py-1 text-gray-500">{{ $audit['serial_no'] }}</td>
                                <td class="px-2 py-1 text-gray-500">{{ $audit->tracking->tracking_no }}</td>
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