@extends('layouts.admin.admin')
@section('title','  داشبورد  ')

@section('content')


    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Container-->
        <div class="container-fluid" id="kt_content_container">
            <!--begin::Row-->
            <div class="row g-5 g-xl-10 mb-xl-10">

                <!--begin::Col-->
                <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-6 mb-xl-10">
                    <!--begin::Card widget 5-->
                    <div class="card card-flush  mb-xl-10">
                        <!--begin::Header-->
                        <div class="card-header pt-5">
                            <!--begin::Title-->
                            <div class="card-title d-flex flex-column">
                                <!--begin::Info-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Amount-->
                                    <span class="fs-2hx fw-bold text-dark me-2 lh-1 ls-n2">{{$todayLogin_count}}</span>
                                </div>
                                <!--end::Info-->
                                <!--begin::Subtitle-->
                                <span class="text-gray-400 pt-1 fw-semibold fs-6">لاگین کاربران امروز</span>
                                <!--end::Subtitle-->
                            </div>
                            <!--end::Title-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Card body-->
                        <div class="card-body d-flex pt-0">
                            <!--begin::Progress-->
                            <div class="d-flex align-items-center flex-column mt-6 w-100">

                                <a href="{{route('admin.users.today-logins')}}" class="btn btn-sm btn-light-success mx-1">
                                    <i class="fa fa-eye p-0 m-0"></i>
                                    مشاهده
                                </a>

                            </div>
                            <!--end::Progress-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card widget 5-->

                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->


        </div>
        <!--end::Container-->
    </div>
    <!--end::Content-->

@endsection
@section('scripts')
    <script src="{{ asset('admin-assets/js/admin-panel/dashboard.js') }}"></script>

@endsection
