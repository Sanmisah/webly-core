<?= $this->extend('Webly\Core\Views\Layouts\default') ?>
<?= $this->section('content') ?>
<?= form_open_multipart() ?>
    <?= csrf_field() ?>
    <div class="row">
        <div class="col-lg-9">
            <div class="card card-primary card-outline">
                <div class="card-body">                
                    <?php
                        echo isset($blogPost->id) ? form_hidden('id', $blogPost->id) : ''; 

                        echo input('title', [                                
                            'input' => [
                                'value'=> $blogPost->title, 
                            ]
                        ]);                         

                        echo input('content', [
                            'input' => [
                                'rows'=>5,
                                'value'=> $blogPost->content,
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
                                'value'=> $blogPost->page_title, 
                            ]
                        ]);
                        
                        echo input('meta_description', [
                            'input' => [
                                'rows'=>2,
                                'value'=> $blogPost->meta_description,
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
                    <h3 class="card-title">Post Visibility</h3>
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
                <div class="card-body">                
                    <?php
                        echo input('layout', [
                            'input' => [
                                'value'=> $blogPost->layout, 
                                'options' => service('webly')->getLayouts()
                            ]
                        ],
                        'select');                    
                    ?>
                </div>
            </div>
            
            <div class="card card-primary card-outline">
                <div class="card-body">                
                    <?php
                        echo input('blog_category_id', [
                            'label' => [
                                'label' => 'Blog Category'
                            ],
                            'input' => [
                                'value'=> $blogPost->blog_category_id, 
                                'options' => service('webly')->getBlogCategoriesList()
                            ]
                        ],
                        'select');                    
                    ?>
                </div>
            </div>

            <div class="card card-primary card-outline">
                <div class="card-body">                
                    <?php
                        echo input('author', [
                            'input' => [
                                'value'=> $blogPost->author, 
                            ]
                        ]);                    
                    ?>
                </div>
            </div>  
            
            <div class="card card-primary card-outline">
                <div class="card-body">                
                    <?php
                        echo input('published_on', [
                            'input' => [
                                'value'=> $blogPost->published_on, 
                            ]
                        ], 'datepicker');                    
                    ?>
                </div>
            </div>              

            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Upload Image</h3>
                </div>
                <div class="card-body">                
                    <?= input('featured_image', ['help' => "Recommended featured image size is " . template_info('image-size.blog_featured_image') . "px"], 'file') ?>
                    <?php if($blogPost->featured_image) : ?>
                        <?= img($blogPost->featured_image, false, ['class'=>'img-fluid']) ?>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input custom-control-input-danger" type="checkbox" name="remove_featured_image" id="remove_featured_image" value=1>
                                <label for="remove_featured_image" class="custom-control-label">Remove Image</label>
                            </div>
                        </div>
                    <?php endif; ?>   
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

<?= $this->section('css') ?>
    <link rel="stylesheet" href="/templates/adminlte3/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
<?= $this->endSection() ?>

<?= $this->section('js') ?>
    <script src="/templates/adminlte3/dist/js/pages/common.js"></script>
    <script src="/templates/adminlte3/plugins/tinymce/js/tinymce/tinymce.min.js"></script>
    <script src="/templates/adminlte3/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>    
    <script src="/templates/adminlte3/plugins/moment/moment.min.js"></script>
    <script src="/templates/adminlte3/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="/templates/adminlte3/dist/js/pages/blog-posts.js"></script>
<?= $this->endSection() ?>
