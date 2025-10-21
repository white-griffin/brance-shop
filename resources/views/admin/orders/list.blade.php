@extends('layouts.admin.admin')
@section('title','  سفارشات   ')
@section('pageTitle',' فهرست  سفارشات   ')
@section('content')
    <div class="d-flex flex-end mb-5">
        <button type="button" class="btn  btn-primary px-4 py-2 ml-4" data-bs-toggle="collapse"
                href="#student_filters" role="button"
                aria-expanded="false" aria-controls="collapseExample" style="margin-left: 5px!important;">
            فیلتر
            <i class="fa fa-filter p-0 m-0"></i>
        </button>
    </div>
    <div class="card mb-5 pb-3 mb-xl-8 collapse @if(request()->has('id')||
        request()->has('user')||request()->has('date_from')||request()->has('date_to')||request()->has('status')) show @else @endif" id="student_filters">
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

                    <div class="col-lg-3 col-md-3 col-sm-12 my-5">
                        <div class="form-group">
                            <label class="form-label fs-6 fw-bolder text-dark">جستجو بر اساس شناسه سفارش
                            </label>
                            <input class="form-control form-control-lg form-control-solid" name="id" type="number"
                                   value="{{ request()->has('id') ? request()->get('id') : null }}"/>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12 my-5">
                        <div class="mb-10 fv-row fv-plugins-icon-container">
                            <!--begin::Label-->
                            <label class=" form-label"> کاربر </label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            @include('admin.__components.select-2-ajax', [
                                'name' => 'user',
                                'url' => route('admin.users.search.ajax')
                                ])
                            <!--end::Input-->

                            <div class="fv-plugins-message-container invalid-feedback"></div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-12 my-5">
                        <div class="form-group">
                            <label class="form-label fs-6 fw-bolder text-dark">جستجو بر اساس کف تاریخ
                            </label>
                            @include('admin.__components.datepicker', [
                                'name' => 'date_from',
                                'initial_value' => false

                            ])
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12 my-5">
                        <div class="form-group">
                            <label class="form-label fs-6 fw-bolder text-dark">جستجو بر اساس سقف تاریخ
                            </label>
                            @include('admin.__components.datepicker', [
                                'name' => 'date_to',
                                'initial_value' => false
                            ])
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-2 col-sm-12">
                        <div class="form-group">
                            <label class="form-label fs-6 fw-bolder text-dark">جستجو بر اساس وضعیت
                            </label>
                            @include('admin.__components.horizontal-radiobutton', [
                                 'name' => 'status',
                                 'items' => $orderStatuses,
                                 'activeKey' => request()->has('status') ? request()->get('status') : null
                            ])
                        </div>
                    </div>
                </div>
                <br/>
                <div class="d-flex  flex-end">
                    <a href="{{route('admin.orders.list')}}" class="btn btn-sm btn-light-danger mx-1">
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
                <span class="card-label fw-bolder fs-3 mb-1"> فهرست سفارشات   </span>
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
                            <th class="min-w-50px">
                                شناسه سفارش
                            </th>
                            <th class="min-w-50px">
                                کاربر
                            </th>
                            <th class="min-w-125px">
                                محصولات
                            </th>
                            <th class="min-w-125px">
                                تاریخ ثبت سفارش
                            </th>
                            <th class="min-w-100px sorting">وضعیت
                            </th>
                            <th class="min-w-100px sorting">وضعیت ارسال
                            </th>
                            <th class="min-w-100px sorting">فاکتور
                            </th>
                            <th class="min-w-100px sorting">آدرس
                            </th>
							<th class="min-w-100px sorting">توضیحات
                            </th>
                        </tr>
                        <!--end::Table row-->
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody class="fw-bold text-gray-600">
                        @if($orders->count() > 0)
                            @foreach($orders as $order)

                                <tr class="odd">
                                    <td>
                                        {{$order->id}}

                                    </td>
                                    <td>
                                        <div>

                                            <div class="d-flex justify-content-center flex-column">
                                                <a href="{{route('admin.users.edit',$order->user)}}" class="text-dark fw-bold text-hover-primary fs-6">
                                                    {{ $order->user->webPresent()->fullName }}
                                                </a>
                                                <span class="text-muted fw-semibold text-muted d-block fs-7">
                                                    {{ $order->user->webPresent()->mobile }}
                                                </span>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <a href="#" class="btn btn-icon btn-light-info btn-sm me-1"
                                           title="نمایش محصولات" data-bs-toggle="modal" data-bs-target="{{'#products_'.$order->id}}">
                                                     <span class="svg-icon svg-icon-3">
                                                         <i class="fa fa-list-1-2"></i>
                                                     </span>
                                        </a>
                                        <div class="modal fade" id="{{'products_'.$order->id}}" tabindex="-1" style="display: none;" aria-hidden="true">
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
                                                        <div id="kt_customers_table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                                            <div class="table-responsive"  style="text-align: center">
                                                                <table class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer">
                                                                    <!--begin::Table head-->
                                                                    <thead>
                                                                    <!--begin::Table row-->
                                                                    <tr class="min-w-125px sorting">

                                                                        <th class="min-w-125px">
                                                                            محصول
                                                                        </th>
                                                                        <th class="min-w-125px">
                                                                            تعداد
                                                                        </th>

                                                                    </tr>
                                                                    <!--end::Table row-->
                                                                    </thead>
                                                                    <!--end::Table head-->
                                                                    <!--begin::Table body-->
                                                                    <tbody class="fw-bold text-gray-600">
                                                                    @if($order->items->count() > 0)
                                                                        @foreach($order->items as $item)

                                                                            <tr class="odd">

                                                                                <td>
                                                                                    <div>
                                                                                        <div class="d-flex align-items-center">
                                                                                            <div class="symbol symbol-45px me-5">
                                                                                                <img src="{{$item->product->webPresent()->image}}" alt="" />
                                                                                            </div>
                                                                                            <div class="d-flex justify-content-start flex-column">
                                                                                                <a href="{{route('admin.products.edit',$item->product)}}" class="text-dark fw-bold text-hover-primary fs-6">
                                                                                                    {{ $item->product->title }}
                                                                                                </a>
                                                                                            </div>
                                                                                        </div>

                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    {{$item->quantity}}
                                                                                </td>
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
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        {{$order->webPresent()->orderDate}}
                                    </td>
                                    <td>{!! $order->webPresent()->status !!}</td>
                                    <td>
                                        <select class="form-select form-select-sm delivery-status-select"
                                                data-order-id="{{ $order->id }}"
                                                name="delivery_status">
                                            @foreach(\App\Constants\Constant::getDeliveryStatusesViewer() as $status)
                                                <option value="{{ $status['id'] }}"
                                                        {{ isset($order->delivery_status) && $order->delivery_status == $status['id'] ? 'selected' :
                                                           (!isset($order->delivery_status) && $status['id'] == \App\Constants\Constant::PENDING ? 'selected' : '') }}>
                                                    {{ $status['title'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-icon btn-light-primary btn-sm me-1"
                                           title="نمایش فاکتوز" data-bs-toggle="modal" data-bs-target="{{'#factor_'.$order->id}}">
                                                 <span class="svg-icon svg-icon-3">
                                                     <i class="fa fa-list-check"></i>
                                                 </span>
                                        </a>
                                        <div class="modal fade" id="{{'factor_'.$order->id}}" tabindex="-1" style="display: none;" aria-hidden="true">
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

                                                        @include('admin.orders.invoice', ['order' => $order])
                                                    </div>
                                                    <div class="modal-footer">
{{--                                                        <a href="{{ route('admin.orders.invoice.pdf', $order->id) }}" class="btn btn-primary">دانلود PDF</a>--}}
                                                        <button class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-icon btn-light-primary btn-sm me-1"
                                           title="مشخصات گیرنده" data-bs-toggle="modal" data-bs-target="{{'#address_'.$order->id}}">
                                                 <span class="svg-icon svg-icon-3">
                                                     <i class="fa fa-location"></i>
                                                 </span>
                                        </a>
                                        <div class="modal fade" id="{{'address_'.$order->id}}" tabindex="-1" style="display: none;" aria-hidden="true">
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

                                                        <div class="px-4 py-3 bg-white rounded-xl shadow-md border border-gray-100">
                                                            <div class="flex items-start gap-3">
                                                                @if(!is_null($order->receiver))

                                                                    <ul class="list-group list-group-flush">
                                                                        <li class="list-group-item">
                                                                            <strong>نام:</strong> <span id="receiver-first-name">{{$order->receiver->first_name}}</span>
                                                                        </li>
                                                                        <li class="list-group-item">
                                                                            <strong>نام خانوادگی:</strong> <span id="receiver-last-name">{{$order->receiver->last_name}}</span>
                                                                        </li>
                                                                        <li class="list-group-item">
                                                                            <strong>کد ملی:</strong> <span id="receiver-national-code">{{$order->receiver->national_code}}</span>
                                                                        </li>
                                                                        <li class="list-group-item">
                                                                            <strong>شماره موبایل:</strong> <span id="receiver-mobile">{{$order->receiver->mobile}}</span>
                                                                        </li>
                                                                        <li class="list-group-item">
                                                                            <strong>ایمیل:</strong> <span id="receiver-email">{{$order->receiver->email}}</span>
                                                                        </li>
                                                                        <li class="list-group-item">
                                                                            <strong>آدرس:</strong> <span id="receiver-address">{{$order->receiver->address}}</span>
                                                                        </li>
                                                                        <li class="list-group-item">
                                                                            <strong>کد پستی:</strong> <span id="receiver-zipcode">{{$order->receiver->zip_code}}</span>
                                                                        </li>
                                                                    </ul>
                                                                @else
                                                                    <a class="btn btn-danger" href="">
                                                                        اطلاعات موجود نیست <i class="icon-warning2 mr-3 icon-1x"></i>
                                                                    </a>
                                                                @endif

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </td>
									<td>
                                        <a href="#" class="btn btn-icon btn-light-primary btn-sm me-1"
                                           title="توضیحات" data-bs-toggle="modal" data-bs-target="{{'#description_'.$order->id}}">
                                                 <span class="svg-icon svg-icon-3">
                                                     <i class="fa fa-address-card"></i>
                                                 </span>
                                        </a>
                                        <div class="modal fade" id="{{'description_'.$order->id}}" tabindex="-1" style="display: none;" aria-hidden="true">
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
                                                        <h2 style="text-align: center; margin-bottom: 20px;"> توضیحات سفارش</h2>

                                                        <div class="px-4 py-3 bg-white rounded-xl shadow-md border border-gray-100">
                                                            <div class="flex items-start gap-3">
                                                                @if(!is_null($order->description))

                                                                   <p>
                                                                       {{$order->description}}
                                                                   </p>
                                                                @else
                                                                    <a class="btn btn-danger" href="">
                                                                        اطلاعات موجود نیست <i class="icon-warning2 mr-3 icon-1x"></i>
                                                                    </a>
                                                                @endif

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </td>
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

            </div>
            <!--end::Table-->
            {{$orders->links() }}
        </div>
        <!--end::Card body-->
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('.delivery-status-select').on('change', function() {
                const orderId = $(this).data('order-id');
                const deliveryStatus = $(this).val();

                $.ajax({
                    url: "{{ route('admin.orders.update-delivery-status') }}",
                    type: "POST",
                    data: {
                        order_id: orderId,
                        delivery_status: deliveryStatus,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        if (response.success) {
                            toastr.success('وضعیت ارسال با موفقیت بروزرسانی شد');
                        } else {
                            toastr.error('خطا در بروزرسانی وضعیت ارسال');
                        }
                    },
                    error: function() {
                        toastr.error('خطا در ارتباط با سرور');
                    }
                });
            });
        });
    </script>
@endsection

