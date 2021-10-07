<div class="p-6">
    {{-- Stop trying to control. --}}
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">Roles</h2>
    <div class="flex items-center justify-end px-4 py-3 text-right sm:px-6">
        <x-jet-button wire:click="createShowRolesModel">
            {{ __('Create Roles') }}
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
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Roles</th>
                                <!-- <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Date Creation</th> -->
                                <!-- <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Date Update</th> -->
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Action</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Sync Permission</th>
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
                                            {{ $item->role_type }}
                                        </td>
                                        <!-- <td class="px-6 py-4 text-sm whitespace-no-wrap">
                                            {{ $item->created_at }}
                                        </td>
                                        <td class="px-6 py-4 text-sm whitespace-no-wrap">
                                            {{ $item->updated_at }}
                                        </td> -->
                                        <td class="px-6 py-4 text-sm whitespace-no-wrap">
                                            <x-jet-danger-button wire:click="deleteRoleModal({{ $item->id }})">
                                                {{__('Delete Role')}}
                                            </x-jet-danger-button>
                                        </td>
                                        <td class="px-6 py-4 text-sm whitespace-no-wrap">
                                            <x-jet-button wire:click="syncPermissionModel({{ $item->id }})">
                                                {{__('Sync Permission')}}
                                            </x-jet-button>
                                        </td>
                                        <td class="px-6 py-4 text-sm whitespace-no-wrap">
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
<!-- MODAL CREATE -->
    <x-jet-dialog-modal wire:model="modalCreateRolesFormVisible">
            <x-slot name="title">
                {{ __('Create Role') }}
            </x-slot>

            <x-slot name="content">
                <div class="mt-4">
                    <x-jet-label for="role_type" value="role_type" />
                    <x-jet-input id="role_type" class="block mt-1 w-full" type="text" wire:model.debounce.800ms="role_type" required autofocus />
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('modalCreateRolesFormVisible')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-jet-secondary-button>
                <x-jet-secondary-button class="ml-2" wire:click="create" wire:loading.attr="disabled">
                    {{ __('Add Role') }}
                </x-jet-secondary-button>                    
            </x-slot>
        </x-jet-dialog-modal>

<!-- DELETE ROLE MODAL -->
    <x-jet-dialog-modal wire:model="modalDeleteRolesFormVisible">
                <x-slot name="title">
                    {{ __('Delete Role ') }} {{ $roleId }}
                </x-slot>
                <x-slot name="content">
                    {{ __('Are you sure you want to delete your role? Once your role is deleted, all of its resources and data will be permanently deleted.') }}
                </x-slot>
                <x-slot name="footer">
                    <x-jet-secondary-button wire:click="$toggle('modalDeleteRolesFormVisible')" wire:loading.attr="disabled">
                        {{ __('Cancel') }}
                    </x-jet-secondary-button>
                    <x-jet-danger-button class="ml-2" wire:click="deleteRoleData" wire:loading.attr="disabled">
                        {{ __('Delete Role') }}
                    </x-jet-danger-button>
                </x-slot>
            </x-jet-dialog-modal>

<!-- SYNC ROLES PERMISSION  -->
    <x-jet-dialog-modal wire:model="modalSyncRolePermissionVisible">
            <x-slot name="title">
                {{ __('Sync Permission') }} to Role #: {{ $roleId }}
            </x-slot>

            <x-slot name="content">
                <form>
                @foreach($displayPermsData as $permsData)
                    <div class="mt-1">
                            <label class="inline-flex items-center">
                                <input type="checkbox" value="{{ $permsData->id }}" name="{{$permsData->id}}" wire:model="selectedPermsOnRoles"  class="form-checkbox h-6 w-6 text-green-500">
                                <span class="ml-3 text-sm">{{ $permsData->permission }}</span>
                            </label>
                    </div>
                @endforeach
                </form>

            </x-slot>

            <x-slot name="footer">
                    <x-jet-secondary-button wire:click="$toggle('modalSyncRolePermissionVisible')" wire:loading.attr="disabled">
                        {{ __('Cancel') }}
                    </x-jet-secondary-button>
                    <x-jet-secondary-button class="ml-2" wire:click="syncPermissionRole" wire:loading.attr="disabled">
                        {{ __('Sync Permission to Role') }}
                    </x-jet-secondary-button>                    
            </x-slot>
        </x-jet-dialog-modal>
</div>
