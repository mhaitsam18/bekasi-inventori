<!-- Main content -->
<style type="text/css" media="print">
    @page {
        size: landscape;
    }
</style>
<section class="content">
    <div class="row text-center">
        <h2>List Data Barang</h2>
        <h2>Kota Bekasi</h2>
    </div>
    <div class="box">
        <div class="box-body">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane active" id="all" role="tabpanel" aria-labelledby="all-tab">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Barcode</th>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Kategori</th>
                                <th>Lokasi</th>
                                <th>Tanggal Pengadaan</th>
                                <!-- <th>Kondisi</th> -->
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($barangs as $barang) : ?>
                                <?php
                                $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
                                ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode("'$barang[kode]'", $generator::TYPE_CODE_128)) . '" style="width:300px;">'; ?></td>
                                    <td><?= $barang['kode']; ?></td>
                                    <td><?= $barang['nama_barang']; ?></td>
                                    <td><?= $barang['nama_kategori']; ?></td>
                                    <td><?= $barang['nama_lokasi']; ?></td>
                                    <td><?= cari_tanggal($barang['tanggal_pengadaan']); ?></td>
                                    <!-- <td><?= $barang['kondisi']; ?></td> -->
                                    <td><?= $barang['keterangan']; ?></td>
                                </tr>

                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="<?php echo base_url() ?>assets/js/jquery.jqprint-0.3.js"></script>
<script>
    window.print();
    $('#sectionID').jqprint();
</script>