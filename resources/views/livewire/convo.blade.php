<div id="convo-container" class="lg:w-3/4 md:w-full bg-white container mx-auto px-4 sm:px-8 flex-1 px-6 py-2 justify-between flex flex-col fixed bottom-0 right-0 left-0" style="height: 90vh; background: #ffffffe3;">
    <div class="loading-page hidden">Loading&#8230;</div>
    <div id='messages' class="flex flex-col space-y-2 p-3 overflow-y-auto scrollbar-thumb-blue scrollbar-thumb-rounded scrollbar-track-blue-lighter scrollbar-w-2 scrolling-touch">
        @foreach($convos ?? [] as $convo)
            <div class="chat-message">
                <div class="flex items-end {{ (Auth::id() === $convo->user_id)? 'justify-end' : '' }}">
                    <div class=" flex shadow-md flex-col space-y-2 text-xs max-w-xs mx-2 order-2 ">
                        <div>
                            <span class="break-words px-4 py-2 rounded-lg inline-block text-sm {{ (Auth::id() === $convo->user_id)? 'rounded-br-none bg-blue-600 text-white' : 'rounded-bl-none bg-gray-200 text-gray-600 hover:bg-gray-300' }}">{!! $convo->message  !!}
                                @if($convo->url !== null)
                                     <p><a class="text-blue-800" target='_blank' href='{{\env('RSHINY_SERVER', 'https://127.0.0.1:5718') . $convo->url . '&static=false' }} '> Show Report <img style="width: 100px; margin: 0 auto; filter: drop-shadow(0px 5px 5px black);" src='/img/bar-line.jpg'/></a></p>
                                @endif
                                <p class="mt-3" style="font-size: 10px" >{{ $convo->created_at }}</p>
                            </span>
                        </div>
                    </div>
                    @if(Auth::id() !== $convo->user_id)
                        <img src="/img/robot-avatar.jpg" alt="My profile" class="w-6 h-6 rounded-full order-1">
                    @endif
                </div>
            </div>
        @endforeach
    </div>
    <div class="border-t-2 border-gray-200 px-4 pt-4 mb-2 sm:mb-0">
        <div class="relative flex">
            <div class="bg-white shadow-md px-5" style="position: absolute;bottom: 65px;font-size: 12px;">
                @foreach($aSearchedPrograms ?? [] as $sProgram)
                    <div class="py-2 hover:bg-gray-100" style=" border-bottom: #e6e6e6 solid 1px; cursor:pointer; font-weight: bolder; color: #333333;" wire:click="selectProgram('{{\strtoupper($sProgram)}}')">{{\strtoupper($sProgram)}}</div>
                @endforeach
            </div>
            <div class="absolute left-0 items-center inset-y-0 sm:flex">
                <button wire:click="$emit('triggerDelete',{{ 1 }})" type="button" class="inline-flex items-center justify-center rounded-full h-12 w-12 transition duration-500 ease-in-out text-white bg-red-500 hover:bg-red-400 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </button>
            </div>
            <input required wire:keydown.enter='sendConvo' wire:model='sContent' wire:keydown='triggerSearchProgram' type="text" style="padding-left: 60px" placeholder="Write Something" class="w-full focus:outline-none focus:placeholder-gray-400 text-gray-600 placeholder-gray-600 pl-5 pr-15 bg-gray-200 rounded-full py-3 font-semiboldbold">
            <div class="absolute right-0 items-center inset-y-0 sm:flex" style="margin-right: 50px">
                <button wire:click='sendConvo' type="button" class="inline-flex items-center justify-center rounded-full h-12 w-12 transition duration-500 ease-in-out text-white bg-blue-500 hover:bg-blue-400 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-6 w-6 transform rotate-90">
                        <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"></path>
                    </svg>
                </button>
            </div>
            <div class="absolute right-0 items-center inset-y-0 sm:flex">
                <button onclick='startRecording();' type="button" class="record-button inline-flex items-center justify-center rounded-full h-12 w-12 transition duration-500 ease-in-out text-white bg-blue-500 hover:bg-blue-400 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="64" height="64" viewBox="0 0 172 172" style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g><path d="M169.34609,86c0,-46.02344 -37.32266,-83.34609 -83.34609,-83.34609c-46.02344,0 -83.34609,37.32266 -83.34609,83.34609c0,46.02344 37.32266,83.34609 83.34609,83.34609c46.02344,0 83.34609,-37.32266 83.34609,-83.34609z" fill="#f16152"></path><path d="M104.54375,83.01016c0,10.24609 -8.29766,18.54375 -18.54375,18.54375v0c-10.24609,0 -18.54375,-8.29766 -18.54375,-18.54375v-27.81563c0,-10.24609 8.29766,-18.54375 18.54375,-18.54375v0c10.24609,0 18.54375,8.29766 18.54375,18.54375z" fill="#ffffff"></path><path d="M98.49688,66.51563h-24.96016v-10.64922c0,-6.88672 5.57656,-12.46328 12.46328,-12.46328v0c6.88672,0 12.49688,5.57656 12.49688,12.46328z" fill="#f16152"></path><path d="M115.89844,69.27031c-2.18359,0 -3.93047,1.74687 -3.93047,3.93047v10.48125c0,14.31094 -11.65703,25.96797 -25.96797,25.96797c-14.31094,0 -25.96797,-11.65703 -25.96797,-25.96797v-10.48125c0,-2.18359 -1.74687,-3.93047 -3.93047,-3.93047c-2.18359,0 -3.93047,1.74687 -3.93047,3.93047v10.48125c0,17.30078 13.06797,31.61172 29.89844,33.56016v10.27969h-9.10391c-2.18359,0 -3.93047,1.74688 -3.93047,3.93047c0,2.18359 1.74687,3.93047 3.93047,3.93047h26.06875c2.18359,0 3.93047,-1.74687 3.93047,-3.93047c0,-2.18359 -1.74688,-3.93047 -3.93047,-3.93047h-9.10391v-10.27969c16.79688,-1.94844 29.89844,-16.25937 29.89844,-33.56016v-10.48125c-0.03359,-2.15 -1.78047,-3.93047 -3.93047,-3.93047z" fill="#ffffff"></path></g></g></svg>
                </button>
            </div>
        </div>
    </div>
