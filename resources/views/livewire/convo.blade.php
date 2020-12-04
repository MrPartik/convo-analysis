<div id="convo-container"  class="flex-1 p:2 sm:p-6 justify-between flex flex-col"  style='height: 80vh'>
    <div id='messages' class="flex flex-col space-y-2 p-3 overflow-y-auto scrollbar-thumb-blue scrollbar-thumb-rounded scrollbar-track-blue-lighter scrollbar-w-2 scrolling-touch">
        @foreach($convos as $convo)
        <div class="chat-message">
            <div class="flex items-end {{ (Auth::id() === $convo->user_id)? 'justify-end' : '' }}">
                <div class="flex shadow-xl flex-col space-y-2 text-xs max-w-xs mx-2 order-2 ">
                    <div >
                        <span class = "px-4 py-2 rounded-lg inline-block text-sm {{ (Auth::id() === $convo->user_id)? 'rounded-br-none bg-blue-600 text-white' : 'rounded-bl-none bg-gray-300 text-gray-600' }}" >{{ $convo->message }}
                        @if($convo->url !== null)
                                <br> <a class="text-blue-800" target='_blank' href='{{ $convo->url }}'>show report</a>
                                <iframe src="{{ $convo->url }}" class="mt-2" scrolling='no'  height='300' width='auto'> </iframe>
                        @endif
                        </span >
                    </div >
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="border-t-2 border-gray-200 px-4 pt-4 mb-2 sm:mb-0">
        <div class="relative flex">
         <span class="absolute inset-y-0 flex items-center">
         </span>
            <input required wire:keydown.enter='sendConvo' wire:model='sContent' type="text" placeholder="Write Something" class="w-full focus:outline-none focus:placeholder-gray-400 text-gray-600 placeholder-gray-600 pl-5 pr-15 bg-gray-200 rounded-full py-3 font-semiboldbold">
            <div class="absolute right-0 items-center inset-y-0 sm:flex">
                <button wire:click='sendConvo' type="button" class="inline-flex items-center justify-center rounded-full h-12 w-12 transition duration-500 ease-in-out text-white bg-blue-500 hover:bg-blue-400 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-6 w-6 transform rotate-90">
                        <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>

<style>
    .scrollbar-w-2::-webkit-scrollbar {
        width: 0.25rem;
        height: 0.25rem;
    }

    .scrollbar-track-blue-lighter::-webkit-scrollbar-track {
        --bg-opacity: 1;
        background-color: #f7fafc;
        background-color: rgba(247, 250, 252, var(--bg-opacity));
    }

    .scrollbar-thumb-blue::-webkit-scrollbar-thumb {
        --bg-opacity: 1;
        background-color: #edf2f7;
        background-color: rgba(237, 242, 247, var(--bg-opacity));
    }

    .scrollbar-thumb-rounded::-webkit-scrollbar-thumb {
        border-radius: 0.25rem;
    }
</style>

<script>
    function scrollToLatest() {
        var el = document.getElementById('messages')
        el.scrollTop = el.scrollHeight
    }
    scrollToLatest();
    window.livewire.on('scrollToLatest', scrollToLatest);

    function toggleConvo() {
        $('#convo-container').slideToggle();
        $('#convo-wrapper').toggleClass('w-2/3');
    }
</script>