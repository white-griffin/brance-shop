<!--begin::Checkboxes-->
<div class=" ">
    @foreach($items as $item)
    <!--begin::Checkbox-->
    <label class="form-check form-check-custom form-check-solid m-5">
        <input class="form-check-input h-20px w-20px"
               type="checkbox"
               name="{{$name}}[]"
               value="{{$item['id']}}"
               @if(isset($activeItemsIDs) && is_array($activeItemsIDs) && in_array($item['id'], $activeItemsIDs ))
               checked="checked"
            @endif
               />
        <span class="form-check-label ">{{$item['title']}}</span>
    </label>
    <!--end::Checkbox-->
    @endforeach
</div>
<!--end::Checkboxes-->

@error($name)
<p class="text-danger">{{$message}}</p>
@enderror

