<?php

namespace App\Http\Controllers\Management;

use App\Data\Models\Table;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tables = Table::orderBy('name')->paginate(10);
        return view("management.table.index")->with("tables", $tables);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("management.table.create");
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
        $imageName = "noimage.png";
        if ($request->image) {
            $request->validate([
                "image" => "nullable|file|image|mimes:jpeg,png,jpg|max:5000"
            ]);
            $imageName = date('mdYHis') . uniqid() . "." . $request->image->extension();
            $request->image->move(public_path("images/table_images"), $imageName);
        }
//        dd($request->available);
        $table = new Table();
        $table->name = $request->name;
        $table->chairs = $request->chairs;
        $table->available = null == $request->available ? false : true;
        $table->description = $request->description;
        $table->image = $imageName;
        $table->save();

        $request->session()->flash("status", $request->name . " was saved successfully.");

        return redirect("/management/table");
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $table = Table::find($id);
        return view("management.table.view")->with("table", $table);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $table = Table::find($id);
        return view("management.table.edit", ["table" => $table]);
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
        $table = Table::find($id);
        if ($request->image) {
            $request->validate([
                "image" => "nullable|file|image|mimes:jpeg,png,jpg|max:5000"
            ]);

            $this->deleteImage($table->image);

            $imageName = date('mdYHis') . uniqid() . "." . $request->image->extension();
            $request->image->move(public_path("images/table_images"), $imageName);
            $table->image = $imageName;
        }
        $table->name = $request->name;
        $table->chairs = $request->chairs;
        $table->available = null == $request->available ? false : true;
        $table->description = $request->description;
        $table->save();

        return redirect("/management/table/" . $table->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $table = Table::find($id);

        $this->deleteImage($table->image);

        Table::destroy($id);
        return redirect("/management/table");
    }

    private function deleteImage($image = null){
        if (null == $image) return;
        try{
            if ((null != $image || "" != $image) && $image != "noimage.png") {
                unlink(public_path("images/table_images") . "/" . $image);
            }
        }
        catch (\Exception $e){
            // nothing to display
        }
    }
}
