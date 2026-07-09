@props(['name'])


@error($name)
<p class="error text-red-500">{{ $message }}</p>
@enderror
