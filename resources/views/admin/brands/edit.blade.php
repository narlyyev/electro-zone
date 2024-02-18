@extends('admin.layouts.app')
@section('content')
    <div class="row justify-content-center ">
        <div class="col-11">
            <div class="container-xl rounded my-3 p-3">
                <div class="h3">
                    Edit a brand
                </div>
                <form action="{{ route('admin.brands.update', $brand->id) }}" method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="bg-white rounded-3 p-4 mb-3">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" placeholder="Write a name" name="name"
                                   value="{{ $brand->name }}">
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input class="form-control" type="file" id="image" name="image" data-default-file="{{ asset('storage/img/brands' . '/' . $brand->image) }}">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary px-4">
                        Submit
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var deleteImageButton = document.getElementById('deleteImageButton');
            var currentImage = document.getElementById('currentImage');

            if (deleteImageButton) {
                deleteImageButton.addEventListener('click', function () {
                    // Make an AJAX request to delete the image
                    fetch('{{ route("admin.brands.deleteImageFromEdit", $brand->id) }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        },
                    })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            // If the deletion was successful, update the UI
                            currentImage.remove();
                            deleteImageButton.remove();
                        })
                        .catch(error => {
                            console.error('There was a problem with the fetch operation:', error);
                        });
                });
            }
        });
    </script>

    <script>
        $(document).ready(function () {
            $('#image').dropify();
        });
    </script>
@endsection