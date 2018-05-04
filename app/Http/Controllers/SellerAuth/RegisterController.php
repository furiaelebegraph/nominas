<?php

namespace App\Http\Controllers\SellerAuth;
use Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Mail\verificaCorreoToken;

//Validator facade used in validator method
use Illuminate\Support\Facades\Validator;

//Seller Model
use App\Seller;

//Auth Facade used in guard
use Auth;

class RegisterController extends Controller
{

    protected $redirectPath = 'seller_register';

    //shows registration form to seller
    public function showRegistrationForm()
    {
        return view('seller.auth.register');
    }

    //Handles registration request for seller
    public function register(Request $request)
    {

       //Validates data
        $this->validator($request->all())->validate();

       //Create seller
        $seller = $this->create($request->all());

        //Authenticates seller
        $this->enviarCorreoVerificacion($seller);

        // $this->guard()->login($seller);

       //Redirects sellers
        return  redirect()->back()->with('mensaje', 'Enviamos un correo de confirmacion a tu cuenta de correo!');
    }

    //Validates user's Input
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nombre' => 'required|max:255',
            'correo' => 'required|email|max:255|unique:sellers',
            'password' => 'required|min:6|confirmed',
            'telefono' => 'required|min:6',
            'direccion' => 'required|min:6',
            'nss' => 'required|min:6',
        ]);
    }

    //Create a new seller instance after a validation.
    protected function create(array $data)
    {
        $data['emailtoken'] = Str::random(40);
        $data['verificado'] = 0;
        return Seller::create([
            'nombre' => $data['nombre'],
            'correo' => $data['correo'],
            'telefono' => $data['telefono'],
            'direccion' => $data['direccion'],
            'nss' => $data['nss'],
            'emailtoken' => $data['emailtoken'],
            'verificado' => $data['verificado'],
            'password' => bcrypt($data['password']),
        ]);
    }

    //Get the guard to authenticate Seller
    protected function guard()
    {
        return Auth::guard('web_seller');
    }
    public function enviarCorreoVerificacion($thisUser){
        Mail::to($thisUser['correo'])->send(new verificaCorreoToken($thisUser));
    }
    public function enviarCorreoListo($correo, $emailtoken){
        $usuario = Seller::where(['correo'=>$correo, 'emailtoken'=>$emailtoken ])->first();
        if ($usuario) {
            Seller::where(['correo'=>$correo, 'emailtoken'=>$emailtoken ])->update(['verificado'=>'1', 'emailtoken'=>NULL]);
            return view('seller.auth.login')->with('mensaje', 'Ya estas dado de alta, ahora puedes ingresar con tu usuario y contrana');
         }else{
            return view('seller.auth.register')->with('errorsito', 'No encotramos el ususario :(');
         }
    }

    public function verificarEmailPrimero(){
        return view('email.verificaCorreoPrimero');
    }
}
