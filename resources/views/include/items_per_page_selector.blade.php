<?php
$paginatorValueName = "itemsPerPage";
$itemsNumber = (int)session("itemsPerPage");
$values = [5, 10, 15, 20, 25, 50, 75, 100, 150, 200];
?>

<select class="custom-select" id="itemsPerPage" name="itemsPerPage">
    @foreach($values as $itemValue)
        <option class="m-3" value="{{$itemValue}}" {{($itemValue == $itemsNumber) ? "selected" : ""}}>{{$itemValue}} rows to show &nbsp;&nbsp;</option>
    @endforeach
</select>

@section('custom_script')
    <script src="{{asset('/js/common_controls.js')}}"></script>
@endsection
