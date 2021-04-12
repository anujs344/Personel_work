<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\planController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('Frontpage');
});
Route::view('Register', 'Register');
Route::post('Register',[RegisterController::class,'insert']);

// Route::view('/login', 'Login');
Route::get('/login', function(){
    if(session()->has('User_Details'))
    {
        return redirect('/Profile');
    }
    return view('Login');
});
Route::post('/login',[LoginController::class,'check']);

// Route::view('/Profile', 'Profile');
Route::get('/Profile',function()
{
    if(session()->has('User_Details'))
    {
        return view('Profile');
    }
    else
    {
       return redirect('/login');
    }
});
Route::get('/Profile',[ProfileController::class,'checkActivation']);

// Route::view('/TakePlan', 'TakePlan');
Route::get('/TakePlan',function()
{
    if(session()->has('User_Details'))
    {
        return view('TakePlan');
    }
    else
    {
       return redirect('/login');
    }
});
// Route::view('plan2', 'plan2');
// Route::get('plan/{value}', function ($value) {
//     return view('value')->with('plan_option',$value);
// });
// Route::get('plan', [planController::class,'addplan']);
Route::get('plan',function()
{
    if(session()->has('User_Details'))
    {
        return Route::get('plan', [planController::class,'addplan']);
    }
    else
    {
       return redirect('/login');
    }
});

// Route::view('aciveplan', 'activeplan');
Route::get('/activeplan',function()
{
    if(session()->has('User_Details'))
    {
        return view('activeplan');
    }
    else
    {
       return redirect('/login');
    }
});

// Route::view('report','report');
// Route::get('report',function()
// {
//     if(session()->has('User_Details'))
//     {
//         Route::get('report', [ReportController::class,'checkCompanyName']);
//     else
//     {
//        return redirect('/login');
//     }
// });
Route::get('report', [ReportController::class,'checkCompanyName']);
Route::get('report', [ReportController::class,'addfeedback']);

Route::view('Linkgenerater','Linkgenerater');
Route::get('Linkgenerater',function()
{
    if(session()->has('User_Details'))
    {
        return view('Linkgenerater');
    }
    else
    {
       return redirect('/login');
    }
});
Route::get('logout',function(){
    if(session()->has('User_Details'))
    {
        session()->pull('User_Details');
    }
    return redirect('/login');
});
Route::view('front', 'Frontpage');