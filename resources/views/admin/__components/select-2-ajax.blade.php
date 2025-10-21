
<select class="form-control  form-select form-select-solid" @if(isset($disabled) && $disabled == true) disabled @endif
        id="kt_select2_{{ $name }}"
        @if(isset($parent) && $parent != "")
            data-dropdown-parent="#{{$parent}}"
        @endif
        @if(isset($isMultiple) && $isMultiple)
            name="{{ $name }}[]"  multiple="multiple"
        @else
            name="{{ $name }}"
        @endif
    >
    @if(isset($selectedItems) && $selectedItems != null)
        @foreach($selectedItems as $selectedItem)
            <option value="{{$selectedItem['id']}}" selected="selected">
                {{$selectedItem['title']}}</option>
        @endforeach
    @endif

</select>
@error($name)
<p class="text-danger">{{$message}}</p>
@enderror
<script>

    $(document).ready(function () {

        // Format displayed data
        function {{ $name }}FormatRepo(repo) {
            if (repo.loading) return 'در حال جستجو ...';
            let markup =  repo.name;
            return markup;
        }
        // Format selection
        function {{ $name }}FormatRepoSelection(repo) {
            if (repo.name == undefined) return repo.text;
            return repo.name ;
        }
        // Format selection

        $('#kt_select2_{{ $name }}').select2({
            @if(isset($isMultiple) && $isMultiple)
            tags: true,
            @endif

            @if(isset($parent) && $parent != "")
                dropdownParent:$("#{{$parent}}"),
            @endif
            language: {
                inputTooShort: function (args) {
                    let remainingChars = args.minimum - args.input.length;
                    let message = 'حداقل ' + remainingChars + ' حرف یا بیشتر برای جستجو وارد کنید';
                    return message;
                },
                noResults: function () {
                    return 'نتیجه ای یافت نشد !';
                },
            },
            allowClear: true,
            placeholder: "انتخاب {{ (isset($title))  ? $title : '' }}",


            minimumInputLength: 1,
            ajax: {
                url: "{!! $url !!}",
                dataType: 'json',
                delay: 20,
                data: function (params) {
                    return {
                        q: params.term, // search term
                        parent_value : {{ (isset($parenValue))  ? $parenValue : 'null' }},
                        null_value : {{ (isset($nullValue))  ? $nullValue : 'null' }}

                    };
                },
                processResults: function (response, params) {
                    let {{ $name }} = response.data;
                    params.page = params.page || 1;
                    return {
                        results: {{ $name }},
                    };
                },
                cache: true
            },
            escapeMarkup: function (markup) {
                return markup;
            }, // let our custom formatter work
            templateResult: {{ $name }}FormatRepo, // omitted for brevity, see the source of this page
            templateSelection: {{ $name }}FormatRepoSelection // omitted for brevity, see the source of this page

        });

    })
</script>



