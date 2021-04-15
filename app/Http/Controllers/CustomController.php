<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CustomController extends Controller
{
    public function getItemsPerPage()
    {
        return (int) Session::get('itemsPerPage');
//        return (int) Session::get('itemsPerPage', 10);
    }

    public static function setItemsPerPage($numXPage){
        session(["itemsPerPage" => $numXPage]);
//        session([$paginatorValueName => $self->getDefaultValue($request)]);
    }

    private static function getDefaultValue(Request $request){
        if (null != $request->itemsPerPage){
            return (int) $request->itemsPerPage;
        }elseif (null != $request->query('q')){
            return (int) $request->query('q');
        }else{
            return 10;
        }
    }
}
