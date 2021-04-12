<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Register;

class ProfileController extends Controller
{
    public function checkActivation(Request $req)
    {
        $id = session('User_Details')['Id'];
        $alldata = Register::where('Id',$id)->get()->first();
        // return $alldata->planbuy;
        if($alldata->planbuy)
        {
            $req->session()->put('Buyied',$alldata->planbuy);
            // return view('profile');
            return view('/Profile')->with('Buyied',1);
        }
        else{
            $req->session()->put('NotBuyied',$alldata->planbuy);
            return view('/Profile')->with('Buyied',0);
        }
     }
}
