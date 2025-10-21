<div class="form-group">
    <input type="text" class="form-control" id="{{$name}}"
           data-jdp
           name="{{$name}}" placeholder="{{ isset($placeholder) ? $placeholder : "تاریخ" }}"
           @if(isset($value)) value="{{ old($name, $value) }}" @else value="{{old($name)}}" @endif readonly />
    <input type="hidden" id="{{$name}}_alt"
           name="{{$name}}_alt"
           value="{{(isset($value)) ? old($name.'_alt', $value) : old($name.'_alt') }}"/>
</div>
@php($initial_value = isset($initial_value) ? $initial_value : true )
@error($name)
<p class="text-danger">{{$message}}</p>
@enderror

<script type="text/javascript">


    $(document).ready(function() {

        $("#{{$name}}").pDatepicker({
            initialValue : @json($initial_value) ,
            format: 'L',
            autoClose : true
        });



    });


</script>
