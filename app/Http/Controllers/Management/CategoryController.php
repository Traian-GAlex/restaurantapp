<?php

namespace App\Http\Controllers\Management;

use App\Data\Models\Category;
use App\Http\Controllers\CustomController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;


class CategoryController extends CustomController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (null == $request->query('q')){
            $categories = Category::orderBy('name')->paginate($this->getItemsPerPage());
        }else{
            $categories = Category::where('name', 'like', "%" . trim($request->query('q')). "%" )->orderBy('name')->paginate($this->getItemsPerPage());
        }
        return view('management.category.index')->with("categories", $categories);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('management.category.create');
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
            "name" => "required|unique:categories|max:255",
        ];
        $request->validate($rules);
        $category = new Category();
        $category->name = $request->name;
        $category->save();
        $request->session()->flash("status", $request->name . " was saved successfully.");
        return Redirect::to("/management/category");
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::all()->where("id", "=", $id)->first();
        return view('management.category.edit')->with("category", $category);
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
        $category = Category::all()->where("id", "=", $id)->first();
        if ($category->name !== $request->name){
            $rules = [
                "name" => "required|unique:categories|max:255",
            ];
            $request->validate($rules);
            $category->name = $request->name;
            $category->save();
        }
        $request->session()->flash("status", $request->name . " was saved successfully.");
        return Redirect::to("/management/category");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::all()->where("id", "=", $id)->first();
        request()->session()->flash("status", $category->name . " was deleted successfully.");
        Category::destroy($id);
        return redirect("/management/category");
    }
}
