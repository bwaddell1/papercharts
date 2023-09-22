@push('header-scripts')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.js"></script>
@endpush

<div class="flex flex-col px-8 mx-auto my-6 max-w-7xl xl:px-5 py-12">

    <form id="dropzoneForm" class="dropzone relative dashed cursor-pointer"
        style="border-style: dashed; border: 1px dashed rgba(56, 78, 183, 0.30); border-radius: 4px; padding: 120px 32px; background: #F8F8FF;"
        action="{{ route('wave.visits.dropzone.store') }}">
        @csrf

        <div id="upload_panel"
            class="absolute top-0 left-0 w-full h-full flex justify-center items-center flex-col bg-transparent"
            style="pointer-events: none;">
            <div class="w-32 h-32 flex justify-center items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="69" height="60" viewBox="0 0 69 60"
                    fill="none">
                    <path
                        d="M36.028 14.7458L36.1203 14.7733L36.1243 14.7688C36.5619 14.8481 36.9961 14.586 37.1247 14.1519C38.2963 10.2152 41.9874 7.46504 46.0998 7.46504C46.5867 7.46504 46.9816 7.07016 46.9816 6.5833C46.9816 6.09643 46.5867 5.70156 46.0998 5.70156C41.0457 5.70156 36.7985 9.06665 35.4348 13.6493C35.2956 14.1162 35.5615 14.6067 36.028 14.7458Z"
                        fill="#483EA8" stroke="#F9FFF9" stroke-width="0.3" />
                    <path
                        d="M56.3438 42.4384H51.9534C51.5494 42.4384 51.2217 42.1107 51.2217 41.7067C51.2217 41.3027 51.5494 40.9749 51.9534 40.9749H56.3438C62.3956 40.9749 67.3197 36.0509 67.3197 29.999C67.3197 23.9471 62.3956 19.023 56.3438 19.023H56.2382C56.026 19.023 55.8242 18.9311 55.6852 18.7706C55.5462 18.6101 55.4834 18.3974 55.5138 18.1873C55.5791 17.7315 55.612 17.2737 55.612 16.8279C55.612 11.5829 51.3444 7.31531 46.0995 7.31531C44.059 7.31531 42.1131 7.95296 40.4719 9.15978C40.1112 9.42478 39.599 9.30718 39.3905 8.91047C34.7425 0.0596993 22.6023 -1.12887 16.3082 6.57053C13.6568 9.81417 12.615 14.0336 13.4498 18.146C13.5418 18.6002 13.1942 19.0236 12.7327 19.0236H12.4395C6.3876 19.0236 1.46353 23.9477 1.46353 29.9996C1.46353 36.0514 6.3876 40.9755 12.4395 40.9755H16.8298C17.2338 40.9755 17.5615 41.3032 17.5615 41.7072C17.5615 42.1113 17.2338 42.439 16.8298 42.439H12.4395C5.5805 42.439 0 36.8585 0 29.9995C0 23.3329 5.27155 17.8742 11.8651 17.5731C11.2457 13.3066 12.4301 9.00295 15.1751 5.64437C21.9138 -2.5996 34.828 -1.67556 40.2871 7.51707C42.0287 6.42522 44.0215 5.85244 46.0992 5.85244C52.4538 5.85244 57.4892 11.261 57.0486 17.58C63.5813 17.9463 68.7829 23.3763 68.7829 29.999C68.7829 36.8585 63.2024 42.4384 56.3434 42.4384L56.3438 42.4384Z"
                        fill="#483EA8" />
                    <path
                        d="M15.85 41.2935C15.85 51.4634 24.1237 59.737 34.2935 59.737C44.4634 59.737 52.737 51.4633 52.737 41.2935C52.737 31.1235 44.4634 22.85 34.2935 22.85C24.1235 22.85 15.85 31.1237 15.85 41.2935ZM17.6138 41.2935C17.6138 32.0966 25.0964 24.6138 34.2935 24.6138C43.4904 24.6138 50.9732 32.0964 50.9732 41.2935C50.9732 50.4904 43.4904 57.9732 34.2935 57.9732C25.0966 57.9732 17.6138 50.4905 17.6138 41.2935Z"
                        fill="#483EA8" stroke="#F9FFF9" stroke-width="0.3" />
                    <path
                        d="M33.9428 48.6577C33.9428 49.0363 34.2499 49.3434 34.6285 49.3434C35.0071 49.3434 35.3142 49.0367 35.3142 48.6577V34.7291C35.3142 34.3504 35.0071 34.0434 34.6285 34.0434C34.2498 34.0434 33.9428 34.3504 33.9428 34.7291V48.6577Z"
                        fill="#483EA8" stroke="#483EA8" stroke-width="0.3" />
                    <path
                        d="M34.6281 35.7004L30.8274 39.5011L34.6281 35.7004ZM34.6281 35.7004L38.4289 39.5012C38.5626 39.6349 38.7386 39.702 38.9137 39.702L34.6281 35.7004ZM29.8576 39.5012C30.1254 39.769 30.5597 39.7691 30.8273 39.5012L38.9138 39.702C39.0886 39.702 39.2647 39.6355 39.3987 39.5011C39.6665 39.2332 39.6665 38.7992 39.3986 38.5314L35.113 34.2457C34.8452 33.9779 34.4108 33.9778 34.1432 34.2457C34.1432 34.2458 34.1431 34.2458 34.1431 34.2458L29.8576 38.5314C29.5897 38.7993 29.5897 39.2333 29.8576 39.5012Z"
                        fill="#483EA8" stroke="#483EA8" stroke-width="0.3" />
                </svg>
            </div>
            <div class="p-1 justify-start items-start gap-2.5 inline-flex">
                <div class="text-center"><span class="text-stone-950 font-bold leading-normal"
                        style="font-size: 16px;">Drag
                        & drop files or</span><span class="text-zinc-800 text-base font-bold leading-normal">
                    </span><span class="text-indigo-800 font-bold underline leading-normal"
                        style="font-size: 16px; margin-left: 3px;">Browse</span>
                </div>
            </div>
            <div class="p-1 justify-start items-start gap-2.5 inline-flex">
                <div class="text-center text-stone-500 font-normal leading-none my-4"
                    style="font-size: 12px; font-weight: 400; color: #676767;">Supported formates:
                    JPEG, PNG, GIF, MP4, PDF, PSD, AI, Word, PPT</div>
            </div>
        </div>
    </form>
    <div align="center" class="my-12">
        <button type="button" class="uppercase btn w-full py-4" style="background: #483EA8; color: white; padding: "
            id="submit-all">Upload Files</button>
    </div>
    <br />
    <div class="bg-white shadow rounded p-8 border border-gray-200">
        <h3 class="text-xl font-bold">Uploaded</h3>
        <div class="panel-body flex flex-wrap items-center m-8" id="uploaded_image" wire:init="fetchUploadedVisits">
            @foreach ($visits as $visit)
                <div class="flex flex-col px-2 relative" style="margin-bottom:16px;">
                    <img src="{{ asset('visits/' . $visit['name']) }}" class="img-thumbnail shadow" width="136"
                        height="136" style="height:136px; border-color: #11AF22;" />
                    <button type="button" class="absolute bg-red-500 rounded-full p-1.5" style="opacity: .75; top: 6px; right: 10px;" id="{{ $visit['name'] }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                            stroke="black" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            @endforeach
        </div>
    </div>

    <script type="text/javascript">
        Dropzone.options.dropzoneForm = {
            autoProcessQueue: false,
            acceptedFiles: ".png,.jpg,.gif,.bmp,.jpeg",

            init: function() {
                var submitButton = document.querySelector("#submit-all");
                myDropzone = this;

                submitButton.addEventListener('click', function() {
                    myDropzone.processQueue();
                });

                this.on("addedfile", function(file) {
                    $('#upload_panel').hide();
                });

                this.on("complete", function() {
                    if (this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0) {
                        var _this = this;
                        _this.removeAllFiles();
                    }
                    Livewire.emit('fetchUploadedVisits');
                });

            }

        };

        // load_images();

        // function load_images() {
        // $.ajax({
        //     url: "{{ route('wave.visits.dropzone.fetch') }}",
        //     success: function(data) {
        //         $('#uploaded_image').html(data);
        //     }
        // })
        // }

        $(document).on('click', '.remove_image', function() {
            var name = $(this).attr('id');
            $.ajax({
                url: "{{ route('wave.visits.dropzone.delete') }}",
                data: {
                    name: name
                },
                success: function(data) {
                    Livewire.emit('fetchUploadedVisits');
                    // load_images();
                }
            })
        });
    </script>
</div>
