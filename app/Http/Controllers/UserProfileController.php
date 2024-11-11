<?php
namespace App\Http\Controllers;

use App\Models\User;  // Asegúrate de importar el modelo User
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserProfileController extends Controller
{
    public function show()
    {
        return view('pages.user-profile');
    }

    public function controlUsers()
    {
        // Obtener todos los usuarios de la base de datos
        $users = User::all();

        // Imprimir los usuarios por pantalla
        // dd($users);
    
        // Pasar los usuarios a la vista
        return view('pages.user-management', compact('users'));
    }




    
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('partials.user-edit-form', compact('user'));
    }


    public function destroy($id)
    {
        $user = User::find($id);
    
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Usuario no encontrado.']);
        }
    
        $user->delete();
    
        return response()->json(['success' => true, 'message' => 'Usuario eliminado correctamente.', 'user' => $user]);
    }
    
    


    public function updateAdmin(Request $request)
    {
        // Validar los datos del formulario
        $attributes = $request->validate([
            'username' => ['required', 'max:255', 'min:2'],
            'firstname' => ['max:100'],
            'lastname' => ['max:100'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore(auth()->user()->id)],
            'address' => ['max:100'],
            'city' => ['max:100'],
            'country' => ['max:100'],
            'postal' => ['max:100'],
            'rol' => ['max:100'],
            'about' => ['max:255']
        ]);

        // Actualizar los datos del usuario autenticado
        auth()->user()->update($attributes);

        // Redirigir de vuelta con un mensaje de éxito
        return back()->with('success', 'Profile successfully updated');
    }

    public function update(Request $request, $id)
    {
        // return response()->json(['success' => true, 'message' => $request->firstname], 200);
        
        // Validar los datos del formulario
        $attributes = $request->validate([
            'firstname' => ['max:100'],
            'lastname' => ['max:100'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($id)], // El email debe ser único, excepto el actual
            'address' => ['max:100'],
            'city' => ['max:100'],
            'country' => ['max:100'],
            'postal' => ['max:100'],
            'role' => ['max:100'],
            'about' => ['max:255']
        ]);
    
        try {
            // Obtener el usuario a actualizar
            $user = User::findOrFail($id);
    
            // Actualizar los datos del usuario
            $user->update($attributes);
    
            // Retornar respuesta JSON con éxito
            return response()->json(['success' => true, 'message' => 'Usuario actualizado correctamente.', 'user' => $attributes], 200);
        } catch (\Exception $e) {
            // En caso de error, retornar un mensaje adecuado
            return response()->json(['success' => false, 'message' => 'Error al actualizar el usuario: ' . $e->getMessage()], 500);
        }
    }
    
}

