<div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <a class="nav-link active" href="<?php base_url('admin/') ?>">
                                <div class="sb-nav-link-icon "><i class="bi bi-speedometer fs-5 text-white"></i></div>
                                Dashboard
                            </a>
                            <a class="nav-link" href="<?php base_url('admin/products.php') ?>">
                                <div class="sb-nav-link-icon"><i class="bi bi-box-fill fs-5 text-white"></i></i></div>
                                Products
                            </a>
                            <a class="nav-link" href="<?php base_url('admin/orders.php') ?>">
                                <div class="sb-nav-link-icon"><i class="bi bi-boxes fs-5 text-white"></i></div>
                                Orders
                            </a>
                            <a class="nav-link" href="<?php base_url('admin/users.php') ?>">
                                <div class="sb-nav-link-icon"><i class="bi bi-people-fill fs-5 text-white"></i></div>
                                Users
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as: 
                            <?php if(isset($_SESSION['authenticated'])) : ?>
                                <p class="d-inline text-warning"><?php echo $_SESSION['user_data']['user_name']; ?></p>
                            <?php endif; ?>    
                        </div>
                    </div>
                </nav>
            </div>