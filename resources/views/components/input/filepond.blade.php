@props([
    'label' => false,
    'error' => false,
    'helpText' => false,
    'uploadedFiles' => [],
])

<div wire:ignore x-data x-init="() => {
    const post = FilePond.create($refs.{{ $attributes->get('ref') ?? 'input' }});
    post.setOptions({
        allowMultiple: {{ $attributes->has('multiple') ? 'true' : 'false' }},
        allowImagePreview: {{ $attributes->has('allowImagePreview') ? 'true' : 'false' }},
        imagePreviewMaxHeight: {{ $attributes->has('imagePreviewMaxHeight') ? $attributes->get('imagePreviewMaxHeight') : '256' }},
        allowFileTypeValidation: {{ $attributes->has('  ') ? 'true' : 'false' }},
        acceptedFileTypes: {!! $attributes->get('acceptedFileTypes') ?? 'null' !!},
        allowFileSizeValidation: {{ $attributes->has('allowFileSizeValidation') ? 'true' : 'false' }},
        maxFileSize: {!! $attributes->has('maxFileSize') ? "'" . $attributes->get('maxFileSize') . "'" : 'null' !!},
        maxFiles: {!! $attributes->has('maxFiles') ? "'" . $attributes->get('maxFiles') . "'" : 'null' !!},
        server: {
            process: (fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                @this.upload('{{ $attributes->whereStartsWith('wire:model')->first() }}', file, load, error, progress)
            },
            revert: (filename, load) => {
                @this.removeUpload('{{ $attributes->whereStartsWith('wire:model')->first() }}', filename, load)
            },
            load: (source, load, error, progress, abort, headers) => {
                var myRequest = new Request(source);
                fetch(myRequest).then((res) => {
                    return res.blob();
                }).then(load);
            },
        },
        files: [
            @if(count($uploadedFiles) > 0)
            @foreach($uploadedFiles as $pathFile) {
                source: '{{ $pathFile }}',
                options: {
                    type: 'local',
                },
            },
            @endforeach
            @endif
        ],
        onremovefile: (error, file) => {
            @this.set('{{ $attributes->whereStartsWith('wire:model')->first() }}', null);
        }
    });
}">
    <label class="block text-sm font-medium text-gray-700">
        {{ $label }}
    </label>

    <div class="mt-1">
        <input {{ $attributes }} type="file" x-ref="input" />
    </div>

    @if ($error)
        <div class="mt-1 text-red-500 text-sm">{{ $error }}</div>
    @endif

    @if ($helpText)
        <p class="mt-1 text-xs text-gray-500">{{ $helpText }}</p>
    @endif
</div>
