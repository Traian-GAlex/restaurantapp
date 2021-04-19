@extends("layouts.app")

@section("content")
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col col-lg-10">
                        @include("include.date_time_filter", [
                            "start_date" => $start_date,
                            "start_time" => $start_time,
                            "end_date" => $end_date,
                            "end_time" => $end_time,
                            "rows" => $all_rows,
                        ])
                    </div>
                    <div class="col col-lg-2">
                        <a href="#" class="btn btn-success btn-block float-right">
                            <i class="las la-plus la-lg"></i>
                            <span>Add order</span>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                @include("cashier.include.orders_list", ["orders" => $orders])
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
