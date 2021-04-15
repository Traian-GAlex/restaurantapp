@extends("management.index")

@section("management")
    <br>
    <i class="las la-chair la-lg"></i>
    <span>Table viewer</span>
    <hr>
    <div class="card">
        <img style="width: 18rem;"  src="{{asset("/images/table_images/". $table->image)}}"
             class="card-img-top img-thumbnail mx-auto mt-3" alt="$table->name">
        <div class="card-body">

            <div class="form-group">
                <label for="name">Table name</label>
                <label class="form-control" id="name" name="name">{{$table->name}}</label>
            </div>

            <div class="form-group">
                <label for="price">Chairs</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <i class="las la-chair la-lg pt-2 input-group-text"></i>
                    </div>
                    <label class="form-control text-right" id="chairs" name="chairs">{{$table->chairs}}</label>
                </div>
            </div>

            <div class="form-group">
                <label for="name">Available</label>
                <label class="form-control {{$table->available ? "text-success": "text-danger"}} " id="available" name="available">{{$table->available == 1 ? "Yes": "No"}}</label>
            </div>

            <div class="form-group">
                <label for="description" style="display:block;">Description</label>
                @include("include.trix_editor", [
                        "id" => "x",
                        "name" => "description",
                        "value" => $table->description,
                        "readonly" => true,
                    ])
            </div>

            <a href="/management/table/{{$table->id}}/edit" class="btn btn-primary float-right" type="submit">Edit</a>
        </div>
    </div>


@endsection
