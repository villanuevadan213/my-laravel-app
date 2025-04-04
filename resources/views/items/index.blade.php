<x-layout>
    <x-slot:heading>
        Inventory Page
    </x-slot:heading>

    <div class="space-y-4">
        @foreach ($items as $item)
            <a href="/items/{{ $item['id'] }}" class="block px-4 py-6 border border-gray-200">
                <div class="font-bold text-blue-500 text-sm">{{ $item->supplier->name }}</div>
                <div>
                    <strong>{{ $item['name'] }}:</strong> Price ₱ {{ number_format($item['price'], 2) }} per piece.
                </div>
            </a>
        @endforeach

        <div>
            {{ $items->links() }}
        </div>
    </div>
</x-layout>