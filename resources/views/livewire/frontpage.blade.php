<link rel="stylesheet" href="{{asset('css/mycss.css')}}">
<div class="divide-y divide-gray-800" x-data="{ show: false }">
    @foreach($pageTableDataTitle as $PageData)
        @if($urlslug == $PageData->slug or $urlslug == $isFrontPageSlugNull)
<div class="bg-img">
  <div class="front-container">
    <nav id="orgNav" class="flex items-center px-3 py-2 shadow-lg bg-red-800">
                <div>
                    <button @click="show =! show" class="block h-8 mr-3 text-gray-400 items-center hover:text-gray-200 focus:text-gray-200 focus:outline-none sm:hidden">
                        <svg class="w-8 fill-current" viewBox="0 0 24 24">                            
                            <path x-show="!show" fill-rule="evenodd" d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z"/>
                            <path x-show="show" fill-rule="evenodd" d="M18.278 16.864a1 1 0 0 1-1.414 1.414l-4.829-4.828-4.828 4.828a1 1 0 0 1-1.414-1.414l4.828-4.829-4.828-4.828a1 1 0 0 1 1.414-1.414l4.829 4.828 4.828-4.828a1 1 0 1 1 1.414 1.414l-4.828 4.829 4.828 4.828z"/>
                        </svg>
                    </button>
                </div>
                <div class="h-12 w-full flex items-center mr-3">
                    <a href="{{ url('/')}}" class="w-full">
                        <img class="h-8" src="{{ asset('image/svg/pup.svg') }}">
                    </a>
                </div>
                <div class="flex justify-end sm:w-8/12">
                    {{-- Top Navigation --}}
                    <ul class="hidden sm:flex sm:text-left text-gray-200 text-xs">
                            @foreach($sidebarLinks as $item)
                                <a href="{{ url('/'.$item->slug) }}" class="frontpage-nav-bar-design inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-opacity-0 hover:bg-yellow-50 hover:text-yellow-700 focus:outline-none focus:bg-yellow-50 focus:text-white transition text-white">
                                    {{ $item->label }}
                                </a>
                            @endforeach


                    <div class="ml-3 relative">
                        <x-jet-dropdown align="right" width="60">
                            <x-slot name="trigger">
                                <span class="inline-flex rounded-md">
                                    <button type="button" class="frontpage-nav-bar-design inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-opacity-0 hover:bg-yellow-50 hover:text-yellow-700 focus:outline-none focus:bg-yellow-50 focus:text-white transition text-white">
                                        Organization
                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </span>
                            </x-slot>
                            <x-slot name="content">
                                <div class="w-60">
                                    <!-- Team Management -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('PUP ORGANIZATIONS') }}
                                    </div>
                                    <!-- Team Settings -->
                                    @foreach($orgLinks as $orgWebLinks)
                                        <x-jet-dropdown-link href="{{ url($orgWebLinks->organization_slug) }}" class="frontpage-nav-bar-design">
                                            {{ $orgWebLinks->organization_name }}
                                        </x-jet-dropdown-link>
                                    @endforeach
                                    <div class="border-t border-gray-100"></div>

                                </div>
                            </x-slot>
                        </x-jet-dropdown>
                    </div>
                    <a href="{{ url('/login') }}" class="frontpage-nav-bar-design inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-opacity-0 hover:bg-yellow-50 hover:text-yellow-700 focus:outline-none focus:bg-yellow-50 focus:text-red-900 transition text-yellow-100">
                      Login
                    </a>
                    </ul>
                </div>
            </nav>

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
                    <ul>
                        <div class="ml-3 relative">
                        <x-jet-dropdown align="right" width="60">
                            <x-slot name="trigger">
                                <span class="inline-flex rounded-md">
                                    <button type="button" class="frontpage-nav-bar-design inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-opacity-0 hover:bg-yellow-50 hover:text-yellow-700 focus:outline-none focus:bg-yellow-50 focus:text-white transition text-white">
                                        Organization
                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </span>
                            </x-slot>
                            <x-slot name="content">
                                <div class="w-60">
                                    <!-- Team Management -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('PUP ORGANIZATIONS') }}
                                    </div>
                                    <!-- Team Settings -->
                                    @foreach($orgLinks as $orgWebLinks)
                                        <x-jet-dropdown-link href="{{ url($orgWebLinks->organization_slug) }}" class="frontpage-nav-bar-design">
                                            {{ $orgWebLinks->organization_name }}
                                        </x-jet-dropdown-link>
                                    @endforeach
                                    <div class="border-t border-gray-100"></div>

                                </div>
                            </x-slot>
                        </x-jet-dropdown>
                    </div>
                    </ul>
                    {{-- Top Navigation Mobile Web View --}}
                    <ul class="text-gray-200 text-xs">
                        <a href="{{ url('/login') }}">
                            <li class="cursor-pointer px-4 py-2 hover:bg-gray-800">Login</li>
                        </a>
                    </ul>
                </div>
            </aside>

            <div class="frontpage-title-container">
                <div class="frontpage-title-logo-container">
                   <img class="frontpage-title-image opacity-70 hover:opacity-100 transition duration-500 ease-in-out" src="{{ asset('image/svg/pup.svg') }}">
                </div>
                <div class="frontpage-title-title-container">
                    <p class="frontpage-title-title">{{ $title }}</p>
                </div>
                <div>
                    {!! $PageData->content !!}
                </div>
            </div>
  </div>
