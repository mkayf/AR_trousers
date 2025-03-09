<div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <a class="nav-link text-white" href="<?= ROOT_URL ?>admin/products.php">
                                <div class="sb-nav-link-icon"><i class="bi bi-box-fill fs-5 text-white"></i></i></div>
                                Products
                            </a>
                            <a class="nav-link text-white" href="<?= ROOT_URL ?>admin/orders.php">
                                <div class="sb-nav-link-icon"><i class="bi bi-boxes fs-5 text-white"></i></div>
                                Orders
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