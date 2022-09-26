<?= $this->extend('Webly\Core\Views\Layouts\default') ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Forms</h3>
                <div class="card-tools">
                    <a type="button" class="btn bg-success btn-small" href="forms/create"><i class="fas fa-plus"></i> Create</a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Form</th>
                            <th style="width: 200px;">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($forms as $form) : ?>
                        <tr>
                            <td><?= $form->form?></td>
                            <td class="float-right">
                                <div class="btn-group">
                                    <a type="button" class="btn bg-info btn-sm" href="forms/data/<?= $form->id?>" target="_blank"><i class="fas fa-list"></i> Data</a>
                                    <a type="button" class="btn bg-warning btn-sm" href="forms/update/<?= $form->id?>"><i class="fas fa-edit"></i></a>
                                    <a type="button" class="btn bg-danger btn-sm delete" href="forms/delete/<?= $form->id?>"><i class="far fa-trash-alt"></i></a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
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