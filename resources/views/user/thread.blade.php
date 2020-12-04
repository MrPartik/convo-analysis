<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Thread') }}
        </h2>
    </x-slot>
        <div class="max-w-7xl mx-auto md:block lg:block lg:px-8">
            <div class = "grid grid-cols-4 gap-4 bg-white overflow-y-auto scrollbar-thumb-blue scrollbar-thumb-rounded scrollbar-track-blue-lighter scrollbar-w-2 scrolling-touch p-2 rounded-lg" style = "height: 80vh" >
                @php
                    $aSideNav = [
                        'enroll-grad-data' => 'Enrollment and Graduate Data',
                        'faculty'           => 'Faculty',
                        'sucs'              => 'SUCS',
                        'lucs'              => 'LUCS',
                        'pheis'             => 'PHEIS',
                        'programs'          => 'Programs'
                        ];
                @endphp
                <div class='col-span-1'>
                    @foreach($aSideNav as $sKey => $sValue)
                        <div id='sidenav-{{ $sKey }}' class ="mb-1 flex max-w-md bg-white shadow rounded-lg overflow-hidden" >
                            <div class = "flex items-center px-2 py-3" >
                                <div class = "mx-3" >
                                    <h1 class = "text-xl font-bold text-gray-800" >10</h1 >
                                    <h3 class = "text-xs  text-gray-800" >Total record for {{ $sValue }}</h3 >
                                </div >
                            </div >
                        </div >
                    @endforeach
                </div>
                <div class='col-span-3'>
                </div>
            </div >
        </div>
</x-app-layout>
