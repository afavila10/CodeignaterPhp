<?php

namespace App\Controllers;

use App\Models\RoleModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;

class Role extends Controller
{
    private $primaryKey;
    private $RoleModel;
    private $data;
    private $model;

    public function __construct()
    {
        $this->primaryKey  = "Roles_id";
        $this->RoleModel   = new RoleModel();
        $this->data        = [];
        $this->model       = "roles";
    }

    public function index()
    {
        $this->data['title'] = "ROLES";
        $this->data[$this->model] = $this->RoleModel->orderBy($this->primaryKey, 'ASC')->findAll();
        return view('roles/roles_view', $this->data);
    }

    public function create()
    {
        if ($this->request->isAJAX()) {
            $dataModel = $this->getDataModel();
            if ($this->RoleModel->insert($dataModel)) {
                $data['message']  = 'success';
                $data['response'] = ResponseInterface::HTTP_OK;
                $data['data']     = $dataModel;
                $data['csrf']     = csrf_hash();
            } else {
                $data['message']  = 'Error creating role';
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

    public function singleRole($id = null)
    {
        if ($this->request->isAJAX()) {
            if ($data[$this->model] = $this->RoleModel->where($this->primaryKey, $id)->first()) {
                $data['message']  = 'success';
                $data['response'] = ResponseInterface::HTTP_OK;
                $data['csrf']     = csrf_hash();
            } else {
                $data['message']  = 'Role not found';
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
                'Roles_name'        => $this->request->getVar("Roles_name"),
                'Roles_description' => $this->request->getVar("Roles_description"),
                'update_at'         => $today
            ];
            if ($this->RoleModel->update($id, $dataModel)) {
                $data['message']  = 'success';
                $data['response'] = ResponseInterface::HTTP_OK;
                $data['data']     = $dataModel;
                $data['csrf']     = csrf_hash();
            } else {
                $data['message']  = 'Error updating role';
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
            if ($this->RoleModel->where($this->primaryKey, $id)->delete($id)) {
                $data['message']  = 'success';
                $data['response'] = ResponseInterface::HTTP_OK;
                $data['data']     = "OK";
                $data['csrf']     = csrf_hash();
            } else {
                $data['message']  = 'Role not found';
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
            'Roles_id'          => $this->request->getVar('Roles_id'),
            'Roles_name'        => $this->request->getVar('Roles_name'),
            'Roles_description' => $this->request->getVar('Roles_description'),
            'create_at'         => $this->request->getVar('create_at'),
            'update_at'         => $this->request->getVar('update_at')
        ];
    }

    public function getRoles()
    {
        if ($this->request->isAJAX()) {
            $roles = $this->RoleModel->findAll();
            return $this->response->setJSON($roles);
        }   
    }
}
