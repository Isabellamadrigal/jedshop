<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class accountController extends Controller
{
    function login(Request $request){
        try{
            $user = $request->input('user');
            $pass = $request->input('pass');
            $userType = $request->input('userType');
            $validateUser = $this->userValidate($userType);

            if($validateUser=="isClient"){
                $userInfo = $this->loginClient($user,$pass);
                $id =  $userInfo[0]->id;
                $users = $userInfo[0]->email;
                $name = $userInfo[0]->name;
                $imgPath = $userInfo[0]->imgPath;
                $role = "client";
            }
            
            else if($validateUser=="isAdmin"){
                $userInfo1 = $this->loginAdmin($user,$pass);
                $id =  $userInfo1[0]->id;
                $users = $userInfo1[0]->userName;
                $name = $userInfo1[0]->name;
                $imgPath = $userInfo1[0]->imgPath;
                $role = "admin";
            }
           

            $loginInfo = [
                (object)['id' => $id, 'username' => $users, 'name'=> $name,'role'=> $role, 'imgPath'=>$imgPath]
            ];
            
            $request->session()->put('pms_midterms',json_encode($loginInfo));

            return response()->json($loginInfo);

        }catch(\Exception $e){
            echo $e->getMessage();
           // return response()->json("");
        }
       
    }

    function loginAdmin($user,$pass){
        $users = DB::table('admin')
        ->where('userName', '=', $user)
        ->where('password', '=', $pass)
        ->get();
        return $users;
    }
    function loginClient($user,$pass){
        $users = DB::table('client')
        ->where('email', '=', $user)
        ->where('password', '=', $pass)
        ->get();
        return $users;
    }
    function userValidate($userType){
        if($userType=="client"){
            return "isClient";
        }else if($userType=="admin"){
            return "isAdmin";
        }
    }

    function checkClientAccountExist($email){
        $users = DB::table('client')
        ->where('email', '=', $email)
        ->count();
        return $users;
    }

    function clientRegistration(Request $request){
        try{
            $email = $request->input('email');
            $password = $request->input('password');
            $name = $request->input('name');
            $address = $request->input('address');
            $phoneNumber = $request->input('phoneNumber');
           
            $checkCount = $this->checkClientAccountExist($email);
          
            $NotificationType = "Client Registration";
           
            if($checkCount==0){
                
                if($request->hasFile('image')&& $request->file('image')->isValid()){
                    $image = $request->file('image');
                    $imageName = time() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('img/users'), $imageName);
                }else{
                    $imageName = "default-user.png";
                }

                $data = [
                    'email' => $email,
                    'password' => $password,
                    'name' => $name,
                    'address' => $address,
                    'contactNo' => $phoneNumber ,
                    'imgPath'=>$imageName
                    // Add more columns and values as needed
                ];
            
                DB::table('client')->insert($data);
             
                $NotificationMessage = "Your Registration is success!";
                $NotificationResult = "success";
            }
            else{
                $NotificationMessage = "This email is already exist";
                $NotificationResult = "error";
            }

            return response()->json(
                array(
                    "type" => $NotificationType,
                    "description" => $NotificationMessage,
                    "result" => $NotificationResult
                )
            );
        }catch(\Exception $e){
            $NotificationType = "Client Registration";
            $NotificationMessage = "Error occured";
            $NotificationResult = "error";
            return response()->json(
                array(
                    "type" => $NotificationType,
                    "description" => $e->getMessage(),
                    "result" => $NotificationResult
                )
            );
        }
    }
}
