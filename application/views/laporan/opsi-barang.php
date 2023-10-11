<div class="form-group">
    <label for="id_lokasi" class="col-sm-4 control-label">Kode Pemilik/lokasi</label>
    <div class="col-sm-8">
        <input type="number" class="form-control" name="id_lokasi" id="id_lokasi" value="<?= $lokasi->id_lokasi ?>" readonly>
    </div>
</div>
<div class="form-group">
    <label for="id_barang" class="col-sm-4 control-label">Kode Aset / Barang</label>
    <div class="col-sm-8">
        <select class="form-control id_barang" id="id_barang" name="id_barang">
            <option value="" selected disabled>Pilih Kode Barang</option>
            <?php foreach ($data_barang as $barang) : ?>
                <option value="<?= $barang->id_barang ?>"><?= $barang->id_barang . '.' . $barang->kode . ' | ' . $barang->nama_barang ?></option>
            <?php endforeach ?>
        </select>
    </div>
</div>
<div class="form-group">
    <label for="jenis" class="col-sm-4 control-label">Jenis/Luas(m<sup>2</sup>)</label>
    <div class="col-sm-8">
        <input type="text" class="form-control jenis" name="jenis" id="jenis" readonly>
    </div>
</div>
<div class="form-group">
    <label for="tanggal_pengadaan" class="col-sm-4 control-label">Tanggal Pengadaan</label>
    <div class="col-sm-8">
        <input type="date" class="form-control tanggal_pengadaan" name="tanggal_pengadaan" id="tanggal_pengadaan" readonly>
    </div>
</div>
<div class="form-group">
    <label for="alamat" class="col-sm-4 control-label">Alamat</label>
    <div class="col-sm-8">
        <input type="text" class="form-control alamat" name="alamat" id="alamat" readonly>
    </div>
</div>
<div class="form-group">
    <label for="keterangan" class="col-sm-4 control-label">Keterangan</label>
    <div class="col-sm-8">
        <input type="text" class="form-control keterangan" name="keterangan" id="keterangan" readonly>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $('.id_barang').on('change', function() {
        const id_barang = $(".id_barang").val();
        $.ajax({
            url: '<?= base_url('Laporan/checkBarang?id_barang=') ?> ' + id_barang,
            type: "post",
            dataType: "json",
            data: {
                'id_barang': id_barang
            },
            success: function(data) {
                $("#jenis").val(data.jenis);
                $("#tanggal_pengadaan").val(data.tanggal_pengadaan);
                $("#alamat").val(data.alamat);
                $("#keterangan").val(data.keterangan);
            }
        });
    });

    $('.pilih-periode').on('change', function() {
        const periode = $(this).val();
        const id_lokasi = <?= $id_lokasi ?>;
        $.ajax({
            url: "<?= base_url('laporan/list_index') ?>",
            type: "post",
            data: {
                'periode': periode,
                'id_lokasi': id_lokasi,
            },
            success: function(data) {
                $('#opsi-index').html(data);
            }
        });
    });

    $('.pilih-index').on('change', function() {
        const periode = $("#periode").val();
        const index = $(this).val();
        const id_lokasi = <?= $id_lokasi ?>;
        $.ajax({
            url: "<?= base_url('laporan/tabel_barang') ?>",
            type: "post",
            data: {
                'index': index,
                'periode': periode,
                'id_lokasi': id_lokasi,
            },
            success: function(data) {

                $('.tabel-barang').html(data);
            }
        });
        $.ajax({
            url: "<?= base_url('laporan/list_barang') ?>",
            type: "post",
            data: {
                'index': index,
                'periode': periode,
                'id_lokasi': id_lokasi,
            },
            success: function(data) {
                $('#opsi-barang').html(data);
            }
        });
    });
</script>