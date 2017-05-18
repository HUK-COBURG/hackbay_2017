<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Ajax
 *
 * @author andre
 */
class Ajax extends CI_Controller {
    
    public function index()
    {
        show_404();
    }
    
    public function messages($name = null)
    {
        echo 'hier';
        
        $this->load->model('SensorModel');
        $this->load->model('SensorDataModel');
        $this->load->model('SchwellwertModel');
        
        
        $sensor = $this->SensorModel->get_sensor_by_name('Temperatur');
        $current = $this->SensorDataModel->get_last_data($sensor);
        $schwellwerte = $this->SchwellwertModel->get_schwellwerte($sensor);
       
        var_dump($sensor);
        var_dump($current);
        var_dump($schwellwerte);
    }
    
}
