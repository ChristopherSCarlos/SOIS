<div class="p-6">
    <div class="flex items-center justify-end px-4 py-3 text-right sm:px-6">
        <x-jet-button wire:click="createNews">
            {{ __('Create News') }}
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
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Article Title</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Article Sub-Title</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Article Content</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Start Date</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">End Date</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @if($articleDataController == 'Super Admin')
                                @if($articleDatas->count())
                                    @foreach($articleDatas as $item)
                                         <tr>
                                            <td class="px-6 py-4 text-sm whitespace-no-wrap">
                                                {{ $item->id }}
                                            </td>
                                            <td class="px-6 py-4 text-sm whitespace-no-wrap">
                                                {{ $item->article_title }}
                                            </td>
                                            <td class="px-6 py-4 text-sm whitespace-no-wrap">
                                                {{ $item->article_subtitle }}
                                            </td>
                                            <td class="px-6 py-4 text-sm whitespace-no-wrap">
                                                {{ $item->article_content }}
                                            </td>
                                            <td class="px-6 py-4 text-sm whitespace-no-wrap">
                                                {{ $item->created_at }}
                                            </td>
                                            <td class="px-6 py-4 text-sm whitespace-no-wrap">
                                                {{ $item->updated_at }}
                                            </td>
                                            <td class="px-6 py-4 text-sm whitespace-no-wrap">
                                                <x-jet-button wire:click="updateNewsShowModal({{ $item->id }})">
                                                    {{__('Update')}}
                                                </x-jet-button>
                                                <x-jet-danger-button wire:click="deleteNewsShowModal({{ $item->id }})">
                                                    {{__('Delete')}}
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
                            @else
                                @if($articleOrganization->count())
                                    @foreach($articleOrganization as $item)
                                         <tr>
                                            <td class="px-6 py-4 text-sm whitespace-no-wrap">
                                                {{ $item->id }}
                                            </td>
                                            <td class="px-6 py-4 text-sm whitespace-no-wrap">
                                                {{ $item->article_title }}
                                            </td>
                                            <td class="px-6 py-4 text-sm whitespace-no-wrap">
                                                {{ $item->article_subtitle }}
                                            </td>
                                            <td class="px-6 py-4 text-sm whitespace-no-wrap">
                                                {{ $item->article_content }}
                                            </td>
                                            <td class="px-6 py-4 text-sm whitespace-no-wrap">
                                                {{ $item->created_at }}
                                            </td>
                                            <td class="px-6 py-4 text-sm whitespace-no-wrap">
                                                {{ $item->updated_at }}
                                            </td>
                                            <td class="px-6 py-4 text-sm whitespace-no-wrap">
                                                <x-jet-button wire:click="updateNewsShowModal({{ $item->id }})">
                                                    {{__('Update')}}
                                                </x-jet-button>
                                                <x-jet-danger-button wire:click="deleteNewsShowModal({{ $item->id }})">
                                                    {{__('Delete')}}
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
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{ $articleDatas->links() }}

