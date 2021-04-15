@extends("management.index")

@section("management")

    <i class="las la-align-justify la-lg"></i>
    <span>Create new menu</span>
    <hr>
    @include("include.error_viewer")
    <form action="/management/menu" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Menu name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Menu...">
        </div>

        <div class="form-group">
            <label for="price">Price</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">$</span>
                </div>
                <input type="number" step=".01" min="0" class="form-control" id="price" name="price"
                       placeholder="Price...">
            </div>
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

        <div class="form-group">
            <label for="category">Category</label>
            <select name="category" id="category" class="form-control">
                <option value="-1">[Chose a category]</option>
                @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
        </div>



        <button class="btn btn-primary float-right" type="submit">Save</button>
    </form>
@endsection
