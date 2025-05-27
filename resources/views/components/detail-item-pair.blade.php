@props(['label1', 'value1', 'label2' => null, 'value2' => null])

<div class="flex justify-between items-center bg-gray-50 p-4 rounded-xl">
    <div>
        <p class="text-xs text-gray-500">{{ $label1 }}</p>
        <p class="font-medium text-sm text-gray-700">{{ $value1 }}</p>
    </div>
    @if(isset($label2) && isset($value2))
    <div>
        <p class="text-xs text-gray-500">{{ $label2 }}</p>
        <p class="font-medium text-sm text-gray-700">{{ $value2 }}</p>
    </div>
    @endif
</div>
