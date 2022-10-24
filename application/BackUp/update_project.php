<style>
    #error_project {
        display: none;
    }
</style>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Projekt bearbeiten</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Verwaltung</li>
            </ol>
            <div class="card-body">
                <form class="form-card" id="update_project_form" method="POST" action="<?php echo base_url() ?>act_update_project">
                    <div class="row justify-content-between text-left">
                        <div class="form-group col-sm-6 flex-column d-flex">
                            <label class="form-control-label px-3">
                                Projektname
                            </label>
                            <input type="text" id="new_pro_name" name="new_pro_name" value="<?php echo $get_one_project_from_DB[0]['pro_name'] ?>">
                        </div>

                        <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">
                                Kundenname</label> <input type="text" id="new_kunde_name" name="new_kunde_name" value="<?php echo $get_one_project_from_DB[0]['pro_kunde_name'] ?>">
                        </div>
                    </div>
                    <div class="row justify-content-between text-left" style="margin-top: 50px;">
                        <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">
                                Kundenadresse </label> <input type="text" id="new_kunde_address" name="new_kunde_address" value="<?php echo $get_one_project_from_DB[0]['pro_kunde_adresse'] ?>">
                        </div>
                        <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">
                                Kundentelefonnummer</label> <input type="tel" id="new_kunde_nummer" name="new_kunde_nummer" value="<?php echo $get_one_project_from_DB[0]['pro_kunde_nummer'] ?>">
                        </div>
                    </div>
                    <div class="row justify-content-between text-left" style="margin-top: 50px;">
                        <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">
                                Kunden-Email-adresse</label> <input type="email" id="new_kunde_email" name="new_kunde_email" value="<?php echo $get_one_project_from_DB[0]['pro_kunde_email'] ?>">
                        </div>
                    </div>
                    <div class="p-3">

                    </div>
                    <input type="hidden" name="pro_id" value="<?php echo $get_one_project_from_DB[0]['pro_id'] ?>">
                    <div class="d-flex justify-content-center">
                        <div class="form-group">
                            <button type="button" onclick="check_project_data()" class="btn-block btn-primary">
                                Speichern</button>
                        </div>
                    </div>
                </form>
                <br>
                <div id="error_project" class="alert alert-danger" role="alert">
                    <p id="error_msg"></p>
                </div>

            </div>
    </main>
    <script>
        function show_error(error) {
            $('#error_project').show();
            $('#error_msg').html(error);
        }

        function check_project_data() {


            var project_name = document.getElementsByName('new_pro_name')[0].value;
            var kunde_name = document.getElementsByName('new_kunde_name')[0].value;
            var kunde_adresse = document.getElementsByName('new_kunde_address')[0].value;
            var kunde_nummer = document.getElementsByName('new_kunde_nummer')[0].value;
            var kunde_email = document.getElementsByName('new_kunde_email')[0].value;

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
            $('#update_project_form').submit();

        }
    </script>