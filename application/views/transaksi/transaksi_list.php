<section class="content-header">
    <h1>
        Transaksi
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Kelola Transaksi </li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <div style="margin-bottom:1em">
        <!-- <a href="<?= base_url(); ?>transaksi/create" class="btn btn-primary">Buat Transaksi</a> -->
        <?php echo anchor(site_url('transaksi/excel'), 'Excel', 'class="btn btn-primary"'); ?>
    </div>


    <div style="margin-bottom: 8px" id="message">
        <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
    </div>

    <div class="box">
        <div class="box-body">
            <table id="example1" class="table table-bordered" style="margin-bottom: 10px">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Jumlah Barang</th>
                        <th>Tanggal Datang</th>
                        <th>Tanggal Distribusi</th>
                        <?php if ($this->session->hak_akses != 'petugas') : ?>
                            <th>Status</th>
                        <?php endif; ?>
                        <th>Action</th>
                        <th>Approval</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $tr = '';
                    foreach ($transaksi_data as $transaksi) {
                        if ($transaksi->approval == 0) {
                            $tr = "";
                        } elseif ($transaksi->approval == 1) {
                            $tr = "bg-success";
                        } elseif ($transaksi->approval == 2) {
                            $tr = "bg-danger";
                        }
                    ?>
                        <tr class="<?= $tr ?>">
                            <td width="80px"><?php echo $no++ ?></td>
                            <td><?php echo $transaksi->kode_barang ?></td>
                            <td><?php echo $transaksi->nama ?></td>
                            <td><?php echo $transaksi->jumlah_barang ?></td>
                            <td><?php echo date("d-m-Y", strtotime($transaksi->tanggal_datang)) ?></td>
                            <td><?php echo date("d-m-Y", strtotime($transaksi->tanggal_distribusi)) ?></td>
                            <?php if ($this->session->hak_akses == 'admin') : ?>
                                <td><?php echo $transaksi->status ?></td>
                            <?php elseif ($this->session->hak_akses == 'petugas') : ?>
                            <?php else : ?>
                                <td><?php echo $transaksi->status == 'datang' ? 'Belum disetujui' : 'Disetujui'; ?></td>
                            <?php endif; ?>
                            <td style="text-align:center" width="200px">
                                <?php
                                echo anchor(site_url('transaksi/read/' . $transaksi->id), 'Read', [
                                    'class' => 'btn btn-primary btn-sm',
                                ]);
                                echo ' | ';
                                echo anchor(site_url('transaksi/update/' . $transaksi->id), 'Update', [
                                    'class' => 'btn btn-warning btn-sm',
                                ]);
                                echo ' | ';
                                echo anchor(site_url('transaksi/delete/' . $transaksi->id), 'Delete', [
                                    'class' => 'btn btn-danger btn-sm tombol-hapus',
                                    'data-hapus' => 'Transaksi',
                                    'onclick' => '"javasciprt: return confirm(\'Are You Sure ?\')"'
                                ]);
                                ?>
                            </td>
                            <td>
                                <?php if ($transaksi->approval == 0 && $this->session->userdata("hak_akses") == "admin") : ?>
                                    <a href="<?= base_url("transaksi/approval/$transaksi->id/1") ?>" class="btn btn-sm btn-success"><i class="fas fa-check"></i></a>
                                    <a href="<?= base_url("transaksi/approval/$transaksi->id/2") ?>" class="btn btn-sm btn-danger"><i class="fas fa-times"></i></a>
                                <?php elseif ($transaksi->approval == 1) : ?>
                                    Approved
                                <?php elseif ($transaksi->approval == 2) : ?>
                                    Rejected
                                <?php else : ?>
                                    in queue
                                <?php endif ?>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</section>