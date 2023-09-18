@extends('theme::layouts.app')


@section('content')
    <div class="bg-white">
        <div class="max-w-7xl mx-auto px-8 xl:px-5 py-4 flex justify-between">
            <div class="text-indigo-950 text-3xl font-semibold leading-10">Welcome Back</div>
            <form>
                <label for="default-search"
                    class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </div>
                    <input type="search" id="default-search"
                        class="block w-full p-3 pl-10 text-sm text-gray-900 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Search Here" required>
                </div>
            </form>

        </div>
    </div>

    @livewire('visits.visit-table')
    @livewire('visits.edit-visit')
    @livewire('visits.delete-visit')

@endsection
