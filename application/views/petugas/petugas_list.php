<section class="content-header">
    <h1>
        Petugas
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Kelola Petugas</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <div style="margin-bottom:1em">
        <a href="<?= base_url(); ?>petugas/create" class="btn btn-primary">Tambah Petugas</a>
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
                        <th>Nomor Anggota</th>
                        <th>Nama Petugas</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Level</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($petugass as $petugas) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $petugas['nomor_anggota']; ?></td>
                            <td><?= $petugas['nama_operator']; ?></td>
                            <td><?= $petugas['username']; ?></td>
                            <td><?= $petugas['password']; ?></td>
                            <td><?= $petugas['hak_akses']; ?></td>
                            <td>
                                <a href="<?= base_url(); ?>petugas/update/<?= $petugas['id']; ?>" class="btn btn-primary">Edit</a>
                                <a href="<?= base_url(); ?>petugas/delete/<?= $petugas['id']; ?>" class="btn btn-danger tombol-hapus" data-hapus="Petugas">Hapus</a>
                            </td>
                        </tr>

                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</section>