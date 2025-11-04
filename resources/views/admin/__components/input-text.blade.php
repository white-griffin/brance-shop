
<input class="form-control form-control-lg form-control-solid"
       type="{{ (isset($type)) ? $type : 'text' }}"
       name="{{ $name }}"

       @if(isset($disabled) && $disabled) disabled="disabled" @endif
       @if(isset($placeholder)) placeholder="{{$placeholder}}" @endif
       @if(isset($value)) value="{{ old($name,$value) }}" @else value="{{old($name)}}" @endif
       autocomplete="off"/>

<p id="{{$name}}" class="validation-error-msg text-danger" style="display: none"></p>

@error($name)
<p class="text-danger">{{$message}}</p>
@enderror

