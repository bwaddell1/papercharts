<div id="lgModal" x-data="{ modalType: '' }" x-init="$watch('$store.lgModal.type', value => { modalType = value; });
$watch('$store.lgModal.open', value => {
    if (value === true) { document.body.classList.add('overflow-hidden') } else { document.body.classList.remove('overflow-hidden'); }
});" x-show="$store.lgModal.open" x-cloak
    class="fixed inset-0 z-10 z-30 overflow-y-auto">
    <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div x-show="$store.lgModal.open" @click="$store.lgModal.open = false;" x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0" class="fixed inset-0 transition-opacity" x-cloak>
            <div class="absolute inset-0 bg-black opacity-50"></div>
        </div>

        <!-- This element is to trick the browser into centering the modal contents. -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>&#8203;
        <div x-show="$store.lgModal.open" x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            class="inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-5xl sm:w-full sm:p-6"
            role="dialog" aria-modal="true" aria-labelledby="modal-headline" x-cloak>


            <template x-if="$store.lgModal.type == 'add-visit'">
                @livewire('modals.add-visit')
            </template>

            <template x-if="$store.lgModal.type == 'print-visit'">
                @livewire('modals.print-visit')
            </template>

            <div class="mt-5 sm:mt-6">

            </div>
        </div>
    </div>
</div>
