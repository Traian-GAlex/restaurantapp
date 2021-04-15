@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="row text-center">
                            @if(Auth::user()->isInRole('Admin'))
                                <div class="col-sm-4">
                                    <a href="/management">
                                        <h4>Management</h4>
                                        <img width="50px" src="{{asset("/icons/flaticons/web-management.png")}}" alt="">
                                    </a>
                                </div>
                            @endif

                            @if(Auth::user()->isInRole('Cashier'))
                                <div class="col-sm-4">
                                    <a href="/cashier">
                                        <h4>Cashier</h4>
                                        <img width="50px" src="{{asset("/icons/flaticons/cashier-machine.png")}}"
                                             alt="">
                                    </a>
                                </div>
                            @endif

                            @if(Auth::user()->isInRole('Admin'))
                                <div class="col-sm-4">
                                    <a href="/reports">
                                        <h4>Reports</h4>
                                        <img width="50px" src="{{asset("/icons/flaticons/dashboard.png")}}" alt="">
                                    </a>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
