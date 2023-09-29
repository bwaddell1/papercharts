@extends('theme::layouts.app')


@section('content')
    <div class="bg-white">
        <div class="max-w-7xl mx-auto px-8 xl:px-5 flex justify-between">
            <div class="text-indigo-950 text-3xl font-semibold leading-10 pt-8 pb-6">Fill Out Visits Note</div>

        </div>
    </div>

    @livewire('visits.visit-note-pane', ['visit' => $visit])

@endsection
