<?php

namespace App\Http\Controllers\Management;

use App\Data\Models\Category;
use App\Data\Models\Menu;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CustomController;
use Illuminate\Http\Request;

class MenuController extends CustomController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (null == $request->query('q')) {
            $menus = Menu::orderBy('name')->paginate($this->getItemsPerPage());
        } else {
            $menus = Menu::where('name', 'like', "%" . trim($request->query('q')) . "%")->orderBy('name')->paginate($this->getItemsPerPage());
        }
        return view("management.menu.index")->with("menus", $menus);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy("name")->get();
        return view("management.menu.create")->with("categories", $categories);
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
            "price" => "required|numeric",
//            "category" => "required|numeric",
        ];
        $request->validate($rules);
        $imageName = "noimage.png";
        if ($request->image) {
            $request->validate([
                "image" => "nullable|file|image|mimes:jpeg,png,jpg|max:5000"
            ]);
            $imageName = date('mdYHis') . uniqid() . "." . $request->image->extension();
            $request->image->move(public_path("images/menu_images"), $imageName);
        }
        $menu = new Menu();
        $menu->name = $request->name;
        $menu->price = $request->price;
        $menu->description = $request->description;
        $menu->category_id = $request->category == -1 ? null : $request->category;
        $menu->image = $imageName;
        $menu->save();

        $request->session()->flash("status", $request->name . " was saved successfully.");

        return redirect("/management/menu");

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $menu = Menu::find($id);
        return view("management.menu.view")->with("menu", $menu);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $menu = Menu::find($id);
        $categories = Category::orderBy("name")->get();
//        return view ("management.menu.edit")->with("menu", $menu);
        return view("management.menu.edit", ["menu" => $menu, "categories" => $categories]);
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
            "price" => "required|numeric"
        ]);
        $menu = Menu::find($id);
        if ($request->image) {
            $request->validate([
                "image" => "nullable|file|image|mimes:jpeg,png,jpg|max:5000"
            ]);

            $this->deleteImage($menu->image);

            $imageName = date('mdYHis') . uniqid() . "." . $request->image->extension();
            $request->image->move(public_path("images/menu_images"), $imageName);
            $menu->image = $imageName;
        }
        $menu->name = $request->name;
        $menu->price = $request->price;
        $menu->description = $request->description;
        $menu->category_id = $request->category == -1 ? null : $request->category;
        $menu->save();

        return redirect("/management/menu/" . $menu->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $menu = Menu::find($id);

        $this->deleteImage($menu->image);

        Menu::destroy($id);

        return redirect("/management/menu");
    }

    private function deleteImage($image = null)
    {
        if (null == $image) return;
        try {
            if ((null != $image || "" != $image) && $image != "noimage.png") {
                unlink(public_path("images/menu_images") . "/" . $image);
            }
        } catch (\Exception $e) {
            // nothing to display
        }
    }
}
