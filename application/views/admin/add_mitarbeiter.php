<style>
    #error_mitarbeiter {
        display: none;
    }

    #success_added {
        display: none;
    }

    #fail_added {
        display: none;
    }
</style>
<?php
$mit_added_success = $this->session->userdata('success');
if (isset($mit_added_success)) {
?>
    <style>
        #success_added {
            display: block;
        }
    </style>
<?php
}
$this->session->unset_userdata('success');
$mit_not_added = $this->session->userdata('fail');
if (isset($mit_not_added)) {
?>
    <style>
        #fail_added {
            display: block;
        }
    </style>
<?php
}
$this->session->unset_userdata('fail');
?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Mitarbeiter addieren</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Verwaltung</li>
            </ol>
            <div class="card-body">
                <form class="form-card" id="add_mitarbeiter_form" action="act_add_mitarbeiter" method="post">
                    <div class="row justify-content-between text-left">
                        <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">
                                Name</label> <input type="text" id="m_name" name="m_name"> </div>

                        <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">
                                Benutzername</label> <input type="text" id="b_name" name="b_name"> </div>
                    </div>
                    <div class="row justify-content-between text-left" style="margin-top: 50px;">
                        <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">
                                Passwort</label> <input type="text" id="passwort" name="passwort"> </div>

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
                    </div>
                    <div class="row justify-content-between text-left" style="margin-top: 50px;">
                        <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">
                                Als Admin hinzufügen?</label> <input type="checkbox" id="m_is_admin" value="1" name="m_is_admin">
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <div class="form-group "> <button type="button" onclick="check_mitarbeiter_data()" class="btn-block btn-primary">
                                Mitarbeiter addieren</button> </div>
                    </div>
                </form>
                <br><br>
                <div id="error_mitarbeiter" class="alert alert-danger" role="alert">
                    <p id="error_msg"></p>
                </div>
                <div id="success_added" class="alert alert-success" role="alert">
                    <p>Mitarbeiter wurde addiert</p>
                </div>
                <div id="fail_added" class="alert alert-danger" role="alert">
                    <p>Benuzername existiert schon!</p>
                </div>
            </div>
    </main>
    <script>
        function show_error(error) {
            $('#error_mitarbeiter').show();
            $('#error_msg').html(error);
            $('#success_added').hide();
            $('#fail_added').hide();
        }

        function check_mitarbeiter_data() {
            var mit_name = document.getElementsByName('m_name')[0].value;
            var mit_benutzer = document.getElementsByName('b_name')[0].value;
            var mit_passwort = document.getElementsByName('passwort')[0].value;
            var mit_m_abteilung = document.getElementsByName('m_abteilung')[0].value;
            var mit_admin = document.getElementsByName('m_is_admin')[0].value;

            if (mit_name.length == 0) {
                show_error('Mitarbeitername ist ungültig!!');
            } else if (mit_benutzer.length == 0) {
                show_error('Benutzername ist ungültig!!');
            } else if (mit_passwort.length <= 5) {
                show_error('Passwort ist zu kürz!! Das Passwort sollte mindestens 5 Zeichnen sein ');
            } else {
                $('#add_mitarbeiter_form').submit();
            }
        }
    </script>