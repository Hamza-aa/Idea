@props(['label'=>false , 'name' , 'type' , 'placeholder' => ""])

<div class="space-y-2">
    @if($label)
    <label for="{{ $name }}" class="label"> {{ $label }}</label>
    @endif

    @if($type === 'textarea')
            <textarea name="{{$name}}" placeholder="{{ $placeholder }}" id="{{ $name }}" class="textarea" {{ $attributes }}>{{ old($name) }}</textarea>
    @else
            <input type="{{ $type }}" placeholder="{{ $placeholder }}" name="{{$name}}" value="{{ old(@$name) }}" id="{{ $name }}" {{ $attributes }} class="input">
    @endif

    <x-form.error name="{{ $name }}"/>
</div>
