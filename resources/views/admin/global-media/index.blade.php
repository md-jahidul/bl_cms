@extends('layouts.admin')
@section('title', 'Media')
@section('card_name', 'Global Media Upload')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Media Manager</div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <a href="{{ route('media.create') }}" class="btn btn-primary mb-3">Upload New Media</a>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <input type="text" id="keyFilter" class="form-control" placeholder="Filter by Key Name">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="button" onclick="filterMedia()">Filter</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Key Name</th>
                                    <th>Image Location</th>
                                    <th>Thumbnail</th>
                                    <th>Settings Key</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($media as $item)
                                    <tr>
                                        <td>{{ $item->key_name }}</td>
                                        <td>
                                            <div class="media-location">
                                                {{ $item->image_location }}
                                                <button class="btn btn-sm btn-info copy-location"
                                                        data-clipboard-text="{{ $item->image_location }}">Copy
                                                </button>
                                            </div>
                                        </td>
                                        <td><img src="{{ asset($item->image_location) }}"
                                                 alt="{{ $item->key_name }} Thumbnail" class="img-thumbnail"
                                                 style="width: 100px; height: 100px;">
                                        </td>
                                        <td>{{ $item->settings_key }}</td>
                                        <td>
                                            {{ $item->created_at }}
                                        </td>
                                        <td>
                                            <a href="{{ asset($item->image_location) }}" target="_blank"
                                               class="btn btn-info btn-sm">Preview</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $media->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Other head content -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.8/clipboard.min.js"></script>
    <script>
        // Initialize ClipboardJS for copy-location buttons
        new ClipboardJS('.copy-location', {
            text: function (trigger) {
                return trigger.getAttribute('data-clipboard-text');
            }
        });

        function filterMedia() {
            var keyFilter = document.getElementById('keyFilter').value;
            window.location.href = "{{ route('media.index') }}?key=" + keyFilter;
        }
    </script>
@endsection
