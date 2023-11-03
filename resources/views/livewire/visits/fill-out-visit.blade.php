<div class="max-w-7xl mx-auto my-6">
    <div class="m-8 my-16 flex justify-center">
        <div class="relative shadow p-8 m-auto bg-white rounded-lg">
            <div style="width: 936px; height: 1150px; font-size: 14px;"
                class="preview-visit" id="drawPane">
                <div style="width: 100%; border-bottom: 2px solid black; padding-bottom: 16px;">
                    <div class="flex">
                        <div style="width: 150%;">
                            @if (auth()->user()->currentTeam->logo)
                                <img src="/storage/{{ auth()->user()->currentTeam->logo }}" alt=""
                                    style="height: 85px; width: auto; object-fit: contain; filter: grayscale(100%); margin: 0 8px;">
                            @endif
                        </div>
                        <div style="text-align: left; width: 100%;" class="flex">
                            <div style="width: 100%;" class="flex">
                                <div class="flex-1">
                                    <div style="font-size: 14px; font-weight: 900; margin-bottom: 4px;" class="text-size-1">
                                        Patient Name:
                                        {{ $visit->first_name }}
                                        {{ $visit->last_name }}
                                    </div>
                                    <div style="font-size: 14px; margin-bottom: 4px; font-weight: 900;" class="text-size-1">
                                        MRN : {{ $visit->id }} &nbsp;&nbsp;&nbsp;DOB:
                                        {{ date('m/d/Y', strtotime($visit->birthdate)) }}
                                    </div>
                                    <div style="font-size: 14px; margin-bottom: 4px; font-weight: 900;" class="text-size-1">
                                        Date of Visit: {{ date('m/d/Y', strtotime($visit->visit_at)) }}
                                    </div>
                                    <div style="font-size: 14px; font-weight: 900;" class="text-size-1">
                                        Provider : Waddell, Ben MD
                                    </div>
                                </div>
                                <div style="padding-left: 4px; text-align: right; min-width: 120px;">
                                    {{ QrCode::size(80)->generate(json_encode(['visit_id' => $visit->id, 'user_id' => auth()->user()->id])) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="padding: 0 16px; font-size: 14px; padding-top: 24px;">
                    <div class="flex">
                        <div style="width: 100%; vertical-align: baseline;">
                            <div style="width: {{ $visit->visitType->third_column_enabled ? 420 : 640 }}px;">
                                {{ jsonToHtml($visit->visitType->content) }}
                            </div>
                        </div>
                        @if ($visit->visitType->third_column_enabled)
                            <div style="width: 100%; vertical-align: baseline; background: white; z-index: 2;">
                                <div
                                    style="width: 192px; border-left: 1px solid #333; padding: 2px 0; padding-left: 12px; margin-left: 12px; margin-top: 60px; height: 855px;">
                                    {{ jsonToHtml($visit->visitType->second_content) }}
                                </div>
                            </div>
                        @endif
                        <div style="vertical-align: baseline; background: white; padding-left: 12px;">
                            <div
                                style="border-left: 1px solid #333; font-size: 1.125rem; width: 198px; padding-left: 16px; margin-top: 60px;">
                                @if (count($selected_vitals) > 0)
                                    <div style="margin-bottom: 16px;">
                                        <p style="font-size: 16px; font-weight: bold; margin-bottom: 4px;"
                                            class="text-size-2">
                                            Vital
                                            Signs</p>
                                        @foreach ($selected_vitals as $key => $value)
                                            <div style="font-size: 16px; line-height: 1;">
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
                                                            _________
                                                        @else
                                                            __________
                                                        @endif
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                                @if (count($selected_histories) > 0)
                                    <div style="margin-bottom: 8px;">
                                        @foreach ($selected_histories as $key => $value)
                                            <div style="margin: 16px 0; font-size: 14px;">
                                                <div class="flex items-center" style="z-index: 30;">
                                                    <input id="default-checkbox" type="checkbox" value=""
                                                        style="z-index: 30;"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                    <label for="default-checkbox"
                                                        class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                                        {{ formatString($key) }}
                                                    </label>
                                                </div>
                                                <p style="margin: 0 !important">
                                                    (mark reviewed)
                                                </p>
                                                <div
                                                    style="background-color: #f0f0f0; border-top: 1px dashed #aaa; border-bottom: 1px dashed #aaa; min-height: 100px; margin: 4px 0; padding: 4px 12px; margin-top: 8px;">
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div style="margin-bottom: 6px; text-align: right; margin-left: 10px;" class="flex mt-6">
                        <div style="width: 50%;">
                            @if (isset($selected_elements['signature']) && $selected_elements['signature'])
                                Signature: ______________________________________
                            @endif
                        </div>
                        <div style="width: 25%; text-align: right;">
                            @if (isset($selected_elements['time']) && $selected_elements['time'])
                                Time: ________________
                            @endif
                        </div>
                        <div style="width: 25%; text-align: right;">
                            @if (isset($selected_elements['date']) && $selected_elements['date'])
                                Date: ________________
                            @endif
                        </div>
                    </div>
                    <div style="width: 100%; border-top: 2px solid black; color: #333;" class="mt-8">
                        <div class="flex justify-between">
                            <div>
                                Copyright 2023 Papercharts.ai
                            </div>
                            <div style="text-align: right;">
                                {{ isset(auth()->user()->currentTeam->name) ? auth()->user()->currentTeam->name : '' }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="absolute right-0 left-0 top-0 bottom-0" style="z-index: 10;">
                    <canvas id="sig" width="1000" height="1210"></canvas>
                </div>
            </div>
        </div>
        <div class="mx-4 sticky top-4 h-full">
            <div>
                <button type="button" id="undo"
                    class="text-white flex items-center gap-2 bg-yellow-400 hover:bg-yellow-500 focus:outline-none focus:ring-4 focus:ring-yellow-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 15l6-6m0 0l-6-6m6 6H9a6 6 0 000 12h3" />
                    </svg>
                    Undo
                </button>
            </div>
            <div>
                <button type="button" id="clear"
                    class="text-white flex items-center gap-2 bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                    </svg>
                    Clear
                </button>
            </div>
        </div>
    </div>
    <div class="flex justify-end mt-6 px-6">
        <button type="button" onclick="backToPage()"
            class="py-2.5 px-5 mr-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200">
            Cancel
        </button>
        <button type="submit" id="submitBtn"
            class="flex gap-1 items-center text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">
            Submit
        </button>
    </div>
</div>

@push('footer-scripts')
    <script>
        var signaturePad = new SignaturePad(document.getElementById('sig'), {
            backgroundColor: 'rgba(255, 255, 0, 0)',
            penColor: 'rgb(0, 0, 0)',

        });
        document.getElementById('undo').addEventListener('click', function() {
            var data = signaturePad.toData();
            if (data) {
                data.pop(); // remove the last dot or line
                signaturePad.fromData(data);
            }
        });
        document.getElementById('clear').addEventListener('click', function() {
            signaturePad.clear();
        });

        document.getElementById('submitBtn').addEventListener('click', function() {

            html2canvas(document.getElementById('drawPane'), {
                background: '#ffffff'
            }).then(canvas => {
                var imgData = canvas.toDataURL('image/jpeg');
                Livewire.emit('submitImage', imgData);
            });
        });

        function backToPage() {
            window.location.href = '/dashboard';
        }

        Livewire.on('backToVisits', function() {
            backToPage();
        });

    </script>
@endpush
