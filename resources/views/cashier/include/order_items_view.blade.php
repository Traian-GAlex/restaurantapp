


<div class="row">
    <div class="col">
        @if (count($order_items) <= 0)
            <div class="alert alert-light" role="alert">
                <h4>There are no orders items to show.</h4>
            </div>
        @else
            @include("include.success_viewer")

                <table class="table table-sm table-striped table-hover">
                    <thead class="bg-primary text-light">
                    <tr>
                        <th scope="col">Image</th>
                        <th scope="col">Name</th>
                        <th scope="col">Qty</th>
                        <th scope="col">Price</th>
                        <th scope="col">Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($order_items as $o)
                    <tr>
                        <td style="width: 75px;" class="align-middle">
                            <img class="img-thumbnail" width="70px"
                                 src="{{asset("/images/menu_images/".$o->item_image)}}"
                                 alt="{{$o->name}}">
                        </td>
                        <td  class="text-left align-middle">{{$o->item_name}}</td>
                        <td style="width: 40px;" class="text-center align-middle">{{$o->qty}}</td>
                        <td style="width: 40px;" class="text-center align-middle">{{$o->price}}</td>
                        <td style="width: 75px;" class="text-right align-middle">{{$o->item_total}}</td>
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
