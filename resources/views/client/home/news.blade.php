<div class="container-xl pb-5">
    <div class="d-flex justify-content-between align-items-center">
        <div style="font-size: 32px; font-weight: 700;">
            @lang('app.news')
        </div>
        <a href="{{ route('news.index') }}" style="color: rgba(252, 16, 0, 1)">
            SEE ALL
        </a>
    </div>
    <div class="row pt-2 g-3">
        @foreach($news as $data)
            <div class="col-12 col-lg-4 hover">
                <a href="{{ route('news.show', $data->slug) }}" class="news text-decoration-none">
                    <div class="bg-white h-100" style="border-radius: 16px;">
                        <div>
                            <img src="{{ asset('storage/img/news/' . $data->image) }}" alt="" class="img-fluid" style="border-top-left-radius: 16px; border-top-right-radius: 16px;">
                        </div>
                        <div class="px-3">
                            <div class="pt-4" style="color: rgba(252, 16, 0, 1)">
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

<style>
    .news .news-name {
        color:#1D1D1F;
        text-decoration: none;
    }

    .hover {
        transition: .4s;
    }

    .hover:hover {
        transform: scale(1.03);
    }

</style>