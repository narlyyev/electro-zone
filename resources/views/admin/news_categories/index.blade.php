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
                                News Category
                            </div>
                            <div>
                                <a href="{{ route('admin.news_categories.create') }}" class="btn btn-sm btn-primary">
                                    <i class="bi-plus h4"></i>
                                </a>
                            </div>
                        </div>
                        <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">Image TM</th>
                            <th class="text-center">Image RU</th>
                            <th class="text-center">Image EN</th>
                            <th class="text-center">Active</th>
                            <th class="text-center">Created at</th>
                            <th class="text-center">Options</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($newsCategories as $category)
                            <tr>
                                <td class="h6 fw-normal text-center">
                                    {{ $category->id }}
                                </td>
                                <td class="h6 fw-normal text-center">
                                    {{ $category->name }}
                                </td>
                                <td class="h6 fw-normal text-center">
                                    {{ $category->name_ru }}
                                </td>
                                <td class="h6 fw-normal text-center">
                                    {{ $category->name_en }}
                                </td>
                                <td class="text-center">
                                    @if($category->is_active)
                                        <div class="h5">
                                            <i class="bi-check"></i>
                                        </div>
                                    @else
                                        <div class="h5">
                                            <i class="bi-x-lg"></i>
                                        </div>
                                    @endif
                                </td>
                                <td class="h6 fw-normal text-center">
                                    {{ $category->created_at->format('d-M-Y') }}
                                </td>
                                <td>
                                    <div class="text-center mb-3">
                                        <a class="btn btn-sm btn-success"
                                           href="{{ route('admin.news_categories.edit', $category) }}">
                                            <i class="bi-pencil"></i>
                                        </a>
                                    </div>
                                    <form action="{{ route('admin.news_categories.destroy', $category) }}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        @honeypot
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-sm btn-dark mt-2">
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