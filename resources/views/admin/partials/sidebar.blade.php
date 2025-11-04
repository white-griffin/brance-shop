
<!--begin::sidebar-->

<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar"
     data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px"
     data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
    <!--begin::Logo-->
    <div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo">
        <!--begin::Logo image-->
        <a href="">
            <img alt="Logo" src="{{ asset('admin-assets/media/logos/logo.png') }}"
                 class="h-25px app-sidebar-logo-default"/>
            <img alt="Logo" src="{{ asset('admin-assets/media/logos/logo.png') }}"
                 class="h-20px app-sidebar-logo-minimize"/>
        </a>
        <!--end::Logo image-->
        <!--begin::Sidebar toggle-->
        <div id="kt_app_sidebar_toggle"
             class="app-sidebar-toggle btn btn-icon btn-shadow btn-sm btn-color-muted btn-active-color-primary body-bg h-30px w-30px position-absolute top-50 start-100 translate-middle rotate"
             data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
             data-kt-toggle-name="app-sidebar-minimize">
            <!--begin::Svg Icon | path: icons/duotune/arrows/arr079.svg-->
            <span class="svg-icon svg-icon-2 rotate-180">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path opacity="0.5"
                          d="M14.2657 11.4343L18.45 7.25C18.8642 6.83579 18.8642 6.16421 18.45 5.75C18.0358 5.33579 17.3642 5.33579 16.95 5.75L11.4071 11.2929C11.0166 11.6834 11.0166 12.3166 11.4071 12.7071L16.95 18.25C17.3642 18.6642 18.0358 18.6642 18.45 18.25C18.8642 17.8358 18.8642 17.1642 18.45 16.75L14.2657 12.5657C13.9533 12.2533 13.9533 11.7467 14.2657 11.4343Z"
                          fill="currentColor"/>
                    <path
                        d="M8.2657 11.4343L12.45 7.25C12.8642 6.83579 12.8642 6.16421 12.45 5.75C12.0358 5.33579 11.3642 5.33579 10.95 5.75L5.40712 11.2929C5.01659 11.6834 5.01659 12.3166 5.40712 12.7071L10.95 18.25C11.3642 18.6642 12.0358 18.6642 12.45 18.25C12.8642 17.8358 12.8642 17.1642 12.45 16.75L8.2657 12.5657C7.95328 12.2533 7.95328 11.7467 8.2657 11.4343Z"
                        fill="currentColor"/>
                </svg>
            </span>
            <!--end::Svg Icon-->
        </div>
        <!--end::Sidebar toggle-->
    </div>
    <!--end::Logo-->
    <!--begin::sidebar menu-->
    <div class="app-sidebar-menu overflow-hidden flex-column-fluid">
        <!--begin::Menu wrapper-->
        <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper hover-scroll-overlay-y my-5"
             data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto"
             data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer"
             data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px"
             data-kt-scroll-save-state="true">
            <!--begin::Menu-->
            <div class="menu menu-column menu-rounded menu-sub-indention px-3" id="#kt_app_sidebar_menu"
                 data-kt-menu="true" data-kt-menu-expand="false">

                <!-- dashboard -->
                <div class="menu-item">
                    <!--begin:Menu link-->
                    <a class="menu-link" href="{{route('admin.dashboard')}}">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                            <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                            <span class="svg-icon svg-icon-2">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <rect x="2" y="2" width="9" height="9" rx="2" fill="currentColor"/>
                                    <rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="currentColor"/>
                                    <rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2" fill="currentColor"/>
                                    <rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="currentColor"/>
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title @if(Route::currentRouteName() == "admin.dashboard") text-white @endif ">داشبورد</span>
                    </a>
                    <!--end:Menu link-->
                </div>
                @can('sliders.all')
                    <!-- sliders -->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link" href="{{route('admin.sliders.list')}}">
                            <span class="menu-icon">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <rect x="2" y="2" width="9" height="9" rx="2" fill="currentColor"/>
                                        <rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="currentColor"/>
                                        <rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2" fill="currentColor"/>
                                        <rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="currentColor"/>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="menu-title @if(Route::currentRouteName() == "admin.sliders.list") text-white @endif ">اسلایدر</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                @endcan

                @can('instagram_posts.all')
                    <!-- instagram -->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link" href="{{route('admin.instagram-posts.list')}}">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                            <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                            <span class="svg-icon svg-icon-2">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <rect x="2" y="2" width="9" height="9" rx="2" fill="currentColor"/>
                                    <rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="currentColor"/>
                                    <rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2" fill="currentColor"/>
                                    <rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="currentColor"/>
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                            <span class="menu-title @if(Route::currentRouteName() == "admin.instagram-posts.list") text-white @endif ">پست های اینستاگرام </span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                @endcan


                    @can('admins.all')
                        <!-- admins -->
                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion
                            @if(Route::currentRouteName() == "admin.admins.all" ||
                                Route::currentRouteName() == "admin.admins.create" ||
                                Route::currentRouteName() == "admin.admins.edit" )
                                show
                            @endif
                        ">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm007.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                         fill="none">
                                        <path
                                            d="M21 9V11C21 11.6 20.6 12 20 12H14V8H20C20.6 8 21 8.4 21 9ZM10 8H4C3.4 8 3 8.4 3 9V11C3 11.6 3.4 12 4 12H10V8Z"
                                            fill="currentColor"></path>
                                        <path d="M15 2C13.3 2 12 3.3 12 5V8H15C16.7 8 18 6.7 18 5C18 3.3 16.7 2 15 2Z"
                                              fill="currentColor"></path>
                                        <path opacity="0.3"
                                              d="M9 2C10.7 2 12 3.3 12 5V8H9C7.3 8 6 6.7 6 5C6 3.3 7.3 2 9 2ZM4 12V21C4 21.6 4.4 22 5 22H10V12H4ZM20 12V21C20 21.6 19.6 22 19 22H14V12H20Z"
                                              fill="currentColor"></path>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="menu-title">  دسترسی مدیران </span>
                            <span class="menu-arrow"></span>
                        </span>
                            <div class="menu-sub menu-sub-accordion menu-active-bg">

                                <div class="menu-item">
                                    @can('admins.list')
                                        <a class="menu-link" href="{{route('admin.admins.all')}}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title
                                            @if(Route::currentRouteName() == "admin.admins.all" ||
                                                Route::currentRouteName() == "admin.admins.create" ||
                                                Route::currentRouteName() == "admin.admins.edit" ||
                                                Route::currentRouteName() == "admin.admins.update" )
                                                 text-white @endif"> مدیریت مدیران </span>
                                        </a>
                                    @endcan

                                    @canany(['roles.all','roles.list'])
                                        <a class="menu-link" href="{{route('admin.roles.all')}}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                            <span class="menu-title
                                        @if(Route::currentRouteName() == "admin.roles.all") text-white @endif">فهرست نقش ها  </span>
                                        </a>
                                    @endcanany
                                    @canany(['permissions.all','permissions.list'])
                                        <a class="menu-link" href="{{route('admin.permissions.all')}}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                            <span class="menu-title @if(Route::currentRouteName() == "admin.permissions.all") text-white @endif"> فهرست مجوزها </span>
                                        </a>
                                    @endcanany

                                </div>
                            </div>
                        </div>
                    @endcan

                    @can('users.all')
                        <!-- users account -->
                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion
                        @if(Route::currentRouteName() == "admin.users.all" ||
                            Route::currentRouteName() == "admin.users.create" ||
                            Route::currentRouteName() == "admin.users.edit" ||
                            Route::currentRouteName() == "admin.statistics.users" ||
                            Route::currentRouteName() == "admin.users.sms-list"
                             )
                        show
                        @endif
                        ">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm007.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                         fill="none">
                                        <path
                                            d="M21 9V11C21 11.6 20.6 12 20 12H14V8H20C20.6 8 21 8.4 21 9ZM10 8H4C3.4 8 3 8.4 3 9V11C3 11.6 3.4 12 4 12H10V8Z"
                                            fill="currentColor"></path>
                                        <path d="M15 2C13.3 2 12 3.3 12 5V8H15C16.7 8 18 6.7 18 5C18 3.3 16.7 2 15 2Z"
                                              fill="currentColor"></path>
                                        <path opacity="0.3"
                                              d="M9 2C10.7 2 12 3.3 12 5V8H9C7.3 8 6 6.7 6 5C6 3.3 7.3 2 9 2ZM4 12V21C4 21.6 4.4 22 5 22H10V12H4ZM20 12V21C20 21.6 19.6 22 19 22H14V12H20Z"
                                              fill="currentColor"></path>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="menu-title">مدیریت حساب های کاربری </span>
                            <span class="menu-arrow"></span>
                        </span>
                            <div class="menu-sub menu-sub-accordion menu-active-bg">

                                <div class="menu-item">
                                    @canany(['users.all','users.list'])
                                        <a class="menu-link" href="{{route('admin.users.all')}}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                                    <span class="menu-title
                                            @if(Route::currentRouteName() == "admin.users.all") text-white @endif">فهرست کاربران</span>
                                        </a>
                                    @endcanany
                                    @can('users.create')
                                        <a class="menu-link" href="{{route('admin.users.create')}}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                                        <span class="menu-title
                                            @if(Route::currentRouteName() == "admin.users.create") text-white @endif
                                                ">ثبت کاربر جدید</span>
                                        </a>
                                    @endcan


                                </div>
                            </div>

                        </div>
                    @endcan

                    @can('categories.all')
                        <!-- Categories -->
                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion
                                            @if(
                                                Route::currentRouteName() == "admin.categories.blog-categories" ||
                                                Route::currentRouteName() == "admin.categories.product-categories" ||
                                                Route::currentRouteName() == "admin.categories.create" ||
                                                Route::currentRouteName() == "admin.categories.edit"
                                                )
                                            show @endif">
                            <span class="menu-link">
                                <span class="menu-icon">
                                    <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm007.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                             fill="none">
                                            <path
                                                d="M21 9V11C21 11.6 20.6 12 20 12H14V8H20C20.6 8 21 8.4 21 9ZM10 8H4C3.4 8 3 8.4 3 9V11C3 11.6 3.4 12 4 12H10V8Z"
                                                fill="currentColor"></path>
                                            <path d="M15 2C13.3 2 12 3.3 12 5V8H15C16.7 8 18 6.7 18 5C18 3.3 16.7 2 15 2Z"
                                                  fill="currentColor"></path>
                                            <path opacity="0.3"
                                                  d="M9 2C10.7 2 12 3.3 12 5V8H9C7.3 8 6 6.7 6 5C6 3.3 7.3 2 9 2ZM4 12V21C4 21.6 4.4 22 5 22H10V12H4ZM20 12V21C20 21.6 19.6 22 19 22H14V12H20Z"
                                                  fill="currentColor"></path>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="menu-title">مدیریت دسته بندی ها </span>
                                <span class="menu-arrow"></span>
                            </span>
                            <div class="menu-sub menu-sub-accordion menu-active-bg">

                        <div class="menu-item">
                            @canany(['categories.all','categories.list'])
                                <a class="menu-link" href="{{route('admin.categories.product-categories')}}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                    <span class="menu-title
                                            @if(Route::currentRouteName() == "admin.categories.product-categories") text-white @endif
                                                "> دسته بندی های محصولات</span>
                                </a>
                                <a class="menu-link" href="{{route('admin.categories.blog-categories')}}">
                                                <span class="menu-bullet">
                                                    <span class="bullet bullet-dot"></span>
                                                </span>
                                    <span class="menu-title
                                                @if(Route::currentRouteName() == "admin.categories.blog-categories") text-white @endif
                                                    "> دسته بندی های وبلاگ</span>
                                </a>
                            @endcan

                            @can('categories.create')
                                <a class="menu-link" href="{{route('admin.categories.create')}}">
                                                            <span class="menu-bullet">
                                                                <span class="bullet bullet-dot"></span>
                                                            </span>
                                    <span class="menu-title
                                                            @if(Route::currentRouteName() == "admin.categories.create") text-white @endif">ثبت دسته بندی جدید</span>
                                </a>
                            @endcan
                            </div>
                        </div>
                        </div>
                    @endcan

                    @can('products.all')
                        <!-- Products -->
                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion
                                @if(
                                    Route::currentRouteName() == "admin.products.list"||
                                    Route::currentRouteName() == "admin.products.create"
                                    )
                                show
                                @endif">
                                <span class="menu-link">
                                                                <span class="menu-icon">
                                                                    <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm007.svg-->
                                                                    <span class="svg-icon svg-icon-2">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                                                             fill="none">
                                                                            <path
                                                                                d="M21 9V11C21 11.6 20.6 12 20 12H14V8H20C20.6 8 21 8.4 21 9ZM10 8H4C3.4 8 3 8.4 3 9V11C3 11.6 3.4 12 4 12H10V8Z"
                                                                                fill="currentColor"></path>
                                                                            <path d="M15 2C13.3 2 12 3.3 12 5V8H15C16.7 8 18 6.7 18 5C18 3.3 16.7 2 15 2Z"
                                                                                  fill="currentColor"></path>
                                                                            <path opacity="0.3"
                                                                                  d="M9 2C10.7 2 12 3.3 12 5V8H9C7.3 8 6 6.7 6 5C6 3.3 7.3 2 9 2ZM4 12V21C4 21.6 4.4 22 5 22H10V12H4ZM20 12V21C20 21.6 19.6 22 19 22H14V12H20Z"
                                                                                  fill="currentColor"></path>
                                                                        </svg>
                                                                    </span>
                                                                    <!--end::Svg Icon-->
                                                                </span>
                                                                <span class="menu-title">مدیریت محصولات </span>
                                                                <span class="menu-arrow"></span>
                                                            </span>
                            <div class="menu-sub menu-sub-accordion menu-active-bg">

                                <div class="menu-item">
                                    @can('products.list')
                                    <a class="menu-link" href="{{route('admin.products.list')}}">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                        <span class="menu-title
                                                    @if(Route::currentRouteName() == "admin.products.list") text-white @endif
                                                        ">لیست محصولات</span>
                                    </a>
                                    @endcan
                                    @can('products.create')
                                    <a class="menu-link" href="{{route('admin.products.create')}}">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                        <span class="menu-title
                                                    @if(Route::currentRouteName() == "admin.products.create") text-white @endif
                                                        ">ثبت محصول جدید</span>
                                    </a>
                                    @endcan
                                </div>
                            </div>

                        </div>
                    @endcan

                    @canany('orders.list')
                    <!-- Orders -->
                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion
                        @if(
                            Route::currentRouteName() == "admin.orders.list" ||
                            Route::currentRouteName() == "admin.payments.list"
                            )
                        show
                        @endif
                        ">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm007.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                         fill="none">
                                        <path
                                            d="M21 9V11C21 11.6 20.6 12 20 12H14V8H20C20.6 8 21 8.4 21 9ZM10 8H4C3.4 8 3 8.4 3 9V11C3 11.6 3.4 12 4 12H10V8Z"
                                            fill="currentColor"></path>
                                        <path d="M15 2C13.3 2 12 3.3 12 5V8H15C16.7 8 18 6.7 18 5C18 3.3 16.7 2 15 2Z"
                                              fill="currentColor"></path>
                                        <path opacity="0.3"
                                              d="M9 2C10.7 2 12 3.3 12 5V8H9C7.3 8 6 6.7 6 5C6 3.3 7.3 2 9 2ZM4 12V21C4 21.6 4.4 22 5 22H10V12H4ZM20 12V21C20 21.6 19.6 22 19 22H14V12H20Z"
                                              fill="currentColor"></path>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="menu-title">سفارشات </span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion menu-active-bg">

                            <div class="menu-item">
                                @can('orders.list')
                                    <a class="menu-link" href="{{route('admin.orders.list')}}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                        <span class="menu-title
                                            @if(Route::currentRouteName() == "admin.orders.list" )  text-white @endif">مدیریت سفارشات</span>
                                    </a>
                                @endcan

                                @can('payments.list')
                                    <a class="menu-link" href="{{route('admin.payments.list')}}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                        <span class="menu-title
                                            @if(Route::currentRouteName() == "admin.payments.list" )  text-white @endif">مدیریت پرداخت ها</span>
                                    </a>
                                @endcan

                            </div>
                        </div>

                    </div>
                @endcanany

                    @can('blogs.all')
                    <!-- Products -->
                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion
                                @if(
                                    Route::currentRouteName() == "admin.blogs.list"||
                                    Route::currentRouteName() == "admin.blogs.create"
                                    )
                                show
                                @endif">
                                <span class="menu-link">
                                                                <span class="menu-icon">
                                                                    <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm007.svg-->
                                                                    <span class="svg-icon svg-icon-2">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                                                             fill="none">
                                                                            <path
                                                                                d="M21 9V11C21 11.6 20.6 12 20 12H14V8H20C20.6 8 21 8.4 21 9ZM10 8H4C3.4 8 3 8.4 3 9V11C3 11.6 3.4 12 4 12H10V8Z"
                                                                                fill="currentColor"></path>
                                                                            <path d="M15 2C13.3 2 12 3.3 12 5V8H15C16.7 8 18 6.7 18 5C18 3.3 16.7 2 15 2Z"
                                                                                  fill="currentColor"></path>
                                                                            <path opacity="0.3"
                                                                                  d="M9 2C10.7 2 12 3.3 12 5V8H9C7.3 8 6 6.7 6 5C6 3.3 7.3 2 9 2ZM4 12V21C4 21.6 4.4 22 5 22H10V12H4ZM20 12V21C20 21.6 19.6 22 19 22H14V12H20Z"
                                                                                  fill="currentColor"></path>
                                                                        </svg>
                                                                    </span>
                                                                    <!--end::Svg Icon-->
                                                                </span>
                                                                <span class="menu-title">مدیریت وبلاگ </span>
                                                                <span class="menu-arrow"></span>
                                                            </span>
                        <div class="menu-sub menu-sub-accordion menu-active-bg">

                            <div class="menu-item">
                                @can('blogs.list')
                                    <a class="menu-link" href="{{route('admin.blogs.list')}}">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                        <span class="menu-title
                                                    @if(Route::currentRouteName() == "admin.blogs.list") text-white @endif
                                                        ">لیست وبلاگ</span>
                                    </a>
                                @endcan
                                @can('blogs.create')
                                    <a class="menu-link" href="{{route('admin.blogs.create')}}">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                        <span class="menu-title
                                                    @if(Route::currentRouteName() == "admin.blogs.create") text-white @endif
                                                        ">ثبت بلاگ جدید</span>
                                    </a>
                                @endcan
                            </div>
                        </div>

                    </div>
                @endcan

                @can('employees.all')
                    <!-- Products -->
                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion
                                @if(
                                    Route::currentRouteName() == "admin.employees.list"||
                                    Route::currentRouteName() == "admin.employees.create"
                                    )
                                show
                                @endif">
                                <span class="menu-link">
                                                                <span class="menu-icon">
                                                                    <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm007.svg-->
                                                                    <span class="svg-icon svg-icon-2">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                                                             fill="none">
                                                                            <path
                                                                                d="M21 9V11C21 11.6 20.6 12 20 12H14V8H20C20.6 8 21 8.4 21 9ZM10 8H4C3.4 8 3 8.4 3 9V11C3 11.6 3.4 12 4 12H10V8Z"
                                                                                fill="currentColor"></path>
                                                                            <path d="M15 2C13.3 2 12 3.3 12 5V8H15C16.7 8 18 6.7 18 5C18 3.3 16.7 2 15 2Z"
                                                                                  fill="currentColor"></path>
                                                                            <path opacity="0.3"
                                                                                  d="M9 2C10.7 2 12 3.3 12 5V8H9C7.3 8 6 6.7 6 5C6 3.3 7.3 2 9 2ZM4 12V21C4 21.6 4.4 22 5 22H10V12H4ZM20 12V21C20 21.6 19.6 22 19 22H14V12H20Z"
                                                                                  fill="currentColor"></path>
                                                                        </svg>
                                                                    </span>
                                                                    <!--end::Svg Icon-->
                                                                </span>
                                                                <span class="menu-title">مدیریت اعضا </span>
                                                                <span class="menu-arrow"></span>
                                                            </span>
                        <div class="menu-sub menu-sub-accordion menu-active-bg">

                            <div class="menu-item">
                                @can('employees.list')
                                    <a class="menu-link" href="{{route('admin.employees.list')}}">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                        <span class="menu-title
                                                    @if(Route::currentRouteName() == "admin.employees.list") text-white @endif
                                                        ">لیست اعضا</span>
                                    </a>
                                @endcan
                                @can('employees.create')
                                    <a class="menu-link" href="{{route('admin.employees.create')}}">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                        <span class="menu-title
                                                    @if(Route::currentRouteName() == "admin.employees.create") text-white @endif
                                                        ">ثبت عضو جدید</span>
                                    </a>
                                @endcan
                            </div>
                        </div>

                    </div>
                @endcan

                    @can('call-requests.all')
                    <!-- Products -->
                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion
                                @if(
                                    Route::currentRouteName() == "admin.call-requests.list"
                                    )
                                show
                                @endif">
                                <span class="menu-link">
                                                                <span class="menu-icon">
                                                                    <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm007.svg-->
                                                                    <span class="svg-icon svg-icon-2">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                                                             fill="none">
                                                                            <path
                                                                                d="M21 9V11C21 11.6 20.6 12 20 12H14V8H20C20.6 8 21 8.4 21 9ZM10 8H4C3.4 8 3 8.4 3 9V11C3 11.6 3.4 12 4 12H10V8Z"
                                                                                fill="currentColor"></path>
                                                                            <path d="M15 2C13.3 2 12 3.3 12 5V8H15C16.7 8 18 6.7 18 5C18 3.3 16.7 2 15 2Z"
                                                                                  fill="currentColor"></path>
                                                                            <path opacity="0.3"
                                                                                  d="M9 2C10.7 2 12 3.3 12 5V8H9C7.3 8 6 6.7 6 5C6 3.3 7.3 2 9 2ZM4 12V21C4 21.6 4.4 22 5 22H10V12H4ZM20 12V21C20 21.6 19.6 22 19 22H14V12H20Z"
                                                                                  fill="currentColor"></path>
                                                                        </svg>
                                                                    </span>
                                                                    <!--end::Svg Icon-->
                                                                </span>
                                                                <span class="menu-title">مدیریت درخواست های تماس </span>
                                                                <span class="menu-arrow"></span>
                                                            </span>
                        <div class="menu-sub menu-sub-accordion menu-active-bg">

                            <div class="menu-item">
                                @can('call-requests.list')
                                    <a class="menu-link" href="{{route('admin.call-requests.list')}}">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                        <span class="menu-title
                                                    @if(Route::currentRouteName() == "admin.call-requests.list") text-white @endif
                                                        ">لیست درخواست ها</span>
                                    </a>
                                @endcan

                            </div>
                        </div>

                    </div>
        @endcan


            </div>
            <!--end::Menu-->
        </div>
        <!--end::Menu wrapper-->
    </div>
    <!--end::sidebar menu-->
    <!--begin::Footer-->
    <div class="app-sidebar-footer flex-column-auto pt-2 pb-6 px-6" id="kt_app_sidebar_footer">
        <a href="https://preview.keenthemes.com/html/metronic/docs"
           class="btn btn-flex flex-center btn-custom btn-primary overflow-hidden text-nowrap px-0 h-40px w-100"
           data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss-="click"
           title="200+ in-house components and 3rd-party plugins">
            <span class="btn-label">فروشگاه مگریکو</span>
            <!--begin::Svg Icon | path: icons/duotune/general/gen005.svg-->
            <span class="svg-icon btn-icon svg-icon-2 m-0">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path opacity="0.3"
                          d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22ZM12.5 18C12.5 17.4 12.6 17.5 12 17.5H8.5C7.9 17.5 8 17.4 8 18C8 18.6 7.9 18.5 8.5 18.5L12 18C12.6 18 12.5 18.6 12.5 18ZM16.5 13C16.5 12.4 16.6 12.5 16 12.5H8.5C7.9 12.5 8 12.4 8 13C8 13.6 7.9 13.5 8.5 13.5H15.5C16.1 13.5 16.5 13.6 16.5 13ZM12.5 8C12.5 7.4 12.6 7.5 12 7.5H8C7.4 7.5 7.5 7.4 7.5 8C7.5 8.6 7.4 8.5 8 8.5H12C12.6 8.5 12.5 8.6 12.5 8Z"
                          fill="currentColor"/>
                    <rect x="7" y="17" width="6" height="2" rx="1" fill="currentColor"/>
                    <rect x="7" y="12" width="10" height="2" rx="1" fill="currentColor"/>
                    <rect x="7" y="7" width="6" height="2" rx="1" fill="currentColor"/>
                    <path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="currentColor"/>
                </svg>
            </span>
            <!--end::Svg Icon-->
        </a>
    </div>
    <!--end::Footer-->
</div>
<!--end::sidebar-->
