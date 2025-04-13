<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\RegisterModel;

class Register extends BaseController
{
    public function login()
    {
        return view('auth/login');
    }

    public function register()
    {
        return view('auth/register'); // Muestra el formulario
    }

    public function store() // Este método procesará el formulario
    {
        // Validación simple (puedes expandirla más adelante)
        $validation = \Config\Services::validation();

        $validation->setRules([
            'username' => 'required|min_length[3]',
            'password' => 'required|min_length[6]',
            'Role_fk' => 'required|integer',
            'User_Status_fk' => 'required|integer',
        ]);


        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('error', $validation->listErrors());
        }

        // Obtiene los datos del formulario
        $data = [
            'User_user' => $this->request->getPost('username'),
            'User_password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'Roles_fk' => $this->request->getPost('Role_fk'),
            'User_status_fk' => $this->request->getPost('User_Status_fk'),
        ];
        dd($data); // Esto imprimirá el array y detendrá la ejecución


        $model = new RegisterModel();
        $model->insert($data);

        return redirect()->to('auth/login')->with('success', 'Usuario registrado correctamente');
    }

    public function logout()
    {
        session()->destroy();
        //return redirect()->to('/auth/login');
    }
}
