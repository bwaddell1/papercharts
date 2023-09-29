<div class="max-w-7xl mx-auto my-6" style="margin-top: 40px;">
    <form wire:submit.prevent="save">
        <div class="bg-white shadow" style="width: fit-content; margin: 0 auto;">
            <div class="block flex justify-center" style="padding: 0 48px;">
                <div class="flex flex-col py-12 pb-4 flex-1" style="width: 750px;">
                    <div style="margin-top: 16px;">
                        @livewire('editorjs', [
                            'editorId' => 'visit_note',
                            'value' => $note_content,
                            'uploadDisk' => 'public',
                            'downloadDisk' => 'public',
                            'placeholder' => 'Type Content',
                            // 'readOnly' => false,
                            'class' => 'full-editor',
                        ])
                    </div>
                </div>
                <div class="border-l-2 text-lg" style="min-width: 20%; padding-left: 16px; margin-top: 80px;">
                    @if (count($selected_vitals) > 0)
                        <div class="mb-4">
                            <p class="pb-4 font-bold">Vital Signs</p>
                            @foreach ($selected_vitals as $key => $value)
                                <div style="font-size: 16px;">
                                    {{ formatString($key) }}
                                    <div class="bg-gray-100 border-t border-b flex items-center"
                                        style="min-height: 50px; margin: 4px 0; border-style: dashed; border-color: #aaa; padding: 4px 12px;">
                                        @if ($key == 'blood_pressure')
                                            __________/_________
                                        @endif
                                        @if ($key == 'Height/Weight')
                                            ________ inches ________ lbs
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                    @if (count($selected_histories) > 0)
                        <div class="mb-4">
                            <p class="pb-4 font-bold mt-8">History(s)</p>
                            @foreach ($selected_histories as $key => $value)
                                <div style="font-size: 16px;">
                                    [&nbsp;&nbsp;] {{ formatString($key) }} (mark reviewed)
                                    <div class="bg-gray-100 border-t border-b flex items-center"
                                        style="min-height: 100px; margin: 4px 0; border-style: dashed; border-color: #aaa; padding: 4px 12px;">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
            <div class="mt-16 pb-8 flex gap-3 text-gray-500 justify-end mx-10">
                @foreach ($selected_elements as $key => $value)
                    @if ($value)
                        <div class="text-md">
                            {{ formatString($key) }}: _______________{{ $key == 'signature' ? '_______________' : '' }}
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
        <div class="flex justify-end mt-6 px-6">
            <button type="button" data-modal-target="clearNoteModal" data-modal-toggle="clearNoteModal"
                class="flex gap-1 items-center focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                </svg>
                Clear
            </button>
            <button type="submit"
                class="flex gap-1 items-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                </svg>
                Save
            </button>
        </div>
    </form>
    <div id="clearNoteModal" tabindex="-1"
        class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button"
                    class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="clearNoteModal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="p-6 text-center">
                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to
                        revert all changes to this note?</h3>
                    <button type="button" wire:click="clearNote"
                        class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                        Yes, I'm sure
                    </button>
                    <button data-modal-hide="clearNoteModal" type="button"
                        class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No,
                        cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>
