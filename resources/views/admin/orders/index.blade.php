@extends('admin.layouts.app')
@section('title') Orders @endsection
@section('content')

<div class="container-xl pt-3">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center pb-3">
                <div class="h3">
                    Sargytlar
                </div>
                <div class="text-end">
                    @include('admin.orderPanel.filter')
                </div>
            </div>
            <input type="text" class="form-control mb-3" id="dt-search" placeholder="Gözleg" autofocus>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover table-sm" id="dt-table">
                    <thead>
                        <tr class="small">
                            <th>ID</th>
                            <th width="5%">Code</th>
                            <th width="20%">Customer</th>
                            <th width="45%">Products</th>
                            <th width="15%">Total</th>
                            <th width="8%">Status</th>
                            <th width="10%">Created at</th>
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
    $(document).ready(function() {
        let f_locations = @if($f_locations)
        "{{ implode(',', $f_locations) }}".split(',').map(x => +x) @else[] @endif;
        let f_statuses = @if($f_statuses)
        "{{ implode(',', $f_statuses) }}".split(',').map(x => +x) @else[] @endif;

        let dtTable = $('#dt-table').DataTable({
            processing: true,
            serverSide: true,
            fixedHeader: true,
            pageLength: 50,
            ajax: {
                url: "{{ route('admin.orders.api') }}",
                dataType: "json",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "locations": f_locations,
                    "statuses": f_statuses,
                },
            },
            columns: [{
                    data: 'id'
                },
                {
                    data: 'code'
                },
                {
                    data: 'customer_name'
                },
                {
                    data: 'products_price'
                },
                {
                    data: 'total_price'
                },
                {
                    data: 'status'
                },
                {
                    data: 'created_at'
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
        }).on('page.dt', function() {
            $("html, body").animate({
                scrollTop: 0
            }, 1500);
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