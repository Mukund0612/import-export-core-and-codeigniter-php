<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comman
{
    function addcss($filename)
    {
        echo "<link rel='stylesheet' href='" . $filename . "'>";
    }

    function getAllRecord(){
        $CI = & get_instance();
        $CI->load->model('import');
        $record = $CI->import->getAllRecord();
        if ($record) {
            echo "<div class='table-responsive'>
                <table id='myTable' class='table table-striped table-bordered'>
                <thead>
                <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
                </tr>
                </thead>
                <tbody>";
            foreach ($record as $row ) {
                echo "<tr>
                    <td>" . $row['id'] . "</td>
                    <td>" . $row['name'] . "</td>
                    <td>" . $row['email'] . "</td>";
            }

            echo " </tr> 
                </tbody>
                </table>
                </div>";
        } else {
            echo "No Record Found."; 
        }
    }
}
