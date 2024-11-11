<?php

// namespace App\Http\Controllers;

// // use App\Http\Requests\RegisterRequest;
// use App\Models\User;

// class RegisterController extends Controller
// {
//     public function create()
//     {
//         return view('auth.register');
//     }

//     public function store()
//     {
//         $attributes = request()->validate([
//             'username' => 'required|max:255|min:2',
//             'email' => 'required|email|max:255|unique:users,email',
//             'password' => 'required|min:5|max:255',
//             'terms' => 'required'
//         ]);
//         $user = User::create($attributes);
//         auth()->login($user);

//         return redirect('/dashboard');
//     }
// }
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        try {
            // Mensajes personalizados de error
            $messages = [
                'username.required' => 'El nombre de usuario es obligatorio',
                'username.string' => 'El nombre de usuario debe ser texto',
                'username.max' => 'El nombre de usuario no puede tener más de 255 caracteres',
                'firstname.required' => 'El nombre es obligatorio',
                'firstname.string' => 'El nombre debe ser texto',
                'firstname.max' => 'El nombre no puede tener más de 255 caracteres',
                'lastname.required' => 'El apellido es obligatorio',
                'lastname.string' => 'El apellido debe ser texto',
                'lastname.max' => 'El apellido no puede tener más de 255 caracteres',
                'rol.required' => 'El rol es obligatorio',
                'rol.string' => 'El rol debe ser texto',
                'rol.max' => 'El rol no puede tener más de 255 caracteres',
                'email.required' => 'El correo electrónico es obligatorio',
                'email.email' => 'El formato del correo electrónico no es válido',
                'email.unique' => 'Este correo electrónico ya está registrado',
                'password.required' => 'La contraseña es obligatoria',
                'password.string' => 'La contraseña debe ser texto',
                'password.confirmed' => 'Las contraseñas no coinciden',
                'terms.required' => 'Debes aceptar los términos y condiciones',
                'terms.accepted' => 'Debes aceptar los términos y condiciones',
            ];

            // Validar los datos del formulario con mensajes personalizados
            $validator = Validator::make($request->all(), [
                'username' => 'required|string|max:255',
                'firstname' => 'required|string|max:255',
                'lastname' => 'required|string|max:255',
                'rol' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|confirmed',
                'terms' => 'required|accepted',
            ], $messages);

            // Comprobar si la validación falló
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()->toArray(),
                    'message' => 'Error de validación'
                ], 422);
            }

            // Verificar si el usuario ya existe (doble verificación)
            if (User::where('email', $request->email)->exists()) {
                return response()->json([
                    'success' => false,
                    'errors' => ['email' => ['Este correo electrónico ya está registrado']],
                    'message' => 'Usuario ya existe'
                ], 409);
            }

            // Si la validación es exitosa, registrar al usuario
            $user = User::create([
                'username' => $request->username,
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'rol' => $request->rol,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Usuario registrado exitosamente.',
                'user' => $user
            ], 201);

        } catch (\Exception $e) {
            // Log del error para el administrador
            \Log::error('Error al registrar usuario: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Ha ocurrido un error al procesar el registro.',
                'errors' => ['general' => ['Error interno del servidor']]
            ], 500);
        }
    }
}


