<div class="row">
    <div class="col-md-12">
        <div class="callout callout-info">
            <?= $this->session->flashdata('msg'); ?>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <a class="btn btn-success" href="<?= site_url('User/AddUser'); ?>"><i class="fa fa-user"></i> Tambah Pengguna</a>
            </div>
            <div class="card-body">
                <table id="tblUser" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="width:5%;">#</th>
                            <th style="width:15%;"></th>
                            <th style="width:15%;">Nama Pengguna</th>
                            <th style="width:35%;">Username</th>
                            <th style="width:15%;">Role</th>
                            <th style="width:15%;">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($data as $item) : ?>
                            <tr>
                                <td><?= ++$start ?></td>
                                <td>
                                    <a href="javascript:void(0)" onclick=delete_user(<?= $item->id_user; ?>) class="btn btn-danger btn-sm">Hapus</a>
                                    <a href="<?= site_url('User/UpdateUser/' . $item->id_user); ?>" class="btn btn-primary btn-sm">Ubah</a>
                                </td>
                                <td><?php echo $item->nama; ?></td>
                                <td><?php echo $item->email; ?></td>
                                <td><?php echo $item->name; ?></td>
                                <td><?php echo $item->status; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                    </tfoot>
                </table>
            </div>
            <div class="card-body">
                <?php echo $pagination; ?>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function delete_user(id) {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Yakin Akan Menghapus Akun Ini ?',
            text: "Akun Yang di hapus tidak bisa di kembalikan lagi!",
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Tidak, Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?php echo site_url('User/delete') ?>/" + id,
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
                    title: 'Akun batal di hapus',
                    showConfirmButton: false,
                    timer: 1500
                })
            }
        })
    }
</script>