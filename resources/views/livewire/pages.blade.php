<div class="p-6">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <style>
        .modal-backdrop {
          z-index: -1;
        }
    </style>


    <div class="flex items-center justify-end px-4 py-3 text-right sm:px-6">
        <x-jet-button wire:click="createShowModel">
            {{ __('Create') }}
        </x-jet-button>
    </div>

    <div class="flex flex-col items-center">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">

                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Title</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Link</th>
                                <!-- <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Content</th> -->
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @if($data->count())
                                @foreach($data as $item)
                                    <tr>
                                        <td class="px-6 py-4 text-sm whitespace-no-wrap">
                                            {{ $item->title }}
                                            {{!! $item->is_default_home ? '<span class="text-green-400 text-xs font-bold">[Default Home Page]</span>':'' !!}}
                                            {{!! $item->is_default_not_found ? '<span class="text-red-600 text-xs font-bold">[Default 404 Page]</span>':'' !!}}
                                       </td>
                                        <td class="px-6 py-4 text-sm whitespace-no-wrap">
                                            <a class="text-indigo-600 hover:text-indigo-900" targets="_blank"href="{{ URL::to('/'.$item->slug) }}">
                                                {{ $item->slug }}
                                            </a>
                                        </td>
                                       <!--  <td class="px-6 py-4 text-sm whitespace-no-wrap">
                                            {!! \Illuminate\Support\Str::limit($item->content, 50, '...') !!}
                                            {!! $item->content !!}
                                        </td> -->
                                        <td class="px-6 py-4 text-sm text-right">
                                            <x-jet-button wire:click="updateShowModal({{ $item->id }})">
                                                {{__('Update')}}
                                            </x-jet-button>

                                            <x-jet-danger-button wire:click="deleteShowModal({{ $item->id }})">
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
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{ $data->links() }}



<!-- MODALS -->
    <x-jet-dialog-modal wire:model="modalFormVisible">
            <x-slot name="title">
                {{ __('Save Page') }} {{$modelId}}
            </x-slot>

            <x-slot name="content">
                <div class="mt-4">
                    <x-jet-label for="title" value="{{ __('Title') }}" />
                    <x-jet-input id="title" style="color:red" class="block mt-1 w-full" type="text" wire:model.debounce.800ms="title" required autofocus />

                    @error('title')
                        <span class="error">{{ $message }}</span>
                    @enderror

                </div>
                <div class="mt-4">
                    <x-jet-label for="slug" value="{{ __('Slug') }}" />
                    <div class="mt-1 flex rounded-md shadow-sm">
                        <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                            http://localhost:8000/
                        </span>
                        <input wire:model="slug" class="form-input flex-1 block w-full rounded-none rounded-r-md transition duration-150 ease-in-out sm:text-sm sm:leading-5" placeholder="url-slug">
                    </div>
                </div>

                    @error('slug')
                        <span class="error">{{ $message }}</span>
                    @enderror

                 <div class="mt-4">
                    <label>
                        <input class="form-checkbox" type="checkbox" value="{{ $isSetToDefaultHomePage }}" wire:model="isSetToDefaultHomePage"/>
                        <span class="ml-2 text-sm text-gray-600">Set as the default home page</span>
                    </label>
                </div>
                <div class="mt-4">
                    <label>
                        <input class="form-checkbox" type="checkbox" value="{{ $isSetToDefaultNotFoundPage }}" wire:model="isSetToDefaultNotFoundPage"/>
                        <span class="ml-2 text-sm text-red-600">Set as the default 404 error page</span>
                    </label>
                </div>

                <div class="mt-4">
                    <x-jet-label for="content" value="{{ __('Content') }}" />
                    <div class="rounded-md shadow-sm">
                        <div class="mt-1 bg-white">
                            <div class="body-content" wire:ignore>
                                <textarea type="text" input="content" id="summernote" class="form-control summernote"></textarea>
                            </div>
                        </div>
                    </div>

                    @error('content')
                        <span class="error">{{ $message }}</span>
                    @enderror

                </div>
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('modalFormVisible')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-jet-secondary-button>
                    <x-jet-secondary-button class="ml-2" wire:click="create" wire:loading.attr="disabled">
                        {{ __('Create Page') }}
                    </x-jet-secondary-button>

            </x-slot>
        </x-jet-dialog-modal>

