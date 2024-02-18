@extends('admin.layouts.app')
@section('content')
<div class="container-xl pt-3">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center pb-3">
                <div class="h3">
                    Aýratynlyklar
                </div>
                <div>
                    <a href="{{ route('admin.attributes.create') }}" class="btn btn-sm btn-primary">
                        <i class="bi-plus h4"></i>
                    </a>
                </div>
            </div>
            <input type="text" class="form-control mb-2" id="dt-search" placeholder="Gözleg" autofocus>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover" id="dt-table">
                    <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">Tertibi</th>
                            <th class="text-center">Ady</th>
                            <th class="text-center">Bahalarynyň sany</th>
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
                url: "{{ route('admin.attributes.api') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}"
                }
            },
            columns: [{
                    data: 'id'
                },
                {
                    data: 'sort_order'
                },
                {
                    data: 'name'
                },
                {
                    data: 'attribute_values_count'
                },
                {
                    data: 'action',
                    orderable: false,
                    searchable: false
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
                    url: "{{ route('admin.attributes.up') }}",
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
                    url: "{{ route('admin.attributes.down') }}",
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