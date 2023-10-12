<div class="absolute top-0 left-0 w-full h-full bg-white"
    style="z-index: 1000; transition: top ease .3s; {{ $isShow ? '' : 'top: 100% !important; display: none;' }}">
    <div class="absolute" style="right: 24px; top: 24px;">
        <button type="button" wire:click="hideComp()"
            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-full text-sm w-8 h-8 ml-auto inline-flex justify-center items-center"
            data-modal-hide="addVisitModal">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">Close modal</span>
        </button>
    </div>
    <div class="p-10 m-8 flex justify-center">
        <div class="border border-gray rounded-lg overflow-x-auto" style="width: 795px; font-size: 14px;">
            <div class="flex p-10" style="">
                <div class="flex-1 flex">
                    @if ($editorId)
                        <div>
                            @livewire('editorjs', [
                                'editorId' => $editorId,
                                'value' => $view_template,
                                'uploadDisk' => 'public',
                                'downloadDisk' => 'public',
                                'placeholder' => 'Type Content',
                                'readOnly' => true,
                                'class' => 'full-editor-preview mr-4',
                                'style' => $third_column_enabled ? 'width: 345px;' : 'width: 490px;',
                            ])
                        </div>
                    @endif
                    @if ($third_column_enabled)
                        @livewire('editorjs', [
                            'editorId' => $editorId . '-second-column',
                            'value' => $second_column_content,
                            'uploadDisk' => 'public',
                            'downloadDisk' => 'public',
                            'placeholder' => 'Type Content',
                            'readOnly' => true,
                            'class' => 'full-editor-preview border-l border-black',
                            'style' => 'width: 180px; padding-left: 12px; margin-top: 48px;',
                        ])
                    @endif
                </div>
                <div class="border-l border-black" style="width: 180px; padding-left: 16px; margin-left: 16px; margin-top: 48px;">
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
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
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
            <div class="mb-8 flex gap-3 text-black justify-end mx-10" style="font-weight: 700">
                @foreach (['signature', 'time', 'date'] as $key)
                    <div class="text-md {{ $key == 'signature' ? 'flex-2' : 'flex-1 text-right' }}">
                        @if (isset($selected_elements[$key]) && $selected_elements[$key])
                            {{ formatString($key) }}: _______________{{ $key == 'signature' ? '_______________' : '' }}
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
