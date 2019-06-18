<main role="main" class="container">
	<?php $this->load->view('layouts/_alert'); ?>
	<div class="row">
		<div class="col-md-3">
			<?php $this->load->view('layouts/_menu'); ?>
		</div>
		<div class="col-md-9">
			<div class="card">
				<div class="card-header">
					Detail Order #01234123
					<div class="float-right">
						<span class="badge badge-pill badge-info">Menunggu Pembayaran</span>
					</div>
				</div>
				<div class="card-body">
					<p>Nama: Nama Penemira</p>
					<p>Telepon: 08991231231</p>
					<p>Alamat: Jl. Sesama, No. 123</p>
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
							<tr>
								<td>
									<p><img src="https://placehold.co/50x50" alt=""> <strong>Produk Title</strong></p>
								</td>
								<td class="text-center">Rp100.000,-</td>
								<td class="text-center">1</td>
								<td class="text-center">Rp100.000,-</td>
							</tr>
							<tr>
								<td colspan="3"><strong>Total:</strong></td>
								<td class="text-center"><strong>Rp100.000,-</strong></td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="card-footer">
					<a href="/orders-confirm.html" class="btn btn-success">Konfirmasi Pembayaran</a>
				</div>
			</div>
		</div>
	</div>
</main>
