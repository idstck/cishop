<main role="main" class="container">
	<?php $this->load->view('layouts/_alert') ?>
	<div class="row">
		<div class="col-md-8 mx-auto">
			<div class="card">
				<div class="card-header">
					Formulir Registrasi
				</div>
				<div class="card-body">
					<?= form_open('register', ['method' => 'POST']) ?>
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
							<?= form_password('password', '', ['class' => 'form-control', 'placeholder' => 'Masukkan password minimal 8 karakter', 'required' => true]) ?>
							<?= form_error('password') ?>
						</div>
						<div class="form-group">
							<label for="">Konfirmasi Password</label>
							<?= form_password('password_confirmation', '', ['class' => 'form-control', 'placeholder' => 'Masukkan password yang sama', 'required' => true]) ?>
							<?= form_error('password_confirmation') ?>
						</div>
						<button type="submit" class="btn btn-primary">Register</button>
					<?= form_close() ?>
				</div>
			</div>
		</div>
	</div>
</main>
