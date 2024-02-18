@extends('admin.layouts.app')
@section('content')
    <div class="row justify-content-center ">
        <div class="col-11">
            <div class="container-xl rounded my-3 p-3">
                <div class="h3">
                    Create a banner
                </div>
                <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="bg-white rounded-3 p-4">
                        <div class="mb-3">
                            <label for="image" class="form-label">Image TM</label>
                            <input class="form-control" type="file" id="image" name="image">
                        </div>
                        <div class="mb-3">
                            <label for="image_ru" class="form-label">Image RU</label>
                            <input class="form-control" type="file" id="image_ru" name="image_ru">
                        </div>
                    </div>
                    <div class="bg-white rounded-3 p-4 my-3">
                        <div class="row">
                            <div class="col-6 mb-3">
                                <label for="start_date" class="form-label">Start date</label>
                                <input type="datetime-local" class="form-control" id="start_date" name="start_date" value="{{ old('start_date') }}">
                            </div>
                            <div class="col-6 mb-3">
                                <label for="end_date" class="form-label">End date</label>
                                <input type="datetime-local" class="form-control" id="end_date" name="end_date" value="{{ old('end_date') }}">
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
        $(document).ready(function () {
            $('#image').dropify();
            $('#image_ru').dropify();
        });
    </script>
@endsection