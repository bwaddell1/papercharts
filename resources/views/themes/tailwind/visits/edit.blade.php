@extends('theme::layouts.app')


@section('content')
<div class="bg-white">
    <div class="max-w-7xl mx-auto px-8 xl:px-5 flex justify-between items-center">
        <div class="text-indigo-950 text-3xl font-semibold leading-10 pt-8 pb-6">Fill Out Visits Note</div>
        <a href="{{ route('wave.dashboard') }}" type="button" class="h-8 bg-transparent border border-blue-700 hover:border-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 text-center inline-flex items-center mr-2 text-blue-700">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-4 h-4 mr-1">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
            </svg>
            <span class="sr-only">Icon description</span>
            Back
        </a>
    </div>
</div>

@livewire('visits.visit-note-pane', ['visit' => $visit])

@endsection
