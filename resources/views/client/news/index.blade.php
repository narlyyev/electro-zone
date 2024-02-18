@extends('client.layouts.app')
@section('title')
    @lang('app.app-name') - @lang('app.news')
@endsection
@section('content')
    <div class="container-xl py-3">
        <div class="row pt-2 g-3">
            @foreach($news as $data)
                <div class="col-12 col-lg-4">
                    <a href="{{ route('news.show', $data->slug) }}" class="news text-decoration-none">
                        <div class="h-100" style="border-radius: 16px; background: #f5f5f7">
                            <div>
                                <img src="{{ asset('storage/img/news/' . $data->image) }}" alt="" class="img-fluid" style="border-top-left-radius: 16px; border-top-right-radius: 16px;">
                            </div>
                            <div class="px-3">
                                <div class="pt-4" style="color: #007AFF;">
                                    {{ $data->category->name }}
                                </div>
                                <div class="py-3 news-name" style="font-size: 20px; line-height: 160%">
                                    {{ $data->getName() }}
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection

<style>
    .news .news-name {
        color:#1D1D1F;
        text-decoration: none;
    }

    .news:hover .news-name {
        color:#FC1000;
        text-decoration: underline;
    }
</style>