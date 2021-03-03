    <div class="bg-white overflow-y-auto scrollbar-thumb-blue scrollbar-thumb-rounded scrollbar-track-blue-lighter scrollbar-w-2 scrolling-touch p-2 rounded-lg" style="height: 80vh; width: 90vw">
        <ul class="tab">
            <li class=" {{ $sType === 'SUC' ? 'text-white bg-blue-500' : 'text-blue-700 bg-transparent'}}  inline-block  hover:bg-blue-500 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded"><a wire:click="getProgramReportData('SUC', true)" href="javascript:" class=" active">SUC</a></li>
            <li class=" {{ $sType === 'LUC' ? 'text-white bg-blue-500' : 'text-blue-700 bg-transparent'}}  inline-block hover:bg-blue-500 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded"><a wire:click="getProgramReportData('LUC', true)" href="javascript:" class="">LUC</a></li>
            <li class=" {{ $sType === 'PRIVATE' ? 'text-white bg-blue-500' : 'text-blue-700 bg-transparent'}} inline-block hover:bg-blue-500 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded"><a wire:click="getProgramReportData('PRIVATE', true)" href="javascript:" class="">Private / PHEIS</a></li>
        </ul>
        <div wire:loading wire:target="getProgramReportData" class="absolute block bg-white opacity-75 z-50" style="width: inherit; height: inherit">
                <span class="text-green-500 opacity-75 top-1/2 my-0 mx-auto block relative w-0 h-0" style=" top: 50%; ">
                    <i class="fas fa-circle-notch fa-spin fa-5x"></i>
                </span>
        </div>
        <div style="display: block">
            <div id="hei-charts">
                <script type="text/javascript">
                    Highcharts.chart('hei-charts', {
                        chart: {  type: 'bar' },
                        title: { text: 'Total {{ $sType }} per year'  },
                        xAxis: {
                            type: 'category',
                            title: { text: null },
                            min: 0,
                            scrollbar: {  enabled: true },
                            tickLength: 0
                        },
                        yAxis: {
                            title: { text: null }
                        },
                        legend: { enabled: false },
                        plotOptions: {
                            series: {
                                borderWidth: 0,
                                dataLabels: {
                                    enabled: true,
                                    format: '{point.y:.0f}'
                                }
                            }
                        },
                        tooltip: {
                            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                            pointFormat: '<b>There are {point.y:.0f} {{ $sType }} in {point.name} </b><br/>'
                        },
                        series: [
                            {
                                name: "{{ $sType }}",
                                colorByPoint: true,
                                data: [
                                    @foreach($aProgramReportData ?? [] as $mKey => $mVal)
                                    {
                                        name : {{ $mVal['year'] }},
                                        y    : {{ $mVal['total_hei'] }}
                                    },
                                    @endforeach
                                ]
                            }
                        ]
                    });
                </script>
            </div>
        </div>
    </div>
