<section class="content-header">
    <h1>
        Barang
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Kelola Barang</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <div style="margin-bottom:1em">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="periode" class="col-sm-4 control-label">Periode</label>
                    <div class="col-sm-8">
                        <select name="periode" id="periode" class="form-control pilih-periode">
                            <option value="" selected disabled>Pilih Periode</option>
                            <option value="semua" <?= ($periode == "semua") ? "selected" : "" ?>>Semua</option>
                            <option value="triwulan" <?= ($periode == "triwulan") ? "selected" : "" ?>>Triwulan</option>
                            <option value="semester" <?= ($periode == "semester") ? "selected" : "" ?>>Semester</option>
                            <option value="tahunan" <?= ($periode == "tahunan") ? "selected" : "" ?>>Tahunan</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="index" class="col-sm-4 control-label">Indeks</label>
                    <div class="col-sm-8" id="opsi-index">
                        <select name="index" id="index" class="form-control pilih-index">
                            <option value="" selected disabled>Pilih Indeks</option>
                            <?php if ($periode == 'triwulan') : ?>
                                <option value="1" <?= ($index == 1) ? "selected" : "" ?>>1</option>
                                <option value="2" <?= ($index == 2) ? "selected" : "" ?>>2</option>
                                <option value="3" <?= ($index == 3) ? "selected" : "" ?>>3</option>
                                <option value="4" <?= ($index == 4) ? "selected" : "" ?>>4</option>
                            <?php elseif ($periode == 'semester') : ?>
                                <option value="1" <?= ($index == 1) ? "selected" : "" ?>>1</option>
                                <option value="2" <?= ($index == 2) ? "selected" : "" ?>>2</option>
                            <?php elseif ($periode == 'tahunan') : ?>
                                <?php foreach ($data_tahun as $tahun) : ?>
                                    <option value="<?= $tahun->tahun ?>" <?= ($index == $tahun->tahun) ? "selected" : "" ?>><?= $tahun->tahun ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                    <input type="hidden" name="id_kategori" id="id_kategori" value="<?= $id_kategori ?>">
                </div>
            </div>
        </div>
    </div>


    <div style="margin-bottom: 8px" id="message">
        <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
    </div>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item <?= ($id_kategori == null || $id_kategori == "NaN" || $id_kategori == "all") ? "active" : "" ?>" role="presentation">
            <a class="nav-link <?= ($id_kategori == null || $id_kategori == "NaN" || $id_kategori == "all") ? "active" : "" ?>" id="all-tab" data-toggle="tab" href="#all" role="tab" aria-controls="all" aria-selected="true">All</a>
        </li>
        <?php foreach ($data_kategori as $kategori) : ?>
            <li class="nav-item <?= ($kategori->id == $id_kategori) ? "active" : "" ?>" role="presentation">
                <a class="nav-link tab-kib <?= ($kategori->id == $id_kategori) ? "active" : "" ?>" id="kib-<?= strtolower($kategori->kib); ?>-tab" data-toggle="tab" href="#kib-<?= strtolower($kategori->kib); ?>" role="tab" aria-controls="kib-<?= strtolower($kategori->kib); ?>" aria-selected="true" data-id_kategori="<?= $kategori->id ?>">KIB <?= $kategori->kib ?></a>
            </li>
        <?php endforeach; ?>
    </ul>
    <div class="box">
        <div class="box-body" id="barang_list">
            <div class="tab-content tabel-kib" id="myTabContent">
                <div class="tab-pane <?= ($id_kategori == null || $id_kategori == "NaN" || $id_kategori == "all") ? "active" : "" ?> table-responsive" id="all" role="tabpanel" aria-labelledby="all-tab">
                    <table class="table table-responsive" id="example1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Laporan</th>
                                <th>Tahun</th>
                                <th>Status</th>
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
                                    <td><?= ($kode_pengesahan) ? "Telah disahkan" : "Belum disahkan" ?></td>
                                    <td><a href="<?= base_url("laporan/KartuInventarisBarang/$id_kartu_inventaris_barang/$barang->id_kategori?periode=$barang->periode&index=$barang->indeks") ?>" class="btn btn-info">Lihat</a></td>
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
                                    <th>Status</th>
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
                                            <td><?= ($kode_pengesahan) ? "Telah disahkan" : "Belum disahkan" ?></td>
                                            <td><a href="<?= base_url("laporan/KartuInventarisBarang/$id_kartu_inventaris_barang/$barang->id_kategori?periode=$barang->periode&index=$barang->indeks") ?>" class="btn btn-info">Lihat</a></td>
                                        </tr>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $('.pilih-periode').on('change', function() {
        const periode = $(this).val();
        const id_lokasi = <?= ($id_lokasi) ? $id_lokasi : "NaN" ?>;
        const id_kartu_inventaris_barang = <?= ($id_kartu_inventaris_barang) ? $id_kartu_inventaris_barang : "NaN" ?>;
        const id_kategori = $("#id_kategori").val();
        $.ajax({
            url: "<?= base_url('laporan/list_index') ?>",
            type: "post",
            data: {
                'periode': periode,
                'id_lokasi': id_lokasi,
                'id_kategori': id_kategori,
                'id_kartu_inventaris_barang': id_kartu_inventaris_barang,
            },
            success: function(data) {
                $('#opsi-index').html(data);
            }
        });
        $.ajax({
            url: "<?= base_url('laporan/tabel_kib') ?>",
            type: "post",
            data: {
                'periode': periode,
                'id_lokasi': id_lokasi,
                'id_kategori': id_kategori,
                'id_kartu_inventaris_barang': id_kartu_inventaris_barang,
            },
            success: function(data) {
                $('.tabel-kib').html(data);
            }
        });
    });

    $('.pilih-index').on('change', function() {
        const periode = $("#periode").val();
        const index = $(this).val();
        const id_lokasi = <?= ($id_lokasi) ? $id_lokasi : "NaN" ?>;
        const id_kartu_inventaris_barang = <?= ($id_kartu_inventaris_barang) ? $id_kartu_inventaris_barang : "NaN" ?>;
        const id_kategori = $("#id_kategori").val();
        $.ajax({
            url: "<?= base_url('laporan/tabel_kib') ?>",
            type: "post",
            data: {
                'index': index,
                'periode': periode,
                'id_lokasi': id_lokasi,
                'id_kategori': id_kategori,
                'id_kartu_inventaris_barang': id_kartu_inventaris_barang,
            },
            success: function(data) {
                $('.tabel-kib').html(data);
            }
        });
    });
    $('.tab-kib').on('click', function() {
        const id_kategori = $(this).data("id_kategori");
        $("#id_kategori").val(id_kategori);
        const periode = $("#periode").val();
        const id_lokasi = <?= ($id_lokasi) ? $id_lokasi : "NaN" ?>;
        const id_kartu_inventaris_barang = <?= ($id_kartu_inventaris_barang) ? $id_kartu_inventaris_barang : "NaN" ?>;
        $.ajax({
            url: "<?= base_url('laporan/list_index') ?>",
            type: "post",
            data: {
                'periode': periode,
                'id_lokasi': id_lokasi,
                'id_kategori': id_kategori,
                'id_kartu_inventaris_barang': id_kartu_inventaris_barang,
            },
            success: function(data) {
                $('#opsi-index').html(data);
            }
        });


    });
</script>