</div>
            
            <main id="frontpagebg" class="bg-gray-100 min-h-screen sm:w-12/12 md:w-12/12 lg:w-12/12 bg-cover bg-center" style="background: #0a0000;">
                

                <div class="event-container grid grid-cols-2">
                    <div class="event-header-container shadow-lg transition duration-500 ease-in-out transform hover:-translate-y-5 hover:shadow-2xl cursor-pointer">
                        <div>
                            <p id="frontpage-quotation" class="frontpage-grid-item-for-quote" data-aos="fade-up-left">Excellence is not a skill. It is an attitude</p>
                            <p id="frontpage-quotation-author" class="frontpage-grid-item-for-quote" data-aos="fade-up-left">Hedley Marston</p>
                        </div>
                    </div>
                    <div id="content" class="event-card-container">
                        <div id="frontpage-quote-image" class="shadow-lg transition duration-500 ease-in-out transform hover:-translate-y-5 hover:shadow-2xl rounded-lg  cursor-pointer">
                                <img alt="blog photo" src="{{ asset('image/hedley marston.jpg') }}" data-aos="fade-up" class=""/>            
                        </div>
                    </div>
            </main>








            <main>
                <div id="events-header-container" data-aos="fade-zoom-in">
                    <p>Featured Events</p>
                </div>
                <div class="events-body-container">
                    <div id="content" class="flex flex-row flex-wrap justify-center">
                        <div class="flex flex-wrap place-items-center h-screen m-5 display:block" data-aos="fade-up-right">
                            <!-- card -->
                            <div class="overflow-hidden shadow-lg transition duration-500 ease-in-out transform hover:-translate-y-5 hover:shadow-2xl rounded-lg h-90 w-60 md:w-80 cursor-pointer m-auto">
                                    <img alt="blog photo" src="https://images.unsplash.com/photo-1542435503-956c469947f6?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=967&q=80" class="max-h-40 w-full object-cover"/>
                                    <div class="bg-white w-full p-4">
                                        <p class="text-indigo-500 text-2xl font-medium">
                                            Sample Event #1
                                        </p>
                                        <p class="text-gray-800 text-sm font-medium mb-2">
                                            Sample Event Sub Title
                                        </p>
                                        <p class="text-gray-600 font-light text-md">
                                            Sample Event content tease 
                                            <a class="inline-flex text-indigo-500" href="#">Read More</a>
                                        </p>
                                        <div class="flex flex-wrap justify-starts items-center py-3 border-b-2 text-xs text-white font-medium">
                                            <span class="m-1 px-2 py-1 rounded bg-indigo-500">
                                                #sampleTagsOne
                                            </span>
                                            <span class="m-1 px-2 py-1 rounded bg-indigo-500">
                                                #sampleTagsTwo
                                            </span>
                                            <span class="m-1 px-2 py-1 rounded bg-indigo-500">
                                                #SampleTagsThree
                                            </span>
                                        </div>
                                        <div class="flex items-center mt-2">
                                            <div class="pl-3">
                                                <div class="font-medium">
                                                    Creation Date
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <div class="flex flex-wrap place-items-center h-screen m-5 display:block" data-aos="fade-up-right">
                            <!-- card -->
                            <div class="overflow-hidden shadow-lg transition duration-500 ease-in-out transform hover:-translate-y-5 hover:shadow-2xl rounded-lg h-90 w-60 md:w-80 cursor-pointer m-auto">
                                    <img alt="blog photo" src="https://images.unsplash.com/photo-1542435503-956c469947f6?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=967&q=80" class="max-h-40 w-full object-cover"/>
                                    <div class="bg-white w-full p-4">
                                        <p class="text-indigo-500 text-2xl font-medium">
                                            Sample Event #2
                                        </p>
                                        <p class="text-gray-800 text-sm font-medium mb-2">
                                            Sample Event Sub Title
                                        </p>
                                        <p class="text-gray-600 font-light text-md">
                                            Sample Event content tease 
                                            <a class="inline-flex text-indigo-500" href="#">Read More</a>
                                        </p>
                                        <div class="flex flex-wrap justify-starts items-center py-3 border-b-2 text-xs text-white font-medium">
                                            <span class="m-1 px-2 py-1 rounded bg-indigo-500">
                                                #sampleTagsOne
                                            </span>
                                            <span class="m-1 px-2 py-1 rounded bg-indigo-500">
                                                #sampleTagsTwo
                                            </span>
                                            <span class="m-1 px-2 py-1 rounded bg-indigo-500">
                                                #SampleTagsThree
                                            </span>
                                        </div>
                                        <div class="flex items-center mt-2">
                                            <div class="pl-3">
                                                <div class="font-medium">
                                                    Creation Date
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <div class="flex flex-wrap place-items-center h-screen m-5 display:block" data-aos="fade-up-right">
                            <!-- card -->
                            <div class="overflow-hidden shadow-lg transition duration-500 ease-in-out transform hover:-translate-y-5 hover:shadow-2xl rounded-lg h-90 w-60 md:w-80 cursor-pointer m-auto">
                                    <img alt="blog photo" src="https://images.unsplash.com/photo-1542435503-956c469947f6?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=967&q=80" class="max-h-40 w-full object-cover"/>
                                    <div class="bg-white w-full p-4">
                                        <p class="text-indigo-500 text-2xl font-medium">
                                            Sample Event #3
                                        </p>
                                        <p class="text-gray-800 text-sm font-medium mb-2">
                                            Sample Event Sub Title
                                        </p>
                                        <p class="text-gray-600 font-light text-md">
                                            Sample Event content tease 
                                            <a class="inline-flex text-indigo-500" href="#">Read More</a>
                                        </p>
                                        <div class="flex flex-wrap justify-starts items-center py-3 border-b-2 text-xs text-white font-medium">
                                            <span class="m-1 px-2 py-1 rounded bg-indigo-500">
                                                #sampleTagsOne
                                            </span>
                                            <span class="m-1 px-2 py-1 rounded bg-indigo-500">
                                                #sampleTagsTwo
                                            </span>
                                            <span class="m-1 px-2 py-1 rounded bg-indigo-500">
                                                #SampleTagsThree
                                            </span>
                                        </div>
                                        <div class="flex items-center mt-2">
                                            <div class="pl-3">
                                                <div class="font-medium">
                                                    Creation Date
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <div class="flex flex-wrap place-items-center h-screen m-5 display:block" data-aos="fade-up-right">
                            <!-- card -->
                            <div class="overflow-hidden shadow-lg transition duration-500 ease-in-out transform hover:-translate-y-5 hover:shadow-2xl rounded-lg h-90 w-60 md:w-80 cursor-pointer m-auto">
                                    <img alt="blog photo" src="https://images.unsplash.com/photo-1542435503-956c469947f6?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=967&q=80" class="max-h-40 w-full object-cover"/>
                                    <div class="bg-white w-full p-4">
                                        <p class="text-indigo-500 text-2xl font-medium">
                                            Sample Event #4
                                        </p>
                                        <p class="text-gray-800 text-sm font-medium mb-2">
                                            Sample Event Sub Title
                                        </p>
                                        <p class="text-gray-600 font-light text-md">
                                            Sample Event content tease 
                                            <a class="inline-flex text-indigo-500" href="#">Read More</a>
                                        </p>
                                        <div class="flex flex-wrap justify-starts items-center py-3 border-b-2 text-xs text-white font-medium">
                                            <span class="m-1 px-2 py-1 rounded bg-indigo-500">
                                                #sampleTagsOne
                                            </span>
                                            <span class="m-1 px-2 py-1 rounded bg-indigo-500">
                                                #sampleTagsTwo
                                            </span>
                                            <span class="m-1 px-2 py-1 rounded bg-indigo-500">
                                                #SampleTagsThree
                                            </span>
                                        </div>
                                        <div class="flex items-center mt-2">
                                            <div class="pl-3">
                                                <div class="font-medium">
                                                    Creation Date
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <div class="flex flex-wrap place-items-center h-screen m-5 display:block" data-aos="fade-up-right">
                            <!-- card -->
                            <div class="overflow-hidden shadow-lg transition duration-500 ease-in-out transform hover:-translate-y-5 hover:shadow-2xl rounded-lg h-90 w-60 md:w-80 cursor-pointer m-auto">
                                    <img alt="blog photo" src="https://images.unsplash.com/photo-1542435503-956c469947f6?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=967&q=80" class="max-h-40 w-full object-cover"/>
                                    <div class="bg-white w-full p-4">
                                        <p class="text-indigo-500 text-2xl font-medium">
                                            Sample Event #5
                                        </p>
                                        <p class="text-gray-800 text-sm font-medium mb-2">
                                            Sample Event Sub Title
                                        </p>
                                        <p class="text-gray-600 font-light text-md">
                                            Sample Event content tease 
                                            <a class="inline-flex text-indigo-500" href="#">Read More</a>
                                        </p>
                                        <div class="flex flex-wrap justify-starts items-center py-3 border-b-2 text-xs text-white font-medium">
                                            <span class="m-1 px-2 py-1 rounded bg-indigo-500">
                                                #sampleTagsOne
                                            </span>
                                            <span class="m-1 px-2 py-1 rounded bg-indigo-500">
                                                #sampleTagsTwo
                                            </span>
                                            <span class="m-1 px-2 py-1 rounded bg-indigo-500">
                                                #SampleTagsThree
                                            </span>
                                        </div>
                                        <div class="flex items-center mt-2">
                                            <div class="pl-3">
                                                <div class="font-medium">
                                                    Creation Date
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <div class="flex flex-wrap place-items-center h-screen m-5 display:block" data-aos="fade-up-right">
                            <!-- card -->
                            <div class="overflow-hidden shadow-lg transition duration-500 ease-in-out transform hover:-translate-y-5 hover:shadow-2xl rounded-lg h-90 w-60 md:w-80 cursor-pointer m-auto">
                                    <img alt="blog photo" src="https://images.unsplash.com/photo-1542435503-956c469947f6?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=967&q=80" class="max-h-40 w-full object-cover"/>
                                    <div class="bg-white w-full p-4">
                                        <p class="text-indigo-500 text-2xl font-medium">
                                            Sample Event #6
                                        </p>
                                        <p class="text-gray-800 text-sm font-medium mb-2">
                                            Sample Event Sub Title
                                        </p>
                                        <p class="text-gray-600 font-light text-md">
                                            Sample Event content tease 
                                            <a class="inline-flex text-indigo-500" href="#">Read More</a>
                                        </p>
                                        <div class="flex flex-wrap justify-starts items-center py-3 border-b-2 text-xs text-white font-medium">
                                            <span class="m-1 px-2 py-1 rounded bg-indigo-500">
                                                #sampleTagsOne
                                            </span>
                                            <span class="m-1 px-2 py-1 rounded bg-indigo-500">
                                                #sampleTagsTwo
                                            </span>
                                            <span class="m-1 px-2 py-1 rounded bg-indigo-500">
                                                #SampleTagsThree
                                            </span>
                                        </div>
                                        <div class="flex items-center mt-2">
                                            <div class="pl-3">
                                                <div class="font-medium">
                                                    Creation Date
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <div class="flex flex-wrap place-items-center h-screen m-5 display:block" data-aos="fade-up-right">
                            <!-- card -->
                            <div class="overflow-hidden shadow-lg transition duration-500 ease-in-out transform hover:-translate-y-5 hover:shadow-2xl rounded-lg h-90 w-60 md:w-80 cursor-pointer m-auto">
                                    <img alt="blog photo" src="https://images.unsplash.com/photo-1542435503-956c469947f6?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=967&q=80" class="max-h-40 w-full object-cover"/>
                                    <div class="bg-white w-full p-4">
                                        <p class="text-indigo-500 text-2xl font-medium">
                                            Sample Event #7
                                        </p>
                                        <p class="text-gray-800 text-sm font-medium mb-2">
                                            Sample Event Sub Title
                                        </p>
                                        <p class="text-gray-600 font-light text-md">
                                            Sample Event content tease 
                                            <a class="inline-flex text-indigo-500" href="#">Read More</a>
                                        </p>
                                        <div class="flex flex-wrap justify-starts items-center py-3 border-b-2 text-xs text-white font-medium">
                                            <span class="m-1 px-2 py-1 rounded bg-indigo-500">
                                                #sampleTagsOne
                                            </span>
                                            <span class="m-1 px-2 py-1 rounded bg-indigo-500">
                                                #sampleTagsTwo
                                            </span>
                                            <span class="m-1 px-2 py-1 rounded bg-indigo-500">
                                                #SampleTagsThree
                                            </span>
                                        </div>
                                        <div class="flex items-center mt-2">
                                            <div class="pl-3">
                                                <div class="font-medium">
                                                    Creation Date
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <div class="flex flex-wrap place-items-center h-screen m-5 display:block" data-aos="fade-up-right">
                            <!-- card -->
                            <div class="overflow-hidden shadow-lg transition duration-500 ease-in-out transform hover:-translate-y-5 hover:shadow-2xl rounded-lg h-90 w-60 md:w-80 cursor-pointer m-auto">
                                    <img alt="blog photo" src="https://images.unsplash.com/photo-1542435503-956c469947f6?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=967&q=80" class="max-h-40 w-full object-cover"/>
                                    <div class="bg-white w-full p-4">
                                        <p class="text-indigo-500 text-2xl font-medium">
                                            Sample Event #8
                                        </p>
                                        <p class="text-gray-800 text-sm font-medium mb-2">
                                            Sample Event Sub Title
                                        </p>
                                        <p class="text-gray-600 font-light text-md">
                                            Sample Event content tease 
                                            <a class="inline-flex text-indigo-500" href="#">Read More</a>
                                        </p>
                                        <div class="flex flex-wrap justify-starts items-center py-3 border-b-2 text-xs text-white font-medium">
                                            <span class="m-1 px-2 py-1 rounded bg-indigo-500">
                                                #sampleTagsOne
                                            </span>
                                            <span class="m-1 px-2 py-1 rounded bg-indigo-500">
                                                #sampleTagsTwo
                                            </span>
                                            <span class="m-1 px-2 py-1 rounded bg-indigo-500">
                                                #SampleTagsThree
                                            </span>
                                        </div>
                                        <div class="flex items-center mt-2">
                                            <div class="pl-3">
                                                <div class="font-medium">
                                                    Creation Date
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <main>
                <div id="articles-header-container">
                    <p data-aos="flip-left">Featured Articles</p>
                </div>
                <div class="article-card-container flex flex-row flex-wrap">
                    <div class="article-jumbotron bg-white shadow-2xl rounded-lg mx-auto text-center m-4" data-aos="flip-up">
                        <div class="grid grid-cols-2">
                            <div class="front-article-img-container">
                                <img alt="blog photo" src="https://images.unsplash.com/photo-1542435503-956c469947f6?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=967&q=80" class="max-h-80 w-full object-cover"/>
                            </div>
                            <div class="mt-8 flex flex-col">
                                <h3>This is the sample article title #1</h3>
                                <h6>This is the sample article subtitle #1</h6>
                                <hr>
                                <p class="frontpage-article-jumbo-content">This is the sample article content</p>
                                <hr>
                                <div class="front-article-jumbo-button inline-flex rounded-md bg-blue-500 shadow">
                                    <a href="#" class="text-gray-200 font-bold py-2 px-6">
                                        Read More
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="article-card-container flex flex-row flex-wrap">
                    <div class="article-jumbotron bg-white shadow-2xl rounded-lg mx-auto text-center m-4" data-aos="flip-up">
                        <div class="grid grid-cols-2">
                            <div class="front-article-img-container">
                                <img alt="blog photo" src="https://images.unsplash.com/photo-1542435503-956c469947f6?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=967&q=80" class="max-h-80 w-full object-cover"/>
                            </div>
                            <div class="mt-8 flex flex-col">
                                <h3>This is the sample article title #2</h3>
                                <h6>This is the sample article subtitle #2</h6>
                                <hr>
                                <p class="frontpage-article-jumbo-content">This is the sample article content</p>
                                <hr>
                                <div class="front-article-jumbo-button inline-flex rounded-md bg-blue-500 shadow">
                                    <a href="#" class="text-gray-200 font-bold py-2 px-6">
                                        Read More
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="article-card-container flex flex-row flex-wrap">
                    <div class="article-jumbotron bg-white shadow-2xl rounded-lg mx-auto text-center m-4" data-aos="flip-up">
                        <div class="grid grid-cols-2">
                            <div class="front-article-img-container">
                                <img alt="blog photo" src="https://images.unsplash.com/photo-1542435503-956c469947f6?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=967&q=80" class="max-h-80 w-full object-cover"/>
                            </div>
                            <div class="mt-8 flex flex-col">
                                <h3>This is the sample article title #3</h3>
                                <h6>This is the sample article subtitle #3</h6>
                                <hr>
                                <p class="frontpage-article-jumbo-content">This is the sample article content</p>
                                <hr>
                                <div class="front-article-jumbo-button inline-flex rounded-md bg-blue-500 shadow">
                                    <a href="#" class="text-gray-200 font-bold py-2 px-6">
                                        Read More
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="article-card-container flex flex-row flex-wrap">
                    <div class="article-jumbotron bg-white shadow-2xl rounded-lg mx-auto text-center m-4" data-aos="flip-up">
                        <div class="grid grid-cols-2">
                            <div class="front-article-img-container">
                                <img alt="blog photo" src="https://images.unsplash.com/photo-1542435503-956c469947f6?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=967&q=80" class="max-h-80 w-full object-cover"/>
                            </div>
                            <div class="mt-8 flex flex-col">
                                <h3>This is the sample article title #4</h3>
                                <h6>This is the sample article subtitle #4</h6>
                                <hr>
                                <p class="frontpage-article-jumbo-content">This is the sample article content</p>
                                <hr>
                                <div class="front-article-jumbo-button inline-flex rounded-md bg-blue-500 shadow">
                                    <a href="#" class="text-gray-200 font-bold py-2 px-6">
                                        Read More
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="article-card-container flex flex-row flex-wrap">
                    <div class="article-jumbotron bg-white shadow-2xl rounded-lg mx-auto text-center m-4" data-aos="flip-up">
                        <div class="grid grid-cols-2">
                            <div class="front-article-img-container">
                                <img alt="blog photo" src="https://images.unsplash.com/photo-1542435503-956c469947f6?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=967&q=80" class="max-h-80 w-full object-cover"/>
                            </div>
                            <div class="mt-8 flex flex-col">
                                <h3>This is the sample article title #5</h3>
                                <h6>This is the sample article subtitle #5</h6>
                                <hr>
                                <p class="frontpage-article-jumbo-content">This is the sample article content</p>
                                <hr>
                                <div class="front-article-jumbo-button inline-flex rounded-md bg-blue-500 shadow">
                                    <a href="#" class="text-gray-200 font-bold py-2 px-6">
                                        Read More
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        @endif
    @endforeach

