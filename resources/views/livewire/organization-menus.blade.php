<div class="p-6">
    <div class="p-6">
    <div class="flex items-center justify-end px-4 py-3 text-right sm:px-6">
        @if($userAuthRole == 'Super Admin')
            <x-jet-button wire:click="createShowModel">
                {{ __('Create Organization') }}
            </x-jet-button>
        @endif
    </div>

    <div class="flex flex-col items-center">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">

                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <!-- <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Organization Photo</th> -->
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Organization Name</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Organization Details</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Organization Slug</th>
                                <!-- <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Primary Color</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Secondary Color</th> -->
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @if($userAuthRole == 'Super Admin')
                                @if($posts->count())
                                    @foreach($posts as $item)
                                        <tr>
                                            <!-- <td class="px-6 py-2">
                                                @if (!empty($item->organization_logo))
                                                    <img width="100px" src="{{ asset('/files/' . $item->organization_logo) }}"/>
                                                @else
                                                    No featured image available!
                                                @endif</td> -->
                                            <td class="px-6 py-2">{{ $item->organization_name }}</td>
                                            <td class="px-6 py-2">{{ $item->organization_details }}</td>
                                            <td class="px-6 py-2">
                                                <a href="{{ url($item->organization_slug) }}" class="text-indigo-600 hover:text-indigo-900" target="_blank">
                                                   {{ $item->organization_slug }}
                                                </a>
                                            </td>
                                            <td>

                                                <x-jet-button wire:click="viewShowModal({{ $item->id }})">
                                                    {{__('View')}}
                                                </x-jet-button>
                                                <x-jet-button wire:click="updateShowModal({{ $item->id }})">
                                                    {{__('Update')}}
                                                </x-jet-button>
                                                <x-jet-button wire:click="updateImageShowModal({{ $item->id }})">
                                                    {{__('Update Logo')}}
                                                </x-jet-button>
                                                <x-jet-danger-button wire:click="deleteShowModal({{ $item->id }})">
                                                    {{__('Delete')}}
                                                </x-jet-danger-button>
                                            </td>
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
                            @else
                                @if($userAffliatedOrganization->count())
                                    @foreach($userAffliatedOrganization as $item)
                                        <tr>
                                            <!-- <td class="px-6 py-2">
                                                @if (!empty($item->organization_logo))
                                                    <img width="100px" src="{{ asset('/files/' . $item->organization_logo) }}"/>
                                                @else
                                                    No featured image available!
                                                @endif</td> -->
                                            <td class="px-6 py-2">{{ $item->organization_name }}</td>
                                            <td class="px-6 py-2">{{ $item->organization_details }}</td>
                                            <td class="px-6 py-2">
                                                <a href="{{ url($item->organization_slug) }}" class="text-indigo-600 hover:text-indigo-900" target="_blank">
                                                   {{ $item->organization_slug }}
                                                </a>
                                            </td>
                                            <td>
                                                <x-jet-button wire:click="updateShowModal({{ $item->id }})">
                                                    {{__('Update')}}
                                                </x-jet-button>
                                                <x-jet-button wire:click="updateImageShowModal({{ $item->id }})">
                                                    {{__('Update Logo')}}
                                                </x-jet-button>
                                                @if($userAuthRole == 'Super Admin')
                                                    <x-jet-danger-button wire:click="deleteShowModal({{ $item->id }})">
                                                        {{__('Delete')}}
                                                    </x-jet-danger-button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{$posts->links()}}


