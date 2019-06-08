<main role="main" class="container">
	<div class="row">
		<div class="col-md-10 mx-auto">
			<div class="card mb-3">
				<div class="card-header">
					<span>Formulir Kategori</span>
				</div>
				<div class="card-body">
					<?= form_open($form_action, ['method' => 'POST']) ?>
						<?= isset($input->id) ? form_hidden('id', $input->id) : '' ?>
						<div class="form-group">
							<label for="">Kategori</label>
							<?= form_input('title', $input->title, ['class' => 'form-control', 'id' => 'title', 'onkeyup' => 'createSlug()', 'required' => true, 'autofocus' => true]) ?>
							<?= form_error('title') ?>
						</div>
						<div class="form-group">
							<label for="">Slug</label>
							<?= form_input('slug', $input->slug, ['class' => 'form-control', 'id' => 'slug', 'required' => true]) ?>
							<?= form_error('slug') ?>
						</div>
						<button type="submit" class="btn btn-primary">Simpan</button>
					<?= form_close() ?>
				</div>
			</div>
		</div>
	</div>
</main>
