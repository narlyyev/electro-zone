@extends('admin.layouts.app')
@section('content')
<div class="row justify-content-center ">
    <div class="col-11">
        <div class="container-xl rounded my-3 p-3">
            <div class="h3">
                Create a brand
            </div>
            <form action="{{ route('admin.brands.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="bg-white rounded-3 p-4 mb-3">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Write a name" name="name" value="{{ old('name') }}">
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input class="form-control" type="file" id="image" name="image">
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
    });
</script>
@endsection