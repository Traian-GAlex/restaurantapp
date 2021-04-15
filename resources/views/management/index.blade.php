@extends("layouts.app")

@section("content")
    <div class="container">
        <div class="row">
            <div class="col-md-4">@include('management.menu')</div>
            <div class="col-md-8">
                @yield("management")
            </div>
        </div>
    </div>
@endsection
