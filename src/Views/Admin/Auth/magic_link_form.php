<?= $this->extend(config('Auth')->views['layout']) ?>
<?= $this->section('main') ?>
<p class="login-box-msg">Use a Login Link</p>
<form action="<?= url_to('magic-link') ?>" method="post">
<?= csrf_field() ?>
  <div class="input-group mb-3">
    <input type="email" class="form-control" name="email" autocomplete="email" placeholder="<?= lang('Auth.email') ?>" value="<?= old('email', auth()->user()->email ?? null) ?>" required />
	<div class="input-group-append">
	  <div class="input-group-text">
		<span class="fas fa-envelope"></span>
	  </div>
	</div>
  </div>
  <div class="row">
	<div class="col-8">&nbsp;</div>
	<!-- /.col -->
	<div class="col-4">
        <button type="submit" class="btn btn-primary btn-block"><?= lang('Auth.send') ?></button>
	</div>
	<!-- /.col -->
  </div>
</form>

<?= $this->endSection() ?>
