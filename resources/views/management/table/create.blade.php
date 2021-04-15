@extends("management.index")

@section("management")

    <i class="las la-chair la-lg"></i>
    <span>Create new table</span>
    <hr>
    @include("include.error_viewer")
    <form action="/management/table" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Table name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Table...">
        </div>

        <div class="form-group">
            <label for="chairs">Chairs</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <i class="las la-chair la-lg pt-2 input-group-text"></i>
                </div>
                <input type="number" step="1" min="0" class="form-control" id="chairs" name="chairs"
                       placeholder="Chairs...">
            </div>
        </div>
        <div class="form-group">
            @include("include.checkbox", ["label" => "Available", "id" => "available", "name" => "available", "checked" => false])
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
                    "value" => ""
                ])
        </div>

        <button class="btn btn-primary float-right" type="submit">Save</button>
    </form>
@endsection
