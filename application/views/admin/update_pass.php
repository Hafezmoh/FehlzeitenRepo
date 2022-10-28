<style>
    #error_data {
        display: none;
    }

    /* #success_edited {
        display: none;
    } */

    #error_password {
        display: none;
    }

    /* #failed_edited {
        display: none;
    } */
</style>

<?php

// $mit_updated = $this->session->userdata('success_updated');
// if (isset($mit_updated)) {
// 
?>
//
<!-- <style>
//         #success_edited {
//             display: block;
//         }
//     </style> -->
// <?php
    // }
    // $this->session->unset_userdata('success_updated');
    $same_name = $this->session->userdata('fail_name');
    if (isset($same_name)) {
    ?>
    <!-- <style>
        #failed_edited {
            display: block;
        }
    </style> -->
<?php
    }
    $this->session->unset_userdata('fail_name');
    // $pass = $this->session->userdata('wrong_pass');
    // if (isset($pass)) {
    // 
?>
//
<!-- <style>
//         #error_password {
//             display: block;
//         }
//     </style> -->
// <?php
    // }
    // $this->session->unset_userdata('wrong_pass');
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
                <!-- <div id="error_password" class="alert alert-danger" role="alert">
                    <p>Passwort neu eingeben</p>
                </div> -->
                <!-- <div id="success_edited" class="alert alert-success" role="alert">
                    <p>Änderungen wurden gespeichert</p>
                </div> -->
                <!-- <div id="failed_edited" class="alert alert-danger" role="alert">
                    <p>Benuztername exsitiert schon!</p>
                </div> -->
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