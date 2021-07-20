<div>
    <div class="loading-page" wire:loading.block wire:target="setDashboardType, getProgramReportData, sStudentData, getCountHEIs">Loading&#8230;</div>
    <div class="bg-white overflow-y-auto scrollbar-thumb-blue scrollbar-thumb-rounded scrollbar-track-blue-lighter scrollbar-w-2 scrolling-touch p-2 rounded-lg" style="border: 1px solid lightgray; margin-bottom: 15px;">
        <ul class="tab" style="display: inline; float: left;">
            <li class=" {{ $iDashboardType === 0 ? 'text-white bg-blue-500' : 'text-blue-700 bg-transparent'}}  inline-block  hover:bg-blue-500 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded"><a wire:click="setDashboardType(0);" href="javascript:" class=" active">Dashboard</a></li>
            <li class=" {{ $iDashboardType === 1 ? 'text-white bg-blue-500' : 'text-blue-700 bg-transparent'}}  inline-block  hover:bg-blue-500 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded"><a wire:click="setDashboardType(1)" href="javascript:" class=" active">HEIs by Academic Year</a></li>
        </ul>
    </div>
    <div class="{{ $iDashboardType === 0 ? 'block' : 'hidden'}} bg-white p-2 rounded-lg" style="margin-bottom: 30px" >
        <div class="p-5 pt-1 flex-wrap  flex items-center gap-2 justify-center">
            <div class="bg-gradient-to-r flex-auto  w-42 h-42  from-blue-800 to-gray-700 shadow-lg rounded-lg">
                <div class="md:p-7 p-4">
                    <h2 class="text-xl font-bold text-center text-gray-200 capitalize">{{ $sAcademicYear }}</h2>
                    <h3 class="text-sm  text-gray-400  text-center">Academic Year</h3>
                </div>
            </div>
            <div class="bg-gradient-to-r flex-auto  w-42 h-42  from-gray-800 to-yellow-700 shadow-lg rounded-lg">
                <div class="md:p-7 p-4">
                    <h2 class="text-lg font-bold text-center text-gray-200 capitalize">{{ \number_format($aAcademicData['SUC']) }}</h2>
                    <h3 class="text-sm  text-gray-400  text-center">Total Students in SUCs</h3>
                </div>
            </div>
            <div class="bg-gradient-to-r flex-auto w-42 h-42  from-red-800 to-gray-700 shadow-lg rounded-lg">
                <div class="md:p-7 p-4">
                    <h2 class="text-xl font-bold text-center text-gray-200 capitalize">{{ \number_format($aAcademicData['LUC']) }}</h2>
                    <h3 class="text-sm  text-gray-400  text-center">Total Students in LUCs</h3>
                </div>
            </div>
            <div class="bg-gradient-to-r flex-auto w-42 h-42  from-orange-800 to-gray-700 shadow-lg rounded-lg">
                <div class="md:p-7 p-4">
                    <h2 class="text-xl font-bold text-center text-gray-200 capitalize">{{ \number_format($aAcademicData['Private']) }}</h2>
                    <h3 class="text-sm  text-gray-400  text-center">Total Students in PHEIs</h3>
                </div>
            </div>
            <div class="bg-gradient-to-r flex-auto  w-42 h-42  from-green-800 to-gray-700 shadow-lg rounded-lg">
                <div class="md:p-7 p-4">
                    <h2 class="text-lg font-bold text-center text-gray-200 capitalize" style="">{{ \number_format($aAcademicData['All']) }}</h2>
                    <h3 class="text-sm  text-gray-400  text-center">Total Students</h3>
                </div>
            </div>
        </div>
        <select id="student_data_type" wire:model="sStudentData" wire:change="getCountHEIs" class="form-select block mt-1" style="float: right; display: inline">
            <option value="enrollment">Enrollment Data</option>
            <option value="graduate">Graduate Data</option>
        </select>
        <select id="student_academic_year" wire:model="iYear" wire:change="getCountHEIs" class="mx-1 form-select block mt-1" style="float: right; display: inline">
            @foreach($aYears as $mKey => $sYear)
                <option value="{{ $mKey }}">{{ $sYear }}</option>
            @endforeach
        </select>
        <br/>
        <br/>
        <div class="p-2 pt-1 flex-wrap  flex items-center gap-2 justify-center">
            <div class="flex-auto w-50">
                <div class="md:p-7 p-4" id="student-charts">
                    <script type="text/javascript">
                        Highcharts.chart('student-charts', {
                            chart: {  type: 'bar' },
                            title: { text: 'Total Students per HEI in {{ $sAcademicYear }} using {{ ($sStudentData === "enrollment") ? "Enrollment Data" : "Graduate Data" }}'},
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
                                pointFormat: '<b>There are {point.y:.0f} data in {point.name} </b><br/>'
                            },
                            series: [
                                {
                                    name: "Data per HEi Type",
                                    colorByPoint: true,
                                    data: [
                                            @foreach($aAcademicData ?? [] as $mKey => $mVal)
                                            @if($mKey !== 'All')
                                        {
                                            name : '{{ $mKey }}',
                                            y    : {{ $mVal }}
                                        },
                                        @endif
                                        @endforeach
                                    ]
                                }
                            ]
                        });
                    </script>
                </div>
            </div>
            <div class="flex-auto w-50" >
                <div class="md:p-7 p-4" id="region-charts">
                    <script type="text/javascript">
                        Highcharts.chart('region-charts', {
                            chart: {  type: 'column' },
                            title: { text: 'Total Data per Registered Region in {{ $sAcademicYear }} using {{ ($sStudentData === "enrollment") ? "Enrollment Data" : "Graduate Data" }}'},
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
                                pointFormat: '<b>There are {point.y:.0f} data in region {point.name} </b><br/>'
                            },
                            series: [
                                {
                                    name: "Data per region registered",
                                    colorByPoint: true,
                                    data: [
                                            @foreach($aRegionReportData ?? [] as $mKey => $mVal)
                                        {
                                            name : '{{ $mKey }}',
                                            y    : {{ $mVal }}
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
    </div>
    <div  class="{{ $iDashboardType === 1 ? 'block' : 'hidden'}} bg-white p-2 rounded-lg" style="margin-bottom: 30px">
        <ul class="tab" style="display: inline; float: left;">
            <li class=" {{ $sType === 'HEIs' ? 'text-white bg-blue-500' : 'text-blue-700 bg-transparent'}}  inline-block  hover:bg-blue-500 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded"><a wire:click="getProgramReportData('ALL')" href="javascript:" class=" active">All</a></li>
            <li class=" {{ $sType === 'SUCs' ? 'text-white bg-blue-500' : 'text-blue-700 bg-transparent'}}  inline-block  hover:bg-blue-500 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded"><a wire:click="getProgramReportData('SUC')" href="javascript:" class=" active">SUCs</a></li>
            <li class=" {{ $sType === 'LUCs' ? 'text-white bg-blue-500' : 'text-blue-700 bg-transparent'}}  inline-block hover:bg-blue-500 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded"><a wire:click="getProgramReportData('LUC')" href="javascript:" class="">LUCs</a></li>
            <li class=" {{ $sType === 'PHEIs' ? 'text-white bg-blue-500' : 'text-blue-700 bg-transparent'}} inline-block hover:bg-blue-500 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded"><a wire:click="getProgramReportData('PRIVATE')" href="javascript:" class="">PHEIs</a></li>
        </ul>
        <select id="student_data_type" wire:model="sStudentData" wire:change="updateStudentData" class="form-select block mt-1" style="float: right; display: inline">
            <option value="enrollment">Enrollment Data</option>
            <option value="graduate">Graduate Data</option>
        </select>
        <br>
        <br>
        <div class="p-2 pt-1 flex-wrap  flex items-center gap-2 justify-center">
            <div class="flex-auto w-100">
                <div class="md:p-7 p-4" id="hei-charts">
                    <script type="text/javascript">
                        Highcharts.chart('hei-charts', {
                            chart: {type: 'bar'},
                            title: {text: 'Total {{ $sType }} per year using {{ ($sStudentData === "enrollment") ? "Enrollment Data" : "Graduate Data" }}'},
                            xAxis: {
                                type: 'category',
                                title: {text: null},
                                min: 0,
                                scrollbar: {enabled: true},
                                tickLength: 0
                            },
                            yAxis: {
                                title: {text: null}
                            },
                            legend: {enabled: false},
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
                                            name: {{ $mVal['year'] }},
                                            y: {{ $mVal['total_hei'] }}
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
    </div>
</div>
