<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
//$routes->get('/', 'Home::index');
// GROUP ROUTES
$routes->group("userStatus",function($routes){
    $routes->get("/", "UserStatus::index");
    $routes->get("show", "UserStatus::index");
    $routes->get("edit/(:num)", "UserStatus::singleUserStatus/$1");
    $routes->get("delete/(:num)", "UserStatus::delete/$1");
    $routes->post("add", "UserStatus::create");
    $routes->post("update", "UserStatus::update");
});

//ROUTES ROLES
$routes->group("roles", function($routes){
    $routes->get("/", "Role::index");              // Cuando entres a /roles cargarás el index (lista de roles)
    $routes->get("show", "Role::index");             // Por si deseas tener la ruta /roles/show
    $routes->get("edit/(:num)", "Role::singleRole/$1"); // Para editar, ej: /roles/edit/3
    $routes->get("delete/(:num)", "Role::delete/$1");   // Para eliminar, ej: /roles/delete/3
    $routes->post("add", "Role::create");            // Para agregar un rol (POST)
    $routes->post("update", "Role::update");         // Para actualizar un rol (POST)
});

//ROUTES PROFILES

$routes->group("profiles", function($routes){
    $routes->get("/", "Profiles::index");                   // Cuando entres a /profiles cargarás el index (lista de perfiles)
    $routes->get("show", "Profiles::index");                // Por si deseas tener la ruta /profiles/show
    $routes->get("edit/(:num)", "Profiles::singleProfile/$1"); // Para editar, ej: /profiles/edit/3
    $routes->get("delete/(:num)", "Profiles::delete/$1");      // Para eliminar, ej: /profiles/delete/3
    $routes->post("add", "Profiles::create");               // Para agregar un perfil (POST)
    $routes->post("update", "Profiles::update");            // Para actualizar un perfil (POST)
});


// ROUTES USERS
$routes->group("users", function($routes){
    $routes->get("/", "Users::index");                         // /users
    $routes->get("show", "Users::index");                      // /users/show
    $routes->get("edit/(:num)", "Users::singleUser/$1");       // /users/edit/3
    $routes->get("delete/(:num)", "Users::delete/$1");         // /users/delete/3
    $routes->post("add", "Users::create");                     // POST /users/add
    $routes->post("update", "Users::update");                  // POST /users/update
    $routes->get('roles/list', 'Role::getRoles'); // esta es la ruta AJAX

});

// LOGIN 
$routes->get('login', 'Auth::login');          // Muestra el formulario
$routes->post('login', 'Auth::loginPost');     // Procesa el login
$routes->get('logout', 'Auth::logout');        // Cierra sesión

// register 
$routes->get('register', 'Register::register');          // Muestra el formulario   // Cierra sesión
$routes->post('register/store', 'Register::store');


