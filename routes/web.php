<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MovieController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/saludo', function () {
    return 'Hola desde Laravel!';
});

Route::get('/saludos', function () {
    return 'Hola a todos!';
});

//Inyeccion de dependencias
//va como argumento de la funcion callback
Route::get('/users', function (Request $request) {
 // $request se resuelve en el controlador correspondiente
});

Route::get('/form', function () {
    return view('formulario');
});

//Redireccion de rutas
Route::redirect('/inicio', '/saludo', 301);

//Rutas de vistas
Route::view('/prueba', 'prueba', ['nombre' => 'Angel Marthans']);

//Rutas con parametros
Route::get('/users/{id}', function ($id) {
    return 'Usuario con id: ' . $id;
});

Route::get('/category/{cat}/product/{prod}', function ($idCat, $idProd) {
    return 'Category: ' . $idCat . "- Product: " . $idProd;
});

//rutas con inyeccion de dependencias y parametros
Route::get('/person/{id}', function ($id) {
    return 'Persona con id: ' . $id;
});

//rutas con parametros opcionales
Route::get('/persona/{name?}', function ($name = 'Sin nombre') {
    return 'Persona con nombre: ' . $name;
});

//Rutas con nombre
Route::get('user/profile', function () {
    return 'Pagina de perfil del usuario';
})->name('perfil');

/* Route::get('user/dashboard',
            [UserDashboardController::class, 'show']
           )->name('dashboard'); */

// Route Model Binding
//Enlace de ruta y modelo
Route::get('/usuarios/{user}', function (User $user) {
    return "Nombre: $user->name <br />Email: $user->email";
});

Route::get('/usuario/{id}', [UserController::class, 'show']);

//ruta especificando middleware de autenticacion de usuarios
Route::get('profile', [UserController::class, 'show'])->middleware('auth');

//ruta de recusros
Route::resource('/movies', MovieController::class);

//Grupo de rutas
Route::middleware(['auth', 'log'])->group(function () {
    Route::get('/', function () {
        // usa auth y luego log
    });

    Route::get('/user/profile', function () {
        // usa auth y luego log
    });
});

//agrupado por prefijo
Route::prefix('admin')->group(function () {

    Route::get('/users', function () {
        return 'ruta: /admin/users';
    });

    Route::get('/dashboard', function () {
        return 'ruta: /admin/dashboard';
    });

});
