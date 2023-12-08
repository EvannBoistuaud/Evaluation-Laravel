@props(['property', 'label', 'collec', 'model'=>null, 'prop_name'])
<div>
    <label for="{{ $property }}">{{__( $label )}}</label>
    <select name="{{ $property }}" id="{{ $property }}">
      @foreach ($collec as $iteration)
      <option value="{{ $iteration->id }}" {{ $model == null ? '' : ($model->$property == $iteration->id ? 'selected' : '') }}>
        {{ $iteration->$prop_name}}

    </option>
      @endforeach
    </select>
</div>
