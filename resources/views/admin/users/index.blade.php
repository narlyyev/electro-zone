@extends('admin.layouts.app')
@section('content')
<div class="container-xl pt-3">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="display table table-bordered table-hover small" id="myTable" width="100%" cellspacing="0">
                    <div class="d-flex justify-content-between align-items-center pb-3">
                        <div class="h3">
                            Ullanyjylar
                        </div>
                        <div>
                            <a href="{{ route('admin.users.create') }}" class="btn btn-sm border border-dark">
                                <i class="bi-plus h4"></i>
                            </a>
                        </div>
                    </div>
                    <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">Rugsatlar</th>
                            <th class="text-center">Ady</th>
                            <th class="text-center">Surat</th>
                            <th class="text-center">Rol</th>
                            <th class="text-center">Telefon belgi</th>
                            <th width="10%" class="text-center">Last seen</th>
                            <th class="text-center"><i class="bi-gear-fill"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td class="h6 fw-normal text-center">
                                {{ $user->id }}
                            </td>
                            <td style="width: 20%!important;">
                                @foreach($permissions as $permission)
                                @if(in_array($permission['id'], $user->permissions))
                                <span class="badge bg-dark">{{ $permission['name'] }}</span>
                                @endif
                                @endforeach
                            </td>
                            <td class="h6 fw-normal text-center">
                                {{ $user->name }}
                            </td>
                            <td class="h6 fw-normal text-center">
                                {!! $user->image ? '<img class="w-50 rounded-4" src="' . asset('storage/img/users/' . $user->image) . '" alt="User Image">' : '<i class="bi bi-person h3"></i>' !!}
                            </td>
                            <td class="h6 fw-normal text-center">
                                {{ $user->role }}
                            </td>
                            <td class="h6 fw-normal text-center">
                                {{ $user->phone }}
                            </td>
                            <td class="h6 fw-normal text-center">
                                {{ isset($user->last_seen) ? $user->last_seen->format('d M Y H:i:s') : '' }}
                            </td>
                            <td>
                                <div class="text-center">
                                    <a class="btn btn-sm btn-success" href="{{ route('admin.users.edit', $user->id) }}">
                                        <i class="bi-pencil"></i>
                                    </a>
                                </div>
                                <div class="my-3 text-center">
                                    <a href="{{ route('admin.users.password', $user->id) }}" class="btn btn-sm btn-danger">
                                        <i class="bi-key"></i>
                                    </a>
                                </div>
                                <div class="text-center">
                                    <form action="{{ route('admin.users.delete', $user->id) }}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        @honeypot
                                        <button type="submit" class="btn btn-sm btn-dark" data-bs-toggle="modal" data-bs-target="#delete{{ $user->id }}">
                                            <i class="bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection