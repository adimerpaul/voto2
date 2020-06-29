<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
//use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use App\Imports\ElectoresImport;
use App\Imports\UsersImport;
use Illuminate\Support\Facades\Hash;
use App\Elector;
use DB;
class ElectoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Elector::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $elector=new Elector([
            "nombres"=>$request->get("nombres"),
            "ci"=>$request->get("ci"),
            "mesa"=>$request->get("mesa"),
        ]);
        $elector->save();
        return $elector;
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
        return DB::select('SELECT mesa,
        (SELECT nombres FROM electores WHERE mesa=1010 ORDER BY nombres ASC LIMIT 1) as desde,
        (SELECT nombres FROM electores WHERE mesa=1010 ORDER BY nombres DESC LIMIT 1) as hasta
        FROM electores GROUP BY mesa');
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
        $elector=Elector::find($id);
        $elector->ci=$request->get('ci');
        $elector->mesa=$request->get('mesa');
        $elector->nombres=$request->get('nombres');
        $elector->save();
        return $elector;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Elector::truncate();
    }
    public function eliminar($id){
        $elector=Elector::find($id);
        $elector->delete();
        return $elector;
//        return "aa";
    }
    public function ImportPersonas(Request $request){
        Elector::truncate();
        Excel::import(new ElectoresImport, $request->file('file'));
//        return redirect()->route('/');
        return "yes";
    }
    public function wordElector(Request $request){
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $section = $phpWord->addSection();
        $section->addText('adimer');
        $section->addText('adimer101@gmail.com');
        $section->addText('69603027',array('name'=>'Arial','size' => 20,'bold' => true));
        $section->addImage("./dist/img/avatar.png");
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save('Appdividend.docx');
//        \PhpOffice\PhpWord\Settings::setPdfRendererPath('path/to/tcpdf');
//        \PhpOffice\PhpWord\Settings::setPdfRendererName('TCPDF');
//        $phpWord = \PhpOffice\PhpWord\IOFactory::load('Appdividend.docx', 'Word2007');
//        $xmlWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord , 'PDF');
//        $xmlWriter->save('Appdividend.pdf');
//        $phpWord->save('document.pdf', 'PDF');
        return response()->download(public_path('Appdividend.docx'));
    }
}