<!-- MODALS -->
    <!-- CREATE NEWS MODALS -->
        <x-jet-dialog-modal wire:model="modalCreateNewsFormVisible">
            <x-slot name="title">
                {{ __('News') }}
            </x-slot>
            <x-slot name="content">
                <div class="mt-4">
                    <x-jet-label for="article_title" value="{{ __('Article Title') }}" />
                    <x-jet-input wire:model="article_title" id="article_title" class="block mt-1 w-full" type="text" />
                    @error('article_title') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="mt-4">
                    <x-jet-label for="article_header" value="{{ __('Article Header') }}" />
                    <x-jet-input wire:model="article_header" id="article_header" class="block mt-1 w-full" type="file" />
                    @error('article_header') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="mt-4">
                    <x-jet-label for="article_subtitle" value="{{ __('Article Sub-Title') }}" />
                    <x-jet-input wire:model="article_subtitle" id="article_subtitle" class="block mt-1 w-full" type="text" />
                    @error('article_subtitle') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="mt-4">
                    <x-jet-label for="article_content" value="{{ __('Article Content') }}" />
                    <textarea wire:model="article_content" id="article_content" class="block mt-1 w-full"></textarea>
                    @error('article_content') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="mt-4">
                    <x-jet-label for="type" value="{{ __('Type') }}" />
                    <select wire:model="type" class="block appearance-none w-full bg-gray-100 border border-gray-200 text-gray-700 py-3 px-4 pr-8 round leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                        <option value="Featured">Featured</option>
                        <option value="NotFeatured">NotFeatured</option>
                    </select>
                </div>
                <p>Affliated Organizations</p>
                @foreach($organizationData as $orgData)
                    <div class="mt-1">
                            <label class="inline-flex items-center">
                                <input type="checkbox" value="{{ $orgData->id }}" name="{{$orgData->id}}" wire:model="selectedOrganizations"  class="form-checkbox h-6 w-6 text-green-500">
                                <span class="ml-3 text-sm">{{ $orgData->organization_name }}</span>
                            </label>
                    </div>
                @endforeach

            </x-slot>
            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('modalCreateNewsFormVisible')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-jet-secondary-button>
                <x-jet-secondary-button class="ml-2" wire:click="create" wire:loading.attr="disabled">
                    {{ __('Create News') }}
                </x-jet-secondary-button>
            </x-slot>
        </x-jet-dialog-modal>

    <!-- UPDATA NEWS MODALS -->
        <x-jet-dialog-modal wire:model="modalUpdateNewsFormVisible">
            <x-slot name="title">
                {{ __('News') }}
            </x-slot>
            <x-slot name="content">
                <div class="mt-4">
                    <x-jet-label for="article_title" value="{{ __('Article Title') }}" />
                    <x-jet-input wire:model="article_title" id="article_title" class="block mt-1 w-full" type="text" />
                    @error('article_title') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="mt-4">
                    <x-jet-label for="article_subtitle" value="{{ __('Article Sub-Title') }}" />
                    <x-jet-input wire:model="article_subtitle" id="article_subtitle" class="block mt-1 w-full" type="text" />
                    @error('article_subtitle') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="mt-4">
                    <x-jet-label for="article_content" value="{{ __('Article Content') }}" />
                    <textarea wire:model="article_content" id="article_content" class="block mt-1 w-full"></textarea>
                    @error('article_content') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="mt-4">
                    <x-jet-label for="type" value="{{ __('Type') }}" />
                    <select wire:model="type" class="block appearance-none w-full bg-gray-100 border border-gray-200 text-gray-700 py-3 px-4 pr-8 round leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                        <option value="Featured">Featured</option>
                        <option value="NotFeatured">NotFeatured</option>
                    </select>
                </div>
                <p>Affliated Organizations</p>
                @foreach($organizationData as $orgData)
                    <div class="mt-1">
                            <label class="inline-flex items-center">
                                <input type="checkbox" value="{{ $orgData->id }}" name="{{$orgData->id}}" wire:model="selectedOrganizations"  class="form-checkbox h-6 w-6 text-green-500">
                                <span class="ml-3 text-sm">{{ $orgData->organization_name }}</span>
                            </label>
                    </div>
                @endforeach

            </x-slot>
            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('modalUpdateNewsFormVisible')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-jet-secondary-button>
                <x-jet-secondary-button class="ml-2" wire:click="update" wire:loading.attr="disabled">
                    {{ __('Update News') }}
                </x-jet-secondary-button>
            </x-slot>
        </x-jet-dialog-modal>

    <!-- DELETE NEWS MODALS -->
        <x-jet-dialog-modal wire:model="modalDeleteNewsFormVisible">
            <x-slot name="title">
                {{ __('News') }}
            </x-slot>
            <x-slot name="content">
                <div class="mt-4">
                    <x-jet-label for="article_title" value="{{ __('Are you sure you want to delete your news? Once your news is deleted, all of its resources and data will be permanently deleted. Do you wish to proceed?') }}" />
                </div>
            </x-slot>
            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('modalDeleteNewsFormVisible')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-jet-secondary-button>
                <x-jet-secondary-button class="ml-2" wire:click="delete" wire:loading.attr="disabled">
                    {{ __('Delete News') }}
                </x-jet-secondary-button>
            </x-slot>
        </x-jet-dialog-modal>
<!-- ENDING DIV -->
</div>
