<html>

<head>
    <style>
        /** Define the margins of your page **/
        @page {
            size: A4;
            margin: 48px 24px;
            margin-bottom: 144px;
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
            bottom: -48px;
            left: 0px;
            right: 0px;
            height: 48px;
            font-size: 12px !important;

            /** Extra personal styles **/            
            text-align: center;
            line-height: 24px;
            font-weight: 900
        }

        main p, main div {
            font-size: 12px;
        }
    </style>

</head>

<body>
    <!-- Define header and footer blocks before your content -->
    <!-- Wrap the content of your PDF inside a main tag -->

    <footer>
        <div style="margin-bottom: 24px; text-align: right; margin-left: 10px;">
            <?php
            foreach ($selected_elements as $key => $value) {
                if ($value) {
                    echo '<div style="display: inline-block; margin-left: 3px; margin-right: 3px; text-align: left;">';
                    echo formatString($key) . ': ';
                    if ($key == 'signature') {
                        echo '_______________';
                    }
                    echo '_______________</div>';
                }
            }
            ?>
        </div>
        <table style="width: 100%; border-top: 2px solid black; color: #333;">
            <tr>
                <td>
                    Copyright 2023 Papercharts.ai
                </td>
                <td style="text-align: right;">
                    {{ auth()->user()->currentTeam->name }}
                </td>
            </tr>
        </table>
    </footer>

    <main>
        @foreach ($visits as $key => $visit)
            <div style="{{ $key < count($visits) - 1 ? 'page-break-after: always;' : '' }}">
                <table style="width: 100%; border-bottom: 2px solid black; height: 96px;">
                    <tr>
                        <td style="width: 150%">
                            @if (auth()->user()->currentTeam->logo)
                                <img src="./storage/{{ auth()->user()->currentTeam->logo }}" alt=""
                                    style="height: 75px; width: auto; object-fit: contain; filter: grayscale(100%);">
                            @endif
                        </td>
                        <td style="text-align: left; width: 100%;">
                            <table style="width: 100%;">
                                <tr style="width: 100%;">
                                    <td style="width: 100%">
                                        <div style="font-size: 15px; font-weight: 900; margin-bottom: 4px;">
                                            Patient Name:
                                            {{ $visit->first_name }}
                                            {{ $visit->last_name }}
                                        </div>
                                        <div style="font-size: 12px; margin-bottom: 8px; font-weight: 900;">
                                            MRN : {{ $visit->id }} &nbsp;&nbsp;&nbsp;DOB:
                                            {{ date('m/d/Y', strtotime($visit->birthdate)) }}
                                        </div>
                                        <div style="font-size: 12px; margin-bottom: 8px; font-weight: 900;">
                                            Date of Visit: {{ date('m/d/Y', strtotime($visit->visit_at)) }}
                                        </div>
                                        <div style="font-size: 12px; font-weight: 900;">
                                            Provider : Waddell, Ben MD
                                        </div>
                                    </td>
                                    <td style="width: 62px; padding-left: 4px; text-align: right;">
                                        <img src="data:image/png;base64, {!! base64_encode(QrCode::size(75)->generate(json_encode(["visit_id" => $visit->id,"user_id" => auth()->user()->id]))) !!}" width="62px"
                                            height="62px">
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
                                <div style="max-width: 490px; overflow-x: hidden;">
                                    {{ jsonToHtml($visit->visitType->content) }}
                                </div>
                            </td>
                            <td style="vertical-align: baseline; background: white; padding-left: 20px;">
                                <div
                                    style="border-left: 2px solid #333; font-size: 1.125rem; width: 200px; padding-left: 16px; margin-top: 24px;">
                                    @if (count($selected_vitals) > 0)
                                        <div style="margin-bottom: 16px;">
                                            <p style="margin-bottom: 16px; font-weight: bold;">Vital Signs</p>
                                            @foreach ($selected_vitals as $key => $value)
                                                <div style="font-size: 16px; line-height: 1;">
                                                    <p style="margin: 4px 0;">
                                                        {{ formatString($key) }}
                                                    </p>
                                                    <div
                                                        style="background-color: #f0f0f0; border-top: 1px dashed #aaa; border-bottom: 1px dashed #aaa; min-height: 30px; margin-top: 4px; margin-bottom: 4px; padding-top: 4px; padding-right: 12px; padding-bottom: 4px; padding-left: 12px;">
                                                        <p>
                                                            @if ($key == 'blood_pressure')
                                                                __________/_________
                                                            @endif
                                                            @if ($key == 'Height/Weight')
                                                                ________ inches ________ lbs
                                                            @endif
                                                        </p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                    @if (count($selected_histories) > 0)
                                        <div style="margin-bottom: 16px;">
                                            <p style="margin-bottom: 16px; font-weight: bold;">History(s)</p>
                                            @foreach ($selected_histories as $key => $value)
                                                <div style="font-size: 16px;">
                                                    <p style="margin: 4px 0;">
                                                        [&nbsp;&nbsp;] {{ formatString($key) }} (mark reviewed)
                                                    </p>
                                                    <div
                                                        style="background-color: #f0f0f0; border-top: 1px dashed #aaa; border-bottom: 1px dashed #aaa; min-height: 50px; margin: 4px 0; padding: 4px 12px;">
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
