<style>
    #success_delete {
        display: none;
    }

    #success_edit {
        display: none;
    }

    #pass_edit {
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


$updated = $this->session->userdata('success_updated');
if (isset($updated)) {
?>
    <style>
        #success_edit {
            display: block;
        }
    </style>
<?php
}
$this->session->unset_userdata('success_updated');


$admin_pass_updated = $this->session->userdata('success_admin_pass_updated');
if (isset($admin_pass_updated)) {
?>
    <style>
        #pass_edit {
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
            <h1 class="mt-4">Alle Mitarbeiter</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Fehlzeiten</li>
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
                <p>Mitarbeiter wurde gelöscht</p>
            </div>
            <div id="success_edit" class="alert alert-success" role="alert">
                <p>Änderung wurden gespeichert</p>
            </div>
            <div id="pass_edit" class="alert alert-success" role="alert">
                <p>Admin Passwort wurde erfolgreich gändert</p>
            </div>
        </div>
    </main>
    <script type="text/javascript">
        function ConfirmDelete($mit_id) {
            if (confirm("Delete Mitarbeiter? Alle Fehlzeiten des Mitarbeiters werden auch gelöscht"))
                location.href = "deleteMitarbeiter/" + $mit_id;
        }
    </script>