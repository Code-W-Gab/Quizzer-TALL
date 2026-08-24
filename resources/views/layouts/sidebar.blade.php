@php
    $navLinks = [
        [
            'label' => 'Dashboard',
            'route' => 'dashboard',
            'icon' => 'layout-dashboard'
        ],
        [
            'label' => 'Quiz Folder',
            'route' => 'quiz-folder',
            'icon' => 'folder'
        ],
        [
            'label' => 'Shared with me',
            'route' => 'shared',
            'icon' => 'share-2'
        ],
        [
            'label' => 'Recent Quiz',
            'route' => 'recent-quiz',
            'icon' => 'clock'
        ],
    ];

    $navs = [
        [
            'label' => 'Import Shared',
            'route' => 'import-shared',
            'icon' => 'cloud-download'
        ],
        [
            'label' => 'Settings',
            'route' => 'settings',
            'icon' => 'settings'
        ],
    ]
@endphp

<nav
    x-show="openSidebar"
    class="[grid-area:sidebar] flex flex-col justify-between bg-white border-r border-gray-300"
>
    <div class="relative">
        <button
            @click="openSidebar = false"
            type="button"
            class="absolute top-3 right-3 bg-gray-50 border border-gray-200 p-1 rounded-md"
        >
            <x-lucide-chevron-left class="size-5"/>
        </button>
        <div class="flex flex-col gap-4 py-6 px-3 mt-4">
            @foreach ($navLinks as $nav)
                @php
                    $isActive = request()->routeIs($nav['route']);
                @endphp

                <a href="{{ route($nav['route']) }}"
                    class="{{  $isActive ? 'bg-blue-100 text-blue-500' : ''}} flex items-center gap-3 py-1.5 px-3 rounded-md hover:bg-blue-50"
                >
                    <x-dynamic-component :component="'lucide-' . $nav['icon']" class="size-5"/>
                    <span>{{ $nav['label'] }}</span>
                </a>
            @endforeach
        </div>
        <div class="border-b border-gray-300 mx-4"></div>
        <div class="flex flex-col gap-4 py-6 px-3">
            @foreach ($navs as $nav)
                @php
                    $isActive = request()->routeIs($nav['route']);
                @endphp

                <a
                    class="{{  $isActive ? 'bg-blue-100 text-blue-500' : ''}} flex items-center gap-3 py-1.5 px-3 rounded-md hover:bg-blue-50"
                >
                    <x-dynamic-component :component="'lucide-' . $nav['icon']" class="size-5"/>
                    <span>{{ $nav['label'] }}</span>
                </a>
            @endforeach
        </div>
    </div>
    <form class="flex items-center justify-between bg-white p-4 border-t border-gray-300">

        <div class="flex flex-col">
            <span class="text-sm font-semibold">{{ Auth::user()->name }}</span>
            <span class="text-xs">{{ Auth::user()->email }}</span>
        </div>
        <button type="submit">
            {{-- <x-icons.logout class="size-5"/> --}}
        </button>
    </form>
</nav>

<nav
    x-show="!openSidebar"
    class="[grid-area:sidebar] flex flex-col bg-white border-r border-gray-300"
>
    <div class="flex flex-col gap-4 py-6 px-3">
        <button
            type="button"
            class="flex items-center gap-3 py-1.5 px-3 rounded-md hover:bg-blue-50 bg-gray-50 border border-gray-200"
            @click="openSidebar = true"
        >
            <x-lucide-chevron-right class="size-5"/>
        </button>
        @foreach ($navLinks as $nav)
            @php
                $isActive = request()->routeIs($nav['route']);
            @endphp

            <a href="{{ route($nav['route']) }}"
                class="{{  $isActive ? 'bg-blue-100 text-blue-500' : ''}} flex items-center gap-3 py-1.5 px-3 rounded-md hover:bg-blue-50"
            >
                <x-dynamic-component :component="'lucide-' . $nav['icon']" class="size-5"/>
            </a>
        @endforeach
    </div>
    <div class="border-b border-gray-300 mx-4"></div>
    <div class="flex flex-col gap-4 py-6 px-3">
        @foreach ($navs as $nav)
            @php
                $isActive = request()->routeIs($nav['route']);
            @endphp

            <a
                class="{{  $isActive ? 'bg-blue-100 text-blue-500' : ''}} flex items-center gap-3 py-1.5 px-3 rounded-md hover:bg-blue-50"
            >
                <x-dynamic-component :component="'lucide-' . $nav['icon']" class="size-5"/>
            </a>
        @endforeach
    </div>
</nav>


