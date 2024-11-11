@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'User Management'])

    <div class="row mt-4 mx-4">
        <div class="col-12">

            <div class="alert alert-light" role="alert">
                <strong> <a href="#" data-bs-toggle="offcanvas" data-bs-target="#registerOffcanvas" aria-controls="registerOffcanvas"> Registra </a> </strong> un nuevo usuario
            </div>

                <!-- Offcanvas para el formulario de registro -->
                <div class="offcanvas offcanvas-start" style="z-index:123123123;" data-bs-scroll="true" tabindex="-1" id="registerOffcanvas" aria-labelledby="registerOffcanvasLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="registerOffcanvasLabel">Registrar Usuario</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <!-- Formulario de registro -->
                        <form id="registerForm">
                            @csrf
                            <div class="mb-3">
                                <label for="username" class="form-label">Nombre de Usuario</label>
                                <input type="text" class="form-control" id="username" name="username" required value="{{ old('username') }}">
                                @error('username')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="firstname" class="form-label">Primer Nombre</label>
                                <input type="text" class="form-control" id="firstname" name="firstname" required value="{{ old('firstname') }}">
                                @error('firstname')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="lastname" class="form-label">Apellido</label>
                                <input type="text" class="form-control" id="lastname" name="lastname" required value="{{ old('lastname') }}">
                                @error('lastname')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="rol" class="form-label">Rol</label>
                                <input type="text" class="form-control" id="rol" name="rol" required value="{{ old('rol') }}">
                                @error('role')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Correo Electrónico</label>
                                <input type="email" class="form-control" id="email" name="email" required value="{{ old('email') }}">
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                                @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                                @error('password_confirmation')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="terms" name="terms" required>
                                <label class="form-check-label" for="terms">
                                    Acepto los <a href="#">términos y condiciones</a>
                                </label>
                                @error('terms')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-success mt-3">Registrar</button>
                        </form>
                    </div>
                </div>

                <div aria-live="polite" style="z-index:123123123;" aria-atomic="true" class="position-relative">
                    <div id="toastContainer" class="toast-container position-fixed bottom-0 end-0 p-3"></div>
                </div>

                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Usuarios</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">

                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-center">ID</th>
                                        <th class="text-center">Username</th>
                                        <th class="text-center">First Name</th>
                                        <th class="text-center">Last Name</th>
                                        <th class="text-center">Email</th>
                                        <th class="text-center">Rol</th>
                                        <th class="text-center">Address</th>
                                        <th class="text-center">City</th>
                                        <th class="text-center">Country</th>
                                        <th class="text-center">Postal Code</th>
                                        <th class="text-center">About</th>
                                        <th class="text-center">Created At</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                        <tr data-user-id="{{ $user->id }}">
                                            <td class="text-center ">{{ $user->id }}</td>
                                            <td class="text-center ">{{ $user->username }}</td>
                                            <td class="text-center firstname">{{ $user->firstname }}</td>
                                            <td class="text-center lastname">{{ $user->lastname }}</td>
                                            <td class="text-center email">{{ $user->email }}</td>
                                            <td class="text-center rol">{{ $user->rol }}</td>
                                            <td class="text-center address">{{ $user->address ?? '-' }}</td>
                                            <td class="text-center city">{{ $user->city ?? '-' }}</td>
                                            <td class="text-center country">{{ $user->country ?? '-' }}</td>
                                            <td class="text-center postalCode">{{ $user->postal ?? '-' }}</td>
                                            <td class="text-center about">{{ $user->about ?? '-' }}</td>
                                            <td class="text-center ">{{ $user->created_at }}</td>
                                            <td class="text-center ">
                                                <button class="btn btn-primary edit-btn" data-id="{{ $user->id }}" type="button" data-bs-toggle="offcanvas" data-bs-target="#editUserOffcanvas">Editar</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <!-- Offcanvas para la edición de usuario -->
                            <div class="offcanvas offcanvas-start" style="z-index:1212313;" data-bs-scroll="true" tabindex="-1" id="editUserOffcanvas" aria-labelledby="editUserOffcanvasLabel">
                                <div class="offcanvas-header">
                                    <h5 class="offcanvas-title" id="editUserOffcanvasLabel">Editar Usuario</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                </div>
                                <div class="offcanvas-body" id="offcanvas-content">
                                    <!-- Aquí se cargará dinámicamente el formulario de edición -->
                                    <p>Cargando...</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

<style>
.toast {
    opacity: 0.9;  /* Hace que la tostada tenga un fondo ligeramente translúcido */
    transition: opacity 0.5s ease-in-out; /* Añade una transición suave al desaparecer */
}
.toast-body {
    font-size: 1rem;
    font-weight: 500;
}
</style>

