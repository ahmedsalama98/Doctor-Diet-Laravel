<div id="app-sidepanel" class="app-sidepanel">
    <div id="sidepanel-drop" class="sidepanel-drop"></div>
    <div class="sidepanel-inner d-flex flex-column">
        <a href="#" id="sidepanel-close" class="sidepanel-close d-xl-none">&times;</a>
        <div class="app-branding">
            <a class="app-logo d-flex align-content-center justify-content-center" href="{{ route('dashboard') }}">

                <img class="logo-icon me-2" src="{{asset('logo.png')}}">
                <span class="logo-text">Doctor Diet</span>
            </a>

        </div>
        <!--//app-branding-->

        <nav id="app-nav-main" class="app-nav app-nav-main flex-grow-1">
            <ul class="app-menu list-unstyled accordion" id="menu-accordion">
                <li class="nav-item">
                    <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                    <a class="nav-link {{ Route::is('dashboard')?'active' :''}}" href="{{ route('dashboard') }}">
                        <span class="nav-icon">
                            <i class="fas fa-home "></i>

                         </span>
                        <span class="nav-link-text">
                                  {{ __('site.Dashboard') }}
                        </span>


                    </a>
                    <!--//nav-link-->


                    {{-- Admins --}}
                </li>
                <!--//nav-item-->
                <li class="nav-item">
                    <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                    <a class="nav-link {{ Route::is('admin.admins.*')?'active' :''}}" href="{{ route('admin.admins.index') }}">
                        <span class="nav-icon">
                            <i class="fas fa-chalkboard-teacher "></i>

                         </span>
                        <span class="nav-link-text">{{ __('site.ADMINS') }}</span>
                    </a>
                    <!--//nav-link-->
                </li>
                {{-- Admins --}}






             {{-- users --}}
                </li>
                <!--//nav-item-->
                <li class="nav-item">
                    <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                    <a class="nav-link {{ Route::is('admin.users.*')?'active' :''}}" href="{{ route('admin.users.index') }}">
                        <span class="nav-icon">
                            <i class="fas fa-users "></i>
                         </span>
                        <span class="nav-link-text">{{ __('site.users') }}</span>
                    </a>
                    <!--//nav-link-->
                </li>
                {{-- users --}}

                </li>


                {{-- food_categories --}}
                <!--//nav-item-->
                <li class="nav-item">
                    <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                    <a class="nav-link {{ Route::is('admin.food_categories.*')?'active' :''}}" href="{{ route('admin.food_categories.index') }}">
                        <span class="nav-icon">
                            <i class="fas fa-hotdog"></i>
                                                 </span>
                        <span class="nav-link-text">{{ __('site.food_categories') }}</span>
                    </a>
                    <!--//nav-link-->
                </li>
                {{-- food_categories --}}

                {{-- foods --}}
                <!--//nav-item-->
                <li class="nav-item">
                    <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                    <a class="nav-link {{ Route::is('admin.foods.*')?'active' :''}}" href="{{ route('admin.foods.index') }}">
                        <span class="nav-icon">
                            <i class="fas fa-drumstick-bite"></i>
                        </span>
                        <span class="nav-link-text">{{ __('site.foods') }}</span>
                    </a>
                    <!--//nav-link-->
                </li>
                {{-- foods --}}


                {{-- meal_categories --}}
                <!--//nav-item-->
                <li class="nav-item">
                    <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                    <a class="nav-link {{ Route::is('admin.meal_categories.*')?'active' :''}}" href="{{ route('admin.meal_categories.index') }}">
                        <span class="nav-icon">
                            <i class="fas fa-hamburger"></i>
                                                </span>
                        <span class="nav-link-text">{{ __('site.meal_categories') }}</span>
                    </a>
                    <!--//nav-link-->
                </li>
                {{-- meals --}}
                                {{-- meals --}}
                {{--  <!--//nav-item-->
                <li class="nav-item">
                    <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                    <a class="nav-link {{ Route::is('admin.meals.*')?'active' :''}}" href="{{ route('admin.meals.index') }}">
                        <span class="nav-icon">
                            <i class="fas fa-utensils"></i>
                        </span>
                        <span class="nav-link-text">{{ __('site.meals') }}</span>
                    </a>
                    <!--//nav-link-->
                </li>  --}}
                {{-- meals --}}

                {{-- meals --}}

                {{-- contacts --}}
                <!--//nav-item-->
                <li class="nav-item">
                    <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                    <a class="nav-link {{ Route::is('admin.contacts.*')?'active' :''}}" href="{{ route('admin.contacts.index') }}">
                        <span class="nav-icon"><i class="fas fa-file-signature"></i>

                        </span>

                        <span class="nav-link-text">{{ __('site.contacts') }}</span>
                    </a>
                    <!--//nav-link-->
                </li>
                {{-- contacts --}}

                {{-- settings --}}
                <!--//nav-item-->
                <li class="nav-item">
                    <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                    <a class="nav-link {{ Route::is('admin.settings.*')?'active' :''}}" href="{{ route('admin.settings.index') }}">
                        <span class="nav-icon">
                            <i class="fas fa-cogs"></i>                        </span>

                        <span class="nav-link-text">{{ __('site.settings') }}</span>
                    </a>
                    <!--//nav-link-->
                </li>
                {{-- settings --}}






                <!--//nav-item-->
            </ul>
            <!--//app-menu-->
        </nav>



    </div>
    <!--//sidepanel-inner-->
</div>
