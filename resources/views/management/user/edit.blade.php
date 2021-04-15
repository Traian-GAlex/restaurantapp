@extends("management.index")

@section("management")

    <i class="las la-align-justify la-lg"></i>
    <span>Edit user</span>
    <hr>
    @include("include.error_viewer")
    @include("management.user.user_form", [
    "action" => "/management/user/" . $user->id,
    "method" => "PUT",
    "user" => $user,
    "user_roles" => null,
    "person" => $person,
    "roles" => $roles,
])
@endsection