<script>

// Función para asignar el evento de edición a todos los botones
function assignEditButtonsEvents() {
    // Delegación de eventos para mejorar la eficiencia
    document.addEventListener('click', function (e) {
        if (e.target && e.target.classList.contains('edit-btn')) {
            const userRow = e.target.closest('tr');
            const userData = Array.from(userRow.querySelectorAll('td')).map(cell => cell.textContent);

            const [userId, username, firstName, lastName, email, rol, address, city, country, postalCode, about] = userData;

            // Prepara el formulario de edición con los valores actuales
            const formHTML = `
                <form id="editUserForm" method="POST" action="/user-update/${userId}">
                    @csrf
                    @method('PUT')
                    ${generateFormInput('username', 'Username', username)}
                    ${generateFormInput('firstname', 'First Name', firstName)}
                    ${generateFormInput('lastname', 'Last Name', lastName)}
                    ${generateFormInput('email', 'Email', email, 'email')}
                    ${generateFormInput('rol', 'Rol', rol)}
                    ${generateFormInput('address', 'Address', address)}
                    ${generateFormInput('city', 'City', city)}
                    ${generateFormInput('country', 'Country', country)}
                    ${generateFormInput('postalCode', 'Postal Code', postalCode)}
                    <div class="mb-3">
                        <label for="about" class="form-label">About</label>
                        <textarea class="form-control" id="about">${about}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar cambios</button>

                    </form>
                    <form method="POST" action="{{ route('user-delete', $user->id) }}" id="delete-form" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger" onclick="confirmDelete(${userId})">Eliminar definitivamente</button>
                    </form>

                `;

            document.getElementById('offcanvas-content').innerHTML = formHTML;

            // Agregar evento de envío del formulario
            const form = document.getElementById('editUserForm');
            form.addEventListener('submit', handleFormSubmit);
        }
    });
}

// Función para generar los inputs del formulario
function generateFormInput(id, label, value, type = 'text') {
    let block = ""
    if (label == "Username"){
        block = "disabled"
    }
    return `
        <div class="mb-3">
            <label for="${id}" class="form-label">${label}</label>
            <input type="${type}" class="form-control" id="${id}" value="${value}" ${block}>
        </div>
    `;
}

