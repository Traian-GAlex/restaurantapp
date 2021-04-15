@extends("management.index")

<?php
function getChecked($user, $role_name = null)
{
    if (null == $role_name) return false;
    $role = $user->roles()->where("name", $role_name)->first();
    if (null == $role) return false;
    return true;
}
?>
@section("management")
    <br>
    <i class="las la-user la-lg"></i>
    <span>User viewer</span>
    <hr>
    <div class="card">
        <img style="width: 18rem;"  src="{{asset("/images/user_images/". $person->image)}}"
             class="card-img-top img-thumbnail mx-auto mt-3" alt="$user->name">
        <div class="card-body">


            <div class="form-group">
                <label for="name">First name</label>
                <label type="text" class="form-control">{{$person->first_name}}</label>
            </div>

            <div class="form-group">
                <label for="name">Middle name</label>
                <label type="text" class="form-control">{{$person->middle_name}}</label>
            </div>

            <div class="form-group">
                <label for="name">Last name</label>
                <label type="text" class="form-control">{{$person->last_name}}</label>
            </div>

            <div class="form-group">
                <label for="date_of_birth">Date of birth</label>
                <input readonly class="form-control" type="date" id="date_of_birth" name="date_of_birth"
                       value="{{$person->date_of_birth}}">
            </div>


            <div class="form-group">
                <label for="name">Place of birth</label>
                <label type="text" class="form-control">{{$person->place_of_birth}}</label>
            </div>

            <div class="form-group">
                <label for="name">User name</label>
                <label type="text" class="form-control">{{$user->name}}</label>
            </div>

            <div class="form-group">
                <label for="email">E-mail</label>
                <label type="email" class="form-control">{{$user->email}}</label>
            </div>
            <br>
            <label><strong>Roles</strong></label>
            <hr>
            @foreach($roles as $role)
                <div class="form-group">
                    @include("include.checkbox", ["readonly" => true,"label" => $role->name, "id" => "r". $role->id, "name" => "r". $role->id, "checked" => getChecked($user, $role->name)])
                </div>
            @endforeach

            <a href="/management/user/{{$user->id}}/edit" class="btn btn-primary float-right" type="submit">Edit</a>
        </div>
    </div>
@endsection
