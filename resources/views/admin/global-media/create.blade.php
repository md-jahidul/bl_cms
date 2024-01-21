@extends('layouts.admin')
@section('title', 'Media')
@section('card_name', 'Global Media Upload')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Upload Media</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('media.store') }}" enctype="multipart/form-data"
                              id="media-upload-form">
                            @csrf

                            <div class="form-group">
                                <label for="key_name">Key Name</label>
                                <input type="text" name="key_name" id="key_name" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="image">Image (Max Size: 2 MB, Allowed Extensions: .jpg, .jpeg, .png,
                                    .gif)</label>
                                <input type="file" name="image" id="image" class="form-control-file" required
                                       accept=".jpg, .jpeg, .png, .gif">
                            </div>
                            <div class="form-group">
                                <label for="settings_key">Image Settings</label>
                                <select name="settings_key" id="settings_key" class="form-control" required>
                                    @foreach ($imageSettings as $key => $value)
                                        <option value="{{ $key }}" data-dimensions="{{ $key }}"> {{ $value }}</option>
                                    @endforeach
                                        <option value="wildcard" data-dimensions="*">Wildcard (Allow Any Ratio)</option>
                                </select>
                            </div>
                            <button type="button" class="btn btn-primary" onclick="validateImage()">Upload</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function validateImage() {
            var settingsKey = document.getElementById('settings_key').value;
            var selectedFile = document.getElementById('image').files[0];

            // Check if a file was selected
            if (!selectedFile) {
                alert('Please select an image.');
                return;
            }

            // Check the file size (2 MB maximum)
            if (selectedFile.size > 2 * 1024 * 1024) {
                alert('Image size exceeds the 2 MB limit. Please choose a smaller image.');
                return;
            }

            // Check the file extension
            var allowedExtensions = ['.jpg', '.jpeg', '.png', '.gif'];
            var fileExtension = selectedFile.name.substring(selectedFile.name.lastIndexOf('.')).toLowerCase();
            if (allowedExtensions.indexOf(fileExtension) === -1) {
                alert('Invalid file extension. Allowed extensions are .jpg, .jpeg, .png, .gif.');
                return;
            }

            // If wildcard setting is selected, submit the form
            if (settingsKey === 'wildcard') {
                document.getElementById('media-upload-form').submit();
                return;
            }

            // Check image dimensions
            var dimensions = document.querySelector(`option[value="${settingsKey}"]`).getAttribute('data-dimensions');
            var [maxWidth, maxHeight] = dimensions.split('x');

            // Check if dimensions are valid
            if (!isValidDimensions(selectedFile, maxWidth, maxHeight)) {
                alert('Image dimensions do not match the selected settings_key. Please choose a different image.');
                return;
            }

            // Image dimensions are valid, submit the form
            document.getElementById('media-upload-form').submit();
        }

        function isValidDimensions(file, maxWidth, maxHeight) {
            var img = new Image();
            img.src = window.URL.createObjectURL(file);

            return new Promise((resolve, reject) => {
                img.onload = function () {
                    if (img.width <= maxWidth && img.height <= maxHeight) {
                        resolve(true);
                    } else {
                        resolve(false);
                    }
                };

                img.onerror = function () {
                    reject(false);
                };
            });
        }
    </script>

@endsection

