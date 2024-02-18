<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-white" id="sidenavAccordion">
        <div class="sb-sidenav-menu mt-1">
            <div class="nav">
                <div>
                    <a class="nav-link fw-semibold pb-0 {{ request()->routeIs('admin.dashboard') ? 'text-primary' : 'text-black'}}"
                       href="{{ route('admin.dashboard') }}"
                       style="font-size: 17px;">
                        <i class="bi-speedometer ps-1 pe-1"></i>Admin Panel
                    </a>
                </div>
                <div>
                    <div class="fw-semibold pb-1 pt-1" style="padding-left: 1.25rem; font-size: 17px;">
                        <i class="bi-graph-up-arrow pe-1"></i>Paneller
                    </div>
                    <div class="ps-1" style="font-size: 14px; line-height: 12px;">
                        <div class="pb-2">
                            <a href="{{ route('admin.productPanel.index') }}"
                               class="ps-3 text-decoration-none pb-1 {{ request()->routeIs('admin.productPanel.*') ? 'text-primary fw-semibold' : 'text-secondary'}}"">
                            Haryt paneli
                            </a>
                        </div>
                        <div class="pb-2">
                            <a href="{{ route('admin.orderPanel.index') }}"
                               class="ps-3 text-decoration-none pb-1 {{ request()->routeIs('admin.orderPanel.*') ? 'text-primary fw-semibold' : 'text-secondary'}}"">
                            Sargyt paneli
                            </a>
                        </div>
                        <div class="pb-2">
                            <a href="#" class="text-secondary ps-3 text-decoration-none pb-1">
                                Myhman paneli
                            </a>
                        </div>
                        <div class="pb-2">
                            <a href="#" class="text-secondary ps-3 text-decoration-none pb-1">
                                Admin paneli
                            </a>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="fw-semibold pb-1 pt-1" style="padding-left: 1.25rem; font-size: 17px;">
                        <i class="bi-cart4 pe-1"></i>Sargytlar
                    </div>
                    <div class="ps-1" style="font-size: 14px; line-height: 12px;">
                        <div class="pb-2">
                            <a href="{{ route('admin.orders.index') }}"
                               class="ps-3 text-decoration-none pb-1 {{ request()->routeIs('admin.orders.*') ? 'text-primary fw-semibold' : 'text-secondary'}}">
                                Sargytlar
                            </a>
                        </div>
                        <div class="pb-2">
                            <a href="#" class="text-secondary ps-3 text-decoration-none pb-1">
                                Hatlar
                            </a>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="fw-semibold pb-1 pt-1" style="padding-left: 1.25rem; font-size: 17px;">
                        <i class="bi-box pe-1"></i>Harytlar
                    </div>
                    <div class="ps-1" style="font-size: 14px; line-height: 12px;">
                        <div class="pb-2">
                            <a href="{{ route('admin.products.index') }}"
                               class="ps-3 text-decoration-none pb-1 {{ request()->routeIs('admin.products.*') ? 'text-primary fw-semibold' : 'text-secondary'}}">
                                Harytlar
                            </a>
                        </div>
                        <div class="pb-2">
                            <a href="{{ route('admin.categories.index') }}"
                               class="ps-3 text-decoration-none pb-1 {{ request()->routeIs('admin.categories.*') ? 'text-primary fw-semibold' : 'text-secondary'}}">
                                Kategoriýalar
                            </a>
                        </div>
                        <div class="pb-2">
                            <a href="{{ route('admin.brands.index') }}"
                               class="ps-3 text-decoration-none pb-1 {{ request()->routeIs('admin.brands.*') ? 'text-primary fw-semibold' : 'text-secondary'}}">
                                Brendlar
                            </a>
                        </div>
                        <div class="pb-2">
                            <a href="{{ route('admin.attributes.index') }}"
                               class="ps-3 text-decoration-none pb-1 {{ request()->routeIs('admin.attributes.*') ? 'text-primary fw-semibold' : 'text-secondary'}}">
                                Aýratynlyklar
                            </a>
                        </div>
                        <div class="pb-2">
                            <a href="{{ route('admin.attribute_values.index') }}"
                               class="ps-3 text-decoration-none pb-1 {{ request()->routeIs('admin.attribute_values.*') ? 'text-primary fw-semibold' : 'text-secondary'}}">
                                Bahalar
                            </a>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="fw-semibold pb-1 pt-1" style="padding-left: 1.25rem; font-size: 17px;">
                        <i class="bi-image pe-1"></i>Slaýderler
                    </div>
                    <div class="ps-1" style="font-size: 14px; line-height: 12px;">
                        <div class="pb-2">
                            <a href="{{ route('admin.sliders.index') }}"
                               class="ps-3 text-decoration-none pb-1 {{ request()->routeIs('admin.sliders.*') ? 'text-primary fw-semibold' : 'text-secondary'}}">
                                Sliders
                            </a>
                        </div>
                        <div class="pb-2">
                            <a href="{{ route('admin.banners.index') }}"
                               class="ps-3 text-decoration-none pb-1 {{ request()->routeIs('admin.banners.*') ? 'text-primary fw-semibold' : 'text-secondary'}}">
                                Banners
                            </a>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="fw-semibold pb-1 pt-1" style="padding-left: 1.25rem; font-size: 17px;">
                        <i class="bi-newspaper pe-1"></i>Habarlar
                    </div>
                    <div class="ps-1" style="font-size: 14px; line-height: 12px;">
                        <div class="pb-2">
                            <a href="{{ route('admin.news.index') }}"
                               class="ps-3 text-decoration-none pb-1 {{ request()->routeIs('admin.news.*') ? 'text-primary fw-semibold' : 'text-secondary'}}">
                                Habarlar
                            </a>
                        </div>
                        <div class="pb-2">
                            <a href="{{ route('admin.news_categories.index') }}"
                               class="ps-3 text-decoration-none pb-1 {{ request()->routeIs('admin.news_categories.*') ? 'text-primary fw-semibold' : 'text-secondary'}}">
                                Kategoriýalar
                            </a>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="fw-semibold pb-1 pt-1" style="padding-left: 1.25rem; font-size: 17px;">
                        <i class="bi-gear-wide-connected pe-1"></i>Sazlamalar
                    </div>
                    <div class="ps-1" style="font-size: 14px; line-height: 12px;">
                        <div class="pb-2">
                            <a href="{{ route('admin.users.index') }}"
                               class="ps-3 text-decoration-none pb-1 {{ request()->routeIs('admin.users.*') ? 'text-primary fw-semibold' : 'text-secondary'}}">
                                Ullanyjylar
                            </a>
                        </div>
                        <div class="pb-2">
                            <a href="{{ route('admin.locations.index') }}"
                               class="ps-3 text-decoration-none pb-1 {{ request()->routeIs('admin.locations.*') ? 'text-primary fw-semibold' : 'text-secondary'}}">
                                Ýerler
                            </a>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="fw-semibold pb-1 pt-1" style="padding-left: 1.25rem; font-size: 17px;">
                        <i class="bi-geo-alt pe-1"></i>Myhmanlar
                    </div>
                    <div class="ps-1" style="font-size: 14px; line-height: 12px;">
                        <div class="pb-2">
                            <a href="#"
                               class="text-secondary ps-3 text-decoration-none pb-1">
                                Ip salgylar
                            </a>
                        </div>
                        <div class="pb-2">
                            <a href="#"
                               class="text-secondary ps-3 text-decoration-none pb-1">
                                Ulgamlar
                            </a>
                        </div>
                        <div class="pb-2">
                            <a href="#"
                               class="text-secondary ps-3 text-decoration-none pb-1">
                                Synanşyklar
                            </a>
                        </div>
                        <div class="pb-2">
                            <a href="#"
                               class="text-secondary ps-3 text-decoration-none pb-1">
                                Myhmanlar
                            </a>
                        </div>
                    </div>
                </div>

                <div class="ps-1 pb-2">
                    <a href="{{ route('admin.config.index') }}"
                       class="ps-3 text-decoration-none pb-1 fw-semibold pt-1" style="padding-left: 1.25rem; font-size: 17px;" {{ request()->routeIs('admin.config.*') ? 'text-primary' : 'text-black'}}">
                        <i class="bi-gear-wide pe-1"></i>Configs
                    </a>
                </div>
            </div>
        </div>
    </nav>
</div>
