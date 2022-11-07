<?php
if (isset($error)) {
?>
  <style>
    #login_fail {
      display: block !important;
    }
  </style>
<?php
}
?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="<?php echo base_url() ?>assets/login/fonts/icomoon/style.css">

  <link rel="stylesheet" href="<?php echo base_url() ?>assets/login/css/owl.carousel.min.css">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/login/css/bootstrap.min.css">

  <!-- Style -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/login/css/style.css">

  <title>Login #8</title>
</head>

<body>
  <div class="content">
    <div class="container">
      <div class="row">
        <div class="col-md-6 order-md-2">
          <img src="<?php echo base_url() ?>assets/login/images/undraw_file_sync_ot38.svg" alt="Image" class="img-fluid">
        </div>
        <div class="col-md-6 contents">
          <div class="row justify-content-center">
            <div class="col-md-8">
              <div class="mb-4">
                <h3>Registrieren Sie Sich zu <strong>Fehlzeiterfassung</strong></h3>
                <p class="mb-4">Erfassen Sie Ihre Fehlzeiten.</p>
              </div>
              <form action="userlogin" method="post">
                <div class="form-group first">
                  <label for="Benutzername"></label>
                  <input type="text" class="form-control" id="username" name="username" placeholder="Benutzername">
                </div>
                <div class="form-group last mb-4">
                  <label for="Passwort"></label>
                  <input type="password" class="form-control" id="password" name="password" placeholder="Passwort" autocomplete="new-password">
                </div>
                <input type="submit" value="Log In" class="btn text-white btn-block btn-primary">
              </form>
              <br><br>
              <div id="login_fail" class="alert alert-danger" role="alert" style="display: none;">
                <p>Benuzername oder Passwort ist falsch!</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>
</body>

</html>