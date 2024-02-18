<div class="container-xl pt-4 pb-3">
    <div class="row g-3">
        @foreach($banners as $banner)
            <div class="col-12 col-lg">
                @php
                    $currentLanguage = app()->getLocale() == 'tm' ? 'image' : 'image_ru';
                    $imagePath = asset("storage/img/banners/{$currentLanguage}/{$banner->$currentLanguage}");
                @endphp
                <img src="{{ $imagePath }}"
                     alt="{{ $banner->$currentLanguage }}"
                     class="d-block rounded w-100">
            </div>
        @endforeach
    </div>
</div>