<?= $this->extend('Webly\Core\Views\Layouts\default') ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card card-primary card-outline card-tabs">
            <form method="post">
                <?= csrf_field() ?>
                <div class="card-body">
                    <?php 
                        echo isset($block->id) ? form_hidden('id', $block->id) : ''; 

                        echo input('block', [                                
                            'input' => [
                                'value'=> $block->block, 
                            ]
                        ]); 

                        echo input('description', [
                            'input' => [
                                'rows'=>5,
                                'value'=> $block->description,
                                'class' => 'tinymce',
                                'html_escape' => false
                            ]
                        ], 
                        'textarea');
                    ?>                    
                </div>
                <div class="card-footer">
                    <div class="float-right">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>    
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
    <script src="/templates/adminlte3/dist/js/pages/common.js"></script>
    <script src="/templates/adminlte3/plugins/tinymce/js/tinymce/tinymce.min.js"></script>
<?= $this->endSection() ?>