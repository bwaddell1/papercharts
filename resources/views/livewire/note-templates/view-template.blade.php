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
    <div class="p-10 m-8">
        <div class="border border-gray rounded-lg overflow-x-auto">
            <div class="flex p-10" style="min-width: 900px;">
                <div class="flex-1">
                    @if ($editorId)
                        @livewire('editorjs', [
                            'editorId' => $editorId,
                            'value' => $view_template,
                            'uploadDisk' => 'public',
                            'downloadDisk' => 'public',
                            'placeholder' => 'Type Content',
                            'readOnly' => true,
                            'class' => 'full-editor',
                        ])
                    @endif
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
            <div class="mt-16 mb-8 flex gap-3 text-gray-500 justify-end mx-10">
                @foreach ($selected_elements as $key => $value)
                    @if ($value)
                        <div class="text-md">
                            {{ formatString($key) }}: _______________{{ $key == 'signature' ? '_______________' : '' }}
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</div>
