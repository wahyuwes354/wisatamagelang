<section class="section dashboard">
    <div class="row">
        <!-- Left side columns -->
        <div class="col-lg-12">
            <div class="row">
                <div class="card info-card sales-card">
                    <div class="card-body">
                        <h5 class="card-title">Objek Wisata</h5>

                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-cart"></i>
                            </div>
                            <div class="ps-3">
                                <h6><?php echo ($wisata); ?></h6>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div><!-- End Left side columns -->
        <?php if ($this->session->userdata('id_role') == '1') { ?>
            <div class="col-lg-12">
                <div class="row">
                    <!-- Customers Card -->
                    <div class="card info-card customers-card">
                        <div class="card-body">
                            <h5 class="card-title">Pengguna</h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-people"></i>
                                </div>
                                <div class="ps-3">
                                    <h6><?php echo ($aktif); ?></h6>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Customers Card -->
                </div>
            </div><!-- End Left side columns -->
        <?php } ?>

    </div>
</section>