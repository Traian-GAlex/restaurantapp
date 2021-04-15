@extends("layouts.app")

@section("content")
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-5">
                        @include("cashier.include.tables")
                    </div>
                    <div class="col-7">

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
