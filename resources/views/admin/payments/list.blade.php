@extends('layouts.admin.admin')
@section('title','  پرداخت ها   ')
@section('pageTitle',' فهرست  پرداخت ها   ')
@section('content')
    <div class="d-flex flex-end mb-5">
        <button type="button" class="btn  btn-primary px-4 py-2 ml-4" data-bs-toggle="collapse"
                href="#student_filters" role="button"
                aria-expanded="false" aria-controls="collapseExample" style="margin-left: 5px!important;">
            فیلتر
            <i class="fa fa-filter p-0 m-0"></i>
        </button>
    </div>
    <div class="card mb-5 pb-3 mb-xl-8 collapse @if(request()->has('plan')||
        request()->has('user')||request()->has('date_from')||request()->has('date_to')||
        request()->has('status')||request()->has('amount_from')||request()->has('amount_to')||request()->has('payment_token')||
        request()->has('transaction_id')) show @else @endif" id="student_filters">
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
                            <label class=" form-label"> جستجو بر اساس کاربر </label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            @include('admin.__components.select-2-ajax', [
                                'name' => 'user',
                                'url' => route('admin.users.search.ajax')
                                ])
                            <!--end::Input-->
                        </div>
                    </div>


                    <div class="col-lg-2 col-md-2 col-sm-6 my-5">
                        <div class="form-group">
                            <label class="form-label fs-6 fw-bolder text-dark"> بر اساس کد رهگیری
                            </label>
                            <input class="form-control form-control-lg form-control-solid" name="payment_token"
                                   value="{{ request()->has('payment_token') ? request()->get('payment_token') : null }}"/>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-6 my-5">
                        <div class="form-group">
                            <label class="form-label fs-6 fw-bolder text-dark"> بر اساس شناسه تراکنش
                            </label>
                            <input class="form-control form-control-lg form-control-solid" name="transaction_id"
                                   value="{{ request()->has('transaction_id') ? request()->get('transaction_id') : null }}"/>
                        </div>
                    </div>

