<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('System') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="mt-4">
                    <x-jet-label for="background_image" value="{{ __('Background Image') }}" />
                    <x-jet-input wire:model="background_image" id="background_image" class="block mt-1 w-full" type="file" />
                    @error('background_image') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="mt-4">
                    <x-jet-label for="logo" value="{{ __('Logo') }}" />
                    <x-jet-input wire:model="logo" id="logo" class="block mt-1 w-full" type="file" />
                    @error('logo') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
