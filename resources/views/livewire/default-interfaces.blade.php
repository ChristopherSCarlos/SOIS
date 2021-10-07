<div class="p-6">
    Homepage Default Interface
    
    <div class="flex items-center justify-end px-4 py-3 text-right sm:px-6">
        <x-jet-button wire:click="createDefaultInterfaceShowModel">
            {{ __('Create Interface Data') }}
        </x-jet-button>
    </div>
    <!-- DISPLAY DATA OF DEFAULT INTERFACE -->
    <div class="flex flex-col items-center">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Id</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Title</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Subtitle</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Details</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Logo</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Background Image</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Text Color</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Background Color 1</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Background Color 2</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Background Color 3</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($displayInterface as $uiData)
                            <tr>
                                <td class="px-6 py-4 text-sm whitespace-no-wrap">
                                    {{ $uiData->id }}
                                </td>
                                <td class="px-6 py-4 text-sm whitespace-no-wrap">
                                    {{ $uiData->homepage_title }}
                                </td>
                                <td class="px-6 py-4 text-sm whitespace-no-wrap">
                                    {{ $uiData->homepage_subtitle }}
                                </td>
                                <td class="px-6 py-4 text-sm whitespace-no-wrap">
                                    {{ $uiData->homepage_details }}
                                </td>
                                <td class="px-6 py-4 text-sm whitespace-no-wrap">
                                    {{ $uiData->homepage_logo }}
                                </td>
                                <td class="px-6 py-4 text-sm whitespace-no-wrap">
                                    {{ $uiData->homepage_background_image }}
                                </td>
                                <td class="px-6 py-4 text-sm whitespace-no-wrap">
                                    {{ $uiData->homepage_text_color }}
                                </td>
                                <td class="px-6 py-4 text-sm whitespace-no-wrap">
                                    {{ $uiData->homepage_background_color_1 }}
                                </td>
                                <td class="px-6 py-4 text-sm whitespace-no-wrap">
                                    {{ $uiData->homepage_background_color_2 }}
                                </td>
                                <td class="px-6 py-4 text-sm whitespace-no-wrap">
                                    {{ $uiData->homepage_background_color_3 }}
                                </td>
                                <td class="px-6 py-4 text-sm whitespace-no-wrap">
                                    <x-jet-button wire:click="updateDefaultInterfaceModel({{ $uiData->id }})">
                                        {{__('Update Default Interface')}}
                                    </x-jet-button>
                                    <x-jet-danger-button wire:click="deleteDefaultInterfaceModel({{ $uiData->id }})">
                                        {{__('Delete Default Interface')}}
                                    </x-jet-danger-button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{ $displayInterface->links() }}

<!-- MODALS -->
<!-- CREATE DEFAULT INTERFACE -->
    <x-jet-dialog-modal wire:model="createDefaultInterfaceShowModalFormVisible">
        <x-slot name="title">
            {{ __('Create Default Interface') }} 
        </x-slot>
        <x-slot name="content">
            <div class="mt-4">
                <x-jet-label for="homepage_title" value="{{ __('Homepage Title') }}" />
                <x-jet-input wire:model="homepage_title" id="homepage_title" class="block mt-1 w-full" type="text" />
            </div>
            <div class="mt-4">
                <x-jet-label for="homepage_subtitle" value="{{ __('Homepage Sub-Title') }}" />
                <x-jet-input wire:model="homepage_subtitle" id="homepage_subtitle" class="block mt-1 w-full" type="text" />
            </div>
            <div class="mt-4">
                <x-jet-label for="homepage_details" value="{{ __('Homepage Details') }}" />
                <x-jet-input wire:model="homepage_details" id="homepage_details" class="block mt-1 w-full" type="text" />
            </div>
            <div class="mt-4">
                <x-jet-label for="homepage_text_color" value="{{ __('Homepage Text Color') }}" />
                <x-jet-input wire:model="homepage_text_color" id="homepage_text_color" class="block mt-1 w-full" type="color" />
            </div>
            <div class="mt-4">
                <x-jet-label for="homepage_background_color_1" value="{{ __('Homepage Color 1') }}" />
                <x-jet-input wire:model="homepage_background_color_1" id="homepage_background_color_1" class="block mt-1 w-full" type="color" />
            </div>
            <div class="mt-4">
                <x-jet-label for="homepage_background_color_2" value="{{ __('Homepage Color 2') }}" />
                <x-jet-input wire:model="homepage_background_color_2" id="homepage_background_color_2" class="block mt-1 w-full" type="color" />
            </div>
            <div class="mt-4">
                <x-jet-label for="homepage_background_color_3" value="{{ __('Homepage Color 3') }}" />
                <x-jet-input wire:model="homepage_background_color_3" id="homepage_background_color_3" class="block mt-1 w-full" type="color" />
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('createDefaultInterfaceShowModalFormVisible')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>
            <x-jet-secondary-button class="ml-2" wire:click="create" wire:loading.attr="disabled">
                {{ __('Create Page') }}
            </x-jet-secondary-button>
        </x-slot>
    </x-jet-dialog-modal>

