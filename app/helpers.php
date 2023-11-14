<?php

use Illuminate\Support\Facades\Storage;

if (!function_exists('formatString')) {
    function formatString($inputString)
    {
        $words = explode('_', $inputString);
        $capitalizedWords = array_map('ucfirst', $words);
        return implode(' ', $capitalizedWords);
    }
}

if (!function_exists('jsonToHtml')) {
    function jsonToHtml($jsonStr)
    {
        $obj = json_decode($jsonStr);

        $html = '';
        foreach ($obj->blocks ?? [] as $block) {
            switch ($block->type) {
                case 'paragraph':
                    $html .= '<p style="word-break: break-all; text-align: ' . $block->data->alignment . '">' . $block->data->text . '</p>';
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
                        $checkbox = !$item->checked ? '<img src="./wave/checkbox.png" width="12px" height="12px" style="margin-right: 6px;" />' : '<img src="./wave/checkedbox.png" width="12px" height="12px" style="margin-right: 6px;" />';
                        $html .= '<div style="margin: 8px 0;">' . $checkbox . '<span contenteditable="true">' . $item->text . '</span></div>';
                    }
                    $html .= '</div></div>';
                    break;

                default:
                    break;
            }
        }

        $html = '<html>' . str_replace("editorjs-style", "span", $html) . '</html>';

        $doc = new DOMDocument();
        $doc->loadHTML($html);
        echo $doc->saveHTML();
    }
}

if (!function_exists('jsonToHtmlForm')) {
    function jsonToHtmlForm($jsonStr)
    {
        $obj = json_decode($jsonStr);

        $html = '';
        foreach ($obj->blocks ?? [] as $block) {
            switch ($block->type) {
                case 'paragraph':
                    $html .= '<p style="word-break: break-all; text-align: ' . $block->data->alignment . '">' . $block->data->text . '</p>';
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
                    $html .= '<div class="my-2" style="z-index: 30;">';
                    $index = 0;
                    foreach ($block->data->items as $item) {
                        // $html .= ('<div class="flex items-center my-2">
                        //     <input id="default-checkbox" type="checkbox" value="' . $item->checked ? 'true' : 'false' . '" style="z-index: 30;"
                        //         class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        //     <label for="default-checkbox" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">' . $item->text . '~~~~~~~</label>
                        // </div>');
                        $html .= '<div class="flex items-center my-2"><input id="checkbox_'.microtime(true).'_'.$index++.'" type="checkbox" value="" style="z-index: 30;" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="default-checkbox" class="ml-2 text-sm font-medium text-gray-900">' . $item->text . '</label>
                        </div>';
                    }
                    $html .= '</div>';
                    break;

                default:
                    break;
            }
        }

        $html = '<html>' . str_replace("editorjs-style", "span", $html) . '</html>';

        $doc = new DOMDocument();
        $doc->loadHTML($html);
        echo $doc->saveHTML();
    }
}

if (!function_exists('jsonToText')) {
    function jsonToText($jsonStr)
    {
        $obj = json_decode($jsonStr);

        $text = '';
        foreach ($obj->blocks ?? [] as $block) {
            switch ($block->type) {
                case 'paragraph':
                    $text .= $block->data->text . "\n\n";
                    break;

                case 'header':
                    $text .= $block->data->text . "\n\n";
                    break;

                case 'raw':
                    break;

                case 'list':
                    break;

                case 'code':
                    break;

                case 'image':
                    break;

                case 'checklist':
                    break;

                default:
                    break;
            }
        }

        return trim($text);
    }
}
