@extends('layouts.admin.admin')
@section('title','  فعالیت ادمین ها   ')
@section('pageTitle',' فهرست  فعالیت ها   ')
@section('style')
    <style>
        .statistics-card{
            border-color: black !important;
            justify-content: center !important;
        }
        .statistic-card-body{
            border-top: 1px solid rgba(0, 0, 0, 0.125);
        }
    </style>
@endsection
@section('content')
    <div class="d-flex flex-end mb-5">
        <button type="button" class="btn  btn-primary px-4 py-2 ml-4" data-bs-toggle="collapse"
                href="#student_filters" role="button"
                aria-expanded="false" aria-controls="collapseExample" style="margin-left: 5px!important;">
            فیلتر
            <i class="fa fa-filter p-0 m-0"></i>
        </button>
    </div>
    <div class="card mb-5 pb-3 mb-xl-8 collapse @if(
        request()->has('admin')||request()->has('activityType')||request()->has('entityType')||
        request()->has('entityTitle') || request()->has('date_from') || request()->has('date_to')
       ) show @else @endif" id="student_filters">
        <form action="" class="form remove-empty-values" method="get" id="filter_form">
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

                    <div class="col-lg-2 col-md-2 col-sm-6 my-5">
                        <div class="mb-10 fv-row fv-plugins-icon-container">
                            <!--begin::Label-->
                            <label class="form-label fs-6 fw-bolder text-dark">جستجو بر اساس کاربر
                            </label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            @include('admin.__components.select-2-ajax', [
                                'name' => 'admin',
                                'url' => route('admin.admins.search.ajax')
                                ])
                            <!--end::Input-->

                            <div class="fv-plugins-message-container invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12 my-5">
                        <div class="form-group">
                            <label class="form-label fs-6 fw-bolder text-dark">عنوان
                            </label>
                            <input class="form-control form-control-lg form-control-solid" name="entityTitle"
                                   value="{{ request()->has('entityTitle') ? request()->get('entityTitle') : null }}"/>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12 my-5">
                        <div class="form-group">
                            <label class="form-label fs-6 fw-bolder text-dark">نوع entity
                            </label>
                            @include('admin.__components.select-2', [
                                 'name' => 'entityType',
                                 'items' => $entityTypes,
                                 'activeKey' => request()->has('entityType') ? request()->get('entityType') : null
                            ])
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12 my-5">
                        <div class="form-group">
                            <label class="form-label fs-6 fw-bolder text-dark">نوع فعالیت
                            </label>
                            @include('admin.__components.horizontal-radiobutton', [
                                 'name' => 'activityType',
                                 'items' => $logTypes,
                                 'activeKey' => request()->has('activityType') ? request()->get('activityType') : null
                            ])
                        </div>
                    </div>


                    <div class="col-lg-2 col-md-2 col-sm-12 my-5">
                        <div class="form-group">
                            <label class="form-label fs-6 fw-bolder text-dark">شروع تاریخ
                            </label>
                            @include('admin.__components.datepicker', [
                                'name' => 'date_from',
                                'initial_value' => false

                            ])
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-12 my-5">
                        <div class="form-group">
                            <label class="form-label fs-6 fw-bolder text-dark">پایان تاریخ
                            </label>
                            @include('admin.__components.datepicker', [
                                'name' => 'date_to',
                                'initial_value' => false
                            ])
                        </div>
                    </div>


                </div>
                <br/>
                <div class="d-flex  flex-end">
                    <a onclick="submitFilterForm(true)" class="btn btn-sm btn-light-info">
                        خروجی فعالیت ها
                    </a>
                    <a href="{{route('admin.admin-logs.list')}}" class="btn btn-sm btn-light-danger mx-1">
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
        <div class="d-flex justify-content-around m-10 ">
            <div class="card statistics-card card-bordered my-5 " style="width: 80%" >
                <div class="card-header statistics-card ">
                    <h3 class="card-title ">آمار فعالیت ها</h3>
                </div>
                <div class="card-body statistic-card-body row">
                    <div class="col-md-3">
                        کل فعالیت ها : {{$allLogsCount}}
                    </div>
                    <div class="col-md-8 row">
                        <div class="col-md-3">
                            ایجاد : {{$createLogsCount}}
                        </div>
                        <div class="col-md-3">
                            ویرایش : {{$updateLogsCount}}
                        </div>
                        <div class="col-md-3">
                            حذف : {{$deleteLogsCount}}
                        </div>

                    </div>
                </div>

            </div>

        </div>

        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder fs-3 mb-1"> فهرست فعالیت ها   </span>
            </h3>

        </div>
        <!--begin::Card body-->
        <div class="card-body pt-0">

            <!--begin::Table-->
            <div id="kt_customers_table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                <div class="table-responsive"  style="text-align: center">
                    <table class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer">
                        <!--begin::Table head-->
                        <thead>
                        <!--begin::Table row-->
                        <tr class="min-w-125px sorting">

                            <th class="min-w-125px " >
                                کاربر
                            </th>

                            <th class="min-w-125px">
                                نوع فعالیت
                            </th>
                            <th class="min-w-125px">
                                نوع entity
                            </th>
                            <th class="min-w-125px">
                                عنوان
                            </th>
                            <th class="min-w-100px sorting">تاریخ
                            </th>
                            <th class="min-w-125px">
                                نمایش توضیحات
                            </th>

                        </tr>
                        <!--end::Table row-->
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody class="fw-bold text-gray-600">
                        @if($logs->count() > 0)
                            @foreach($logs as $log)
                                <tr class="odd">

                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="d-flex justify-content-center flex-column">
                                                <a href="{{route('admin.admins.edit',$log->admin)}}" class="text-dark fw-bold text-hover-primary fs-6">
                                                    {{ $log->admin->webPresent()->fullName }}
                                                </a>
                                                <span class="text-muted fw-semibold text-muted d-block fs-7">
                                                    {{ $log->admin->webPresent()->mobile }}
                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        {!! $log->webPresent()->activityType !!}
                                    </td>
                                    <td>
                                        {{$log->webPresent()->entityType}}
                                    </td>
                                    <td>
                                        {!! $log->entity_title !!}
                                    </td>
                                    <td>
                                        {!! $log->webPresent()->updatedAt !!}
                                    </td>
                                    <td>
                                        <a type="button" data-bs-toggle="modal" data-bs-target="#description_{{$log->id}}" title="نمایش جزئیات"
                                           class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                            <i class="fa fa-comment" ></i>
                                        </a>
                                    </td>

                                </tr>

                                <div class="modal fade" tabindex="-1" id="description_{{$log->id}}">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <!--begin::Close-->
                                                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                                                </div>
                                                <!--end::Close-->
                                            </div>

                                            <div class="modal-body mx-5">
                                                @if(!is_null($log->description))
                                                    @foreach($log->description as $key => $description)
                                                        <li>{{ $key }}: {{ $description }}</li>
                                                    @endforeach
                                                @else
                                                    بدون توضیحات
                                                @endif
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">بستن</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" style="text-align:center;color:red"><a class="btn btn-danger" href="">
                                        اطلاعات موجود نیست <i class="icon-warning2 mr-3 icon-1x"></i></a></td>
                            </tr>
                        @endif
                        </tbody>
                        <!--end::Table body-->
                    </table>
                </div>

            </div>
            <!--end::Table-->
            {{$logs->links() }}
        </div>
        <!--end::Card body-->
    </div>
@endsection
@section('scripts')
    <script>
        function submitFilterForm(exportItems) {
            if (exportItems){
                $('#filter_form').attr('action', "{{route('admin.admin-logs.export')}}").submit()

            }else {
                $('#filter_form').attr('action', "{{route('admin.admin-logs.list')}}").submit()

            }
        }
    </script>
@endsection
