<?= $this->extend('Webly\Core\Views\Layouts\default') ?>
<?= $this->section('content') ?>
<?= form_open_multipart() ?>
    <?= csrf_field() ?>
    <div class="row">
        <div class="col-lg-9">
            <div class="card card-primary card-outline">
                <div class="card-body">                
                    <?php 
                        echo input('title', [                                
                            'input' => [
                                'value'=> $page->title, 
                            ]
                        ]);                         

                        echo input('content', [
                            'input' => [
                                'rows'=>5,
                                'value'=> $page->content,
                                'class' => 'tinymce',
                                'html_escape' => false
                            ]
                        ], 
                        'textarea');                        
                    ?>                    
                </div>
            </div>
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">For SEO</h3>
                </div>                
                <div class="card-body"> 
                    <?php                   
                        echo input('page_title', [                                
                            'input' => [
                                'value'=> $page->page_title, 
                            ]
                        ]);
                        
                        echo input('meta_description', [
                            'input' => [
                                'rows'=>2,
                                'value'=> $page->meta_description,
                                'html_escape' => true
                            ]
                        ], 
                        'textarea');                    
                    ?>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Page Visibility</h3>
                </div>
                <div class="card-body">                
                    <div class="form-group">
                        <div class="custom-control custom-radio">
                            <?= form_radio('visible', 1, true, ['id'=>'visible-true', 'class'=>'custom-control-input']); ?>
                            <?= form_label('Show', 'visible-true', ['class' => 'custom-control-label']); ?>                            
                        </div>
                        <div class="custom-control custom-radio">
                            <?= form_radio('visible', 0, false, ['id'=>'visible-false', 'class'=>'custom-control-input']); ?>
                            <?= form_label('Hide', 'visible-false', ['class' => 'custom-control-label']); ?>                            
                        </div>                        
                    </div>
                </div>
            </div>
            
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Upload Image</h3>
                </div>
                <div class="card-body">                
                    <?= input('featured_image', [], 'file') ?>
                </div>
            </div>   
            
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Layout</h3>
                </div>
                <div class="card-body">                
                    <?php
                        echo input('protocol', [
                            'input' => [
                                'value'=> $page->layout, 
                                'options' => ['mail'=>'mail', 'sendmail'=>'sendmail', 'smtp'=>'smtp']
                            ]
                        ],
                        'select');                    
                    ?>
                </div>
            </div>               
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-primary">
                <div class="card-body">               
                    <div class="float-right">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>              
                </div>
            </div>
        </div>
    </div>    
</form>          

<?= $this->endSection() ?>

<?= $this->section('js') ?>
    <script src="/templates/adminlte3/dist/js/pages/common.js"></script>
    <script src="/templates/adminlte3/plugins/tinymce/js/tinymce/tinymce.min.js"></script>
    <script src="/templates/adminlte3/dist/js/pages/pages.js"></script>
    <script src="/templates/adminlte3/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<?= $this->endSection() ?>
