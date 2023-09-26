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
}
