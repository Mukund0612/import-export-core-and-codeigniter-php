<?php include 'function.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IMPORT & EXPORT CSV FILE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div>
            <h1 align="center" style="padding-top:50px">Improt csv File</h1>
        </div>
    </div>
    <div class="container pt-5">
        <form action="function.php" method="post" enctype="multipart/form-data">
            <label class="form-label" for="customFile"><strong>Select CSV file :</strong></label>
            <input type="file" name="file" class="form-control" id="customFile" />
            <center>
                <input type="submit" name="import" class="btn btn-primary" style="margin-top:20px;padding: 5px 45px;margin-bottom:20px;" value="Import Data">
            </center>
        </form>
    </div>
    <div class="container">
        <?php get_all_records(); ?>
    </div>
    <div class="container">
        <form action="function.php" method="post" enctype="multipart/form-data">
            <center>
                <input type="submit" name="export" class="btn btn-primary" style="margin-top:20px;padding: 5px 45px;margin-bottom:20px;" value="Export Data">
            </center>
        </form>
    </div>
    
</body>
</html>