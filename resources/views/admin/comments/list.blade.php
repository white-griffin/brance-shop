@extends('layouts.admin.admin')
@section('title','  نظرات')
@section('pageTitle','فهرست نظرات  ')
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card" data-select2-id="select2-data-131-rhmf">
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bolder fs-3 mb-1"> فهرست نظرات </span>
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
                                        aria-label="Customer Name: activate to sort column ascending">نام کاربر
                                    </th>
                                    <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_customers_table"
                                        rowspan="1"
                                        colspan="1"
                                        aria-label="Customer Name: activate to sort column ascending">بخش
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
                                @if($comments->count() > 0)
                                    @foreach($comments as $comment)
                                        <tr class="odd">

                                            <td>{!! $comment->webPresent()->user !!}</td>
                                            <td>{!! $comment->webPresent()->commentableType !!}</td>
                                            <td>{!! $comment->webPresent()->commentableTitle !!}</td>
                                            <td>{!! $comment->webPresent()->status !!}</td>
                                            <td>
                                                <a href="#" class="btn btn-icon btn-light-info btn-sm me-1" data-bs-toggle="modal" data-bs-target="{{'#status_'.$comment->id}}">
                                                     <span class="svg-icon svg-icon-3">
                                                         <i class="fa fa-gear"></i>
                                                     </span>
                                                </a>
                                                <a href="#" class="btn btn-icon btn-light-info btn-sm me-1" data-bs-toggle="modal" data-bs-target="{{'#reply_'.$comment->id}}">
                                                     <span class="svg-icon svg-icon-3">
                                                         <i class="fa fa-reply"></i>
                                                     </span>
                                                </a>
                                                @include('admin.__modules.delete-link',['url' => route('admin.comments.delete',$comment)])
                                                <div class="modal fade" id="{{'status_'.$comment->id}}" tabindex="-1" style="display: none;" aria-hidden="true">
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
                                                                <form action="{{route('admin.comments.update-status',$comment->id)}}" method="post">
                                                                    @csrf
                                                                    <!--begin::Heading-->
                                                                    <div class="mb-13 text-center">
                                                                        <!--begin::Title-->
                                                                        <h4 class="text-right" style="text-align: right !important;">متن نظر :</h4>
                                                                        <br/>
                                                                        <h5 class="text-right" style="text-align: right !important;">{!! $comment->text !!}  </h5>
                                                                        <br/>
                                                                        <br/>
                                                                        <br/>
                                                                        <!--end::Title-->
                                                                        <div class="row mt-4">
                                                                            <div class="col-md-12 mb-5">
                                                                                @include('admin.__components.label',['title' => 'وضعیت'])
                                                                                @include('admin.__components.select',[
                                                                                    'name'=>'status',
                                                                                    'items'=>\App\Constants\Constant::getStatusCommentsView(),
                                                                                    'selectedItem' => $comment->status
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
                                                <div class="modal fade" id="{{'reply_'.$comment->id}}" tabindex="-1" style="display: none;" aria-hidden="true">
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
                                                                <form action="{{route('admin.comments.reply')}}" method="post">
                                                                    <input name="comment_id" value="{{$comment->id}}" class="d-none">
                                                                    @csrf
                                                                    <!--begin::Heading-->
                                                                    <div class="mb-13 text-center">
                                                                        <!--begin::Title-->
                                                                        <h4 class="text-right" style="text-align: right !important;">پاسخ به نظر </h4>
                                                                        <br/>
                                                                        <br/>
                                                                        <!--end::Title-->
                                                                        <div class="row mt-4">
                                                                            <div class="col-md-12 mb-5">
                                                                                @include('admin.__components.label',['title' => 'متن پاسخ'])
                                                                                @include('admin.__components.textarea',[
                                                                                    'name' => 'text',
                                                                                    'value' => !is_null($comment->adminReply) ? $comment->adminReply->text : null
                                                                                ])
                                                                            </div>
                                                                            <div class="col-md-4 mt-4">
                                                                                <button type="submit" id="kt_ecommerce_add_category_submit" class="btn btn-primary">
                                                                                    <span class="indicator-label">ثبت پاسخ  </span>

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
                        <div class="row">
                            <div
                                class="col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end">

                            </div>
                        </div>
                    </div>
                    <!--end::Table-->
                    {{$comments->links('vendor.pagination.bootstrap-4') }}
                </div>
                <!--end::Card body-->
            </div>
        </div>
    </div>
@endsection

