@extends('admin.layouts.app')
@section('content')
    <div class="row justify-content-center ">
        <div class="col-12 px-5">
            <div class="container-xl bg-white rounded my-3 p-3">
                <div class="h3">
                    Configs
                </div>
                <form action="{{ route('admin.config.update', $config->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <label for="hex_code" class="form-label">Navbar color</label>
                            <div class="mb-3 w-100">
                                <input type="text" class="form-control" id="hex_code" name="hex_code" value="{{ $config->hex_code }}">
                            </div>
                        </div>
                        <div class="col-6">
                            <label for="address" class="form-label">Address</label>
                            <div class="mb-3 w-100">
                                <input type="text" class="form-control" id="address" name="address" value="{{ $config->address }}">
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-6">
                            <label for="phone_1" class="form-label">Phone 1</label>
                            <div class="mb-3 w-100">
                                <input type="text" class="form-control" id="phone_1" name="phone_1" value="{{ $config->phone_1 }}">
                            </div>
                        </div>
                        <div class="col-6">
                            <label for="phone_2" class="form-label">Phone 2</label>
                            <div class="mb-3 w-100">
                                <input type="text" class="form-control" id="phone_2" name="phone_2" value="{{ $config->phone_2 }}">
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="mb-3 w-100">
                            <label for="logo" class="form-label">Logo</label>
                            <input class="form-control" type="file" id="logo" name="logo" data-default-file="{{ asset('img/' . $config->logo) }}">
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary px-3 mt-3">
                                Submit
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#logo').dropify();
        });
    </script>
@endsection