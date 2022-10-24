<style>
    #success_edited {
        display: none;
    }
</style>

<?php
$time_added = $this->session->userdata('time_added');
if (isset($time_added)) {
?>
    <style>
        #success_edited {
            display: block;
        }
    </style>
<?php
}
$this->session->unset_userdata('time_added');
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Arbeitzeiten bearbeiten</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Edit</li>
            </ol>

            <form id="update_time_form" method="POST" action="<?php echo base_url() ?>ref_update_time">
                <div class="row">

                    <div class="form-group col-6 flex-column d-flex"> <label class="form-control-label px-3">
                            Datum </label> <input type="date" id="pro_date" name="pro_date" value="<?php echo $get_aufgabe_from_DB[0]['auf_datum'] ?>">
                    </div>
                </div>
                <div class="row" style="margin-top: 50px;">

                    <div class="form-group col-sm-6 flex-column d-flex">
                        <label class="form-control-label px-3">
                            Anfangzeit
                        </label>
                        <input type="time" id="start_time" name="start_time" value="<?php echo $get_aufgabe_from_DB[0]['auf_start_zeit'] ?>">
                    </div>

                    <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">
                            Endezeit</label> <input type="time" id="end_time" name="end_time" value="<?php echo $get_aufgabe_from_DB[0]['auf_ende_zeit'] ?>">
                    </div>
                </div>

                <input type="hidden" name="auf_id" value="<?php echo $get_aufgabe_from_DB[0]['auf_id'] ?>">

                <div class="d-flex justify-content-center">
                    <div class="form-group">
                        <button type="submit" class="btn-block btn-primary" style="margin-top: 50px;">
                            Speichern</button>
                    </div>
                </div>
            </form>
            <br>
            <div id="success_edited" class="alert alert-success" role="alert">
                <p>Änderungen wurden gespeichert</p>
            </div>

        </div>
    </main>