<!-- organization  -->
    @foreach($pageOrgData as $OrgData)
        @if($urlslug == $OrgData->organization_slug)
<div class="bg-img">
  <div class="org-container">
    <nav id="orgPageNav" class="flex items-center px-3 py-2 shadow-lg bg-transparent-0" style="
        background: -webkit-linear-gradient(45deg, {{ $OrgData->organization_primary_color }}b0 0%, {{ $OrgData->organization_secondary_color }}b0 50%,{{ $OrgData->organization_secondary_color }}b0 100%)">
                <div>
                    <button @click="show =! show" class="block h-8 mr-3 text-gray-400 items-center hover:text-gray-200 focus:text-gray-200 focus:outline-none sm:hidden">
                        <svg class="w-8 fill-current" viewBox="0 0 24 24">                            
                            <path x-show="!show" fill-rule="evenodd" d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z"/>
                            <path x-show="show" fill-rule="evenodd" d="M18.278 16.864a1 1 0 0 1-1.414 1.414l-4.829-4.828-4.828 4.828a1 1 0 0 1-1.414-1.414l4.828-4.829-4.828-4.828a1 1 0 0 1 1.414-1.414l4.829 4.828 4.828-4.828a1 1 0 1 1 1.414 1.414l-4.828 4.829 4.828 4.828z"/>
                        </svg>
                    </button>
                </div>
                <div class="h-12 w-full flex items-center mr-3">
                    <a href="{{ url('/student-organization-information-system')}}" class="w-full">
                        <img class="h-8" src="{{ asset('image/svg/pup.svg') }}">
                    </a>
                </div>
                <div class="flex justify-end sm:w-8/12">
                    {{-- Top Navigation --}}
                    <ul class="hidden sm:flex sm:text-left text-gray-200 text-xs">
                            @foreach($sidebarLinks as $item)
                                <a href="{{ url('/'.$item->slug) }}" class="frontpage-nav-bar-design inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-opacity-0 hover:bg-yellow-50 hover:text-yellow-700 focus:outline-none focus:bg-yellow-50 focus:text-white transition text-white">
                                    {{ $item->label }}
                                </a>
                            @endforeach


                    <div class="ml-3 relative">
                        <x-jet-dropdown align="right" width="60">
                            <x-slot name="trigger">
                                <span class="inline-flex rounded-md">
                                    <button type="button" class="frontpage-nav-bar-design inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-opacity-0 hover:bg-yellow-50 hover:text-yellow-700 focus:outline-none focus:bg-yellow-50 focus:text-dark transition text-white">
                                        Organization
                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </span>
                            </x-slot>
                            <x-slot name="content">
                                <div class="w-60">
                                    <!-- Team Management -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('PUP ORGANIZATIONS') }}
                                    </div>
                                    <!-- Team Settings -->
                                    @foreach($orgLinks as $orgWebLinks)
                                        <x-jet-dropdown-link href="{{ url($orgWebLinks->organization_slug) }}" class="frontpage-nav-bar-design">
                                            {{ $orgWebLinks->organization_name }}
                                        </x-jet-dropdown-link>
                                    @endforeach
                                    <div class="border-t border-gray-100"></div>

                                </div>
                            </x-slot>
                        </x-jet-dropdown>
                    </div>
                    <a href="{{ url('/login') }}" class="frontpage-nav-bar-design inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-opacity-0 hover:bg-yellow-50 hover:text-yellow-700 focus:outline-none focus:bg-yellow-50 focus:text-red-900 transition text-yellow-100">
                      Login
                    </a>
                    </ul>
                </div>
            </nav>

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
                    <ul>
                        <div class="ml-3 relative">
                        <x-jet-dropdown align="right" width="60">
                            <x-slot name="trigger">
                                <span class="inline-flex rounded-md">
                                    <button type="button" class="frontpage-nav-bar-design inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-opacity-0 hover:bg-yellow-50 hover:text-yellow-700 focus:outline-none focus:bg-yellow-50 focus:text-white transition text-white">
                                        Organization
                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </span>
                            </x-slot>
                            <x-slot name="content">
                                <div class="w-60">
                                    <!-- Team Management -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('PUP ORGANIZATIONS') }}
                                    </div>
                                    <!-- Team Settings -->
                                    @foreach($orgLinks as $orgWebLinks)
                                        <x-jet-dropdown-link href="{{ url($orgWebLinks->organization_slug) }}" class="frontpage-nav-bar-design">
                                            {{ $orgWebLinks->organization_name }}
                                        </x-jet-dropdown-link>
                                    @endforeach
                                    <div class="border-t border-gray-100"></div>

                                </div>
                            </x-slot>
                        </x-jet-dropdown>
                    </div>
                    </ul>
                    {{-- Top Navigation Mobile Web View --}}
                    <ul class="text-gray-200 text-xs">
                        <a href="{{ url('/login') }}">
                            <li class="cursor-pointer px-4 py-2 hover:bg-gray-800">Login</li>
                        </a>
                    </ul>
                </div>
            </aside>

            <div class="organization-title-container">
                <div class="organization-title-logo-container">
                   <img class="organization-title-image opacity-70 hover:opacity-100 transition duration-500 ease-in-out" src="{{ asset('/files/' . $OrgData->organization_logo) }}">
                </div>
                <div class="organization-title-title-container">
                    <p class="organization-title-title" data-aos="flip-up">{{ $OrgData->organization_name }}</p>
                </div>
            </div>
            <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

  </div>
