@extends("management.index")

@section("management")

        <i class="las la-user-tag la-lg"></i>
        <span>Edit role</span>
    <hr>
        @include("include.error_viewer")
        <form action="/management/role/{{$role->id}}" method="POST">
            @csrf
            @method("PUT")
            <div class="form-group">
                <label for="name">Role name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Role..." value="{{$role->name}}">
            </div>
            <div class="form-group">
                @include("include.checkbox", ["label" => "Prevent deletion", "id" => "prevent_deletion", "name" => "prevent_deletion", "checked" => $role->prevent_deletion])
            </div>
            <div class="form-group">
                <label for="description" style="display:block;">Description</label>
                @include("include.trix_editor", [
                        "id" => "x",
                        "name" => "description",
                        "value" => $role->description
                    ])
            </div>

            <button class="btn btn-primary float-right" type="submit">Save</button>
        </form>
@endsection
