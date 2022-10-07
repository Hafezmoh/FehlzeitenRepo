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
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    foreach ($worked_time_from_DB as $pro) {
                    ?>
                        <tr>
                            <td><a href="<?php echo base_url() ?>mit_project/<?php echo $pro['pro_id'] ?>"><?php echo $pro['pro_name'] ?></a> </td>
                            <td><?php echo $pro['pro_kunde_name']    ?> </td>
                            <td><?php echo $pro['pro_kunde_adresse'] ?> </td>
                            <td><?php echo $pro['pro_kunde_nummer']  ?> </td>
                            <td><?php echo $pro['pro_kunde_email']   ?> </td>
                            <td><?php echo date('H:i', $pro['auf_gesamt_zeit'] - 3600)  ?></td>
                            
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </main>
