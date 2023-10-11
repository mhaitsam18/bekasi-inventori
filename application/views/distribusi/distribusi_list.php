<section class="content-header">
    <h1>
        Transaksi   
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Kelola Transaksi </li>
    </ol>
</section>

    <!-- Main content -->
<section class="content">

    <div style="margin-bottom:1em">
        <!-- <a href="<?= base_url(); ?>transaksi/create" class="btn btn-primary">Buat Transaksi</a> -->
		<?php echo anchor(site_url('transaksi/excel'), 'Excel', 'class="btn btn-primary"'); ?>
    </div>

    
    <div style="margin-bottom: 8px" id="message">
        <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
    </div>

    <div class="box">
        <div class="box-body">
        <table id="example1" class="table table-bordered" style="margin-bottom: 10px">
            <thead>
            <tr>
                <th>No</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Tanggal Datang</th>
                <th>Tanggal Distribusi</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $no =1;
            foreach ($transaksi_data as $transaksi)
            {
                ?>
                <tr>
			<td width="80px"><?php echo $no++ ?></td>
			<td><?php echo $transaksi->kode_barang ?></td>
			<td><?php echo $transaksi->nama ?></td>
			<td><?php echo $transaksi->tanggal_datang ?></td>
			<td><?php echo $transaksi->tanggal_distribusi ?></td>
			<td><?php echo $transaksi->status ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('transaksi/read/'.$transaksi->id),'Read'); 
				echo ' | '; 
				echo anchor(site_url('transaksi/update/'.$transaksi->id),'Update'); 
				echo ' | '; 
				echo anchor(site_url('transaksi/delete/'.$transaksi->id),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
				?>
			</td>
		</tr>
                <?php
            }
            ?>
            </tbody>
        </table>
        </div>
        </div>
        </section>