<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Nomina;
use App\Seller;
use URL;

class NominaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function buscador(Request $request){
        $error = ['error'=> 'No se encontro ningun Resultad'];
        if($request->has('buscador')){
            $buscaNomina = Seller::search($request->get('buscador'))->get();
            return Response()->json($buscaNomina);
        }else{

        }
        return $error;
    }


    public function index(Request $request){
        $title = 'Index - nomina';
        $nominas = Nomina::paginate(6);
        $error = ['error'=> 'No se encontró ningun resultado'];
        if($request->buscador){
            $buscaNomina = Nomina::search($request->buscador)->get()->load('seller');
        }else{
            $buscaNomina = null;
        }
        return view('nomina.index',compact('nominas','title', 'buscaNomina'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $title = 'Create - nomina';
        $selers = Seller::all();
        return view('nomina.create', compact('selers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nomina = new Nomina();
        if ($request->hasFile('pdf') && $request->hasFile('xml')) {
            $nombrePDF = preg_replace('/\s/', '', $request->pdf->getClientOriginalName());
            $nombreXML = preg_replace('/\s/', '', $request->xml->getClientOriginalName());
            $superXml = time().'-'.$nombreXML;
            $superPdf = time().'-'.$nombrePDF;
            $pdfPath = 'pdf/'.$superPdf;
            $xmlPath = 'xml/'.$superXml;
            $request->pdf->move('img/pdf/', $superPdf);
            $request->xml->move('img/xml/', $xmlPath);
            $nomina->pdf = $pdfPath;
            $nomina->xml = $xmlPath;
        }else{
            return back()->withInput('mensaje', 'Debes agregar PDF Y XML');
        }

        $nomina->seller_id = $request->seller_id;
        $nomina->fecha = $request->fecha;
        
        $nomina->save();


        return redirect('nomina')->with('mensaje', 'Nueva nomina creada');
    }

    /**
     * Display the specified resource.
     *
     * @param    \Illuminate\Http\Request  $request
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
    public function show($id,Request $request)
    {
        $title = 'Show - nomina';

        if($request->ajax())
        {
            return URL::to('nomina/'.$id);
        }

        $nomina = Nomina::findOrfail($id);
        return view('nomina.show',compact('title','nomina'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param    \Illuminate\Http\Request  $request
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
    public function edit($id,Request $request)
    {
        $title = 'Edit - nomina';
        if($request->ajax())
        {
            return URL::to('nomina/'. $id . '/edit');
        }

        $selers = Seller::all();
        $nomina = Nomina::findOrfail($id);
        return view('nomina.edit',compact('title','nomina', 'selers'  ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
    public function update($id,Request $request)
    {
        $nomina = Nomina::findOrfail($id);
        if ($request->hasFile('pdf') && $request->hasFile('xml')) {
            $nombrePDF = preg_replace('/\s/', '', $request->pdf->getClientOriginalName());
            $nombreXML = preg_replace('/\s/', '', $request->xml->getClientOriginalName());
            $superXml = time().'-'.$nombreXML;
            $superPdf = time().'-'.$nombrePDF;
            $pdfPath = 'pdf/'.$superPdf;
            $xmlPath = 'xml/'.$superXml;
            $request->pdf->move('img/pdf/', $superPdf);
            $request->xml->move('img/xml/', $xmlPath);
            $nomina->pdf = $pdfPath;
            $nomina->xml = $xmlPath;
        }else{
            return back()->withInput('mensaje', 'Debes agregar PDF Y XML');
        }
        $nomina->fecha = $request->fecha;
        
        
        $nomina->save();

        return redirect('nomina');
    }

    /**
     * Delete confirmation message by Ajaxis.
     *
     * @link      https://github.com/amranidev/ajaxis
     * @param    \Illuminate\Http\Request  $request
     * @return  String
     */
    public function DeleteMsg($id,Request $request)
    {
        $msg = Ajaxis::BtDeleting('Warning!!','Would you like to remove This?','/nomina/'. $id . '/delete');

        if($request->ajax())
        {
            return $msg;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param    int $id
     * @return  \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $nomina = Nomina::findOrfail($id);
        $nomina->delete();
        return redirect('nomina');
    }
}
