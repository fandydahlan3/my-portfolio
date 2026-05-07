<div class="container">
    <h3>Bayar Angsuran</h3>
    <div class="card mb-4">
        <div class="card-body">
            <?php
                $pembayaranModel = new \App\Models\m_pembayaran();
                $totalBayar = $pembayaranModel
                                ->where('id_angsuran', $angsuran['id_angsuran'])
                                ->selectSum('nominal_bayar')
                                ->first()['nominal_bayar'] ?? 0;
                $sisa = $angsuran['nominal_angsuran'] - $totalBayar;
            ?>
            <form action="<?= base_url('d_angsuran/bayar/'.$angsuran['id_angsuran']) ?>" method="post">
                <?= csrf_field() ?>
                
                <div class="mb-3">
                    <label>Nomor Anggota</label>
                    <input type="text" class="form-control" value="<?= $angsuran['nomor_anggota'] ?>" readonly>
                </div>

                <div class="mb-3">
                    <label>Total Angsuran</label>
                    <input type="text" class="form-control" value="Rp <?= number_format($angsuran['nominal_angsuran'],2,',','.') ?>" readonly>
                </div>

                <div class="mb-3">
                    <label>Total Sudah Dibayar</label>
                    <input type="text" class="form-control" value="Rp <?= number_format($totalBayar,2,',','.') ?>" readonly>
                </div>

                <div class="mb-3">
                    <label>Sisa Angsuran</label>
                    <input type="text" class="form-control" value="Rp <?= number_format($sisa,2,',','.') ?>" readonly>
                </div>

                <div class="mb-3">
                    <label>Jumlah Bayar</label>
                    <input type="number" step="0.01" class="form-control" name="nominal_bayar" max="<?= $sisa ?>" required>
                </div>

                <div class="mb-3">
                    <label>Tanggal Bayar</label>
                    <input type="date" class="form-control" name="tanggal_bayar" value="<?= date('Y-m-d') ?>" required>
                </div>

                <button type="submit" class="btn btn-primary">Bayar</button>
            </form>
        </div>
    </div>
    <!-- Tabel cicilan sebelumnya -->
    <div class="card">
        <div class="card-header">Riwayat Pembayaran</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nominal Bayar</th>
                            <th>Tanggal Bayar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $cicilan = $pembayaranModel->where('id_angsuran', $angsuran['id_angsuran'])->findAll();
                        $no=1;
                        foreach($cicilan as $c): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td>Rp <?= number_format($c['nominal_bayar'],2,',','.') ?></td>
                                <td><?= $c['tanggal_bayar'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                        <?php if(!$cicilan) : ?>
                            <tr>
                                <td colspan="3" class="text-center">Belum ada pembayaran</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
