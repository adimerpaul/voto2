<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
//use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use App\Imports\UsersImport;
use Illuminate\Support\Facades\Hash;

class ElectoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user=new User([
            "name"=>$request->get("name"),
            "email"=>$request->get("email"),
            "password"=>Hash::make($request->get("password")),
        ]);
        $user->save();
        return $request;
//        $data=json_decode($request->data);
//        $t=" 01 ";
//        for ($i=0;$i<count($data);$i++){
//            echo $t;
//        }
//        $array = array(1, 2, 3, 4);
//        $array=json_decode($request->data);
//        $users=[];
//        foreach ($array as &$valor) {
////            $valor = $valor * 2;
////            echo $valor->name;
////            $user=new User([
////                "name"=>$valor->name,
////                "email"=>$valor->email,
////                "password"=>Hash::make($valor->name),
////            ]);
////            $users[]=;
//            $users[] = [
//                'name' => $valor->name,
//                'email' => $valor->email,
//                'password' => Hash::make($valor->password)
//            ];
//        }
//        User::insert($array);
//        return $array;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function ImportPersonas(Request $request){
        Excel::import(new UsersImport, $request->file('file'));
//        return redirect()->route('/');
        return "yes";
    }
}
