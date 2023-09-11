<div id="editVisitModal" x-data x-init="$watch('$store.editVisitModal.open', value => {
    if (value === true) { document.body.classList.add('overflow-hidden') } else { document.body.classList.remove('overflow-hidden'); }
});" x-show="$store.editVisitModal.open"
    class="fixed inset-0 z-10 z-30 overflow-y-auto">
    <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div x-show="$store.editVisitModal.open" @click="$store.editVisitModal.open = false;"
            x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="fixed inset-0 transition-opacity" x-cloak>
            <div class="absolute inset-0 bg-black opacity-50"></div>
        </div>

        <!-- This element is to trick the browser into centering the modal contents. -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>&#8203;
        <div x-show="$store.editVisitModal.open" x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            class="inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-5xl sm:w-full sm:p-6"
            role="dialog" aria-modal="true" aria-labelledby="modal-headline" x-cloak>
            <div>
                <div class="mt-3 flex justify-between items-center sm:mt-5">
                    <h3 class="text-lg font-medium leading-6 text-gray-900" id="modal-headline">
                        Edit Visit
                    </h3>
                    <div class="mt-2">
                        <svg class="cursor-pointer" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                            viewBox="0 0 16 16" fill="none" @click="$store.editVisitModal.open = false;">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M11.9928 4.99715C11.9928 4.44747 11.5431 3.99774 10.9934 3.99774C10.7135 3.99774 10.4637 4.10768 10.2838 4.28757L7.99517 6.5862L5.70654 4.29756C5.52664 4.10768 5.27679 3.99774 4.99696 3.99774C4.44729 3.99774 3.99756 4.44747 3.99756 4.99715C3.99756 5.27698 4.10749 5.52683 4.28738 5.70672L6.57602 7.99536L4.28738 10.284C4.10749 10.4639 3.99756 10.7137 3.99756 10.9936C3.99756 11.5432 4.44729 11.993 4.99696 11.993C5.27679 11.993 5.52664 11.883 5.70654 11.7031L7.99517 9.41451L10.2838 11.7031C10.4637 11.883 10.7135 11.993 10.9934 11.993C11.5431 11.993 11.9928 11.5432 11.9928 10.9936C11.9928 10.7137 11.8829 10.4639 11.703 10.284L9.41432 7.99536L11.703 5.70672C11.8829 5.52683 11.9928 5.27698 11.9928 4.99715ZM7.99523 0C3.57787 0 0 3.57787 0 7.99523C0 12.4126 3.57787 15.9905 7.99523 15.9905C12.4126 15.9905 15.9905 12.4126 15.9905 7.99523C15.9905 3.57787 12.4126 0 7.99523 0ZM7.99572 13.9918C4.68769 13.9918 1.9993 11.3034 1.9993 7.99536C1.9993 4.68733 4.68769 1.99893 7.99572 1.99893C11.3037 1.99893 13.9921 4.68733 13.9921 7.99536C13.9921 11.3034 11.3137 13.9918 7.99572 13.9918Z"
                                fill="#8F95B2" />
                        </svg>
                    </div>
                </div>
                <div class="shadow mt-6 sm:mt-5 rounded-md">
                    <form id="edit_visit_form" wire:submit.prevent="handleSubmit">
                        <div class="p-6">
                            <div class="flex flex-col sm:flex-row my-4 gap-6">
                                <div class="w-full sm:w-1/2 sm:mx-2">
                                    <label for="visit_date" class="block text-sm font-medium leading-5 text-gray-700">
                                        Visit Date
                                    </label>
                                    <div class="mt-1 relative">
                                        <div
                                            class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path
                                                    d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                            </svg>
                                        </div>
                                        <input name="date_edit" type="text" id="date_edit" required wire:model="visit_at"
                                            class="border border-gray-300 shadow text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="Select Dates">
                                    </div>
                                </div>
                                <div class="w-full sm:w-1/2 sm:ml-2 mt-4 sm:mt-0">

                                </div>
                            </div>
                            <div class="flex flex-col sm:flex-row my-4 gap-6">
                                <div class="w-full sm:w-1/2 sm:mx-2">
                                    <div class="mt-1 relative">
                                        <label for="first_name"
                                            class="block mb-2 text-sm font-medium text-gray-900">First
                                            Name</label>
                                        <input type="text" id="first_name" name="first_name" required wire:model="first_name"
                                            class="shadow border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    </div>
                                </div>
                                <div class="w-full sm:w-1/2 sm:mx-2">
                                    <div class="mt-1 relative">
                                        <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900">Last
                                            Name</label>
                                        <input type="text" id="last_name" name="last_name" required wire:model="last_name"
                                            class="shadow border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-col sm:flex-row my-4 gap-6">
                                <div class="w-full sm:w-1/2 sm:mx-2">
                                    <div class="mt-1 relative">
                                        <label for="visit_type"
                                            class="block mb-2 text-sm font-medium text-gray-900">Visit
                                            Type</label>
                                        <select id="visit_type" name="visit_type" required wire:model="visit_type"
                                            class="shadow border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                            <option value="" selected>Choose a type</option>
                                            <option value="obesity_follow_up">Obesity Follow Up</option>
                                            <option value="hypertension">Hypertension</option>
                                            <option value="sports_physical">Sports Physical</option>
                                            <option value="skin_rash">Skin Rash</option>
                                            <option value="other">Other</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="w-full sm:w-1/2 sm:mx-2">

                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-100 flex justify-end py-3 pr-5">
                            <button
                                class="inline-flex justify-center px-4 py-1 ml-2 text-base font-medium leading-6 text-white transition duration-150 ease-in-out border border-transparent rounded-md shadow-sm bg-blue-600 hover:bg-wave-500 focus:outline-none focus:border-wave-700 focus:shadow-outline-wave sm:text-sm sm:leading-5"
                                id="apply-crop" type="submit">Save Visit</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="mt-5 sm:mt-6">

            </div>
        </div>
    </div>
</div>

@push('footer-scripts')
    <script>
        $('input[name="date_edit"]').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
        });

        $('#date_edit').on('apply.daterangepicker', function(ev, picker) {
            Livewire.emit('setVisitDate',
                picker.startDate.format('DD/MM/YYYY'),
            );
        });

        window.addEventListener('closeEditVisitModal', event => {
            popToast("success", "Visit is updated successfully.");
            Alpine.store('editVisitModal').close();
        })

    </script>
@endpush
