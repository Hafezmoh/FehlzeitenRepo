<style>
    #error_data {
        display: none;
    }

    #error_password {
        display: none;
    }
</style>
<?php
$same_name = $this->session->userdata('fail_name');
if (isset($same_name)) {
?>
<?php
}
$this->session->unset_userdata('fail_name');
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Admin Passwort ändern</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Verwaltung</li>
            </ol>
            <div class="card-body">
                <form class="form-card" id="update_pass_form" action="<?php echo base_url() ?>act_update_admin_pass" method="post">

                    <div class="row justify-content-between text-left" style="margin-top: 50px;">
                        <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">
                                Neues Passwort</label> <input type="password" id="passwort" name="passwort"></div>
                        <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">
                                Passwort Bestätigung</label> <input type="password" id="W_passwort" name="w_passwort"></div>
                    </div>

                    <div class="d-flex justify-content-center" style="margin-top: 50px;">
                        <div class="form-group "> <button type="button" onclick="check_neu_pass_data()" class="btn-block btn-primary">
                                Speichern</button> </div>
                    </div>
                </form>
                <br>
                <div id="error_data" class="alert alert-danger" role="alert">
                    <p id="error_msg"></p>
                </div>
            </div>
    </main>
    <script>
        function show_error(error) {
            $('#error_data').show();
            $('#error_msg').html(error);
        }

        function check_neu_pass_data() {

            var mit_passwort = document.getElementsByName('passwort')[0].value;
            var mit_passwort_w = document.getElementsByName('w_passwort')[0].value;


            if (mit_passwort.length <= 5) {
                show_error('Passwort ist zu kürz!! Das Passwort sollte mindestens 5 Zeichnen sein ');
            } else if (mit_passwort_w.length <= 5) {
                show_error('Passwort Bestätigung ist zu kürz!! Das Passwort sollte mindestens 5 Zeichnen sein');
            } else if (mit_passwort != mit_passwort_w) {
                show_error('Die eingegebenen Passwörter stimmen nicht überein');
                $('#error_password').hide();
            } else {
                $('#update_pass_form').submit();
            }
        }
    </script>