<main role="main" class="container">
	<div class="row">
		<div class="col-md-3">
			<?php $this->load->view('layouts/_menu'); ?>
		</div>
		<div class="col-md-9">
			<div class="card">
				<div class="card-header">
					Formulir Profile
				</div>
				<div class="card-body">
					<?= form_open_multipart($form_action, ['method' => 'POST']) ?>
						<?= isset($input->id) ? form_hidden('id', $input->id) : '' ?>
						<div class="form-group">
							<label for="">Nama</label>
							<?= form_input('name', $input->name, ['class' => 'form-control', 'required' => true, 'autofocus' => true]) ?>
							<?= form_error('name') ?>
						</div>
						<div class="form-group">
							<label for="">E-Mail</label>
							<?= form_input(['type' => 'email', 'name' => 'email', 'value' => $input->email, 'class' => 'form-control', 'placeholder' => 'Masukkan alamat email aktif', 'required' => true]) ?>
							<?= form_error('email') ?>
						</div>
						<div class="form-group">
							<label for="">Password</label>
							<?= form_password('password', '', ['class' => 'form-control', 'placeholder' => 'Masukkan password minimal 8 karakter']) ?>
							<?= form_error('password') ?>
						</div>
						<div class="form-group">
							<label for="">Foto</label>
							<br>
							<?= form_upload('image') ?>
							<?php if ($this->session->flashdata('image_error')) : ?>
								<small class="form-text text-danger"><?= $this->session->flashdata('image_error') ?></small>
							<?php endif ?>
							<?php if (isset($input->image)): ?>
								<img src="<?= base_url("/images/user/$input->image") ?>" alt="" height="150">
							<?php endif ?>
						</div>
						<button type="submit" class="btn btn-primary">Simpan</button>
					<?= form_close() ?>
				</div>
			</div>
		</div>
	</div>
</main>
