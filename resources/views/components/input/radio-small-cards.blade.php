@props([
'label' => null,
'lists' => [],
])

<fieldset x-data="{select: null}" class="mt-1">
    <legend class="sr-only">Choose a topup option</legend>
    <div class="grid grid-cols-3 gap-3 sm:grid-cols-6">
        @foreach ($lists as $key => $val)
        <label
            class="border rounded-md py-2 px-3 flex items-center justify-center text-sm font-medium sm:flex-1 cursor-pointer focus:outline-none"
            :class="select == {{ $key }} ? 'ring-2 ring-offset-2 ring-blue-500 bg-blue-600 border-transparent text-white hover:bg-blue-700' : ''">
            <input {{ $attributes }} type="radio" x-model="select" value="{{ $key }}" class="sr-only">
            <span> {{ $val }} </span>
        </label>
        @endforeach
    </div>
</fieldset>