


<div class="row">
    <div class="col">
        @if (count($order_tables) <= 0)
            <div class="alert alert-light" role="alert">
                <h4>There are no tables to show.</h4>
            </div>
        @else
            @include("include.success_viewer")

                <table class="table table-sm table-striped table-hover">
                    <thead class="bg-primary text-light">
                    <tr>
                        <th scope="col">Image</th>
                        <th scope="col">Name</th>
                        <th scope="col">Chairs</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($order_tables as $o)
                    <tr>
                        <td style="width: 75px;" class="align-middle">
                            <img class="img-thumbnail" width="70px"
                                 src="{{asset("/images/table_images/".$o->table->image)}}"
                                 alt="{{$o->name}}">
                        </td>
                        <td  class="text-left align-middle">{{$o->table->name}}</td>
                        <td style="width: 40px;" class="text-center align-middle">{{$o->table->chairs}}</td>

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
