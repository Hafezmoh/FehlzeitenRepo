<style>
    #error_project {
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
$pro_added_success= $this->session->userdata('pro_added');
if (isset($pro_added_success)) {
?>
    <style>
        #success_added {
            display: block;
        }
    </style>
<?php
}
$this->session->unset_userdata('pro_added');
$pro_not_added= $this->session->userdata('fail');
if (isset($pro_not_added)) {
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
            <h1 class="mt-4">Projekt addieren</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Verwaltung</li>
            </ol>
            <div class="card-body">
                <form class="form-card" id="add_project_form" method="POST" action="send_new_project">
                    <div class="row justify-content-between text-left">
                        <div class="form-group col-sm-6 flex-column d-flex">
                            <label class="form-control-label px-3">
                                Projektname
                            </label>
                            <input type="text" id="pname" name="pname">
                        </div>

                        <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">
                                Kundenname</label> <input type="text" id="kname" name="kname">
                        </div>
                    </div>
                    <div class="row justify-content-between text-left" style="margin-top: 50px;">
                        <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">
                                Kundenadresse </label> <input type="text" id="kadresse" name="kadresse">
                        </div>
                        <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">
                                Kundentelefonnummer</label> <input type="tel" id="knummer" name="knummer">
                        </div>
                    </div>
                    <div class="row justify-content-between text-left" style="margin-top: 50px;">
                        <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">
                                Kunden-Email-adresse</label> <input type="email" id="kemail" name="kemail">
                        </div>
                    </div>
                    <div class="p-3">

                    </div>

                    <div class="d-flex justify-content-center">
                        <div class="form-group">
                            <button type="button" onclick="check_project_data()" class="btn-block btn-primary">
                                Projekt addieren</button>
                        </div>
                    </div>
                </form>
                <br>
                <div id="error_project" class="alert alert-danger" role="alert">
                    <p id="error_msg"></p>
                </div>
                <div id="success_added" class="alert alert-success" role="alert">
                    <p>Projekt wurde addiert</p>
                </div>
                <div id="fail_added" class="alert alert-danger" role="alert">
                    <p>Projektname existiert schon!</p>
                </div>
            </div>
        </div>
    </main>
    <script>
        function show_error(error) {
            $('#error_project').show();
            $('#error_msg').html(error);
            $('#success_added').hide();
        }

        function check_project_data() {


            var project_name = document.getElementsByName('pname')[0].value;
            var kunde_name = document.getElementsByName('kname')[0].value;
            var kunde_adresse = document.getElementsByName('kadresse')[0].value;
            var kunde_nummer = document.getElementsByName('knummer')[0].value;
            var kunde_email = document.getElementsByName('kemail')[0].value;

            var atposition = kunde_email.indexOf("@");
            var dotposition = kunde_email.lastIndexOf(".");
            var mailformat = /^w+([.-]?w+)@w+([.-]?w+)(.w{2,3})+$/;


            if (project_name.length == 0) {
                show_error('Projektname ist ungültig!!');
                return;
            }
            if (kunde_name.length == 0) {
                show_error('Kundenname ist ungültig!!');
                return;
            }
            if (kunde_adresse.length == 0) {
                show_error('Kundenadresse ist ungültig!!');
                return;
            }
            if (kunde_nummer.length == 0 || isNaN(kunde_nummer)) // kunde_nummer.length == 0 ||
            {
                show_error('Kundentelefonnummer ist ungültig!!');
                return;
            }
            if (atposition < 1 || dotposition < atposition + 2 || dotposition + 2 >= kunde_email.length) {
                show_error("Kunden-Email-Adresse ist ungültig!!");
                return;
            }
            $('#add_project_form').submit();

        }
    </script>