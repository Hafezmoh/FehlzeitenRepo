<style>
    #success_delete {
        display: none;
    }

    #success_edit {
        display: none;
    }

    #failed_edit {
        display: none;
    }
</style>

<?php
$deleted = $this->session->userdata('deleted');

if (isset($deleted)) {
?>
    <style>
        #success_delete {
            display: block;
        }
    </style>
<?php
}
$this->session->unset_userdata('deleted');
$updated = $this->session->userdata('updated');
if (isset($updated)) {
?>
    <style>
        #success_edit {
            display: block;
        }
    </style>
<?php
}
$this->session->unset_userdata('updated');
$same_name = $this->session->userdata('failed');
if (isset($same_name)) {
?>
    <style>
        #failed_edit {
            display: block;
        }
    </style>
<?php
}
$this->session->unset_userdata('failed');
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Alle Projekte</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Projektzeiten</li>
            </ol>
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Vorname</th>
                        <th>Nachname</th>
                        <th>Benuztername</th>
                        <th>Steuerung</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Vorname</th>
                        <th>Nachname</th>
                        <th>Benuztername</th>
                        <th>Steuerung</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    foreach ($mitarbeiter_from_DB as $mit) {
                    ?>
                        <tr>
                            <!-- <td><a href="<?php echo base_url() ?>admin_project/<?php echo $pro['vorname'] ?>"><?php echo $pro['pro_name'] ?></a> </td> -->

                            <td><?php echo $mit['vorname']    ?> </td>
                            <td><?php echo $mit['nachname']    ?> </td>
                            <td><?php echo $mit['b_name'] ?> </td>
                            <td style="width: 60px">
                                <a href="<?php echo base_url() ?>update_mitarbeiter/<?php echo $mit['id'] ?>">
                                    <i class="fa fa-pen" style="color:green"></i></a>
                                -
                                <a href="#" onclick="ConfirmDelete(<?php echo $mit['id'] ?>)">
                                    <i class="fa fa-times-circle" style="color:red"></i> </a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
            <br><br>
            <div id="success_delete" class="alert alert-success" role="alert">
                <p>Projekt wurde gelöscht</p>
            </div>
            <div id="success_edit" class="alert alert-success" role="alert">
                <p>Änderung wurden gespeichert</p>
            </div>
            <div id="failed_edit" class="alert alert-danger" role="alert">
                <p>Projektname exsitiert schon!</p>
            </div>
        </div>
    </main>
    <script type="text/javascript">
        function ConfirmDelete($pro) {
            if (confirm("Delete Projekt?"))
                location.href = "deleteProject/" + $pro;
        }
    </script>