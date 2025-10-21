<div class="form-group">
    <textarea id="{{ $name }}" name="{{ $name }}" rows="8"
              class="form-control">{!! (isset($value)) ? old($name, $value) : old($name) !!}</textarea>
</div>
@error($name)
<p class="text-danger">{{ $message }}</p>
@enderror

<script src="{{ asset('admin-assets/plugins/added/ckeditor5/ckeditor.js') }}"></script>

<script>
    ClassicEditor
        .create(document.querySelector('#{{ $name }}'), {
            language: 'fa',
            ckfinder: {
                uploadUrl: '{{ route('admin.blogs.ckeditor.upload') }}?&_token={{ csrf_token() }}'
            },
            toolbar: {
                items: [
                    'ckfinder', 'imageUpload',  'imageTextAlternative', 'mediaEmbed', '|',

                    'fontfamily', 'fontsize',  'fontColor', 'fontBackgroundColor',  'blockQuote','|',
                    'bold', 'italic', 'strikethrough', 'underline',  'horizontalLine','subscript',
                    'bulletedList', 'numberedList', 'todoList',  'superscript', 'link', '|',
                    'heading', '|',
                    'undo', 'redo',
                    'highlight', 'removeHighlight', '|',
                    'alignment', 'selectAll', '|',
                    'Indent', 'Outdent', '|',
                    'insertTable', 'tableColumn', 'tableRow', 'mergeTableCells', '|',
                    'specialCharacters', 'viewSource'
                ]
            },
            link: {
                decorators: {
                    openInNewTab: {
                        mode: 'manual',
                        label: 'باز کردن در تب جدید',
                        defaultValue: true,
                        attributes: {
                            target: '_blank',
                            rel: 'noopener noreferrer'
                        }
                    },
                    nofollow: {
                        mode: 'manual',
                        label: 'Nofollow',
                        attributes: {
                            rel: 'nofollow'
                        }
                    }
                }
            }
        })
        .catch(error => {
            console.error(error);
        });

</script>
