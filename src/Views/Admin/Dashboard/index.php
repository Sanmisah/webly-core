<?= $this->extend('Webly\Core\Views\Layouts\default') ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Dashboard</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <?php
                    $menus = config('Menu')->menu;
                    echo strpos('/admin/blocks/update/2', '/admin/blocks') == true;;
                ?>
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
                
            </div>            
        </div>
        <!-- /.card -->
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
    <script src="/templates/adminlte3/dist/js/pages/common.js"></script>
<?= $this->endSection() ?>