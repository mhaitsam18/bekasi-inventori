<section class="content-header">
    <h1>
        Lokasi
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= base_url() ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Kelola Lokasi</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div style="margin-bottom: 8px" id="message">
        <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
    </div>

    <div class="box">
        <div class="box-body">
            <a href="<?= base_url('lokasi/create') ?>" class="btn btn-primary">Tambah Data</a>
            <table class="table table-responsive" id="example1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Lokasi</th>
                        <th>Alamat</th>
                        <th>Kecamatan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($data_lokasi as $lokasi) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $lokasi->nama_lokasi ?></td>
                            <td><?= $lokasi->alamat ?></td>
                            <td><?= $lokasi->nama_kecamatan ?></td>
                            <td>
                                <a href="<?= base_url('lokasi/edit/' . $lokasi->id); ?>" class="btn btn-success">Edit</a>
                                <a href="<?= base_url('lokasi/delete/' . $lokasi->id); ?>" class="btn btn-danger tombol-hapus" data-hapus="lokasi">Hapus</a>
                            </td>
                        </tr>

                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</section>