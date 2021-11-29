<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Library') }}
        </h2>
    </x-slot>
    <script src="/highcharts/highcharts.js"></script>
    <script src="/highcharts/modules/data.js"></script>
    <script src="/highcharts/modules/exporting.js"></script>
    <script src="/highcharts/modules/drilldown.js"></script>
    <div class="max-w-7xl mx-auto md:block lg:block lg:px-8">
        @livewire('library')
    </div>
</x-app-layout>
