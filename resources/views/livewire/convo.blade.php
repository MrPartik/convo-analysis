<div id="convo-container" class="flex-1 px-6 py-2 justify-between flex flex-col" style='height: 80vh'>
    <div id='messages' class="flex flex-col space-y-2 p-3 overflow-y-auto scrollbar-thumb-blue scrollbar-thumb-rounded scrollbar-track-blue-lighter scrollbar-w-2 scrolling-touch">
        @foreach($convos as $convo)
            <div class="chat-message">
                <div class="flex items-end {{ (Auth::id() === $convo->user_id)? 'justify-end' : '' }}">
                    <div class="flex shadow-md flex-col space-y-2 text-xs max-w-xs mx-2 order-2 ">
                        <div>
                            <span class="break-words px-4 py-2 rounded-lg inline-block text-sm {{ (Auth::id() === $convo->user_id)? 'rounded-br-none bg-blue-600 text-white' : 'rounded-bl-none bg-gray-300 text-gray-600' }}">{!! $convo->message  !!}
                                @if($convo->url !== null)
                                     <p><a class="text-blue-800" target='_blank' href='{{\env('RSHINY_SERVER', 'https://127.0.0.1:5718') . $convo->url . '&static=false' }} '> Show Report <img style="width: 100px; margin: 0 auto; filter: drop-shadow(0px 5px 5px black);" src='/img/bar-line.jpg'/></a></p>
                                @endif
                                <p class="mt-3" style="font-size: 10px" >{{ $convo->created_at }}</p>
                            </span>
                        </div>
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
