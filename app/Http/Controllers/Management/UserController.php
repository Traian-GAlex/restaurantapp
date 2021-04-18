<?php

namespace App\Http\Controllers\Management;

use App\Data\Models\Role;
use App\Data\Models\User;
use App\Data\Models\Person as Prs;
use App\Http\Controllers\CustomController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserController extends CustomController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (null == $request->query('q')){
            $users = User::orderBy('name')->paginate($this->getItemsPerPage());
        }else{
            $users = User::where('name', 'like', "%" . trim($request->query('q')). "%" )->orderBy('name')->paginate($this->getItemsPerPage());
        }
        return view("management.user.index")->with("users", $users);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $user = new User();
        $person = new Prs();
        $roles = Role::orderBy("name")->get();

        return view("management.user.create")
            ->with("user", $user)
            ->with("roles", $roles)
            ->with("person", $person);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // user_name
        // email
        // email_confirmation
        // password
        // password_confirmation

        $rules = [
            "name" => ['required', 'string', 'min:3', 'max:255', 'unique:users'],
            "email" => ['required', 'string', 'email', 'max:255', 'unique:users', "same:email_confirmation"],
            "email_confirmation" => ["required", "string", "email"],
            "password" => ['required', 'string', 'min:8', 'confirmed', 'same:password_confirmation'],
            "password_confirmation" => ['required', 'string', 'min:8'],
        ];

        $request->validate($rules);

        // first_name
        // middle_name
        // last_name
        // date_of_birth
        // place_of_birth

        // image
        $imageName = "noimage.png";
        if ($request->image) {
            $request->validate([
                "image" => "nullable|file|image|mimes:jpeg,png,jpg|max:5000"
            ]);
            $imageName = date('mdYHis') . uniqid() . "." . $request->image->extension();
            $request->image->move(public_path("images/user_images"), $imageName);
        }
        $user = new User();
        $user->uuid = Str::uuid();
        $user->name = $request->name;
        $user->email = $request->email;

        $user->password = $request->password;

        $user->save();

        $person = new Prs();
        $person->user_id = $user->id;
        $person->image = $imageName;
        $person->first_name = $request->first_name;
        $person->middle_name = $request->middle_name;
        $person->last_name = $request->last_name;
        $person->date_of_birth = $request->date_of_birth;
        $person->place_of_birth = $request->place_of_birth;
        $person->save();

        $this->store_user_roles($request, $user);

        $request->session()->flash("status", "The " . $request->name . " was saved successfully.");

        return redirect("/management/user");
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $person = $user->person;
        $user_roles = $user->roles;
        $roles = Role::orderBy("name")->get();

        return view("management.user.view")
            ->with("user", $user)
            ->with("user_roles", $user_roles)
            ->with("roles", $roles)
            ->with("person", $person);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $person = $user->person;
        $user_roles = $user->roles;
        $roles = Role::orderBy("name")->get();

        return view("management.user.edit")
            ->with("user", $user)
            ->with("user_roles", $user_roles)
            ->with("roles", $roles)
            ->with("person", $person);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $rules = [
            "name" => ['required', 'string', 'min:3', 'max:255'],
            "email" => ['required', 'string', 'email', 'max:255', "same:email_confirmation"],
            "email_confirmation" => ["required", "string", "email"],
        ];

//        $request->validate($rules);
        $validator = Validator::make($request->all(), $rules);

        $validator->after(function ($validator) use ($request, $id) {
            $user = User::all()->firstWhere("name", $request->name);
            if (null != $user && $user->id != $id) {
                $validator->errors()->add('email', "Name '$request->name' already taken");
            }

            $user = User::all()->firstWhere("email", $request->email);
            if (null != $user && $user->id != $id) {
                $validator->errors()->add('email', "Name '$request->email' already taken");
            }
        });

        $validator->validate();

        if (isset($request->password) || isset($request->password_confirmation)) {
            $rules = [
                "password" => ['required', 'string', 'min:8', 'confirmed', 'same:password_confirmation'],
                "password_confirmation" => ['required', 'string', 'min:8'],
            ];

            $request->validate($rules);
            $user->password = $request->password;
        }

//        $imageName = "noimage.png";
        $person = $user->person;
        if ($request->image) {
            $request->validate([
                "image" => "nullable|file|image|mimes:jpeg,png,jpg|max:5000"
            ]);
            $imageName = date('mdYHis') . uniqid() . "." . $request->image->extension();
            $request->image->move(public_path("images/user_images"), $imageName);
            $this->deleteImage($user->person->image);
            $person->image = $imageName;
        }


        $user->name = $request->name;
        $user->email = $request->email;


        $user->save();


        $person->first_name = $request->first_name;
        $person->middle_name = $request->middle_name;
        $person->last_name = $request->last_name;
        $person->date_of_birth = $request->date_of_birth;
        $person->place_of_birth = $request->place_of_birth;
        $person->save();

        $this->store_user_roles($request, $user);

        $request->session()->flash("status", "The " . $request->name . " was saved successfully.");

        return redirect("/management/user");
    }

    private function store_user_roles(Request $request, User $user)
    {
        $roles = Role::all();
        $roles2attach = [];
        $roles2detach = [];
        foreach ($roles as $role) {

            if ($request->has("r" . $role->id)) {
                $roles2attach[] = $role;
            } else {
                $roles2detach[] = $role;
            }
        }

        foreach ($roles2detach as $r) {
            $user->roles()->detach($r->id);
        }

        foreach ($roles2attach as $r) {
            if (!$user->isInRole($r->name)) $user->roles()->attach($r->id);
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $this->deleteImage($user->person->image);
        User::destroy($id);
        return redirect("/management/user");
    }

    private function deleteImage($image = null)
    {
        if (null == $image) return;
        try {
            if ((null != $image || "" != $image) && $image != "noimage.png") {
                unlink(public_path("images/user_images") . "/" . $image);
            }
        } catch (\Exception $e) {
            // nothing to display
        }
    }
}
