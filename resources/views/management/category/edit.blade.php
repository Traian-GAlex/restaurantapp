@extends("management.index")

@section("management")

        <i class="las la-align-justify la-lg"></i>
        <span>Edit category</span>
    <hr>
        @include("include.error_viewer")
        <form action="/management/category/{{$category->id}}" method="POST">
            @csrf
            @method("PUT")
            <div class="form-group">
                <label for="name">Category name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Category..." value="{{$category->name}}">
            </div>
            <button class="btn btn-primary float-right" type="submit">Save</button>
        </form>
@endsection