<!-- MODALS -->
    <x-jet-dialog-modal wire:model="modalFormVisible">
            <x-slot name="title">
                {{ __('Organization') }}
            </x-slot>

            <x-slot name="content">
            <div class="mt-4">
                <x-jet-label for="Organization_logo" value="{{ __('organization logo') }}" />
                <x-jet-input wire:model="organization_logo" id="organization_logo" class="block mt-1 w-full" type="file" />
                @error('organization_logo') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="mt-4">
                <x-jet-label for="organization_name" value="{{ __('Organization name') }}" />
                <x-jet-input wire:model="organization_name" id="organization_name" class="block mt-1 w-full" type="text" />
                @error('organization_name') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="mt-4">
                <x-jet-label for="organization_details" value="{{ __('Organization details') }}" />
                <x-jet-input wire:model="organization_details" id="organization_details" class="block mt-1 w-full" type="text" />
                @error('organization_details') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="mt-4">
                <x-jet-label for="organization_slug" value="{{ __('organization slug') }}" />
                <div class="mt-1 flex rounded-md shadow-sm">
                    <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                        http://localhost:8000/
                    </span>
                    <input wire:model="organization_slug" class="form-input flex-1 block w-full rounded-none rounded-r-md transition duration-150 ease-in-out sm:text-sm sm:leading-5" placeholder="url-slug">
                </div>
                @error('organization_slug') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="mt-4">
                <x-jet-label for="organization_primary_color" value="{{ __('organization primary color') }}" />
                <x-jet-input wire:model="organization_primary_color" id="organization_primary_color" class="block mt-1 w-full" type="color" />
                @error('organization_primary_color') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="mt-4">
                <x-jet-label for="organization_secondary_color" value="{{ __('organization secondary color') }}" />
                <x-jet-input wire:model="organization_secondary_color" id="organization_secondary_color" class="block mt-1 w-full" type="color" />
                @error('organization_secondary_color') <span class="error">{{ $message }}</span> @enderror
            </div>
           <!--  <div class="mt-4">
                <x-jet-label for="sequence" value="{{ __('Type') }}" />
                <select wire:model="type" class="block appearance-none w-full bg-gray-100 border border-gray-200 text-gray-700 py-3 px-4 pr-8 round leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                    <option value="SidebarNav">SidebarNav</option>
                    <option value="TopNav">TopNav</option>
                </select>
            </div> -->
        </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('modalFormVisible')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-jet-secondary-button>

                    <!-- <x-jet-secondary-button class="ml-2" wire:click="update" wire:loading.attr="disabled">
                        {{ __('Update Page') }}
                    </x-jet-secondary-button>       -->              
                    <x-jet-secondary-button class="ml-2" wire:click="create" wire:loading.attr="disabled">
                        {{ __('Create Organization') }}
                    </x-jet-secondary-button>

            </x-slot>
        </x-jet-dialog-modal>

<!--VIEW MODALS -->
    <x-jet-dialog-modal wire:model="viewmodalFormVisible">
            <x-slot name="title">
                {{ __('Organization Details') }}
            </x-slot>

            <x-slot name="content">
            <div class="mt-4">
                <x-jet-label for="Organization_logo" value="{{ __('organization logo') }}" />
                @if (!empty($this->organization_logo))
                    <img width="100px" src="{{ asset('/files/' . $this->organization_logo) }}"/>
                @else
                    No featured image available!
                @endif
                @error('organization_logo') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="mt-4">
                <x-jet-label for="organization_name" value="{{ __('Organization name') }}" />
                <x-jet-input wire:model="organization_name" id="organization_name" class="block mt-1 w-full" type="text" readonly />
                @error('organization_name') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="mt-4">
                <x-jet-label for="organization_details" value="{{ __('Organization details') }}" />
                <x-jet-input wire:model="organization_details" id="organization_details" class="block mt-1 w-full" type="text" readonly />
                @error('organization_details') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="mt-4">
                <x-jet-label for="organization_slug" value="{{ __('organization slug') }}" />
                <div class="mt-1 flex rounded-md shadow-sm">
                    <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                        http://localhost:8000/
                    </span>
                    <input wire:model="organization_slug" class="form-input flex-1 block w-full rounded-none rounded-r-md transition duration-150 ease-in-out sm:text-sm sm:leading-5" placeholder="url-slug" readonly>
                </div>
                @error('organization_slug') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="mt-4">
                <x-jet-label for="organization_primary_color" value="{{ __('organization primary color') }}" />
                <x-jet-input wire:model="organization_primary_color" id="organization_primary_color" class="block mt-1 w-full" type="color" disabled />
                @error('organization_primary_color') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="mt-4">
                <x-jet-label for="organization_secondary_color" value="{{ __('organization secondary color') }}" />
                <x-jet-input wire:model="organization_secondary_color" id="organization_secondary_color" class="block mt-1 w-full" type="color" disabled />
                @error('organization_secondary_color') <span class="error">{{ $message }}</span> @enderror
            </div>
           <!--  <div class="mt-4">
                <x-jet-label for="sequence" value="{{ __('Type') }}" />
                <select wire:model="type" class="block appearance-none w-full bg-gray-100 border border-gray-200 text-gray-700 py-3 px-4 pr-8 round leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                    <option value="SidebarNav">SidebarNav</option>
                    <option value="TopNav">TopNav</option>
                </select>
            </div> -->
        </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('viewmodalFormVisible')" wire:loading.attr="disabled">
                    {{ __('Back') }}
                </x-jet-secondary-button>

            </x-slot>
        </x-jet-dialog-modal>

