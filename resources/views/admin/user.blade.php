<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users Management') }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto md:block lg:block lg:px-8">
        <div id="user-panel" class ="bg-white overflow-y-auto scrollbar-thumb-blue scrollbar-thumb-rounded scrollbar-track-blue-lighter scrollbar-w-2 scrolling-touch p-2 rounded-lg"   >
            <livewire:users-datatable id="user-table" searchable="name, email" exportable />
        </div >
    </div>
</x-app-layout>
<style>
    #user-panel div[wire\:id] .overflow-x-scroll {
        overflow: auto;
        margin-top: 30px;
    }
</style>
