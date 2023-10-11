<section class="content-header">
    <h1>
        Kategori
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Kelola Kategori</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <div style="margin-bottom:1em">
        <a href="<?= base_url(); ?>kategori/create" class="btn btn-primary">Tambah Kategori</a>
    </div>

    <div style="margin-bottom: 8px" id="message">
        <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
    </div>

    <div class="box">
        <div class="box-body">
            <table class="table table-bordered" id="example1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kategori</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($kategoris as $kategori) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $kategori['nama']; ?></td>
                            <td>
                                <a href="<?= base_url(); ?>kategori/update/<?= $kategori['id']; ?>" class="btn btn-primary">Edit</a>
                                <a href="<?= base_url(); ?>kategori/delete/<?= $kategori['id']; ?>" class="btn btn-danger tombol-hapus" data-hapus="Kategori">Hapus</a>
                                <a href="<?= base_url(); ?>kategori/barang/<?= $kategori['id']; ?>" class="btn btn-info">Lihat Barang</a>
                            </td>
                        </tr>

                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</section>