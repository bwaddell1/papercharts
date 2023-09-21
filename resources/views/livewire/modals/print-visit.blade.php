<div>
    <div class="mt-3 flex justify-between items-center sm:mt-5">
        <h3 class="text-lg font-medium leading-6 text-gray-900" id="modal-headline">
            Print Selected Visits
        </h3>
        <div class="mt-2">
            <svg class="cursor-pointer" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"
                fill="none" @click="$store.lgModal.open = false;">
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M11.9928 4.99715C11.9928 4.44747 11.5431 3.99774 10.9934 3.99774C10.7135 3.99774 10.4637 4.10768 10.2838 4.28757L7.99517 6.5862L5.70654 4.29756C5.52664 4.10768 5.27679 3.99774 4.99696 3.99774C4.44729 3.99774 3.99756 4.44747 3.99756 4.99715C3.99756 5.27698 4.10749 5.52683 4.28738 5.70672L6.57602 7.99536L4.28738 10.284C4.10749 10.4639 3.99756 10.7137 3.99756 10.9936C3.99756 11.5432 4.44729 11.993 4.99696 11.993C5.27679 11.993 5.52664 11.883 5.70654 11.7031L7.99517 9.41451L10.2838 11.7031C10.4637 11.883 10.7135 11.993 10.9934 11.993C11.5431 11.993 11.9928 11.5432 11.9928 10.9936C11.9928 10.7137 11.8829 10.4639 11.703 10.284L9.41432 7.99536L11.703 5.70672C11.8829 5.52683 11.9928 5.27698 11.9928 4.99715ZM7.99523 0C3.57787 0 0 3.57787 0 7.99523C0 12.4126 3.57787 15.9905 7.99523 15.9905C12.4126 15.9905 15.9905 12.4126 15.9905 7.99523C15.9905 3.57787 12.4126 0 7.99523 0ZM7.99572 13.9918C4.68769 13.9918 1.9993 11.3034 1.9993 7.99536C1.9993 4.68733 4.68769 1.99893 7.99572 1.99893C11.3037 1.99893 13.9921 4.68733 13.9921 7.99536C13.9921 11.3034 11.3137 13.9918 7.99572 13.9918Z"
                    fill="#8F95B2" />
            </svg>
        </div>
    </div>
    <div class="shadow mt-6 sm:mt-5 rounded-md">
        <div class="px-8 py-16">
            <div class="text-gray-500 text-sm font-medium font-['Inter'] leading-tight">Print or
                download the selected office visits</div>

            <div class="flex items-center mt-4">
                <input id="visit-id-checkbox" type="checkbox" wire:model.debounce.200ms="show_visit_id"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                <label for="visit-id-checkbox" class="ml-2 text-sm font-medium text-gray-900">Visit
                    ID</label>
            </div>
            <div class="flex items-center mt-4">
                <input checked id="last-name-checkbox" type="checkbox" wire:model.debounce.200ms="show_last_name"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                <label for="last-name-checkbox" class="ml-2 text-sm font-medium text-gray-900">Last
                    Name</label>
            </div>
            <div class="flex items-center mt-4">
                <input checked id="first-name-checkbox" type="checkbox" wire:model.debounce.200ms="show_first_name"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                <label for="first-name-checkbox" class="ml-2 text-sm font-medium text-gray-900">First
                    Name</label>
            </div>
            <div class="flex items-center mt-4">
                <input checked id="visit-type-checkbox" type="checkbox" wire:model.debounce.200ms="show_visit_type"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                <label for="visit-type-checkbox" class="ml-2 text-sm font-medium text-gray-900">Visit
                    Type</label>
            </div>
            <div class="flex items-center mt-4">
                <input checked id="visit-at-checkbox" type="checkbox" wire:model.debounce.200ms="show_visit_at"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                <label for="visit-at-checkbox" class="ml-2 text-sm font-medium text-gray-900">Visit
                    At</label>
            </div>
            <div class="flex items-center mt-4">
                <input checked id="status-checkbox" type="checkbox" wire:model.debounce.200ms="show_status"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                <label for="status-checkbox"
                    class="ml-2 text-sm font-medium text-gray-900">Status</label>
            </div>
            <div class="flex items-center mt-4">
                <input checked id="ready-checkbox" type="checkbox" wire:model.debounce.200ms="show_ready"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                <label for="ready-checkbox"
                    class="ml-2 text-sm font-medium text-gray-900">Ready</label>
            </div>
        </div>
        <form id="print_visit_form" wire:submit.prevent="printVisits">

            <div class="bg-gray-100 flex justify-end py-3 pr-5">
                <button
                    class="inline-flex justify-center px-4 py-1 ml-2 text-base font-medium leading-6 text-white transition duration-150 ease-in-out border border-transparent rounded-md shadow-sm bg-blue-600 hover:bg-wave-500 focus:outline-none focus:border-wave-700 focus:shadow-outline-wave sm:text-sm sm:leading-5"
                    id="apply-crop" type="submit">Print</button>
            </div>
        </form>
    </div>
</div>
