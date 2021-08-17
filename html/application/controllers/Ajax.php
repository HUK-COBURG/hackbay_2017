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
        $data = array();
        
        $this->load->model('SensorModel');
        $this->load->model('SensorDataModel');
        $this->load->model('SchwellwertModel');
        
        if (!isset($name)) {
            $sensors = $this->SensorModel->get_active_sensors();
        } else {
            $sensors[] = $this->SensorModel->get_sensor_by_name($name);
        }    
            
        foreach ($sensors as $sensor) { 
            $current = $this->SensorDataModel->get_last_data($sensor);
            $schwellwerte = $this->SchwellwertModel->get_schwellwerte($sensor);

            foreach ($schwellwerte as $schwellwert) {
                $add = false;

                switch ($schwellwert->get_SchwellwertVergleich()) {
                    case '>':
                        $add = ($current->get_SensorWert() > $schwellwert->get_SchwellwertWert()) ? TRUE : FALSE;
                        break;
                    case '<':
                        $add = ($current->get_SensorWert() < $schwellwert->get_SchwellwertWert()) ? TRUE : FALSE;
                        break;
                    case '>=':
                        $add = ($current->get_SensorWert() >= $schwellwert->get_SchwellwertWert()) ? TRUE : FALSE;
                        break;
                    case '<=':
                        $add = ($current->get_SensorWert() <= $schwellwert->get_SchwellwertWert()) ? TRUE : FALSE;
                        break;
                    case '=':
                        $add = ($current->get_SensorWert() == $schwellwert->get_SchwellwertWert()) ? TRUE : FALSE;                    
                        break;
                }

                if ($add) {
                    $data['messages'][] = array(
                        'id' => $sensor->get_SensorID(),
                        'name' => $sensor->get_SensorBezeichnung(),
                        'level' => $schwellwert->get_SchwellwertLevel(),
                        'text' => $schwellwert->get_SchwellwertText()
                    );
                }
            }
        }
        
        echo json_encode($data);
    }
    
}
