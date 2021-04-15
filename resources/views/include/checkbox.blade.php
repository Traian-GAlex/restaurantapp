<?php
if (!isset($readonly)) $readonly = false;
?>
@if($readonly)
    <div>
        <strong>{{$label}}:</strong> <span class="{{$checked ? "text-success": "text-danger"}}">{{$checked ? "Yes": "No"}}</span>
    </div>
@else
    <div class="form-check">
        @if($checked)
            <input class="form-check-input" type="checkbox" checked id="{{$id}}" name="{{$name}}">
        @else
            <input class="form-check-input" type="checkbox" id="{{$id}}" name="{{$name}}">
        @endif
        <label class=" form-check-label" for="available">
            {{ $label}}
        </label>
    </div>
@endif
