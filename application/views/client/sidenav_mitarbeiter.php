<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="#">Projektzeiterfassung</a>
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
                        <div class="sb-sidenav-menu-heading">Projektzeiten</div>
                        <a class="nav-link" href="<?php echo base_url() ?>mit_all_projects">
                            <div class="sb-nav-link-icon"><i class="fas fa-file-alt"></i></div>
                            Alle Projekte
                        </a>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-file"></i></div>
                            Ein Projekt
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <?php
                                foreach ($projects_from_DB as $pro) {
                                ?>
                                    <a class="nav-link" href="<?php echo base_url() ?>mit_project/<?php echo $pro['pro_id'] ?>"><?php echo $pro['pro_name'] ?></a>
                                <?php
                                }
                                ?>
                            </nav>
                        </div>
                        <div class="sb-sidenav-menu-heading">Arbeitzeiten Addieren</div>
                        <a class="nav-link" href="<?php echo base_url() ?>mit_ref_add_time">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Neue Arbeitzeiten
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as: Mitarbeiter </div>
                    <?php
                    echo $this->session->userdata('user_name_session');
                    //var_dump( $this->session);
                    ?>
                </div>
            </nav>
        </div>