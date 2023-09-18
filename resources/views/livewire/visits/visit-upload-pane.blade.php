@push('header-scripts')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.js"></script>
@endpush

<div class="flex flex-col px-8 mx-auto my-6 max-w-7xl xl:px-5 py-12">

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Select Image</h3>
        </div>
        <div class="panel-body">
            <form id="dropzoneForm" class="dropzone" action="{{ route('wave.visits.dropzone.store') }}">
                @csrf
            </form>
            <div align="center">
                <button type="button" class="btn btn-info" id="submit-all">Upload</button>
            </div>
        </div>
    </div>
    <br />
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Uploaded Image</h3>
        </div>
        <div class="panel-body flex flex-wrap items-center" id="uploaded_image" wire:init="fetchUploadedVisits">
            @foreach ($visits as $visit)
                <div class="flex flex-col px-2" style="margin-bottom:16px;">
                    <img src="{{ asset('visits/' . $visit->getFilename()) }}" class="img-thumbnail" width="170"
                        height="170" style="height:170px;" />
                    <button type="button" class="btn btn-link remove_image"
                        id="{{ $visit->getFilename() }}">Remove</button>
                </div>
            @endforeach
        </div>
        <button wire:click="fetchUploadedVisits">test</button>
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

                this.on("complete", function() {
                    if (this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0) {
                        var _this = this;
                        _this.removeAllFiles();
                    }
                    // Livewire.emit('fetchUploadedVisits');
                });

            }

        };

        // load_images();

        function load_images() {
            $.ajax({
                url: "{{ route('wave.visits.dropzone.fetch') }}",
                success: function(data) {
                    $('#uploaded_image').html(data);
                }
            })
        }

        $(document).on('click', '.remove_image', function() {
            var name = $(this).attr('id');
            $.ajax({
                url: "{{ route('wave.visits.dropzone.delete') }}",
                data: {
                    name: name
                },
                success: function(data) {
                    load_images();
                }
            })
        });
    </script>
</div>
