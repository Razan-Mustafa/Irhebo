<aside class="app-sidebar" id="sidebar">
    <div class="main-sidebar-header">
        <a href="{{ route('home.index') }}" class="header-logo">
            <img src="{{ asset('build/assets/images/media/temp-logo.png') }}" alt="logo" class="desktop-logo">
            <img src="{{ asset('build/assets/images/media/temp-logo.png') }}" alt="logo" class="toggle-logo">
            <img src="{{ asset('build/assets/images/media/temp-logo.png') }}" alt="logo" class="desktop-dark">
            <img src="{{ asset('build/assets/images/media/temp-logo.png') }}" alt="logo" class="toggle-dark">
            <img src="{{ asset('build/assets/images/media/temp-logo.png') }}" alt="logo" class="desktop-white">
            <img src="{{ asset('build/assets/images/media/temp-logo.png') }}" alt="logo" class="toggle-white">
        </a>
    </div>
    <div class="main-sidebar" id="sidebar-scroll">
        <nav class="main-menu-container nav nav-pills flex-column">

            @if (auth()->guard('freelancer')->check())
                <ul class="main-menu">
                    <li class="slide__category"><span class="category-name">{{ __('main') }}</span></li>
                    <li class="slide">
                        <a href="{{ route('freelancer.home.index') }}" class="side-menu__item">
                            <i class="bx bx-home side-menu__icon"></i>
                            <span class="side-menu__label">{{ __('dashboard') }}</span>
                        </a>
                    </li>

                    <li class="slide__category"><span class="category-name">{{ __('pages') }}</span></li>


                    <li class="slide">
                        <a href="{{ route('freelancer.services.index') }}" class="side-menu__item">
                            <i class="bx bx-cube side-menu__icon"></i>
                            <span class="side-menu__label">{{ __('services') }}</span>
                        </a>
                    </li>

                    <li class="slide">
                        <a href="{{ route('freelancer.portfolios.index') }}" class="side-menu__item">
                            <i class="bx bx-image side-menu__icon"></i>
                            <span class="side-menu__label">{{ __('portfolios') }}</span>
                        </a>
                    </li>
                    <li class="slide">
                        <a href="{{ route('freelancer.requests.index') }}" class="side-menu__item">
                            <i class="bx bx-clipboard side-menu__icon"></i>
                            <span class="side-menu__label">{{ __('requests') }}</span>
                        </a>
                    </li>
                    <li class="slide">
                        <a href="{{ route('freelancer.quotations.index') }}" class="side-menu__item">
                            <i class="bx bx-file side-menu__icon"></i>
                            <span class="side-menu__label">{{ __('quotations') }}</span>
                        </a>
                    </li>
                    <li class="slide">
                        <a href="{{ route('freelancer.finances.index') }}" class="side-menu__item">
                            <i class="bx bx-coin side-menu__icon"></i>
                            <span class="side-menu__label">{{ __('finances') }}</span>
                        </a>
                    </li>
                    <li class="slide">
                        <a href="{{ route('freelancer.reviews.index') }}" class="side-menu__item">
                            <i class="bx bx-star side-menu__icon"></i>
                            <span class="side-menu__label">{{ __('Reviews') }}</span>
                        </a>
                    </li>

                    <li class="slide">
                        <a href="{{ route('freelancer.tickets.index') }}" class="side-menu__item">
                            <i class="bx bx-message side-menu__icon"></i>
                            <span class="side-menu__label">{{ __('support_tickets') }} </span>
                        </a>
                    </li>


                </ul>
            @elseif(auth()->guard('admin')->check())
                <ul class="main-menu">
                    <li class="slide__category"><span class="category-name">{{ __('main') }}</span></li>
                    <li class="slide">
                        <a href="{{ route('home.index') }}" class="side-menu__item">
                            <i class="bx bx-home side-menu__icon"></i>
                            <span class="side-menu__label">{{ __('dashboard') }}</span>
                        </a>
                    </li>

                    <li class="slide__category"><span class="category-name">{{ __('pages') }}</span></li>
                    <li class="slide has-sub">
                        <a href="javascript:void(0);" class="side-menu__item">
                            <i class="bx bx-user side-menu__icon"></i>
                            <span class="side-menu__label">{{ __('users') }}</span>
                            <i class="fe fe-chevron-right side-menu__angle"></i>
                        </a>
                        <ul class="slide-menu">
                            <li class="slide">
                                <a href="{{ route('admins.index') }}" class="side-menu__item">
                                    <i class="bx bx-shield-quarter side-menu__icon"></i>
                                    <span class="side-menu__label">{{ __('administrators') }}</span>
                                </a>
                            </li>

                            <li class="slide">
                                <a href="{{ route('clients.index') }}" class="side-menu__item">
                                    <i class="bx bx-user side-menu__icon"></i>
                                    <span class="side-menu__label">{{ __('clients') }}</span>
                                </a>
                            </li>
                            <li class="slide">
                                <a href="{{ route('freelancers.index') }}" class="side-menu__item">
                                    <i class="bx bx-briefcase side-menu__icon"></i>
                                    <span class="side-menu__label">{{ __('freelancers') }}</span>
                                </a>
                            </li>
                            <li class="slide">
                                <a href="{{ route('roles.index') }}" class="side-menu__item">
                                    <i class="bx bx-key side-menu__icon"></i>
                                    <span class="side-menu__label">{{ __('roles') }}</span>
                                </a>
                            </li>
                        </ul>
                    </li>


                    {{-- <li class="slide">
                    <a href="{{ route('countries.index') }}" class="side-menu__item">
                        <i class="bx bx-globe side-menu__icon"></i>
                        <span class="side-menu__label">{{ __('countries') }}</span>
                    </a>
                </li> --}}

                    <li class="slide has-sub">
                        <a href="javascript:void(0);" class="side-menu__item">
                            <i class="bx bx-category-alt side-menu__icon"></i>
                            <span class="side-menu__label">{{ __('categories_management') }}</span>
                            <i class="fe fe-chevron-right side-menu__angle"></i>
                        </a>
                        <ul class="slide-menu">
                            <li class="slide">
                                <a href="{{ route('categories.index') }}" class="side-menu__item">
                                    <i class="bx bx-category side-menu__icon"></i>
                                    <span class="side-menu__label">{{ __('categories') }}</span>
                                </a>
                            </li>
                            <li class="slide">
                                <a href="{{ route('subCategories.index') }}" class="side-menu__item">
                                    <i class="bx bx-layer side-menu__icon"></i>
                                    <span class="side-menu__label">{{ __('sub_categories') }}</span>
                                </a>
                            </li>
                            <li class="slide">
                                <a href="{{ route('tags.index') }}" class="side-menu__item">
                                    <i class="bx bx-tag side-menu__icon"></i>
                                    <span class="side-menu__label">{{ __('tags') }}</span>
                                </a>
                            </li>
                            <li class="slide">
                                <a href="{{ route('plans.index') }}" class="side-menu__item">
                                    <i class="bx bx-file side-menu__icon"></i>
                                    <span class="side-menu__label">{{ __('plans') }}</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="slide">
                        <a href="{{ route('services.index') }}" class="side-menu__item">
                            <i class="bx bx-cube side-menu__icon"></i>
                            <span class="side-menu__label">{{ __('services') }}</span>
                        </a>
                    </li>

                    <li class="slide">
                        <a href="{{ route('portfolios.index') }}" class="side-menu__item">
                            <i class="bx bx-image side-menu__icon"></i>
                            <span class="side-menu__label">{{ __('portfolios') }}</span>
                        </a>
                    </li>
                    <li class="slide">
                        <a href="{{ route('requests.index') }}" class="side-menu__item">
                            <i class="bx bx-clipboard side-menu__icon"></i>
                            <span class="side-menu__label">{{ __('requests') }}</span>
                        </a>
                    </li>
                    <li class="slide">
                        <a href="{{ route('quotations.index') }}" class="side-menu__item">
                            <i class="bx bx-file side-menu__icon"></i>
                            <span class="side-menu__label">{{ __('quotations') }}</span>
                        </a>
                    </li>
                    <li class="slide">
                        <a href="{{ route('finances.index') }}" class="side-menu__item">
                            <i class="bx bx-coin side-menu__icon"></i>
                            <span class="side-menu__label">{{ __('finances') }}</span>
                        </a>
                    </li>
                    <li class="slide">
                        <a href="{{ route('reviews.index') }}" class="side-menu__item">
                            <i class="bx bx-star side-menu__icon"></i>
                            <span class="side-menu__label">{{ __('Reviews') }}</span>
                        </a>
                    </li>
                    {{-- <li class="slide">
                    <a href="{{ route('filters.index') }}" class="side-menu__item">
                        <i class="bx bx-filter side-menu__icon"></i>
                        <span class="side-menu__label">{{ __('filters') }}</span>
                    </a>
                </li> --}}

                    {{-- <li class="slide">
                    <a href="{{ route('features.index') }}" class="side-menu__item">
                        <i class="bx bx-check-square side-menu__icon"></i>
                        <span class="side-menu__label">{{ __('fixed_features') }}</span>
                    </a>
                </li> --}}

                    <li class="slide">
                        <a href="{{ route('tickets.index') }}" class="side-menu__item">
                            <i class="bx bx-message side-menu__icon"></i>
                            <span class="side-menu__label">{{ __('support_tickets') }} </span>
                        </a>
                    </li>
                    <li class="slide has-sub">

                        <a href="javascript:void(0);" class="side-menu__item">
                            <i class="bx bx-cog side-menu__icon"></i>
                            <span class="side-menu__label">{{ __('general_info') }}</span>
                            <i class="fe fe-chevron-right side-menu__angle"></i>
                        </a>
                        <ul class="slide-menu">
                            <li class="slide has-sub">
                                <a href="javascript:void(0);" class="side-menu__item">
                                    <i class="bx bx-image side-menu__icon"></i>
                                    <span class="side-menu__label">{{ __('sliders') }}</span>
                                    <i class="fe fe-chevron-right side-menu__angle"></i>
                                </a>
                                <ul class="slide-menu">
                                    <li class="slide">
                                        <a href="{{ route('sliders.mobileSliders') }}" class="side-menu__item">
                                            <i class="bx bx-mobile side-menu__icon"></i>
                                            <span class="side-menu__label">{{ __('mobile_intro_screens') }}</span>
                                        </a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{ route('sliders.webSliders') }}" class="side-menu__item">
                                            <i class="bx bx-desktop side-menu__icon"></i>
                                            <span class="side-menu__label">{{ __('web_sliders') }}</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="slide">
                                <a href="{{ route('professions.index') }}" class="side-menu__item">
                                    <i class="bx bx-hard-hat side-menu__icon"></i>
                                    <span class="side-menu__label">{{ __('professions') }}</span>
                                </a>
                            </li>
                            <li class="slide">
                                <a href="{{ route('general.generalInfo') }}" class="side-menu__item">
                                    <i class="bx bx-cog side-menu__icon"></i>
                                    <span class="side-menu__label">{{ __('general') }}</span>
                                </a>
                            </li>
                            <li class="slide">
                                <a href="{{ route('general.privacyPolicy') }}" class="side-menu__item">
                                    <i class="bx bx-shield-quarter side-menu__icon"></i>
                                    <span class="side-menu__label">{{ __('privacy_policy') }}</span>
                                </a>
                            </li>
                            <li class="slide">
                                <a href="{{ route('general.terms') }}" class="side-menu__item">
                                    <i class="bx bx-lock side-menu__icon"></i>
                                    <span class="side-menu__label">{{ __('terms') }}</span>
                                </a>
                            </li>
                            <li class="slide">
                                <a href="{{ route('currencies.index') }}" class="side-menu__item">
                                    <i class="bx bx-dollar-circle side-menu__icon"></i>
                                    <span class="side-menu__label">{{ __('currencies') }}</span>
                                </a>
                            </li>
                            <li class="slide">
                                <a href="{{ route('faqs.index') }}" class="side-menu__item">
                                    <i class="bx bx-help-circle side-menu__icon"></i>
                                    <span class="side-menu__label">{{ __('faqs') }}</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                </ul>
            @endif


        </nav>
    </div>
</aside>
