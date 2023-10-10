@extends('theme::layouts.app')


@section('content')
    <div class="bg-white">
        <div class="max-w-7xl mx-auto px-8 xl:px-5 flex justify-between">
            <div class="text-indigo-950 text-3xl font-semibold leading-10 pt-8 pb-6">Edit Note Template</div>

        </div>
    </div>

    <div class="mt-6">
        <div class="max-w-7xl mx-auto px-8 xl:px-5 flex justify-between">
            <ul
                class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-gray-200 dark:border-gray-700 dark:text-gray-400">
                <li class="mr-2">
                    <a href="#" aria-current="page" class="inline-block p-4 text-blue-600 bg-gray-200 rounded-t-lg active">Note
                        Template</a>
                </li>
                <li class="mr-2">
                    <a href="{{ route('wave.templates.sample') }}"
                        class="inline-block p-4 rounded-t-lg hover:text-gray-600 hover:bg-gray-50 dark:hover:bg-gray-800 dark:hover:text-gray-300">Sample
                        Template</a>
                </li>
            </ul>
        </div>
    </div>

    @livewire('note-templates.template-pane', ['mode' => 'edit', 'template' => $template])

    @livewire('note-templates.delete-note-template')
@endsection
