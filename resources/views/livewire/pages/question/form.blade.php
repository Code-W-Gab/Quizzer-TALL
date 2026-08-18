{{-- Identification --}}
<div wire:show='type === "identification"' class="space-y-4">
    <div class="flex flex-col gap-1">
        <label for="identification_answer" class="font-semibold text-gray-900 text-sm">
            Correct Answer
        </label>
        <input
            id="identification_answer"
            type="text"
            wire:model='identificationAnswer'
            placeholder="Expected answers"
            :disabled="$wire.type !== 'identification'"
            class="rounded-lg border border-gray-200 bg-gray-100"
        />
        <x-input-error :messages="$errors->get('identificationAnswer')" class="mt-2" />
    </div>
</div>

{{-- Multiple Choice --}}
<div wire:show='type === "multiple_choice"' class="space-y-4">

    <div class="flex flex-col gap-3">
        <label class="font-semibold text-gray-900 text-sm">
            Options
        </label>

        @foreach ($options as $index => $option)
            <div class="flex items-center gap-3" wire:key='{{ $index }}'>
                <button type="button"
                        wire:click="selectOption({{ $index }})"
                        :disabled="$type !== 'multiple_choice'"
                        class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full text-sm font-semibold transition duration-150 shadow-sm border outline-none
                        {{ $correctOptionIndex === $index
                            ? 'bg-blue-600 border-blue-600 text-white ring-2 ring-blue-100'
                            : 'bg-white border-gray-200 text-gray-800 hover:bg-gray-50'
                        }}">
                    {{ chr(65 + $index) }}
                </button>

                <div class="flex-1">
                    <input type="text"
                           wire:model="options.{{ $index }}"
                           placeholder="Option {{ chr(65 + $index) }}"
                           :disabled="$type !== 'multiple_choice'"
                           class="w-full h-11 rounded-xl border-0 bg-gray-50 px-4 text-sm text-gray-900 ring-1 ring-inset ring-gray-100 placeholder:text-gray-400 focus:bg-white focus:ring-2 focus:ring-inset focus:ring-blue-600 transition duration-150 outline-none">

                    <!-- Validation Error display -->
                    @error("options.{$index}")
                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        @endforeach

        @error('correctOptionIndex')
            <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
        @enderror
    </div>
</div>

{{-- True/False --}}
<div wire:show="type === 'true_false'" x-cloak class="space-y-4">

    <div class="flex flex-col gap-1">
        <label class="font-semibold text-gray-900 text-sm">
            Correct Answer
        </label>

        <div class="grid grid-cols-2 gap-3">
            <button
                type="button"
                wire:click="selectTrueFalse('true')"
                class="rounded-xl border px-4 py-2 font-semibold transition
                {{ $trueFalseAnswer === 'true'
                    ? 'bg-blue-500 text-white border-blue-500'
                    : 'bg-gray-100 text-gray-700 border-gray-300'
                }}"
            >
                True
            </button>

            <button
                type="button"
                wire:click="selectTrueFalse('false')"
                class="rounded-xl border px-4 py-2 font-semibold transition
                {{ $trueFalseAnswer === 'false'
                    ? 'bg-blue-500 text-white border-blue-500'
                    : 'bg-gray-100 text-gray-700 border-gray-300'
                }}"
            >
                False
            </button>
        </div>

        @error('trueFalseAnswer')
            <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
        @enderror
    </div>
</div>

{{-- Enumeration --}}
<div wire:show="type === 'enumeration'" x-cloak class="space-y-4">
    <div class="flex flex-col gap-1">
        <label for="enumeration_answer" class="font-semibold text-gray-900 text-sm">
            Correct Answer
        </label>
        <input
            id="enumeration_answer"
            type="text"
            :disabled="$wire.type !== 'enumeration'"
            class="rounded-lg border border-gray-200 bg-gray-100"
        />
        <x-input-error :messages="$errors->get('answers')" class="mt-2" />
    </div>
</div>


