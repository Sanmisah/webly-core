<?= $this->extend('Webly\Core\Views\Layouts\default') ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card card-primary card-outline card-tabs">
            <?= form_open_multipart() ?>
                <?= csrf_field() ?>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card-body">                
                        <?= input('banner_image', ['help' => "Recommended banner size is " . template_info('image-size.page_featured_image') . "px"], 'file') ?>
                        <?php if($banner->banner_image) : ?>
                        <?= img($banner->banner_image, false, ['class'=>'img-fluid']) ?>
                        <?php endif; ?>   
                        </div>                        
                    </div>
                    <div class="col-lg-6">
                        <div class="card-body">
                        <?php 
                            echo isset($banner->id) ? form_hidden('id', $banner->id) : ''; 

                            echo input('caption', [                                
                                'input' => [
                                    'value'=> $banner->caption, 
                                ]
                            ]); 

                            echo input('description', [
                                'input' => [
                                    'rows'=>3,
                                    'value'=> $banner->description,
                                    'class' => 'tinymce',
                                    'html_escape' => false
                                ]
                            ], 
                            'textarea');

                            echo input('link', [                                
                                'input' => [
                                    'value'=> $banner->link, 
                                ]
                            ]);                         
                        ?>                    
                        </div>                        
                    </div>
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
    <script src="/templates/adminlte3/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<?= $this->endSection() ?>