<!-- UPDATE DEFAULT INTERFACE -->
    <x-jet-dialog-modal wire:model="modelUpdateDefaultInterfaceData">
            <x-slot name="title">
                {{ __('Update Default Data') }} {{$defUIid}}
            </x-slot>
            <x-slot name="content">
                <div class="mt-4">
                    {{$uiData->id}}
                    <x-jet-label for="homepage_title" value="{{ __('Homepage Title') }}" />
                    <x-jet-input wire:model.debounce.800ms="homepage_title" id="homepage_title" class="block mt-1 w-full" type="text" />
                </div>
                <div class="mt-4">
                    <x-jet-label for="homepage_subtitle" value="{{ __('Homepage Sub-Title') }}" />
                    <x-jet-input wire:model.debounce.800ms="homepage_subtitle" id="homepage_subtitle" class="block mt-1 w-full" type="text" />
                </div>
                <div class="mt-4">
                    <x-jet-label for="homepage_details" value="{{ __('Homepage Details') }}" />
                    <x-jet-input wire:model.debounce.800ms="homepage_details" id="homepage_details" class="block mt-1 w-full" type="text" />
                </div>
                <div class="mt-4">
                    <x-jet-label for="homepage_text_color" value="{{ __('Homepage Text Color') }}" />
                    <x-jet-input wire:model.debounce.800ms="homepage_text_color" id="homepage_text_color" class="block mt-1 w-full" type="color" />
                </div>
                <div class="mt-4">
                    <x-jet-label for="homepage_background_color_1" value="{{ __('Homepage Color 1') }}" />
                    <x-jet-input wire:model.debounce.800ms="homepage_background_color_1" id="homepage_background_color_1" class="block mt-1 w-full" type="color" />
                </div>
                <div class="mt-4">
                    <x-jet-label for="homepage_background_color_2" value="{{ __('Homepage Color 2') }}" />
                    <x-jet-input wire:model.debounce.800ms="homepage_background_color_2" id="homepage_background_color_2" class="block mt-1 w-full" type="color" />
                </div>
                <div class="mt-4">
                    <x-jet-label for="homepage_background_color_3" value="{{ __('Homepage Color 3') }}" />
                    <x-jet-input wire:model.debounce.800ms="homepage_background_color_3" id="homepage_background_color_3" class="block mt-1 w-full" type="color" />
                </div>
            </x-slot>
            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('modelUpdateUserData')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-jet-secondary-button>
                @if($defUIid)
                    <x-jet-secondary-button class="ml-2" wire:click="update" wire:loading.attr="disabled">
                        {{ __('Update Default Interface Data') }}
                    </x-jet-secondary-button>                    
                @endif
            </x-slot>
        </x-jet-dialog-modal>

<!-- DELETE DEFAULT INTERFACE -->
    <x-jet-dialog-modal wire:model="modelConfirmDeleteDefaultInterface">
            <x-slot name="title">
                {{ __('Update Default Data') }} {{$defUIid}}
            </x-slot>
            <x-slot name="content">
                <div class="mt-4">
                    <x-jet-label for="status" value="{{ __('Do you want to delete this?') }}" />
                </div>
            </x-slot>
            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('modelUpdateUserData')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-jet-secondary-button>
                @if($defUIid)
                    <x-jet-secondary-button class="ml-2" wire:click="delete" wire:loading.attr="disabled">
                        {{ __('Delete Default Interface Data') }}
                    </x-jet-secondary-button>                    
                @endif
            </x-slot>
        </x-jet-dialog-modal>


<!-- ENDING DIV -->
</div>
