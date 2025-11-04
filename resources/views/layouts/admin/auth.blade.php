<!DOCTYPE html>

<html lang="en">
<!--begin::Head-->
<head><base href="../../../"/>
    <title>پنل  مگریکو</title>
    <meta charset="utf-8" />
    <meta name="description"/>
    <meta name="keywords"/>
    <meta name="viewport" />
    <meta property="og:locale" />
    <meta property="og:type" />
    <meta property="og:title"/>
    <meta property="og:url"/>
    <meta property="og:site_name" />
    <link rel="shortcut icon" href="{{ asset('admin-assets/media/logos/logo.png') }}" />

    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link href="{{asset('admin-assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('admin-assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin-assets/css/font-style.css') }}" rel="stylesheet" type="text/css"/>
    <!--end::Global Stylesheets Bundle-->
</head>
<!--end::Head-->
<!--begin::Body-->
<body id="kt_body" class="app-blank app-blank">
<!--begin::Theme mode setup on page load-->
<script>var defaultThemeMode = "light"; var themeMode; if ( document.documentElement ) { if ( document.documentElement.hasAttribute("data-theme-mode")) { themeMode = document.documentElement.getAttribute("data-theme-mode"); } else { if ( localStorage.getItem("data-theme") !== null ) { themeMode = localStorage.getItem("data-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-theme", themeMode); }</script>
<!--end::Theme mode setup on page load-->
<!--begin::Root-->
<div class="d-flex flex-column flex-root" id="kt_app_root">
    <!--begin::Authentication - Sign-in -->
    <div class="d-flex flex-column flex-lg-row flex-column-fluid">
        <!--begin::Body-->
        <div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10 order-2 order-lg-1">
            <!--begin::Form-->
            <div class="d-flex flex-center flex-column flex-lg-row-fluid">
                <!--begin::Wrapper-->
                @yield('content')
                <!--end::Wrapper-->
            </div>
            <!--end::Form-->
        </div>
        <!--end::Body-->
        <!--begin::Aside-->
        <div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center order-1 order-lg-2" style="background-image: url({{asset('admin-assets/media/misc/auth-bg.png')}})">
            <!--begin::Content-->
            <div class="d-flex flex-column flex-center py-7 py-lg-15 px-5 px-md-15 w-100">
                <!--begin::Logo-->
                <a href="" class="mb-0 mb-lg-12">
                    <img alt="Logo" src="{{ asset('admin-assets/media/logos/logo.png') }}" class="h-200px h-lg-200px" />
                </a>
                <!--end::Logo-->
                <!--begin::Image-->
{{--                <img class="d-none d-lg-block mx-auto w-275px w-md-50 w-xl-500px mb-10 mb-lg-20" src="https://nebrasar.ir/public/admin-panel/image/about-img-4-1-600x598.png" alt="" />--}}
                <!--end::Image-->
                <!--begin::Title-->
                <h1 class="d-none d-lg-block text-white fs-2qx fw-bolder text-center mb-7">گروه آموزشی مگریکو</h1>
                <!--end::Title-->
                <!--begin::Text-->

                <!--end::Text-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Aside-->
    </div>
    <!--end::Authentication - Sign-in-->
</div>
<!--end::Root-->
<!--begin::Javascript-->
<script>var hostUrl = "assets/";</script>
<!--begin::Global Javascript Bundle(used by all pages)-->
<script src="{{asset('admin-assets/plugins/global/plugins.bundle.js')}}"></script>
<script src="{{asset('admin-assets/js/scripts.bundle.js')}}"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Custom Javascript(used by this page)-->
<script src="{{asset('admin-assets/js/custom/authentication/sign-in/general.js')}}"></script>
<!--end::Custom Javascript-->
<!--end::Javascript-->
@include('layouts.alert')
</body>
<!--end::Body-->
</html>
