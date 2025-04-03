<x-layout>
    <x-slot:heading>
        Edit Audit: {{ $audit->title }}
    </x-slot:heading>

    <form method="POST" action="/audits/{{ $audit->id }}">
        @csrf
        @method('PATCH')

        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base/7 font-semibold text-gray-900">Add new Audit</h2>

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <x-form-field>
                        <x-form-label for="title">Title</x-form-label>
                        <div class="mt-2">
                            <x-form-input name="title" id="title" value="{{ $audit->title }}" required />

                            <x-form-error name="title" />
                        </div>
                    </x-form-field>

                    <x-form-field>
                        <x-form-label for="product_control_no">Product Control No.</x-form-label>
                        <div class="mt-2">
                            <x-form-input name="product_control_no" id="product_control_no"
                                value="{{ $audit->product_control_no }}" required />

                            <x-form-error name="product_control_no" />
                        </div>
                    </x-form-field>

                    <x-form-field>
                        <x-form-label for="basket_no">Basket No.</x-form-label>
                        <div class="mt-2">
                            <x-form-input name="basket_no" id="basket_no" value="{{ $audit->basket_no }}" required />

                            <x-form-error name="basket_no" />
                        </div>
                    </x-form-field>

                    <x-form-field>
                        <x-form-label for="serial_no">Serial No.</x-form-label>
                        <div class="mt-2">
                            <x-form-input name="serial_no" id="serial_no" value="{{ $audit->serial_no }}" required />

                            <x-form-error name="serial_no" />
                        </div>
                    </x-form-field>

                    <x-form-field>
                        <x-form-label for="tracking_no">Tracking No.</x-form-label>
                        <div class="mt-2">
                            <x-form-input name="tracking_no" id="tracking_no"
                                value="{{ $audit->tracking->tracking_no }}" required />

                            <x-form-error name="tracking_no" />
                        </div>
                    </x-form-field>
                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
            <a href="/audits" class="text-sm/6 font-semibold text-gray-900">Cancel</a>
            <button type="submit"
                class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Update</button>
        </div>
    </form>
</x-layout>