<?= $this->extend('Webly\Core\Views\Layouts\email') ?>
<?= $this->section('content') ?>
<p>Hi there,</p>
<p>Use a Following Login Link.</p>
<table role="presentation" border="0" cellpadding="0" cellspacing="0" class="btn btn-primary">
    <tbody>
    <tr>
        <td align="left">
        <table role="presentation" border="0" cellpadding="0" cellspacing="0">
            <tbody>
            <tr>
                <td> <a href="<?= url_to('verify-magic-link') ?>?token=<?= $token ?>"><?= lang('Auth.login') ?></a> </td>
            </tr>
            </tbody>
        </table>
        </td>
    </tr>
    </tbody>
</table>
<p>Good luck! Hope it works.</p>
<?= $this->endSection() ?>