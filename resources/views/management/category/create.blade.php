@extends("management.index")

@section("management")

        <i class="las la-align-justify la-lg"></i>
        <span>Create new category</span>
    <hr>
        @include("include.error_viewer")
        <form action="/management/category" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Category name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Category...">
            </div>
            <button class="btn btn-primary float-right" type="submit">Save</button>
        </form>
@endsection