</div>
<style>
    .pulse {
        background: white;
        border-radius: 50%;

        box-shadow: 0 0 0 0 rgba(0, 0, 0, 1);
        transform: scale(1);
        animation: pulse 2s infinite;
    }
    @keyframes pulse {
        0% {
            transform: scale(0.95);
            box-shadow: 0 0 0 0 salmon;
        }

        70% {
            transform: scale(1);
            box-shadow: 0 0 0 10px salmon;
        }

        100% {
            transform: scale(0.95);
            box-shadow: 0 0 0 0 salmon;
        }
    }
</style>
<script type="text/javascript">
    let oRecognition = new webkitSpeechRecognition();
    oRecognition.onresult = function(event) {
        let sSaidText = '';
        for (let iIndex = event.resultIndex; iIndex < event.results.length; iIndex++) {
            if (event.results[iIndex].isFinal) {
                sSaidText = event.results[iIndex][0].transcript;
            } else {
                sSaidText += event.results[iIndex][0].transcript;
            }
        }
        @this.set('sContent', sSaidText);
        @this.call('sendConvo');
        @this.set('sContent', sSaidText);
    }

    oRecognition.onaudiostart = function(event) {
        $('.record-button').addClass('pulse');
    }

    oRecognition.onaudioend = function(event) {
        $('.record-button').removeClass('pulse');
    }

    function startRecording(){
        oRecognition.start();
    }

    document.addEventListener('DOMContentLoaded', function () {
        @this.on('triggerDelete', function () {
            if (confirm('Are you sure? You want to delete all of your conversation with Brixbo AI?')) {
                @this.call('deleteConvo');
            }
        });
    })
</script>
