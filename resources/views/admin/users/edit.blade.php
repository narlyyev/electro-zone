@extends('admin.layouts.app')
@section('content')
    <div class="row justify-content-center ">
        <div class="col-11">
            <div class="container-xl my-3 p-3">
                <div class="h3">
                    Ullanyjyny üýtgetmek
                </div>
                <form action="{{ route('admin.users.update', $user) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="bg-white p-4 rounded-3">
                        <div class="row">
                            <div class="col-4">
                                <div class="mb-3">
                                    <label for="name" class="form-label h6">Ady</label>
                                    <input type="text" class="form-control" id="name" placeholder="Write a name" name="name"
                                           value="{{ $user->name }}">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-3">
                                    <label for="role" class="form-label h6">Rol</label>
                                    <input type="text" class="form-control" id="role" placeholder="Write a role" name="role"
                                           value="{{ $user->role }}">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-3">
                                    <label for="phone" class="form-label h6">Telefon belgi</label>
                                    <input type="phone" class="form-control" id="phone" placeholder="Write a phone"
                                           name="phone" value="{{ $user->phone }}">
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

                    <div class="bg-white rounded-3 p-4 my-3">
                        <div class="mb-3">
                            <div class="mb-1 h6">
                                Rugsatlar
                            </div>
                            <div class="row">
                                @foreach($permissions as $permission)
                                    <div class="col-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="{{ $permission['id'] }}"
                                                   id="permission{{ $permission['id'] }}"
                                                   name="permissions[]" {{ in_array($permission['id'], $user->permissions ?: []) ? 'checked':'' }}>
                                            <label class="form-check-label" for="permission{{ $permission['id'] }}">
                                                {{ $permission['name'] }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
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