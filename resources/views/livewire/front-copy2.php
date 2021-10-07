<div class="divide-y divide-gray-800" x-data="{ show: false }">
    <nav id="orgNav" class="flex items-center px-3 py-2 shadow-lg position:sticky">
                <div>
                    <button @click="show =! show" class="block h-8 mr-3 text-gray-400 items-center hover:text-gray-200 focus:text-gray-200 focus:outline-none sm:hidden">
                    <svg class="w-8 fill-current" viewBox="0 0 24 24">                            
                            <path x-show="!show" fill-rule="evenodd" d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z"/>
                            <path x-show="show" fill-rule="evenodd" d="M18.278 16.864a1 1 0 0 1-1.414 1.414l-4.829-4.828-4.828 4.828a1 1 0 0 1-1.414-1.414l4.828-4.829-4.828-4.828a1 1 0 0 1 1.414-1.414l4.829 4.828 4.828-4.828a1 1 0 1 1 1.414 1.414l-4.828 4.829 4.828 4.828z"/>
                        </svg>
                    </button>
                </div>
                <div class="h-12 w-full flex items-center">
                    <a href="{{ url('/')}}" class="w-full">
                        <img class="h-8" src="{{ asset('image/svg/pup.svg') }}">
                    </a>
                </div>
                <div class="flex justify-end sm:w-8/12">
                    {{-- Top Navigation --}}
                    <ul class="hidden sm:flex sm:text-left text-gray-200 text-xs">
                            @foreach($sidebarLinks as $item)
                                <a href="{{ url('/'.$item->slug) }}" class="bg-white inline-block border-l border-t border-r rounded-t py-2 px-4 text-blue-700 font-semibold mr-5">
                                    {{ $item->label }}
                                </a>
                            @endforeach
                            <a href="{{ url('/login') }}" class="bg-white inline-block border-l border-t border-r rounded-t py-2 px-4 text-blue-700 font-semibold">
                                Login
                            </a>
                    </ul>
                </div>
            </nav>
            
    @foreach($pageTableDataTitle as $PageData)
        @if($urlslug == $PageData->slug or $urlslug == $isFrontPageSlugNull)
            <aside class="sm:hidden bg-gray-900 text-gray-700 divide-y divide-gray-700 divide-dashed sm:w-4/12 md:w-3/12 lg:w-2/12">
                {{-- Desktop Web View --}}
                <ul class="hidden text-gray-200 text-xs sm:block sm:text-left">
                    @foreach($sidebarLinks as $item)
                        <a href="{{ url('/'.$item->slug) }}">
                            {{ $item->label }}
                        </a>
                    @endforeach
                </ul>
                {{-- Mobile Web View --}}
                <div :class="show ? 'block' : 'hidden'" class="pb-3 divide-y divide-gray-800 block sm:hidden">
                    <ul class="text-gray-200 text-xs">
                        @foreach($sidebarLinks as $item)
                            <a href="{{ url('/'.$item->slug) }}" class="cursor-pointer px-4 py-2 hover:bg-gray-800">
                                <li class="cursor-pointer px-4 py-2 hover:bg-gray-800">
                                    {{ $item->label }}
                                </li>
                            </a>
                        @endforeach
                    </ul>
                    {{-- Top Navigation Mobile Web View --}}
                    <ul class="text-gray-200 text-xs">
                        <a href="{{ url('/login') }}">
                            <li class="cursor-pointer px-4 py-2 hover:bg-gray-800">Login</li>
                        </a>
                    </ul>
                </div>
            </aside>
            <main id="frontpagebg" class="bg-gray-100 p-12 min-h-screen sm:w-12/12 md:w-12/12 lg:w-12/12 bg-cover bg-center" style="background: {{$PageData->primary_color}};">
                <div id="FrontPageFlex" class="flex align-center justify-center items-center {{$test}}">
                    <div id="c1" class="FrontPageLogoContainer">
                       <img id="FrontPageLogo" src="{{ asset('image/svg/pup.svg') }}">
                    </div>
                    <div id="c2">
                        <p id="title" class="text-white">{{ $title }}</p>
                        @if($title == $frontPageTitle)
                            <x-jet-button class="linkButton" wire:click="ShowSystemModel">
                               {{ __('Visit Us') }}
                            </x-jet-button>
                            <x-jet-button class="linkButton" wire:click="ShowOrgWebModel">
                               {{ __('Visit your Organization Website') }}
                            </x-jet-button>
                        @endif
                    </div>
                </div>

                <hr>
                <section class="logo-slider slider flex items-center">
                    @foreach($orgLinks as $orgItem)
                        <div>
                            <a href="{{ url($orgItem->organization_slug) }}">
                                <img class="item" src="{{ asset('/files/' . $orgItem->organization_logo) }}">
                            </a>
                        </div>
                    @endforeach
                </section>


                <!-- MODALS -->
                <x-jet-dialog-modal wire:model="modalShowSystemModel">
                    <x-slot name="title">
                        {{ __('Visit SOIS Website') }}
                    </x-slot>
                    <x-slot name="content">
                        @foreach($topnavLinks as $items)
                            <a href="{{ url($items->slug) }}" class="bg-white inline-block border-l border-t border-r rounded-t py-2 px-4 text-blue-700 font-semibold mr-5">
                                {{ $items->label }}
                            </a>
                        @endforeach
                    </x-slot>
                    <x-slot name="footer">
                    </x-slot>
                </x-jet-dialog-modal>
                <x-jet-dialog-modal wire:model="modalShowNewOrgModel">
                    <x-slot name="title">
                        {{ __('Visit Your Organization WebPage') }}
                    </x-slot>
                    <x-slot name="content">
                        <div id="orgLinks">
                            @foreach($orgLinks as $orgWebLinks)
                                    <a id="link" href="{{ url($orgWebLinks->organization_slug) }}">
                                <div id="linkContainer">
                                        {{ $orgWebLinks->organization_name }}
                                </div>
                                    </a>
                            @endforeach
                        </div>
                    </x-slot>
                    <x-slot name="footer">
                    </x-slot>
                </x-jet-dialog-modal>
            </main>
        @endif
    @endforeach


