<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('New Shopping List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto space-y-2 sm:px-6 lg:px-8">
            <x-button href="{{route('shopping-lists.index')}}" icon="arrow-left" class="mb-12">All Shopping Lists</x-button>
            <livewire:shopping-lists.create/>
        </div>
    </div>
</x-app-layout>
