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
            @if ($template_id)
                <embed src="{{ asset("storage/print_pdfs/{$template_id}.pdf") }}"
                    type="application/pdf" width="100%" height="900px" />
            @endif
        </div>
    </div>
</div>
