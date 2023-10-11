<section class="content-header">
	<h1>
		Lokasi Ruangan
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Lokasi Ruangan</li>
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
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php $no =1; foreach ($data_lokasi as $lokasi): ?>
						<tr>
							<td width="80px"><?php echo $no++ ?></td>
							<td><?php echo $lokasi->id_kartu_inventaris_ruangan ?></td>
							<td><?php echo $lokasi->id_lokasi ?></td>
							<td><?php echo $lokasi->nama_lokasi ?></td>
							<td><?php echo $lokasi->alamat ?></td>
							<td><?php echo cari_tanggal($lokasi->created_at) ?></td>
							<td style="text-align:center" width="200px">
								<a href="<?= site_url('laporan/kartuInventarisruangan/'.$lokasi->id_kartu_inventaris_ruangan) ?>" class="btn btn-info btn-sm">Lihat Kartu</a>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</section>