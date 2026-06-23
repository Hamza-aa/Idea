@props(['label' , 'name' , 'type'])

<div class="space-y-2">
    <label for="{{ $name }}" class="label"> {{ $label }}</label>
    <input type="{{ $type }}" name="{{$name}}" id="{{ $name }}" class="input">
</div>
