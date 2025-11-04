@extends('layouts.admin.admin')
@section('title','  کاربران  ')
@section('pageTitle',' لیست کاربران ')
@section('content')
    <div class="d-flex flex-end mb-5">
        <button type="button" class="btn  btn-primary px-4 py-2 ml-4" data-bs-toggle="collapse"
                href="#student_filters" role="button"
                aria-expanded="false" aria-controls="collapseExample" style="margin-left: 5px!important;">
            فیلتر
            <i class="fa fa-filter p-0 m-0"></i>
        </button>
    </div>
    <div class="card mb-5 pb-3 mb-xl-8 collapse @if(request()->has('first_name')||request()->has('last_name')||request()->has('mobile')) show @else @endif" id="student_filters">
        <form action="" class="form remove-empty-values" method="get" id="remove-empty-values">
            <!--begin::Header-->
            <div class="card-header border-0 pt-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bolder fs-3 mb-1">
                        <i class="fa fa-search text-white pl-1"></i>
                        جستجوی پیشرفته
                    </span>
                </h3>
            </div>
            <div class="card-body py-3">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-12">
                        <div class="form-group">
                            <label class="form-label fs-6 fw-bolder text-dark">جستجو بر اساس نام
                            </label>
                            <input class="form-control form-control-lg form-control-solid" name="first_name"
                                   placeholder=""
                                   value="{{ request()->has('first_name') ? request()->get('first_name') : null }}"/>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12">
                        <div class="form-group">
                            <label class="form-label fs-6 fw-bolder text-dark">جستجو بر اساس نام خانوادگی
                            </label>
                            <input class="form-control form-control-lg form-control-solid" name="last_name"
                                   placeholder=""
                                   value="{{ request()->has('last_name') ? request()->get('last_name') : null }}"/>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12">
                        <div class="form-group">
                            <label class="form-label fs-6 fw-bolder text-dark">جستجو بر اساس شماره همراه
                            </label>
                            <input class="form-control form-control-lg form-control-solid" name="mobile" placeholder=""
                                   value="{{ request()->has('mobile') ? request()->get('mobile') : null }}"/>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12">
                        <div class="form-group">
                            <label class="form-label fs-6 fw-bolder text-dark">جستجو بر اساس کد ملی
                            </label>
                            <input class="form-control form-control-lg form-control-solid" name="national_code" placeholder=""
                                   value="{{ request()->has('national_code') ? request()->get('national_code') : null }}"/>
                        </div>
                    </div>

                </div>
                <br/>
                <div class="d-flex  flex-end">
                    <a href="{{route('admin.users.all')}}" class="btn btn-sm btn-light-danger mx-1">
                        <i class="fa fa-eraser p-0 m-0"></i>
                        حذف فیلترها
                    </a>
                    <button type="submit" class="btn btn-sm btn-light-primary mx-1">
                        <i class="fa fa-search"></i>
                        فیلتر
                    </button>
                </div>
            </div>
        </form>
    </div>

    <div class="card" data-select2-id="select2-data-131-rhmf">
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder fs-3 mb-1"> فهرست کاربران </span>
            </h3>
            <div class="card-toolbar">
                <a href="{{route('admin.users.create')}}" class="btn btn-sm btn-light-success">
                    ثبت کاربر جدید
                </a>


            </div>
        </div>
        <!--begin::Card body-->
        <div class="card-body pt-0">

            <!--begin::Table-->
            <div id="kt_customers_table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                <div class="table-responsive">
                    <!--begin::Table-->
                    <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                        <!--begin::Table head-->
                        <thead>
                        @include('admin.users.thead')
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody>
                        @if($users->count() > 0)
                            @foreach($users as $user)
                                <tr>
                                    <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input widget-9-check" type="checkbox" value="1" />
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="symbol symbol-45px me-5">
                                                <img src="{{$user->webPresent()->avatar}}" alt="" />
                                            </div>
                                            <div class="d-flex justify-content-start flex-column">
                                                <a href="#" class="text-dark fw-bold text-hover-primary fs-6">
                                                    {{ $user->webPresent()->fullName }}
                                                </a>
                                                <span class="text-muted fw-semibold text-muted d-block fs-7">
                                                    {{ $user->webPresent()->mobile }}
                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="text-dark fw-bold text-hover-primary d-block  ">
                                             {{$user->email}}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="text-dark fw-bold text-hover-primary d-block  ">
                                             {{$user->national_code}}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="text-dark fw-bold text-hover-primary d-block  ">
                                             {{$user->webPresent()->registerDate}}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="text-dark fw-bold text-hover-primary d-block  ">
                                             {!! $user->webPresent()->status !!}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center flex-shrink-0">
                                            <a href="{{ route('admin.users.edit', $user) }}"
                                               class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                <i class="fa fa-pencil" ></i>
                                            </a>
{{--                                            @include('admin.__modules.delete-link',['url' => route('admin.users.delete',$user)])--}}

                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" style="text-align:center;color:red">
                                    <a class="btn btn-danger" href="">
                                        اطلاعات موجود نیست <i class="icon-warning2 mr-3 icon-1x"></i></a></td>
                            </tr>
                        @endif
                        </tbody>
                        <!--end::Table body-->
                    </table>
                    <!--end::Table-->
                </div>
                <div class="row">
                    <div
                        class="col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end">
                    </div>
                </div>
            </div>
            <!--end::Table-->
            {{$users->links() }}
        </div>
        <!--end::Card body-->
    </div>


    <div class="modal fade" id="dictionary-modal-target"
         data-bs-backdrop="static"
         data-bs-keyboard="false" tabindex="-1"
         aria-labelledby="staticBackdropLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="dictionaryMembershipForm" class="modal-dictionary-content-form" method="post" action="javascript:void(0)">
                @csrf

                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="social-network-modal-target"
         data-bs-backdrop="static"
         data-bs-keyboard="false" tabindex="-1"
         aria-labelledby="staticBackdropLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="socialNetworkMembershipForm" class="modal-social-network-content-form" method="post" action="javascript:void(0)">
                @csrf

                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        @if(session('success'))
        Swal.fire({
            icon: 'success',
            confirmButtonText: 'متوجه شدم',
            title: 'عملیات موفق',
            text: '{{ session('success')}}',
        });
        @endif
    </script>
    <script>
        $('#remove-empty-values').submit(function () {
            $(this).find(':input').filter(function () {
                return !this.value;
            }).attr('disabled', 'disabled');
            return true;
        });
    </script>
@endsection
