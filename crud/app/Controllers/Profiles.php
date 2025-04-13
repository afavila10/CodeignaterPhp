<?php

namespace App\Controllers;

use App\Models\ProfileModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;

class Profiles extends Controller
{
    private $primaryKey;
    private $ProfileModel;
    private $data;
    private $model;

    public function __construct()
    {
        $this->primaryKey    = "Profile_id";
        $this->ProfileModel  = new ProfileModel();
        $this->data          = [];
        $this->model         = "profiles";
    }

    public function index()
    {
        $this->data['title'] = "PROFILES";
        $this->data[$this->model] = $this->ProfileModel->orderBy($this->primaryKey, 'ASC')->findAll();
        return view('Profiles/Profiles_view', $this->data);
    }

    public function create()
    {
        if ($this->request->isAJAX()) {
            $dataModel = $this->getDataModel();
            if ($this->ProfileModel->insert($dataModel)) {
                $data['message']  = 'success';
                $data['response'] = ResponseInterface::HTTP_OK;
                $data['data']     = $dataModel;
                $data['csrf']     = csrf_hash();
            } else {
                $data['message']  = 'Error creating profile';
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

    public function singleProfile($id = null)
    {
        if ($this->request->isAJAX()) {
            if ($data[$this->model] = $this->ProfileModel->where($this->primaryKey, $id)->first()) {
                $data['message']  = 'success';
                $data['response'] = ResponseInterface::HTTP_OK;
                $data['csrf']     = csrf_hash();
            } else {
                $data['message']  = 'Profile not found';
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
                'Profile_email' => $this->request->getVar("Profile_email"),
                'Profile_name'  => $this->request->getVar("Profile_name"),
                'Profile_photo' => $this->request->getVar("Profile_photo"),
                'User_id_fk'    => $this->request->getVar("User_id_fk"),
                'update_at'     => $today
            ];
            if ($this->ProfileModel->update($id, $dataModel)) {
                $data['message']  = 'success';
                $data['response'] = ResponseInterface::HTTP_OK;
                $data['data']     = $dataModel;
                $data['csrf']     = csrf_hash();
            } else {
                $data['message']  = 'Error updating profile';
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
            if ($this->ProfileModel->where($this->primaryKey, $id)->delete($id)) {
                $data['message']  = 'success';
                $data['response'] = ResponseInterface::HTTP_OK;
                $data['data']     = "OK";
                $data['csrf']     = csrf_hash();
            } else {
                $data['message']  = 'Profile not found';
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
            'Profile_id'    => $this->request->getVar('Profile_id'),
            'Profile_email' => $this->request->getVar('Profile_email'),
            'Profile_name'  => $this->request->getVar('Profile_name'),
            'Profile_photo' => $this->request->getVar('Profile_photo'),
            'User_id_fk'    => $this->request->getVar('User_id_fk'),
            'create_at'     => $this->request->getVar('create_at'),
            'update_at'     => $this->request->getVar('update_at')
        ];
    }
}