<!-- organization  -->
    @foreach($pageOrgData as $OrgData)
        @if($urlslug == $OrgData->organization_slug)
            
            <aside class="sm:hidden bg-gray-900 text-gray-700 divide-y divide-gray-700 divide-dashed sm:w-4/12 md:w-3/12 lg:w-2/12">
                {{-- Desktop Web View --}}
                <ul class="hidden text-gray-200 text-xs sm:block sm:text-left">
                    @foreach($sidebarLinks as $item)
                        <a href="{{ url('/'.$item->slug) }}">
                            {{ $item->label }}
                        </a>
                    @endforeach
                </ul>
                {{-- Mobile Web View --}}
                <div :class="show ? 'block' : 'hidden'" class="pb-3 divide-y divide-gray-800 block sm:hidden">
                    <ul class="text-gray-200 text-xs">
                        @foreach($sidebarLinks as $item)
                            <a href="{{ url('/'.$item->slug) }}" class="cursor-pointer px-4 py-2 hover:bg-gray-800">
                                <li class="cursor-pointer px-4 py-2 hover:bg-gray-800">
                                    {{ $item->label }}
                                </li>
                            </a>
                        @endforeach
                    </ul>
                    {{-- Top Navigation Mobile Web View --}}
                    <ul class="text-gray-200 text-xs">
                        <a href="{{ url('/login') }}">
                            <li class="cursor-pointer px-4 py-2 hover:bg-gray-800">Login</li>
                        </a>
                    </ul>
                </div>
            </aside>

            
            <div id="carouselOrgs" class="carousel slider flex items-center mb-0 flex-wrap">
                <div id="carousel-orgs-inner">
                    <img id="carousel-background" src="{{ asset('/image/carousel2.jpg') }}">
                    <div id="carousel-items-container" class="carousel-center">
                        <img id="carousel-image-logo" class="object-center" src="{{ asset('/files/' . $OrgData->organization_logo) }}">
                        <p class="text-center" id="carousel-center-title">{{ $OrgData->organization_name }}</p>
                    </div>
                </div>
                <div>
                    <img id="carousel-background" src="{{ asset('/image/carousel2.jpg') }}">
                    <div id="carousel-items-container" class="carousel-center">
                        <img id="carousel-image-logo" class="object-center" src="{{ asset('/files/' . $OrgData->organization_logo) }}">
                        <p class="text-center" id="carousel-center-title">{{ $OrgData->organization_name }}</p>
                    </div>
                </div>
                <div>
                    <img id="carousel-background" src="{{ asset('/image/carousel3.jpg') }}">
                    <div id="carousel-items-container" class="carousel-center">
                        <img id="carousel-image-logo" class="object-center" src="{{ asset('/files/' . $OrgData->organization_logo) }}">
                        <p class="text-center" id="carousel-center-title">{{ $OrgData->organization_name }}</p>
                    </div>
                </div>
            </div>


            <p class="text-center bg-transparent mt-0" style="
                background: {{ $OrgData->organization_primary_color }};
                color: {{ $OrgData->organization_secondary_color  }};
            ">{{ $OrgData->organization_name }}'s News</p>





<x-jet-button wire:click="getArticleOrganization">
            {{ __('Create News') }}
        </x-jet-button>




        @endif
    @endforeach
</div>
