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
                        <?php 
                            echo isset($galleryCategory->id) ? form_hidden('id', $galleryCategory->id) : ''; 

                            echo input('category', [                                
                                'input' => [
                                    'value'=> $galleryCategory->category, 
                                ]
                            ]); 

                            echo input('description', [
                                'input' => [
                                    'rows'=>3,
                                    'value'=> $galleryCategory->description,
                                    'class' => 'tinymce',
                                    'html_escape' => false
                                ]
                            ], 
                            'textarea');                    
                        ?>                    
                        </div>                        
                    </div>
                    <div class="col-lg-6">
                        <div class="card-body">                
                        <?= input('category_image', ['help' => "Recommended Category Thumbnail size is " . template_info('image-size.gallery_category_thumbnail') . "px"], 'file') ?>
                        <?php if($galleryCategory->category_image) : ?>
                        <?= img($galleryCategory->category_image, false, ['class'=>'img-fluid']) ?>
                        <?php endif; ?>   
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