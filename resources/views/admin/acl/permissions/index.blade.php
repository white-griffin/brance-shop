@extends('layouts.admin.admin')@section('title','   سطوح دسترسی ')
@section('pageTitle','    مجوز ها ')
@section('pageTitleSingle','   لیست مجوز ها ')

@section('content')

<div class="card" data-select2-id="select2-data-131-rhmf">
    <div class="card-header border-0 pt-5">
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label fw-bolder fs-3 mb-1"> فهرست مجوزهای پیش فرض سیستم </span>
        </h3>
        <div class="card-toolbar">

            <a href="{{ route('admin.acl.refresh.permissions') }}" class="btn btn-sm btn-light-success">
                بروزرسانی مجوزهای پیش فرض سیستم
            </a>
        </div>
    </div>
    <!--begin::Card body-->
    <div class="card-body pt-0">
        <!--begin::Table-->
        <div id="kt_customers_table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
            <div class="table-responsive">
                <table class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer"
                       id="kt_customers_table">
                    <!--begin::Table head-->
                    <thead>
                    <!--begin::Table row-->
                    <tr class="min-w-125px sorting">
                        <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_customers_table" rowspan="1"
                            colspan="1" style="width: 162.9px;"
                            aria-label="Created Date: activate to sort column ascending"> #
                        </th>
                        <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_customers_table" rowspan="1"
                            colspan="1" style="width: 162.9px;"
                            aria-label="Customer Name: activate to sort column ascending"> بخش
                        </th>
                        <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_customers_table" rowspan="1"
                            colspan="1" style="width: 162.9px;"
                            aria-label="Customer Name: activate to sort column ascending"> عنوان
                        </th>
                        <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_customers_table" rowspan="1"
                            colspan="1" style="width:162.9px;"
                            aria-label="Status: activate to sort column ascending">عنوان فارسی
                        </th>

                    </tr>
                    <!--end::Table row-->
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody class="fw-bold text-gray-600">
                    @if($permissions->count() > 0)
                        @foreach($permissions as $key => $permission)
                            <tr class="odd">
                                <td>{{ ++$key }}</td>
                                <td>{{ $permission->page }}</td>
                                <td>{{ $permission->name }}</td>
                                <td>{{ $permission->persian_name }}</td>
                                <!--end::Date=-->
                            </tr>
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
            <div class="row">
                <div
                    class="col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end">

                </div>
            </div>
        </div>
        <!--end::Table-->
    </div>
    <!--end::Card body-->
</div>
@endsection
