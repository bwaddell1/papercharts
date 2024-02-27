<div>
    <div class="flex flex-col px-8 mx-auto max-w-7xl xl:px-5 py-12">
        <div class="text-gray-900 text-3xl font-bold leading-9">Visits</div>
        <div class="flex justify-between py-2 flex-wrap items-center">
            <div class="justify-end md:justify-start items-center gap-2 inline-flex flex-wrap mt-4"
                style="height: fit-content;">
                <div class="relative w-44">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
                        </svg>
                    </div>
                    <input name="dates" type="text" wire:change="handleChangeSearchDate" id="visit_daterange"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5"
                        placeholder="Select Dates">
                </div>
                @if (auth()->user()->currentTeam)
                    <div class="relative w-44">
                        <select id="countries" wire:model="filterProvider"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected value="">All Providers</option>
                            @foreach (auth()->user()->currentTeam->providers() as $provider)
                                <option value="{{ $provider->id }}">{{ $provider->name }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif
            </div>
            <div class="flex gap-2 flex-wrap justify-end mt-4 ml-auto">
                <button data-modal-target="addVisitModal" data-modal-toggle="addVisitModal"
                    class="w-44 px-4 py-2 rounded-md border border-gray-300 justify-center items-center inline-flex">
                    <div class="justify-start items-start gap-2 flex">
                        <div class="w-5 h-5 relative">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                        </div>
                        <div class="text-gray-700 text-sm font-medium leading-tight">Add Visits</div>
                    </div>
                </button>
                <button wire:click="showPrintVisits"
                    class="w-44 px-4 py-2 rounded-md border border-gray-300 justify-center items-center inline-flex">
                    <div class="justify-start items-start gap-2 flex">
                        <div class="w-5 h-5 relative">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z" />
                            </svg>
                        </div>
                        <div class="text-gray-700 text-sm font-medium leading-tight">Print Notes</div>
                    </div>
                </button>
                <button data-modal-target="uploadVisitModal" data-modal-toggle="uploadVisitModal"
                    class="w-44 px-2 py-2 bg-indigo-600 rounded-md border border-gray-300 justify-center items-center inline-flex">
                    <div class="justify-start items-start gap-2 flex">
                        <div class="w-5 h-5 relative">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="white" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                            </svg>
                        </div>
                        <div class="text-white text-sm font-medium leading-tight">Upload Visits</div>
                    </div>
                </button>
            </div>
        </div>
        <div class="justify-start items-center gap-1.5 flex pb-4 mt-4">
            <div class="pr-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>

            </div>
            <div class="text-gray-500 text-sm font-normal leading-tight flex-1">{{ $visits->total() }} Visits</div>
        </div>
        <div class="relative shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase" style="background: #E6E9F3">
                    <tr>
                        <th scope="col" class="p-4" style="width: 48px;">
                            <div class="flex items-center">
                                <input id="checkbox-all-search" type="checkbox"
                                    wire:change="handleSelectAll($event.target.checked)"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="checkbox-all-search" class="sr-only">checkbox</label>
                            </div>
                        </th>
                        <th scope="col" class="px-2 py-3 w-1/12" style="min-width: 50px;">
                            ID
                        </th>
                        <th scope="col" class="px-2 py-3 w-3/12" style="min-width: 160px;">
                            FULL NAME
                        </th>
                        <th scope="col" class="px-2 py-3 w-1.5/12" style="min-width: 100px;">
                            DATE
                        </th>
                        <th scope="col" class="px-2 py-3 w-2/12" style="min-width: 150px;">
                            VISIT TYPE
                        </th>
                        <th scope="col" class="px-2 py-3 w-2/12" style="min-width: 120px;">
                            STATUS
                        </th>
                        <th scope="col" class="px-2 py-3 text-center" style="width: 85px; min-width: 85px;">
                            FILL OUT
                        </th>
                        <th scope="col" class="px-2 py-3 text-center" style="width: 55px; min-width: 55px;">
                            RESULT
                        </th>
                        <th scope="col" class="px-2 py-3 text-center text-black"
                            style="width: 55px; min-width: 55px;">
                            AI
                        </th>
                        <th scope="col" class="px-2 py-3 text-center" style="width: 75px; min-width: 75px;">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($visits as $key => $visit)
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="w-4 p-4">
                                <div class="flex items-center">
                                    <input id="checkbox-table-search-1" type="checkbox"
                                        wire:change="handleSelectRow({{ $visit->id }})"
                                        {{ in_array($visit->id, $selected_rows) ? 'checked' : '' }}
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                    <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                                </div>
                            </td>
                            <td class="px-2 py-4">
                                #{{ $visit->id }}
                            </td>
                            <td class="px-2 py-4">
                                {{ $visit->first_name }}
                                {{ $visit->last_name }}
                            </td>
                            <td class="px-2 py-4">
                                {{ date_format(date_create($visit->visit_at), 'm/d/Y') }}
                            </td>
                            <td class="px-2 py-4">
                                {{ $visit->visitType->visit_type }}
                            </td>
                            <td class="px-2 py-4">
                                <?php
                                $statusThemeList = [
                                    'not_started' => 'red',
                                    'printed' => 'yellow',
                                    'processing' => 'blue',
                                    'complete' => 'green',
                                ];
                                $i = $statusThemeList[$visit->status];
                                ?>
                                <span
                                    class="bg-{{ $i }}-100 text-{{ $i }}-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">
                                    {{ strtoupper(formatString($visit->status)) }}
                                </span>
                            </td>
                            <td class="px-2 py-4">
                                {{-- <div wire:click="printVisits({{$visit->id}})" class="flex justify-center cursor-pointer"> --}}
                                <a class="cursor-pointer" href="{{ route('wave.visits.fill_out', $visit->id) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 26 27.5" x="0px"
                                        class="w-5 h-5" y="0px" style="margin: auto">
                                        <title>Asset 398</title>
                                        <g data-name="Layer 2">
                                            <g data-name="Layer 1">
                                                <path
                                                    d="M23,14H3a3,3,0,0,1-3-3V3A3,3,0,0,1,3,0H23a3,3,0,0,1,3,3v8A3,3,0,0,1,23,14ZM3,2A1,1,0,0,0,2,3v8a1,1,0,0,0,1,1H23a1,1,0,0,0,1-1V3a1,1,0,0,0-1-1ZM23,9a1,1,0,0,0-1-1H21a1,1,0,0,0,0,2h1A1,1,0,0,0,23,9ZM19,9a1,1,0,0,0-1-1H8a1,1,0,0,0,0,2H18A1,1,0,0,0,19,9ZM6,9A1,1,0,0,0,5,8H4a1,1,0,0,0,0,2H5A1,1,0,0,0,6,9ZM23,5a1,1,0,0,0-1-1H21a1,1,0,0,0,0,2h1A1,1,0,0,0,23,5ZM19,5a1,1,0,0,0-1-1H17a1,1,0,0,0,0,2h1A1,1,0,0,0,19,5ZM15,5a1,1,0,0,0-1-1H12a1,1,0,0,0,0,2h2A1,1,0,0,0,15,5ZM10,5A1,1,0,0,0,9,4H8A1,1,0,0,0,8,6H9A1,1,0,0,0,10,5ZM6,5A1,1,0,0,0,5,4H4A1,1,0,0,0,4,6H5A1,1,0,0,0,6,5Zm7.447,16.9,6-3a1,1,0,1,0-.894-1.79L13,19.882,7.447,17.105a1,1,0,1,0-.894,1.79l6,3a1,1,0,0,0,.894,0Z" />
                                            </g>
                                        </g><text x="0" y="37" fill="#000000" font-size="5px" font-weight="bold"
                                            font-family="'Helvetica Neue', Helvetica, Arial-Unicode, Arial, Sans-serif">Created
                                            by Mohamed Salah Hajji</text><text x="0" y="42" fill="#000000"
                                            font-size="5px" font-weight="bold"
                                            font-family="'Helvetica Neue', Helvetica, Arial-Unicode, Arial, Sans-serif">from
                                            the Noun Project</text>
                                    </svg>
                                </a>
                                {{-- </div> --}}
                            </td>
                            <td class="px-2 py-4">
                                <a class="cursor-pointer" href="{{ route('wave.visits.edit', $visit->id) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-black"
                                        style="margin: auto">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </a>
                            </td>
                            <td class="px-2 py-4">
                                <div class="cursor-pointer"
                                    wire:click="handleOpenQuickNoteModal({{ $visit->id }})">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        id="bot" style="width: 24px; margin: auto;">
                                        <g fill="none" fill-rule="evenodd">
                                            <path stroke="#000000" stroke-linecap="round"
                                                d="M7.707 22.293A1 1 0 0 1 6 21.586V20H5a2 2 0 0 1-2-2V9a2 2 0 0 1 2-2h15a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2H10l-2.293 2.293z">
                                            </path>
                                            <path stroke="#000000" stroke-linecap="square" d="M12.5 6.5v-1"></path>
                                            <circle cx="8.5" cy="13.5" r="1.5" fill="#000000"></circle>
                                            <circle cx="16.5" cy="13.5" r="1.5" fill="#000000"></circle>
                                            <circle cx="12.5" cy="3.5" r="1.5" stroke="#000000"></circle>
                                            <rect width="4" height="1" x="10.5" y="17.5" stroke="#000000"
                                                rx=".5"></rect>
                                            <path stroke="#000000" stroke-linecap="round"
                                                d="M8 17c-1.657 0-3-1.567-3-3.5S6.343 10 8 10h9c1.657 0 3 1.567 3 3.5S18.657 17 17 17">
                                            </path>
                                        </g>
                                    </svg>
                                </div>
                            </td>
                            <td class="px-2 py-4">
                                <!-- <div class="cursor-pointer" onclick="openDeleteVisitModal({{ $visit->id }})">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.1082 4.69647H1.87293C1.6094 4.69647 1.40234 4.90353 1.40234 5.16706C1.40234 5.43059 1.6094 5.63765 1.87293 5.63765H2.34352V15.0494C2.34352 15.5671 2.76705 15.9906 3.2847 15.9906H12.6965C13.2141 15.9906 13.6376 15.5671 13.6376 15.0494V5.63765H14.1082C14.3718 5.63765 14.5788 5.43059 14.5788 5.16706C14.5788 4.90353 14.3718 4.69647 14.1082 4.69647ZM6.10823 13.1671C6.10823 13.6847 5.6847 14.1082 5.16705 14.1082C4.6494 14.1082 4.22587 13.6847 4.22587 13.1671V7.52C4.22587 7.00235 4.6494 6.57882 5.16705 6.57882C5.6847 6.57882 6.10823 7.00235 6.10823 7.52V13.1671ZM8.93176 13.1671C8.93176 13.6847 8.50823 14.1082 7.99058 14.1082C7.47293 14.1082 7.0494 13.6847 7.0494 13.1671V7.52C7.0494 7.00235 7.47293 6.57882 7.99058 6.57882C8.50823 6.57882 8.93176 7.00235 8.93176 7.52V13.1671ZM11.7553 13.1671C11.7553 13.6847 11.3318 14.1082 10.8141 14.1082C10.2965 14.1082 9.87293 13.6847 9.87293 13.1671V7.52C9.87293 7.00235 10.2965 6.57882 10.8141 6.57882C11.3318 6.57882 11.7553 7.00235 11.7553 7.52V13.1671ZM13.6376 1.87294H9.87293C9.87293 1.35529 9.4494 0.931763 8.93176 0.931763H7.0494C6.53176 0.931763 6.10823 1.35529 6.10823 1.87294H2.34352C1.82587 1.87294 1.40234 2.29647 1.40234 2.81412V3.75529H14.5788V2.81412C14.5788 2.29647 14.1553 1.87294 13.6376 1.87294Z" fill="#101840" />
                                </svg>
                            </div> -->
                                <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown"
                                    class="text-black hover:bg-gray-50 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center"
                                    type="button">
                                    Actions
                                    <svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 1 4 4 4-4" />
                                    </svg>
                                </button>

                                <!-- Dropdown menu -->
                                <div id="dropdown"
                                    class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-36 dark:bg-gray-700">
                                    <ul class="p-2 text-sm text-gray-700 dark:text-gray-200"
                                        aria-labelledby="dropdownDefaultButton">
                                        <li>
                                            <button onclick="openEditVisitModal({{ $visit->id }})"
                                                class="block w-full px-4 py-2 hover:bg-gray-100 text-left">Edit</button>
                                        </li>
                                        <li>
                                            <a href="#" class="block px-4 py-2 hover:bg-gray-100 text-red-400">
                                                Delete</a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="row my-10">
            <div class="col-md-12">
                {{ $visits->links('pagination::tailwind') }}
            </div>
        </div>

        @if ($generate_note_id)
            <!-- Main modal -->
            <div id="quickNoteModal" tabindex="-1" aria-hidden="true"
                class="fixed top-0 left-0 right-0 z-50 w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full justify-center items-center flex">
                <div class="relative w-full max-w-2xl max-h-full">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow">
                        <!-- Modal header -->
                        <div class="flex items-start justify-between p-4 border-b rounded-t">
                            <h3 class="text-xl font-semibold text-gray-900">
                                Complete Visit Electronically
                            </h3>
                            <button type="button" wire:click="closeQuickNoteModal"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <form wire:submit.prevent="generate_note">
                            @csrf
                            <!-- Modal body -->
                            <div class="p-6 space-y-6">
                                @if (!$note_generating)
                                    <textarea id="prompt" name="prompt" wire:model="prompt" rows="6"
                                        placeholder="Briefly describe your encounter, almost like you would when presenting on rounds and let AI generate your note for you"
                                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Write your thoughts here..."></textarea>
                                @else
                                    <div class="w-full lg:w-5/12 px-4" wire:ignore>
                                        <p class="text-2xl text-bold text-center" style="padding: 12px 0;">Generating
                                        </p>
                                        <div style="margin-bottom: 12px; margin-top: 12px;">
                                            <div
                                                style="width: 100%; height: 10px; position: relative; background-color: #f0f0f0; border-radius: 20px;">
                                                <div id="progress_bar"
                                                    style="position: absolute; top: 0; left: 0; background-color: #007acc; border-radius: 20px; height: 100%; width: 0%;">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <span wire:poll.500ms="check_generate_note"></span>
                                @endif
                            </div>
                            <!-- Modal footer -->
                            <div
                                class="flex items-center justify-end p-6 space-x-2 border-t border-gray-200 rounded-b">
                                @if (!$note_generating)
                                    <button type="submit"
                                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                        Generate Note
                                    </button>
                                @endif
                                <div wire:click="closeQuickNoteModal" type="button"
                                    class="text-gray-500 cursor-pointer bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">
                                    Close
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        @endif

        @if ($generate_note_id)
            <div modal-backdrop="" class="bg-gray-900 bg-opacity-50 dark:bg-opacity-80 fixed inset-0 z-40"
                wire:click="closeQuickNoteModal"></div>
        @endif

        <div id="printVisitsPreviewModal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
            class="fixed top-0 left-0 right-0 z-50 w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 max-h-full {{ $showPreviewModal ? '' : 'hidden' }}">
            <div class="relative w-full max-w-2xl max-h-full z-20"
                style="{{ $showPreviewModal ? 'top: 50%; left: 50%; transform: translate(-50%, -50%)' : '' }}">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            Preview PDFs
                        </h3>
                        <button wire:click="closePrintVisits" type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-hide="printVisitsPreviewModal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    @if (count($pdf_list) == 0)
                        <div class="p-6 space-y-6">
                            <div role="status" class="flex justify-center py-6">
                                <svg aria-hidden="true"
                                    class="w-8 h-8 mr-2 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
                                    viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                        fill="currentColor" />
                                    <path
                                        d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                        fill="currentFill" />
                                </svg>
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                    @else
                        <div class="p-8">
                            @foreach ($pdf_list as $pdf)
                                <div>
                                    <h4 class="font-bold text-lg py-2 text-gray-800">#{{ $pdf['id'] }}
                                        {{ $pdf['name'] }} {{ $pdf['visitType'] }}</h4>
                                    <embed src="{{ asset($pdf['link']) }}" type="application/pdf" width="100%"
                                        height="600px" />
                                </div>
                            @endforeach
                        </div>
                    @endif
                    <!-- Modal footer -->
                    <div
                        class="flex justify-end items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button wire:click="downloadZipFiles" type="button"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Download
                            All</button>
                        <button wire:click="closePrintVisits" type="button"
                            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Close</button>
                    </div>
                </div>
            </div>
            <div class="absolute left-0 right-0 top-0 bottom-0 bg-gray-900 opacity-50" wire:click="closePrintVisits">
            </div>
        </div>

    </div>
    <script>
        var isCompleted = false;

        window.openUploadVisitModal = function() {
            Alpine.store('lgModal').type = 'upload-visit';
            Alpine.store('lgModal').openModal();
        }
        window.openEditVisitModal = function(visit_id) {
            Alpine.store('editVisitModal').openModal();
            Livewire.emit('editVisit', visit_id);
            // Alpine.store('editVisitModal').visit_id = visit_id;

        }
        window.openDeleteVisitModal = function(visit_id) {
            Alpine.store('deleteVisitModal').openModal();
            Livewire.emit('deleteVisit', visit_id);
        }

        printVisits = function(visits) {
            visits = JSON.parse(visits);
            if (!visits || visits.length == 0) {
                popToast('danger', "Please select visits to print.");
            }
            for (let i = 0; i < visits.length; i++) {
                setTimeout(() => {
                    Livewire.emit('printVisits', visits[i]);
                }, 300 * i);
            }
        }

        let progressBarInterval;

        window.addEventListener('generateNote', event => {
            // progressBarInterval = setInterval(() => {
            //     const progressBar = document.getElementById('progress_bar');
            //     if (!progressBar || !progressBar.style) {
            //         clearInterval(progressBarInterval);
            //         return;
            //     }
            //     const currentWidth = parseFloat(progressBar.style.width) || 0;
            //     if (currentWidth < 100) {
            //         progressBar.style.width = (currentWidth + (100 - currentWidth) / 1000) + '%';
            //     } else {
            //         clearInterval(interval);
            //     }
            // }, 20);
        });

        window.addEventListener('CompleteGenerateNote', event => {
            clearInterval(progressBarInterval);
            if (!isCompleted) {
                const progressBar = document.getElementById('progress_bar');
                progressBarInterval = setInterval(() => {
                    const currentWidth = parseFloat(progressBar.style.width) || 0;
                    if (currentWidth < 100) {
                        progressBar.style.width = (currentWidth + 10) + '%';
                    } else {
                        clearInterval(progressBarInterval);
                        console.log(event);
                        window.location.href = `/visits/fill-out/${event.detail.visit_id}`;
                    }
                }, 20);
                isCompleted = true;
            }
        });
    </script>
</div>
@push('footer-scripts')
    <script>
        $('input[name="dates"]').daterangepicker({
            autoUpdateInput: false,
        });

        $('input[name="dates"]').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
        });

        $('input[name="dates"]').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });

        $('#visit_daterange').on('apply.daterangepicker', function(ev, picker) {
            Livewire.emit('dateRangeUpdated', picker.startDate.format('YYYY-MM-DD'), picker.endDate.format(
                'YYYY-MM-DD'));
        });

        $('#visit_daterange').on('cancel.daterangepicker', function(ev, picker) {
            Livewire.emit('dateRangeUpdated', null, null);
        });
    </script>
@endpush
