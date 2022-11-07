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
            <h1 class="mt-4">Aktuelle Fehlzeiten</h1>
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>gemeldet durch</th>
                        <th>Grund der Abwesendheit</th>
                        <th>Notiz</th>
                        <th>Von Datum</th>
                        <th>Bis Datum</th>
                        <th>gemeldet am</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>gemeldet durch</th>
                        <th>Grund der Abwesendheit</th>
                        <th>Notiz</th>
                        <th>Von Datum</th>
                        <th>Bis Datum</th>
                        <th>gemeldet am</th>
                </tfoot>
                <tbody>
                    <?php
                    foreach ($mitarbeiter_from_DB as $mit) {
                    ?>
                        <tr>
                            <td><?php echo $mit['vorname'] . " " . $mit['nachname'] ?> </td>
                            <td><?php echo get_autor_name($mit['autor_id']) ?> </td>
                            <td><?php echo GRUND[$mit['grund']] ?> </td>
                            <td><?php echo $mit['note'] ?> </td>
                            <td><?php echo date("d M Y", strtotime($mit['von_datum']))  ?> </td>
                            <td><?php echo date("d M Y", strtotime($mit['bis_datum']))  ?> </td>
                            <td><?php echo $mit['reg_datum'] ?> </td>
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