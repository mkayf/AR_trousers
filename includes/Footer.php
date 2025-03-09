<!-- size guide modal -->
<div class="modal fade" id="size-guide-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Size Guide</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div style="overflow-x: auto;">    
            <table class="table text-center size-table table-bordered border-dark">
              <thead>
                <tr>
                  <th scope="col" class="text-start">Size</th>
                  <th scope="col">Small</th>
                  <th scope="col">Medium</th>
                  <th scope="col">Large</th>
                  <th scope="col">X large</th>
                  <th scope="col">XX large</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="fw-bold text-start">Waist</td>
                  <td>24</td>
                  <td>28</td>
                  <td>30</td>
                  <td>32.5</td>
                  <td>34</td>
                </tr> 
                <tr>
                  <td class="fw-bold text-start">Hip</td>
                  <td>38</td>
                  <td>40</td>
                  <td>44</td>
                  <td>48</td>
                  <td>56</td>
                </tr>
                <tr>
                  <td class="fw-bold text-start">Thigh</td>
                  <td>23</td>
                  <td>24</td>
                  <td>26</td>
                  <td>28</td>
                  <td>32</td>
                </tr>
                <tr>
                  <td class="fw-bold text-start">Length</td>
                  <td>36</td>
                  <td>37</td>
                  <td>38</td>
                  <td>39</td>
                  <td>39</td>
                </tr>
                <tr>
                  <td class="fw-bold text-start">Bottom</td>
                  <td>6</td>
                  <td>6.5</td>
                  <td>7</td>
                  <td>7.5</td>
                  <td>7.5</td>
                </tr>
              </tbody>
           </table>
          </div>
           <p class="size-note"><span class="fw-bold">Note:</span> All measurements are in inches.</p>
            </div>
          </div>
        </div>
  </div>
<!-- Size guide modal -->


<footer class="text-center text-lg-start text-muted">
    
  <section class="d-flex justify-content-center justify-content-md-between py-4 px-5 border-bottom">
    <div class="me-5 d-none d-md-block">
      <span class="">Get connected with us on social networks:</span>
    </div>

    <div>
    <a href="https://wa.me/923401128236" target="_blank" class="me-4 text-reset text-decoration-none">
        <i class="bi bi-whatsapp social-icon"></i>
      </a>
      <a href="https://www.facebook.com/ArTrouser786" target="_blank" class="me-4 text-reset text-decoration-none">
        <i class="bi bi-facebook social-icon"></i>
      </a>
      <a href="https://www.instagram.com/ar_trouser786" target="_blank" class="text-reset text-decoration-none">
        <i class="bi bi-instagram social-icon"></i>
      </a>
    </div>
  </section>

  <section class="">
    <div class="container text-start text-md-start mt-5">
      <div class="row mt-3 d-flex align-items-center">
        <div class="col-6 col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
          <a class="navbar-brand pt-0" href="<?= ROOT_URL ?>index.php">
            <img class="logo" src="<?= ROOT_URL ?>assets/images/logo-1.png" alt="">
         </a>
          <p class="footer-about">
          At AR Trouser, we offer stylish, high-quality women's trousers that combine comfort and affordability. Shop with confidence!
          </p>
        </div>

        <div class="col-6 col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
          <h6 class="text-uppercase fw-bold mb-4">
            Quick links
          </h6>
          <p class="mb-2 footer-link">
            <a href="<?= ROOT_URL ?>index.php" class="text-reset text-decoration-none">Home</a>
          </p>
          <p class="mb-2 footer-link">
            <a href="<?= ROOT_URL ?>products/trousers.php" class="text-reset text-decoration-none">Trousers</a>
          </p>
          <p class="mb-2 footer-link">
            <a href="<?= ROOT_URL ?>index.php#new-arrivals" class="text-reset text-decoration-none">New arrivals</a>
          </p>
        </div>

        <div class="col-6 col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
          <h6 class="text-uppercase fw-bold mb-4">
            Account
          </h6>
          <?php if(isset($_SESSION['authenticated'])) : ?>
          
            <p class="mb-2 footer-link">
            <a href="<?= ROOT_URL ?>myaccount/orders.php" class="text-reset text-decoration-none">My account</a>
            </p>

            <p class="mb-2 footer-link">
                <a href="<?= ROOT_URL ?>myaccount/orders.php" class="text-reset text-decoration-none">Orders</a>
            </p>
 
            <form method="POST">
            <p class="mb-2 footer-link">
              <button type="submit" name="logout-btn" class="text-reset text-decoration-none bg-transparent" style="border: none;">Logout</button>
            </p>
            </form>

            <?php else : ?>
              <p class="mb-2 footer-link">
                <a href="<?= ROOT_URL ?>login.php#login" class="text-reset text-decoration-none">Login</a>
              </p>
              <p class="mb-2 footer-link">
                <a href="<?= ROOT_URL ?>signup.php" class="text-reset text-decoration-none">Signup</a>
              </p>
              <p class="mb-2 footer-link">
                <a href="<?= ROOT_URL ?>myaccount/orders.php" class="text-reset text-decoration-none">My account</a>
              </p>

            <?php endif; ?>
        </div>

        <div class="col-6 col-md-4 col-lg-3 col-xl-3 mx-auto mb-4">
          <h6 class="text-uppercase fw-bold mb-4">Customer support</h6>
          <p class="mb-2 footer-link">
            <a href="<?= ROOT_URL ?>contact.php" class="text-reset text-decoration-none">Contact us</a>
          </p>
          <p class="mb-2 footer-link">
            <a href="<?= ROOT_URL ?>about.php" class="text-reset text-decoration-none">About</a>
          </p>
          <p class="mb-2 footer-link">
            <a href="#" class="text-reset text-decoration-none" data-bs-toggle="modal" data-bs-target="#size-guide-modal">Size chart</a>
          </p>
        </div>
      </div>

    </div>
  </section>

  <div class="text-center p-4 footer-bottom" style="background-color: rgba(0, 0, 0, 0.05);">
    © <span class="year"></span>
    <a class="text-reset fw-bold" href="<?= ROOT_URL ?>index.php">AR Trouser</a>
    All rights reserved.
  </div>
</footer>