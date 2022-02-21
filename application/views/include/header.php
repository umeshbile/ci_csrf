<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <base href="<?php echo base_url(); ?>">
    <script type="text/javascript" src="assets/jquery/dist/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/datatables/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="assets/font-awesome/css/font-awesome.min.css">

    <script src="assets/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="assets/js/bootstrap-notify.min.js"></script>
    <script type="text/javascript" src="assets/js/notify_helper.js"></script>
    <script src="assets/popper/dist/popper.js"></script>
    <script src="assets/bootstrap/dist/js/bootstrap.bundle.js"></script>
    
    <script src="assets/js/custom.js"></script>
    <script>
      var base_url = window.location.origin+"/ci_csrf/";
      var CFG = {
          token: '<?php echo $this->security->get_csrf_hash();?>'
      };
     
    </script>
    <script src="assets/js/create.js"></script>
    <script src="assets/js/update.js"></script>
    <script src="assets/js/delete.js"></script>
    <style>
      body {
        padding-top: 54px;
      }
      @media (min-width: 992px) {
        body {
          padding-top: 56px;
        }
      }
      .dropdown-menu {
        cursor: pointer;
      }

    </style>
</head>
<body>
<div class="container">

