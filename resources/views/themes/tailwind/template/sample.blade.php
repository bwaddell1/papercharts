@extends('theme::layouts.app')


@section('content')
    <div class="bg-white">
        <div class="max-w-7xl mx-auto px-8 xl:px-5 flex justify-between">
            <div class="text-indigo-950 text-3xl font-semibold leading-10 pt-8 pb-6">Sample Note Templates</div>
            <div class="flex justify-center items-center">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </div>
                    <input type="search" id="default-search"
                        class="block w-full p-3 pl-10 text-sm text-gray-900 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Search Here" required>
                </div>
            </div>

        </div>
    </div>

    <div class="py-12">
        <div class="bg-white max-w-7xl mx-auto px-8 xl:px-5 rounded-lg shadow pt-12">
            <ul
                class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400">
                <li class="mr-2">
                    <a href="{{route('wave.templates.index')}}" class="inline-block p-4 rounded-t-lg hover:text-gray-600 hover:bg-gray-50">Note
                        Templates</a>
                </li>
                <li class="mr-2">
                    <a href="#" aria-current="page"
                        class="inline-block p-4 text-blue-600 bg-gray-100 rounded-t-lg active">Sample Templates</a>
                </li>
            </ul>

            @livewire('note-templates.sample-template-table')
        </div>
    </div>
@endsection
