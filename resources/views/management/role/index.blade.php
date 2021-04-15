@extends("management.index")

@section("management")
    @component("include.index_content_header")
        @slot('title')
            <i class="las la-user-tag la-lg"></i>
            <span>Role</span>
        @endslot

        @slot('add_button')
            <a href="/management/role/create" class="btn btn-success btn-sm float-right">
                <i class="las la-plus la-lg"></i>
                <span>Add Role</span>
            </a>
        @endslot
    @endcomponent

    <hr>

    @if(count($roles)<=0)
        <div class="alert alert-light" role="alert">
            <h4>There are no roles yet. Please add some...</h4>
        </div>
    @else

        @include("include.success_viewer")

        {{$roles->links()}}

        <table class="table table-sm table-striped table-hover">
            <thead class="bg-primary text-light">
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Name</th>
                <th scope="col">Prevent deletion</th>
                <th scope="col">View</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
            </tr>
            </thead>
            <tbody>
            @foreach($roles as $role)
                <tr>
                    <td style="width: 40px;" class="text-right align-middle">
                        {{$role->id}}
                    </td>
                    <td class="align-middle">
                        <a href="{{ "/management/role/" . $role->id . "/edit" }}">{{$role->name}}</a>
                    </td>

                    <td style="width: 75px; text-align: center" class="align-middle">
                        @if($role->prevent_deletion)
                            <span class="text-success">Yes</span>
                        @else
                            <span class="text-danger">No</span>
                        @endif
                    </td>
                    <td style="width: 32px;" class="align-middle">
                        <a class="btn btn-outline-success" href="/management/role/{{$role->id}}">
                            <i class="las la-search la-lg"></i>
                        </a>
                    </td>
                    <td style="width: 32px;" class="align-middle">
                        <a class="btn btn-outline-primary" href="/management/role/{{$role->id}}/edit">
                            <i class="las la-pencil-alt la-lg"></i>
                        </a>
                    </td>
                    <td style="width: 32px;" class="align-middle">
                        <form action="/management/role/{{$role->id}}" method="post">
                            @csrf
                            @method("DELETE")
                            <button type="submit" class="btn btn-outline-danger"
                                    onclick="return confirm('Are you sure?')">
                                <i class="las la-trash la-lg"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>

        </table>
        {{$roles->links()}}

    @endif

@endsection
