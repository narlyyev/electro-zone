<div class="row">
    @foreach($categories as $category)
        <div class="col-3 pb-2" id="col-3">
            <div class="categories" style="border: 1px solid #F6F6F6;border-radius: 8px; padding: 6px;">
                <a href="{{ route('category.show', $category->slug) }}" class="text-decoration-none">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <div class="pe-2">
                                <div>
                                    @php
                                        $categoryImagePath = $category->big_image ? public_path('storage/img/categories/big_images/' . $category->big_image) : null;
                                    @endphp

                                    <img src="{{ $categoryImagePath && file_exists($categoryImagePath) ? asset('storage/img/categories/big_images/'. $category->big_image) : asset($category->big_image) }}"
                                         alt="" class="d-block" style="object-fit: cover; width: 28px;">
                                </div>
                            </div>
                            <div style="color: #1D1D1F; font-size: 14px; font-weight: 500;">
                                {{ $category->getName() }}
                            </div>
                        </div>
                        @if (count($category->children))
                            <div class="icon icon-hover-gray">
                                <i class="bi-chevron-right"></i>
                            </div>
                        @endif
                    </div>
                </a>
            </div>
        </div>
        <div class="col-9" id="col-9">
            <div class="position-absolute w-75 pe-4 top-0">
                <div class="row pt-3 g-2">
                    @foreach($category->children as $subcategory)
                        <div class="col-4">
                            <div class="d-none subcategories border-subcategory-hover" style="padding: 6px; background: #F5F5F7; border-radius: 8px;">
                                <a href="{{ route('category.show', $subcategory->slug) }}" class="text-decoration-none">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="pe-2">
                                                <div>
                                                    @php
                                                        $categoryImagePath = $subcategory->big_image ? public_path('storage/img/categories/big_images/' . $subcategory->big_image) : null;
                                                    @endphp

                                                    <img src="{{ $categoryImagePath && file_exists($categoryImagePath) ? asset('storage/img/categories/big_images/'. $subcategory->big_image) : asset($subcategory->big_image) }}"
                                                         alt="" class="d-block" style="object-fit: cover; width: 60px;">
                                                </div>
                                            </div>
                                            <div style="color:rgba(29, 29, 31, 1); font-size: 14px; font-weight: 500;">
                                                {{ $subcategory->getName() }}
                                            </div>
                                        </div>
                                        <div style="color: rgba(148, 148, 149, 1); font-size: 14px; font-weight: 500;">
                                            {{ $subcategory->products->where('stock', '>', 0)->count() }}
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endforeach
</div>

<script>
    let categories = document.getElementsByClassName('categories');
    let allSubcategories = document.getElementsByClassName('subcategories');
    let icons = document.getElementsByClassName('icon');

    for (let i = 0; i < categories.length; i++) {
        categories[i].addEventListener('mouseover', function () {
            hideAllSubcategories();
            let col9 = this.parentNode.nextElementSibling;
            let col3 = this.parentNode;
            icons = col3.getElementsByClassName('icon');

            if (col9) {
                let self = this
                self.classList.add('border-hover');

                for (const icon of icons) {
                    icon.classList.add('icon-hover-red');
                }
                let subcategories = col9.getElementsByClassName('subcategories');

                for (let j = 0; j < subcategories.length; j++) {
                    subcategories[j].classList.remove('d-none');
                }
            }
        });
    }

    function hideAllSubcategories() {
        for (const category of categories) {
            category.classList.remove('border-hover');
        }

        for (const icon of icons) {
            icon.classList.remove('icon-hover-red');
        }

        for (let k = 0; k < allSubcategories.length; k++) {
            allSubcategories[k].classList.add('d-none');
        }
    }
</script>

<style>
    .border-hover {
        border: 1px solid #FC1000 !important;
    }

    .border-subcategory-hover {
        border: 1px solid white;
    }

    .border-subcategory-hover:hover {
        border: 1px solid #FC1000;
    }

    .icon-hover-gray {
        color: rgba(129, 131, 149, 1);
    }

    .icon-hover-red {
        color: #FC1000 !important;
    }
</style>
