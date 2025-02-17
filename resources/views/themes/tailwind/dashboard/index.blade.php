@extends('theme::layouts.app')


@section('content')
    <div class="bg-white">
        <div class="max-w-7xl mx-auto px-8 xl:px-5 flex justify-between">
            <div class="text-indigo-950 text-3xl font-semibold leading-10 pt-8 pb-6">Welcome Back</div>
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

    <!-- Main modal -->
    <div id="addVisitModal" tabindex="-1" aria-hidden="true"
        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow">
                <!-- Modal header -->
                <div class="flex items-start justify-between p-4 border-b rounded-t">
                    <h3 class="text-xl font-semibold text-gray-900">
                        Add Visit
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center"
                        data-modal-hide="addVisitModal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <form id="add_visit_form" action="{{ route('wave.add-visit') }}" method="POST">
                    @csrf
                    <!-- Modal body -->
                    <div class="p-6 space-y-6">
                        <div class="p-6">
                            <div class="flex flex-col sm:flex-row my-4 gap-6">
                                <div class="w-full sm:w-1/2 sm:mx-2">
                                    <label for="visit_date" class="block text-sm font-medium leading-5 text-gray-700">
                                        Visit Date
                                    </label>
                                    <div class="mt-1 relative">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                                            <svg class="w-4 h-4 text-gray-500" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                <path
                                                    d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                            </svg>
                                        </div>
                                        <input name="datepicker" type="text" id="daterange" required
                                            class="border border-gray-300 shadow text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5"
                                            placeholder="Select Dates">
                                    </div>
                                </div>
                                <div class="w-full sm:w-1/2 sm:mx-2">
                                    <label for="visit_date" class="block text-sm font-medium leading-5 text-gray-700">
                                        Visit Type
                                    </label>
                                    <div class="mt-1 relative searchable-select">
                                        @livewire(
                                            'visits.visit-type-select',
                                            [
                                                'name' => 'visit_type',
                                                'placeholder' => 'Choose a Visit Type',
                                                'searchable' => true,
                                                'class' => 'test',
                                            ],
                                            key(time() . rand(0, 999))
                                        )
                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-col sm:flex-row my-4 gap-6">
                                <div class="w-full sm:w-1/2 sm:mx-2">
                                    <div class="mt-1 relative">
                                        <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900">First
                                            Name</label>
                                        <input type="text" id="first_name" name="first_name" required
                                            class="shadow border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    </div>
                                </div>
                                <div class="w-full sm:w-1/2 sm:mx-2">
                                    <div class="mt-1 relative">
                                        <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900">Last
                                            Name</label>
                                        <input type="text" id="last_name" name="last_name" required
                                            class="shadow border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-col sm:flex-row my-4 gap-6">
                                <div class="w-full sm:w-1/2 sm:mx-2">
                                    <label for="birth_date" class="block text-sm font-medium leading-5 text-gray-700">
                                        Birth Date
                                    </label>
                                    <div class="mt-1 relative">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                                            <svg class="w-4 h-4 text-gray-500" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                <path
                                                    d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                            </svg>
                                        </div>
                                        <input name="birthdate" type="text" id="birth_date" required
                                            class="border border-gray-300 shadow text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5"
                                            placeholder="Select Dates">
                                    </div>
                                </div>
                                <div class="w-full sm:w-1/2 sm:mx-2">

                                </div>
                            </div>
                        </div>
                        <script>
                            $('input[name="datepicker"]').daterangepicker({
                                singleDatePicker: true,
                                showDropdowns: true,
                            });
                            $('input[name="birthdate"]').daterangepicker({
                                singleDatePicker: true,
                                showDropdowns: true,
                            });
                        </script>

                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center justify-end p-6 space-x-2 border-t border-gray-200 rounded-b">
                        <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                            Add Visit
                        </button>
                        <button data-modal-hide="addVisitModal" type="button"
                            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">
                            Cancel
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>


    @livewire('visits.visit-table')
    @livewire('visits.edit-visit')
    @livewire('visits.delete-visit')
    <!-- Main modal -->
    <div id="uploadVisitModal" tabindex="-1" aria-hidden="true"
        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow">
                <!-- Modal header -->
                <div class="flex items-start justify-between p-4 border-b rounded-t">
                    <h3 class="text-xl font-semibold text-gray-900">
                        Upload Visit
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center"
                        data-modal-hide="uploadVisitModal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                @livewire('visits.visit-upload-pane')
            </div>
        </div>
    </div>
@endsection
