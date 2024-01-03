<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
class serviceController extends Controller
{ 
    function userSession(){
    $sessionArr = session('pms_midterms');
    $sessionParsed = json_decode($sessionArr);
    return $sessionParsed[0];
   }
    function getServicesList(){
        $services = DB::table('services')
        ->where('visible','=','visible')
        ->get();
        return response()->json($services);
    }

    function getPartsList(){
        $parts = DB::table('parts')
        ->where('visible','=','visible')
        ->get();
        return response()->json($parts);
    }
    function getServiceInformation(Request $request){
        $id = $request->input('id');
        $parts = DB::table('services')
        ->where('id', $id)
        ->get();
        return response()->json($parts);
    }
    function getPartsInformation(Request $request){
        $id = $request->input('id');
        $services = DB::table('parts')
        ->where('id', $id)
        ->get();
        return response()->json($services);

    }
    function getApprovedAppointment(Request $request)
    {
        $perPage = 3; // Items per page
        $currentPage = $request->input('page', 1);
        $searchQuery = $request->input('query');
        $total = DB::table('appointment')
        ->where('requestStatus','=','approve')
        ->count(); // Replace 'your_table' with your actual table name
        
        $query = DB::table('appointment')
        ->select('appointment.id','client.name','client.contactNo','appointment.vehicleProblem','vehicle.make','vehicle.model','vehicle.variant')
        ->join('client','appointment.clientId','=','client.id')
        ->join('vehicle','vehicle.id','=','appointment.vehicleId'); // Replace 'your_table' with your actual table name

        // Apply search filter if a query is provided
        if ($searchQuery) {
            $query->where('client.name', 'LIKE', '%' . $searchQuery . '%');
            // Replace 'column_name' with the column you want to search
        }

    

        $total = $query->count();
        $data = $query->skip(($currentPage - 1) * $perPage)
            ->take($perPage)
            ->get();

        $lastPage = ceil($total / $perPage);

        return response()->json([
            'data' => $data,
            'current_page' => $currentPage,
            'last_page' => $lastPage,
            'prev_page_url' => $currentPage > 1 ? route('data.get', ['page' => $currentPage - 1]) : null,
            'next_page_url' => $currentPage < $lastPage ? route('data.get', ['page' => $currentPage + 1]) : null,
        ]);
    }

    function getWaitingAppointmentClient($id){
        $appointment = DB::table('appointment')
        ->select('appointment.id','appointment.remarks', 'vehicle.make','vehicle.model','vehicle.variant','appointment.vehicleProblem','appointment.requestStatus','appointment.requestDate')
        ->join('vehicle','vehicle.id','=','appointment.vehicleId')
        ->where('appointment.clientId','=', $id)
        ->where('appointment.requestStatus','!=','canceled')
        ->get();
        return $appointment;
    }
    function getWaitingAppointmentAdmin(){
        $appointment = DB::table('appointment')
        ->select('appointment.id', 'appointment.remarks', 'vehicle.make','vehicle.model','vehicle.variant','appointment.vehicleProblem','appointment.requestStatus','appointment.requestDate','client.name')
        ->join('vehicle','vehicle.id','=','appointment.vehicleId')
        ->join('client','client.id','=','appointment.clientId')
        ->where('appointment.requestStatus','!=','canceled')
        ->where('appointment.requestStatus','!=','reject')
        ->where('appointment.requestStatus','!=','approve')
        ->get();
        return $appointment;
    }

