<?= $this->extend('Webly\Core\Views\Layouts\default') ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Blocks</h3>
                <div class="card-tools">
                    <a type="button" class="btn bg-success btn-small" href="blocks/create"><i class="fas fa-plus"></i> Create</a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Block</th>
                            <th style="width: 40px">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($blocks as $block) : ?>
                        <tr>
                            <td><?= $block->block?></td>
                            <td>
                                <div class="btn-group">
                                    <a type="button" class="btn bg-warning btn-sm" href="blocks/update/<?= $block->id?>"><i class="fas fa-edit"></i></a>
                                    <a type="button" class="btn bg-danger btn-sm delete" href="blocks/delete/<?= $block->id?>"><i class="far fa-trash-alt"></i></a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
                <?= $pager->links() ?>
            </div>            
        </div>
        <!-- /.card -->
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
    <script src="/templates/adminlte3/dist/js/pages/common.js"></script>
<?= $this->endSection() ?>