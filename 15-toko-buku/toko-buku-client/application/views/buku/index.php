<div class="container">
    <?php if ($this->session->flashdata('flash-data')) : ?>
        <div class="row mt-4">
            <div class="col-md-6">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Data Buku <strong> berhasil </strong> <?= $this->session->flashdata('flash-data'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <div class="row mt-4">
        <div class="col-md-6">
            <a href="<?= base_url(); ?>buku/tambah" class="btn btn-primary"> Tambah Data </a>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-6">
            <form action="" method="post">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Cari Data Buku" name="keyword">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit">Cari</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-6">
            <h2> Daftar Buku </h2>

            <!-- alert -->
            <?php if (empty($buku)) : ?>
                <div class="alert alert-danger" role="alert">
                    Data Buku Tidak ditemukan
                </div>
            <?php endif; ?>

            <div class="table-responsive-md">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">ID Buku</th>
                        <th scope="col">Judul Buku</th>
                        <th scope="col">Pengarang</th>
                        <th scope="col">Penerbit</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Stok</th>
                        <th scope="col">Gambar Buku</th>
                        <th scope="col">Hapus</th>
                        <th scope="col">Edit</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                     <?php foreach ($buku as $bk) { ?>
                    <tr>
                        <td><?php echo $bk['id_buku']; ?></td>
                        <td><?php echo $bk['judul_buku']; ?></td>
                        <td><?php echo $bk['pengarang']; ?></td>
                        <td><?php echo $bk['penerbit']; ?></td>
                        <td><?php echo $bk['harga']; ?></td>
                        <td><?php echo $bk['stok']; ?></td>
                        <td><img src="<?= base_url() . 'uploads/buku/' . $bk['gambar'] ?>" style="max-width:100px; min-height:100px" /></td>
                        <td><a href="<?= base_url(); ?>buku/hapus/<?= $bk['id_buku']; ?>" class="badge badge-danger float-right" onclick="return confirm('Yakin Data ini akan dihapus');">Hapus</a></td>
                        <td><a href="<?= base_url(); ?>buku/edit/<?= $bk['id_buku']; ?>" class="badge badge-success float-right">Edit</a></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>