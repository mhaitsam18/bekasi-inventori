<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sistem Informasi Inventarisasi Aset Kecamatan | Kota Bekasi | Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/fontawesome-free-5.15.4-web/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/dist/css/skins/_all-skins.min.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/morris.js/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/jvectormap/jquery-jvectormap.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <style>
        .swal-wide {
            width: 850px !important;
        }
    </style>
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        <header class="main-header">
            <!-- Logo -->
            <a href="index2.html" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>SIVA </b>DES</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b>Digital </b>Inventarisasi Aset Kecamatan Kota Bekasi</span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>

                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="<?php echo base_url() ?>assets/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                                <span class="hidden-xs"><?= $this->session->username; ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    <img src="<?php echo base_url() ?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                                    <p>
                                        <?= $this->session->username; ?>
                                    </p>
                                </li>
                                <!-- Menu Body -->

                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-right">
                                        <a href="<?php echo site_url() ?>/dashboard/logout" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <!-- Control Sidebar Toggle Button -->
                        <!-- <li>
                            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                        </li> -->
                    </ul>
                </div>
            </nav>
        </header>
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- Sidebar user panel -->
                <div class="user-panel">
                    <div class="pull-left image">
                        <img src="<?php echo base_url() ?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                    </div>
                    <div class="pull-left info">
                        <p><?= $this->session->username; ?></p>
                        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                    </div>
                </div>
                <!-- search form -->
                <form action="#" method="get" class="sidebar-form">
                    <div class="input-group">
                        <input type="text" name="q" class="form-control" placeholder="Search...">
                        <span class="input-group-btn">
                            <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                            </button>
                        </span>
                    </div>
                </form>
                <!-- /.search form -->
                <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="header">MAIN NAVIGATION</li>


                    <?php if ($this->session->hak_akses == 'admin') : ?>
                        <li class="">
                            <a href="<?php echo site_url() ?>dashboard">
                                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                            </a>
                        </li>

                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-check-square"></i> <span>Transaksi</span>
                            </a>
                            <ul class="treeview-menu">
                                <li class="active"><a href="<?php echo site_url() ?>transaksi"><i class="fa fa-circle-o"></i> Semua</a></li>
                                <li class="active"><a href="<?php echo site_url() ?>transaksi/index/0"><i class="fa fa-circle-o"></i> Belum disetujui</a></li>
                                <li class="active"><a href="<?php echo site_url() ?>transaksi/index/1"><i class="fa fa-circle-o"></i> Sudah disetujui</a></li>
                                <li class="active"><a href="<?php echo site_url() ?>transaksi/index/2"><i class="fa fa-circle-o"></i> Tidak disetujui</a></li>
                                <li><a href="<?php echo site_url() ?>distribusi"><i class="fa fa-circle-o"></i> Distribusi</a></li>
                            </ul>
                        </li>

                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-check-square"></i> <span>Kondisi barang</span>

                            </a>
                            <ul class="treeview-menu">
                                <li class="active"><a href="<?php echo site_url() ?>kondisi/baik"><i class="fa fa-circle-o"></i> Baik</a></li>
                                <li><a href="<?php echo site_url() ?>kondisi/buruk"><i class="fa fa-circle-o"></i> Buruk </a></li>
                                <li><a href="<?php echo site_url() ?>kondisi/rusak"><i class="fa fa-circle-o"></i> Rusak </a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="<?php echo base_url() ?>barang">
                                <i class="fa fa-book"></i>
                                <span>Kelola Inventaris Aset</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>kategori">
                                <i class="fa fa-th"></i> <span>Kelola kategori</span>

                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>petugas">
                                <i class="fa fa-users"></i> <span>Kelola petugas</span>

                            </a>
                        </li>
                        <!-- <li>
                            <a href="<?php echo base_url('laporan/barang'); ?>">
                                <i class="fa fa-credit-card"></i> <span>Kartu Inventaris Barang</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('laporan/ruangan'); ?>">
                                <i class="fa fa-credit-card"></i> <span>Kartu Inventaris Ruangan</span>
                            </a>
                        </li> -->
                        <!-- <li>
                            <a href="<?php echo base_url('laporan/'); ?>">
                                <i class="fa fa-file"></i> <span>Laporan Transaksi</span>
                            </a>
                        </li> -->

                    <?php elseif ($this->session->hak_akses == 'petugas') : ?>

                        <!-- <li class="">
                            <a href="<?php echo site_url() ?>dashboard">
                                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                            </a>
                        </li> -->
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-check-square"></i> <span>Transaksi/Pinjam barang</span>
                            </a>
                            <ul class="treeview-menu">
                                <li class="active"><a href="<?php echo site_url() ?>transaksi/create"><i class="fa fa-circle-o"></i> Buat pinjaman</a></li>
                                <li><a href="<?php echo site_url() ?>transaksi"><i class="fa fa-circle-o"></i>Lihat status</a></li>
                            </ul>
                        </li>
                    <?php elseif ($this->session->hak_akses == 'pengelola') : ?>
                        <li>
                            <a href="<?php echo base_url('dashboard'); ?>">
                                <i class="fa fa-users"></i> <span>Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('user/profile'); ?>">
                                <i class="fa fa-user"></i> <span>My Profile</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('lokasi'); ?>">
                                <i class="fa fa-credit-card"></i> <span>Data Lokasi</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('laporan/barang'); ?>">
                                <i class="fa fa-credit-card"></i> <span>Kartu Inventaris Barang</span>
                            </a>
                        </li>
                        <!-- <li>
                            <a href="<?php echo base_url('laporan/ruangan'); ?>">
                                <i class="fa fa-credit-card"></i> <span>Kartu Inventaris Ruangan</span>
                            </a>
                        </li> -->
                    <?php elseif ($this->session->hak_akses == 'kecamatan') : ?>
                        <li>
                            <a href="<?php echo base_url('user/profile'); ?>">
                                <i class="fa fa-user"></i> <span>My Profile</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('pengesahan/'); ?>">
                                <i class="fa fa-file"></i> <span>Pengesahan</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('pengesahan/histori'); ?>">
                                <i class="fa fa-file"></i> <span>Histori Pengesahan</span>
                            </a>
                        </li>

                    <?php endif; ?>
                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->

            <?php $this->load->view($page); ?>

            <!-- right col -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b>Version</b> 24.07.22
            </div>
            <strong>Copyright &copy; 2021-2022 <a href="https://adminlte.io">SiVaCam</a>.</strong> All rights
            reserved.
        </footer>

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
            $('.kategori-barang').on('click', function(e) {
                const kondisi = $('#kondisi').val();
                const kategori_id = $(this).data('kategori');
                $.ajax({
                    url: "<?= base_url('barang/barang_list') ?>",
                    type: "post",
                    data: {
                        'kondisi': kondisi,
                        'kategori_id': kategori_id,
                    },
                    success: function(data) {
                        $('#barang_list').html(data);
                    }
                });
            });
            $('.kondisi-barang').on('click', function(e) {
                const kondisi = $(this).data('kondisi');
                const kategori_id = $('#kategori_id').val();
                $.ajax({
                    url: "<?= base_url('barang/barang_list') ?>",
                    type: "post",
                    data: {
                        'kondisi': kondisi,
                        'kategori_id': kategori_id,
                    },
                    success: function(data) {
                        $('#barang_list').html(data);
                    }
                });
            });



            $.widget.bridge('uibutton', $.ui.button);
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
            $(function() {
                $('#example2').DataTable({
                    'paging': true,
                    'lengthChange': true,
                    'searching': true,
                    'ordering': true,
                    'info': true,
                    'autoWidth': true
                })
            })
            $(function() {
                $('#example3').DataTable({
                    'paging': true,
                    'lengthChange': true,
                    'searching': true,
                    'ordering': true,
                    'info': true,
                    'autoWidth': true
                })
            })
            $(function() {
                $('#example4').DataTable({
                    'paging': true,
                    'lengthChange': true,
                    'searching': true,
                    'ordering': true,
                    'info': true,
                    'autoWidth': true
                })
            })
            $(function() {
                $('#example5').DataTable({
                    'paging': true,
                    'lengthChange': true,
                    'searching': true,
                    'ordering': true,
                    'info': true,
                    'autoWidth': true
                })
            })
            $(function() {
                $('#example6').DataTable({
                    'paging': true,
                    'lengthChange': true,
                    'searching': true,
                    'ordering': true,
                    'info': true,
                    'autoWidth': true
                })
            })
            $(function() {
                $('#example7').DataTable({
                    'paging': true,
                    'lengthChange': true,
                    'searching': true,
                    'ordering': true,
                    'info': true,
                    'autoWidth': true
                })
            })
            $(function() {
                $('#example8').DataTable({
                    'paging': true,
                    'lengthChange': true,
                    'searching': true,
                    'ordering': true,
                    'info': true,
                    'autoWidth': true
                })
            })
        </script>
        <!-- Bootstrap 3.3.7 -->
        <script src="<?php echo base_url() ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- Morris.js charts -->
        <script src="<?php echo base_url() ?>assets/bower_components/raphael/raphael.min.js"></script>
        <script src="<?php echo base_url() ?>assets/bower_components/morris.js/morris.min.js"></script>
        <!-- Sparkline -->
        <script src="<?php echo base_url() ?>assets/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
        <!-- jvectormap -->
        <script src="<?php echo base_url() ?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
        <script src="<?php echo base_url() ?>assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
        <!-- jQuery Knob Chart -->
        <script src="<?php echo base_url() ?>assets/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
        <!-- daterangepicker -->
        <script src="<?php echo base_url() ?>assets/bower_components/moment/min/moment.min.js"></script>
        <script src="<?php echo base_url() ?>assets/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
        <!-- datepicker -->
        <script src="<?php echo base_url() ?>assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="<?php echo base_url() ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
        <!-- Slimscroll -->
        <script src="<?php echo base_url() ?>assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
        <!-- FastClick -->
        <script src="<?php echo base_url() ?>assets/bower_components/fastclick/lib/fastclick.js"></script>
        <!-- AdminLTE App -->
        <script src="<?php echo base_url() ?>assets/dist/js/adminlte.min.js"></script>
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="<?php echo base_url() ?>assets/dist/js/pages/dashboard.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="<?php echo base_url() ?>assets/dist/js/demo.js"></script>
</body>

</html>