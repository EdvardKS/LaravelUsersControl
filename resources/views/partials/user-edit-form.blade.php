@auth
    <form method="POST" action="{{ route('user-update', $user->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" value="{{ $user->username }}" required>
        </div>
        
        <div class="mb-3">
            <label for="firstname" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="firstname" name="firstname" value="{{ $user->firstname }}">
        </div>
        
        <div class="mb-3">
            <label for="lastname" class="form-label">Apellidos</label>
            <input type="text" class="form-control" id="lastname" name="lastname" value="{{ $user->lastname }}">
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>
        </div>

        <div class="form-group">
            <label for="role">Rol</label>
            <input type="text" name="role" id="role" class="form-control" value="{{ old('role', $user->rol) }}">
        </div>

        <div class="form-group">
            <label for="address">Dirección</label>
            <input type="text" name="address" id="address" class="form-control" value="{{ old('address', $user->address) }}">
        </div>

        <div class="form-group">
            <label for="city">Ciudad</label>
            <input type="text" name="city" id="city" class="form-control" value="{{ old('city', $user->city) }}">
        </div>

        <div class="form-group">
            <label for="country">País</label>
            <input type="text" name="country" id="country" class="form-control" value="{{ old('country', $user->country) }}">
        </div>

        <div class="form-group">
            <label for="postal">CP</label>
            <input type="text" name="postal" id="postal" class="form-control" value="{{ old('postal', $user->postal) }}">
        </div>

        <div class="form-group">
            <label for="about">Destalles</label>
            <textarea name="about" id="about" class="form-control">{{ old('about', $user->about) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Guardar cambios</button>
    </form>


    <!-- Formulario para eliminar el usuario -->
    <form method="POST" action="{{ route('user-delete', $user->id) }}" id="delete-form" style="display: inline;">
        @csrf
        @method('DELETE')
        <button type="button" class="btn btn-danger" onclick="confirmDelete()">Eliminar definitivamente</button>
    </form>

@endauth