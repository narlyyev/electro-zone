@extends('admin.layouts.app')
@section('content')
    <div class="container-xl pt-3">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div class="h3">
                        Products
                    </div>
                    <div>
                        <a href="{{ route('admin.products.create') }}" class="btn btn-primary btn-sm"><i
                                    class="bi-plus-lg"></i> Goşmak</a>
                    </div>
                </div>
                <input type="search" class="form-control mb-2" id="dt-search" placeholder="Gözleg" autofocus>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover table-sm" id="dt-table" width="100%"
                           cellspacing="0">
                        <thead>
                        <tr class="small">
                            <th class="text-center">ID</th>
                            <th width="12%" class="text-center">Surat</th>
                            <th class="text-center">Aýratynlyklar</th>
                            <th class="text-center">Ady</th>
                            <th class="text-center">Barkod</th>
                            <th width="15%" class="text-center">Baha</th>
                            <th class="text-center">Stock</th>
                            <th class="text-center">Aktiw</th>
                            <th class="text-center">Hödürlenýär</th>
                            <th class="text-center">Satyldy</th>
                            <!-- <th class="text-center"><i class="bi-hand-thumbs-up-fill text-danger h5"></i></th> -->
                            <th class="text-center"><i class="bi-eye-fill h5 text-primary"></i></th>
                            <th><i class="bi-gear-wide-connected"></i></th>
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
            display: none
        }
    </style>
    <script>
        $(document).ready(function () {
            let dtTable = $('#dt-table').DataTable({
                processing: true,
                serverSide: true,
                fixedHeader: true,
                pageLength: 50,
                ajax: {
                    url: "{{ route('admin.products.api') }}",
                    dataType: "json",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        category: "{{ request()->input('$f_category') }}",
                        brand: "{{ request()->input('$f_brand') }}",
                        hasDiscount: "{{ request()->input('$f_hasDiscount') }}",
                        hasStock: "{{ request()->input('$f_hasStock') }}",
                    },
                },
                columns: [{
                    data: 'id',
                },
                    {
                        data: 'image'
                    },
                    {
                        data: 'attributes',
                        orderable: false,
                        searchable: false,
                    },
                    {
                        data: 'name',
                    },
                    {
                        data: 'barcode',
                    },
                    {
                        data: 'price',
                    },
                    {
                        data: 'stock',
                    },
                    {
                        data: 'is_active',
                    },
                    {
                        data: 'is_recommended',
                    },
                    {
                        data: 'sold',
                    },
                    {
                        data: 'viewed',
                    },
                    {
                        data: 'action',
                        searchable: false,
                        orderable: false
                    },

                ],
                order: [
                    [0, 'desc']
                ],
                mark: true,
            }).on('page.dt', function () {
                $("html, body").animate({
                    scrollTop: 0
                }, 1500);
            }).on('draw.dt', function () {
                $('.check-is_active').click(function () {
                    let self = $(this);
                    self.attr("disabled", true);
                    $.ajax({
                        url: "{{ route('admin.products.active') }}",
                        dataType: "json",
                        type: "POST",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "id": self.val()
                        },
                        success: function (result, status, xhr) {
                            self.attr("disabled", false);
                            self.prop('checked', result["is_active"] === 1);
                        },
                    });
                });
                $('.check-is_recommended').click(function () {
                    let self = $(this);
                    self.attr("disabled", true);
                    $.ajax({
                        url: "{{ route('admin.products.recommended') }}",
                        dataType: "json",
                        type: "POST",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "id": self.val()
                        },
                        success: function (result, status, xhr) {
                            self.attr("disabled", false);
                            self.prop('checked', result["is_recommended"] === 1);
                        },
                    });
                });
                $('.btn-up').click(function () {
                    let self = $(this);
                    self.attr("disabled", true);
                    $.ajax({
                        url: "{{ route('admin.products.up') }}",
                        dataType: "json",
                        type: "POST",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "id": self.val()
                        },
                        success: function (result, status, xhr) {
                            self.attr("disabled", false);
                            self.next().text(result["stock"]);
                        },
                    });
                });
                $('.btn-down').click(function () {
                    let self = $(this);
                    self.attr("disabled", true);
                    $.ajax({
                        url: "{{ route('admin.products.down') }}",
                        dataType: "json",
                        type: "POST",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "id": self.val()
                        },
                        success: function (result, status, xhr) {
                            self.attr("disabled", false);
                            self.prev().text(result["stock"]);
                        },
                    });
                });
            });
            let dtSearch = document.getElementById('dt-search');
            let dtSearchTimeout = null;
            dtSearch.onkeyup = function (e) {
                let self = this;
                clearTimeout(dtSearchTimeout);
                dtSearchTimeout = setTimeout(function () {
                    if (dtTable.search() !== self.value) {
                        dtTable.search(self.value).draw();
                    }
                }, 500);
            };
        });
    </script>
@endsection
