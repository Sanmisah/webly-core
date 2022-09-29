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

    <div class="col-md-12">
    <div class="card card-default">
        <div class="card-header">
        <h3 class="card-title">Dropzone.js <small><em>jQuery File Upload</em> like look</small></h3>
        </div>
        <div class="card-body">
        <div id="actions" class="row">
            <div class="col-lg-6">
            <div class="btn-group w-100">
                <span class="btn btn-success col fileinput-button">
                <i class="fas fa-plus"></i>
                <span>Add files</span>
                </span>
                <button type="submit" class="btn btn-primary col start">
                <i class="fas fa-upload"></i>
                <span>Start upload</span>
                </button>
                <button type="reset" class="btn btn-warning col cancel">
                <i class="fas fa-times-circle"></i>
                <span>Cancel upload</span>
                </button>
            </div>
            </div>
            <div class="col-lg-6 d-flex align-items-center">
            <div class="fileupload-process w-100">
                <div id="total-progress" class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                </div>
            </div>
            </div>
        </div>
        <div class="table table-striped files" id="previews">
            <div id="template" class="row mt-2">
            <div class="col-auto">
                <span class="preview"><img src="data:," alt="" data-dz-thumbnail /></span>
            </div>
            <div class="col d-flex align-items-center">
                <p class="mb-0">
                    <span class="lead" data-dz-name></span>
                    (<span data-dz-size></span>)
                </p>
                <strong class="error text-danger" data-dz-errormessage></strong>
            </div>
            <div class="col-4 d-flex align-items-center">
                <div class="progress progress-striped active w-100" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                    <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                </div>
            </div>
            <div class="col-auto d-flex align-items-center">
                <div class="btn-group">
                <button class="btn btn-primary start">
                    <i class="fas fa-upload"></i>
                    <span>Start</span>
                </button>
                <button data-dz-remove class="btn btn-warning cancel">
                    <i class="fas fa-times-circle"></i>
                    <span>Cancel</span>
                </button>
                <button data-dz-remove class="btn btn-danger delete">
                    <i class="fas fa-trash"></i>
                    <span>Delete</span>
                </button>
                </div>
            </div>
            </div>
        </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
        Visit <a href="https://www.dropzonejs.com">dropzone.js documentation</a> for more examples and information about the plugin.
        </div>
    </div>
    <!-- /.card -->
    </div>
</div>

<?= $this->endSection() ?>


<?= $this->section('css') ?>
    <link rel="stylesheet" href="/templates/adminlte3/plugins/dropzone/min/dropzone.min.css">
<?= $this->endSection() ?>

<?= $this->section('js') ?>
    <script src="/templates/adminlte3/dist/js/pages/common.js"></script>
    <script src="/templates/adminlte3/plugins/tinymce/js/tinymce/tinymce.min.js"></script>
    <script src="/templates/adminlte3/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <script src="/templates/adminlte3/plugins/dropzone/min/dropzone.min.js"></script>
<?= $this->endSection() ?>