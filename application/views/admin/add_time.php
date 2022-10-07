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
            <h1 class="mt-4">Neue Arbeitzeiten addieren</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Add</li>
            </ol>

            <form id="add_project_form" method="POST" action="act_admin_add_time">
                <div class="row">
                    <div class="form-group col-6 flex-column d-flex">
                        <label class="form-control-label px-3">
                            Projekt</label>
                        <select name="mit_project" id="mit_project">
                            <?php
                            foreach ($projects_from_DB as $pro) {
                            ?>
                                <option value="<?php echo $pro['pro_id'] ?>"><?php echo $pro['pro_name'] ?>
                                </option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-6 flex-column d-flex"> <label class="form-control-label px-3">
                            Datum </label> <input type="date" id="pro_date" name="pro_date">
                    </div>
                </div>
                <div class="row" style="margin-top: 50px;">

                    <div class="form-group col-sm-6 flex-column d-flex">
                        <label class="form-control-label px-3">
                            Anfangzeit
                        </label>
                        <input type="time" id="start_time" name="start_time" value="<?php echo date('H:i') ?>">
                    </div>

                    <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">
                            Endezeit</label> <input type="time" id="end_time" name="end_time">
                    </div>
                </div>



                <div class="d-flex justify-content-center">
                    <div class="form-group">
                        <button type="submit" class="btn-block btn-primary" style="margin-top: 50px;">
                            Arbeitzeiten addieren</button>
                    </div>
                </div>
                <br><br>
                <div id="success_added" class="alert alert-success" role="alert">
                    <p>Zeit wurde hinzufügt</p>
                </div>

            </form>

        </div>
    </main>


    <script>
        document.getElementById('pro_date').valueAsDate = new Date();
    </script>