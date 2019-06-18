<main role="main" class="container">
	<?php $this->load->view('layouts/_alert'); ?>
	<div class="row">
		<div class="col-md-3">
			<?php $this->load->view('layouts/_menu'); ?>
		</div>
		<div class="col-md-9">
			<div class="card">
				<div class="card-header">
					Detail Order #<?= $order->invoice ?>
					<div class="float-right">
						<?php $this->load->view('layouts/_status', ['status' => $order->status]); ?>
					</div>
				</div>
				<div class="card-body">
					<p>Tanggal: <?= str_replace('-', '/', date("d-m-Y", strtotime($order->date))) ?></p>
					<p>Nama: <?= $order->name ?></p>
					<p>Telepon: <?= $order->phone ?></p>
					<p>Alamat: <?= $order->address ?></p>
					<table class="table">
						<thead>
							<tr>
								<th>Produk</th>
								<th class="text-center">Harga</th>
								<th class="text-center">Jumlah</th>
								<th class="text-center">Subtotal</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($order_detail as $row) : ?>
							<tr>
								<td>
									<p><img src="<?= $row->image ? base_url("/images/product/$row->image") : base_url('/images/product/default.png') ?>" alt="" height="50"> <strong><?= $row->title ?></strong></p>
								</td>
								<td class="text-center">Rp<?= number_format($row->price, 0, ',', '.') ?>,-</td>
								<td class="text-center"><?= $row->qty ?></td>
								<td class="text-center">Rp<?= number_format($row->subtotal, 0, ',', '.') ?>,-</td>
							</tr>
							<?php endforeach ?>
							<tr>
								<td colspan="3"><strong>Total:</strong></td>
								<td class="text-center"><strong>Rp<?= number_format(array_sum(array_column($order_detail, 'subtotal')), 0, ',', '.') ?>,-</strong></td>
							</tr>
						</tbody>
					</table>
				</div>
				<?php if ($order->status == 'waiting') : ?>
				<div class="card-footer">
					<a href="<?= base_url("/myorder/confirm/$order->invoice") ?>" class="btn btn-success">Konfirmasi Pembayaran</a>
				</div>
				<?php endif ?>
			</div>

			<?php if (isset($order_confirm)) : ?>
			<div class="row mb-3">
				<div class="col-md-8">
					<div class="card">
						<div class="card-header">
							Bukti Transfer
						</div>
						<div class="card-body">
							<p>No Rekening: <?= $order_confirm->account_number ?></p>
							<p>Atas Nama: <?= $order_confirm->account_name ?></p>
							<p>Nominal: Rp<?= number_format($order_confirm->nominal, 0, ',', '.') ?>,-</p>
							<p>Catatan: <?= $order_confirm->note ?></p>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<img src="<?= base_url("/images/confirm/$order_confirm->image") ?>" alt="" height="200">
				</div>
			</div>
			<?php endif ?>
		</div>
	</div>
</main>
