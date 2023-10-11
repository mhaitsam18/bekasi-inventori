<div class="tab-pane <?= ($id_kategori == null || $id_kategori == "NaN" || $id_kategori == "all") ? "active" : "" ?> table-responsive" id="all" role="tabpanel" aria-labelledby="all-tab">
    <table class="table table-responsive" id="example1">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Laporan</th>
                <th>Tahun</th>
                <!-- <th>Status</th> -->
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($data_inventaris as $barang) : ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td>KIB <?= $barang->kib . ' ' . $barang->periode . ' ' . $barang->indeks; ?></td>
                    <td><?= $barang->tahun ?></td>
                    <!-- <td><?= ($barang->kode_pengesahan) ? "Telah disahkan" : "Belum disahkan" ?></td> -->
                    <td><a href="<?= base_url("laporan/KartuInventarisBarang/$id_kartu_inventaris_barang/$barang->id_kategori?periode=$periode&index=$index") ?>" class="btn btn-info">Lihat</a></td>
                </tr>

            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php $example = 1;
foreach ($data_kategori as $kategori) : ?>
    <div class="tab-pane table-responsive <?= ($kategori->id == $id_kategori) ? "active" : "" ?>" id="kib-<?= strtolower($kategori->kib) ?>" role="tabpanel" aria-labelledby="kib-<?= strtolower($kategori->kib) ?>-tab">
        <table class="table table-responsive" id="example<?= ++$example ?>">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Laporan</th>
                    <th>Tahun</th>
                    <!-- <th>Status</th> -->
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($data_inventaris as $barang) : ?>
                    <?php if ($barang->kib == $kategori->kib) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td>KIB <?= $barang->kib . ' ' . $barang->periode . ' ' . $barang->indeks; ?></td>
                            <td><?= $barang->tahun ?></td>
                            <!-- <td><?= ($barang->kode_pengesahan) ? "Telah disahkan" : "Belum disahkan" ?></td> -->
                            <td><a href="<?= base_url("laporan/KartuInventarisBarang/$id_kartu_inventaris_barang/$barang->id_kategori?periode=$periode&index=$index") ?>" class="btn btn-info">Lihat</a></td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endforeach; ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- DataTables -->
<script src="<?php echo base_url() ?>assets/bower_components/jquery/dist/jquery.js"></script>
<script src="<?php echo base_url() ?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url() ?>assets/bower_components/jquery-ui/jquery-ui.min.js"></script>
<script>
    $.widget.bridge('uibutton', $.ui.button);
    $(function() {
        $('#example9').DataTable({
            'paging': true,
            'lengthChange': true,
            'searching': true,
            'ordering': true,
            'info': true,
            'autoWidth': true
        })
    })
    $(function() {
        $('#example10').DataTable({
            'paging': true,
            'lengthChange': true,
            'searching': true,
            'ordering': true,
            'info': true,
            'autoWidth': true
        })
    })
    $(function() {
        $('#example11').DataTable({
            'paging': true,
            'lengthChange': true,
            'searching': true,
            'ordering': true,
            'info': true,
            'autoWidth': true
        })
    })
    $(function() {
        $('#example12').DataTable({
            'paging': true,
            'lengthChange': true,
            'searching': true,
            'ordering': true,
            'info': true,
            'autoWidth': true
        })
    })
    $(function() {
        $('#example13').DataTable({
            'paging': true,
            'lengthChange': true,
            'searching': true,
            'ordering': true,
            'info': true,
            'autoWidth': true
        })
    })
    $(function() {
        $('#example14').DataTable({
            'paging': true,
            'lengthChange': true,
            'searching': true,
            'ordering': true,
            'info': true,
            'autoWidth': true
        })
    })
    $(function() {
        $('#example15').DataTable({
            'paging': true,
            'lengthChange': true,
            'searching': true,
            'ordering': true,
            'info': true,
            'autoWidth': true
        })
    })
    $(function() {
        $('#example16').DataTable({
            'paging': true,
            'lengthChange': true,
            'searching': true,
            'ordering': true,
            'info': true,
            'autoWidth': true
        })
    })
    $(function() {
        $('#example17').DataTable({
            'paging': true,
            'lengthChange': true,
            'searching': true,
            'ordering': true,
            'info': true,
            'autoWidth': true
        })
    })
</script>