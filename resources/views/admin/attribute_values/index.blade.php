@extends('admin.layouts.app')
@section('content')
<div class="container-xl pt-3">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center pb-3">
                <div class="h3">
                    Bahalar
                </div>
                <div>
                    <a href="{{ route('admin.attribute_values.create') }}" class="btn btn-sm btn-primary">
                        <i class="bi-plus h4"></i>
                    </a>
                </div>
            </div>
            <input type="text" class="form-control mb-2" id="dt-search" placeholder="Gözleg" autofocus>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover table-sm" id="dt-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tertibi</th>
                            <th>Aýratynlyk</th>
                            <th>Ady</th>
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
        let dtTable = $('#dt-table').DataTable({
            processing: true,
            serverSide: true,
            fixedHeader: true,
            pageLength: 50,
            ajax: {
                url: "{{ route('admin.attribute_values.api') }}",
                dataType: "json",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "attribute": "{{ $f_attribute }}",
                },
            },
            columns: [{
                    data: 'id'
                },
                {
                    data: 'sort_order'
                },
                {
                    data: 'attribute_id',
                    orderable: false
                },
                {
                    data: 'name'
                },
                {
                    data: 'action',
                    searchable: false,
                    orderable: false
                },
            ],
            order: [
                [1, 'asc']
            ],
            mark: true,
        }).on('page.dt', function() {
            $("html, body").animate({
                scrollTop: 0
            }, 1500);
        }).on('draw.dt', function() {
            $('.btn-up').click(function() {
                let self = $(this);
                self.attr("disabled", true);
                $.ajax({
                    url: "{{ route('admin.attribute_values.up') }}",
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
                    url: "{{ route('admin.attribute_values.down') }}",
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