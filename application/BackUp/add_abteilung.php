<style>
    #error_abteilung {
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
$abt_added = $this->session->userdata('success');
if (isset($abt_added)) {
?>
    <style>
        #success_added {
            display: block;
        }
    </style>
<?php
}
$this->session->unset_userdata('success');
$abt_not_added = $this->session->userdata('fail');
if (isset($abt_not_added)) {
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
            <h1 class="mt-4">Abteilung addieren</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Verwaltung</li>
            </ol>
            <div class="card-body">

                <form class="form-card" id="add_abteilung_form" method="POST" action="send_new_abteilung">
                    <div class="row justify-content-between text-left">
                        <div class="form-group col-sm-6 flex-column d-flex">
                            <label class="form-control-label px-3">
                                Abteilungname </label> <input type="text" id="abt_name" name="abt_name">
                        </div>

                        <div class="form-group col-sm-6 flex-column d-flex" style="margin-top: 22px;">
                            <div class="form-group">
                                <button type="button" onclick="check_abteilung()" class="btn-block btn-primary">
                                    Abteilung addieren</button>
                            </div>
                        </div>
                    </div>
                </form>
                <br><br>
                <div id="error_abteilung" class="alert alert-danger" role="alert">
                    <p id="errro_msg"></p>
                </div>
                <div id="success_added" class="alert alert-success" role="alert">
                    <p>Abteilung wurde addiert</p>
                </div>
                <div id="fail_added" class="alert alert-danger" role="alert">
                    <p>Abteilungname existiert schon!</p>
                </div>
            </div>
    </main>
    <script>
        function show_error(error) {
            $('#error_abteilung').show();
            $('#errro_msg').html(error);
        }

        function check_abteilung() {
            var abteilung_name = document.getElementsByName('abt_name')[0].value;
            if (abteilung_name.length == 0) {
                show_error('Abteilung name ist ungültig!!');
            } else {
                $('#add_abteilung_form').submit();
            }
        }
    </script>