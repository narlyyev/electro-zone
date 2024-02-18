<div class="container-xl pb-4">
    <div class="row row-cols-6 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-2">
        @foreach ($categories as $category)
            <div class="col">
                <a href="{{ route('category.show', $category->slug) }}" class="text-decoration-none text-dark">
                    <div class="card card-category h-100 px-1" style="border-radius: 16px;">
                        <div class="d-flex align-items-center">
                            <div class="card-body">
                                <div class="row align-items-center g-0">
                                    <div class="col-4">
                                        <div>
                                            @php
                                                $categoryImagePath = $category->big_image ? public_path('storage/img/categories/big_images/' . $category->big_image) : null;
                                            @endphp

                                            <img src="{{ $categoryImagePath && file_exists($categoryImagePath) ? asset('storage/img/categories/big_images/'. $category->big_image) : asset($category->big_image) }}"
                                                 alt="" class="d-block" style="object-fit: cover; width: 60px;">
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <div class="mt-2">
                                            <div class="h6" style="font-size: 14px; color: #1D1D1F; font-weight: 600;">
                                                {{ $category->getName() }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="pe-3">
                                <div class="text-center pt-1 arrow">
                                    <i class="bi-arrow-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>

<style>
    .arrow {
        background: rgba(242, 243, 245, 1);
        width: 32px;
        height: 32px;
        border-radius: 100%
    }

    .card-category:hover .arrow {
        background: #FC1000;
        color: white;
        transition: .4s;
    }

    .card-category {
        border: 1px solid white !important;
        transition: .4s;
    }

    .card-category:hover {
        border: 1px solid #FC1000 !important;
    }
</style>