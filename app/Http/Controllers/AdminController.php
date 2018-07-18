<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Index - seller';
        $sellers = Seller::paginate(6);
        return view('seller.index',compact('sellers','title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Create - seller';
        
        return view('seller.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $seller = new Seller();

        
        $seller->fecha = $request->fecha;

        
        $seller->pdf = $request->pdf;

        
        $seller->xml = $request->xml;

        
        
        $seller->save();

        $pusher = App::make('pusher');

        //default pusher notification.
        //by default channel=test-channel,event=test-event
        //Here is a pusher notification example when you create a new resource in storage.
        //you can modify anything you want or use it wherever.
        $pusher->trigger('test-channel',
                         'test-event',
                        ['message' => 'A new seller has been created !!']);

        return redirect('seller');
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
        $title = 'Show - seller';

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
    public function edit($id,Request $request)
    {
        $title = 'Edit - seller';
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
    public function update($id,Request $request)
    {
        $seller = Seller::findOrfail($id);
        
        $seller->fecha = $request->fecha;
        
        $seller->pdf = $request->pdf;
        
        $seller->xml = $request->xml;
        
        
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
    public function DeleteMsg($id,Request $request)
    {
        $msg = Ajaxis::BtDeleting('Warning!!','Would you like to remove This?','/seller/'. $id . '/delete');

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
