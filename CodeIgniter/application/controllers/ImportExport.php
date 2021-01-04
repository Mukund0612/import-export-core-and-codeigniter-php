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
			if (isset($_POST['import'])) {
				
				// file is not empty
				if ($_FILES['file']['size'] > 0) {
					
					// get file Name
					$file_name = $_FILES['file']['tmp_name'];
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
			}
		}
	}

	public function export(){
		// check get data is method post or not
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			if ($this->input->post('export')) {
				header('Content-Type: text/csv; charset=utf-8');
				header('Content-Disposition: attachment; filename=newrecord.csv');
				$output = fopen("php://output", "w");
				fputcsv($output, array('ID', 'NAME', 'Email'));
				$this->load->model('import');
				$data = $this->import->getAllRecord();
				foreach ($data as $record) {
						fputcsv($output, $record);
				}
				fclose($output);
			}
		}
	}
}
