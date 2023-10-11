<section class="content-header">
	<h1>
		Kartu Inventaris Ruangan
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Kartu Inventaris Ruangan</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
	<div class="box">
		<div class="box-body">
			<div class="row">
				<div class="col text-center">
					<h3>Pemerintahan Kota Bekasi</h3>
					<h4>Kartu Inventaris Ruangan</h4>
				</div>
				<div class="col-lg-6 text-bold">
					<!-- <img src="<?= site_url('login/qrcode/bekasi.id/4') ?>"> -->
					<img src="<?= site_url('assets/img/logo-kota-bekasi.png') ?>" width="100">
					<div class="row">
						<div class="col-md-3">Nama Lokasi</div>
						<div class="col-md-1"> : </div>
						<div class="col-md-8"><?= $lokasi->nama_lokasi ?></div>
						<div class="col-md-3">Alamat</div>
						<div class="col-md-1"> : </div>
						<div class="col-md-8"><?= $lokasi->alamat ?></div>
						<div class="col-md-3">Kecamtan</div>
						<div class="col-md-1"> : </div>
						<div class="col-md-8"><?= $lokasi->nama_kecamatan ?></div>
					</div>
				</div>
				<div class="col-lg-6">
				</div>
			</div>
			<?php if ($lokasi->status_pengesahan == 1): ?>
				<div class="alert alert-success mt-3" role="alert" style="margin-top: 10px" id="hilang1">
					Status Pengesahan : Sudah disahkan
				</div>
				<a href="#" onclick="printKartu()" class="btn btn-primary" id="hilang2"> <i class="fa fa-print"></i> Print </a>
			<?php else: ?>
				<div class="alert alert-danger mt-3" role="alert" style="margin-top: 10px" id="hilang1">
					Status Pengesahan : Belum disahkan
				</div>
			<?php endif ?>
			<table id="example1" class="table table-bordered" style="margin-bottom: 10px">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama Ruangan</th>
						<th>Status</th>
						<th>Keterangan</th>
						<th>Lokasi</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$no = 1;
					foreach($data_ruangan as $ruangan) : ?>
						<tr>
							<td><?= $no++; ?></td>
							<td><?= $ruangan->nama_ruangan;?></td>
							<td><?= $ruangan->status;?></td>
							<td><?= $ruangan->keterangan;?></td>
							<td><?= $ruangan->nama_lokasi;?></td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			<div class="row">
				<div class="col-lg-8"></div>
				<div class="col-lg-4 text-center text-bold">
					Mengetahui
					<br>
					Camat <?= $lokasi->nama_kecamatan ?>
					<br>
					Bekasi, 
					<?php if ($lokasi->kode_pengesahan): ?>
						<?= cari_tanggal($lokasi->updated_at) ?>
						<br>
						<img src="<?= site_url('login/qrcode/'.$lokasi->kode_pengesahan.'/3') ?>">
					<?php elseif($this->session->userdata('hak_akses') == 'kecamatan'): ?>
						<br>
						<div class="row" style="padding: 20px">
							<a href="<?= base_url('pengesahan/pengesahanRuangan/'.$lokasi->id_kartu_inventaris_ruangan) ?>" class="btn btn-success"><i class="fa fa-edit"></i> Tandatangani Laporan</a>
						</div>
					<?php else: ?>
						<br>
						<br>
						<br>
						<br>
						<br>
						<br>
					<?php endif ?>
					<?php if ($lokasi->id_camat): ?>
						<?php 
						$camat = $this->db->get_where('user', ['id' => $lokasi->id_camat])->row();
						 ?>
						 <br>
						<?= $camat->nama_operator ?>	
					<?php endif ?>
					<br>
					<!-- <?= $lokasi->nama_operator ?>	 -->
					<hr style="margin-top:0;">
				</div>
			</div>
		</div>
	</div>
</section>
<script>
function printKartu() {
  var x = document.getElementById("hilang1");
  var y = document.getElementById("hilang2");
    x.style.display = "none";
    y.style.display = "none";
    window.print();
}
</script>