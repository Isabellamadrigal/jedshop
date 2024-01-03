<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class logsAndHistoryController extends Controller
{
    function userSession(){
        $sessionArr = session('pms_midterms');
        $sessionParsed = json_decode($sessionArr);
        return $sessionParsed[0];
    }

    function getPartsAvail($id){
        $partsavail = DB::table('partsavail')
        ->join('parts','parts.id','=','partsavail.partsId')
        ->where('partsavail.onServiceId','=',$id)
        ->get();
        
        return $partsavail;
    }
    function getServiceAvail($id){
        $serviceavail = DB::table('serviceavail')
        ->join('services','services.id','=','serviceavail.serviceId')
        ->where('serviceavail.onServiceId','=',$id)
        ->get();
        return $serviceavail;
    }
    function getServicesLogs(Request $request){
        try{
          
            $userId = $this->userSession();

       
            if($userId->role=="admin" ){
                $onService = DB::table('onservice')
                ->select(
                'onservice.id',
                'onservice.dateStart',
                'onservice.dateEnded',
                'onservice.serviceStatus',
                'onservice.paymentStatus',
                'onservice.totalPrice',
                'vehicle.year',
                'client.id as clientId',
                'vehicle.id as vehicleId',
                'client.name',
                'client.contactNo'
                ,'vehicle.make'
                ,'vehicle.model'
                ,'vehicle.variant')
                ->join('client','onservice.clientId','=','client.id')
                ->join('vehicle','vehicle.id','=','onservice.vehicleId') // Replace 'your_table' with your actual table name
                
                ->where('onservice.adminId', '=',$userId->id)
                ->where('onservice.paymentStatus', '=', 'paid')
                ->where('onservice.serviceStatus', '=', 'finished')
                ->get();
            }
            else if($userId->role=="client" ){
                $onService = DB::table('onservice')
                ->select(
                'onservice.id',
                'onservice.dateStart',
                'onservice.dateEnded',
                'onservice.serviceStatus',
                'onservice.paymentStatus',
                'onservice.totalPrice',
                'vehicle.year',
                'client.id as clientId',
                'vehicle.id as vehicleId',
                'client.name',
                'client.contactNo'
                ,'vehicle.make'
                ,'vehicle.model'
                ,'vehicle.variant')
                ->join('client','onservice.clientId','=','client.id')
                ->join('vehicle','vehicle.id','=','onservice.vehicleId') // Replace 'your_table' with your actual table name
                
                ->where('onservice.clientId', '=',$userId->id)
                ->where('onservice.paymentStatus', '=', 'paid')
                ->where('onservice.serviceStatus', '=', 'finished')
                ->get();
            }
           
           
            $data = array();
            
            $parts = array();
            $partsSTR="";
            $servicesSTR="";
            $pesoSign = "\u{20B1}";
            foreach($onService as $onServices){
                $actions="";
                $id= $onServices->id;
               

              
                $partsAvail = $this->getPartsAvail($onServices->id);
                $serviceAvail =$this->getServiceAvail($onServices->id);
                if($partsAvail!=""){
                    foreach($partsAvail as $parts){
                        $partsSTR.= "<i class='fa-solid fa-circle-plus'></i> ".$parts->itemDesc." <br> ".$pesoSign."".$parts->price."<br><br>";
                    }
                }

                if($serviceAvail!=""){
                    foreach($serviceAvail as $services){
                        $servicesSTR.= "<i class='fa-solid fa-circle-plus'></i> ".$services->serviceDesc." <br> ".$pesoSign."".$services->price."<br><br>";
                    }
                }
           
                array_push(
                    $data,
                    array(
                        'actions'=>$actions,
                        'name'=>$onServices->name,
                        'vehicle'=>$onServices->make." ".$onServices->model." ".$onServices->variant,
                        'servicesAvail'=>$servicesSTR,
                        'partsAvail'=>$partsSTR,
                        'dateStart'=>$onServices->dateStart,
                        'dateEnded'=>$onServices->dateEnded,
                        'totalPrice'=>$onServices->totalPrice,
                        'serviceStatus'=>$onServices->serviceStatus,
                        'paymentStatus'=>$onServices->paymentStatus,
                    )
                );
                $partsSTR="";
                $servicesSTR="";
            }

            return response()->json(array(
                "data" => $data,
            ));

        }catch(\Exception $e){
            echo $e->getMessage();
        }
        


    }
}
