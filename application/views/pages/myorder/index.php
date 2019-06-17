<main role="main" class="container">
	<div class="row">
		<div class="col-md-3">
			<?php $this->load->view('layouts/_menu'); ?>
		</div>
		<div class="col-md-9">
			<div class="card">
				<div class="card-header">
					Daftar Orders
				</div>
				<div class="card-body">
					<table class="table">
						<thead>
							<tr>
								<th>Nomor</th>
								<th>Tanggal</th>
								<th>Total</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<a href="/orders-detail.html"><strong>#012341234</strong></a>
								</td>
								<td>2019/05/20</td>
								<td>Rp300.000,-</td>
								<td>
									<span class="badge badge-pill badge-info">Menunggu Pembayaran</span>
								</td>
							</tr>
							<tr>
								<td>
									<a href="/orders-detail.html"><strong>#012341234</strong></a>
								</td>
								<td>2019/05/19</td>
								<td>Rp300.000,-</td>
								<td>
									<span class="badge badge-pill badge-success">Dikirim</span>
								</td>
							</tr>
							<tr>
								<td>
									<a href="/orders-detail.html"><strong>#012341234</strong></a>
								</td>
								<td>2019/05/10</td>
								<td>Rp300.000,-</td>
								<td>
									<span class="badge badge-pill badge-danger">Dibatalkan</span>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</main>
