<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Seller;
use URL;
use App\Nomina;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Auth;

class SellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function index() {
        $title = 'Index - Seller';
        $id = Auth::user()->id;
        $nominis = Seller::findOrFail($id);
        return view('seller.dash',compact('nominis','title'));
    }



    public function buscador(Request $request){
        $error = ['error'=> 'No se encontro ningun Resultad'];
        if($request->has('q')){
            $buscaColaborador = Seller::search($request->get('q'))->get();
            return $buscaColaborador->count();
        }
        return error;
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create(){
        $title = 'Create - Seller';
        
        return view('seller.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function store(Request $request){
        $seller = new Seller();

        
        $seller->nombre = $request->nombre;
        $seller->correo = $request->correo;
        $seller->telefono = $request->telefono;
        $seller->verificado = 1;
        $seller->direccion = $request->direccion;
        $seller->nss = $request->nss;
		$seller->password = bcrypt($request->password);
        
        
        $seller->save();

        $pusher = App::make('pusher');

        //default pusher notification.
        //by default channel=test-channel,event=test-event
        //Here is a pusher notification example when you create a new resource in storage.
        //you can modify anything you want or use it wherever.
        $pusher->trigger('test-channel',
                         'test-event',
                        ['message' => 'A new Seller has been created !!']);

        return redirect('seller');
    }

    /**
     * Display the specified resource.
     *
     * @param    \Illuminate\Http\Request  $request
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
    public function show($id,Request $request){
        $title = 'Show - Seller';

        if($request->ajax())
        {
            return URL::to('seller/'.$id);
        }

        $seller = Seller::findOrfail($id);
        return view('seller.show',compact('title','seller'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param    \Illuminate\Http\Request  $request
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
    public function edit($id,Request $request){
        $title = 'Edit - Seller';
        if($request->ajax())
        {
            return URL::to('seller/'. $id . '/edit');
        }

        
        $seller = Seller::findOrfail($id);
        return view('seller.edit',compact('title','seller'  ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
    public function update($id,Request $request){
        $seller = Seller::findOrfail($id);
    	
        $seller->nombre = $request->nombre;
        $seller->correo = $request->correo;
        $seller->telefono = $request->telefono;
        $seller->direccion = $request->direccion;
        $seller->nss = $request->nss;
        
        
        $seller->save();

        return redirect('seller');
    }

    /**
     * Delete confirmation message by Ajaxis.
     *
     * @link      https://github.com/amranidev/ajaxis
     * @param    \Illuminate\Http\Request  $request
     * @return  String
     */
    public function DeleteMsg($id,Request $request){
        $msg = Ajaxis::BtDeleting('Warning!!','Would you like to remove This?','/Seller/'. $id . '/delete');

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
     	$seller = Seller::findOrfail($id);
     	$seller->delete();
        return URL::to('seller');
    }
}
