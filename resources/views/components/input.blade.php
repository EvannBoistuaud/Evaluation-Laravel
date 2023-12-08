@props(['property', 'type', 'label', 'model'=>null])
<div>
    <label for="{{ $property }}">{{__("$label")}}</label>
    <input type="{{ $type }}" name="{{ $property }}" id="{{ $property }}" required value="{{ old( $property, $model?->$property??null) }}">
  </div>
  <x-error property="{{ $property }}"/>


