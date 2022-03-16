@if(@$type === 'profile')
    @if ($profile !== '')
        <img class="h-8 w-8 rounded-full object-cover" src="{{ '/storage/' . $profile }}" alt=""/>
    @else
        <img class="h-8 w-8 rounded-full object-cover" src="{{ '//ui-avatars.com/api/?&color=7F9CF5&background=EBF4FF&name=' . $name }}" alt=""/>
    @endif
@elseif(@$type === 'action')
    <div class="flex space-x-1 justify-around">
        <button wire:click="showConfirmEdit({{$id}})" class="flex items-center space-x-2 px-3 border border-yellow-400 rounded-md bg-white text-yellow-400 text-xs leading-4 font-medium uppercase tracking-wider hover:bg-yellow-100 focus:outline-none">

            <svg class="h-4 w-5 stroke-current m-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
            </svg>
        </button>
        @if($isActive === true)
        <button wire:click="toggleVisibility({{$id}})" class="flex items-center space-x-2 px-3 border border-red-400 rounded-md bg-white text-red-400 text-xs leading-4 font-medium uppercase tracking-wider hover:bg-red-100 focus:outline-none">
            <svg class="h-4 w-5 stroke-current m-2" fill="currentColor" viewBox="0 0 50 50" xmlns="http://www.w3.org/2000/svg">
                <path d="M 21 0 C 19.355469 0 18 1.355469 18 3 L 18 5 L 10.1875 5 C 10.0625 4.976563 9.9375 4.976563 9.8125 5 L 8 5 C 7.96875 5 7.9375 5 7.90625 5 C 7.355469 5.027344 6.925781 5.496094 6.953125 6.046875 C 6.980469 6.597656 7.449219 7.027344 8 7 L 9.09375 7 L 12.6875 47.5 C 12.8125 48.898438 14.003906 50 15.40625 50 L 34.59375 50 C 35.996094 50 37.1875 48.898438 37.3125 47.5 L 40.90625 7 L 42 7 C 42.359375 7.003906 42.695313 6.816406 42.878906 6.503906 C 43.058594 6.191406 43.058594 5.808594 42.878906 5.496094 C 42.695313 5.183594 42.359375 4.996094 42 5 L 32 5 L 32 3 C 32 1.355469 30.644531 0 29 0 Z M 21 2 L 29 2 C 29.5625 2 30 2.4375 30 3 L 30 5 L 20 5 L 20 3 C 20 2.4375 20.4375 2 21 2 Z M 11.09375 7 L 38.90625 7 L 35.3125 47.34375 C 35.28125 47.691406 34.910156 48 34.59375 48 L 15.40625 48 C 15.089844 48 14.71875 47.691406 14.6875 47.34375 Z M 18.90625 9.96875 C 18.863281 9.976563 18.820313 9.988281 18.78125 10 C 18.316406 10.105469 17.988281 10.523438 18 11 L 18 44 C 17.996094 44.359375 18.183594 44.695313 18.496094 44.878906 C 18.808594 45.058594 19.191406 45.058594 19.503906 44.878906 C 19.816406 44.695313 20.003906 44.359375 20 44 L 20 11 C 20.011719 10.710938 19.894531 10.433594 19.6875 10.238281 C 19.476563 10.039063 19.191406 9.941406 18.90625 9.96875 Z M 24.90625 9.96875 C 24.863281 9.976563 24.820313 9.988281 24.78125 10 C 24.316406 10.105469 23.988281 10.523438 24 11 L 24 44 C 23.996094 44.359375 24.183594 44.695313 24.496094 44.878906 C 24.808594 45.058594 25.191406 45.058594 25.503906 44.878906 C 25.816406 44.695313 26.003906 44.359375 26 44 L 26 11 C 26.011719 10.710938 25.894531 10.433594 25.6875 10.238281 C 25.476563 10.039063 25.191406 9.941406 24.90625 9.96875 Z M 30.90625 9.96875 C 30.863281 9.976563 30.820313 9.988281 30.78125 10 C 30.316406 10.105469 29.988281 10.523438 30 11 L 30 44 C 29.996094 44.359375 30.183594 44.695313 30.496094 44.878906 C 30.808594 45.058594 31.191406 45.058594 31.503906 44.878906 C 31.816406 44.695313 32.003906 44.359375 32 44 L 32 11 C 32.011719 10.710938 31.894531 10.433594 31.6875 10.238281 C 31.476563 10.039063 31.191406 9.941406 30.90625 9.96875 Z"></path>
            </svg>
        </button>
        @else
        <button wire:click="toggleVisibility({{$id}})" class="flex items-center space-x-2 px-3 border border-green-400 rounded-md bg-white text-green-400 text-xs leading-4 font-medium uppercase tracking-wider hover:bg-green-100 focus:outline-none">
           <svg class="h-4 w-5 stroke-current m-2" fill="currentColor" viewBox="0 0 50 50" xmlns="http://www.w3.org/2000/svg">
               <path d="M32.8125 2.96875C32.023438 3.023438 31.339844 3.535156 31.070313 4.28125C30.796875 5.023438 30.992188 5.859375 31.5625 6.40625L38.09375 13L27 13C20.484375 13 15.449219 14.648438 12.03125 17.71875C8.613281 20.789063 7 25.191406 7 30C7 39.117188 10.25 44.96875 10.25 44.96875C10.785156 45.933594 12.003906 46.285156 12.96875 45.75C13.933594 45.214844 14.285156 43.996094 13.75 43.03125C13.75 43.03125 11 38.191406 11 30C11 26.050781 12.222656 22.960938 14.71875 20.71875C17.214844 18.476563 21.160156 17 27 17L38.09375 17L31.5625 23.59375C30.785156 24.386719 30.800781 25.660156 31.59375 26.4375C32.386719 27.214844 33.660156 27.199219 34.4375 26.40625L44.3125 16.40625L45.71875 15L44.3125 13.59375L34.4375 3.59375C34.0625 3.199219 33.542969 2.972656 33 2.96875C32.9375 2.964844 32.875 2.964844 32.8125 2.96875Z"></path>
            </svg>
        </button>
       @endif
    </div>
