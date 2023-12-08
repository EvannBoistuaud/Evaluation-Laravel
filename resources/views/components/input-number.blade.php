@props(['property', 'label', 'old'])
<div>
    <label for="{{ $property }}">{{__("$label")}}</label>
    <input type="number" name="{{ $property }}" id="{{ $property }}" required value="{{ old($old) }}">
  </div>
