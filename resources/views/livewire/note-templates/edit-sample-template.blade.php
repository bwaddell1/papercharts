<div>

    <form wire:submit.prevent="save">
        <div class="mx-auto my-6 bg-white rounded-lg shadow" style="margin-top: 40px; width: 940px;">
            <div class="block lg:flex justify-center">
                <div class="flex p-10">
                    <div class="flex-1" style="width: 750px;">
                        @livewire('editorjs', [
                            'editorId' => 'sample',
                            'value' => $template_content,
                            'uploadDisk' => 'public',
                            'downloadDisk' => 'public',
                            'placeholder' => 'Type Content',
                            'readOnly' => false,
                            'class' => 'full-editor',
                        ])
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
                                            style="min-height: 75px; margin: 4px 0; border-style: dashed; border-color: #aaa; padding: 4px 12px;">
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