    function getWaitingAppoinments(){
        try{
            //$id=2;
            $servicesSTR="";
            $name="";
            $userSession=$this->userSession();
            $appointArr = array();
            if($userSession->role == "client"){
                $appointment=$this->getWaitingAppointmentClient($userSession->id);
             
            }else if($userSession->role == "admin"){
                $appointment=$this->getWaitingAppointmentAdmin();
            }
            foreach($appointment as $appointments){

                if($userSession->role == "client"){
                    if($appointments->requestStatus=="waiting for approval" || $appointments->requestStatus=="rejected"){
                        $actions ="<select class=' appointmentActionBtn'  data-id='$appointments->id'>
                        <option value='' selected disabled>Select Option</option>
                        <option value='Del Appointment'>Cancel Appointment</option>
                        </select>";
                    }else if($appointments->requestStatus=="approve"){
                        $actions="Action Suspended! Please Read The Remarks";
                    }
             
                }else if($userSession->role == "admin"){
                    $actions ="<select class=' appointmentActionBtn'  data-id='$appointments->id'>
                    <option value='' selected disabled>Select Option</option>
                    <option value='Approve Appointment'>Approve Appointment</option>
                    <option value='Reject Appointment'>Reject Appointment</option>
                    </select>";
                    $name=$appointments->name;
                }
                    $serviceAvail = $this->servicesAvail($appointments->id);
                    foreach($serviceAvail as $service){
                        $servicesSTR.= "<i class='fa-solid fa-circle-plus'></i> ".$service->serviceDesc."<br><br>";
                    }
                array_push(
                    $appointArr,
                    array(
                        'actions'=>$actions,
                        'name'=>$name,
                        'vehicle'=>$appointments->make." ".$appointments->model." ".$appointments->variant,
                        'vehicleProblem'=>$appointments->vehicleProblem,
                        'services'=>$servicesSTR,
                        'remarks'=>$appointments->remarks,
                        'requestDate'=>$appointments->requestDate,
                        'requestStatus'=>$appointments->requestStatus
                    )
                );
                $servicesSTR="";
            }
            return response()->json(
                array(
                    "data" => $appointArr,
                )
            );

        }catch(\Exception $e){
            echo $e->getMessage();
        }
    }

    function servicesAvail($appointId){
        $appointment = DB::table('servicerequest')
        ->join('services','services.id','=','servicerequest.serviceId')
        ->where('servicerequest.appointId','=',$appointId)
        ->get();
        
        return $appointment;
    }