<!--UPDATE MODALS -->
    <x-jet-dialog-modal wire:model="updatemodalFormVisible">
            <x-slot name="title">
                {{ __('Update Page') }} {{$modelId}}
            </x-slot>

            <x-slot name="content">
                <div class="mt-4">
                    <x-jet-label for="title" value="{{ __('Title') }}" />
                    <x-jet-input id="title" style="color:red" class="block mt-1 w-full" type="text" wire:model.debounce.800ms="title" required autofocus />

                    @error('title')
                        <span class="error">{{ $message }}</span>
                    @enderror

                </div>
                <div class="mt-4">
                    <x-jet-label for="slug" value="{{ __('Slug') }}" />
                    <div class="mt-1 flex rounded-md shadow-sm">
                        <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                            http://localhost:8000/
                        </span>
                        <input wire:model="slug" class="form-input flex-1 block w-full rounded-none rounded-r-md transition duration-150 ease-in-out sm:text-sm sm:leading-5" placeholder="url-slug">
                    </div>
                </div>

                    @error('slug')
                        <span class="error">{{ $message }}</span>
                    @enderror

                 <div class="mt-4">
                    <label>
                        <input class="form-checkbox" type="checkbox" value="{{ $isSetToDefaultHomePage }}" wire:model="isSetToDefaultHomePage"/>
                        <span class="ml-2 text-sm text-gray-600">Set as the default home page</span>
                    </label>
                </div>
                <div class="mt-4">
                    <label>
                        <input class="form-checkbox" type="checkbox" value="{{ $isSetToDefaultNotFoundPage }}" wire:model="isSetToDefaultNotFoundPage"/>
                        <span class="ml-2 text-sm text-red-600">Set as the default 404 error page</span>
                    </label>
                </div>

                <div class="mt-4">
                    <x-jet-label for="content" value="{{ __('Content') }}" />
                    <div class="rounded-md shadow-sm">
                        <div class="mt-1 bg-white">
                            <div class="body-content" wire:ignore>
                                <textarea type="text" input="content" id="summernote" class="form-control summernote"></textarea>
                                <!-- <input id="summernote" class="form-control summernote"/> -->
                                <!-- <textarea type="text" input="content" id="summernote" class="form-control summernote">{!! $content !!}</textarea> -->
                                <!-- <input type="text" name="content" id="summernote"  class="form-control"></input> -->
                            </div>
                        </div>
                    </div>

                    @error('content')
                        <span class="error">{{ $message }}</span>
                    @enderror

                </div>
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('updatemodalFormVisible')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-jet-secondary-button>

                    <x-jet-secondary-button class="ml-2" wire:click="update" wire:loading.attr="disabled">
                        {{ __('Update Page') }}
                    </x-jet-secondary-button>                    

            </x-slot>
        </x-jet-dialog-modal>

        <!-- DELETE MODAL -->
        <x-jet-dialog-modal wire:model="modelConfirmDeleteVisible">
            <x-slot name="title">
                {{ __('Delete Page') }}
            </x-slot>

            <x-slot name="content">
                {{ __('Are you sure you want to delete your page? Once your page is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your page.') }}
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('modelConfirmDeleteVisible')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-jet-secondary-button>

                <x-jet-danger-button class="ml-2" wire:click="delete" wire:loading.attr="disabled">
                    {{ __('Delete Account') }}
                </x-jet-danger-button>
            </x-slot>
        </x-jet-dialog-modal>

<script>

    $(document).ready(function() {
        $('.summernote').summernote(
        // 'pasteHTML',$content
        {
        focus: true,
        tabsize: 2,
        height: 200,
        toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'underline', 'clear']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
          ['insert', ['link', 'picture', 'video']],
          ['view', ['fullscreen', 'codeview', 'help']]
        ],
        callbacks: {
          onChange: function(contents, $editable) {
          @this.set('content', contents);
        }
        }
        });
    });


    // var HTMLstring = $this->content;
    // $('.summernote').summernote('pasteHTML', HTMLstring);

    // $('.summernote').summernote(
    // // 'pasteHTML',$content
    // {
    // tabsize: 2,
    // height: 200,
    // toolbar: [
    //   ['style', ['style']],
    //   ['font', ['bold', 'underline', 'clear']],
    //   ['color', ['color']],
    //   ['para', ['ul', 'ol', 'paragraph']],
    //   ['table', ['table']],
    //   ['insert', ['link', 'picture', 'video']],
    //   ['view', ['fullscreen', 'codeview', 'help']]
    // ],
    // callbacks: {
    //   onChange: function(contents, $editable) {
    //   @this.set('content', contents);
    // }
    // }
    // });

// var edit = function() {
//   $('.click2edit').html({focus: true});
// };

// var save = function() {
//   var markup = $('.click2edit').summernote('code');
//   $('.click2edit').summernote('destroy');
// };
</script>

</div>