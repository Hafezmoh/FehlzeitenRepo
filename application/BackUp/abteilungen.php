<style>
    #success_deleted {
        display: none;
    }
</style>

<?php
$abt_deleted = $this->session->userdata('deleted');
if (isset($abt_deleted)) {
?>
    <style>
        #success_deleted {
            display: block;
        }
    </style>
<?php

}
$this->session->unset_userdata('deleted');
?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Abteilungen</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Unternehmen</li>
            </ol>
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Abteilung</th>
                        <th>Steuerung</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Abteilung</th>
                        <th>Steuerung</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    foreach ($abteilungen_from_DB as $abt) {
                    ?>
                        <tr>
                            <td><?php echo $abt['abt_name'] ?> </td>
                            <td style="width: auto">
                                <a href="<?php echo base_url() ?>updateabteilung/<?php echo $abt['abt_id'] ?>">
                                    <i class="fa fa-pen" style="color:green"></i></a>-
                                <a href="#" onclick="ConfirmDelete(<?php echo $abt['abt_id'] ?>)">
                                    <i class="fa fa-times-circle" style="color:red"></i> </a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
            <br><br>
            <div id="success_deleted" class="alert alert-success" role="alert">
                <p>Abteilung wurde gelöscht</p>
            </div>
        </div>
    </main>
    <script type="text/javascript">
        function ConfirmDelete($abt) {
            if (confirm("Delete Abteilung?"))
                location.href = "<?php echo base_url() ?>deleteAbteilung/" + $abt;
        }
    </script>