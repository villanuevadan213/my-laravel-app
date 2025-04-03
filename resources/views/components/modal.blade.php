<div class="container mx-auto pb-4">
    <div x-data="{ open: false }">
        <!-- Button to trigger modal -->
        <x-form-button class="bg-green-600 hover:bg-green-500" @click="open = true">Enter Data</x-form-button>

        <!-- Modal -->
        <div x-show="open" x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="opacity-0 scale-75" x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-200 transform"
            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-75"
            class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50" @click="open = false">

            <!-- Modal Content -->
            <div @click.stop class="bg-white rounded-lg p-8 w-1/3">
                <form method="POST" action="/audits" class="flex flex-col gap-2">
                    @csrf
                    <x-form-label>Enter Data:</x-form-label>
                    <textarea class="border w-full" name="audit_data" id="audit_data" rows="5"
                        placeholder="{{ 'Tracking #' . PHP_EOL . 'Serial # ' . PHP_EOL . 'Basket # ' . PHP_EOL . 'Product Control # ' . PHP_EOL . 'Title' }}"></textarea>
                    <div class="flex justify-end">
                        <x-form-button class="bg-green-600 hover:bg-green-500" type="submit">
                            Submit
                        </x-form-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>