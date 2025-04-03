<x-layout>
    <x-slot:heading>
        Item
    </x-slot:heading>

    <h2 class="font-bold text-lg">{{ $item->name }}</h2>

    <p>
        This is worth {{ $item->price }} per piece.
    </p>

    @can('edit', $item)
        <p class="mt-6">
            <x-button href="/items/{{ $item->id }}/edit">Edit Item</x-button>
        </p>
    @endcan
</x-layout>