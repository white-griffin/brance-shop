
<!--begin::Checkboxes-->
<div class="d-flex align-items-center mt-5">
    @foreach($items as $item)
    <!--begin::Checkbox-->
    <label class="form-check form-check-custom form-check-solid me-10">
        <input class="form-check-input h-20px w-20px"
               type="checkbox"
               name="{{$name}}[]"
               id="_{{$name}}_{{$item['id']}}"
               value="{{$item['id']}}"
               @if(isset($activeKeyItems) && is_array($activeKeyItems) && in_array($item['id'], $activeKeyItems) )
               checked="checked"
                @endif
               />
        <span class="form-check-label  ">{{$item['title']}}</span>
    </label>
    <!--end::Checkbox-->
    @endforeach
</div>
<!--end::Checkboxes-->
@error($name)
<p class="text-danger">{{$message}}</p>
@enderror


