<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    /**
     * Página principal (vista general).
     */
    public function indexgeneral()
    {
        return view('users/indexgeneral');
    }

    /**
     * Registro de usuarios.
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/', 'max:30'],
            'email' => 'required|email|unique:users,email',
            'password' => [
                'required', 'string', 'min:8',
                'regex:/[A-Z]/',    // mayúscula
                'regex:/[a-z]/',    // minúscula
                'regex:/[0-9]/',    // número
                'regex:/[@$!%*?&+,#]/', // caracter especial
                'confirmed'
            ],
            'password_confirmation' => ['required']
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'name.max' => 'El nombre no puede tener más de 30 caracteres.',
            'name.regex' => 'El nombre solo puede contener letras y espacios.',

            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Este formato no es válido.',
            'email.unique' => 'El correo electrónico ya está en uso.',

            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 6 caracteres.',
            'password.regex' => 'La contraseña debe contener al menos una mayúscula, una minúscula, un número y un carácter especial.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
        ]);

        // Crear usuario
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = 'cliente'; // rol por defecto
        $user->save();

        // Enviar verificación de correo
        $user->sendEmailVerificationNotification();

        return redirect()->route('indexgeneral')
            ->with('success', '¡Registro completado! Revisa tu correo para verificar tu cuenta.');
    }

    /**
     * Inicio de sesión.
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => ['required']
        ], [
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Este formato no es válido.',
            'password.required' => 'La contraseña es obligatoria.',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Si no verificó el correo
            if (!$user->hasVerifiedEmail()) {
                Auth::logout();
                return redirect()->route('indexgeneral')
                    ->withErrors(['login' => 'Debes verificar tu correo electrónico antes de ingresar.']);
            }

            // Redirección por rol
            return $user->role === 'admin'
                ? redirect()->route('admin.index')->with('success', '¡Bienvenido administrador!')
                : redirect()->route('indexgeneral')->with('success', '¡Inicio de sesión exitoso!');
        }

        return back()->withErrors(['login' => 'Correo o contraseña incorrectos.'])->withInput();
    }
/**
     * Logout.
     */
    public function logout(Request $request)
{
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('indexgeneral')->with('success', 'Sesión cerrada correctamente.');
}


    /**
     * Formulario de contacto.
     */
    public function message(Request $request)
    {
        $request->validate([
            'firstname' => ['required', 'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/', 'max:30'],
            'lastname'  => ['required', 'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/', 'max:30'],
            'email'     => ['required', 'email'],
            'message'   => ['required']
        ], [
            'firstname.required' => 'El nombre es obligatorio.',
            'lastname.required'  => 'El apellido es obligatorio.',
            'email.required'     => 'El correo electrónico es obligatorio.',
            'email.email'        => 'Este formato no es válido.',
            'message.required'   => 'El mensaje es obligatorio.',
        ]);

        // Aquí puedes elegir: guardar en DB o enviar correo.
        // Ejemplo: Mail::to('soporte@tuapp.com')->send(new ContactMessage($request->all()));

        return back()->with('success', '¡Tu mensaje ha sido enviado correctamente!');
    }
}
