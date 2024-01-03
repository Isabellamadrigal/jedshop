<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class vehicleController extends Controller
{

   function getAllClientVehicle(){

    try{
        $client_id = $this->getClientSessionId();
        $vehicles = DB::table('vehicle')
        ->where('clientId', '=', $client_id)
        ->where('vehicleStatus', '=', 'visible')
        ->get();
        $data = array();

        foreach($vehicles as $vehicle){
            $actions = "
            <select class='vehicleActionBtn' data-id='$vehicle->id'>
                <option value='' selected disabled hidden>Select</option>
           
                <option value='Edit Vehicle'>Edit</option>
                <option value='Delete Vehicle'>Delete</option>
            </select>
        ";
            array_push(
                $data,
                array(
                    "actions"=>$actions,
                    "id"=>$vehicle->id,
                    "vehicleType" => $vehicle->vehicleType,
                    "make" => $vehicle->make,
                    "model" => $vehicle->model,
                    "variant" => $vehicle->variant,
                    "year" => $vehicle->year
                )
            );
        }

        return response()->json(
            array(
                "data"=>$data
            )
        );
    }catch(\Exception $e){
        $error = $e->getMessage();
        echo $error;
    }

   }

   function addVehicle(Request $request){

    try{
        $vehicleType = $request->input("vehicleType");
        $make = $request->input("make");
        $model = $request->input("model");
        $variant = $request->input("variant");
        $year = $request->input("year");
        $plateNo = $request->input("plateNo");
        $client_id = $this->getClientSessionId();
        $NotificationType = "Add Vehicle";
        $data = [
            'vehicleType' => $vehicleType,
            'make' => $make,
            'model' => $model,
            'variant' => $variant,
            'year' => $year ,
            'plateNo' => $plateNo ,
            'vehicleStatus'=>'visible',
            'clientId'=>$client_id
            // Add more columns and values as needed
        ];
    
        DB::table('vehicle')->insert($data);
     
        $NotificationMessage = "Successfuly to add vehicle: $make $model $variant $year";
        $NotificationResult = "success";

        return response()->json(
            array(
                "type" => $NotificationType,
                "description" => $NotificationMessage,
                "result" => $NotificationResult
            )
        );
        
    }catch(\Exception $e){

        $error = $e->getMessage();
        $NotificationType = "Edit Account";
        $NotificationMessage = "Failed to add vehicle: $make $model $variant $year. $error";
        $NotificationResult = "error";
        return response()->json(
            array(
                "type" => $NotificationType,
                "description" => $NotificationMessage,
                "result" => $NotificationResult
            )
        );
    }
       
   }

   function getVehicleInfo(Request $request){
    try{
        $id = $request->input('id');
        $vehicles = DB::table('vehicle')
        ->where('id', '=', $id)
        ->get();

        return response()->json($vehicles);
    }catch(\Exception $e){
        $error = $e->getMessage();
        echo $error;
    }
   }

   function editVehicle(Request $request){
    try{
        $id = $request->input('id');
        $vehicleType = $request->input("vehicleType");
        $make = $request->input("make");
        $model = $request->input("model");
        $variant = $request->input("variant");
        $year = $request->input("year");
        $plateNo = $request->input("plateNo");

        DB::table('vehicle')
        ->where('id', $id)
        ->update([
        'vehicleType'=>$vehicleType,
        'make' => $make,
        'model' => $model,
        'variant' =>$variant,
        'year' => $year ,
        'plateNo' => $plateNo]
        );

        $NotificationType = "Edit Vehicle";
        $NotificationMessage = "Successfuly to edit vehicle: $make $model $variant $year";
        $NotificationResult = "success";
        return response()->json(
            array(
                "type" => $NotificationType,
                "description" => $NotificationMessage,
                "result" => $NotificationResult
            )
        );

    
    }catch(\Exception $e){
        $error = $e->getMessage();
        $NotificationType = "Edit Vehicle";
        $NotificationMessage = "Failed to edit: $make $model $variant $year. $error";
        $NotificationResult = "error";
        return response()->json(
            array(
                "type" => $NotificationType,
                "description" => $NotificationMessage,
                "result" => $NotificationResult
            )
        );
    }
   
   }

   function changeVehicleStatus(Request $request){
    try{
        $id = $request->input('id');
        $vehicleStatus = $request->input('status');
        DB::table('vehicle')
        ->where('id', $id)
        ->update([
        'vehicleStatus'=>$vehicleStatus
        ]);

        $NotificationType = "Delete Vehicle";
        $NotificationMessage = "Successfuly to delete vehicle id: $id";
        $NotificationResult = "success";
        return response()->json(
            array(
                "type" => $NotificationType,
                "description" => $NotificationMessage,
                "result" => $NotificationResult
            )
        );
    }catch(\Exception $e){
        $error = $e->getMessage();
        $NotificationType = "Delete Vehicle";
        $NotificationMessage = "Failed to  delete vehicle id: $id";
        $NotificationResult = "error";
        return response()->json(
            array(
                "type" => $NotificationType,
                "description" => $NotificationMessage,
                "result" => $NotificationResult
            )
        );
    }
   }
   function getClientSessionId(){
    $sessionArr = session('pms_midterms');
    $sessionParsed = json_decode($sessionArr);
    return $sessionParsed[0]->id;
   }
}
