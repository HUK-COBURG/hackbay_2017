<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Dashboard
 *
 * @author andre
 */
class Measurement extends CI_Controller {
    
    public function __construct() {
        parent::__construct();

        $this->load->model('SensorDAO');
        $this->load->model('MeasurementDAO');
    }
    
    public function chart($id, $interval) {
        $sensor = $this->SensorDAO->getSensorById($id);
        $measurements = $this->MeasurementDAO->getPastSecondsBySensor($sensor, $interval);
        
        $graphset = array();
        $graphset['type'] = 'line';
        $graphset['scale-x']['transform']['type'] = 'date';
        $graphset['scale-x']['transform']['all'] = '%H:%i';
        $graphset['scale-x']['transform']['item']['visible'] = false;
        
        $series = array();
        foreach ($measurements as $measurement) {
            $series['values'][] = array($measurement->getTime() * 1000, floatval($measurement->getValue()));
        }
        $series['line-color'] = '#9d54ff';
        $series['line-width'] = 1;
        $series['marker']['background-color'] = '#6e00ff';
        $series['marker']['size'] = 3;
        $series['marker']['border-color'] = '#6e00ff';
        
        $graphset['series'][] = $series;
        
        $data = array();
        $data['graphset'][] = $graphset;
        
        echo json_encode($data);
    }
    
    public function hour($id) {
        $sensor = $this->SensorDAO->getSensorById($id);
        $measurements = $this->MeasurementDAO->getPastSecondsBySensor($sensor, 3600);
        
        $graphset = array();
        $graphset['type'] = 'line';
        //$graphset['plot']['line-width'] = 1;
        //$graphset['scale-x']['max-items'] = 10;
        //$graphset['scale-x']['min-value'] = (time() - 86400) * 1000;
        $graphset['scale-x']['transform']['type'] = 'date';
        $graphset['scale-x']['transform']['all'] = '%H:%i';
        $graphset['scale-x']['transform']['item']['visible'] = false;
        
        $series = array();
        foreach ($measurements as $measurement) {
            $series['values'][] = array($measurement->getTime() * 1000, floatval($measurement->getValue()));
        }
        $series['line-color'] = '#9d54ff';
        $series['line-width'] = 1;
        $series['marker']['background-color'] = '#6e00ff';
        $series['marker']['size'] = 3;
        $series['marker']['border-color'] = '#6e00ff';
        
        $graphset['series'][] = $series;
        
        $data = array();
        $data['graphset'][] = $graphset;
        
        echo json_encode($data);
    }
    
}
