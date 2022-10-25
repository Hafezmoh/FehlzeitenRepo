<?php
// var_dump($users_array)
?>
<style>
    #success_added {
        display: none;
    }

    #error_formular {
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
            <form id="add_fehlzeit_form" method="POST" action="act_add_fehlzeit">
                <div class="row">
                    <div class="form-group col-6 flex-column d-flex">
                        <label class="form-control-label px-3">
                            Name</label>
                        <select name="name" id="name_id">
                            <?php
                            foreach ($users_array as $value) {
                            ?>
                                <option>
                                    <?php
                                    echo $value['vorname'] . " " . $value['nachname']
                                    ?>
                                </option>
                            <?php
                            }
                            ?>
                            <input type="hidden" name="name_id" value="<?php echo $value['id'] ?>">
                        </select>
                    </div>
                    <div class="form-group col-6 flex-column d-flex">
                        <label class="form-control-label px-3">
                            Gemeldet durch</label>
                        <input type="text" value="<?= $this->session->userdata('user_name_session') ?>" disabled>
                    </div>
                    <h2>Grund der Abwesenheit</h2>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="radio" id="radioid" value="1">
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
                        <br>
                    </div>
                    <div class="form-group col-6 flex-column d-flex"> <label class="form-control-label px-3" id="label2_id" style="display: none;">
                            Bitte unbedingt eine Bescheinigung einfordern und unverzüglich an AW schicken. </label>
                    </div>
                    <div>

                    </div>
                    <div class="form-group col-6 flex-column d-flex"> <label class="form-control-label px-3">
                            Abwesend von: </label> <input type="date" id="von_date_id" name="von_date" value="<?php echo (new DateTime())->format('Y-m-d'); ?>">
                    </div>
                    <div class="form-group col-6 flex-column d-flex"> <label class="form-control-label px-3">
                            bis vorraussichtlich: </label> <input type="date" id="bis_date_id" name="bis_date">
                    </div>
                </div>
                <div class="row" style="margin-top: 50px;">

                    <div class="form-group col-sm-6 flex-column d-flex">
                        <label class="form-control-label px-3">
                            von Uhr
                        </label>
                        <input type="time" id="von_uhr_id" name="von_uhr" value="<?php echo date('H:i') ?>">
                    </div>

                    <div class="form-group col-sm-6 flex-column d-flex">
                        <label class="form-control-label px-3">
                            bis Uhr
                        </label>
                        <input type="time" id="bis_uhr_id" name="bis_uhr">
                    </div>
                </div>



                <div class="d-flex justify-content-center">
                    <div class="form-group">
                        <button type="button" onclick="check_mitarbeiter_data()" class="btn-block btn-primary" style="margin-top: 50px;">
                            Jetzt absenden</button>
                    </div>
                </div>
                <br><br>
                <div id="success_added" class="alert alert-success" role="alert">
                    <p>Fehlzeit wurde hinzufügt</p>
                </div>
                <div id="error_formular" class="alert alert-danger" role="alert">
                    <p id="error_msg"></p>
                </div>

            </form>

        </div>
    </main>


    <script>
        var radiovar = 0;
        $(function() {
            $('input[name="radio"]').on('click', function() {
                $('#error_formular').hide(); // Fehlermeldung löschen wenn auf Radiobutton gedrückt werden
                if ($(this).val() == '3') {
                    $('#label_id').show();
                    $('#note_id').show();
                    $('#label2_id').hide();
                     radiovar = 3;
                } else if ($(this).val() == '1' || $(this).val() == '2') {
                    $('#label2_id').show();
                    $('#label_id').hide();
                    $('#note_id').hide();
                    radiovar = 0;
                }
            });
        });

        // document.getElementById('pro_date').valueAsDate = new Date();

        function show_error(error) {
            $('#error_formular').show();
            $('#error_msg').html(error);
            $('#success_added').hide();
        }


        function check_mitarbeiter_data() {
            var mit_name = document.getElementsByName('name')[0].value;
            var grund = document.querySelectorAll('input[type="radio"]:checked').length == 0;
            var note = document.getElementsByName('note')[0].value;
            var von_date = document.getElementsByName('von_date')[0].value;
            var bis_date = document.getElementsByName('bis_date')[0].value;
            var von_uhr = document.getElementsByName('von_uhr')[0].value;
            var bis_uhr = document.getElementsByName('bis_uhr')[0].value;
            console.log(grund);
            console.log(radiovar);
            if (mit_name.length == 0) {
                show_error('Mitarbeitername ist ungültig!!');
            } else if (grund) {
                show_error('Bitte wählen Sie einen Grund aus!!');
            } else if (von_date.length == 0) {
                show_error('Ab welchem Tag sind Sie abwesend?');
            } else if (bis_date.length == 0) {
                show_error('Bis welchem Tag sind Sie abwesend?');
            } else if (von_uhr.length == 0) {
                show_error('Ab welcher Uhr sind Sie abwesend?');
            } else if (bis_uhr.length == 0) {
                show_error('Bis welcher Uhr sind Sie abwesend?');
            } else if (radiovar == 3 && note.length == 0 ) {
                show_error('Note?');
            } else {
                $('#add_fehlzeit_form').submit();
            }
        }
    </script>