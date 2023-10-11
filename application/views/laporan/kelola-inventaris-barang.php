<section class="content-header">
	<h1>
		Kelola Inventaris Barang
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Kelola Inventaris Barang</li>
	</ol>
</section>
<!-- Main content -->
<?= $this->session->flashdata('message') ?>
<section class="content">
	<div class="box">
		<div class="box-body">
			<form class="form-horizontal" action="<?= base_url('laporan/tambah_inventaris_barang') ?>" method="post">
				<div class="row">
					<div class="col-lg-4" id="opsi-barang">
						<div class="form-group">
							<label for="id_lokasi" class="col-sm-4 control-label">Kode Pemilik/lokasi</label>
							<div class="col-sm-8">
								<input type="number" class="form-control" name="id_lokasi" id="id_lokasi" value="<?= $lokasi->id_lokasi ?>" readonly>
							</div>
						</div>
						<div class="form-group">
							<label for="id_barang" class="col-sm-4 control-label">Kode Aset / Barang</label>
							<div class="col-sm-8">
								<select class="form-control" id="id_barang" name="id_barang">
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
								<input type="text" class="form-control" name="jenis" id="jenis" readonly>
							</div>
						</div>
						<div class="form-group">
							<label for="tanggal_pengadaan" class="col-sm-4 control-label">Tanggal Pengadaan</label>
							<div class="col-sm-8">
								<input type="date" class="form-control" name="tanggal_pengadaan" id="tanggal_pengadaan" readonly>
							</div>
						</div>
						<div class="form-group">
							<label for="alamat" class="col-sm-4 control-label">Alamat</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="alamat" id="alamat" readonly>
							</div>
						</div>
						<div class="form-group">
							<label for="keterangan" class="col-sm-4 control-label">Keterangan</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="keterangan" id="keterangan" readonly>
							</div>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="form-group">
							<label for="periode" class="col-sm-4 control-label">Periode</label>
							<div class="col-sm-8">
								<select name="periode" id="periode" class="form-control pilih-periode">
									<option value="" selected disabled>Pilih Periode</option>
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
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-4"></div>
					<div class="col-lg-4 text-right">
						<button type="submit" class="btn btn-primary" style="margin-left: 30px;">Tambah</button>
						<button type="button" class="btn btn-primary" id="reset" style="margin-left: 30px;">Reset</button>
					</div>
				</div>
			</form>
			<hr>
			<div class="row tabel-barang">

				<table id="example1" class="table table-bordered" style="margin-bottom: 10px; margin-left: 20px; margin-right: 20px;">
					<thead>
						<tr>
							<th>Aksi</th>
							<th>No</th>
							<th>Nama Barang</th>
							<th>Kode Barang</th>
							<th>Jenis</th>
							<th>Kategori</th>
							<th>Tanggal Pengadaan</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$no = 1;
						foreach ($data_inventaris as $inventaris) : ?>
							<tr>
								<td>
									<a href="<?= base_url('laporan/hapus_inventaris_barang/' . $inventaris->id_barang) . "?periode=" . $periode . "&index=" . $index ?>" class="btn btn-default btn-sm" title="Hapus"><i class="fas fa-trash-alt"></i></a>
									<button type="button" class="btn btn-default btn-sm modalBarang" id="modalBarang" title="Detail" data-toggle="modal" data-target="#barangModal" data-id="<?= $inventaris->id_barang ?>"><i class="fas fa-eye"></i></button>
								</td>
								<td><?= $no++; ?></td>
								<td><?= $inventaris->nama_barang; ?></td>
								<td><?= $inventaris->kode; ?></td>
								<td><?= $inventaris->jenis; ?></td>
								<td><?= $inventaris->nama_kategori; ?></td>
								<td><?= cari_tanggal($inventaris->tanggal_pengadaan); ?></td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</section>

