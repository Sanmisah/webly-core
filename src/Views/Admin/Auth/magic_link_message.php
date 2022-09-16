<?= $this->extend(config('Auth')->views['layout']) ?>
<?= $this->section('main') ?>

<h5><?= lang('Auth.useMagicLink') ?></h5>

<p><b><?= lang('Auth.checkYourEmail') ?></b></p>

<p><?= lang('Auth.magicLinkDetails', [setting('Auth.magicLinkLifetime') / 60]) ?></p>

<?= $this->endSection() ?>
