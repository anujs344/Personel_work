<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Register;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function checkCompanyName(Request $req)
    {
        $alldata = Register::where('CompanyName',$req->input('CompanyName'))->get()->first();
        if($alldata)
        {
            return view('report')->with('Register',1);
        }
        else{
            return view('report')->with('Register',0);
        }
    }
    public function addfeedback(Request $req)
    {
        $data = $req->input();
        $Attachments = $data['CName'].".".$req->file('Attachment')->getClientOriginalExtension();
        $req->file('Attachment')->storeAs('public/Feedbacks/'.$data['CName'], $Attachments);

        DB::table('Feedbacks')->insert([
                        'Concern' => $data['Concern'],
                        'Happen' => $data['Happen'],
                        'Cname' => $data['Cname'],
                        'Attachment' => $data['Attachment'],
                        'Details' => $data['Details']
        ]);
    }
}
