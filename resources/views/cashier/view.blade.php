@extends("layouts.app")

@section('content')

    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <table class="table table-sm table-striped table-hover">
                    <thead class="bg-primary text-light">
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Order date</th>
                        <th scope="col">Name</th>
                        <th scope="col">Adults</th>
                        <th scope="col">Children</th>
                        <th scope="col">Total</th>
                        <th scope="col">Payd</th>
                        <th scope="col">Status</th>

                        <th style="width: 32px;" scope="col">Edit</th>
                        <th style="width: 32px;" scope="col">Delete</th>
                        <th style="width: 32px;" scope="col">Back</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td style="width: 40px;" class="text-right align-middle">
                            <span class="">{{$order->id}}</span>
                        </td>
                        <td style="width: 150px;" class="align-middle">{{$order->order_date->format('d/m/Y H:i')}}</td>
                        <td class="align-middle">{{$order->customer_name}}</td>
                        <td style="width: 40px;" class="text-center align-middle">{{$order->adults}}</td>
                        <td style="width: 40px;" class="text-center align-middle">{{$order->children}}</td>
                        <td style="width: 75px;" class="text-right align-middle">{{$order->total}}</td>
                        <td style="width: 75px;" class="text-right align-middle">{{$order->payd}}</td>
                        <td style="width: 75px;" class="text-center align-middle">
                            @if($order->total <= $order->payd)
                                <i class="las la-check-square la-lg text-success"></i>
                            @else
                                <i class="las la-stop la-lg text-danger"></i>
                            @endif
                        </td>
                        <td style="width: 32px;" class="align-middle">
                            <a class="btn btn-outline-primary" href="/cashier/{{$order->id}}/edit">
                                <i class="las la-pencil-alt la-lg"></i>
                            </a>
                        </td>

                        <td class="align-middle">
                            <form action="/management/user/{{$order->id}}" method="post">
                                @csrf
                                @method("DELETE")
                                <button type="submit" class="btn btn-outline-danger"
                                        onclick="return confirm('Are you sure?')">
                                    <i class="las la-trash la-lg"></i>
                                </button>
                            </form>
                        </td>

                        <td style="width: 32px;" class="align-middle">
                            <a class="btn btn-outline-success" href="{{str_replace(url('/'), '', url()->previous())}}">
                                <i class="las la-hand-point-left la-lg"></i>
                            </a>
                        </td>
                    </tr>
                    </tbody>

                </table>

                <ul class="nav nav-tabs nav-fill">
                    <li class="nav-item">
                        <a id="itemsTab" class="nav-link " href="#">Menu items</a>
                    </li>
                    <li class="nav-item">
                        <a id="tablesTab" class="nav-link" href="#">Tables</a>
                    </li>
                    <li class="nav-item">
                        <a id="paymentsTab" class="nav-link" href="#">Payments</a>
                    </li>
                </ul>
                <div id="order_content" class="container-fluid form-control" >
                    &nbsp;
                </div>

            </div>
        </div>

    </div>
@endsection

@section('custom_head')
    @parent
@endsection

@section('custom_script')
    @parent
    <script src="{{asset('js/common_controls.js')}}" defer></script>
@endsection

