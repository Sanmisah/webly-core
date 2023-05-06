<?= $this->extend('Webly\Core\Views\Layouts\default') ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Form Data of <?= $form->form ?></h3>
                <div class="card-tools">
                    <a type="button" class="btn bg-info btn-small" href="/admin/forms/export/<?= $form->id ?>" target="_blank"><i class="fas fa-file-download"></i> Export Data</a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <div class="card-body table-responsive p-0">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Submitted On</th>
                                <?php foreach($form->form_fields as $field):?>
                                    <th><?= humanize($field->field) ?></th>
                                <?php endforeach; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($data as $row) : ?>
                            <tr>
                                <td><?= $row->created_at->format('d/m/Y h:i A') ?></td>
                                <?php foreach($form->form_fields as $field): ?>
                                    <td>
                                        <?php
                                            if(isset($row->form_data->{$field->field})) {
                                                if(substr($row->form_data->{$field->field}, 0, 8) === 'uploads/') {
                                                    echo anchor($row->form_data->{$field->field}, $row->form_data->{$field->field}, ['target' => '_blank']);
                                                } else {
                                                    echo $row->form_data->{$field->field};
                                                }
                                            }
                                        ?>
                                    </td>
                                <?php endforeach; ?>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
                <?= $pager->links('default', 'default_adminlte3') ?>
            </div>            
        </div>
        <!-- /.card -->
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
    <script src="/templates/adminlte3/dist/js/pages/common.js"></script>
<?= $this->endSection() ?>