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
                            Ýerler
                        </div>
                        <div>
                            <a href="{{ route('admin.locations.create') }}" class="btn btn-sm border border-dark">
                                <i class="bi-plus h4"></i>
                            </a>
                        </div>
                    </div>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tertibi</th>
                            <th>Ady</th>
                            <th>Sargydyň sany</th>
                            <th>Eltip bermegiň tölegi</th>
                            <th><i class="bi-gear-wide-connected"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($locations as $location)
                        <tr>
                            <td>{{ $location->id }}</td>
                            <td class="text-center">
                                <button class="btn btn-light btn-sm btn-up" value="{{ $location->id }}"><i class="bi-plus-lg"></i></button>
                                <div class="text-primary fw-bold my-1">{{ $location->sort_order }}</div>
                                <button class="btn btn-light btn-sm btn-down" value="{{ $location->id }}"><i class="bi-dash-lg"></i></button>
                            </td>
                            <td>
                                <div class="mb-1">{{ $location->name }}</div>
                                <div class="mb-1"><span class="font-monospace text-secondary">RU</span> {{ $location->name_ru }}</div>
                            </td>
                            <td>
                                <a href="{{ route('admin.orders.index', ['locations' => [$location->id]]) }}" class="fs-5 text-decoration-none">
                                    {{ $location->orders_count }} <i class="bi-box-arrow-up-right"></i>
                                </a>
                            </td>
                            <td>{{ $location->delivery_fee }}</td>
                            <td>
                                <div class="text-center">
                                    <a class="btn btn-sm btn-success" href="{{ route('admin.locations.edit', $location) }}">
                                        <i class="bi-pencil"></i>
                                    </a>
                                </div>
                                <div class="text-center">
                                    <form action="{{ route('admin.locations.delete', $location) }}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        @honeypot
                                        <button type="submit" class="btn btn-sm btn-dark mt-2" data-bs-toggle="modal" data-bs-target="#delete{{ $location->id }}">
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
<script>
    $('.btn-up').click(function() {
        let self = $(this);
        self.attr("disabled", true);
        $.ajax({
            url: "{{ route('admin.locations.up') }}",
            dataType: "json",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                "id": self.val()
            },
            success: function(result, status, xhr) {
                self.attr("disabled", false);
                self.next().text(result["sort_order"]);
            },
        });
    });
    $('.btn-down').click(function() {
        let self = $(this);
        self.attr("disabled", true);
        $.ajax({
            url: "{{ route('admin.locations.down') }}",
            dataType: "json",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                "id": self.val()
            },
            success: function(result, status, xhr) {
                self.attr("disabled", false);
                self.prev().text(result["sort_order"]);
            },
        });
    });
</script>
@endsection