    <div class="bg-white overflow-y-auto scrollbar-thumb-blue scrollbar-thumb-rounded scrollbar-track-blue-lighter scrollbar-w-2 scrolling-touch p-2 rounded-lg" style="height: 80vh; width: 90vw">
        <ul class="tab">
            <li ><a wire:click="getProgramReportData('SUC', true)" href="javascript:" class="tablinks active">SUC</a></li>
            <li><a wire:click="getProgramReportData('LUC', true)" href="javascript:" class="tablinks" onclick="openTab(event, 'LUC')">LUC</a></li>
            <li><a wire:click="getProgramReportData('PHEIS', true)" href="javascript:" class="tablinks" onclick="openTab(event, 'PHEIS')">PHEIS</a></li>
        </ul>
        <div wire:loading wire:target="getProgramReportData" class="absolute block bg-white opacity-75 z-50" style="width: inherit; height: inherit">
                <span class="text-green-500 opacity-75 top-1/2 my-0 mx-auto block relative w-0 h-0" style=" top: 50%; ">
                    <i class="fas fa-circle-notch fa-spin fa-5x"></i>
                </span>
        </div>
        <div style="display: block">
            <h3>SUC</h3>
            <p>
                {{ \json_encode($aProgramReportData, true) }}
            </p>
        </div>
    </div>
