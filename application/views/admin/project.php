<style>
    #success_deleted {
        display: none;
    }
</style>

<?php
$deleted = $this->session->userdata('delete_success');
if (isset($deleted)) {
?>
    <style>
        #success_deleted {
            display: block;
        }
    </style>
<?php

}
$this->session->unset_userdata('delete_success');
?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <?php foreach ($get_one_project_from_DB as $one_pro) {
            ?>
                <h1 class="mt-4"><?php echo $one_pro['pro_name'] ?></h1>
            <?php
            }
            ?>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Projektzeiten</li>
            </ol>
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Datum</th>
                        <th>Anfangzeit</th>
                        <th>Endezeit</th>
                        <th>Gesamte Zeit</th>
                        <th>Gearbeitet durch</th>
                        <th>Steuerung</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Datum</th>
                        <th>Anfangzeit</th>
                        <th>Endezeit</th>
                        <th>Gesamte Zeit</th>
                        <th>Gearbeitet durch</th>
                        <th>Steuerung</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    foreach ($worked_time_from_DB as $pro) {
                    ?>
                        <tr>
                            <td><?php echo $pro['auf_datum']          ?> </td>
                            <td><?php echo $pro['auf_start_zeit']    ?> </td>
                            <td><?php echo $pro['auf_ende_zeit'] ?> </td>
                            <td><?php echo date('H:i', $pro['auf_gesamt_zeit'] - 3600) ?> </td>
                            <td><?php echo $pro['m_benutzer']  ?> </td>
                            <td style="width: auto">
                                <a href="<?php echo base_url() ?>updatetime/<?php echo $pro['auf_id'] ?>">
                                    <i class="fa fa-pen" style="color:green"></i></a>-
                                <a href="#" onclick="ConfirmDelete(<?php echo $pro['auf_id']?>)">
                                    <i class="fa fa-times-circle" style="color:red"></i> </a>
                            </td>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                    </tr>
                </tbody>
            </table>
            <br><br>
            <div id="success_deleted" class="alert alert-success" role="alert">
                <p>Zeit würde gelöscht</p>
            </div>
        </div>
    </main>
    <script type="text/javascript">
        function ConfirmDelete($pro) {
            if (confirm("Zeit löschen?"))
                location.href = " <?php echo base_url() ?>ref_deletetime/"+$pro;
        }
    </script>