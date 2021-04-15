<?php
if (!isset($readonly)) $readonly = false;
?>
@section("custom_head")
    @parent
    <link rel="stylesheet" href="{{asset('js/trix.js/trix.css')}}">
    <script src="{{asset('js/trix.js/trix.js')}}" defer></script>
@endsection

@if($readonly)
    <div class="trix-content">
        <?php echo $value; ?>
    </div>
@else
    <input id="{{$id}}" type="hidden" name="{{$name}}" value="{{$value}}"/>
    <trix-editor input="{{$id}}" class="trix-content" style="background-color: white;"></trix-editor>
@endif
