<?php 
include 'db.php';
$con = getdb();
// import data to database
if (isset($_POST['import'])) {
    $fileName = $_FILES['file']['tmp_name'];
    if ($_FILES['file']['size'] > 0) {
        $file = fopen($fileName, 'r');
        while (($getData = fgetcsv($file,1000,",")) !== FALSE) {
            $sql = "insert into `import` (name, email) VALUES ('".$getData[0]."', '".$getData[1]."')";
            $result = mysqli_query($con, $sql);
        }
        if (!isset($result)) {
            echo "<script type\"text/javascript\">
                alert(\"Invalid File: Pleace Upload CSV File.\");
                window.location=\"index.php\";
                </script>";
        } else {
            echo "<script type\"text/javascript\">
                alert(\"CSV File hase been Successfully Imported.\");
                window.location=\"index.php\";
                </script>";
        }
        fclose($fileName);
    } else {
        echo "<script type\"text/javascript\">
        alert(\"Invalid File: Pleace Select File.\");
        window.location=\"index.php\";
        </script>";
    }

}
// show all record to main page
function get_all_records() {
    $con = getdb();
    $sql = "SELECT * FROM import";
    $result = mysqli_query($con, $sql);
    if (mysqli_num_rows($result) > 0) {
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
        while ($row = mysqli_fetch_assoc($result)) {
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
// export database detail to csv file
if (isset($_POST['export'])) {
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=arecord.csv');
    $output = fopen("php://output", "w");
    fputcsv($output, array('ID','NAME','EMAIL'));
    $sql = "SELECT * FROM `import`";
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        fputcsv($output, $row);
    }
    fclose($output);
} 
?>
