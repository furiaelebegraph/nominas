<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Nomina;
use URL;

class NominaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Index - nomina';
        $nominas = Nomina::paginate(6);
        return view('nomina.index',compact('nominas','title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Create - nomina';
        
        return view('nomina.create');
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

        
        $nomina->fecha = $request->fecha;

        
        $nomina->pdf = $request->pdf;

        
        $nomina->xml = $request->xml;

        
        
        $nomina->save();

        $pusher = App::make('pusher');

        //default pusher notification.
        //by default channel=test-channel,event=test-event
        //Here is a pusher notification example when you create a new resource in storage.
        //you can modify anything you want or use it wherever.
        $pusher->trigger('test-channel',
                         'test-event',
                        ['message' => 'A new nomina has been created !!']);

        return redirect('nomina');
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

        
        $nomina = Nomina::findOrfail($id);
        return view('nomina.edit',compact('title','nomina'  ));
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
        
        $nomina->fecha = $request->fecha;
        
        $nomina->pdf = $request->pdf;
        
        $nomina->xml = $request->xml;
        
        
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
        return URL::to('nomina');
    }
}
