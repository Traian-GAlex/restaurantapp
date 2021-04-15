<?php
if (!isset($form_method)) $form_method = "POST";
if (!isset($method)) $method = "POST";
function getChecked($user, $role_name = null)
{
    if (null == $role_name) return false;
    $role = $user->roles()->where("name", $role_name)->first();
    if (null == $role) return false;
    return true;
}

?>
<form action="{{$action}}" method="{{$form_method}}" enctype="multipart/form-data">
    @csrf
    @method($method)
    @if($person->image)
        <div class="form-group">
            <img style="width: 18rem;" src="{{asset("/images/user_images/". $person->image)}}"
                 class="img-thumbnail mx-auto mt-3" alt="$table->name">
        </div>
    @endif

    <div class="form-group">
        <label for="name">First name</label>
        <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First name..."
               value="{{$person->first_name}}">
    </div>

    <div class="form-group">
        <label for="name">Middle name</label>
        <input type="text" class="form-control" id="middle_name" name="middle_name" placeholder="Middle name..."
               value="{{$person->middle_name}}">
    </div>

    <div class="form-group">
        <label for="name">Last name</label>
        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last name..."
               value="{{$person->last_name}}">
    </div>

    <div class="form-group">
        <label for="date_of_birth">Date of birth</label>
        <input class="form-control" type="date" id="date_of_birth" name="date_of_birth"
               value="{{$person->date_of_birth}}">
    </div>


    <div class="form-group">
        <label for="name">Place of birth</label>
        <input type="text" class="form-control" id="place_of_birth" name="place_of_birth"
               placeholder="Place of birth..." value="{{$person->place_of_birth}}">
    </div>

    <div class="form-group">
        <label for="name">User name</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="User name..."
               value="{{$user->name}}">
    </div>

    <div class="form-group">
        <label for="email">E-mail</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="E-mail..."
               value="{{$user->email}}">
    </div>

    <div class="form-group">
        <label for="email_confirmation">E-mail confirmation</label>
        <input type="email" class="form-control" id="email_confirmation" name="email_confirmation"
               placeholder="E-mail confirmation..." value="{{$user->email}}">
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Password...">
    </div>

    <div class="form-group">
        <label for="password_confirmation">Password confirmation</label>
        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
               placeholder="Password confirmation...">
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

    <div class="card">
        <div class="card-body">
            <label><strong>Roles</strong></label>
            <hr>
            @foreach($roles as $role)
                <div class="form-group">
                    @include("include.checkbox", ["label" => $role->name, "id" => "r". $role->id, "name" => "r". $role->id, "checked" => getChecked($user, $role->name)])
                </div>
            @endforeach
        </div>
    </div>
    <br>
    <button class="btn btn-primary float-right" type="submit">Save</button>
</form>
