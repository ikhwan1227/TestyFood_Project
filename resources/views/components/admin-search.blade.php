@props(['route', 'value' => '', 'placeholder' => 'Cari...'])

<form action="{{ $route }}" method="GET" class="admin-search" role="search">
    <svg class="admin-search-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <circle cx="11" cy="11" r="8"></circle>
        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
    </svg>

    <input type="text"
           name="q"
           value="{{ $value }}"
           placeholder="{{ $placeholder }}"
           class="admin-search-input"
           autocomplete="off">

    @if($value)
        <a href="{{ $route }}" class="admin-search-clear" title="Hapus pencarian">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
        </a>
    @endif
</form>