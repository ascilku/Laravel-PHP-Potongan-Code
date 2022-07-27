<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Http\Requests\SampelRequest as Sampel;
use App\Http\Requests\SampleRequest;
use App\Helpers\ResponseFormatter;
use App\Http\Repositories\SampelRepository;
use App\Http\Servis\SampleServis;



class SampleController extends Controller
{
    private $sampleServis;
    public function __construct()
    {
        $this->sampleServis = new SampleServis();
    }


    //
    public function Index(SampleRequest $request){

        // $this->validate($request, [
        //     'sample'               => 'required|max:20' ,
        // ]); 
        $credentials = request(['name', 'email', 'password']);
        $data = $this->sampleServis->whereByEmailServis($credentials);
        // $data = ['kurni', 'hamsah', 'sandi'];
        
        return ResponseFormatter::responFormatter($data);

        // return ResponseFormatter::responFormatter('succes', 200, 'get berhasil', $data);
           
        
            // if($sample == ""){
            //     return ResponseFormatter::responFormatter('succes', 200, 'get berhasil', $data);
            // }else{
            //     return ResponseFormatter::responFormatter('succes', 200, 'get berhasil', $data);
            // }
        
        

    } 
}
