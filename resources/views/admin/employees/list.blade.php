@extends('layouts.admin.admin')
@section('title','  اعضا ')
@section('pageTitle',' فهرست   اعضا   ')
@section('content')
   <div class="card mb-5 mb-xl-8 mt-15">
        <!--begin::Header-->
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder fs-3 mb-1">فهرست  اعضا </span>
            </h3>
            <div class="card-toolbar">

                <a href="{{route('admin.employees.create')}}" class="btn btn-sm btn-light-success">
                    ثبت عضو جدید
                </a>
            </div>
        </div>


        <!--end::Header-->
        <!--begin::Body-->
        <div class="card-body py-3">

            <!--begin::Table container-->
            <div class="table-responsive">
                <!--begin::Table-->
                <table class="table align-middle gs-0 gy-4">
                    <!--begin::Table head-->
                    <thead>
                    <tr class="fw-bolder text-muted bg-light">

                        <th class="ps-4">تصویر </th>
                        <th >نام </th>
						<th >سمت شغلی  </th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody class="row_position" id="category">

                    @if($employees->count() > 0)
                        @foreach($employees as $employee)
                            <tr  class="odd" id="{{$employee->id}}" data-id="{{$employee->id}}" style="border-bottom:1px solid #80808073">

                                <td>
                                    <div class="d-flex">
                                        <!--begin::Thumbnail-->
                                        <a href="" class="symbol symbol-50px">
                                            <img class="symbol-label" src="{{$employee->webPresent()->image}}"/>
                                        </a>
                                        <!--end::Thumbnail-->
                                    </div>
                                </td>
                                <td>
                                    {{$employee->title}}
                                </td>
								 <td>
                                    {{$employee->job_position}}
                                </td>
                                <td class="">

                                    <a href="{{ route('admin.employees.edit',$employee) }}"
                                       class="btn btn-icon btn-light-primary btn-sm me-1">
                                     <span class="svg-icon svg-icon-3">
                                        <i class="fa fa-edit"></i>
                                    </span>
                                    </a>
                                    @include('admin.__modules.delete-link',['url' => route('admin.employees.delete',$employee)])
                                </td>
                            </tr>

                        @endforeach
                    @else
                        <tr>
                            <td colspan="9" class="text-center">
                                <h4 class="text-danger pt-5">عضوی ثبت نشده است</h4>
                            </td>
                        </tr>
                    @endif
                    </tbody>

                    <!--end::Table body-->
                </table>
                <!--end::Table-->

            </div>
            <!--end::Table container-->
        </div>
        <!--begin::Body-->
    </div>
@endsection

@section('scripts')


@endsection
