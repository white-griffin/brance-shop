<input type="text" id="{{$name}}" name="{{$name}}"
       class="form-control form-control-lg form-control-solid"
       placeholder="{{isset($label) ? $label : '12::30 AM'}}"
       @if(isset($value)) value="{{ old($name, $value) }}" @else value="{{old($name)}}" @endif />
@error($name)
<p class="text-danger">{{$message}}</p>
@enderror


<script src="{{asset("admin-assets/plugins/added/mdtimepicker/mdtimepicker.js")}}"></script>
<script>
    $(document).ready(function () {
        $('#{{$name}}').mdtimepicker({
            timeFormat: 'hh:mm:ss', // format of the time value (data-time attribute)
            format: 'hh:mm',    // format of the input value
            readOnly: true,       // determines if input is readonly
            hourPadding: true,
            theme: 'dark',
            okLabel: 'تائید',
            cancelLabel: 'انصراف',
            clearBtn : true
        });
    });
</script>
