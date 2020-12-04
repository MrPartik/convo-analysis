<x-guest-layout>
    <div class="bg-gray-100 h-screen w-screen">
        <div class="flex flex-col items-center flex-1 h-full justify-center px-4 sm:px-0">
            <div class="flex rounded-lg shadow-lg w-full sm:w-3/4 lg:w-1/2 bg-white sm:mx-0" style="height: 500px">
                <div class="flex flex-col w-full md:w-1/2 p-4">
                    <div class="flex flex-col flex-1 justify-center mb-8">
                        <x-jet-authentication-card-logo />
                        <div class="w-full mt-4">
                            <form class="form-horizontal w-3/4 mx-auto" method="POST" action="{{ route('login') }}">
                                <x-jet-validation-errors class="mb-4" />
                                @if (session('status'))
                                    <div class="mb-4 font-medium text-sm text-green-600">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                @csrf
                                <div class="flex flex-col mt-4">
                                    <x-jet-input id="email" class="flex-grow h-8 px-2 border rounded border-grey-400" placeholder="Email" type="email" name="email" :value="old('email')" required autofocus />
                                </div>
                                <div class="flex flex-col mt-4">
                                    <x-jet-input id="password" class="flex-grow h-8 px-2 rounded border border-grey-400" type="password" name="password" required autocomplete="current-password" placeholder="Password"/>
                                </div>
                                <div class="flex items-center mt-4">
                                    <input type="checkbox" name="remember" id="remember_me" class="mr-2"> <label for="remember_me" class="text-sm text-grey-dark">Remember Me</label>
                                </div>
                                <div class="flex flex-col mt-8">
                                    <button type="submit" class="bg-gray-800 hover:bg-gray-700 text-white text-sm font-semibold py-2 px-4 rounded">
                                        Login
                                    </button>
                                </div>
                            </form>
                            @if (Route::has('password.request'))
                                <div class="text-center mt-4">
                                    <a class="no-underline hover:underline text-blue-dark text-xs" href="{{ route('password.request') }}">
                                        Forgot Your Password?
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="hidden md:block md:w-1/2 rounded-r-lg" style="background: url('/img/accounting-pix.jpg'); background-size: cover; background-position: center center;"></div>
            </div>
        </div>
    </div>
</x-guest-layout>
