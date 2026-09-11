@props(['percentage' => 95])

@php
    // Calculate the SVG stroke dashoffset based on a radius of 40 (Circumference = 2 * pi * 40 ≈ 251.2)
    $radius = 40;
    $circumference = 2 * pi() * $radius;
    $strokeOffset = $circumference - ($percentage / 100) * $circumference;
@endphp

<div class="progress-circle-container" style="position: relative;  display: inline-flex; align-items: center; justify-content: center;">
    <svg {{ $attributes }} viewBox="0 0 100 100" style="transform: rotate(-90deg);">
        <!-- Background Track Circle -->
        <circle
            cx="50"
            cy="50"
            r="{{ $radius }}"
            stroke="#eaeaea"
            stroke-width="10"
            fill="transparent"
        />
        <!-- Active Progress Circle -->
        <circle
            cx="50"
            cy="50"
            r="{{ $radius }}"
            stroke="#1d72f2"
            stroke-width="10"
            stroke-linecap="round"
            fill="transparent"
            stroke-dasharray="{{ $circumference }}"
            stroke-dashoffset="{{ $strokeOffset }}"
            style="transition: stroke-dashoffset 0.3s ease;"
        />
    </svg>
    <!-- Text Center Label -->
    <span style="position: absolute; font-family: sans-serif; font-weight: bold; color: #111;">
        {{ $percentage }}%
    </span>
</div>
