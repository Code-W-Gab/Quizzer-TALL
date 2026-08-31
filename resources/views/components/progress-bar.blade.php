@props([
    'value' => 0,
    'min' => 0,
    'max' => 100,
])

@php
    $safeValue = max((float) $min, min((float) $max, (float) $value));
    $percentage = $max === $min ? 0 : (($safeValue - $min) / ($max - $min)) * 100;
@endphp

<div class="w-full bg-gray-200 rounded-full h-4 overflow-hidden dark:bg-gray-700">
    <div
        class="bg-blue-600 h-4 rounded-full text-center text-[10px] font-medium leading-4 text-white transition-all duration-500 ease-out"
         style="width: {{ $percentage }}%"
    >
    </div>
</div>
