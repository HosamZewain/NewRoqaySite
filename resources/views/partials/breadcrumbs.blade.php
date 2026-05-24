@if(isset($items) && count($items) > 0)
<nav class="flex px-4 py-3 text-gray-400 text-sm" aria-label="Breadcrumb">
    <ol class="inline-flex items-center space-x-1 md:space-x-3 {{ $isRtl ? 'space-x-reverse' : '' }}">
        <li class="inline-flex items-center">
            <a href="{{ route($locale . '.home') }}" class="inline-flex items-center hover:text-cyan-400 transition-colors">
                <span class="material-icons-round text-lg {{ $isRtl ? 'ml-1' : 'mr-1' }}">home</span>
                {{ $isRtl ? 'الرئيسية' : 'Home' }}
            </a>
        </li>
        @foreach($items as $item)
            <li>
                <div class="flex items-center">
                    <span class="material-icons-round text-sm mx-1">{{ $isRtl ? 'chevron_left' : 'chevron_right' }}</span>
                    @if(!$loop->last && isset($item['url']))
                        <a href="{{ $item['url'] }}" class="hover:text-cyan-400 transition-colors">{{ $item['label'] }}</a>
                    @else
                        <span class="text-white font-medium" aria-current="page">{{ $item['label'] }}</span>
                    @endif
                </div>
            </li>
        @endforeach
    </ol>
</nav>

<!-- Breadcrumb Schema -->
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [
    {
      "@type": "ListItem",
      "position": 1,
      "name": "{{ $isRtl ? 'الرئيسية' : 'Home' }}",
      "item": "{{ route($locale . '.home') }}"
    }
    @foreach($items as $index => $item)
    ,{
      "@type": "ListItem",
      "position": {{ $index + 2 }},
      "name": "{{ $item['label'] }}"
      @if(isset($item['url']))
      ,"item": "{{ $item['url'] }}"
      @endif
    }
    @endforeach
  ]
}
</script>
@endif
