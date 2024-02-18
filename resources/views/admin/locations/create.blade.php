@extends('admin.layouts.app')
@section('content')
<div class="row justify-content-center ">
    <div class="col-10">
        <div class="container-xl bg-white rounded my-3 p-3">
            <div class="h3">
                Ýer döretmek
            </div>
            <form action="{{ route('admin.locations.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="name" class="form-label h6">Ady Tm</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="name_ru" class="form-label h6">Ady Ru</label>
                            <input type="text" class="form-control" id="name_ru" name="name_ru" value="{{ old('name_ru') }}">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="delivery_fee" class="form-label h6">Eltip bermegiň tölegi</label>
                            <input type="number" class="form-control" id="delivery_fee" name="delivery_fee" value="{{ old('delivery_fee') }}">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="sort_order" class="form-label h6">Tertibi</label>
                            <input type="number" class="form-control" id="sort_order" name="sort_order" value="{{ old('sort_order') }}">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-sm btn-primary">
                    Kabul et
                </button>
            </form>
        </div>
    </div>
</div>
@endsection