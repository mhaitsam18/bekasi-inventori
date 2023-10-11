<section class="content-header">
	<h1>
		Lokasi Barang
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Lokasi Barang</li>
	</ol>
</section>
<!-- Main content -->
<section class="content">
	<div class="box">
		<div class="box-body">
			<table id="example1" class="table table-bordered" style="margin-bottom: 10px">
				<thead>
					<tr>
						<th>No</th>
						<th>ID Kartu</th>
						<th>ID Lokasi</th>
						<th>Nama Lokasi</th>
						<th>Alamat</th>
						<th>Tanggal dibuat</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php $no = 1;
					foreach ($data_lokasi as $lokasi) : ?>
						<?php if ($lokasi->kode_pengesahan) {
							$warna = "bg-success";
						} else {
							$warna = "bg-danger";
						}
						?>
						<tr class="<?= $warna ?>">
							<td width="80px"><?php echo $no++ ?></td>
							<td><?php echo $lokasi->id_kartu_inventaris_barang ?></td>
							<td><?php echo $lokasi->id_lokasi ?></td>
							<td><?php echo $lokasi->nama_lokasi ?></td>
							<td><?php echo $lokasi->alamat ?></td>
							<td><?php echo cari_tanggal($lokasi->created_at) ?></td>
							<td><?= ($lokasi->kode_pengesahan) ? "Telah disahkan" : "Belum disahkan" ?></td>
							<td style="text-align:center" width="200px">
								<!-- <a href="<?= site_url('laporan/kelola_barang/' . $lokasi->lokasi_id) ?>" class="btn btn-warning btn-sm">Kelola Kartu Inventaris Barang</a> -->
								<a href="<?= site_url('laporan/pilih_periode/' . $lokasi->lokasi_id) ?>" class="btn btn-warning btn-sm">Kelola Kartu Inventaris Barang</a>
								<a href="<?= site_url('laporan/KartuInventarisBarang/' . $lokasi->id_kartu_inventaris_barang) ?>" class="btn btn-info btn-sm">Lihat Kartu</a>
								<a href="<?= site_url('laporan/KategoriKartuInventarisBarang/' . $lokasi->id_kartu_inventaris_barang . '/' . $lokasi->lokasi_id) ?>" class="btn btn-info btn-sm">Lihat KIB</a>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</section>