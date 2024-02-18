@extends('admin.layouts.app')
@section('content')
    <div class="row justify-content-center ">
        <div class="col-11">
            <div class="container-xl my-3 p-3">
                <div class="h3">
                    Ullanyjy döretmek
                </div>
                <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="bg-white rounded-3 p-4 my-3">
                        <div class="row">
                            <div class="col-4">
                                <div class="mb-3">
                                    <label for="name" class="form-label h6">Ady</label>
                                    <input type="text" class="form-control" id="name" placeholder="Write a name" name="name"
                                           value="{{ old('name') }}">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-3">
                                    <label for="role" class="form-label h6">Rol</label>
                                    <input type="text" class="form-control" id="role" placeholder="Write a role" name="role"
                                           value="{{ old('role') }}">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-3">
                                    <label for="phone" class="form-label h6">Telefon belgi</label>
                                    <input type="phone" class="form-control" id="phone" placeholder="Write a phone"
                                           name="phone" value="{{ old('phone') }}">
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <div class="w-100">
                                <label for="image" class="form-label h6">Surat</label>
                                <input type="file" class="form-control" id="image" name="image">
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
        });
    </script>
@endsection