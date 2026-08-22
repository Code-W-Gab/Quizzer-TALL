@props(['value' => 0])

<div class="w-full bg-gray-200 rounded-full h-4 overflow-hidden dark:bg-gray-700">
    <!-- Inline style dynamically sets width safely -->
    <div class="bg-blue-600 h-4 rounded-full text-center text-[10px] font-medium leading-4 text-white transition-all duration-500 ease-out"
         style="width: {{ max(0, min(100, $value)) }}%">
        {{ $value }}%
    </div>
</div>
