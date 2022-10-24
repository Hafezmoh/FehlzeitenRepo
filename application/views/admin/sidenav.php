<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="<?php echo base_url() ?>admin_aktuel_fehlzeiten">Fehlzeiterfassung</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">

        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                    <li><a class="dropdown-item" href="#!"> <?php
                                                            echo $this->session->userdata('user_name_session');
                                                            ?></a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="<?php echo base_url() ?>ref_logout">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading"> Mitarbeiter </div>
                        <a class="nav-link" href="<?php echo base_url() ?>all_mitarbeiter_ref">
                            <div class="sb-nav-link-icon"><i class="fas fa-plus"></i></div>
                            Alle Mitarbeiter
                        </a>
                        <a class="nav-link" href="<?php echo base_url() ?>add_mitarbeiter_ref">
                            <div class="sb-nav-link-icon"><i class="fas fa-user-plus"></i></div>
                            Mitarbeiter addieren
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as: <?= $this->session->userdata('user_vorname_session') . " " . $this->session->userdata('user_nachname_session'); ?>
                    </div>
                    <?php
                    echo $this->session->userdata('user_name_session');
                    ?>
                </div>
            </nav>
        </div>