<style>
    #error_mitarbeiter {
        display: none;
    }

    #success_edited {
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

$mit_updated = $this->session->userdata('success_updated');
if (isset($mit_updated)) {
?>
    <style>
        #success_edited {
            display: block;
        }
    </style>
<?php
}
$this->session->unset_userdata('success_updated');
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
$pass = $this->session->userdata('wrong_pass');
if (isset($pass)) {
?>
    <style>
        #error_password {
            display: block;
        }
    </style>
<?php
}
$this->session->unset_userdata('wrong_pass');
?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Mitarbeiter bearbeiten</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Verwaltung</li>
            </ol>
            <div class="card-body">
                <form class="form-card" id="update_mitarbeiter_form" action="<?php echo base_url() ?>act_update_mitarbeiter" method="post">
                    <div class="row justify-content-between text-left">
                        <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">
                                Name</label> <input type="text" id="m_name" name="m_name" value="<?php echo $get_mit_info_from_DB[0]['m_name'] ?>">
                        </div>

                        <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">
                                Benutzername</label> <input type="text" id="b_name" name="b_name" value="<?php echo $get_mit_info_from_DB[0]['m_benutzer'] ?>"></div>
                    </div>
                    <div class="row justify-content-between text-left" style="margin-top: 50px;">
                        <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">
                                Passwort</label> <input type="text" id="passwort" name="passwort"></div>
                        <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">
                                Passwort wiederholen</label> <input type="text" id="W_passwort" name="w_passwort"></div>
                    </div>
                    <div class="row justify-content-between text-left" style="margin-top: 50px;">
                        <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">
                                Abteilung</label>
                            <select name="m_abteilung" id="m_abteilung">
                                <?php
                                foreach ($abteilungen_from_DB as $abt) {
                                ?>
                                    <option value="<?php echo $abt['abt_id'] ?>"><?php echo $abt['abt_name'] ?>
                                    </option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">
                                Als Admin hinzufügen?</label> <input type="checkbox" id="m_is_admin" name="m_is_admin" <?php if ($get_mit_info_from_DB[0]['m_rule'] == 1) {
                                                                                                                        ?> checked <?php
                                                                                                                                }  ?> value="<?php echo $get_mit_info_from_DB[0]['m_rule'] ?>"></div>
                    </div>

                    <input type="hidden" name="mit_id" value="<?php echo $get_mit_info_from_DB[0]['m_id'] ?>">
                    <div class="d-flex justify-content-center" style="margin-top: 50px;">
                        <div class="form-group "> <button type="button" onclick="check_mitarbeiter_data()" class="btn-block btn-primary">
                                Speichern</button> </div>
                    </div>
                </form>
                <br>
                <div id="error_mitarbeiter" class="alert alert-danger" role="alert">
                    <p id="error_msg"></p>
                </div>
                <div id="error_password" class="alert alert-danger" role="alert">
                    <p>Passwort neu eingeben</p>
                </div>
                <div id="success_edited" class="alert alert-success" role="alert">
                    <p>Änderungen wurden gespeichert</p>
                </div>
                <div id="failed_edited" class="alert alert-danger" role="alert">
                    <p>Benuztername exsitiert schon!</p>
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
            var mit_benutzer = document.getElementsByName('b_name')[0].value;

            if (mit_name.length == 0) {
                show_error('Mitarbeitername ist ungültig!!');
            } else if (mit_benutzer.length == 0) {
                show_error('Benutzername ist ungültig!!');
            } else {
                $('#update_mitarbeiter_form').submit();
            }
        }
    </script>