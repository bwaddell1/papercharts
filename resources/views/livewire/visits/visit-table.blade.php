<div class="flex flex-col px-8 mx-auto my-6 max-w-7xl xl:px-5 py-12">
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
                <input name="dates" type="text" wire:change="handleChangeSearchDate" id="daterange"
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
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                    </div>
                    <div class="text-gray-700 text-sm font-medium leading-tight">Add Visits</div>
                </div>
            </button>
            <button onclick="printVisits('{{ json_encode($selected_rows) }}')"
                class="w-44 px-4 py-2 rounded-md border border-gray-300 justify-center items-center inline-flex">
                <div class="justify-start items-start gap-2 flex">
                    <div class="w-5 h-5 relative">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5">
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
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="white" class="w-5 h-5">
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
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
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
                        EDIT
                    </th>
                    <th scope="col" class="px-2 py-3 text-center" style="width: 75px; min-width: 75px;">
                        DELETE
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
                            {{ $visit->last_name }}
                            {{ $visit->first_name }}
                        </td>
                        <td class="px-2 py-4">
                            {{ date_format(date_create($visit->visit_at), 'm/d/Y') }}
                        </td>
                        <td class="px-2 py-4">
                            {{ $visit->visitType->visit_type }}
                        </td>
                        <td class="px-2 py-4">
                            <?php $i = $visit->status == 'complete' ? 'green' : ($visit->status == 'processing' ? 'blue' : ($visit->status == 'not_started' ? 'red' : 'gray')); ?>
                            <span
                                class="bg-{{ $i }}-100 text-{{ $i }}-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">
                                {{ strtoupper(formatString($visit->status)) }}
                            </span>
                        </td>
                        <td class="px-2 py-4">
                            <a href="#" class="font-medium text-blue-600 hover:underline flex justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 26 27.5" x="0px"
                                    class="w-5 h-5" y="0px">
                                    <title>Asset 398</title>
                                    <g data-name="Layer 2">
                                        <g data-name="Layer 1">
                                            <path
                                                d="M23,14H3a3,3,0,0,1-3-3V3A3,3,0,0,1,3,0H23a3,3,0,0,1,3,3v8A3,3,0,0,1,23,14ZM3,2A1,1,0,0,0,2,3v8a1,1,0,0,0,1,1H23a1,1,0,0,0,1-1V3a1,1,0,0,0-1-1ZM23,9a1,1,0,0,0-1-1H21a1,1,0,0,0,0,2h1A1,1,0,0,0,23,9ZM19,9a1,1,0,0,0-1-1H8a1,1,0,0,0,0,2H18A1,1,0,0,0,19,9ZM6,9A1,1,0,0,0,5,8H4a1,1,0,0,0,0,2H5A1,1,0,0,0,6,9ZM23,5a1,1,0,0,0-1-1H21a1,1,0,0,0,0,2h1A1,1,0,0,0,23,5ZM19,5a1,1,0,0,0-1-1H17a1,1,0,0,0,0,2h1A1,1,0,0,0,19,5ZM15,5a1,1,0,0,0-1-1H12a1,1,0,0,0,0,2h2A1,1,0,0,0,15,5ZM10,5A1,1,0,0,0,9,4H8A1,1,0,0,0,8,6H9A1,1,0,0,0,10,5ZM6,5A1,1,0,0,0,5,4H4A1,1,0,0,0,4,6H5A1,1,0,0,0,6,5Zm7.447,16.9,6-3a1,1,0,1,0-.894-1.79L13,19.882,7.447,17.105a1,1,0,1,0-.894,1.79l6,3a1,1,0,0,0,.894,0Z" />
                                        </g>
                                    </g><text x="0" y="37" fill="#000000" font-size="5px"
                                        font-weight="bold"
                                        font-family="'Helvetica Neue', Helvetica, Arial-Unicode, Arial, Sans-serif">Created
                                        by Mohamed Salah Hajji</text><text x="0" y="42"
                                        fill="#000000" font-size="5px" font-weight="bold"
                                        font-family="'Helvetica Neue', Helvetica, Arial-Unicode, Arial, Sans-serif">from
                                        the Noun Project</text>
                                </svg>
                            </a>
                        </td>
                        <td class="px-2 py-4">
                            <div class="cursor-pointer" onclick="openEditVisitModal({{ $visit->id }})">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    viewBox="0 0 16 16" fill="none">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M3.25023 10.26L5.72023 12.73L12.4102 6.03999L9.95023 3.55999L3.25023 10.26ZM0.990234 14.99L4.85023 13.6L2.39023 11.16L0.990234 14.99ZM13.2402 0.98999C12.7602 0.98999 12.3202 1.18999 12.0002 1.49999L10.5602 2.93999L13.0302 5.40999L14.4702 3.96999C14.7902 3.64999 14.9802 3.21999 14.9802 2.72999C14.9902 1.77999 14.2102 0.98999 13.2402 0.98999Z"
                                        fill="#101840" />
                                </svg>
                            </div>
                        </td>
                        <td class="px-2 py-4">
                            <div class="cursor-pointer" onclick="openDeleteVisitModal({{ $visit->id }})">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    viewBox="0 0 16 16" fill="none">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M14.1082 4.69647H1.87293C1.6094 4.69647 1.40234 4.90353 1.40234 5.16706C1.40234 5.43059 1.6094 5.63765 1.87293 5.63765H2.34352V15.0494C2.34352 15.5671 2.76705 15.9906 3.2847 15.9906H12.6965C13.2141 15.9906 13.6376 15.5671 13.6376 15.0494V5.63765H14.1082C14.3718 5.63765 14.5788 5.43059 14.5788 5.16706C14.5788 4.90353 14.3718 4.69647 14.1082 4.69647ZM6.10823 13.1671C6.10823 13.6847 5.6847 14.1082 5.16705 14.1082C4.6494 14.1082 4.22587 13.6847 4.22587 13.1671V7.52C4.22587 7.00235 4.6494 6.57882 5.16705 6.57882C5.6847 6.57882 6.10823 7.00235 6.10823 7.52V13.1671ZM8.93176 13.1671C8.93176 13.6847 8.50823 14.1082 7.99058 14.1082C7.47293 14.1082 7.0494 13.6847 7.0494 13.1671V7.52C7.0494 7.00235 7.47293 6.57882 7.99058 6.57882C8.50823 6.57882 8.93176 7.00235 8.93176 7.52V13.1671ZM11.7553 13.1671C11.7553 13.6847 11.3318 14.1082 10.8141 14.1082C10.2965 14.1082 9.87293 13.6847 9.87293 13.1671V7.52C9.87293 7.00235 10.2965 6.57882 10.8141 6.57882C11.3318 6.57882 11.7553 7.00235 11.7553 7.52V13.1671ZM13.6376 1.87294H9.87293C9.87293 1.35529 9.4494 0.931763 8.93176 0.931763H7.0494C6.53176 0.931763 6.10823 1.35529 6.10823 1.87294H2.34352C1.82587 1.87294 1.40234 2.29647 1.40234 2.81412V3.75529H14.5788V2.81412C14.5788 2.29647 14.1553 1.87294 13.6376 1.87294Z"
                                        fill="#101840" />
                                </svg>
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

</div>
<script>
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
        for (let i = 0; i < visits.length; i++) {
            setTimeout(() => {
                Livewire.emit('printVisits', visits[i]);
            }, 300 * i);
        }
    }
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

        $('#daterange').on('apply.daterangepicker', function(ev, picker) {
            Livewire.emit('dateRangeUpdated',
                picker.startDate.format('YYYY-MM-DD'),
                picker.endDate.format('YYYY-MM-DD')
            );
        });

        $('#daterange').on('cancel.daterangepicker', function(ev, picker) {
            Livewire.emit('dateRangeUpdated',
                null,
                null
            );
        });
    </script>
@endpush
