@extends('layouts.admin.admin')
@section('title','    فهرست کاربران')
@section('pageTitle','فهرست کاربران امروز ')
@section('content')

    <div id="kt_content_container" class="container-xxl">
        <div class="card" data-select2-id="select2-data-131-rhmf">
            <div class="card-header border-0 pt-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bolder fs-3 mb-1"> فهرست کاربران امروز </span>
                </h3>

            </div>
            <!--begin::Card body-->
            <div class="card-body pt-0">

                <!--begin::Table-->
                <div id="kt_customers_table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                    <div class="table-responsive">
                        <!--begin::Table-->
                        <table class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer"
                               id="kt_customers_table">
                            <!--begin::Table head-->
                            <thead>
                            <!--begin::Table row-->
                            <tr class="min-w-125px sorting">

                                <th class="min-w-125px  "
                                    colspan="1" style="width: 162.9px;"> نام ونام خانوادگی
                                </th>
                                <th class="min-w-125px  "
                                    colspan="1" style="width: 162.9px;"> تلفن
                                </th>


                            </tr>
                            <!--end::Table row-->
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody class="fw-bold text-gray-600">
                            @if($users->count() > 0)
                                @foreach($users as $user)
                                    <tr class="odd">

                                        <td>

                                            <div class="symbol symbol-45px me-5">
                                                <img src="{{$user->webPresent()->avatar}}" alt=""/>
                                                <a href="{{route('admin.users.edit',$user)}}" class="text-dark fw-bold text-hover-primary fs-6">
                                                    {{ $user->webPresent()->fullName }}
                                                </a>
                                            </div>
                                        </td>
                                        <td>   {{ $user->mobile }}</td>

                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6" style="text-align:center;color:red"><a class="btn btn-danger"
                                                                                           href="">
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

            </div>
            {{$users->links('vendor.pagination.bootstrap-4') }}
            <!--end::Card body-->
        </div>

    </div>
@endsection
@section('scripts')
@endsection
