@props(['label', 'error' => false, 'helpText' => false, 'disabled' => false])

<div class="relative flex items-start">
    <div class="flex h-5 items-center">
        <input type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
            {{ $attributes }}>
    </div>
    <div class="ml-3 text-sm">
        <label class="font-medium text-gray-700">{{ $label }}</label>
        @if ($error)
            <p class="text-red-500">Get notified when someones posts a comment on a posting.</p>
        @endif

        @if ($helpText)
            <p class="text-gray-500">{{ $helpText }}</p>
        @endif
    </div>
</div>
