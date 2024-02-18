@extends('admin.layouts.app')
@section('title')
Brendler
@endsection
@section('content')
<div class="container-xl pt-3">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center pb-3">
                <div class="h3">
                    Brendlar
                </div>
                <div>
                    <a href="{{ route('admin.brands.create') }}" class="btn btn-sm btn-primary">
                        <i class="bi-plus h4"></i>
                    </a>
                </div>
            </div>
            <input type="text" class="form-control mb-3" id="dt-search" placeholder="Gözleg" autofocus>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover table-sm" id="dt-table">
                    <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">Ady</th>
                            <th class="text-center">Surady</th>
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
                url: "{{ route('admin.brands.api') }}",
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
                    data: 'name'
                },
                {
                    data: 'image'
                },
                {
                    data: 'action',
                    orderable: false,
                    searchable: false
                },
            ],
            order: [
                [0, 'desc']
            ],
            mark: true,
        }).on('page.dt', function() {
            $("html, body").animate({
                scrolltop: 0
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
    })
</script>
@endsection