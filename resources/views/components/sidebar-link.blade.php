<a href="{{ $link }}" {!! $attributes->merge(['class' =>"text-gray-900 hover:text-gray-900 hover:bg-gray-50 group rounded-md px-3 py-2 flex items-center text-sm font-medium"]) !!}>

<!-- Heroicon name: user-circle -->
    {{--    <svg class="text-gray-400 group-hover:text-gray-500 flex-shrink-0 -ml-1 mr-3 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">--}}
    {{--        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />--}}
    {{--    </svg>--}}
    <span class="truncate">
            {{ $slot }}
          </span>
</a>
