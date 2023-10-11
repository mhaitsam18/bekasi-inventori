<select name="index" id="index" class="form-control pilih-index">
    <option value="" selected disabled>Pilih Indeks</option>
    <?php if ($periode == 'triwulan') : ?>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
    <?php elseif ($periode == 'semester') : ?>
        <option value="1">1</option>
        <option value="2">2</option>
    <?php elseif ($periode == 'tahunan') : ?>
        <?php foreach ($data_tahun as $tahun) : ?>
            <option value="<?= $tahun->tahun ?>"><?= $tahun->tahun ?></option>
        <?php endforeach; ?>
    <?php endif; ?>
</select>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $('.pilih-index').on('change', function() {
        const periode = "<?= $periode ?>";
        const index = $(this).val();

        const id_lokasi = <?= ($id_lokasi) ? $id_lokasi : "NaN" ?>;
        const id_kategori = <?= ($id_kategori) ? $id_kategori : "NaN" ?>;
        const id_kartu_inventaris_barang = <?= ($id_kartu_inventaris_barang) ? $id_kartu_inventaris_barang : "NaN" ?>;
        $.ajax({
            url: "<?= base_url('laporan/tabel_barang') ?>",
            type: "post",
            data: {
                'index': index,
                'periode': periode,
                'id_lokasi': id_lokasi,
                'id_kategori': id_kategori,
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
                'id_kategori': id_kategori,
            },
            success: function(data) {
                $('#opsi-barang').html(data);
            }
        });
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
</script>