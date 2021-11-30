<div>
    <style>
        tr:hover {
            font-weight: 500;
            cursor: pointer;
        }
    </style>
    <div id="utterance-library" class="bg-white container mx-auto px-4 sm:px-8">
        <div class="loading-page" wire:loading.block wire:target="updateUtterance, nextPage, previousPage, reload, showTrainModal, hideTrainModal">Loading&#8230;</div>
        <div class="py-8" style="text-align: -webkit-center">
            <div>
                <h2 class="text-2xl font-semibold leading-tight">Utterances</h2>
                <small>Phrases that the users uses to have a conversation with bot.</small>
            </div>
            <div class="my-2 flex sm:flex-row flex-col">
                <div class="flex flex-row mb-1 sm:mb-0 w-full">
                    <div class="relative">
                        <select wire:model="iLimit" wire:change="updateUtterance" class="appearance-none h-full rounded-l border block appearance-none w-full bg-white border-gray-400 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                            <option value="10">10</option>
                            <option value="30">30</option>
                            <option value="50">50</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                            </svg>
                        </div>
                    </div>
                    <div class="relative ml-3">
                        <select wire:model="sIntent" wire:change="updateUtterance" class="appearance-none h-full rounded-l border block appearance-none w-full bg-white border-gray-400 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                            <option value="all">All</option>
                            @foreach($aIntents as $aIntent)
                                <option value="{{$aIntent['name']}}">{{$aIntent['name']}}</option>
                            @endforeach
                        </select>
                        <div  class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                            </svg>
                        </div>
                    </div>
                    <div class="relative">
                        <button wire:click="reload" title="Reset" type="button" class="mx-3 p-3 inline-flex items-center justify-center rounded-full h-12 w-12 transition duration-500 ease-in-out text-white bg-green-500 hover:bg-green-400 focus:outline-none">
                            <svg fill="white" viewBox="0 0 50 50"><path d="M25 2 A 1.0001 1.0001 0 1 0 25 4C36.609534 4 46 13.390466 46 25C46 36.609534 36.609534 46 25 46C13.390466 46 4 36.609534 4 25C4 18.776502 6.7056023 13.200205 11 9.3554688L11 17 A 1.0001 1.0001 0 1 0 13 17L13 7 A 1.0001 1.0001 0 0 0 12 6L2 6 A 1.0001 1.0001 0 1 0 2 8L9.5234375 8C4.9051803 12.207192 2 18.26679 2 25C2 37.690466 12.309534 48 25 48C37.690466 48 48 37.690466 48 25C48 12.309534 37.690466 2 25 2 z"/></svg>
                        </button>
                        </a>
                    </div>
                    <div class="relative" style="margin-inline-start: auto;">
                        <button wire:click="showTrainModal()" href="javascript:" class=" text-white bg-blue-500  inline-block  hover:bg-blue-400 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">Train Brixbo</button>
                    </div>
                </div>
            </div>
            <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                    <table class="min-w-full leading-normal">
                        <thead>
                        <tr>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">
                                Text/ Utterance
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">
                                Intent
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">
                                Entities
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">
                                Copy Utterance
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($aUtterances ?? [] as $aUtterance)
                            <tr>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="utterance-text text-gray-900 whitespace-no-wrap">
                                        {{ @$aUtterance['text'] }}
                                    </p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        {{ @$aUtterance['intent']['name'] ?? 'None'}}
                                    </p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        @if(($aUtterance['entities'] === []))
                                            None
                                        @endif
                                        @foreach($aUtterance['entities'] as $aEntity)
                                            {{ $aEntity['name'] . '(' . $aEntity['body'] . ') ,' }}
                                        @endforeach
                                    </p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm w-15">
                                    <li class="inline-block hover:bg-blue-500 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded"><a onclick="copyToClipboard('{{ @$aUtterance['text'] }}')" href="javascript:" class="active">Copy</a></li>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="px-5 py-5 bg-white border-t flex flex-col xs:flex-row items-center xs:justify-between">
                        <span class="text-xs xs:text-sm text-gray-900">
                            Please click next or previous, data are from realtime. <strong> Current Page : <input wire:model="iPage" wire:keydown.enter="reload" /> </strong>
                        </span>
                        <div class="inline-flex mt-2 xs:mt-0">
                            <button {{ (($iPage === 1) ? 'disabled=true' : '') }} wire:click="previousPage" class="mx-1 text-sm bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-l">
                                Prev
                            </button>
                            <button wire:click="nextPage" class="text-sm bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-r">
                                Next
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                function copyToClipboard(sValue) {
                    const el = document.createElement('textarea');
                    el.value = sValue;
                    document.body.appendChild(el);
                    el.select();
                    document.execCommand('copy');
                    document.body.removeChild(el);
                    alert("Text has been copied: " + sValue);
                }
            </script>
        </div>
        <x-jet-dialog-modal wire:model="bIsTrainModalShown">
            <x-slot name="title">
                {{ __('Train Brixbo') }}
            </x-slot>
            <x-slot name="content">
                {{ __('Please provide the necessary fields to train the accuracy of brixbo. This is created for relevant programs/ courses in the app') }}
                <div class="mt-4" x-data="{}">
                    @if(array_key_exists('status', $trainResponse) === true)
                        <label class="block font-medium text-sm {{ ($trainResponse['status'] === true ? 'text-green-700' : 'text-red-700') }}">
                            {{ $trainResponse['message'] }}
                        </label>
                        <br />
                    @endif
                    <div class="col-span-6 sm:col-span-4">
                        <label class="block font-medium text-sm text-gray-700" for="utterance">
                            Utterance/ Conversation (ex. Get the summary of HEI for BSIT)
                        </label>
                        <x-jet-input id="utterance" wire:model.lazy="utteranceText" type="text" class="mt-1 block w-full" placeholder="{{ __('Utterance/ Conversation') }}"/>
                        <x-jet-input-error for="utteranceText" class="mt-2"/>
                    </div>
                    <div class="col-span-6 sm:col-span-4 mt-5">
                        <label class="block font-medium text-sm text-gray-700" for="entity_to_recall">
                            Entity to train/ recall Value (ex. BSIT)
                        </label>
                        <x-jet-input type="text" wire:model.lazy="entityToRecallValue" class="mt-1 block w-full" placeholder="{{ __('Entity') }}"/>
                        <x-jet-input-error for="entityToRecallValue" class="mt-2"/>
                    </div>
                    <div class="col-span-6 sm:col-span-4 mt-5">
                        <label class="block font-medium text-sm text-gray-700" for="role">
                            Intent of the Conversation above (ex. getHei)
                        </label>
                        <select id="intent" wire:model="intentValue" class="form-select rounded-md shadow-sm mt-1 block w-full">
                            <option value="" selected>Select Intent</option>
                            @foreach($aIntents as $aIntent)
                                <option value="{{$aIntent['name']}}">{{$aIntent['name']}}</option>
                            @endforeach
                        </select>
                        <x-jet-input-error for="intentValue" class="mt-2"/>
                    </div>
                    <div class="col-span-6 sm:col-span-4 mt-5">
                        <label class="block font-medium text-sm text-gray-700" for="role">
                            Assign Existing Entity (ex. BACHELOR OF SCIENCE IN INFORMATION TECHNOLOGY);
                            <br/>
                            <a wire:click="showEntityModal()" class="underline text-sm text-gray-600 hover:text-gray-900" href="javascript:"> Create Entity</a> (if entity is not existing)
                        </label>
                        <select id="entities" wire:model = "assignedEntityValue" class="form-select rounded-md shadow-sm mt-1 block w-full">
                            <option value="" selected>Select Existing Entity</option>
                            @foreach($aEntities as $sEntity)
                                <option value="{{$sEntity}}">{{ strtoupper(\App\Library\utils::convertEntityName($sEntity, true)) }}</option>
                            @endforeach
                        </select>
                        <x-jet-input-error for="assignedEntityValue" class="mt-2"/>
                    </div>
                </div>
            </x-slot>
            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('bIsTrainModalShown')" wire:loading.attr="disabled">
                    {{ __('Nevermind') }}
                </x-jet-secondary-button>

                <x-jet-button class="ml-2"  wire:click="trainBrixbo" wire:loading.attr="disabled">
                    {{ __('Train') }}
                </x-jet-button>
            </x-slot>
        </x-jet-dialog-modal>


        <x-jet-dialog-modal wire:model="bIsEntityModalShown">
            <x-slot name="title">
                {{ __('Add Entity') }}
            </x-slot>
            <x-slot name="content">
                {{ __('If the entity you are looking for is not existing, you need to create it first before proceeding to the next steps.') }}
                <div class="mt-4" x-data="{}">
                    <div class="col-span-6 sm:col-span-4 mt-5">
                        <label class="block font-medium text-sm text-gray-700" for="role">
                            Programs Existing in Database (ex. BACHELOR OF SCIENCE IN INFORMATION TECHNOLOGY);
                        </label>
                        <select id="programs" wire:model="entityProgram" class="form-select rounded-md shadow-sm mt-1 block w-full">
                            <option value="" selected>Select Program</option>
                            @foreach($aPrograms as $sProgram)
                                <option value="{{ strtoupper(\App\Library\utils::convertEntityName($sProgram)) }}">{{ strtoupper($sProgram) }}</option>
                            @endforeach
                        </select>
                        <x-jet-input-error for="entityProgram" class="mt-2"/>
                    </div>
                    @if(strlen($entityProgram) <= 0)
                        <div class="col-span-6 sm:col-span-4 mt-5">
                            <label class="block font-medium text-sm text-gray-700" for="custom_entity">
                                Custom Entity (optional)
                            </label>
                            <x-jet-input id="custom_entity" wire:model.lazy="entityCustomText" type="custom_entity" class="mt-1 block w-full" placeholder="{{ __('Custom Entity') }}"/>
                            <x-jet-input-error for="entityCustomText" class="mt-2"/>
                        </div>
                    @endif
                </div>
            </x-slot>
            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('bIsEntityModalShown')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-jet-secondary-button>

                <x-jet-button class="ml-2" wire:click="saveEntity" wire:loading.attr="disabled">
                    {{ __('Save') }}
                </x-jet-button>
            </x-slot>
        </x-jet-dialog-modal>
    </div>
    <script>
        window.livewire.on('select2',() => {
            $('[id=entities]').select2({
                width: '100%'
            }).off('select2:select').on('select2:select', (e) => {
                @this.set('assignedEntityValue', e.params.data.id);
            });
            $('[id=intent]').select2({
                width: '100%'
            }).off('select2:select').on('select2:select', (e) => {
                @this.set('intentValue', e.params.data.id);
            });
            $('[id=programs]').select2({
                width: '100%'
            }).off('select2:select').on('select2:select', (e) => {
                @this.set('entityProgram', e.params.data.id);
            });
        });

    </script>
</div>
