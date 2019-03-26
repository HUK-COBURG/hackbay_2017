<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Dashboard
 *
 * @author andre
 */
class Report extends CI_Controller {
    
    public function index() {
        $this->load->view('report');
    }
    
}
