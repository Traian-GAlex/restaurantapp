@extends("management.index")

@section("management")

    <i class="las la-chair la-lg"></i>
    <span>Edit table</span>
    <hr>
    @include("include.error_viewer")
    <form action="/management/table/{{$table->id}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method("PUT")
        <div class="form-group">
            <img style="width: 18rem;"  src="{{asset("/images/table_images/". $table->image)}}"
                 class="img-thumbnail mx-auto mt-3" alt="$table->name">
        </div>
        <div class="form-group">
            <label for="name">Table name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Table..." value="{{$table->name}}">
        </div>

        <div class="form-group">
            <label for="chairs">Chairs</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <i class="las la-chair la-lg pt-2 input-group-text"></i>
                </div>
                <input type="number" step="1" min="0" class="form-control" id="chairs" name="chairs"
                       placeholder="Chairs..." value="{{$table->chairs}}">
            </div>
        </div>

        <div class="form-group">
            @include("include.checkbox", ["label" => "Available", "id" => "available", "name" => "available", "checked" => $table->available])
        </div>

        <div class="form-group">
            <label for="image">Image</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                </div>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="inputGroupFile01" name="image"
                           aria-describedby="inputGroupFileAddon01">
                    <label class="custom-file-label" for="inputGroupFile01">Choose file...</label>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="description" style="display:block;">Description</label>
            @include("include.trix_editor", [
                "id" => "x",
                "name" => "description",
                "value" => $table->description
            ])
        </div>



        <button class="btn btn-primary float-right" type="submit">Save</button>
    </form>
@endsection
