@extends('layouts.admin.admin')
@section('title','  درخواست های تماس')
@section('pageTitle','فهرست درخواست ها  ')
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card" data-select2-id="select2-data-131-rhmf">
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bolder fs-3 mb-1"> فهرست درخواست ها </span>
                    </h3>

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
                                    <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_customers_table"
                                        rowspan="1"
                                        colspan="1"
                                        aria-label="Customer Name: activate to sort column ascending">نام مشتری
                                    </th>
                                    <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_customers_table"
                                        rowspan="1"
                                        colspan="1"
                                        aria-label="Customer Name: activate to sort column ascending">شماره تماس
                                    </th>
                                    <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_customers_table"
                                        rowspan="1"
                                        colspan="1"
                                        aria-label="Customer Name: activate to sort column ascending">عنوان
                                    </th>
                                    <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_customers_table"
                                        rowspan="1"
                                        colspan="1"
                                        aria-label="Status: activate to sort column ascending">وضعیت
                                    </th>

                                    <th class="min-w-125px sorting" rowspan="1" colspan="1"
                                        aria-label="Actions">عملیات
                                    </th>
                                </tr>
                                <!--end::Table row-->
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody class="fw-bold text-gray-600">
                                @if($callRequests->count() > 0)
                                    @foreach($callRequests as $request)
                                        <tr class="odd">

                                            <td>{!! $request->webPresent()->user !!}</td>
                                            <td>{{ $request->phone_number}}</td>
                                            <td>{!! $request->title !!}</td>
                                            <td>{!! $request->webPresent()->status !!}</td>
                                            <td>
                                                <a href="#" class="btn btn-icon btn-light-info btn-sm me-1" data-bs-toggle="modal" data-bs-target="{{'#status_'.$request->id}}">
                                                     <span class="svg-icon svg-icon-3">
                                                         <i class="fa fa-gear"></i>
                                                     </span>
                                                </a>
                                                <div class="modal fade" id="{{'status_'.$request->id}}" tabindex="-1" style="display: none;" aria-hidden="true">
                                                    <!--begin::Modal dialog-->
                                                    <div class="modal-dialog modal-dialog-centered mw-650px">
                                                        <!--begin::Modal content-->
                                                        <div class="modal-content rounded">
                                                            <!--begin::Modal header-->
                                                            <div class="modal-header pb-0 border-0 justify-content-end">
                                                                <!--begin::Close-->
                                                                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                                                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                                                                    <span class="svg-icon svg-icon-1">
                                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                                             xmlns="http://www.w3.org/2000/svg">
                                                                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                                                                  transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
                                                                            <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                                                                  transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
                                                                        </svg>
						                                        	</span>
                                                                    <!--end::Svg Icon-->
                                                                </div>
                                                                <!--end::Close-->
                                                            </div>
                                                            <!--begin::Modal header-->
                                                            <!--begin::Modal body-->
                                                            <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                                                                <!--begin:Form-->
                                                                <form action="{{route('admin.call-requests.update-status',$request)}}" method="post">
                                                                    @csrf
                                                                    <!--begin::Heading-->
                                                                    <div class="mb-13 text-center">
                                                                        <!--begin::Title-->
                                                                        <h4 class="text-right" style="text-align: right !important;">متن درخواست :</h4>
                                                                        <br/>
                                                                        <h5 class="text-right" style="text-align: right !important;">{!! $request->description !!}  </h5>
                                                                        <br/>
                                                                        <br/>
                                                                        <br/>
                                                                        <!--end::Title-->
                                                                        <div class="row mt-4">
                                                                            <div class="col-md-12 mb-5">
                                                                                @include('admin.__components.label',['title' => 'وضعیت'])
                                                                                @include('admin.__components.select',[
                                                                                    'name'=>'status',
                                                                                    'items'=>\App\Constants\Constant::getCallRequestsStatusView(),
                                                                                    'selectedItem' => $request->status
                                                                                ])
                                                                            </div>
                                                                            <div class="col-md-4 mt-4">
                                                                                <button type="submit" id="kt_ecommerce_add_category_submit" class="btn btn-primary">
                                                                                    <span class="indicator-label">ثبت اطلاعات  </span>

                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!--end::Heading-->
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
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
                        </div>

                    </div>
                    <!--end::Table-->
                    {{$callRequests->links('vendor.pagination.bootstrap-4') }}
                </div>
                <!--end::Card body-->
            </div>
        </div>
    </div>
@endsection

