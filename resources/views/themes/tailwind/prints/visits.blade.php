<html>

<head>
    <style>
        /** Define the margins of your page **/
        @page {
            margin: 40px;
            margin-bottom: 100px;
        }

        header {
            position: fixed;
            top: -80px;
            left: 0px;
            right: 0px;
            height: 75px;
            font-size: 20px !important;

            /** Extra personal styles **/
            border-bottom: 2px solid #008B8B;
            color: black;
            text-align: center;
            line-height: 35px;
            display: flex;
            justify-content: space-between;
        }

        footer {
            position: fixed;
            bottom: -80px;
            left: 0px;
            right: 0px;
            height: 75px;
            font-size: 16px !important;

            /** Extra personal styles **/
            border-top: 2px solid #008B8B;
            color: #aaa;
            text-align: center;
            line-height: 35px;
            font-weight: 900
        }
    </style>

</head>

<body>
    <!-- Define header and footer blocks before your content -->
    <!-- Wrap the content of your PDF inside a main tag -->

    <footer>
        <table style="width: 100%;">
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
        <?php
        function jsonToHtml($jsonStr)
        {
            $obj = json_decode($jsonStr);
        
            $html = '';
            foreach ($obj->blocks as $block) {
                switch ($block->type) {
                    case 'paragraph':
                        $html .= '<p style="text-align: ' . $block->data->alignment . '">' . $block->data->text . '</p>';
                        break;
        
                    case 'header':
                        $html .= '<h' . $block->data->level . '>' . $block->data->text . '</h' . $block->data->level . '>';
                        break;
        
                    case 'raw':
                        $html .= $block->data->html;
                        break;
        
                    case 'list':
                        $lsType = $block->data->style == 'ordered' ? 'ol' : 'ul';
                        $html .= '<' . $lsType . '>';
                        foreach ($block->data->items as $item) {
                            $html .= '<li>' . $item . '</li>';
                        }
                        $html .= '</' . $lsType . '>';
                        break;
        
                    case 'code':
                        $html .= '<pre><code class="language-' . $block->data->lang . '">' . $block->data->code . '</code></pre>';
                        break;
        
                    case 'image':
                        $html .= '<div class="img_pnl"><img src="' . $block->data->file->url . '" /></div>';
                        break;
        
                    case 'checklist':
                        $html .= '<div class="ce-block__content"><div class="cdx-block cdx-checklist">';
                        foreach ($block->data->items as $item) {
                            $checkbox = !$item->checked ? '<img src="./wave/checkbox.png" width="18px" height="18px" />' : '<img src="./wave/checkedbox.png" width="18px" height="18px" />';
                            $html .= '<div style="margin: 8px 0;">' . $checkbox . '<div style="display: inline-block; margin-left: 6px;" contenteditable="true">' . $item->text . '</div></div>';
                        }
                        $html .= '</div></div>';
                        break;
        
                    default:
                        break;
                }
            }
        
            $doc = new DOMDocument();
            $doc->loadHTML($html);
            echo $doc->saveHTML();
        }
        ?>
        @foreach ($visits as $key => $visit)
            <div style="{{ $key < count($visits) - 1 ? 'page-break-after: always;' : '' }}">
                <table style="width: 100%; border-bottom: 2px solid #377da2;">
                    <tr>
                        <td style="width: 65%">
                            @if (auth()->user()->currentTeam->logo)
                                <img src="./storage/{{ auth()->user()->currentTeam->logo }}" alt=""
                                    style="height: 75px; width: auto; object-fit: contain;">
                            @endif
                        </td>
                        <td style="text-align: left;">
                            <table>
                                <tr>
                                    <td>
                                        <div style="font-size: 14px;">
                                            Patient Name:
                                            {{ $visit->first_name }}
                                            {{ $visit->last_name }}
                                        </div>
                                        <div style="font-size: 10px; margin-bottom: 8px;">
                                            MRN : {{ $visit->id }} &nbsp;&nbsp;&nbsp;DOB:
                                            {{ date('m/d/Y', strtotime($visit->birthdate)) }}
                                        </div>
                                        <div style="font-size: 10px; margin-bottom: 8px;">
                                            Date of Visit: {{ date('m/d/Y', strtotime($visit->visit_at)) }}
                                        </div>
                                        <div style="font-size: 10px;">
                                            Provider : Waddell, Ben MD
                                        </div>
                                    </td>
                                    <td style="width: 75px; padding-left: 6px;">
                                        <img src="data:image/png;base64, {!! base64_encode(QrCode::size(75)->generate("{\"visit_id\":$visit->id,\"user_id\":{{ auth()->user()->id }}},")) !!}" width="75px"
                                            height="75px">
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                <div style="padding: 16px">
                    {{ jsonToHtml($visit->visitType->content) }}
                </div>
            </div>
        @endforeach
    </main>

</body>

</html>
