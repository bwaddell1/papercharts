@extends('theme::layouts.app')


@section('content')
    <div class="bg-white">
        <div class="max-w-7xl mx-auto px-8 xl:px-5 flex justify-between">
            <div class="text-indigo-950 text-3xl font-semibold leading-10 pt-8 pb-6">Edit Note Template</div>

        </div>
    </div>

    @livewire('note-templates.edit-sample-template', ['mode' => 'edit', 'template' => $template])

    @livewire('note-templates.delete-note-template')
@endsection