@else
    <button wire:click="showConfirmAdd" class="mb-5 flex items-center space-x-2 px-3 border border-blue-400 rounded-md bg-white text-blue-400 text-xs leading-4 font-medium uppercase tracking-wider hover:bg-blue-100 focus:outline-none">
        <span>Add User</span>
        <svg class="h-5 w-5 stroke-current m-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
        </svg>
    </button>

    <x-jet-dialog-modal wire:model="confirmAdd" >
        <x-slot name="title">
            {{ __('Add User') }}
        </x-slot>
        <x-slot name="content">
            {{ __('Please provide the user`s details, in order to login the account created, you need to forgot password using your this email address.') }}
            <div class="mt-4" x-data="{}">
                <div class="col-span-6 sm:col-span-4">
                    <label class="block font-medium text-sm text-gray-700" for="name">
                        Name
                    </label>
                    <x-jet-input wire:model.lazy="name" type="text" class="mt-1 block w-full" placeholder="{{ __('Name') }}"/>
                    <x-jet-input-error for="name" class="mt-2"/>
                </div>
                <div class="col-span-6 sm:col-span-4 mt-5">
                    <label class="block font-medium text-sm text-gray-700" for="name">
                        Email
                    </label>
                    <x-jet-input wire:model.lazy="email" type="email" class="mt-1 block w-full" placeholder="{{ __('Email') }}"/>
                    <x-jet-input-error for="email" class="mt-2"/>
                </div>
                <div class="col-span-6 sm:col-span-4 mt-5">
                    <label class="block font-medium text-sm text-gray-700" for="role">
                        User Role
                    </label>
                    <select wire:model="role"  id="role" class="form-select rounded-md shadow-sm mt-1 block w-full">
                        <option value="">Select Role</option>
                        <option value="user">CHED Regional Officer</option>
                        <option value="top">Top Management</option>
                        <option value="admin">Admin</option>
                    </select>
                    <x-jet-input-error for="role" class="mt-2"/>
                </div>
                @if($role == 'user')
                <div class="col-span-6 sm:col-span-4 mt-5">
                    <label class="block font-medium text-sm text-gray-700" for="region">
                        Regional Office
                    </label>
                    <select wire:model="region"  id="region" class="form-select rounded-md shadow-sm mt-1 block w-full">
                        <option value="" selected>Select Region</option>
                        <option value="NCR">Region NCR: National Capital Region</option>
                        <option value="CAR">Region CAR: Cordillera Administrative Region</option>
                        <option value="I">Region I: Ilocos Region</option>
                        <option value="II">Region II: Cagayan Valley</option>
                        <option value="IV-A">Region IV-A: Calabarzon</option>
                        <option value="IV-B">Region IV-B: Mimaropa</option>
                        <option value="V">Region V: Bicol Region</option>
                        <option value="VI">Region VI: Western Visayas</option>
                        <option value="VII">Region VII: Central Visayas</option>
                        <option value="VIII">Region VIII: Eastern Visayas</option>
                        <option value="IX">Region IX: Zamboanga Peninsula</option>
                        <option value="X">Region X: Northern Mindanao</option>
                        <option value="XI">Region XI: Davao Region</option>
                        <option value="XII">Region XII: Soccsksargen</option>
                        <option value="XIII">Region XIII: Caraga</option>
                        <option value="BARMM">Region BARMM: Bangsamoro</option>
                    </select>
                    <x-jet-input-error for="region" class="mt-2"/>
                </div>
                @endif
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('confirmAdd')" wire:loading.attr="disabled">
                {{ __('Nevermind') }}
            </x-jet-secondary-button>

            <x-jet-button wire:click="saveNewUser" class="ml-2"  wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>

    <x-jet-dialog-modal wire:model="confirmEdit">
        <x-slot name="title">
            {{ __('Edit User') }}
        </x-slot>

        <x-slot name="content">
            {{ __('You can now edit the basic info.') }}
            <div class="mt-4" x-data="{}">
                <div class="col-span-6 sm:col-span-4">
                    <label class="block font-medium text-sm text-gray-700" for="name">
                        Name
                    </label>
                    <x-jet-input  wire:model.lazy="name"  type="text" class="mt-1 block w-full" placeholder="{{ __('Name') }}"/>
                    <x-jet-input-error for="name" class="mt-2"/>
                </div>
                <div class="col-span-6 sm:col-span-4 mt-5">
                    <label class="block font-medium text-sm text-gray-700" for="name">
                        Email
                    </label>
                    <x-jet-input  wire:model.lazy="email"  type="email" class="mt-1 block w-full" placeholder="{{ __('Email') }}"/>
                    <x-jet-input-error for="email" class="mt-2"/>
                </div>
                <div class="col-span-6 sm:col-span-4 mt-5">
                    <label class="block font-medium text-sm text-gray-700" for="role">
                        User Role
                    </label>
                    <select wire:model.lazy="role"  id="role" class="form-select rounded-md shadow-sm mt-1 block w-full">
                        <option value="user">CHED Regional Officer</option>
                        <option value="top">Top Management</option>
                        <option value="admin">Admin</option>
                    </select>
                    <x-jet-input-error for="role" class="mt-2"/>
                    @if($role == 'user')
                        <div class="col-span-6 sm:col-span-4 mt-5">
                            <label class="block font-medium text-sm text-gray-700" for="region">
                                Regional Office
                            </label>
                            <select wire:model="region"  id="region" class="form-select rounded-md shadow-sm mt-1 block w-full">
                                <option value="" selected>Select Region</option>
                                <option value="NCR">Region NCR: National Capital Region</option>
                                <option value="CAR">Region CAR: Cordillera Administrative Region</option>
                                <option value="I">Region I: Ilocos Region</option>
                                <option value="II">Region II: Cagayan Valley</option>
                                <option value="IV-A">Region IV-A: Calabarzon</option>
                                <option value="IV-B">Region IV-B: Mimaropa</option>
                                <option value="V">Region V: Bicol Region</option>
                                <option value="VI">Region VI: Western Visayas</option>
                                <option value="VII">Region VII: Central Visayas</option>
                                <option value="VIII">Region VIII: Eastern Visayas</option>
                                <option value="IX">Region IX: Zamboanga Peninsula</option>
                                <option value="X">Region X: Northern Mindanao</option>
                                <option value="XI">Region XI: Davao Region</option>
                                <option value="XII">Region XII: Soccsksargen</option>
                                <option value="XIII">Region XIII: Caraga</option>
                                <option value="BARMM">Region BARMM: Bangsamoro</option>
                            </select>
                            <x-jet-input-error for="region" class="mt-2"/>
                        </div>
                    @endif
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('confirmEdit')" wire:loading.attr="disabled">
                {{ __('Nevermind') }}
            </x-jet-secondary-button>

            <x-jet-button class="ml-2" wire:click="saveExistingUser"  wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>
@endif

