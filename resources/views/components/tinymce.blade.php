<div x-data="{ value: @entangle($attributes->wire('model')) }" x-init="
    editor_config = {
        path_absolute : '/',
        target: $refs.tinymce,
        themes: 'modern',
        height: 400,
        relative_urls: false,
        plugins: [
            'advlist autolink lists link image charmap print preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table paste code help wordcount'
        ],
        toolbar: 'undo redo | formatselect | ' +
        'bold italic | alignleft aligncenter ' +
        'alignright alignjustify | bullist numlist outdent indent | ' +
        '| link image media | removeformat | help',
        setup: function(editor) {
            editor.on('blur', function(e) {
                value = editor.getContent()
            })

            editor.on('init', function (e) {
                if (value != null) {
                    editor.setContent(value)
                }
            })

            function putCursorToEnd() {
                editor.selection.select(editor.getBody(), true);
                editor.selection.collapse(false);
            }

            $watch('value', function (newValue) {
                if (newValue !== editor.getContent()) {
                    editor.resetContent(newValue || '');
                    putCursorToEnd();
                }
            });
        },
        file_picker_callback : function(callback, value, meta) {
        var x = window.innerWidth || document.documentElement.clientWidth ||
        document.getElementsByTagName('body')[0].clientWidth;
        var y = window.innerHeight|| document.documentElement.clientHeight||
        document.getElementsByTagName('body')[0].clientHeight;

        var cmsURL = editor_config.path_absolute + 'laravel-filemanager?editor=' + meta.fieldname;
        if (meta.filetype == 'image') {
        cmsURL = cmsURL + '&type=Images';
        } else {
        cmsURL = cmsURL + '&type=Files';
        }

        tinyMCE.activeEditor.windowManager.openUrl({
        url : cmsURL,
        title : 'Filemanager',
        width : x * 0.8,
        height : y * 0.8,
        resizable : 'yes',
        close_previous : 'no',
        onMessage: (api, message) => {
        callback(message.content);
        }
        });
        }
    }
    tinymce.init(editor_config);
    " wire:ignore>
    <div>
        <input x-ref="tinymce" type="textarea" {{ $attributes->whereDoesntStartWith('wire:model') }}>
    </div>
</div>
