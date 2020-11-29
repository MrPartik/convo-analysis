<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Thread') }}
        </h2>
    </x-slot>
        <div class="col-span-9 py-12">
            <div class="max-w-7xl mx-auto md:block lg:block lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    @livewire('convo')
                </div>
            </div>
        </div>
</x-app-layout>
