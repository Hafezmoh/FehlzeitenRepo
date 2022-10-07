<style>
    #last_admin {
        display: none;
    }

    #success_delete {
        display: none;
    }
</style>

<?php
$last_admin = $this->session->userdata('last_admin');
if (isset($last_admin)) {
?>
    <style>
        #last_admin {
            display: block;
        }
    </style>
<?php
}
$this->session->unset_userdata('last_admin');
$mit_deleted = $this->session->userdata('mit_deleted');
if (isset($mit_deleted)) {
?>
    <style>
        #success_delete {
            display: block;
        }
    </style>
<?php
}
$this->session->unset_userdata('mit_deleted');
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Alle Mitarbeiter</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Unternehmen</li>
            </ol>
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Benuztername</th>
                        <th>Abteilung</th>
                        <th>Rolle</th>
                        <th>Gesamte Zeit</th>
                        <th>Steuerung</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Benuztername</th>
                        <th>Abteilung</th>
                        <th>Rolle</th>
                        <th>Gesamte Zeit</th>
                        <th>Steuerung</th>
                </tfoot>
                <tbody>
                    <?php
                    foreach ($mitarbeiter_from_DB as $mit) {
                    ?>
                        <tr>
                            <td><?php echo $mit['m_name']     ?> </td>
                            <td><?php echo $mit['m_benutzer'] ?> </td>
                            <td><?php echo $mit['abt_name'] ?> </td>
                            <td><?php if ($mit['m_rule'] == 1) {
                                    echo "Admin";
                                } else {
                                    echo "Mitarbeiter";
                                } ?> </td>
                            <td><?php echo date('H:i', $mit['auf_gesamt_zeit'] - 3600)  ?> </td>
                            <td style="width: auto">
                                <a href="<?php echo base_url() ?>ref_update_mit/<?php echo $mit['m_id'] ?>">
                                    <i class="fa fa-pen" style="color:green"></i></a>-
                                <a href="#" onclick="ConfirmDelete(<?php echo $mit['m_id'] ?>)">
                                    <i class="fa fa-times-circle" style="color:red"></i> </a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
            <br><br>
            <div id="last_admin" class="alert alert-danger" role="alert">
                <p>Letzter Admin darf nicht gelöscht werden!</p>
            </div>
            <div id="success_delete" class="alert alert-success" role="alert">
                <p>Account wurde gelöscht</p>
            </div>

        </div>
    </main>
    <script type="text/javascript">
        function ConfirmDelete(id) {
            console.log(id);
            if (confirm("Delete Account?"))
                location.href = "<?php echo base_url() ?>ref_delete_mit/" + id;
        }
    </script>