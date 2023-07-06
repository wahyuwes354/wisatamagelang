<div class="row">
    <div class="col-md-12">
        <div class="callout callout-info">
            <?= $this->session->flashdata('msg'); ?>
        </div>
        <div class="card">
            <form method="POST" action="<?= site_url('Wisata/doUpdate?id_wisata=') . $Wisata->id_wisata ?>" id="frm_Wisata" enctype="multipart/form-data">
                <div class="card-body">
                    <h5 class="card-title">Data Wisata</h5>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Kategori Wisata</label>
                        <div class="col-sm-10">
                            <select name="kategori" id="kategori" class="form-control">
                                <?php foreach ($kategori as $ktg) { ?>
                                    <option value="<?= $ktg->id_kategori ?>" <?= ($ktg->id_kategori == $Wisata->id_kategori) ? "selected" : "" ?>><?= $ktg->kategori ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="" class="col-sm-2 col-form-label">Nama Wisata</label>
                        <div class="col-sm-10">
                            <input type="text" name="nm_wisata" id="nm_wisata" class="form-control" placeholder="Nama Wisata" value="<?= $Wisata->nm_wisata ?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="" class="col-sm-2 col-form-label">lokasi Wisata</label>
                        <div class="col-sm-10">
                            <input type="text" name="lokasi" id="lokasi" class="form-control" placeholder="Lokasi Wisata" value="<?= $Wisata->lokasi ?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="" class="col-sm-2 col-form-label">deskripsi Wisata</label>
                        <div class="col-sm-10">
                            <input type="text" name="deskripsi" id="deskripsi" class="form-control" placeholder="deskripsi Wisata" value="<?= $Wisata->deskripsi ?>">
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="<?= site_url('Wisata/data_wisata'); ?>" class="btn btn-danger">Batal</a>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>