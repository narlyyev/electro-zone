@extends('admin.layouts.app')
@section('title')
Categories
@endsection
@section('content')
<div class="container-xl pt-3">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover table-sm" id="dt-table" width="100%" cellspacing="0">
                    <div class="d-flex justify-content-between align-items-center pb-3">
                        <div class="h3">
                            Kategoriýalar
                        </div>
                        <div>
                            <a href="{{ route('admin.categories.create') }}" class="btn btn-sm btn-primary">
                                <i class="bi-plus h4"></i>
                            </a>
                        </div>
                    </div>
                    <input type="text" class="form-control mb-3" id="dt-search" placeholder="Gözleg" autofocus>
                    <thead>
                        <tr class="small">
                            <th class="text-center">ID</th>
                            <th class="text-center">Esasy</th>
                            <th class="text-center">Tertibi</th>
                            <th class="text-center">Ady</th>
                            <th class="text-center">Baş sahypa</th>
                            <th class="text-center">Köp ullanylýan</th>
                            <th class="text-center">Aktiw</th>
                            <th class="text-center">Harytlar</th>
                            <th class="text-center" style="width: 20%!important;">Attributlar</th>
                            <th class="text-center" style="width: 10%!important;">Kiçi surat</th>
                            <th class="text-center" style="width: 10%!important;">Uly surat</th>
                            <th class="text-center"><i class="bi-gear-wide-connected"></i></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
<style>
    #dt-table_length,
    #dt-table_filter {
        display: none;
    }
</style>
<script>
    $(document).ready(function() {
        let dtTable = $('#dt-table').DataTable({
            processing: true,
            serverSide: true,
            fixedHeader: true,
            pageLength: 50,
            ajax: {
                url: "{{ route('admin.categories.api') }}",
                dataType: "json",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}"
                },
            },
            columns: [{
                    data: 'id'
                },
                {
                    data: 'parent_id'
                },
                {
                    data: 'sort_order'
                },
                {
                    data: 'name'
                },
                {
                    data: 'is_home'
                },
                {
                    data: 'most_used'
                },
                {
                    data: 'is_active',
                },
                {
                    data: 'products_count'
                },
                {
                    data: 'attributes'
                },
                {
                    data: 'small_image'
                },
                {
                    data: 'big_image'
                },
                {
                    data: 'action',
                    searchable: true,
                    orderable: false
                },
            ],
            order: [
                [2, 'asc']
            ],
            mark: true,
        }).on('page.dt', function() {
            $("html, body").animate({
                scrollTop: 0
            }, 1500);
        }).on('draw.dt', function() {
            $('.check-home').click(function() {
                let self = $(this);
                self.attr("disabled", true);
                $.ajax({
                    url: '{{ route("admin.categories.home") }}',
                    dataType: "json",
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": self.val(),
                    },
                    success: function(result, status, xhr) {
                        self.attr("disabled", false);
                        self.prop('checked', result["home"] === 1);
                    },
                });
            });
            $('.check-most_used').click(function() {
                let self = $(this);
                self.attr("disabled", true);
                $.ajax({
                    url: '{{ route("admin.categories.mostUsed") }}',
                    dataType: "json",
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": self.val(),
                    },
                    success: function(result, status, xhr) {
                        self.attr("disabled", false);
                        self.prop('checked', result["most_used"] === 1);
                    },
                });
            });
            $('.check-is_active').click(function() {
                let self = $(this);
                self.attr("disabled", true);
                $.ajax({
                    url: "{{ route('admin.categories.active') }}",
                    dataType: "json",
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": self.val()
                    },
                    success: function(result, status, xhr) {
                        self.attr("disabled", false);
                        self.prop('checked', result["is_active"] === 1);
                    },
                });
            });
            $('.btn-up').click(function() {
                let self = $(this);
                self.attr("disabled", true);
                $.ajax({
                    url: '{{ route("admin.categories.up") }}',
                    dataType: "json",
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": self.val(),
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
                    url: '{{ route("admin.categories.down") }}',
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
        });
        let dtSearch = document.getElementById('dt-search');
        let dtSearchTimeout = null;
        dtSearch.onkeyup = function(e) {
            let self = this;
            clearTimeout(dtSearchTimeout);
            dtSearchTimeout = setTimeout(function() {
                if (dtTable.search() !== self.value) {
                    dtTable.search(self.value).draw();
                }
            }, 500);
        };
    });
</script>
@endsection