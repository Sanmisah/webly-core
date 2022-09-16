<?= $this->extend(config('Auth')->views['layout']) ?>
<?= $this->section('main') ?>
<p class="login-box-msg">Sign in to start your session</p>
<form action="<?= url_to('login') ?>" method="post">
<?= csrf_field() ?>
  <div class="input-group mb-3">
	<input type="email" class="form-control" name="email" inputmode="email" autocomplete="email" placeholder="<?= lang('Auth.email') ?>" value="<?= old('email') ?>" required />
	<div class="input-group-append">
	  <div class="input-group-text">
		<span class="fas fa-envelope"></span>
	  </div>
	</div>
  </div>
  <div class="input-group mb-3">
	<input type="password" class="form-control" name="password" inputmode="text" autocomplete="current-password" placeholder="<?= lang('Auth.password') ?>" required />
	<div class="input-group-append">
	  <div class="input-group-text">
		<span class="fas fa-lock"></span>
	  </div>
	</div>
  </div>
  <div class="row">
	<div class="col-8">&nbsp;</div>
	<!-- /.col -->
	<div class="col-4">
	  <button type="submit" class="btn btn-primary btn-block">Sign In</button>
	</div>
	<!-- /.col -->
  </div>
</form>

<?php if (setting('Auth.allowMagicLinkLogins')) : ?>
	<p class="mb-1"><?= lang('Auth.forgotPassword') ?> <a href="<?= url_to('magic-link') ?>"><?= lang('Auth.useMagicLink') ?></a></p>
<?php endif ?>

<?php if (setting('Auth.allowRegistration')) : ?>
	<p class="mb-1"><?= lang('Auth.needAccount') ?> <a href="<?= url_to('register') ?>"><?= lang('Auth.register') ?></a></p>
<?php endif ?>
<?= $this->endSection() ?>