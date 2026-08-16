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

<nav class="[grid-area:sidebar] flex flex-col justify-between bg-white border-r border-gray-300">
    <div>
        <div class="flex flex-col gap-4 py-6 px-3 ">
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


