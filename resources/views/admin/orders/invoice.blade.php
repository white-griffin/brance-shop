<div style="direction: rtl; font-family: Tahoma, sans-serif; font-size: 14px; padding: 20px;">
    <h2 style="text-align: center; margin-bottom: 20px;">فاکتور خرید</h2>

    <h4 style="margin-top: 20px;">جزئیات کالاها:</h4>
    <ul style="list-style: none; padding: 0; margin: 0 0 10px 0;">
        @foreach ($order->items as $item)
            <li style="display: flex; justify-content: space-between; padding: 6px 0; border-bottom: 1px dashed #ccc;">
                <span>{{ $item->quantity }} x {{ $item->product->title }} </span>
                <span>{{ number_format($item->price * $item->quantity) }} تومان</span>
            </li>
        @endforeach
    </ul>

    <hr style="margin: 20px 0;">

    <ul style="list-style: none; padding: 0;">
        <li style="display: flex; justify-content: space-between; padding: 8px 0;">
            <span>جمع قیمت کالاها:</span>
            <span>{{ number_format($order->order_amount + $order->discount_amount) }} تومان</span>
        </li>
        <li style="display: flex; justify-content: space-between; padding: 8px 0;">
            <span>هزینه ارسال:</span>
            <span>{{ number_format($order->delivery_amount) }} تومان</span>
        </li>
        <li style="display: flex; justify-content: space-between; padding: 8px 0;">
            <span>تخفیف:</span>
            <span>{{ number_format($order->discount_amount) }} تومان</span>
        </li>
        <li style="display: flex; justify-content: space-between; padding: 10px 0; font-weight: bold; font-size: 16px;">
            <span>مالیات:</span>
            <span>{{ number_format($order->total_amount * 0.1) }} تومان</span>
        </li>
        <li style="display: flex; justify-content: space-between; padding: 10px 0; font-weight: bold; font-size: 16px;">
            <span>قیمت نهایی:</span>
            <span>{{ number_format($order->total_amount) }} تومان</span>
        </li>
    </ul>
</div>
