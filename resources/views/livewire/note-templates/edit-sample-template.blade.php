<div>

    <div class="mt-6">
        <div class="mx-auto px-8 xl:px-5 flex justify-between bg-white p-8 shadow rounded-lg mb-8 items-center" style="width: 900px;">
            <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-gray-200 dark:border-gray-700 dark:text-gray-400">
                <li class="mr-2">
                    <a href="{{ route('wave.templates.edit', $template->id) }}" aria-current="page" class="inline-block p-4 rounded-t-lg hover:text-gray-600 hover:bg-gray-50">Note
                        Template</a>
                </li>
                <li class="mr-2">
                    <a href="#" class="inline-block p-4 text-blue-600 bg-gray-200 rounded-t-lg active">Sample
                        Template</a>
                </li>
            </ul>
        </div>
    </div>

    <form wire:submit.prevent="save">
        <div class="mx-auto my-6 bg-white rounded-lg shadow" style="margin-top: 40px; width: 900px;">
            <div class="block lg:flex justify-center">
                <div class="flex p-10">
                    <div class="flex-1">
                        @livewire('editorjs', [
                        'editorId' => 'sample',
                        'value' => $template_content,
                        'uploadDisk' => 'public',
                        'downloadDisk' => 'public',
                        'placeholder' => 'Type sample note template',
                        'readOnly' => false,
                        'class' => 'text-editor',
                        'style' => 'width: 870px;',
                        ])
                    </div>
                </div>
            </div>
        </div>
        <div class="flex justify-end mt-6 px-6" style="margin: 40px auto; max-width: 900px;">
            <button type="submit" class="flex gap-1 items-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                </svg>
                Save
            </button>
        </div>
    </form>
</div>
