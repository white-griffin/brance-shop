<!DOCTYPE html>
<html direction="rtl" lang="ar" dir="rtl" style="direction: rtl">
<!--begin::Head-->
<head>
    <base href=""/>
    <title>@yield('title')</title>
    <meta charset="utf-8"/>
    <meta name="description" content=""/>
    <meta name="keywords" content=""/>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US"/>
    <meta property="og:type" content="article"/>
    <meta property="og:title" content=""/>
    <meta property="og:url" content=""/>
    <meta property="og:site_name">
    <meta name="_token" content="{{ csrf_token() }}">
    <link rel="canonical" href=""/>
    <link rel="shortcut icon" href="{{ asset('admin-assets/media/logos/logo.png') }}"/>
    <!--begin::Fonts-->
{{--    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700"/>--}}
    <!--end::Fonts-->
    <!--begin::Page Vendor Stylesheets(used by this page)-->
    <link href="{{ asset('admin-assets/plugins/custom/prismjs/prismjs.bundle.rtl.css') }}" rel="stylesheet"
          type="text/css"/>
    <!--end::Page Vendor Stylesheets-->
    <!--begin::Vendor Stylesheets(used by this page)-->
{{--<link href="{{ asset('admin-assets/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet" type="text/css" />--}}
{{--<link href="{{ asset('admin-assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />--}}
<!--end::Vendor Stylesheets-->
    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link href="{{ asset('admin-assets/plugins/global/plugins.bundle.rtl.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('admin-assets/css/style.bundle.rtl.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('admin-assets/css/persian-datepicker.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('admin-assets/css/fileinput.min.css') }}" rel="stylesheet" type="text/css"/>


    <!--end::Global Stylesheets Bundle-->
    <!--begin::Global Stylesheets Bundle(used by all pages)-->
<link href="{{ asset('admin-assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
{{--<link href="{{ asset('admin-assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />--}}
<!--end::Global Stylesheets Bundle-->

    <link href="{{ asset('admin-assets/css/font-style.css') }}" rel="stylesheet" type="text/css"/>
    @yield('style')

    <script src="{{ asset('admin-assets/plugins/global/plugins.bundle.js') }}"></script>

    @yield('top-scripts')

    <style>
        .select2-container--bootstrap5
        .select2-selection--multiple
        .select2-selection__rendered
        .select2-selection__choice
        .select2-selection__choice__remove {
            right: 0px !important;
        }

        .select2-container--bootstrap5
        .select2-selection--multiple:not(.form-select-sm):not(.form-select-lg)
        .select2-selection__choice
        .select2-selection__choice__display {
            padding-right: 0.5rem !important;
        }
    </style>
</head>
<!--end::Head-->
<!--begin::Body-->
<body id="kt_app_body" data-kt-app-layout="dark-sidebar" data-kt-app-header-fixed="true"
      data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true"
      data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true"
      data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true" class="app-default">
<style>

</style>
<!--begin::Theme mode setup on page load-->
<script>var defaultThemeMode = "light";
    var themeMode;
    if (document.documentElement) {
        if (document.documentElement.hasAttribute("data-theme-mode")) {
            themeMode = document.documentElement.getAttribute("data-theme-mode");
        } else {
            if (localStorage.getItem("data-theme") !== null) {
                themeMode = localStorage.getItem("data-theme");
            } else {
                themeMode = defaultThemeMode;
            }
        }
        if (themeMode === "system") {
            themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
        }
        document.documentElement.setAttribute("data-theme", themeMode);
    }</script>
<!--end::Theme mode setup on page load-->
<!--begin::App-->
<div class="d-flex flex-column flex-root app-root" id="kt_app_root">
    <!--begin::Page-->
    <div class="app-page flex-column flex-column-fluid" id="kt_app_page">

    @include('admin.partials.header')

    <!--begin::Wrapper-->
        <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">

        @include('admin.partials.sidebar')

        <!--begin::Main-->
            <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
                <!--begin::Content wrapper-->
                <div class="d-flex flex-column flex-column-fluid">

                @include('admin.partials.toolbar')

                <!--begin::Content-->
                    <div id="kt_app_content" class="app-content flex-column-fluid">
                        <!--begin::Content container-->
                        <div id="kt_app_content_container" class="app-container container">

                            @yield('content')

                        </div>
                        <!--end::Content container-->
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Content wrapper-->

                @include('admin.partials.footer')

            </div>
            <!--end:::Main-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Page-->
</div>
<!--end::App-->
<!--begin::Scrolltop-->
<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
    <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
    <span class="svg-icon">
				<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
					<rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)"
                          fill="currentColor"/>
					<path
                        d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z"
                        fill="currentColor"/>
				</svg>
			</span>
    <!--end::Svg Icon-->
</div>
<!--end::Scrolltop-->
<!--begin::Javascript-->
<script>var hostUrl = "assets/";</script>
<!--begin::Global Javascript Bundle(used by all pages)-->
<script src="{{ asset('admin-assets/js/scripts.bundle.js') }}"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Vendors Javascript(used by this page)-->
{{--<script src="{{ asset('admin-assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>--}}
{{--<script src="{{ asset('admin-assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>--}}
<!--end::Vendors Javascript-->
<!--begin::Custom Javascript(used by this page)-->
<script src="{{ asset('admin-assets/js/widgets.bundle.js') }}"></script>
<script src="{{ asset('admin-assets/js/persian-datepicker.min.js') }}"></script>
<script src="{{ asset('admin-assets/js/persian-date.min.js') }}"></script>
<script src="{{ asset('admin-assets/js/custom/fileuploader/fileinput.min.js') }}"></script>
<script src="{{ asset('admin-assets/js/custom/fileuploader/buffer.min.js') }}"></script>
<script src="{{ asset('admin-assets/js/custom/fileuploader/filetype.min.js') }}"></script>
<script src="{{ asset('admin-assets/js/custom/fileuploader/piexif.js') }}"></script>
<script src="{{ asset('admin-assets/js/custom/fileuploader/sortable.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.min.js"></script>

<script src="{{ asset('admin-assets/js/custom/widgets.js') }}"></script>
<script src="{{asset('admin-assets/js/custom/recorder/recorder.js')}}"></script>
{{--<script src="{{ asset('admin-assets/js/custom/apps/chat/chat.js') }}"></script>--}}
{{--<script src="{{ asset('admin-assets/js/custom/utilities/modals/upgrade-plan.js') }}"></script>--}}
{{--<script src="{{ asset('admin-assets/js/custom/utilities/modals/create-app.js') }}"></script>--}}
{{--<script src="{{ asset('admin-assets/js/custom/utilities/modals/new-target.js') }}"></script>--}}
{{--<script src="{{ asset('admin-assets/js/custom/utilities/modals/users-search.js') }}"></script>--}}
<!--end::Custom Javascript-->
<!--end::Javascript-->
@include('layouts.alert')
@yield('scripts')

</body>
<!--end::Body-->
</html>
