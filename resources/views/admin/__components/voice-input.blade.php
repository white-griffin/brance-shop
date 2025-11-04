@if(isset($value))
    <audio controls style="max-width: 100%">
        <source  src="{{$value}}" type="audio/ogg">
    </audio>
    <input class="form-control" name="{{$name}}" value="{{$value}}" type="file"  />
@else
    <input class="form-control" name="{{$name}}" type="file"  />
@endif