{{--                    <div class="col-lg-2 col-md-2 col-sm-12 my-5">--}}
{{--                        <div class="form-group">--}}
{{--                            <label class="form-label fs-6 fw-bolder text-dark">کد تخفیف--}}
{{--                            </label>--}}
{{--                            @include('admin.__components.select-2-ajax', [--}}
{{--                                 'name' => 'discount_code',--}}
{{--                                 'url' => route('admin.discount_codes.search.ajax'),--}}
{{--                                 'nullValue' => true--}}
{{--                                 ])--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-lg-2 col-md-2 col-sm-12 my-5">--}}
{{--                        <div class="form-group">--}}
{{--                            <label class="form-label fs-6 fw-bolder text-dark">درگاه--}}
{{--                            </label>--}}
{{--                            @include('admin.__components.select-2', [--}}
{{--                                 'name' => 'gateway',--}}
{{--                                 'items' => $gateways--}}
{{--                                 ])--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <div class="col-lg-2 col-md-2 col-sm-12 my-5">
                        <div class="form-group">
                            <label class="form-label fs-6 fw-bolder text-dark">جستجو  کف تاریخ
                            </label>
                            @include('admin.__components.datepicker', [
                                'name' => 'date_from',
                                'initial_value' => false

                            ])
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-12 my-5">
                        <div class="form-group">
                            <label class="form-label fs-6 fw-bolder text-dark">جستجو  سقف تاریخ
                            </label>
                            @include('admin.__components.datepicker', [
                                'name' => 'date_to',
                                'initial_value' => false
                            ])
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-6 my-5">
                        <div class="form-group">
                            <label class="form-label fs-6 fw-bolder text-dark">جستجو کف قیمت
                            </label>
                            <input class="form-control form-control-lg form-control-solid" name="amount_from" type="number"
                                   value="{{ request()->has('amount_from') ? request()->get('amount_from') : null }}"/>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-6 my-5">
                        <div class="form-group">
                            <label class="form-label fs-6 fw-bolder text-dark">جستجو سقف قیمت
                            </label>
                            <input class="form-control form-control-lg form-control-solid" name="amount_to" type="number"
                                   value="{{ request()->has('amount_to') ? request()->get('amount_to') : null }}"/>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-12 my-5">
                        <div class="form-group">
                            <label class="form-label fs-6 fw-bolder text-dark">جستجو بر اساس وضعیت
                            </label>
                            @include('admin.__components.horizontal-radiobutton', [
                                 'name' => 'status',
                                 'items' => $paymentStatuses,
                                 'activeKey' => request()->has('status') ? request()->get('status') : null
                            ])
                        </div>
                    </div>
                </div>
                <br/>
                <div class="d-flex  flex-end">

                    <a href="{{route('admin.payments.list')}}" class="btn btn-sm btn-light-danger mx-1">
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
                <span class="card-label fw-bolder fs-3 mb-1"> فهرست پرداخت ها   </span>
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
                            <th class="min-w-125px " >
                                کاربر
                            </th>
                            <th class="min-w-50px">
                                درگاه پرداخت
                            </th>
                            <th class="ps-4">
                                مبلغ پرداختی
                            </th>
                            <th class="ps-4">
                                تخفیف
                            </th>
                            <th class="min-w-125px">
                                کد رهگیری
                            </th>
                            <th class="min-w-125px">
                                تاریخ پرداخت
                            </th>
                            <th class="ps-4">شناسه تراکنش
                            </th>
                            <th class="ps-4 ">وضعیت
                            </th>
                        </tr>
                        <!--end::Table row-->
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody class="fw-bold text-gray-600">
                        @if($payments->count() > 0)
                            @foreach($payments as $payment)
                                <tr class="odd">
                                    <td>
                                        {{$payment->order->id}}
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="d-flex justify-content-center flex-column">
                                                <a href="#" class="text-dark fw-bold text-hover-primary fs-6" >
                                                    {{ $payment->user->webPresent()->fullName }}
                                                </a>
                                                <span class="text-muted fw-semibold text-muted d-block fs-7">
                                                    {{ $payment->user->mobile }}
                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        {{$payment->webPresent()->gatewayName}}
                                    </td>
                                    <td>
                                        {{number_format($payment->amount)}}
                                    </td>
                                    <td>
                                        {!! $payment->webPresent()->discountCodeAmount !!}
                                    </td>
                                    <td>
                                        {{$payment->payment_token}}
                                    </td>
                                    <td>
                                        {{$payment->webPresent()->payDate}}
                                    </td>
                                    <td>
                                        <a type="button" data-bs-toggle="modal" data-bs-target="#paymentCode_{{$payment->id}}"
                                           class="btn btn-icon btn-light-primary btn-sm me-1">
                                             <span class="svg-icon svg-icon-3">
                                                <i class="fa fa-eye"></i>
                                            </span>
                                        </a>
                                    </td>
                                    <td>
                                        {!! $payment->webPresent()->status !!}
                                    </td>

                                </tr>
                                <!-- Modal -->
                                <div class="modal fade" id="paymentCode_{{$payment->id}}" tabindex="-1" role="dialog" aria-labelledby="paymentCodeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="paymentCodeModalLabel">شناسه تراکنش</h5>
                                            </div>
                                            <div class="modal-body">
                                                شناسه تراکنش : {{ $payment->transaction_id }}
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="11" style="text-align:center;color:red"><a class="btn btn-danger" href="">
                                        اطلاعات موجود نیست <i class="icon-warning2 mr-3 icon-1x"></i></a></td>
                            </tr>
                        @endif
                        </tbody>
                        <!--end::Table body-->
                    </table>
                </div>

            </div>
            <!--end::Table-->
            {{$payments->links() }}
        </div>
        <!--end::Card body-->
    </div>
@endsection
@section('scripts')
<script>

</script>
@endsection
