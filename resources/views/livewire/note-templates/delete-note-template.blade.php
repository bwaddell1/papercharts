<div id="deleteNoteTemplateModal" x-data x-init="$watch('$store.deleteNoteTemplateModal.open', value => {
    if (value === true) { document.body.classList.add('overflow-hidden') } else { document.body.classList.remove('overflow-hidden'); }
});" x-show="$store.deleteNoteTemplateModal.open"
    class="fixed inset-0 z-10 z-30 overflow-y-auto" style="z-index: 200;">
    <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div x-show="$store.deleteNoteTemplateModal.open" @click="$store.deleteNoteTemplateModal.open = false;"
            x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="fixed inset-0 transition-opacity" x-cloak>
            <div class="absolute inset-0 bg-black opacity-50"></div>
        </div>

        <!-- This element is to trick the browser into centering the modal contents. -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>&#8203;
        <div x-show="$store.deleteNoteTemplateModal.open" x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            class="inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6"
            role="dialog" aria-modal="true" aria-labelledby="modal-headline" x-cloak>
            <div>
                <div class="mt-3 flex justify-between items-center sm:mt-5">
                    <h3 class="text-lg font-medium leading-6 text-gray-900" id="modal-headline">
                        Delete Note Template
                    </h3>
                    <div class="mt-2">
                        <svg class="cursor-pointer" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                            viewBox="0 0 16 16" fill="none" @click="$store.deleteNoteTemplateModal.open = false;">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M11.9928 4.99715C11.9928 4.44747 11.5431 3.99774 10.9934 3.99774C10.7135 3.99774 10.4637 4.10768 10.2838 4.28757L7.99517 6.5862L5.70654 4.29756C5.52664 4.10768 5.27679 3.99774 4.99696 3.99774C4.44729 3.99774 3.99756 4.44747 3.99756 4.99715C3.99756 5.27698 4.10749 5.52683 4.28738 5.70672L6.57602 7.99536L4.28738 10.284C4.10749 10.4639 3.99756 10.7137 3.99756 10.9936C3.99756 11.5432 4.44729 11.993 4.99696 11.993C5.27679 11.993 5.52664 11.883 5.70654 11.7031L7.99517 9.41451L10.2838 11.7031C10.4637 11.883 10.7135 11.993 10.9934 11.993C11.5431 11.993 11.9928 11.5432 11.9928 10.9936C11.9928 10.7137 11.8829 10.4639 11.703 10.284L9.41432 7.99536L11.703 5.70672C11.8829 5.52683 11.9928 5.27698 11.9928 4.99715ZM7.99523 0C3.57787 0 0 3.57787 0 7.99523C0 12.4126 3.57787 15.9905 7.99523 15.9905C12.4126 15.9905 15.9905 12.4126 15.9905 7.99523C15.9905 3.57787 12.4126 0 7.99523 0ZM7.99572 13.9918C4.68769 13.9918 1.9993 11.3034 1.9993 7.99536C1.9993 4.68733 4.68769 1.99893 7.99572 1.99893C11.3037 1.99893 13.9921 4.68733 13.9921 7.99536C13.9921 11.3034 11.3137 13.9918 7.99572 13.9918Z"
                                fill="#8F95B2" />
                        </svg>
                    </div>
                </div>
                <div class="py-4 mt-6 sm:mt-5 rounded-md">
                    This data will be permanently deleted. This action cannot be undone. Are you sure?
                </div>
            </div>
            <div class="mt-5 sm:mt-6">
                <span class="flex w-full rounded-md justify-end gap-4">
                    <button type="button"
                        class="inline-flex justify-center rounded-md border border-transparent px-4 py-2 bg-gray-500 text-base leading-6 font-medium text-white shadow-sm hover:bg-gray-600 focus:outline-none focus:border-red-700 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5"
                        @click="$store.deleteNoteTemplateModal.open = false;">
                        Cancel
                    </button>
                    <button type="button"
                        class="inline-flex justify-center rounded-md border border-transparent px-4 py-2 bg-red-500 text-base leading-6 font-medium text-white shadow-sm hover:bg-red-600 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5"
                        wire:click="handleDeleteNoteTemplate">
                        Delete
                    </button>
                </span>
            </div>
        </div>
    </div>
</div>