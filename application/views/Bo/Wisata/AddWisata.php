<div class="row">
    <div class="col-md-12">
        <div class="callout callout-info">
            <?= $this->session->flashdata('msg'); ?>
        </div>
        <div class="card">
            <form method="POST" action="<?= site_url('Wisata/simpanWisata') ?>" id="frm_calon" enctype="multipart/form-data">
                <div class="card-body">
                    <input hidden type="text" id="id_user" name="id_user">
                    <h5 class="card-title">Data Wisata</h5>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Kategori Wisata</label>
                        <div class="col-sm-10">
                            <select name="kategori" id="kategori" class="form-control">
                                <?php foreach ($kategori as $ktg) { ?>
                                    <option value="<?= $ktg->id_kategori ?>"><?= $ktg->kategori ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="" class="col-sm-2 col-form-label">Nama Objek Wisata</label>
                        <div class="col-sm-10">
                            <input type="text" name="objek" id="objek" class="form-control" placeholder="Nama Objek Wisata">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="" class="col-sm-2 col-form-label">Lokasi Objek</label>
                        <div class="col-sm-10">
                            <input type="text" name="lokasi" id="lokasi" class="form-control" placeholder="lokasi Objek Wisata">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="" class="col-sm-2 col-form-label">deskripsi</label>
                        <div class="col-sm-10">
                            <input type="text" name="deskripsi" id="deskripsi" class="form-control" placeholder="deskripsi Wisata">
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="<?= site_url('Wisata/Data_wisata'); ?>" class="btn btn-danger">Batal</a>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>