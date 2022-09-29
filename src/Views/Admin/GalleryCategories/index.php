<?= $this->extend('Webly\Core\Views\Layouts\default') ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Gallery Categories</h3>
                <div class="card-tools">
                    <a type="button" class="btn bg-success btn-small" href="gallery-categories/create"><i class="fas fa-plus"></i> Create</a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th style="width:20px">&nbsp;</th>
                            <th>Category</th>
                            <th>Image</th>
                            <th style="width: 40px">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($galleryCategories as $galleryCategory) : ?>
                        <tr id="<?= $galleryCategory->id ?>">
                            <td><i class="fas fa-sort fa-lg"></i></td>
                            <td><?= $galleryCategory->category ?></td>
                            <td><?= img($galleryCategory->category_image, false, ['height' => 100]) ?></td>
                            <td>
                                <div class="btn-group">
                                    <a type="button" class="btn bg-warning btn-sm" href="gallery-categories/update/<?= $galleryCategory->id?>"><i class="fas fa-edit"></i></a>
                                    <a type="button" class="btn bg-danger btn-sm delete" href="gallery-categories/delete/<?= $galleryCategory->id?>"><i class="far fa-trash-alt"></i></a>
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
    <script src="/templates/adminlte3/dist/js/pages/gallery-categories.js"></script>
<?= $this->endSection() ?>