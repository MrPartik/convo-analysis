<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Companion') }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto md:block lg:block lg:px-8">
        @livewire('convo')
    </div>
</x-app-layout>
