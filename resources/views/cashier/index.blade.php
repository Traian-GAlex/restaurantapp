@extends("layouts.app")

@section("content")
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                @include("include.date_time_filter", [
                            "start_date" => $start_date,
                            "start_time" => $start_time,
                            "end_date" => $end_date,
                            "end_time" => $end_time,
                        ])
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                {{count($orders)}}
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                &nbsp;
            </div>
        </div>
    </div>

@endsection

@section('custom_script')
    <script src="{{asset('js/cashier/cashier.js')}}" defer></script>
@endsection
