<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/signin.css" type='text/css' >
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css" type='text/css' >
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
    <title>Login</title>
</head>
<?php if ($this->session->userdata('message')) { ?>
    <div class="alert alert-danger alert-dismissible fade show" style="position:absolute;margin-top:-17rem;margin-left:34rem" role="alert">
        <strong><?php echo $this->session->userdata('message');?></strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
<?php } ?>

<body class="text-center">
    <form action="<?php echo base_url().'index.php/Login/auth'?>" method="post" class="form-signin">
        <img class="mb-4" src="<?php echo base_url(); ?>assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal">Graha Rajasa</h1>
        <div class="form-group">
            <input type="text" class="form-control" id="exampleFormControlInput1" name="username" placeholder="Masukan Username">
        </div>
        <div class="form-group">
            <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password" required>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    </form>
</body>
</html>