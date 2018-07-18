<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Nomina;
use App\Seller;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $sellers = Seller::paginate(5);
        $nominis = Nomina::with('Seller')->paginate(5);
        return view('home', compact('sellers','nominis'));
    }

    public function indexSeller(){
        $sellers = Seller::paginate(5);
        return view('seller.index', compact('sellers'));
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

        $seller->nombre = $request->nombre;
        $seller->correo = $request->correo;
        $seller->telefono = $request->telefono;
        $seller->verificado = 1;
        $seller->direccion = $request->direccion;
        $seller->nss = $request->nss;
        $seller->password = bcrypt($request->password);

        $seller->save();


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

        
        $colaborador = Seller::findOrfail($id);
        return view('seller.edit',compact('title','colaborador'  ));
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
        
        $seller->nombre = $request->nombre;
        $seller->correo = $request->correo;
        $seller->telefono = $request->telefono;
        $seller->verificado = 1;
        $seller->direccion = $request->direccion;
        $seller->nss = $request->nss;
        $seller->password = bcrypt($request->password);
        
        
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
        return redirect('seller');
    }
}