<!-- Modal -->
<div class="modal fade" id="barangModal" tabindex="-1" role="dialog" aria-labelledby="barangModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="barangModalLabel">Detail Barang</h4>
			</div>
			<div class="modal-body">
				<form>
					<div class="form-group">
						<label for="modal_nama">Nama Barang</label>
						<input type="text" class="form-control" name="modal_nama" id="modal_nama" readonly>
					</div>
					<div class="form-group">
						<label for="modal_jenis">Jenis Barang</label>
						<input type="text" class="form-control" name="modal_jenis" id="modal_jenis" readonly>
					</div>
					<div class="form-group">
						<label for="modal_kode">Kode Barang</label>
						<input type="text" class="form-control" name="modal_kode" id="modal_kode" readonly>
					</div>
					<div class="form-group">
						<label for="modal_kategori">Kategori Barang</label>
						<input type="text" class="form-control" name="modal_kategori" id="modal_kategori" readonly>
					</div>
					<div class="form-group">
						<label for="modal_kondisi">Kondisi Barang</label>
						<input type="text" class="form-control" name="modal_kondisi" id="modal_kondisi" readonly>
					</div>
					<div class="form-group">
						<label for="modal_keterangan">Keterangan</label>
						<input type="text" class="form-control" name="modal_keterangan" id="modal_keterangan" readonly>
					</div>
					<div class="form-group">
						<label for="modal_tanggal_pengadaan">Tanggal pengadaan</label>
						<input type="date" class="form-control" name="modal_tanggal_pengadaan" id="modal_tanggal_pengadaan" readonly>
					</div>
					<div class="form-group">
						<label for="modal_gambar">Gambar</label>
						<img src="https://source.unsplash.com/600x400/?random" style="width: 100px; height: 100px;">
					</div>
					<div class="form-group">
						<label for="modal_lokasi">Lokasi</label>
						<input type="text" class="form-control" name="modal_lokasi" id="modal_lokasi" readonly>
					</div>


				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<!-- <button type="button" class="btn btn-primary">Save changes</button> -->
			</div>
		</div>
	</div>
</div>

<script src="http://code.jquery.com/jquery-1.9.1.js"></script>

<script type="text/javascript">
	const id_barang = document.querySelector('#id_barang');
	const jenis = document.querySelector('#jenis');
	const tanggal_pengadaan = document.querySelector('#tanggal_pengadaan');
	const alamat = document.querySelector('#alamat');
	const keterangan = document.querySelector('#keterangan');
	const modalBarang = document.querySelector('#modalBarang');
	const modal_nama = document.querySelector('#modal_nama');
	const modal_jenis = document.querySelector('#modal_jenis');
	const modal_kode = document.querySelector('#modal_kode');
	const modal_kategori = document.querySelector('#modal_kategori');
	const modal_kondisi = document.querySelector('#modal_kondisi');
	const modal_keterangan = document.querySelector('#modal_keterangan');
	const modal_tanggal_pengadaan = document.querySelector('#modal_tanggal_pengadaan');
	const modal_lokasi = document.querySelector('#modal_lokasi');
	const reset = document.querySelector('#reset');

	id_barang.addEventListener('change', function() {
		fetch('<?= base_url('Laporan/checkBarang?id_barang=') ?>' + id_barang.value)
			.then(response => response.json())
			.then(data => [
				jenis.value = data.jenis,
				tanggal_pengadaan.value = data.tanggal_pengadaan,
				alamat.value = data.alamat,
				keterangan.value = data.keterangan
			]);

	});

	reset.addEventListener('click', function() {
		jenis.value = '';
		tanggal_pengadaan.value = '';
		alamat.value = '';
		keterangan.value = '';

	});

	$('.modalBarang').on('click', function() {
		// modalBarang.addEventListener('click', function() {
		const id = $(this).data('id');
		fetch('<?= base_url('Laporan/checkBarang?id_barang=') ?>' + id)
			.then(response => response.json())
			.then(data => [
				modal_nama.value = data.nama_barang,
				modal_jenis.value = data.jenis,
				modal_kode.value = data.kode,
				modal_kategori.value = data.nama_kategori,
				modal_kondisi.value = data.kondisi,
				modal_keterangan.value = data.keterangan,
				modal_tanggal_pengadaan.value = data.tanggal_pengadaan,
				modal_lokasi.value = data.nama_lokasi
			]);

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