    function changeAppointmentStatusA(Request $request){
        try{
            $id = $request->input('id');
            $status = $request->input('status');
            DB::table('appointment')
            ->where('id', $id)
            ->update([
            'requestStatus'=>$status
            ]);
    
            $NotificationType = "$status  Appointment";
            $NotificationMessage = "Successfuly $status  the appointment id: $id";
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
            $NotificationMessage = "Failed to  $status  the appointment id: $id";
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

    function changeAppointmentStatusB(Request $request){
        try{
            $id = $request->input('id');
            $status = $request->input('status');
    
            $remarks = $request->input('remarks');
            DB::table('appointment')
            ->where('id', $id)
            ->update([
            'requestStatus'=>$status,
            'remarks'=>$remarks
            ]);
    
            $NotificationType = "$status Appointment";
            $NotificationMessage = "Successfuly $status the appointment id: $id";
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
            $NotificationType = "$status Appointment";
            $NotificationMessage = "Failed to $status the appointment id: $id";
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

    function requestAppointment(Request $request){
        try{
            $userSession=$this->userSession();
            $vehicleId = $request->input('vehicleId');
            $vehicleProblem = $request->input('issue');
            $requestDate = $request->input('requestDate');
            $serviceId = $request->input('serviceId');
            $appointmentStatus = 'waiting for approval';
            //id	clientId	vehicleId	vehicleProblem	requestDate	requestStatus	dateAdded	

            $dataAppointment = [
                'clientId' => $userSession->id,
                'vehicleId' => $vehicleId,
                'vehicleProblem' => $vehicleProblem,
                'requestDate' => $requestDate,
                'requestStatus' => $appointmentStatus,
                'remarks'=>''
            ];
            
            $arrOjb = array();
            $id = DB::table('appointment')->insertGetId($dataAppointment);
            if($serviceId!=""){
                if($id){
                    for($i=0 ;$i<count($serviceId);$i++){
                        array_push(
                            $arrOjb,
                            array(
                              'serviceId'=>$serviceId[$i],
                              'appointId'=>$id
                            )
                        );
                    }
                    DB::table('servicerequest')->insert($arrOjb);
                }
            }
          
            $NotificationType = "Request Appointment";
            $NotificationMessage = "Successfuly to request appaointment. appointment ID: $id";
            $NotificationResult = "success";
    
            return response()->json(
                array(
                    "type" => $NotificationType,
                    "description" => $NotificationMessage,
                    "result" => $NotificationResult
                )
            );

        }catch(\Exception $e){ 
            $NotificationType = "Request Appointment";
            $NotificationMessage = "Error occured ". $e->getMessage();
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


    function getApprovedAppointmentInfo(Request $request){
        try{
            $id= $request->input("id");
            $query = DB::table('appointment')
            ->select('appointment.id','vehicle.year','client.id as clientId','vehicle.id as vehicleId','client.name','client.contactNo','appointment.vehicleProblem','vehicle.make','vehicle.model','vehicle.variant')
            ->join('client','appointment.clientId','=','client.id')
            ->join('vehicle','vehicle.id','=','appointment.vehicleId') // Replace 'your_table' with your actual table name
            ->where('appointment.id', '=', $id)
            ->get();
                // Replace 'column_name' with the column you want to search
         
            $serviceText="";
            $data = array();
            foreach($query as $rows){
                $servicesAvail = $this->servicesAvail($rows->id);
                foreach($servicesAvail as $row){
             
                    $serviceText.=$row->serviceDesc.' , ';
                }
                array_push(
                    $data,
                    array(
                        "name"=>$rows->name,
                        "clientId"=>$rows->clientId,
                        "vehicleId"=>$rows->vehicleId,
                        "vehicle"=>$rows->make ." ".$rows->model." ".$rows->variant." ".$rows->year,
                        "vehicleProblem"=>$rows->vehicleProblem,
                        "serviceRequest"=> $serviceText,
                    )
                );
            }


           

            return response()->json(array(
                "data" => $data,
            ));
            
        }catch(\Exception $e){
            echo $e->getMessage();
        }
    }



    function setServiceSubmit(Request $request){
      //  id	clientId	vehicleId	adminId	serviceCharge	partsCharge	totalPrice	serviceStatus	paymentStatus	dateStart	dateEnded	dateAdded
        try{

            $userSession= $this->userSession();
            $id = $request->input("id");
            $clientId = $request->input("clientId");
            $vehicleId = $request->input("vehicleId");
            $adminId =$userSession->id;
            $appointId = $request->input("appointId");
            $totalPrice = $request->input("totalPrice");
            $serviceStatus = 'pending';
            $paymentStatus ='not paid';
            $dateStart ='';
            $dateEnded ='';
            $partsId = $request->input("partsId"); 
            $serviceId= $request->input("serviceId");

            $insertOnService =[
                "clientId"=> $clientId,
                "vehicleId"=> $vehicleId,
                "adminId"=> $adminId,
                "totalPrice"=> $totalPrice,
                "serviceStatus"=> $serviceStatus,
                "paymentStatus"=> $paymentStatus,
                "dateStart"=> $dateStart,
                "dateEnded"=> $dateEnded
            ];
            
            $id = DB::table('onservice')->insertGetId($insertOnService);
            $arrOjbParts=array();
            $arrOjbService =array();
            if($serviceId!=""){
                if($id){
                    for($i=0 ;$i<count($serviceId);$i++){
                        array_push(
                            $arrOjbService,
                            array(
                              'serviceId'=>$serviceId[$i],
                              'onserviceId'=>$id
                            )
                        );
                    }
                    DB::table('serviceavail')->insert($arrOjbService);
                }
            }

            if($partsId!=""){
                if($id){
                    for($i=0 ;$i<count($partsId);$i++){
                        array_push(
                            $arrOjbParts,
                            array(
                              'partsId'=>$partsId[$i],
                              'onserviceId'=>$id
                            )
                        );
                    }
                    DB::table('partsAvail')->insert($arrOjbParts);
                }
            }

            DB::table('appointment')->where('id', '=', $appointId)->delete();
            DB::table('servicerequest')->where('appointId', '=', $appointId)->delete();

            $NotificationType = "Set Task";
            $NotificationMessage = "Successfuly to set task. appointment ID: $id";
            $NotificationResult = "success";
    
            return response()->json(
                array(
                    "type" => $NotificationType,
                    "description" => $NotificationMessage,
                    "result" => $NotificationResult
                )
            );

        }catch(\Exception $e){
            echo $e->getMessage();
        }
      
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

    function getOnServiceList(Request $request){
        try{

            $userId = $this->userSession();

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
            ->where(function($query){
                $query
                ->where('onservice.paymentStatus', '!=', 'paid')
                ->orWhere('onservice.serviceStatus', '!=', 'finished');
            })
          
            ->get();
           
            $data = array();
            
            $parts = array();
            $partsSTR="";
            $servicesSTR="";
            $pesoSign = "\u{20B1}";
            foreach($onService as $onServices){
                $actions="";
                $id= $onServices->id;
                if($onServices->serviceStatus=="pending" && ($onServices->paymentStatus=="not paid"||$onServices->paymentStatus=="paid")){
                    $actions="<select class='onServiceActionBtn' data-id='$id'>
                        <option value='' selected disabled>Select Option</option>
                        <option value='start task'>Start Task</option>
                        <option value='del task'>Remove Pending</option>
                    </select>";
                }else if($onServices->serviceStatus=="ongoing" && ($onServices->paymentStatus=="not paid"||$onServices->paymentStatus=="paid")){
                    $actions="<select class='onServiceActionBtn' data-id='$id'>
                    <option value='' selected disabled>Select Option</option>
                    <option value='finish task'>Set to Finish</option>
                    <option value='payment'>Payment</option>
                    </select>";
                }
                else if($onServices->serviceStatus=="finished" && ($onServices->paymentStatus=="not paid"||$onServices->paymentStatus=="paid")){
                    $actions="<select class='onServiceActionBtn' data-id='$id'>
                    <option value='' selected disabled>Select Option</option>
                    <option value='payment'>Payment</option>
                    </select>";
                }

              
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

    function changeOnServiceStatus(Request $request){
        try{

            $currentDateTime = Carbon::now()->setTimezone('GMT+8');
            $current12HrsDateTime = $currentDateTime->format('Y-m-d g:i A');
            $id = $request->input('id');
            $status = $request->input('status');

           $query= DB::table('onservice')
            ->where('id', $id);
            if($status =="ongoing"){
               $query->update([
                    'serviceStatus'=>$status,
                    'dateStart'=>$current12HrsDateTime 
                ]);
            }else if($status=="finished"){
                $query->update([
                    'serviceStatus'=>$status,
                    'dateEnded'=>$current12HrsDateTime 
                ]);
            }
            else if($status=="paid"){
                $query->update([
                    'paymentStatus'=>$status,
                ]);
            }


            $NotificationType = "Set to $status";
            $NotificationMessage = "Successfuly change status to $status. Task id: $id";
            $NotificationResult = "success";
            return response()->json(
                array(
                    "type" => $NotificationType,
                    "description" => $NotificationMessage,
                    "result" => $NotificationResult
                )
            );
        }catch(\Exception $e){
            $NotificationType = "Set to $status";
            $NotificationMessage = "Error Occured";
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

  function getOnServiceInfo(Request $request){
    try{
        $id = $request->input("id");

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
        ->where('onservice.id', '=',$id)
        ->get();
        return response()->json($onService);

    }catch(\Exception $e){

    }
  }

}
  




