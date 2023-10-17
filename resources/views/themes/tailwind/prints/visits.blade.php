<html>

<head>
    <style>
        /** Define the margins of your page **/
        @page {
            size: A4;
            margin: 32px 24px;
            margin-bottom: 80px;
            font-family: Arial;
        }

        header {
            position: fixed;
            top: -50px;
            left: 0px;
            right: 0px;
            height: 75px;
            font-size: 20px !important;

            /** Extra personal styles **/
            border-bottom: 2px solid black;
            color: black;
            text-align: center;
            line-height: 35px;
            display: flex;
            justify-content: space-between;
        }

        footer {
            position: fixed;
            bottom: -44px;
            left: 0px;
            right: 0px;
            height: 48px;
            font-size: 12px !important;

            /** Extra personal styles **/
            text-align: center;
            line-height: 24px;
            font-weight: 900
        }

        main p,
        main div {
            font-size: 14px;
        }
    </style>

</head>

<body>
    <!-- Define header and footer blocks before your content -->
    <!-- Wrap the content of your PDF inside a main tag -->

    <footer>
        <div style="margin-bottom: 6px; text-align: right; margin-left: 10px;">
            <table style="width: 100%;">
                <tr>
                    <td style="width: 50%;">
                        @if (isset($selected_elements['signature']) && $selected_elements['signature'])
                            Signature: ______________________________
                        @endif
                    </td>
                    <td style="width: 25%; text-align: right;">
                        @if (isset($selected_elements['time']) && $selected_elements['time'])
                            Time: ____________
                        @endif
                    </td>
                    <td style="width: 25%; text-align: right;">
                        @if (isset($selected_elements['date']) && $selected_elements['date'])
                            Date: ____________
                        @endif
                    </td>
                </tr>
            </table>
        </div>
        <table style="width: 100%; border-top: 2px solid black; color: #333;">
            <tr>
                <td>
                    Copyright 2023 Papercharts.ai
                </td>
                <td style="text-align: right;">
                    {{ isset(auth()->user()->currentTeam->name) ? auth()->user()->currentTeam->name : "" }}
                </td>
            </tr>
        </table>
    </footer>

    <main>
        @foreach ($visits as $key => $visit)
            <div style="{{ $key < count($visits) - 1 ? 'page-break-after: always;' : '' }}">
                <table style="width: 100%; border-bottom: 2px solid black; height: 80px; margin-bottom: 16px;">
                    <tr>
                        <td style="width: 150%">
                            @if (auth()->user()->currentTeam->logo)
                                <img src="./storage/{{ auth()->user()->currentTeam->logo }}" alt=""
                                    style="height: 65px; width: auto; object-fit: contain; filter: grayscale(100%);">
                            @endif
                        </td>
                        <td style="text-align: left; width: 100%;">
                            <table style="width: 100%;">
                                <tr style="width: 100%;">
                                    <td style="width: 100%">
                                        <div style="font-size: 12px; font-weight: 900; margin-bottom: 4px;">
                                            Patient Name:
                                            {{ $visit->first_name }}
                                            {{ $visit->last_name }}
                                        </div>
                                        <div style="font-size: 12px; margin-bottom: 4px; font-weight: 900;">
                                            MRN : {{ $visit->id }} &nbsp;&nbsp;&nbsp;DOB:
                                            {{ date('m/d/Y', strtotime($visit->birthdate)) }}
                                        </div>
                                        <div style="font-size: 12px; margin-bottom: 4px; font-weight: 900;">
                                            Date of Visit: {{ date('m/d/Y', strtotime($visit->visit_at)) }}
                                        </div>
                                        <div style="font-size: 12px; font-weight: 900;">
                                            Provider : Waddell, Ben MD
                                        </div>
                                    </td>
                                    <td style="width: 50px; padding-left: 4px; text-align: right;">
                                        <img src="data:image/png;base64, {!! base64_encode(
                                            QrCode::size(62)->generate(json_encode(['visit_id' => $visit->id, 'user_id' => auth()->user()->id])),
                                        ) !!}" width="50px"
                                            height="50px">
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                <div style="padding: 0 16px; font-size: 14px;">
                    <table style="width: 100%;">
                        <tr>
                            <td style="width: 100%; vertical-align: baseline;">
                                <div style="width: {{ $visit->visitType->third_column_enabled ? 340 : 490 }}px;">
                                    {{ jsonToHtml($visit->visitType->content) }}
                                </div>
                            </td>
                            @if ($visit->visitType->third_column_enabled)
                                <td style="width: 100%; vertical-align: baseline; background: white; z-index: 2;">
                                    <div
                                        style="width: 154px; border-left: 1px solid #333; padding: 2px 0; padding-left: 12px; margin-left: 12px; margin-top: 60px; height: 815px;">
                                        {{ jsonToHtml($visit->visitType->second_content) }}
                                    </div>
                                </td>
                            @endif
                            <td style="vertical-align: baseline; background: white; padding-left: 12px; z-index: 3;">
                                <div
                                    style="border-left: 1px solid #333; font-size: 1.125rem; width: 166px; padding-left: 16px; margin-top: 60px;">
                                    @if (count($selected_vitals) > 0)
                                        <div style="margin-bottom: 16px;">
                                            <p style="font-size: 16px; font-weight: bold; margin-bottom: 4px;">Vital
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
                                        <div style="margin-bottom: 16px;">
                                            @foreach ($selected_histories as $key => $value)
                                                <div style="margin: 4px 0;">
                                                    <div class="margin-bottom: 0;">
                                                        <img src="./wave/checkbox.png" width="12px" height="12px" />
                                                        <span>
                                                            {{ formatString($key) }}
                                                        </span>
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
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        @endforeach
    </main>

</body>

</html>
