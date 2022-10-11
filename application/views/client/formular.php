<?php
// var_dump($users_array)
?>
<style>
    #success_added {
        display: none;
    }
</style>

<?php
$deleted = $this->session->userdata('time_added');
if (isset($deleted)) {
?>
    <style>
        #success_added {
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
            <h1 class="mt-4">Fehlzeit addieren</h1>
            <h2 class="mt-4"><?= date("l-Y-M-d") ?></h2>
            <form id="add_fehlzeit" method="POST" action="act_add_fehlzeit">
                <div class="row">
                    <div class="form-group col-6 flex-column d-flex">
                        <label class="form-control-label px-3">
                            Name</label>
                        <select name="name" id="name_id">
                            <?php
                            foreach ($users_array as $value) {
                            ?>
                                <option value="id">
                                    <?php
                                    echo $value['vorname'] . " " . $value['nachname']
                                    ?>
                                </option>
                            <?php
                            }
                            ?>
                        </select>
                        <!-- <input type="text" value="<?= $this->session->userdata('user_vorname_session') ?>"> -->
                    </div>
                    <div class="form-group col-6 flex-column d-flex">
                        <label class="form-control-label px-3">
                            Gemeldet durch</label>
                        <input type="text" value="<?= $this->session->userdata('user_vorname_session') . " " . $this->session->userdata('user_nachname_session') ?>" disabled>
                    </div>
                    <h2>Grund der Abwesenheit</h2>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="radio" id="radioid" value="1" checked>
                        <label class="form-check-label" for="flexRadioDefault1">
                            Krankheit
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="radio" id="radioid" value="2">
                        <label class="form-check-label" for="flexRadioDefault2">
                            Arztbesuch
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="radio" id="radioid" value="3">
                        <label class="form-check-label" for="flexRadioDefault2">
                            Sonstiges:
                        </label>
                    </div>
                    <div class="form-group col-6 flex-column d-flex"> <label class="form-control-label px-3" id="label_id" style="display: none;">
                            Bitte schreiben Sie eine kürze Erklärung: </label> <input type="text" id="note_id" name="note" style="display: none;">
                    </div>
                    <div>

                    </div>
                    <div class="form-group col-6 flex-column d-flex"> <label class="form-control-label px-3">
                            Abwesend von: </label> <input type="date" id="von_date_id" name="von_date">
                    </div>
                    <div class="form-group col-6 flex-column d-flex"> <label class="form-control-label px-3">
                            bis vorraussichtlich: </label> <input type="date" id="bis_date_id" name="bis_date">
                    </div>
                </div>
                <div class="row" style="margin-top: 50px;">

                    <div class="form-group col-sm-6 flex-column d-flex">
                        <label class="form-control-label px-3">
                            ..
                        </label>
                        <input type="time" id="von_uhr_id" name="von_uhr" value="<?php echo date('H:i') ?>">
                    </div>

                    <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">
                            ..</label> <input type="time" id="bis_uhr_id" name="bis_uhr">
                    </div>
                </div>



                <div class="d-flex justify-content-center">
                    <div class="form-group">
                        <button type="submit" class="btn-block btn-primary" style="margin-top: 50px;">
                            Jetzt absenden</button>
                    </div>
                </div>
                <br><br>
                <div id="success_added" class="alert alert-success" role="alert">
                    <p>Fehlzeit wurde hinzufügt</p>
                </div>

            </form>

        </div>
    </main>


    <script>
        $(function() {
            $('input[name="radio"]').on('click', function() {
                if ($(this).val() == '3') {
                    $('#label_id').show();
                    $('#note_id').show();

                    // $('#packageList').show();
                } else {
                    $('#label_id').hide();
                    $('#note_id').hide();
                }
            });
        });

        document.getElementById('pro_date').valueAsDate = new Date();
    </script>