<div class="row">
    <div class="col-md-12">
        <div class="callout callout-info">
            <?= $this->session->flashdata('msg'); ?>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <a class="btn btn-success" href="<?= site_url('Wisata/AddWisata'); ?>"><i class="fa fa-user"></i> Tambah Wisata</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="tblUser" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="width:5%;">#</th>
                                <th style="width:15%;"></th>
                                <th style="width:10%;">Kategori</th>
                                <th style="width:15%;">Nama Objek</th>
                                <th style="width:15%;">Lokasi</th>
                                <th style="width:45%;">Deskripsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($data as $item) : ?>
                                <tr>
                                    <td><?= ++$start ?></td>
                                    <td>
                                        <a href="javascript:void(0)" onclick=delete_wisata(<?= $item->id_wisata; ?>) class="btn btn-danger btn-sm"></i> Hapus</a>
                                        <a href="<?= site_url('Wisata/UpdateWisata/' . $item->id_wisata) ?>" class=" btn btn-primary btn-sm"></i> Ubah</a>
                                    </td>
                                    <td><?php echo $item->kategori; ?></td>
                                    <td><?php echo $item->nm_wisata; ?></td>
                                    <td><?php echo $item->lokasi; ?></td>
                                    <td style="word-wrap: break-word;"><?php echo $item->deskripsi; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="card-body">
                <?php echo $pagination; ?>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function delete_wisata(id) {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Yakin Akan Menghapus Data Ini ?',
            text: "Data Yang di hapus tidak bisa di kembalikan lagi!",
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Tidak, Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?php echo site_url('Wisata/delete') ?>/" + id,
                    type: "POST",
                    dataType: "JSON",
                    success: function(data) {
                        console.log(data);
                        swalWithBootstrapButtons.fire({
                            icon: 'success',
                            title: 'Akun Telah berhasil di hapus',
                            showConfirmButton: false,
                            timer: 1500
                        });

                        location.reload();
                    }
                });
            } else if (
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire({
                    icon: 'error',
                    title: 'Data batal di hapus',
                    showConfirmButton: false,
                    timer: 1500
                })
            }
        })
    }
</script>