<style>
    #error_abteilung {
        display: none;
    }

    #success_edited {
        display: none;
    }
    #failed_edited {
        display: none;
    }
</style>
<?php
$success_updated = $this->session->userdata('abt_updated');
if (isset($success_updated)) {
?>
    <style>
        #success_edited {
            display: block;
        }
    </style>
<?php
}
$this->session->unset_userdata('abt_updated');
$failed_updated = $this->session->userdata('same_name');
if (isset($failed_updated)) {
?>
    <style>
        #failed_edited {
            display: block;
        }
    </style>
<?php
}
$this->session->unset_userdata('same_name');
?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Abteilung bearbeiten</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Verwaltung</li>
            </ol>
            <div class="card-body">

                <form class="form-card" id="edit_abteilung_form" method="POST" action="<?php echo base_url() ?>send_edited_abteilung">
                    <div class="row justify-content-between text-left">
                        <div class="form-group col-sm-6 flex-column d-flex">
                            <label class="form-control-label px-3">
                                Abteilungname </label> <input type="text" id="abt_name" name="abt_name" value="<?php echo $abteilungen_from_DB[0]['abt_name'] ?>">
                        </div>

                        <div class="form-group col-sm-6 flex-column d-flex" style="margin-top: 22px;">
                            <div class="form-group">
                                <button type="button" onclick="check_abteilung()" class="btn-block btn-primary">
                                    Speichern</button>
                            </div>
                        </div>
                        <input type="hidden" name="abteilung_id" value="<?php echo $abteilungen_from_DB[0]['abt_id'] ?>">
                    </div>
                </form>
                <br><br>
                <div id="error_abteilung" class="alert alert-danger" role="alert">
                    <p id="errro_msg"></p>
                </div>
                <div id="success_edited" class="alert alert-success" role="alert">
                    <p>Änderungen wurden gespeichert</p>
                </div>
                <div id="failed_edited" class="alert alert-danger" role="alert">
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
                $('#edit_abteilung_form').submit();
            }
        }
    </script>