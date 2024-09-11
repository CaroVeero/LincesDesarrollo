<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Stmt\TryCatch;

class UserController extends Controller
{
    public function formularioLogin(){
        if(Auth::check()){
            return redirect()->route('backoffice.dashboard');
        }
        return view('usuario.login');
    }

    public function formularioNuevo(){
        if(Auth::check()){
            return redirect()->route('backoffice.dashboard');
        }
        return view('usuario.create');
    }
    public function login(Request $_request){
        $mensajes = [
            'email.required' =>'El mail es obligatorio.',
            'email.email' =>'El mail no tiene un formato válido.',
            'password.required' =>'La contraseña es obligatoria.'          
        ];

        $_request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ], $mensajes);

        $credenciales = $_request->only('email', 'password');

        if (Auth::attemp($credenciales)){
            //Verifica el usuario activo
            $user = Auth::user();
            if (!$user->activo){
                Auth::logout();
                return redirect()->route('usuario.login')->withErrors(['email' => 'El usuario e encuentra desactivado']);
            }
            //Autenticación exitosa
            $_request->session()->regenerate();
            return redirect()->route('backoffice.dashboard');
        }
        return redirect()->back()->withErrors(['email'=>'El usuario o contraseña son incorrectos']);
    }

    public function logout(Request $_request)
    {
        Auth::logout();
        $_request->session()->invalidate();
        $_request->session()->regenerateToken();
        return redirect()->route('usuario.login');
    }
    public function registrar(Request $_request){
        $mensajes = [
            'nombre.required' =>'El nombre es obligatorio.',
            'email.required' =>'El mail es obligatorio.',
            'email.email' =>'El mail no tiene un formato válido.',
            'password.required' =>'La contraseña es obligatoria.',             
            'rePassword.required' =>'Repetir la contraseña es obligatorio.',
            'dayCode.required' =>'Repetir el código del día es obligatorio.',
        ];

        $_request->validate([
            'nombre' => 'required|string|max:50',
            'email' => 'required|email',
            'password' => 'required',
            'rePassword' => 'required',
            'dayCode' => 'required',
        ], $mensajes);

        $datos= $_request->only('nombre', 'email', 'password', 'rePassword', 'dayCode');
        
        // Comprobar las contraseñas 
        if($datos['password'] != $datos['rePassword']){
            return back()->withErrors(['message' => 'Las contraseñas no coinciden']);
        }

        // Comprobar el código del día
        date_default_timezone_set('America/Santiago');
        if($datos['password'] != $datos['rePassword']){
            // Mostrar el error
            return back()->withErrors(['message' => 'El código del día no es válido']);

        }

        //Crear el usuario en la base de datos
        Try{
            User::create([
                'nombre' => $datos['nombre'],
                'email' => $datos['email'],
                'password' => Hash::make($datos['password']),
            ]);
            return redirect()->route('usuario.login')->with('success', 'Usuario creado exitosamente');
        }catch (QueryException $e){
            // Mostrar el error
            return back()->withErrors(['message' => 'Error: '. $e->getMessage()]);

        }
    }
}