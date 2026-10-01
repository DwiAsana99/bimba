@props(['items' => []])

@if (!empty($items))
    <nav class="text-xs text-slate-500 mb-2 font-medium" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2">
            <li class="inline-flex items-center">
                <a href="{{ url('/') }}" class="inline-flex items-center hover:text-bimba-maroon transition-colors">
                    <svg class="w-3.5 h-3.5 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l1.293 1.293a1 1 0 001.414-1.414l-7-7z"></path>
                    </svg>
                    Dashboard
                </a>
            </li>
            @foreach ($items as $item)
                <li>
                    <div class="flex items-center">
                        <svg class="w-3.5 h-3.5 text-slate-400 mx-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        @if (isset($item['url']) && !$loop->last)
                            <a href="{{ $item['url'] }}" class="ml-1 hover:text-bimba-maroon transition-colors md:ml-2">{{ $item['title'] }}</a>
                        @else
                            <span class="ml-1 text-slate-700 font-semibold md:ml-2">{{ $item['title'] }}</span>
                        @endif
                    </div>
                </li>
            @endforeach
        </ol>
    </nav>
@endif
