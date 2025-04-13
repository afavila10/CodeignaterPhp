<?php

/**
 * Author: DIEGO CASALLAS
 * Date: 08/04/2024
 * Descriptions: This is controller class for managing user state
 **/

// Is file namespace
namespace App\Controllers;

// These are the class that will be used in this controller
use App\Models\UserStatusModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;


//this is the users state class
class UserStatus extends Controller
{
    //Variable declarations.
    private $primaryKey;
    private $StatusModel;
    private $data;
    private $model;

    // This method is the constructor
    public function __construct()
	{
		$this->primaryKey   = "User_status_id";
    	$this->StatusModel  = new UserStatusModel();
    	$this->data         = [];
    	$this->model        = "userStatus";
	}

	// This method is the index, Started the view, set parameters for send the data in the view of the html render
	public function index()
	{
    	$this->data['title'] = "USER STATUS";
    
    	// Get data App\Models\UserStatusModel
    	$this->data[$this->model] = $this->StatusModel->orderBy($this->primaryKey, 'ASC')->findAll();
    	return view('userStatus/status_view', $this->data);
	}

	// This method consists of creating, obtains the data from the POST method, return Json
	public function create()
	{	
    	if ($this->request->isAJAX()) {
			$dataModel = $this->getDataModel();
			// Query Insert CodeIgniter
			if ($this->StatusModel->insert($dataModel)) {
				$data['message']  = 'success';
				$data['response'] = ResponseInterface::HTTP_OK;
				$data['data'] = $dataModel;
				$data['csrf'] = csrf_hash();
			} else {
				$data['message']  = 'Error create user';
				$data['response'] = ResponseInterface::HTTP_NO_CONTENT;
				$data['data'] = '';
			}
		} else {
			$data['message']  = 'Error Ajax';
        	$data['response'] = ResponseInterface::HTTP_CONFLICT;
        	$data['data'] = '';
    	}
		// Change array to Json
    	echo json_encode($dataModel);
	}
	// This method consists of single User Status, obtains id the data from the GET method, return Json
	public function singleUserStatus($id = null)
	{
		// Validate is ajax
		if ($this->request->isAJAX()) {
			// Select user status model
			if ($data[$this->model] = $this->StatusModel->where($this->primaryKey, $id)->first()) {
				$data['message']  = 'success';
            	$data['response'] = ResponseInterface::HTTP_OK;
            	$data['csrf'] = csrf_hash();
			} else {
				$data['message']  = 'Error create user';
            	$data['response'] = ResponseInterface::HTTP_NO_CONTENT;
            	$data['data'] = '';
        	}
		} else {
			$data['message']  = 'Error Ajax';
			$data['response'] = ResponseInterface::HTTP_CONFLICT;
			$data['data']     = '';
		}
		// Change array to Json
		echo json_encode($data);
	}
	// This method consists of update status, obtains id the data from the POST method, return Json
	public function update()
	{
		// Validate is ajax
		if ($this->request->isAJAX()) {
			$today = date("Y-m-d H:i:s");
			$id = $this->request->getVar($this->primaryKey);
        	$dataModel = [
				'User_status_name'=>$this->request->getVar("User_status_name"),
            	'User_status_description'=>$this->request->getVar("User_status_description"),
            	'update_at'=> $today
			];
        	// Update data model
        	if ($this->StatusModel->update($id, $dataModel)) {
            	$data['message']  = 'success';
            	$data['response'] = ResponseInterface::HTTP_OK;
            	$data['data'] = $dataModel;
            	$data['csrf'] = csrf_hash();
        	} else {
            	$data['message']  = 'Error create user';
            	$data['response'] = ResponseInterface::HTTP_NO_CONTENT;
            	$data['data'] = '';
        	}
    	} else {
        	$data['message']  = 'Error Ajax';
        	$data['response'] = ResponseInterface::HTTP_CONFLICT;
        	$data['data'] = '';
    	}
    	// Change array to Json
    	echo json_encode($dataModel);
	}
	// This method consists of delete status, obtains id the data from the GET method, return Json
	public function delete($id = null)
	{
		try {
			// Delete data model
        	if ($this->StatusModel->where($this->primaryKey, $id)->delete($id)) {
				$data['message']  = 'success';
            	$data['response'] = ResponseInterface::HTTP_OK;
            	$data['data'] = "OK";
            	$data['csrf'] = csrf_hash();
        	} else {
            	$data['message']  = 'Error Ajax';
            	$data['response'] = ResponseInterface::HTTP_CONFLICT;
            	$data['data'] = 'error';
       	 	}
		} catch (\Exception $e) {
        	$data['message']  = $e;
        	$data['response'] = ResponseInterface::HTTP_CONFLICT;
        	$data['data'] = 'Error';
    	}
    	// Change array to Json
    	echo json_encode($data);
	}
	//This method consists of create is model the data in the array associative, return Array
	public function getDataModel()
	{
		$data = [
			'User_status_id' => $this->request->getVar('User_status_id'),
			'User_status_name' =>$this->request->getVar('User_status_name'),
			'User_status_description' =>$this->request->getVar('User_status_description'),
			'update_at'=> $this->request->getVar('update_at')
		];
		return $data;
	}
	
}