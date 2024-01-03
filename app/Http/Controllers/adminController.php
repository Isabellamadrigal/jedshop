<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class adminController extends Controller
{

    function userSession(){
        $sessionArr = session('pms_midterms');
        $sessionParsed = json_decode($sessionArr);
        return $sessionParsed[0];
       }
   function getSalesDWMY(Request $request){
    try{
        $user= $this->userSession();
        $data = array();
        $date = $request->input('date');
       
        $dateSale = DB::select(
        "
        SELECT
        DATE_FORMAT(onservice.dateAdded, '". $date ." ') AS dateSale,
        SUM(onservice.totalPrice) AS totalSale
        FROM
        onservice 
        LEFT JOIN
        admin
        ON
        admin.id=onservice.adminId  
        WHERE
        admin.id = '".$user->id."'
        GROUP BY 
        dateSale
        ORDER BY 
        onservice.dateAdded
        LIMIT 7;
        "
        );
    
    foreach($dateSale as $dsale){
        array_push(
            $data,
            array( 
                "dateSale" =>$dsale->dateSale,
                "totalSale" =>$dsale->totalSale,
            )
        );
    }
    
    
        return response()->json(
            array(
        "data" => $data
    )
        );
    }catch(\Exception $e){
        echo $e->getMessage();
    }
   
  
   }
}
