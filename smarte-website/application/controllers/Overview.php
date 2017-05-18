<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Overview extends CI_Controller {

	public function index()
	{
            $this->load->model('SensorModel');
            $data['sensors'] = $this->SensorModel->get_active_sensors();
            
            $this->load->view('overview',$data);
	}
        
}