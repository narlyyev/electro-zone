@extends('admin.layouts.app')
@section('content')
    <div class="row justify-content-center ">
        <div class="col-11">
            <div class="container-xl rounded my-3 p-3">
                <div class="h3">
                    Edit a slider
                </div>
                <form action="{{ route('admin.sliders.update', $slider->id) }}" method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="bg-white p-4 rounded-3">
                        <div class="mb-3">
                            <label for="image" class="form-label">Image TM</label>
                            <input class="form-control" type="file" id="image" name="image" value="{{ $slider->image }}"
                                   data-default-file="{{ asset('storage/img/sliders/image' . '/' . $slider->image) }}">
                        </div>
                        <div class="mb-3">
                            <label for="image_ru" class="form-label">Image RU</label>
                            <input class="form-control" type="file" id="image_ru" name="image_ru"
                                   data-default-file="{{ asset('storage/img/sliders/image_ru' . '/' . $slider->image_ru) }}">
                        </div>
                    </div>
                    <div class="bg-white p-4 rounded-3 my-3">
                        <div class="mb-3">
                            <label for="mobile_image" class="form-label">Mobile image TM</label>
                            <input class="form-control" type="file" id="mobile_image" name="mobile_image"
                                   data-default-file="{{ asset('storage/img/sliders/mobile_image' . '/' . $slider->mobile_image) }}">
                        </div>
                        <div class="mb-3 mt-1">
                            <label for="mobile_image_ru" class="form-label">Mobile image RU</label>
                            <input class="form-control" type="file" id="mobile_image_ru" name="mobile_image_ru"
                                   data-default-file="{{ asset('storage/img/sliders/mobile_image_ru' . '/' . $slider->mobile_image_ru) }}">
                        </div>
                    </div>
                    <div class="bg-white p-4 rounded-3 mb-3">
                        <div class="row">
                            <div class="col-6 mb-3">
                                <label for="start_date" class="form-label">Start date</label>
                                <input type="datetime-local" step="any" class="form-control" id="start_date" name="start_date"
                                       value="{{ $slider->start_date }}">
                            </div>
                            <div class="col-6 mb-3">
                                <label for="end_date" class="form-label">End date</label>
                                <input type="datetime-local" step="any" class="form-control" id="end_date" name="end_date"
                                       value="{{ $slider->end_date }}">
                            </div>
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
            // Define an array of objects with information about buttons and images
            var slidersData = [
                {
                    buttonId: 'deleteImageButtonTm',
                    currentImageId: 'currentImageTm',
                    route: '{{ route("admin.sliders.deleteImageTmFromEdit", $slider->id) }}'
                },
                {
                    buttonId: 'deleteImageButtonRu',
                    currentImageId: 'currentImageRu',
                    route: '{{ route("admin.sliders.deleteImageRuFromEdit", $slider->id) }}'
                }
                // Add more objects if needed
            ];

            // Iterate over the array using for...of loop
            for (const sliderData of slidersData) {
                let deleteButton = document.getElementById(sliderData.buttonId);
                let currentImage = document.getElementById(sliderData.currentImageId);

                if (deleteButton) {
                    deleteButton.addEventListener('click', function () {
                        // Make an AJAX request to delete the image
                        fetch(sliderData.route, {
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
                                deleteButton.remove();
                            })
                            .catch(error => {
                                console.error('There was a problem with the fetch operation:', error);
                            });
                    });
                }
            }
        });
    </script>

    <script>
        $(document).ready(function () {
            $('#image').dropify();
            $('#image_ru').dropify();
            $('#mobile_image').dropify();
            $('#mobile_image_ru').dropify();
        });
    </script>

@endsection