<!--UPDATE MODAL -->
    <x-jet-dialog-modal wire:model="updatemodalFormVisible">
            <x-slot name="title">
                {{ __('Update Organization') }}
            </x-slot>

            <x-slot name="content">
            <!-- <div class="mt-4">
                <x-jet-label for="Organization_logo" value="{{ __('organization logo') }}" />
                <x-jet-input wire:model="organization_logo" id="organization_logo" class="block mt-1 w-full" type="file" />
                @error('organization_logo') <span class="error">{{ $message }}</span> @enderror
            </div> -->
            <div class="mt-4">
                <x-jet-label for="organization_name" value="{{ __('Organization name') }}" />
                <x-jet-input wire:model="organization_name" id="organization_name" class="block mt-1 w-full" type="text" />
                @error('organization_name') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="mt-4">
                <x-jet-label for="organization_details" value="{{ __('Organization details') }}" />
                <x-jet-input wire:model="organization_details" id="organization_details" class="block mt-1 w-full" type="text" />
                @error('organization_details') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="mt-4">
                <x-jet-label for="organization_slug" value="{{ __('Organization slug') }}" />
                <div class="mt-1 flex rounded-md shadow-sm">
                    <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                        http://localhost:8000/
                    </span>
                    <input wire:model="organization_slug" class="form-input flex-1 block w-full rounded-none rounded-r-md transition duration-150 ease-in-out sm:text-sm sm:leading-5" placeholder="url-slug">
                </div>
                @error('organization_slug') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="mt-4">
                <x-jet-label for="organization_primary_color" value="{{ __('organization primary color') }}" />
                <x-jet-input wire:model="organization_primary_color" id="organization_primary_color" class="block mt-1 w-full" type="color" />
                @error('organization_primary_color') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="mt-4">
                <x-jet-label for="organization_secondary_color" value="{{ __('organization secondary color') }}" />
                <x-jet-input wire:model="organization_secondary_color" id="organization_secondary_color" class="block mt-1 w-full" type="color" />
                @error('organization_secondary_color') <span class="error">{{ $message }}</span> @enderror
            </div>
           <!--  <div class="mt-4">
                <x-jet-label for="sequence" value="{{ __('Type') }}" />
                <select wire:model="type" class="block appearance-none w-full bg-gray-100 border border-gray-200 text-gray-700 py-3 px-4 pr-8 round leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                    <option value="SidebarNav">SidebarNav</option>
                    <option value="TopNav">TopNav</option>
                </select>
            </div> -->
        </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('updatemodalFormVisible')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-jet-secondary-button>

                    <x-jet-secondary-button class="ml-2" wire:click="update" wire:loading.attr="disabled">
                        {{ __('Update Details') }}
                    </x-jet-secondary-button>                    
                    <!-- <x-jet-secondary-button class="ml-2" wire:click="create" wire:loading.attr="disabled">
                        {{ __('Create Organization') }}
                    </x-jet-secondary-button> -->

            </x-slot>
        </x-jet-dialog-modal>

<!--UPDATE IMAGE MODAL -->
    <x-jet-dialog-modal wire:model="updateImagemodalFormVisible">
            <x-slot name="title">
                {{ __('Update Organization Image') }}
            </x-slot>

            <x-slot name="content">
            <div class="mt-4">
                <x-jet-label for="Organization_logo" value="{{ __('organization logo') }}" />
                <x-jet-input wire:model="organization_logo" id="organization_logo" class="block mt-1 w-full" type="file" />
                @error('organization_logo') <span class="error">{{ $message }}</span> @enderror
            </div>
            
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('updateImagemodalFormVisible')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-jet-secondary-button>

                    <x-jet-secondary-button class="ml-2" wire:click="Imageupdate" wire:loading.attr="disabled">
                        {{ __('Update Logo') }}
                    </x-jet-secondary-button>                    

            </x-slot>
        </x-jet-dialog-modal>

<!-- DELETE MODAL -->
        <x-jet-dialog-modal wire:model="modelConfirmDeleteVisible">
            <x-slot name="title">
                {{ __('Delete Organization') }}
            </x-slot>

            <x-slot name="content">
                {{ __('Are you sure you want to delete your page? Once your page is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your page.') }}
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('modelConfirmDeleteVisible')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-jet-secondary-button>

                <x-jet-danger-button class="ml-2" wire:click="delete" wire:loading.attr="disabled">
                    {{ __('Delete Organization') }}
                </x-jet-danger-button>
            </x-slot>
        </x-jet-dialog-modal>


</div>
