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
                    'heading', '|',
                    'bold', 'italic', 'strikethrough', 'underline', 'blockQuote', 'horizontalLine', '|',
                    'fontfamily', 'fontsize', 'fontColor', 'fontBackgroundColor', '|',
                    'alignment', '|',
                    'bulletedList', 'numberedList', 'todoList', '|',
                    'link', '|',
                    'ckfinder', 'imageUpload', 'mediaEmbed', '|',
                    'insertTable', 'tableColumn', 'tableRow', 'mergeTableCells', '|',
                    'highlight', 'removeHighlight', '|',
                    'undo', 'redo', '|',
                    'specialCharacters', 'viewSource'
                ]
            },
            heading: {
                options: [
                    { model: 'paragraph', title: 'پاراگراف', class: 'ck-heading_paragraph' },
                    { model: 'heading1', view: 'h1', title: 'سرفصل ۱', class: 'ck-heading_heading1' },
                    { model: 'heading2', view: 'h2', title: 'سرفصل ۲', class: 'ck-heading_heading2' },
                    { model: 'heading3', view: 'h3', title: 'سرفصل ۳', class: 'ck-heading_heading3' },
                    { model: 'heading4', view: 'h4', title: 'سرفصل ۴', class: 'ck-heading_heading4' }
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
