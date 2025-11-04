@extends('layouts.admin.admin')
@section('content')
<div class="card" data-select2-id="select2-data-131-rhmf">
    <div class="card-header border-0 pt-5">
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label fw-bolder fs-3 mb-1">   لیست مجوز های مربوط نقش   :   {{ $role->persian_name }} </span>
        </h3>
        <div class="card-toolbar">

            <a href="{{ route('admin.roles.all') }}" class="btn btn-sm btn-light-success">
                بازگشت
            </a>
        </div>
    </div>
    <!--begin::Card body-->
    <div class="card-body pt-0">
        <div class="row">
            <br/>
            <br/>
            <div class="col-md-12">
                <br/>
                @foreach ($permissions as $permission )
                    <span class="badge badge-light-success">{{ $permission->persian_name }}</span>

                @endforeach
            </div>
        </div>
    </div>
    <!--end::Card body-->
</div>
@endsection




