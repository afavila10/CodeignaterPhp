<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        //return view('auth/login');
        return view('auth/login');
    }

    public function loginPost()
    {
        $session = session();
        $model = new UserModel();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $model->where('User_user', $username)->first();

        if ($user) {
            if (password_verify($password, $user['User_password'])) {
                // Guardar en sesión
                $session->set([
                    'user_id' => $user['User_id'],
                    'username' => $user['User_user'],
                    'isLoggedIn' => true
                ]);
                return redirect()->to('/status_view'); // Cambia esto por tu vista principal
            } else {
                return redirect()->back()->with('error', 'Contraseña incorrecta');
            }
        } else {
            return redirect()->back()->with('error', 'Usuario no encontrado');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/auth/login');
    }
}
