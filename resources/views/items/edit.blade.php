<x-layout>
    <x-slot:heading>
        Edit Item: {{ $item->name }}
    </x-slot:heading>

    <form method="POST" action="/items/{{ $item->id }}">
        @csrf
        @method('PATCH')

        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-4">
                        <label for="name" class="block text-sm/6 font-medium text-gray-900">Name</label>
                        <div class="mt-2">
                            <div
                                class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                                <input type="text" name="name" id="name"
                                    class="block min-w-0 grow p-1.5 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6"
                                    value="{{ $item->name }}" placeholder="Motherboard">
                            </div>
                        </div>
                    </div>

                    <div class="sm:col-span-4">
                        <label for="price" class="block text-sm/6 font-medium text-gray-900">Price</label>
                        <div class="mt-2">
                            <div
                                class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                                <input type="text" name="price" id="price"
                                    class="block min-w-0 grow p-1.5 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6"
                                    value="{{ $item->price }}" placeholder="₱ XX,XXX per piece">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-between gap-x-6">
            <button form="delete-form" class="text-red-500 text-sm text-bold">Delete</button>
            <div class="flex items-center gap-x-6">
                <a href="/items/{{ $item->id }}" class="flex text-sm/6 font-semibold text-gray-900">Cancel</a>
                <button type="submit"
                    class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    Update
                </button>
            </div>
        </div>
    </form>

    <form method="POST" action="/items/{{ $item->id }}" id="delete-form" class="hidden">
        @csrf
        @method('DELETE')
    </form>
</x-layout>