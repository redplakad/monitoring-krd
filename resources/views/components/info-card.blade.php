@props(['label', 'value', 'iconPath', 'iconAlt' => 'Icon'])

<div class="bg-white shadow rounded-xl p-6">
    <div class="flex items-center justify-between">
        <div>
            <p class="text-sm text-gray-500">{{ $label }}</p>
            <p class="text-2xl font-bold text-gray-800">{{ $value }}</p>
        </div>
        <div>
            <img src="{{ asset($iconPath) }}" alt="{{ $iconAlt }}" class="w-10 h-10">
        </div>
    </div>
</div>
