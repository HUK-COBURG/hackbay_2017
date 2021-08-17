<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Schaden
 *
 * @author andre
 */
class Schaden extends CI_Controller {
    
    public function index()
    {
        $this->load->model('SensorModel');

        $sensors = $this->SensorModel->get_active_sensors();
        $data['sensors'] = $sensors;
        
        $this->load->view('schaden',$data);
    }
    
}
