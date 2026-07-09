@props(['status' => 'PENDING'])

@php
$classes= 'inline-block rounded-full border px-2 py-1 text-xs font-medium';

if ($status === 'PENDING'){
    $classes .= ' bg-yellow-500/10 text-yellow-500 border-yellow-500/20';
}

if ($status === 'IN_PROGRESS'){
    $classes .= 'bg-blue-500/10 text-blue-500 border-blue-500/20';
}

if ($status === 'COMPLETED'){
        $classes .= 'bg-primary/10 text-primary border-primary/20';

}


@endphp


<span {{$attributes(['class' => $classes])}}>
{{$slot}}
</span>
