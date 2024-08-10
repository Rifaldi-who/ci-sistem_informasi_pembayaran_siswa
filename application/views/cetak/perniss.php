<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= $title ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i><?= $title ?></a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="box">
                    <div class="box-header">
                        <?php foreach ($transaksi as $trx) : ?>
                            <?php
                            $idtrx = $trx['id_trx'];
                            $qkelas = "SELECT *
                                        FROM `kelas` JOIN `transaksi`
                                        ON `kelas`.`id_kelas` = `transaksi`.`kelas`
                                        WHERE `transaksi`.`niss` = $niss";
                            $kelasqu = $this->db->query($qkelas)->result_array();
                            ?>
                        <?php endforeach; ?>
                        <h3 class="box-title">Kuitansi Pembayaran</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="text-center">
                            <img src="<?= base_url('assets') ?>/dist/img/idrus.png" alt="" width="100">
                            <h3>MAS AL-IDRUS</h3>
                            <p>Dikeluarkan oleh: Keuangan Sekolah</p>
                        </div>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>NISS</th>
                                    <th>Nama</th>
                                    <th>Kelas</th>
                                    <th>Jenis</th>
                                    <th>Nominal</th>
                                    <th>Status</th>
                                    <th>Kekurangan</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $kurang = 0;
                                $total = 0; ?>
                                <?php if ($transaksi != null) : ?>
                                    <?php foreach ($kelasqu as $qu) : ?>
                                        <tr>
                                            <td><?= $qu['id_trx']; ?></td>
                                            <td><?= $qu['niss']; ?></td>
                                            <td><?= $qu['nama']; ?></td>
                                            <td><?= $qu['nkelas'] . $qu['sub']; ?></td>
                                            <td><?= $qu['jenis']; ?></td>
                                            <td>Rp. <?= $qu['nominal']; ?>,-</td>
                                            <?php if ($qu['status'] != 0) : ?>
                                                <td><span class="label label-success">Lunas</span></td>
                                            <?php else : ?>
                                                <td><span class="label label-danger">Belum Lunas</span></td>
                                            <?php endif; ?>
                                            <td>Rp. <?= $qu['kurang']; ?>,-</td>
                                            <td><?= $qu['tanggal']; ?></td>
                                        </tr>

                                        <?php
                                        $kurang = $kurang + $qu['kurang'];
                                        $total = $total + $qu['nominal'];
                                        ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                        <div class="text-center">
                            <h4>Total : Rp. <?= $total; ?>,-</h4>
                            <h4>Kurang : Rp. <?= $kurang; ?>,-</h4>
                            <p>Tanggal Cetak: <?= date('Y-m-d'); ?></p>
                        </div>
                        <div class="text-right" style="margin-top: 50px;">
    <p>___________________________</p>
    <p style="margin-bottom: 20px;">Nama Keuangan</p>
    <p>Tanda Tangan: ___________________________</p>
</div>

                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button class="btn btn-primary hilang" onclick="myFunction()"><i class="fa fa-print"></i> Cetak</button>
                        <script>
                            function myFunction() {
                                window.print();
                            }
                        </script>
                    </div>
                    <!-- /.box-footer -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<style>
    @media print {
        .hilang {
            display: none;
        }
    }
</style>
