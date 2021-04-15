@extends("management.index")

@section("custom_head")

@endsection

@section("management")

    <i class="las la-user la-lg"></i>
    <span>Create new user</span>
    <hr>
    @include("include.error_viewer")
    @include("management.user.user_form", [
        "action" => "/management/user",
        "user" => $user,
        "user_roles" => null,
        "person" => $person,
        "roles" => $roles,
    ])
@endsection

@section("custom_script")

@endsection
