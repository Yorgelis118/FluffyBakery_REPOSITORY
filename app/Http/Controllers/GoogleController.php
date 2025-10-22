<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Exception;

class GoogleController extends Controller
{
    /**
     * Redirigir al login de Google.
     */
    public function redirectToGoogle()
    {
        try {
            $url = Socialite::driver('google')->redirect()->getTargetUrl();
            $url .= '&prompt=select_account'; // Forzar selección de cuenta
            return redirect($url);
        } catch (Exception $e) {
            Log::error('Error al redirigir a Google: ' . $e->getMessage());
            return redirect()->route('indexgeneral')
                ->with('error', 'Error al conectar con Google. Inténtalo de nuevo.');
        }
    }

    /**
     * Manejar la respuesta de Google.
     */
   public function handleGoogleCallback()
{
    try {
        $googleUser = Socialite::driver('google')->user();

        // Buscar usuario por email
        $user = User::where('email', $googleUser->getEmail())->first();

        if (!$user) {
            // Crear nuevo usuario con datos de Google
            $user = User::create([
                'name'              => $googleUser->getName(),
                'email'             => $googleUser->getEmail(),
                'password'          => bcrypt(Str::random(16)), // clave aleatoria
                'google_id'         => $googleUser->getId(),
                'avatar'            => $googleUser->getAvatar(),
                'email_verified_at' => now(), // marcar verificado
                'role'              => 'cliente', // por defecto
            ]);
        } else {
            // Actualizar datos si cambió algo
            $user->update([
                'google_id' => $googleUser->getId(),
                'avatar'    => $googleUser->getAvatar(),
            ]);

            // Marcar verificado si aún no lo está
            if (!$user->email_verified_at) {
                $user->update([
                    'email_verified_at' => now(),
                ]);
            }
        }

        // Loguear usuario
        Auth::login($user);

        // Redirigir según rol
        return $user->role === 'admin'
            ? redirect()->route('admin.index')->with('success', '¡Bienvenido administrador!')
            : redirect()->route('indexgeneral')->with('success', '¡Bienvenido de nuevo!');
    } catch (Exception $e) {
        Log::error('Error en callback de Google: ' . $e->getMessage());
        return redirect()->route('indexgeneral')
            ->with('error', 'Algo salió mal con Google Login.');
    }
}

}
