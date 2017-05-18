<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Overview extends CI_Controller {

	public function index()
	{
            $this->load->model('SensorModel');
            $this->load->model('SensorDataModel');
            
            $sensors = $this->SensorModel->get_active_sensors();
            $data['sensors'] = $sensors;

            $sensorData = array();
            foreach ($sensors as $sensor) {
                $sensorData[$sensor->get_SensorId()] = $this->SensorDataModel->get_sensor_data_from_to($sensor, time()-3600, time());
            }
            $data['data'] = $sensorData;
            
            $this->load->view('overview',$data);
	}
        
}