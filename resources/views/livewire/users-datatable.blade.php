@if(@$type === 'profile')
    @if ($profile !== '')
        <img class="h-8 w-8 rounded-full object-cover" src="{{ '/storage/' . $profile }}" alt=""/>
    @else
        <img class="h-8 w-8 rounded-full object-cover" src="{{ '//ui-avatars.com/api/?&color=7F9CF5&background=EBF4FF&name=' . $name }}" alt=""/>
    @endif
@elseif(@$type === 'action')
    <div class="flex space-x-1 justify-around">
        <button wire:click="showConfirmEdit({{$id}})" class="flex items-center space-x-2 px-3 border border-yellow-400 rounded-md bg-white text-yellow-400 text-xs leading-4 font-medium uppercase tracking-wider hover:bg-yellow-100 focus:outline-none">
            <span>Update </span>
            <svg class="h-4 w-5 stroke-current m-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
            </svg>
        </button>
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
                    <x-jet-input wire:model.lazy="name" type="text" class="mt-1 block w-3/4" placeholder="{{ __('Name') }}"/>
                    <x-jet-input-error for="name" class="mt-2"/>
                </div>
                <div class="col-span-6 sm:col-span-4 mt-5">
                    <label class="block font-medium text-sm text-gray-700" for="name">
                        Email
                    </label>
                    <x-jet-input wire:model.lazy="email" type="email" class="mt-1 block w-3/4" placeholder="{{ __('Email') }}"/>
                    <x-jet-input-error for="email" class="mt-2"/>
                </div>
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
                    <x-jet-input  wire:model.lazy="name"  type="text" class="mt-1 block w-3/4" placeholder="{{ __('Name') }}"/>
                    <x-jet-input-error for="name" class="mt-2"/>
                </div>
                <div class="col-span-6 sm:col-span-4 mt-5">
                    <label class="block font-medium text-sm text-gray-700" for="name">
                        Email
                    </label>
                    <x-jet-input  wire:model.lazy="email"  type="email" class="mt-1 block w-3/4" placeholder="{{ __('Email') }}"/>
                    <x-jet-input-error for="email" class="mt-2"/>
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

