@if ($paginator->hasPages())
<div class="berita-pagination">
    {{-- Prev --}}
    @if ($paginator->onFirstPage())
    <span class="page-btn page-btn-disabled" aria-disabled="true">
        <i class="fas fa-chevron-left fa-fw"></i>
    </span>
    @else
    <a href="{{ $paginator->previousPageUrl() }}" class="page-btn" aria-label="Halaman sebelumnya">
        <i class="fas fa-chevron-left fa-fw"></i>
    </a>
    @endif

    {{-- Nomor halaman --}}
    @foreach ($elements as $element)
    @if (is_string($element))
    <span class="page-btn page-btn-dots">{{ $element }}</span>
    @endif
    @if (is_array($element))
    @foreach ($element as $page => $url)
    @if ($page == $paginator->currentPage())
    <span class="page-btn page-btn-active" aria-current="page">{{ $page }}</span>
    @else
    <a href="{{ $url }}" class="page-btn">{{ $page }}</a>
    @endif
    @endforeach
    @endif
    @endforeach

    {{-- Next --}}
    @if ($paginator->hasMorePages())
    <a href="{{ $paginator->nextPageUrl() }}" class="page-btn" aria-label="Halaman berikutnya">
        <i class="fas fa-chevron-right fa-fw"></i>
    </a>
    @else
    <span class="page-btn page-btn-disabled" aria-disabled="true">
        <i class="fas fa-chevron-right fa-fw"></i>
    </span>
    @endif
</div>
@endif