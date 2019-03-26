<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Dashboard
 *
 * @author andre
 */
class Alerts extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        
        $this->load->model('AlertDAO');
        $this->load->model('SensorDAO');
        $this->load->model('MeasurementDAO');
    }
    
    public function notifications()
    {
        $sensors = $this->SensorDAO->getAllSensors();
        $data['alerts'] = array();
        
        foreach ($sensors as $sensor) {
            $this->MeasurementDAO->getLatestBySensor($sensor);
            $alert = $this->getSensorAlerts($sensor);
            if ($alert) {
                $data['alerts'][] = $alert;
            }
        }
        
        $this->load->view('notifications', $data);
    }
    
    public function dashboard_notifications()
    {
        $sensors = $this->SensorDAO->getAllSensors();
        $data['alerts'] = array();
        
        foreach ($sensors as $sensor) {
            $this->MeasurementDAO->getLatestBySensor($sensor);
            $alert = $this->getSensorAlerts($sensor);
            if ($alert) {
                $data['alerts'][] = $alert;
            }
        }
        
        $this->load->view('dashboard_notifications', $data);
    }
    
    private function getSensorAlerts($sensor) {
        $alerts = $this->AlertDAO->getAlertsBySensor($sensor);
            
        foreach ($alerts as $alert) {
            return $this->checkSensorAlert($sensor, $alert);
        }
        
        return false;
    }
    
    private function checkSensorAlert($sensor, $alert) {
        if (is_array($sensor->getMeasurements()) && count($sensor->getMeasurements()) > 0) {
            if (eval('return (' . $sensor->getMeasurements()[0]->getValue() . ' ' . $alert->getRelation() . ' ' . $alert->getValue() . ') ? true : false;')) {
                return $alert;
            }
        }
        
        return false;
    }
    
}
