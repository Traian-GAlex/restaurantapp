<div class="row">
    <div class="col">
        @if (count($order_payments) <= 0)
            <div class="alert alert-light" role="alert">
                <h4>There are no payments to show.</h4>
            </div>
        @else
            @include("include.success_viewer")

            <table class="table table-sm table-striped table-hover">
                <thead class="bg-primary text-light">
                <tr>
                    <th class="text-left" scope="col">Payment date</th>
                    <th class="text-center" scope="col">Amount</th>
                    <th class="text-center" scope="col">Received</th>
                    <th class="text-center" scope="col">Change</th>
                    <th class="text-center" scope="col">POS</th>
                </tr>
                </thead>
                <tbody>
                @foreach($order_payments as $o)
                    <tr>
                        <td style="width: 150px;" class="align-middle">{{$o->payment_date->format('d/m/Y H:i')}}</td>
                        <td style="width: 75px;" class="text-right align-middle">{{$o->amount}}</td>
                        <td style="width: 75px;" class="text-right align-middle">{{$o->received}}</td>
                        <td style="width: 75px;" class="text-right align-middle">{{$o->change}}</td>
                        <td style="width: 75px;" class="text-center align-middle">
                            @if($o->pos)
                                <i class="las la-check-square la-lg text-info"></i>
                            @else
                                <i class="las la-stop la-lg text-success"></i>
                            @endif
                        </td>

                    </tr>
                @endforeach
                </tbody>

            </table>

        @endif
    </div>
</div>

<script>
</script>

@section('custom_script')
    @parent

@endsection
