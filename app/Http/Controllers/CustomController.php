<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CustomController extends Controller
{
    public function getItemsPerPage()
    {
        return (int)Session::get('itemsPerPage');
//        return (int) Session::get('itemsPerPage', 10);
    }

    public static function setItemsPerPage($numXPage)
    {
        session(["itemsPerPage" => $numXPage]);
//        session([$paginatorValueName => $self->getDefaultValue($request)]);
    }

    private static function getDefaultValue(Request $request)
    {
        if (null != $request->itemsPerPage) {
            return (int)$request->itemsPerPage;
        } elseif (null != $request->query('q')) {
            return (int)$request->query('q');
        } else {
            return 10;
        }
    }

    public static function setFilterDates(Request $request)
    {
        $dates = new \stdClass();
        $dates->start_date = $request->start_date;
        $dates->start_time = $request->start_time;
        $dates->end_date = $request->end_date;
        $dates->end_time = $request->end_time;
        session(["filter_dates" => json_encode($dates)]);
        return $dates;
    }

    public static function getFilterDates(){
        $dates = json_decode(Session::get("filter_dates"));
        if (null == $dates){
            $crtDate = new \DateTime();
            $dates = new \stdClass();
            $dates->start_date = $crtDate->format('Y-m-d');
            $dates->start_time = '00:00';
            $dates->end_date = $crtDate->format('Y-m-d');
            $dates->end_time = '23:59';
            session(["filter_dates" => json_encode($dates)]);
        }
        return $dates;
    }
}