// Función para manejar el envío del formulario con datos JSON
function handleFormSubmit(event) {
    event.preventDefault(); // Evita el envío tradicional del formulario

    const form = event.target;
    const userId = form.action.split('/').pop(); // Extrae el ID de la URL de acción

    // Obtener y validar los valores de los campos obligatorios
    const data = {
        username: form.querySelector('#username').value.trim(),
        firstname: form.querySelector('#firstname').value.trim(),
        lastname: form.querySelector('#lastname').value.trim(),
        email: form.querySelector('#email').value.trim(),
        rol: form.querySelector('#rol').value.trim(),
        address: form.querySelector('#address').value.trim(),
        city: form.querySelector('#city').value.trim(),
        country: form.querySelector('#country').value.trim(),
        postal: form.querySelector('#postalCode').value.trim(),
        about: form.querySelector('#about').value.trim()
    };

    // Validar campos obligatorios en el frontend
    if (!data.username || !data.firstname || !data.lastname || !data.email || !data.rol) {
        showToast('error', 'Los campos Username, First Name, Last Name, Email y Rol son obligatorios.');
        return;
    }

    // Token CSRF desde el <meta> en el HTML
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Enviar datos como JSON al backend
    fetch(`/user-update/${userId}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(data => {
        
        showToast(data.success ? 'success' : 'error', data.message);

        if (data.success) {
            // alert("asfdas")
            console.log(data.user);
            
            updateTableRow(userId, data.user);

        }
    })
    .catch(error => {
        showToast('error', 'Error al contactar con el servidor');
    });
}

// Función para actualizar los datos en la tabla
function updateTableRow(userId, data) {
    // Refrescar la tabla antes de actualizar la fila específica

    const userRow = document.querySelector(`tr[data-user-id="${userId}"]`);
    console.log(userRow);
    
    if (userRow) {
        userRow.querySelector('.firstname').textContent = data.firstname;
        userRow.querySelector('.lastname').textContent = data.lastname;
        userRow.querySelector('.email').textContent = data.email;
        userRow.querySelector('.rol').textContent = data.rol;
        userRow.querySelector('.address').textContent = data.address;
        userRow.querySelector('.city').textContent = data.city;
        userRow.querySelector('.country').textContent = data.country;
        userRow.querySelector('.postalCode').textContent = data.postal;
        userRow.querySelector('.about').textContent = data.about;
    }
    
}

// Registramos un nuevo usuario
document.getElementById('registerForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Evita que el formulario se envíe de manera tradicional

    let formData = new FormData(this); // Obtiene los datos del formulario

    fetch("{{ route('register.perform') }}", {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest',  // Indica que es una solicitud AJAX
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showToast('success', data.message);  // Muestra la tostada de éxito
            addUserToTable(data.user)
            assignEditButtonsEvents();
        } else {
            // Mostrar errores solo para los campos fallidos
            let errorMessages = '';
            for (let field in response.data.errors) {
                errorMessages += `${field}: ${response.data.errors[field].join(', ')}<br>`;
            }
        showToast('error', errorMessages);  // Mostrar los errores de los campos fallidos
    }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('error', "Hubo un problema con el registro. Compruebe todos los campos");
    });
});

// Mostramos las tostadas con mensaje
function showToast(type, message) {
    const toastContainer = document.getElementById('toastContainer');
    const toast = document.createElement('div');
    toast.classList.add('toast');
    toast.classList.add('fade');
    toast.classList.add('show');
    
    // Agregar clases según el tipo
    if (type === 'success') {
        toast.classList.add('bg-success');
    } else if (type === 'error') {
        toast.classList.add('bg-danger');
    }

    toast.innerHTML = `
        <div class="toast-header">
            <strong class="me-auto">${type === 'success' ? 'Éxito' : 'Error'}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            ${message}
        </div>
    `;

    toastContainer.appendChild(toast);
    
    // Eliminar la tostada después de 7 segundos
    setTimeout(() => {
        toast.classList.remove('show');
        setTimeout(() => {
            toast.remove();
        }, 500);
    }, 7000);
}

// Función para añadir un nuevo usuario a la tabla
function addUserToTable(user) {

    const tableBody = document.querySelector('table tbody');
    
    const row = document.createElement('tr');
    row.setAttribute('data-user-id', user.id);
    row.innerHTML = `
        <td class="text-center">${user.id}</td>
        <td class="text-center">${user.username}</td>
        <td class="text-center firstname">${user.firstname}</td>
        <td class="text-center lastname">${user.lastname}</td>
        <td class="text-center email">${user.email}</td>
        <td class="text-center rol">${user.rol}</td>
        <td class="text-center address">${user.address || '-'}</td>
        <td class="text-center city">${user.city || '-'}</td>
        <td class="text-center country">${user.country || '-'}</td>
        <td class="text-center postalCode">${user.postal || '-'}</td>
        <td class="text-center about">${user.about || '-'}</td>
        <td class="text-center">${user.created_at.split('.')[0]}</td>
        <td class="text-center">
            <button class="btn btn-primary edit-btn" data-id="${user.id}" type="button" data-bs-toggle="offcanvas" data-bs-target="#editUserOffcanvas">Editar</button>
        </td>
    `;
    
    tableBody.appendChild(row);
}

// Manejo de la respuesta del formulario (llama a estas funciones)
function handleFormResponse(data) {
    if (data.success) {
        showToast('success', data.message);  // Mostrar la tostada de éxito
        addUserToTable(data.user);           // Agregar el nuevo usuario a la tabla
    } else {
        // Si hay errores, puedes manejarlo de otra forma (mostrar errores en el frontend, etc.)
        showToast('error', 'Hubo un problema al registrar el usuario.');
    }
}

// Confirmación doble para eliminación definitiva de un usuario
function confirmDelete(userId) {
    if (confirm('¿Estás seguro de que quieres eliminar este usuario permanentemente?')) {
        if (confirm('¡Esta acción no se puede deshacer! ¿Estás seguro?')) {
            // Obtener la URL del formulario            
            const row = document.querySelector(`[data-user-id="${userId}"]`);
            
            // Verificar que el token CSRF está disponible
            const csrfTokenElement = document.querySelector('meta[name="csrf-token"]');
            if (!csrfTokenElement) {
                console.error('No se encontró el token CSRF en el encabezado de la página.');
                return;
            }

            const csrfToken = csrfTokenElement.getAttribute('content');

            // Enviar la solicitud DELETE usando fetch
            fetch(`/user-delete/${userId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrfToken, // Asegúrate de incluir el token CSRF si es necesario
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Mostrar una tostada de éxito
                    showToast('success', data.message);

                    // Oculta la fila de la tabla del usuario que ha sido eliminado
                    row.style.display = 'none';
                } else {
                    // Mostrar una tostada de error si no fue exitoso
                    showToast('error', 'Hubo un problema al eliminar el usuario.');
                }
            })
            .catch(error => {
                // Mostrar una tostada de error si ocurre un error en la solicitud
                showToast('error', 'Hubo un error al realizar la solicitud.');
            });
        }
    }
}

assignEditButtonsEvents();
</script>
@endsection

