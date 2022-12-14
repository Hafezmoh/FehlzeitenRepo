<style>
    #error_mitarbeiter {
        display: none;
    }

    #error_password {
        display: none;
    }

    #failed_edited {
        display: none;
    }
</style>

<?php
$same_name = $this->session->userdata('fail_name');
if (isset($same_name)) {
?>
    <style>
        #failed_edited {
            display: block;
        }
    </style>
<?php
}
$this->session->unset_userdata('fail_name');
?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <div class="row">
                <h1 class="mt-4">Mitarbeiter bearbeiten</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Verwaltung</li>
                </ol>
                <div class="card-body">
                    <form class="form-card" id="update_mitarbeiter_form" action="<?php echo base_url() ?>act_update_mitarbeiter" method="post">
                        <div class="row justify-content-between text-left">
                            <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">
                                    Name</label> <input type="text" id="m_name" name="m_name" value="<?php echo $get_mit_info_from_DB[0]['vorname'] ?>">
                            </div>

                            <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">
                                    Nachname</label> <input type="text" id="nach_name" name="nach_name" value="<?php echo $get_mit_info_from_DB[0]['nachname'] ?>"></div>
                        </div>

                        <div class="row justify-content-between text-left" style="margin-top: 50px;">

                            <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3" >
                                    Benutzername</label> <input type="text" id="b_name" name="b_name" value="<?php echo $get_mit_info_from_DB[0]['b_name'] ?>"></div>
                        </div>
                        <div class="row justify-content-between text-left" style="margin-top: 50px;">
                            <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">
                                    Passwort</label> <input type="password" id="passwort" name="passwort" autocomplete="new-password"></div>
                            <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">
                                    Passwort Best??tigung</label> <input type="password" id="W_passwort" name="w_passwort"></div>
                        </div>


                        <input type="hidden" name="mit_id" value="<?php echo $get_mit_info_from_DB[0]['id'] ?>">
                        <div class="d-flex justify-content-center" style="margin-top: 50px;">
                            <div class="form-group "> <button type="button" onclick="check_mitarbeiter_data()" class="btn-block btn-primary">
                                    Speichern</button> </div>
                        </div>
                    </form>
                    <br>
                    <div id="error_mitarbeiter" class="alert alert-danger" role="alert">
                        <p id="error_msg"></p>
                    </div>
                    <div id="failed_edited" class="alert alert-danger" role="alert">
                        <p>Benuztername exsitiert schon!</p>
                    </div>
                </div>

            </div>
    </main>
    <script>
        function show_error(error) {
            $('#error_mitarbeiter').show();
            $('#error_msg').html(error);
        }

        function check_mitarbeiter_data() {
            var mit_name = document.getElementsByName('m_name')[0].value;
            var mit_nachname = document.getElementsByName('nach_name')[0].value;
            var mit_benutzer = document.getElementsByName('b_name')[0].value;
            var mit_passwort = document.getElementsByName('passwort')[0].value;
            var mit_passwort_w = document.getElementsByName('w_passwort')[0].value;


            if (mit_name.length == 0) {
                show_error('Mitarbeitername ist ung??ltig!!');
            } else if (mit_nachname.length == 0) {
                show_error('Mitarbeiter Nachname ist ung??ltig!!');
            } else if (mit_benutzer.length == 0) {
                show_error('Benutzername ist ung??ltig!!');
            } else if (mit_passwort != mit_passwort_w) {
                show_error('Die eingegebenen Passw??rter stimmen nicht ??berein');
                $('#error_password').hide();
            } else {
                $('#update_mitarbeiter_form').submit();
            }
        }
    </script>