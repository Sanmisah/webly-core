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
                            echo isset($album->id) ? form_hidden('id', $album->id) : ''; 

                            echo input('album', [                                
                                'input' => [
                                    'value'=> $album->album, 
                                ]
                            ]); 

                            echo input('description', [
                                'input' => [
                                    'rows'=>3,
                                    'value'=> $album->description,
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
                            <?= input('album_image', ['help' => "Recommended Album Thumbnail size is " . template_info('image-size.album_thumbnail') . "px"], 'file') ?>
                            <?php if($album->album_image) : ?>
                            <?= img($album->album_image, false, ['class'=>'img-fluid']) ?>
                            <?php endif; ?> 
                            
                            <?php
                                $categories = service('webly')->getGalleryCategoriesList(true);
                                echo input('gallery_category_id', [
                                    'label' => [
                                        'label' => 'Gallery Category'
                                    ],
                                    'input' => [
                                        'value'=> $album->gallery_category_id, 
                                        'options' => $categories
                                    ]
                                ],
                                'select');                    
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