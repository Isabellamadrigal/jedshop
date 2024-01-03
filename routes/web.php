<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\accountController;
use App\Http\Controllers\serviceController;
use App\Http\Controllers\vehicleController;
use App\Http\Controllers\logsAndHistoryController;
use App\Http\Controllers\settingsController;
use App\Http\Controllers\adminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('login');
});




Route::post('/loginAccount',[accountController::class, 'login'] );

Route::get('/clientDashboard',function(){
    $sessionData = session('pms_midterms');
    if($sessionData!=null){
        $sessionArr = session('pms_midterms');
        $sessionParsed = json_decode($sessionArr);
        if($sessionParsed[0]->role=="client"){
            return view('/client/index');
        }else{
            Session::flush();
            return redirect('/');
        } 
    }else{
        return redirect('/');
    }
});

Route::get('/adminDashboard',function(){
    $sessionData = session('pms_midterms');
    if($sessionData!=null){
        $sessionArr = session('pms_midterms');
        $sessionParsed = json_decode($sessionArr);
        if($sessionParsed[0]->role=="admin"){
            return view('/admin/index');
        }else{
            Session::flush();
            return redirect('/');
        } 
    }else{
        return redirect('/');
    }
});

Route::get('/logout',function(){
    Session::flush();
    return redirect('/');
});

Route::get('/clientRegistration',function(){
    return view('/client/registration');
});

Route::get('/manageVehicles',function(){
    return view('/client/vehicle');
});

Route::get('/appointment',function(){
    return view('/client/appointment');
});

Route::get('/manageAppointments',function(){
    return view('/admin/appointment');
});

Route::get('/onService',function(){
    return view('/admin/service');
});

Route::get('/repairLogs',function(){
    return view('/admin/repairedLogs');
});


Route::get('/repairHistory',function(){
    return view('/client/repairedLogs');
});

Route::get('/manageServices-Parts',function(){
    return view('/admin/settings');
});

Route::post('/clientRegistration',[accountController::class, 'clientRegistration']);

Route::get('/getServicesList',[serviceController::class, 'getServicesList']);

Route::get('/getAllClientVehicle',[vehicleController::class, 'getAllClientVehicle']);

Route::post('/addVehicle',[vehicleController::class, 'addVehicle'] );

Route::get('/getVehicleInfo',[vehicleController::class, 'getVehicleInfo']);

Route::post('/editVehicle',[vehicleController::class, 'editVehicle'] );

Route::get('/changeVehicleStatus',[vehicleController::class, 'changeVehicleStatus']);



Route::post('/requestAppointment',[serviceController::class, 'requestAppointment']);

Route::get('/getWaitingAppoinments',[serviceController::class, 'getWaitingAppoinments']);

Route::get('/changeAppointmentStatus',[serviceController::class, 'changeAppointmentStatusA']);

Route::post('/changeAppointmentStatus',[serviceController::class, 'changeAppointmentStatusB']);

Route::get('/getPartsList',[serviceController::class, 'getPartsList']);
Route::get('/getServiceInformation',[serviceController::class, 'getServiceInformation']);
Route::get('/getPartsInformation',[serviceController::class, 'getPartsInformation']);
Route::get('/getApprovedAppointment',[serviceController::class, 'getApprovedAppointment'])->name('data.get');

Route::get('/getApprovedAppointmentInfo',[serviceController::class, 'getApprovedAppointmentInfo']);

Route::post('/setServiceSubmit',[serviceController::class, 'setServiceSubmit']);

Route::get('/getOnServiceList',[serviceController::class, 'getOnServiceList']);
Route::get('/changeOnServiceStatus',[serviceController::class, 'changeOnServiceStatus']);
Route::get('/getOnServiceInfo',[serviceController::class, 'getOnServiceInfo']);

Route::get('/getOnServiceLogs',[logsAndHistoryController::class, 'getServicesLogs']);
Route::get('/getParts',[settingsController::class, 'getParts']);
Route::get('/getServices',[settingsController::class, 'getServices']);

Route::get('/changeServicesStatus',[settingsController::class, 'changeServicesStatus']);
Route::get('/changePartsStatus',[settingsController::class, 'changePartsStatus']);
// function sessionCheker(){
Route::post('/editServiceInfo',[settingsController::class, 'editServiceInfo']);
Route::post('/editPartInfo',[settingsController::class, 'editPartInfo']);  
//     return "";
// }
Route::post('/addServices',[settingsController::class, 'addServices']);  
Route::post('/addParts',[settingsController::class, 'addParts']);  
Route::get('/getSalesDWMY',[adminController::class, 'getSalesDWMY']);
