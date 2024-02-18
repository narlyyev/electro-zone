@extends('admin.layouts.app')
@section('content')
    <div class="container-xl pt-3">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="display table table-bordered table-hover" id="myTable" width="100%" cellspacing="0">
                        <div class="d-flex justify-content-between align-items-center pb-3">
                            <div class="h3">
                                Banners
                            </div>
                            <div>
                                <a href="{{ route('admin.banners.create') }}" class="btn btn-sm btn-primary">
                                    <i class="bi-plus h4"></i>
                                </a>
                            </div>
                        </div>
                        <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">Image Tm</th>
                            <th class="text-center">Image Ru</th>
                            <th class="text-center">Start date</th>
                            <th class="text-center">End date</th>
                            <th class="text-center">Options</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($banners as $banner)
                            <tr>
                                <td class="h6 fw-normal text-center">
                                    {{ $banner->id }}
                                </td>
                                <td class="text-center">
                                    <img src="{{ asset('storage/img/banners/image') . '/' . $banner->image }}"
                                         alt="{{ $banner->image }}" width="100">
                                </td>
                                <td class="text-center">
                                    <img src="{{ asset('storage/img/banners/image_ru/') . '/' . $banner->image_ru }}"
                                         alt="{{ $banner->image_ru }}" width="100">
                                </td>
                                <td class="text-center">
                                    {{ $banner->start_date }}
                                </td>
                                <td class="text-center">
                                    {{ $banner->end_date }}
                                </td>
                                <td>
                                    <div class="text-center mb-3">
                                        <a class="btn btn-sm btn-success"
                                           href="{{ route('admin.banners.edit', $banner) }}">
                                            <i class="bi-pencil"></i>
                                        </a>
                                    </div>
                                    <div class="text-center">
                                        <form action="{{ route('admin.banners.delete', $banner) }}" method="post">
                                            @method('DELETE')
                                            @csrf
                                            @honeypot
                                            <div class="text-center">
                                                <button type="submit" class="btn btn-sm btn-dark mt-2">
                                                    <i class="bi-trash"></i>
                                                </button>
                                            </div>
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
