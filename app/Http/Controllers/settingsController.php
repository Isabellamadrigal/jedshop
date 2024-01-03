<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class settingsController extends Controller
{ 
    function userSession(){
    $sessionArr = session('pms_midterms');
    $sessionParsed = json_decode($sessionArr);
    return $sessionParsed[0];
   }
    function getServices(){
        try{
            $services = DB::table('services')->get();
            $data = array();
    
            foreach($services as $row){
                $id = $row->id;
                $action ="<select class='servicesActionBtn' data-id='$id'>
                <option value=''>Select Option</option>
                <option value='Edit'>Edit</option>
                <option value='Show'>Show</option>
                <option value='Hide'>Hide</option>
                </select>";
                $imgPath = $row->imgPath;
                $img = "<img src='img/services/$imgPath' class='img-100 rounded-circle img-thumbnail' alt='Image'>";
                array_push($data,
                    array(
                        "actions"=> $action,
                        "imgPath"=> $img,
                        "serviceDesc"=> $row->serviceDesc,
                        "price"=> $row->price,
                        "visible"=>$row->visible
                    )
                );
            }
    
            return response()->json(
                array(
                    'data'=> $data
                )
            );
        }catch(\Exception $e){
            
        }
       
    }

    function getParts(){
        try{
            $parts = DB::table('parts')->get();
            $data = array();
    
            foreach($parts as $row){
                $id = $row->id;
                $action ="<select class='partsActionBtn' data-id='$id'>
                    <option value=''>Select Option</option>
                    <option value='Edit'>Edit</option>
                    <option value='Show'>Show</option>
                    <option value='Hide'>Hide</option>
                </select>";
    
                $imgPath = $row->imgPath;
                $img = "<img src='img/parts/$imgPath' class='img-100 rounded-circle img-thumbnail' alt='Image'>";
                array_push($data,
                    array(
                        "actions"=> $action,
                        "imgPath"=> $img,
                        "itemDesc"=> $row->itemDesc,
                        "category"=> $row->category,
                        "price"=> $row->price,
                        "visible"=>$row->visible

                    )
                );
            }
            return response()->json(
                array(
                    'data'=> $data
                )
            );
        }catch(\Exception $e){

        }
       
    }



    function changeServicesStatus(Request $request){
        try{    
            $id = $request->input('id');
            $status = $request->input('status');

            DB::table('services')
            ->where('id', $id)
            ->update([
            'visible'=>$status,
            ]);

            $NotificationType = "Set to $status";
            $NotificationMessage = "Successfuly $status the Item id: $id";
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
            $NotificationMessage = "Failed to  $status  the Item id: $id";
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
    function changePartsStatus(Request $request){
        try{    
            $id = $request->input('id');
            $status = $request->input('status');

            DB::table('parts')
            ->where('id', $id)
            ->update([
            'visible'=>$status,
            ]);

            $NotificationType = "Set to $status";
            $NotificationMessage = "Successfuly $status the Item id: $id";
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
            $NotificationMessage = "Failed to  $status  the Item id: $id";
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

    function editServiceInfo(Request $request){
        try{
            $id = $request->input('id');
            //$status = $request->input('status');

            $serviceDesc =$request->input('serviceDesc');
            $price =$request->input('price');


            if($request->hasFile('imgPath')&& $request->file('imgPath')->isValid()){
                $image = $request->file('imgPath');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('img/services'), $imageName);
            }else{
                $imageName = "default-user.png";
            }


             DB::table('services')
            ->where('id', $id)
            ->update([
            'serviceDesc'=>$serviceDesc,
            'imgPath'=>$imageName,
            'price'=>$price
            ]);
    
            $NotificationType = "Edit  Service";
            $NotificationMessage = "Successfuly edited the service id: $id";
            $NotificationResult = "success";
            return response()->json(
                array(
                    "type" => $NotificationType,
                    "description" => $NotificationMessage,
                    "result" => $NotificationResult
                )
            );
        }catch(\Exception $e){
            $NotificationType = "Edit Service";
            $NotificationMessage = "Successfuly edited the service id: $id";
            $NotificationResult = "success";
            return response()->json(
                array(
                    "type" => $NotificationType,
                    "description" => $NotificationMessage,
                    "result" => $NotificationResult
                )
            );
        }
    }

    function editPartInfo(Request $request){
        try{
            $id = $request->input('id');
            //$status = $request->input('status');
            $itemDesc = $request->input('itemDesc');
            $category = $request->input('category');
            $price = $request->input('price');
            
            if($request->hasFile('imgPath')&& $request->file('imgPath')->isValid()){
                $image = $request->file('imgPath');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('img/parts'), $imageName);
            }else{
                $imageName = "default-user.png";
            }

            DB::table('parts')
            ->where('id', $id)
            ->update([
            'itemDesc'=>$itemDesc,
            'imgPath'=> $imageName,
            'category'=> $category,
            'price'=>$price
            ]);
    
            $NotificationType = "Edit Part";
            $NotificationMessage = "Successfuly edited the part id: $id";
            $NotificationResult = "success";
            return response()->json(
                array(
                    "type" => $NotificationType,
                    "description" => $NotificationMessage,
                    "result" => $NotificationResult
                )
            );

        }catch(\Exception $e){

            $NotificationType = "Edit Part";
            $NotificationMessage = "Failed edited the part id: $id";
            $NotificationResult = "success";
            return response()->json(
                array(
                    "type" => $NotificationType,
                    "description" => $NotificationMessage,
                    "result" => $NotificationResult
                )
            );
        }
    }

    function addServices(Request $request){
        try{

            $serviceDesc = $request->input("serviceDesc");
            $price = $request->input("price");
            $status ="hidden";

            if($request->hasFile('imgPath')&& $request->file('imgPath')->isValid()){
                $image = $request->file('imgPath');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('img/services'), $imageName);
            }else{
                $imageName = "default-user.png";
            }

            $data = [
                'serviceDesc' => $serviceDesc,
                'price' => $price,
                'imgPath' => $imageName,
                'visible'=>$status
            ];
        

        DB::table('services')->insert($data);

        $NotificationType = "Add Service";
        $NotificationMessage = "Successfully added the Service: $serviceDesc";
        $NotificationResult = "success";
        return response()->json(
            array(
                "type" => $NotificationType,
                "description" => $NotificationMessage,
                "result" => $NotificationResult
            )
        );

        }catch(\Exception $e){
            $NotificationType = "Add Service";
            $NotificationMessage = "Failed ty add Service: $serviceDesc";
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

    function addParts(Request $request){
        try{

            $itemDesc = $request->input("itemDesc");
            $price = $request->input("price");
            $category =$request->input("category");
            $status = "hidden";
            if($request->hasFile('imgPath')&& $request->file('imgPath')->isValid()){
                $image = $request->file('imgPath');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('img/parts'), $imageName);
            }else{
                $imageName = "default-user.png";
            }

            $data = [
                'category' => $category,
                'itemDesc' => $itemDesc,
                'imgPath' => $imageName,
                'price'=>$price,
                'visible'=>$status

            ];
        

        DB::table('parts')->insert($data);

        $NotificationType = "Add Parts";
        $NotificationMessage = "Successfully added the Item: $itemDesc";
        $NotificationResult = "success";
        return response()->json(
            array(
                "type" => $NotificationType,
                "description" => $NotificationMessage,
                "result" => $NotificationResult
            )
        );

        }catch(\Exception $e){
            $NotificationType = "Add Parts";
            $NotificationMessage = "Failed ty add Item: $itemDesc";
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
}
