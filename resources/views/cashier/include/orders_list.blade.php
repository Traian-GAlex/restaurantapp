<?php

?>
{{$orders->links()}}
@if (count($orders) <= 0)
    <div class="alert alert-light" role="alert">
        <h4>There are no orders to show.</h4>
    </div>
@else

    @include("include.success_viewer")



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

            <th style="width: 32px;" scope="col">View</th>
            <th style="width: 32px;" scope="col">Edit</th>
            <th style="width: 32px;" scope="col">Delete</th>
        </tr>
        </thead>
        <tbody>
        @foreach($orders as $order)
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
                    <a class="btn btn-outline-success" href="/cashier/{{$order->id}}/view">
                        <i class="las la-search la-lg"></i>
                    </a>
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
            </tr>
        @endforeach
        </tbody>

    </table>



@endif
{{$orders->links()}}
