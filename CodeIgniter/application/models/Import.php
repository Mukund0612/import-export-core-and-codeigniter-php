<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Import extends CI_Model {
    
    private $data = "";

    public function __construct() {
        parent::__construct();
    }

    public function importData($data) {
        $ins = $this->db->insert('import', $data);
        return !empty($ins) ? $ins : '';
    }

    public function exportData() {
        
    }

    public function getAllRecord() {
        $query = $this->db->select('*')->get('import');
        if ($query->num_rows() > 0) {
            $query = $query->result_array();
            return !empty($query) ? $query : false ;
        } 
    }
}