</div>


            
            <main>
                <div id="carouselOrgs" class="carousel slider flex items-center mb-0 flex-wrap">
                    <div id="carousel-orgs-inner">
                        <img id="carousel-background" src="{{ asset('/image/c1.jpg') }}">
                    </div>
                    <div>
                        <img id="carousel-background" src="{{ asset('/image/c2.jpg') }}">
                    </div>
                    <div>
                        <img id="carousel-background" src="{{ asset('/image/c3.jpg') }}">
                    </div>
                </div>
            </main>


            <!-- <p class="text-center bg-transparent mt-0" style="
                background: {{ $OrgData->organization_primary_color }};
                color: {{ $OrgData->organization_secondary_color  }};
            ">{{ $OrgData->organization_name }}'s News</p> -->
            <div style="border-style: none;">
                
            <p class="organization-title text-center bg-transparent m-5" style="
                color: {{ $OrgData->organization_secondary_color  }};
            " data-aos="flip-left">{{ $OrgData->organization_name }}'s News</p>
            </div>

            <main>
                <div class="article-card-container flex flex-row flex-wrap">
                    <div class="article-jumbotron bg-white shadow-2xl rounded-lg mx-auto text-center m-4" data-aos="flip-up">
                        <div class="grid grid-cols-2">
                            <div class="front-article-img-container">
                                <img alt="blog photo" src="https://images.unsplash.com/photo-1542435503-956c469947f6?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=967&q=80" class="max-h-80 w-full object-cover"/>
                            </div>
                            <div class="mt-8 flex flex-col">
                                <h3>This is the sample article title #1</h3>
                                <h6>This is the sample article subtitle #1</h6>
                                <hr>
                                <p class="frontpage-article-jumbo-content">This is the sample article content</p>
                                <hr>
                                <div class="front-article-jumbo-button inline-flex rounded-md bg-blue-500 shadow">
                                    <a href="#" class="text-gray-200 font-bold py-2 px-6">
                                        Read More
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="article-card-container flex flex-row flex-wrap">
                    <div class="article-jumbotron bg-white shadow-2xl rounded-lg mx-auto text-center m-4" data-aos="flip-up">
                        <div class="grid grid-cols-2">
                            <div class="front-article-img-container">
                                <img alt="blog photo" src="https://images.unsplash.com/photo-1542435503-956c469947f6?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=967&q=80" class="max-h-80 w-full object-cover"/>
                            </div>
                            <div class="mt-8 flex flex-col">
                                <h3>This is the sample article title #1</h3>
                                <h6>This is the sample article subtitle #1</h6>
                                <hr>
                                <p class="frontpage-article-jumbo-content">This is the sample article content</p>
                                <hr>
                                <div class="front-article-jumbo-button inline-flex rounded-md bg-blue-500 shadow">
                                    <a href="#" class="text-gray-200 font-bold py-2 px-6">
                                        Read More
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="article-card-container flex flex-row flex-wrap">
                    <div class="article-jumbotron bg-white shadow-2xl rounded-lg mx-auto text-center m-4" data-aos="flip-up">
                        <div class="grid grid-cols-2">
                            <div class="front-article-img-container">
                                <img alt="blog photo" src="https://images.unsplash.com/photo-1542435503-956c469947f6?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=967&q=80" class="max-h-80 w-full object-cover"/>
                            </div>
                            <div class="mt-8 flex flex-col">
                                <h3>This is the sample article title #1</h3>
                                <h6>This is the sample article subtitle #1</h6>
                                <hr>
                                <p class="frontpage-article-jumbo-content">This is the sample article content</p>
                                <hr>
                                <div class="front-article-jumbo-button inline-flex rounded-md bg-blue-500 shadow">
                                    <a href="#" class="text-gray-200 font-bold py-2 px-6">
                                        Read More
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="article-card-container flex flex-row flex-wrap">
                    <div class="article-jumbotron bg-white shadow-2xl rounded-lg mx-auto text-center m-4" data-aos="flip-up">
                        <div class="grid grid-cols-2">
                            <div class="front-article-img-container">
                                <img alt="blog photo" src="https://images.unsplash.com/photo-1542435503-956c469947f6?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=967&q=80" class="max-h-80 w-full object-cover"/>
                            </div>
                            <div class="mt-8 flex flex-col">
                                <h3>This is the sample article title #1</h3>
                                <h6>This is the sample article subtitle #1</h6>
                                <hr>
                                <p class="frontpage-article-jumbo-content">This is the sample article content</p>
                                <hr>
                                <div class="front-article-jumbo-button inline-flex rounded-md bg-blue-500 shadow">
                                    <a href="#" class="text-gray-200 font-bold py-2 px-6">
                                        Read More
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>

        @endif
    @endforeach
</div>
