<div>

    <div class="mt-6">
        <div class="mx-auto px-8 xl:px-5 flex justify-between bg-white p-8 shadow rounded-lg mb-8 items-center"
            style="width: {{ $allow_third_column ? 1030 : 900 }}px;">
            <ul
                class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-gray-200 dark:border-gray-700 dark:text-gray-400">
                <li class="mr-2">
                    <a href="{{ route('wave.templates.edit', $template->id) }}" aria-current="page"
                        class="inline-block p-4 rounded-t-lg hover:text-gray-600 hover:bg-gray-50">Note
                        Template</a>
                </li>
                <li class="mr-2">
                    <a href="#"
                        class="inline-block p-4 text-blue-600 bg-gray-200 rounded-t-lg active">Sample
                        Template</a>
                </li>
            </ul>
        </div>
    </div>

    <form wire:submit.prevent="save">
        <div class="mx-auto my-6 bg-white rounded-lg shadow"
            style="margin-top: 40px; width: {{ $allow_third_column ? 1030 : 900 }}px;">
            <div class="block lg:flex justify-center">
                <div class="flex p-10">
                    <div class="flex-1">
                        @livewire('editorjs', [
                            'editorId' => 'sample',
                            'value' => $template_content,
                            'uploadDisk' => 'public',
                            'downloadDisk' => 'public',
                            'placeholder' => 'Type Content',
                            'readOnly' => false,
                            'class' => 'full-editor',
                            'style' => $allow_third_column ? 'width: 425px;' : 'width: 570px;',
                        ])
                    </div>
                    @if ($allow_third_column)
                        <div class="mt-16 border-l border-black">
                            @livewire('editorjs', [
                                'editorId' => 'sample_second_column',
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
                    <div class="border-l border-black"
                        style="width: 180px; padding-left: 16px; margin-left: 16px; margin-top: 48px;">
                        @if (count($selected_vitals) > 0)
                            <div class="mb-8">
                                <p class="font-bold" style="font-size: 16px;">Vital Signs</p>
                                @foreach ($selected_vitals as $key => $value)
                                    <div style="padding: 5px 0;">
                                        @if ($key == 'Height/Weight')
                                            Height ________ inches
                                            <div style="height: 8px"></div>
                                            Weight ________ lbs
                                        @elseif ($key == 'height')
                                            ________ inches
                                        @elseif ($key == 'weight')
                                            ________ lbs
                                        @else
                                            {{ formatString($key) }}
                                            @if ($key == 'respiratory_rate')
                                                ________
                                            @else
                                                __________
                                            @endif
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        @if (count($selected_histories) > 0)
                            <div class="mb-4">
                                @foreach ($selected_histories as $key => $value)
                                    <div>
                                        <div class="flex">
                                            <div class="cdx-checklist__item-checkbox" style="margin-right: 4px;">
                                                <span class="cdx-checklist__item-checkbox-check">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" fill="none" viewBox="0 0 24 24">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-width="2"
                                                            d="M7 12L10.4884 15.8372C10.5677 15.9245 10.705 15.9245 10.7844 15.8372L17 9">
                                                        </path>
                                                    </svg>
                                                </span>
                                            </div>
                                            {{ formatString($key) }}
                                        </div>
                                        (mark reviewed)
                                        <div class="bg-gray-100 border-t border-b flex items-center"
                                            style="min-height: 100px; margin: 4px 0; border-style: dashed; border-color: #aaa; padding: 4px 12px; margin-top: 8px;">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="pb-10 flex gap-3 text-gray-500 justify-end mx-10">
                @foreach ($selected_elements as $key => $value)
                    @if ($value)
                        <div class="text-md">
                            {{ formatString($key) }}: _______________{{ $key == 'signature' ? '_______________' : '' }}
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
        <div class="flex justify-end mt-6 px-6" style="margin: 40px auto; max-width: 900px;">
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
</div>
