@props([
    'pagesCount',
    'curPage',
    'link',
    'showCount',
    'query'
])
@php
    $start = 1;
@endphp
<div class="row">
    <div class="col text-center mb-1">
        @for($p=$start; $p <= $pagesCount; $p++)
            <a class="btn btn-@php echo ($curPage == $p ? "primary" : "secondary") @endphp" href="{{ $link }}?p={{ $p }}&{{ $query }}">{{ $p }}</a>
        @endfor
    </div>
</div>
