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
                                Sliders
                            </div>
                            <div>
                                <a href="{{ route('admin.sliders.create') }}" class="btn btn-sm btn-primary">
                                    <i class="bi-plus h4"></i>
                                </a>
                            </div>
                        </div>
                        <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">Image TM/RU</th>
                            <th class="text-center">Mobile image TM/RU</th>
                            <th class="text-center">Start/End date</th>
                            <th class="text-center">Options</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($sliders as $slider)
                            <tr>
                                <td class="h6 fw-normal text-center">
                                    {{ $slider->id }}
                                </td>
                                <td class="text-center">
                                    <div class="pb-3">
                                        <img src="{{ asset('storage/img/sliders/image') . '/' . $slider->image }}"
                                             alt="{{ $slider->image }}" width="100">
                                    </div>
                                    <div>
                                        <img src="{{ asset('storage/img/sliders/image_ru/') . '/' . $slider->image_ru }}"
                                             alt="{{ $slider->image_ru }}" width="100">
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="pb-3">
                                        <img src="{{ asset('storage/img/sliders/mobile_image') . '/' . $slider->mobile_image }}"
                                             alt="{{ $slider->mobile_image }}" width="100">
                                    </div>
                                    <div>
                                        <img src="{{ asset('storage/img/sliders/mobile_image_ru/') . '/' . $slider->mobile_image_ru }}"
                                             alt="{{ $slider->mobile_image_ru }}" width="100">
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="pb-3">
                                        {{ $slider->start_date->format('d-M-Y H:s') }}
                                    </div>
                                    <div>
                                        {{ $slider->end_date->format('d-M-Y H:s') }}
                                    </div>
                                </td>
                                <td>
                                    <div class="text-center mb-3">
                                        <a class="btn btn-sm btn-success"
                                           href="{{ route('admin.sliders.edit', $slider) }}">
                                            <i class="bi-pencil"></i>
                                        </a>
                                    </div>
                                    <form action="{{ route('admin.sliders.delete', $slider) }}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        @honeypot
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-sm btn-dark mt-2" data-bs-toggle="modal"
                                                    data-bs-target="#delete{{ $slider->id }}">
                                                <i class="bi-trash"></i>
                                            </button>
                                        </div>
                                    </form>
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