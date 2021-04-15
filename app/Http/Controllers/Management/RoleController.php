<?php

namespace App\Http\Controllers\Management;

use App\Data\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::orderBy('name')->paginate(10);
        return view('management.role.index')->with("roles", $roles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('management.role.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            "name" => "required|unique:menus|max:255",
        ];
        $request->validate($rules);
        $role = new Role();
        $role->name = $request->name;
        $role->prevent_deletion = null == $request->prevent_deletion ? false : true;
        $role->description = $request->description;
        $role->save();

        $request->session()->flash("status", $request->name . " was saved successfully.");

        return redirect("/management/role");
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::find($id);
        return view("management.role.view")->with("role", $role);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find($id);
//        dd($table->available);
        return view("management.role.edit", ["role" => $role]);
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
        $request->validate([
            "name" => "required|max:255",
        ]);

        $role = Role::find($id);

        $role->name = $request->name;
//        dd($request);
        $role->prevent_deletion = null == $request->prevent_deletion ? false : true;
        $role->description = $request->description;
        $role->save();

        return redirect("/management/role/" . $role->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::find($id);

        if ($role->prevent_deletion) {
            $validator = Validator::make(["id"], [], []);
            $validator->getMessageBag()->add("deletion", "The '$role->name' role cannot be deleted!");
            return redirect("/management/role/" . $id . "/edit")->withErrors($validator->errors());
        }

        Role::destroy($id);
        return redirect("/management/role");
    }
}
