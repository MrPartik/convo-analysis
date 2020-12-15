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
                        //'faculty'  => 'Faculty',
                        'Suc'     => 'SUCS',
                        'Luc'     => 'LUCS',
                        'Pheis'    => 'PHEIS',
                        'Program' => 'Programs'
                        ];
                @endphp
                <div class='col-span-1 shadow-lg'>
                    @foreach($aSideNav as $sKey => $sValue)
                        <div id='sidenav-{{ $sKey }}' class ="mb-1 flex max-w-md bg-white shadow rounded-lg overflow-hidden" >
                            <div class = "flex items-center px-2 py-3" >
                                <div class="p-3 mr-2 text-blue-500 bg-blue-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
                                    {{ \call_user_func(\App\Repositories\derivedRepository::class . '::get' . $sKey)->count() }}
                                </div>
                                <div class = "mx-3" >
                                    <h3 class = "text-sm font-bold text-gray-800" >Total record for {{ $sValue }}</h3 >
                                </div >
                            </div >
                        </div >
                    @endforeach
                </div>
                <div class='col-span-3 shadow-lg'>
                    <div x-data="app()" x-cloak class="px-4">
                            <div class="max-w-lg mx-auto py-10">
                                <div class="shadow p-6 rounded-lg bg-white">
                                    <div class="md:flex md:justify-between md:items-center">
                                        <div>
                                            <h2 class="text-xl text-gray-800 font-bold leading-tight">Program by City</h2>
                                            <p class="mb-2 text-gray-600 text-sm">Total by City</p>
                                        </div>

                                        <!-- Legends -->
                                        <div class="mb-4">
                                            <div class="flex items-center">
                                                <div class="w-2 h-2 bg-blue-600 mr-2 rounded-full"></div>
                                                <div class="text-sm text-gray-700">Program</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="line my-8 relative">
                                        <!-- Tooltip -->
                                        <template x-if="tooltipOpen == true">
                                            <div x-ref="tooltipContainer" class="p-0 m-0 z-10 shadow-lg rounded-lg absolute h-auto block"
                                                 :style="`bottom: ${tooltipY}px; left: ${tooltipX}px`"
                                            >
                                                <div class="shadow-xs rounded-lg bg-white p-2">
                                                    <div class="flex items-center justify-between text-sm">
                                                        <div>Sales:</div>
                                                        <div class="font-bold ml-2">
                                                            <span x-html="tooltipContent"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </template>

                                        <!-- Bar Chart -->
                                        <div class="flex -mx-2 items-end mb-2">
                                            <template x-for="data in chartData">

                                                <div class="px-2 w-1/6">
                                                    <div :style="`height: ${data}px`"
                                                         class="transition ease-in duration-200 bg-blue-600 hover:bg-blue-400 relative"
                                                         @mouseenter="showTooltip($event); tooltipOpen = true"
                                                         @mouseleave="hideTooltip($event)"
                                                    >
                                                        <div x-text="data" class="text-center absolute top-0 left-0 right-0 -mt-6 text-gray-800 text-sm"></div>
                                                    </div>
                                                </div>

                                            </template>
                                        </div>

                                        <!-- Labels -->
                                        <div class="border-t border-gray-400 mx-auto" :style="`height: 1px; width: ${ 100 - 1/chartData.length*100 + 3}%`"></div>
                                        <div class="flex -mx-2 items-end">
                                            <template x-for="data in labels">
                                                <div class="px-2 w-1/6">
                                                    <div class="bg-red-600 relative">
                                                        <div class="text-center absolute top-0 left-0 right-0 h-2 -mt-px bg-gray-400 mx-auto" style="width: 1px"></div>
                                                        <div x-text="data" class="text-center absolute top-0 left-0 right-0 mt-3 text-gray-700 text-sm"></div>
                                                    </div>
                                                </div>
                                            </template>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>
                            function app() {
                                return {
                                    chartData: {{ \json_encode(\array_column($programByCity->toArray(), 'TOTAL'), true) }},
                                    labels:  {!! \json_encode(\array_column($programByCity->toArray(), 'CITY'), true) !!},
                                    tooltipContent: '',
                                    tooltipOpen: false,
                                    tooltipX: 0,
                                    tooltipY: 0,
                                    showTooltip(e) {
                                        this.tooltipContent = e.target.textContent
                                        this.tooltipX = e.target.offsetLeft - e.target.clientWidth;
                                        this.tooltipY = e.target.clientHeight + e.target.clientWidth;
                                    },
                                    hideTooltip(e) {
                                        this.tooltipContent = '';
                                        this.tooltipOpen = false;
                                        this.tooltipX = 0;
                                        this.tooltipY = 0;
                                    }
                                }
                            }
                        </script>
                    </div>
                </div>
            </div >
        </div>
</x-app-layout>
