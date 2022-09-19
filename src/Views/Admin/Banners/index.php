<?= $this->extend('Webly\Core\Views\Layouts\default') ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Banners</h3>
                <div class="card-tools">
                    <a type="button" class="btn bg-success btn-small" href="banners/create"><i class="fas fa-plus"></i> Create</a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Banner</th>
                            <th style="width: 40px">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($banners as $banner) : ?>
                        <tr id="<?= $banner->id ?>">
                            <td><?= img($banner->banner_image, false, ['height' => 50]) ?></td>
                            <td>
                                <div class="btn-group">
                                    <a type="button" class="btn bg-warning btn-sm" href="banners/update/<?= $banner->id?>"><i class="fas fa-edit"></i></a>
                                    <a type="button" class="btn bg-danger btn-sm delete" href="banners/delete/<?= $banner->id?>"><i class="far fa-trash-alt"></i></a>
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
    <script src="/templates/adminlte3/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="/templates/adminlte3/dist/js/pages/banners.js"></script>
<?= $this->endSection() ?>