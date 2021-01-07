<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php $this->comman->addcss('https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css'); ?>
    <title>Import & Export</title>
</head>
<body>
    <div class="container">
        <h1 align="center" style="margin: 45px 0px;">Import AND Export</h1>
        <form action="<?php echo base_url('index.php/ImportExport/import'); ?>" method="post" enctype="multipart/form-data">
            <input type="file" name="file" class="form-control">
            <center>
                <button type="submit" class="btn btn-primary" style="margin: 25px 0px;" name="import" value="import"> Import Data </button>
            </center>
        </form>
    </div>
    <div class="container">
        <?php $this->comman->getAllRecord(); ?>
    </div>
    <div class="container">
        <form action="<?php echo base_url('index.php/ImportExport/export'); ?>" method="post">
            <center>
                <button type="submit" class="btn btn-primary" style="margin: 25px 0px;" name="export" value="export" > Export Data </button>
            </center>
        </form>
    </div>

</body>
</html>