<div class="p-6">
    {{-- In work, do what you enjoy. --}}

    <div class="flex items-center justify-end px-4 py-3 text-right sm:px-6">
        <x-jet-button wire:click="createShowPermissionModel">
            {{ __('Create Permission') }}
        </x-jet-button>
    </div>

    <div class="flex flex-col items-center">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">

                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Id</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Role Type</th>
                                <!-- <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Date Creation</th> -->
                                <!-- <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Date Update</th> -->
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @if($displayData->count())
                                @foreach($displayData as $item)
                                     <tr>
                                        <td class="px-6 py-4 text-sm whitespace-no-wrap">
                                            {{ $item->id }}
                                        </td>
                                        <td class="px-6 py-4 text-sm whitespace-no-wrap">
                                            {{ $item->permission }}
                                        </td>
                                        <!-- <td class="px-6 py-4 text-sm whitespace-no-wrap">
                                            {{ $item->created_at }}
                                        </td>
                                        <td class="px-6 py-4 text-sm whitespace-no-wrap">
                                            {{ $item->updated_at }}
                                        </td> -->
                                        <td class="px-6 py-4 text-sm whitespace-no-wrap">
                                            <x-jet-button wire:click="updatePermission({{ $item->id }})">
                                                {{__('Update Permission')}}
                                            </x-jet-button>
                                            <x-jet-danger-button wire:click="deleteShowPermissionModal({{ $item->id }})">
                                                {{__('Delete Permission')}}
                                            </x-jet-danger-button>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                    <tr>
                                        <td class="px-6 py-4 text-sm whitespace-no-wrap" colspan="4">
                                            No Results Found
                                        </td>
                                    </tr>
                            @endif        
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{ $displayData->links() }}


<!-- MODALS -->
<!-- MODAL PERMISSION CREATE -->
    <x-jet-dialog-modal wire:model="modalCreatePermissionFormVisible">
            <x-slot name="title">
                {{ __('Create Permission') }}
            </x-slot>

            <x-slot name="content">
                <div class="mt-4">
                    <x-jet-label for="permission" value="permission" />
                    <x-jet-input id="permission" class="block mt-1 w-full" type="text" wire:model.debounce.800ms="permission" required autofocus />
                </div>
                <div class="mt-4">
                    <p>*Note that this process will create four (4) permission:</p>
                    <p>Name-Inputted-list</p>
                    <p>Name-Inputted-edit</p>
                    <p>Name-Inputted-create</p>
                    <p>Name-Inputted-delete</p>
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('modalCreatePermissionFormVisible')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-jet-secondary-button>
                <x-jet-secondary-button class="ml-2" wire:click="create" wire:loading.attr="disabled">
                    {{ __('Add Permission') }}
                </x-jet-secondary-button>                    
            </x-slot>
        </x-jet-dialog-modal>


<!-- MODAL UPDATE PERMISSION -->
    <x-jet-dialog-modal wire:model="modalUpdatePermissionFormVisible">
            <x-slot name="title">
                {{ __('Update Permission') }} {{$permsId}}
            </x-slot>

            <x-slot name="content">
                <div class="mt-4">
                    <x-jet-label for="permission" value="permission" />
                    <x-jet-input id="permission" class="block mt-1 w-full" type="text" wire:model.debounce.800ms="permission" required autofocus />
                </div>
                <div class="mt-4">
                    <p>*Note that the only data that can be change is the selected data</p>
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('modalUpdatePermissionFormVisible')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-jet-secondary-button>
                <x-jet-secondary-button class="ml-2" wire:click="updateUserPassword" wire:loading.attr="disabled">
                    {{ __('Update Permission') }}
                </x-jet-secondary-button>                    
            </x-slot>
        </x-jet-dialog-modal>

<!-- MODAL DELETE PERMISSION -->
    <x-jet-dialog-modal wire:model="modelConfirmPermissionDeleteVisible">
                <x-slot name="title">
                    {{ __('Delete Permission ') }} {{ $permsId }}
                </x-slot>
                <x-slot name="content">
                    {{ __('Are you sure you want to delete this permission? Once your permission is deleted, all of its resources and data will be permanently deleted.') }}
                </x-slot>
                <x-slot name="footer">
                    <x-jet-secondary-button wire:click="$toggle('modelConfirmPermissionDeleteVisible')" wire:loading.attr="disabled">
                        {{ __('Cancel') }}
                    </x-jet-secondary-button>
                    <x-jet-danger-button class="ml-2" wire:click="deletePermissionData" wire:loading.attr="disabled">
                        {{ __('Delete Permission') }}
                    </x-jet-danger-button>
                </x-slot>
            </x-jet-dialog-modal>

<!-- MODAL  -->

</div>
