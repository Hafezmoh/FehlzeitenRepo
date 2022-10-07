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
                        <th>Projektname</th>
                        <th>Kundename</th>
                        <th>Kundeadresse</th>
                        <th>Kundetelefonnummer</th>
                        <th>Kunde EMail</th>
                        <th>Gesamte Zeit</th>
                        <th>Steuerung</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Projektname</th>
                        <th>Kundename</th>
                        <th>Kundeadresse</th>
                        <th>Kundetelefonnummer</th>
                        <th>Kunde EMail</th>
                        <th>Gesamte Zeit</th>
                        <th>Steuerung</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    foreach ($worked_time_from_DB as $pro) {
                    ?>
                        <tr>
                            <td><a href="<?php echo base_url() ?>admin_project/<?php echo $pro['pro_id'] ?>"><?php echo $pro['pro_name'] ?></a> </td>
                            <td><?php echo $pro['pro_kunde_name']    ?> </td>
                            <td><?php echo $pro['pro_kunde_adresse'] ?> </td>
                            <td><?php echo $pro['pro_kunde_nummer']  ?> </td>
                            <td><?php echo $pro['pro_kunde_email']   ?> </td>
                            <td><?php echo date('H:i', $pro['auf_gesamt_zeit'] - 3600)  ?></td>
                            <td style="width: auto">
                                <a href="<?php echo base_url() ?>updateProject/<?php echo $pro['pro_id'] ?>">
                                    <i class="fa fa-pen" style="color:green"></i></a>-
                                <a href="#" onclick="ConfirmDelete(<?php echo $pro['pro_id'] ?>)">
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