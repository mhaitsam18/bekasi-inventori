<div class="tab-content" id="myTabContent">
    <input type="hidden" id="kondisi" value="<?= $kondisi ?>">
    <input type="hidden" id="kategori_id" value="<?= $kategori_id ?>">
    <h3>Kondisi : <?= ($kondisi) ? $kondisi : "Semua Kondisi" ?></h3>
    <h3>Kategori : <?= ($kategori) ? $kategori->nama : "Semua Kategori" ?></h3>
    <div class="tab-pane active" id="all" role="tabpanel" aria-labelledby="all-tab">
        <table class="table table-responsive" id="example1">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Barcode</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Kategori</th>
                    <th>Lokasi</th>
                    <th>Tanggal Pengadaan</th>
                    <th>Keterangan</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($barangs as $barang) : ?>
                    <?php
                    $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
                    ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $generator->getBarcode("'$barang[kode]'", $generator::TYPE_CODE_128); ?></td>
                        <td><?= $barang['kode']; ?></td>
                        <td><?= $barang['nama_barang']; ?></td>
                        <td><?= $barang['nama_kategori']; ?></td>
                        <td><?= $barang['nama_lokasi']; ?></td>
                        <td><?= cari_tanggal($barang['tanggal_pengadaan']); ?></td>
                        <td><?= $barang['keterangan']; ?></td>
                        <td>
                            <?php if ($barang['gambar'] == '' || !$barang['gambar']) : ?>
                                <img src="https://source.unsplash.com/600x400/?<?= $barang['nama_barang'] ?>" style="width: 100px; height: 100px;">
                            <?php else : ?>
                                <img src="<?= base_url('assets/img/barang/') . $barang['gambar'] ?>" class="img-thumbnail">
                            <?php endif; ?>

                        </td>
                        <td>
                            <a href="<?= base_url(); ?>barang/update/<?= $barang['id_barang']; ?>" class="btn btn-primary">Edit</a>
                            <a href="<?= base_url(); ?>barang/delete/<?= $barang['id_barang']; ?>" class="btn btn-danger tombol-hapus" data-hapus="barang">Hapus</a>
                        </td>
                    </tr>

                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<!-- jQuery 3 -->
<script src="<?php echo base_url() ?>assets/bower_components/jquery/dist/jquery.js"></script>
<!-- DataTables -->
<script src="<?php echo base_url() ?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url() ?>assets/bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-show-password/1.0.1/bootstrap-show-password.min.js" integrity="sha512-HFCs3oK0PH4zg5Kli78BTmVkaNCAwMrVMp/JuCb+/SRYeYByDTEXuaF2F9n06Ktzai0bkQMvDeMtsC+UwGaGVw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $('.tombol-hapus').on('click', function(e) {
        const hapus = $(this).data('hapus');
        const href = $(this).attr('href');
        e.preventDefault();
        Swal.fire({
            title: 'Apakah Anda Yakin?',
            text: "Data " + hapus + " akan dihapus!",
            icon: 'warning',
            confirmButtonText: 'Iya',
            cancelButtonText: 'Tidak',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
        }).then((result) => {
            if (result.isConfirmed) {
                document.location.href = href;
            }
        })
    });
    $(function() {
        $('#example1').DataTable({
            'paging': true,
            'lengthChange': true,
            'searching': true,
            'ordering': true,
            'info': true,
            'autoWidth': true
        })
    })
</script>