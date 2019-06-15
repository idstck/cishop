<main role="main" class="container">
	<?php $this->load->view('layouts/_alert') ?>
	<div class="row">
		<div class="col-md-9">
			<div class="row">
				<div class="col-md-12">
					<div class="card mb-3">
						<div class="card-body">
							Kategori: <strong><?= isset($category) ? $category : 'Semua Kategori' ?></strong>
							<span class="float-right">
								Urutkan Harga: <a href="<?= base_url("/shop/sortby/asc") ?>" class="badge badge-primary">Termurah</a> | <a href="<?= base_url("/shop/sortby/desc") ?>" class="badge badge-primary">Termahal</a>
							</span>
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<?php foreach($content as $row) : ?>
				<div class="col-md-6">
					<div class="card mb-3">
						<img src="<?= $row->image ? base_url("/images/product/$row->image") : base_url("/images/product/default.png") ?>" alt="" height="" class="card-img-top">
						<div class="card-body">
							<h5 class="card-title"><?= $row->product_title ?></h5>
							<p class="card-text"><strong>Rp<?= number_format($row->price, 0, ',', '.') ?>,-</strong></p>
							<p class="card-text"><?= $row->description ?></p>
							<a href="<?= base_url("/shop/category/$row->category_slug") ?>" class="badge badge-primary"><i class="fas fa-tags"></i> <?= $row->category_title ?></a>
						</div>
						<div class="card-footer">
							<form action="<?= base_url("/cart/add") ?>" method="POST">
								<input type="hidden" name="id_product" value="<?= $row->id ?>">
								<div class="input-group">
									<input type="number" name="qty" value="1" class="form-control">
									<div class="input-group-append">
										<button class="btn btn-primary">Add to Cart</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
				<?php endforeach ?>
			</div>

			<nav aria-label="Page navigation example">
				<?= $pagination ?>
			</nav>
		</div>
		<div class="col-md-3">
			<div class="row">
				<div class="col-md-12">
					<div class="card mb-3">
						<div class="card-header">
							Pencarian
						</div>
						<div class="card-body">
							<form action="<?= base_url("/shop/search") ?>" method="POST">
								<div class="input-group">
									<input type="text" name="keyword" placeholder="Cari" value="<?= $this->session->userdata('keyword') ?>" class="form-control">
									<div class="input-group-append">
										<button class="btn btn-primary" type="submit">
											<i class="fas fa-search"></i>
										</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="card mb-3">
						<div class="card-header">
							Kategori
						</div>
						<ul class="list-group list-group-flush">
							<li class="list-group-item"><a href="<?= base_url('/') ?>">Semua Kategori</a></li>
							<?php foreach(getCategories() as $category) : ?>
							<li class="list-group-item"><a href="<?= base_url("/shop/category/$category->slug") ?>"><?= $category->title ?></a></li>
							<?php endforeach ?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>

