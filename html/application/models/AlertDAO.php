<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of MenuDTO
 *
 * @author andre
 */
class AlertDAO extends CI_Model  {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('AlertDTO');
    }
    
    public function getAllAlerts() {     
        $query = $this->db->get_where('alerts', array('active' => TRUE));
        $alerts = $query->result('AlertDTO');
        
        return $alerts;
    }
    
    public function getAlertsBySensor($sensor) {     
        $query = $this->db->get_where('alerts', array('sensor' => $sensor->getId()));
        $alerts = $query->result('AlertDTO');
        
        foreach($alerts as $alert) {
            $alert->setSensor($sensor);
        }
        
        return $alerts;
    }
    
}
