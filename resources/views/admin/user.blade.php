<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users Management') }}
        </h2>
    </x-slot>
        <div id="user-panel" class ="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white overflow-y-auto scrollbar-thumb-blue scrollbar-thumb-rounded scrollbar-track-blue-lighter scrollbar-w-2 scrolling-touch p-2 rounded-lg" style="margin-top: 55px">
            <livewire:users-datatable id="user-table" searchable="name, email" exportable />
        </div >
</x-app-layout>
<style>
    #user-panel div[wire\:id] .overflow-x-scroll {
        overflow: auto;
        margin-top: 30px;
    }
</style>
