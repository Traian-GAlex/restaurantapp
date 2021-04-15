<div class="row">
    <div class="col">
        @if (count($tables) > 0)
            @foreach($tables as $table)
                <div class="card mb-3">
                    <div class="row no-gutter">
                        <div class="col-md-3 align-middle">
                            <img src="{{asset("/images/table_images/".$table->image)}}" alt="$table.name" class="img-fluid">
                        </div>
                        <div class="col-md-9">
                            <div class="card-body">
                                <h5 class="card-title"><strong>{{$table->name}}</strong></h5>
                                <p class="card-text"><strong>Places:</strong> {{$table->chairs}}</p>
                                <p class="card-text {{$table->available ? 'text-success':'text-danger'}}">{{$table->available ? 'Available':'Not svailable'}}</p>
                                <button
                                    class="newOrderBtn btn btn-primary float-right mb-3 {{$table->available ? '':'disabled'}}"
                                    {{$table->available ? '':'disabled'}}  data-id="{{$table->id}}">Add
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="alert alert-light text-center" role="alert">
                <h4>There are no tables yet. Eating while standing is annoying!</h4>
                <h6>Please add some!</h6>
            </div>
        @endif


    </div>
</div>
<script>
    $(".newOrderBtn").click(function () {
        // this button is on the table viewer modal
        $('#closeTablesListBtn').click();
        console.log("Added table " + $(this).data('id'));
    });
</script>
