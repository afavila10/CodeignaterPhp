<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\RolesModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;

class Users extends Controller
{
    private $primaryKey;
    private $UsersModel;
    private $data;
    private $model;

    public function __construct()
    {
        $this->primaryKey   = "User_id";
        $this->UsersModel   = new UsersModel();
        $this->data         = [];
        $this->model        = "users";
    }

    public function index()
    {
        $this->data['title'] = "USERS";
        $this->data[$this->model] = $this->UsersModel->orderBy($this->primaryKey, 'ASC')->findAll();
        return view('Users/Users_view', $this->data);
    }

    public function create()
    {
        if ($this->request->isAJAX()) {
            $dataModel = $this->getDataModel();
            // 🛡️ Validación mínima
            if (empty($dataModel['User_user']) || empty($dataModel['User_password'])) {
                $data['message']  = 'Campos requeridos vacíos';
                $data['response'] = ResponseInterface::HTTP_BAD_REQUEST;
                $data['data']     = '';
                echo json_encode($data);
                return;
            }
            if ($this->UsersModel->insert($dataModel)) {
                $data['message']  = 'success';
                $data['response'] = ResponseInterface::HTTP_OK;
                $data['data']     = $dataModel;
                $data['csrf']     = csrf_hash();
            } else {
                $data['message']  = 'Error creating user';
                $data['response'] = ResponseInterface::HTTP_NO_CONTENT;
                $data['data']     = '';
            }
        } else {
            $data['message']  = 'Error Ajax';
            $data['response'] = ResponseInterface::HTTP_CONFLICT;
            $data['data']     = '';
        }
        echo json_encode($data);
    }

    public function singleUser($id = null)
    {
        if ($this->request->isAJAX()) {
            if ($data[$this->model] = $this->UsersModel->where($this->primaryKey, $id)->first()) {
                $data['message']  = 'success';
                $data['response'] = ResponseInterface::HTTP_OK;
                $data['csrf']     = csrf_hash();
            } else {
                $data['message']  = 'User not found';
                $data['response'] = ResponseInterface::HTTP_NO_CONTENT;
                $data['data']     = '';
            }
        } else {
            $data['message']  = 'Error Ajax';
            $data['response'] = ResponseInterface::HTTP_CONFLICT;
            $data['data']     = '';
        }
        echo json_encode($data);
    }

    public function update()
    {
        if ($this->request->isAJAX()) {
            $today = date("Y-m-d H:i:s");
            $id = $this->request->getVar($this->primaryKey);
            $dataModel = [
                'User_user'       => $this->request->getVar("User_user"),
                'User_password'   => $this->request->getVar("User_password"),
                'Roles_fk'        => $this->request->getVar("Roles_fk"),
                'User_status_fk'  => $this->request->getVar("User_status_fk"),
                'update_at'       => $today
            ];
            if ($this->UsersModel->update($id, $dataModel)) {
                $data['message']  = 'success';
                $data['response'] = ResponseInterface::HTTP_OK;
                $data['data']     = $dataModel;
                $data['csrf']     = csrf_hash();
            } else {
                $data['message']  = 'Error updating user';
                $data['response'] = ResponseInterface::HTTP_NO_CONTENT;
                $data['data']     = '';
            }
        } else {
            $data['message']  = 'Error Ajax';
            $data['response'] = ResponseInterface::HTTP_CONFLICT;
            $data['data']     = '';
        }
        echo json_encode($data);
    }

    public function delete($id = null)
    {
        try {
            if ($this->UsersModel->where($this->primaryKey, $id)->delete($id)) {
                $data['message']  = 'success';
                $data['response'] = ResponseInterface::HTTP_OK;
                $data['data']     = "OK";
                $data['csrf']     = csrf_hash();
            } else {
                $data['message']  = 'User not found';
                $data['response'] = ResponseInterface::HTTP_CONFLICT;
                $data['data']     = 'error';
            }
        } catch (\Exception $e) {
            $data['message']  = $e->getMessage();
            $data['response'] = ResponseInterface::HTTP_CONFLICT;
            $data['data']     = 'Error';
        }
        echo json_encode($data);
    }
    
    private function getDataModel()
    {
        return [
            'User_user'       => $this->request->getVar("User_user"),
            'User_password'   => $this->request->getVar("User_password"),
            'Roles_fk'        => $this->request->getVar("Roles_fk"),
            'User_status_fk'  => $this->request->getVar("User_status_fk"),
            'created_at'       => $this->request->getVar("created_at"),
            'updated_at'       => $this->request->getVar("updated_at"),
        ];
    }
} 