<div style="direction: rtl; font-family: Tahoma, sans-serif; font-size: 14px; padding: 20px;" id="invoiceContent_{{ $order->id }}">
    <h2 style="text-align: center; margin-bottom: 15px;">فاکتور سفارش {{ $order->id }}</h2>

    <hr style="margin: 20px 0;">

    <h4 style="margin-top: 20px;"> اطلاعات سفارش :</h4>
    <div class="row">
        <div class="col-md-4">
            <span>شماره :</span>
            <span>{{ $order->id }} </span>
        </div>
        <div class="col-md-4">
            <span>تاریخ :</span>
            <span>{{ $order->webPresent()->orderDate }} </span>
        </div>
        <div class="col-md-4">
            <span>وضعیت :</span>
            <span>{!! $order->webPresent()->status !!} </span>
        </div>

    </div>
    <hr style="margin: 20px 0;">

    <h4 style="margin-top: 20px;"> اطلاعات گیرنده  :</h4>
    <ul style="list-style: none; padding: 0;">
        <li style="display: flex; justify-content: space-between; padding: 5px 0;">
            <span>نام و نام خانوادگی:</span>
            <span>{{$order->receiver->first_name .$order->receiver->last_name}}</span>
        </li>
        <li style="display: flex; justify-content: space-between; padding: 5px 0;">
            <span>کد ملی:</span>
            <span>{{$order->receiver->national_code}}</span>
        </li>
        <li style="display: flex; justify-content: space-between; padding: 5px 0;">
            <span>شماره موبایل:</span>
            <span>{{$order->receiver->mobile}}</span>
        </li>

        <li style="display: flex; justify-content: space-between; padding: 5px 0;">
            <span>آدرس:</span>
            <span>{{$order->receiver->address}}</span>
        </li>
        <li style="display: flex; justify-content: space-between; padding: 5px 0;">
            <span>کد پستی:</span>
            <span>{{$order->receiver->zip_code}}</span>
        </li>
    </ul>
    <hr style="margin: 20px 0;">

    <h4 style="margin-top: 20px;"> کالاها:</h4>
    <ul style="list-style: none; padding: 0; margin: 0 0 10px 0;">
        @foreach ($order->items as $item)
            <li style="display: flex; justify-content: space-between; padding: 6px 0; border-bottom: 1px dashed #ccc;">
                <span>{{ $item->product->title }} - {{ $item->quantity }} عدد  </span>
                <span>{{ number_format($item->price * $item->quantity) }} تومان</span>
            </li>
        @endforeach
    </ul>

    <hr style="margin: 20px 0;">

    <ul style="list-style: none; padding: 0;">
        <li style="display: flex; justify-content: space-between; padding: 5px 0;">
            <span>جمع قیمت کالاها:</span>
            <span>{{ number_format($order->order_amount + $order->discount_amount) }} تومان</span>
        </li>
        <li style="display: flex; justify-content: space-between; padding: 5px 0;">
            <span>هزینه ارسال:</span>
            <span>{{ number_format($order->delivery_amount) }} تومان</span>
        </li>
        <li style="display: flex; justify-content: space-between; padding: 5px 0;">
            <span>تخفیف:</span>
            <span>{{ number_format($order->discount_amount) }} تومان</span>
        </li>
        <li style="display: flex; justify-content: space-between; padding: 5px 0;">
            <span>مالیات:</span>
            <span>{{ number_format($order->total_amount * 0.1) }} تومان</span>
        </li>
        <li style="display: flex; justify-content: space-between; padding: 5px 0;">
            <span>قیمت نهایی:</span>
            <span>{{ number_format($order->total_amount) }} تومان</span>
        </li>
    </ul>
</div>

