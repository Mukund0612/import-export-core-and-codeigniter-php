<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ImportExport extends CI_Controller {

	public function index()
	{
		$this->load->view('index');
	}

	public function import(){
		// Sending file in using post
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			
			// button click event
			if ($this->input->post('import')) {

				// input field validation for type
				$this->form_validation->set_rules('file', '', 'required|callback_file_check');

				// file extension validation
				if ($this->form_validation->run() == true) {
					
					// file is not empty
					if ($_FILES['file']['size'] > 0) {
						
						// get file Name
						$file_name = $_FILES['file']['tmp_name'];

						//file open and readonly mod
						$file = fopen($file_name, "r");

						// load model to inset record
						$this->load->model('import');
						
						// insert data to databse
						while (($getData = fgetcsv($file, 1000 , ",")) !== false) {
								// pass data in model
								@$data = array(
									'name' => $getData[0],
									'email' => $getData[1]
								);

								// insert data to database
								$ins = $this->import->importData($data);
						}
						// if data insert successull then
						if (isset($ins)) {

							echo "<script type\"text/javascript\"> alert(\"File Upload Successfully import.\"); window.location=\"index\"; </script>";	
						} else {

							echo "<script type\"text/javascript\"> alert(\"Invalid File: Please Select CSV File.\"); window.location=\"index\"; </script>";
						}
					} else {
						
						echo "<script type\"text/javascript\"> alert(\"Invalid File: Please Select CSV File.\"); window.location=\"index\"; </script>";
					}
				} else {
					echo "<script type\"text/javascript\"> alert(\"Invalid File: Please Select CSV File.\"); window.location=\"index\"; </script>";
				}
			}
		}
	}

	public function export(){
		// check get data is method post or not
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {

			// export button click event
			if ($this->input->post('export')) {

				// file type
				header('Content-Type: text/csv; charset=utf-8');
				// file desposition
				header('Content-Disposition: attachment; filename=newrecord.csv');
				// open file on write mode
				$output = fopen("php://output", "w");
				// put first line
				fputcsv($output, array('ID', 'NAME', 'Email'));
				// load model
				$this->load->model('import');
				// fetch all data from import table
				$data = $this->import->getAllRecord();
				// put all data in csv file
				foreach ($data as $record) {
						fputcsv($output, $record);
				}
				// close file
				fclose($output);
			}
		}
	}

	/*
     * file value and type check during validation
     */
	public function file_check($string)
	{
		$allowed_mime_type_array = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
		$mime = get_mime_by_extension($_FILES['file']['name']);
		if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != "") {
			if (in_array($mime, $allowed_mime_type_array)) {
				return true;
			} else {
				$this->form_validation->set_message('file_check', 'Please select CSV file.');
				return false;
			}
		}
	}
}
