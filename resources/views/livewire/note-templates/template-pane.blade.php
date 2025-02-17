<div class="max-w-7xl mx-auto my-6" style="margin-top: 40px;">

    <div class="mt-6">
        <div class="mx-auto px-8 xl:px-5 flex justify-between bg-white p-8 shadow rounded-lg mb-8 items-center" style="width: {{$allow_third_column ? 1030 : 900}}px;">
            <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-gray-200 dark:border-gray-700 dark:text-gray-400">
                <li class="mr-2">
                    <a href="#" aria-current="page" class="inline-block p-4 text-blue-600 bg-gray-200 rounded-t-lg active">Note
                        Template</a>
                </li>
                @if($mode != 'create')
                <li class="mr-2">
                    <a href="{{ route('wave.templates.sample.edit', $template->id) }}" class="inline-block p-4 rounded-t-lg hover:text-gray-600 hover:bg-gray-50 dark:hover:bg-gray-800 dark:hover:text-gray-300">Sample
                        Template</a>
                </li>
                @endif
            </ul>
            <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-gray-200 dark:border-gray-700 dark:text-gray-400">
                <li class="mr-2">
                    <a href="?allow_third_column=false" aria-current="page" class="inline-block p-4 rounded-t-lg {{!$allow_third_column ? 'text-blue-600 bg-gray-200 active' : 'hover:text-gray-600 hover:bg-gray-50'}}">Two Column
                        Template</a>
                </li>
                <li class="mr-2">
                    <a href="?allow_third_column=true" class="inline-block p-4 rounded-t-lg {{$allow_third_column ? 'text-blue-600 bg-gray-200 active' : 'hover:text-gray-600 hover:bg-gray-50'}}">Three
                        Column
                        Template</a>
                </li>
            </ul>
        </div>
    </div>

    <form wire:submit.prevent="save">
        <div class="block lg:flex justify-center">
            <div class="bg-white shadow flex flex-col px-8 xl:px-5 py-12 pb-4 flex-1 mx-4" style="max-width: {{$allow_third_column ? 800 : 670}}px;">
                <div class="flex justify-end">
                    <div class="flex gap-1 justify-center items-center flex-wrap mr-6">
                        @foreach ($specialties as $specialty)
                        @if (in_array($specialty->id, $selected_specialties))
                        <span id="badge_{{ $specialty->id }}" style="color: {{ $specialty->color }}; background: {{ $specialty->bg_color }}" class="inline-flex items-center px-2 py-1 mr-2 text-sm font-medium rounded">
                            {{ $specialty->name }}
                            <button type="button" wire:click="set_specialty('{{ $specialty->id }}')" class="inline-flex items-center p-1 ml-2 text-sm text-white-400 bg-transparent rounded-sm">
                                <svg class="w-2 h-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Remove badge</span>
                            </button>
                        </span>
                        @endif
                        @endforeach
                    </div>
                    <div class="relative">
                        <div class="fixed {{ $collapseDropdown ? 'hidden' : '' }} top-0 left-0 right-0 bottom-0" style="z-index: 100" wire:click="hideDropDown"></div>
                        <button wire:click.prevent.stop="$toggle('collapseDropdown')" class="relative border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-52 py-2.5 px-4 inline-flex items-center justify-between" style="z-index: 101;" type="button">
                            Select Specialties
                            <svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>
                        </button>
                        <!-- Dropdown menu -->
                        <div id="dropdownHover" class="z-10 {{ $collapseDropdown ? 'hidden' : '' }} bg-white divide-y divide-gray-100 rounded-lg shadow w-56" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(-8px, 52px); z-index: 101;">
                            <ul class="py-2 text-sm text-gray-700">
                                @foreach ($specialties as $specialty)
                                <li>
                                    <div class="flex items-center ml-6">
                                        <input id="{{ $specialty->id }}" type="checkbox" {{ in_array($specialty->id, $selected_specialties) ? 'checked' : '' }} wire:change.debounce.200ms="set_specialty('{{ $specialty->id }}')" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                        <label for="{{ $specialty->id }}" class="ml-2 flex px-4 py-2">
                                            <span class="text-xs font-medium mr-2 px-2.5 py-0.5 rounded select-none" style="color: {{ $specialty->color }}; background: {{ $specialty->bg_color }}">
                                                {{ $specialty->name }}
                                            </span>
                                        </label>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="border border-gray-100 rounded flex pb-8" style="margin: 0 24px; margin-top: 16px; font-size: 14px;">
                    <div>
                        @livewire('editorjs', [
                        'editorId' => 'template',
                        'value' => $template_content,
                        'uploadDisk' => 'public',
                        'downloadDisk' => 'public',
                        'placeholder' => 'Type Content',
                        // 'readOnly' => false,
                        'class' => 'full-editor',
                        'style' => $allow_third_column ? 'width: 425px;' : 'width: 570px;',
                        ])
                    </div>
                    @if ($allow_third_column)
                    <div class="mt-16 border-l border-black">
                        @livewire('editorjs', [
                        'editorId' => 'template_second_column',
                        'value' => $template_second_column_content,
                        'uploadDisk' => 'public',
                        'downloadDisk' => 'public',
                        'placeholder' => 'Type Second Column Content',
                        // 'readOnly' => false,
                        'class' => 'full-editor',
                        'style' => 'width: 285px;',
                        ])
                    </div>
                    @endif
                </div>
            </div>

            <div class="bg-white shadow flex justify-between mx-4 mt-8 lg:mt-0 items-center" style="flex-direction: column; height: fit-content; max-width: 195px;">
                <div class="w-full">
                    <p class="text-lg py-4 text-semibold mt-2 px-8 lg:px-4">
                        Vitals
                    </p>
                    <ul class="w-full lg:w-48 text-sm font-medium text-gray-900 bg-gray-50 py-2 px-8 lg:px-0">
                        @foreach ($vitals as $vital)
                        <li class="w-full rounded-t-lg">
                            <div class="flex items-center pl-3">
                                <input id="{{ $vital }}" type="checkbox" wire:model.debounce.200ms="selected_vitals.{{ $vital }}" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                <label for="{{ $vital }}" class="w-full py-2 ml-2 text-sm font-medium text-gray-700">
                                    {{ formatString($vital) }}
                                </label>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                    <p class="text-lg py-4 text-semibold mt-2 px-8 lg:px-4">
                        History(s)
                    </p>
                    <ul class="w-full lg:w-48 text-sm font-medium text-gray-900 bg-gray-50 py-2 px-8 lg:px-0">
                        @foreach ($histories as $history)
                        <li class="w-full rounded-t-lg dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input id="{{ $history }}" type="checkbox" wire:model="selected_histories.{{ $history }}" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                <label for="{{ $history }}" class="w-full py-2 ml-2 text-sm font-medium text-gray-700">
                                    {{ formatString($history) }}
                                </label>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="w-full mt-16">
                    <ul class="w-full lg:w-48 text-sm font-medium text-gray-900 bg-gray-50 py-2">
                        <p class="text-lg py-2 text-semibold mt-2 px-8 lg:px-4">
                            Footer
                        </p>
                        @foreach ($footer_elements as $footer_element)
                        <li class="w-full rounded-t-lg px-8 lg:px-0">
                            <div class="flex items-center pl-3 py-2">
                                <input id="{{ $footer_element }}" type="checkbox" wire:model.debounce.200ms="selected_elements.{{ $footer_element }}" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                <label for="{{ $footer_element }}" class="w-full py-2 ml-2 text-sm font-medium text-gray-700">
                                    {{ formatString($footer_element) }}
                                </label>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="flex justify-end mt-6 px-6">
            @if ($mode != 'create')
            <button type="button" onclick="openDeleteNoteTemplate({{ $template->id }})" class="flex gap-1 items-center focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                </svg>
                Delete
            </button>
            @endif
            {{-- <a type="button" href="{{route("wave.templates.edit", $template->id)}}"
            class="{{ $mode == "edit" ? 'disabled' : ""}} flex gap-1 items-center text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
            </svg>
            Edit
            </a> --}}
            <button type="button" wire:click="handleShowVisit" class="flex gap-1 items-center text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244" />
                </svg>
                View
            </button>
            <button type="submit" class="flex gap-1 items-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                </svg>
                Save
            </button>
        </div>
    </form>

    @livewire('note-templates.view-template')

    <script>
        window.openDeleteNoteTemplate = function(template_id) {
            Alpine.store('deleteNoteTemplateModal').openModal();
            Livewire.emit('deleteNoteTemplate', template_id);
        }
    </script>
</div>
