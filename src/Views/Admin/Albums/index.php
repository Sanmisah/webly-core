<?= $this->extend('Webly\Core\Views\Layouts\default') ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Albums</h3>
                <div class="card-tools">
                    <a type="button" class="btn bg-success btn-small" href="albums/create"><i class="fas fa-plus"></i> Create</a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th style="width:20px">&nbsp;</th>
                            <th>Album</th>
                            <th>Category</th>
                            <th>Image</th>
                            <th style="width: 40px">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($albums as $album) : ?>
                        <tr id="<?= $album->id ?>">
                            <td><i class="fas fa-sort fa-lg"></i></td>
                            <td><?= $album->album ?></td>
                            <td><?= $album->category ?></td>
                            <td><?= img($album->album_image, false, ['height' => 100]) ?></td>
                            <td>
                                <div class="btn-group">
                                    <a type="button" class="btn bg-warning btn-sm" href="albums/update/<?= $album->id?>"><i class="fas fa-edit"></i></a>
                                    <a type="button" class="btn bg-danger btn-sm delete" href="albums/delete/<?= $album->id?>"><i class="far fa-trash-alt"></i></a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.card -->
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
    <script src="/templates/adminlte3/dist/js/pages/common.js"></script>
    <script src="/templates/adminlte3/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="/templates/adminlte3/dist/js/pages/albums.js"></script>
<?= $this->endSection() ?>