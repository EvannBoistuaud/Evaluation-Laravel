@props(['property'])
@error('{{ $property }}')
      <p class="text-danger">{{ $property }}</p>
    @enderror
