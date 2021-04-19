<?php
if (!isset($start_date)) $start_date = (new DateTime())->format('Y-m-d');
if (!isset($start_time)) $start_time = '00:00';
if (!isset($end_date)) $end_date = (new DateTime())->format('Y-m-d');
if (!isset($end_time)) $end_time = '23:59';
?>
<form id="date_segment_filter" class="form-inline" >
    @csrf
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label class="mx-1" for="start_date">From: </label>
                <input class="form-control" type="date" id="start_date" name="start_date" value="{{$start_date}}">
                <span class="mx-1"></span>
                <input class="form-control" type="time" id="start_time" name="start_time" value="{{$start_time}}">

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label class="mx-1" for="end_date">To: </label>
                <input class="form-control" type="date" id="end_date" name="end_date" value="{{$end_date}}">
                <span class="mx-1"></span>
                <input class="form-control" type="time" id="end_time" name="end_time" value="{{$end_time}}">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <button id="submit_filter_dates" type="submit" class="btn btn-outline-primary mx-2 ">
                <i class="las la-filter"></i>
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col">
            @include("include.items_per_page_selector", ["rows" => $rows])
        </div>
    </div>


</form>
