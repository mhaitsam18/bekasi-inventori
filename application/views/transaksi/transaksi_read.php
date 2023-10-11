<section class="content-header">
    <h1>
        Transaksi Read
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Kelola Transaksi Read</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <div class="box">
        <div class="box-body">
            <table class="table">
                <tr>
                    <td>Kode Barang</td>
                    <td><?php echo $kode_barang; ?></td>
                </tr>
                <tr>
                    <td>Nomor Anggota</td>
                    <td><?php echo $nomor_anggota; ?></td>
                </tr>
                <tr>
                    <td>Jumlah Barang</td>
                    <td><?php echo $jumlah_barang; ?></td>
                </tr>
                <tr>
                    <td>Tanggal Datang</td>
                    <td><?php echo $tanggal_datang; ?></td>
                </tr>
                <tr>
                    <td>Tanggal Distribusi</td>
                    <td><?php echo $tanggal_distribusi; ?></td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td><?php echo $status; ?></td>
                </tr>
                <tr>
                    <td>
                        <?php if ($approval == 1) : ?>
                            <p>
                                <small>Peminjaman sudah disetujui, silahkan download Surat BAP dibawah ini</small>
                            </p>
                            <a href="<?= base_url("assets/bap/" . $bap) ?>" class="btn btn-default"><i class="fa fa-file"></i> Download Surat BAP</a>
                        <?php endif; ?>
                    </td>
                    <td><a href="<?php echo site_url('transaksi') ?>" class="btn btn-default">Cancel</a></td>
                </tr>
            </table>
            <!-- <embed type="application/pdf" src="<?= base_url("assets/bap/") ?>contoh.pdf" width="600"></embed>
            <iframe src="<?= base_url("assets/bap/") ?>contoh.pdf" width="600"></iframe>
            <object data="<?= base_url("assets/bap/") ?>contoh.pdf" width="400"></object> -->
        </div>
    </div>
</section>

<<!-- section class="content">

    <div class="box">
        <div class="box-body">
            <object type="application/pdf"></object>
            <?php

            // // Store the file name into variable 
            // $file = 'contoh.pdf'; 
            // $filename = 'contoh.pdf'; 

            // // Header content type 
            // header('Content-type: application/pdf'); 

            // header('Content-Disposition: inline; filename="' . $filename . '"'); 

            // header('Content-Transfer-Encoding: binary'); 

            // header('Accept-Ranges: bytes'); 

            // // Read the file 
            // @readfile($file); 
            ?>

        </div>
    </div>
    </section> -->