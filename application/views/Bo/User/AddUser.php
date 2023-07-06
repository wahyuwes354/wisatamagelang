<div class="row">
    <div class="col-md-12">
        <div class="callout callout-info">
            <?= $this->session->flashdata('msg'); ?>
        </div>
        <div class="card">
            <form method="POST" action="<?= site_url('User/simpanUser') ?>" id="frm_calon" enctype="multipart/form-data">
                <div class="card-body">
                    <input hidden type="text" id="id_user" name="id_user">
                    <h5 class="card-title">Data Pengguna</h5>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Role User</label>
                        <div class="col-sm-10">
                            <select name="role" id="role" class="form-select" aria-label="Default select example">
                                <?php foreach ($role as $rl) { ?>
                                    <option value="<?= $rl->id_role ?>"><?= $rl->name ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="" class="col-sm-2 col-form-label">Nama User</label>
                        <div class="col-sm-10">
                            <input type="text" name="nm_lengkap" id="nm_lengkap" class="form-control" placeholder="Nama User">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="" class="col-sm-2 col-form-label">Email User</label>
                        <div class="col-sm-10">
                            <input type="text" name="email" id="email" class="form-control" placeholder="Email">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <input type="text" name="pass" id="pass" class="form-control" placeholder="Password">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="" class="col-sm-2 col-form-label">Retype Password</label>
                        <div class="col-sm-10">
                            <input type="text" name="repass" id="repass" class="form-control" placeholder="Retype Password">
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="<?= site_url('User/Data_pengguna'); ?>" class="btn btn-danger">Batal</a>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>