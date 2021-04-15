@extends("management.index")

@section("management")
    <br>
    <i class="las la-user-tag la-lg"></i>
    <span>Role viewer</span>
    <hr>
    <div class="card">
        <div class="card-body">
            <div class="form-group">
                <label for="name">Role name</label>
                <label class="form-control" id="name" name="name">{{$role->name}}</label>
            </div>

            <div class="form-group">
                <label for="name">Prevent deletion</label>
                <label class="form-control {{$role->prevent_deletion ? "text-success": "text-danger"}} " id="prevent_deletion" name="prevent_deletion">{{$role->prevent_deletion == 1 ? "Yes": "No"}}</label>
            </div>

            <div class="form-group">
                <label for="description" style="display:block;">Description</label>
                @include("include.trix_editor", [
                        "id" => "x",
                        "name" => "description",
                        "value" => $role->description,
                        "readonly" => true,
                    ])
            </div>

            <a href="/management/role/{{$role->id}}/edit" class="btn btn-primary float-right" type="submit">Edit</a>
        </div>
    </div>


@endsection
