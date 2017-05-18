<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Sensor
 *
 * @author andre
 */
class Sensor extends CI_Controller {
    
    public function index()
    {
        
    }
    
    public function show($name = null)
    {
        $this->load->model('SensorModel');
        
        $data['sensors'] = $this->SensorModel->get_active_sensors();
        
        $sensor = $this->SensorModel->get_sensor_by_name($name);
        if (!isset($sensor))
        {
            show_404();
        }
        else
        {
            $data['sensor'] = $sensor;
            
            $this->load->model('SensorDataModel');
            $data['data'] = $this->SensorDataModel->get_sensor_data_from_to($sensor, time()-3600, time());
            $data['sensors'] = $this->SensorModel->get_active_sensors();
        
            $this->load->view('sensor',$data);
        }
    }
    
}
