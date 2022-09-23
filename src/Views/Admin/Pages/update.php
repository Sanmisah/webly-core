<?= $this->extend('Webly\Core\Views\Layouts\default') ?>
<?= $this->section('content') ?>
<?= form_open_multipart() ?>
    <?= csrf_field() ?>
    <div class="row">
        <div class="col-lg-9">
            <div class="card card-primary card-outline">
                <div class="card-header p-0 pt-1 border-bottom-0">
                    <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="main-tab" data-toggle="pill" href="#main" role="tab" aria-controls="main" aria-selected="true">Main</a>
                        </li>
                        <?php $i = -1; ?>
                        <?php foreach($pageBlocks as $i => $block): ?>
                            <li class="nav-item">
                                <a class="nav-link" id="tab-block-<?=$i+1?>" data-toggle="pill" href="#block-<?=$i+1?>" role="tab" aria-controls="block-<?=$i+1?>" aria-selected="false"><?= $block->block ?></a>
                            </li>
                        <?php endforeach ?>
                        <li class="nav-item">
                            <a class="nav-link" id="tab-block-<?=$i+2?>" data-toggle="pill" href="#block-<?=$i+2?>" role="tab" aria-controls="block-<?=$i+2?>" aria-selected="false">New Block</a>
                        </li>                        
                    </ul>
                </div>                
                <div class="card-body">                
                    <div class="tab-content" id="custom-tabs-three-tabContent">
                        <div class="tab-pane fade show active" id="website" role="tabpanel" aria-labelledby="website-tab">
                            <?php 
                                echo isset($page->id) ? form_hidden('id', $page->id) : ''; 

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
                        <?php $i = -1; ?>
                        <?php foreach($pageBlocks as $i => $block): ?>
                            <div class="tab-pane fade" id="block-<?=$i+1?>" role="tabpanel" aria-labelledby="tab-block-<?=$i+1?>">
                                <?php
                                    echo form_hidden("pg_".$i."_id", $block->id); 
                                    echo input("pg_".$i."_block", ['input'=>['value' => $block->block], 'label'=>['label' => 'Block']]); 
                                    echo input("pg_".$i."_content", [
                                        'input' => [
                                            'rows'=>5,
                                            'value'=> $block->content,
                                            'class' => 'tinymce',
                                            'html_escape' => false
                                        ],
                                        'label' => ['label' => 'Content']
                                    ], 
                                    'textarea');                                                            
                                ?>
                            </div>
                        <?php endforeach ?>
                        <div class="tab-pane fade" id="block-<?=$i+2?>" role="tabpanel" aria-labelledby="tab-block-<?=$i+2?>">
                            <?php
                                echo form_hidden("pg_".($i+1)."_id", ''); 
                                echo input("pg_".($i+1)."_block", ['label'=>['label' => 'Block']]); 
                                echo input("pg_".($i+1)."_content", [
                                    'input' => [
                                        'rows'=>5,
                                        'class' => 'tinymce',
                                        'html_escape' => false
                                    ],
                                    'label' => ['label' => 'Content']
                                ], 
                                'textarea');                                                            
                            ?>
                        </div>
                    </div>
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
                            <?= form_radio('visible', 1, $page->visible ? true : false, ['id'=>'visible-true', 'class'=>'custom-control-input']); ?>
                            <?= form_label('Show', 'visible-true', ['class' => 'custom-control-label']); ?>                            
                        </div>
                        <div class="custom-control custom-radio">
                            <?= form_radio('visible', 0, !$page->visible ? true : false, ['id'=>'visible-false', 'class'=>'custom-control-input']); ?>
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
                    <?= input('featured_image', ['help' => "Recommended featured image size is " . template_info('image-size.page_featured_image') . "px"], 'file') ?>
                    <?php if($page->featured_image) : ?>
                        <?= img($page->featured_image, false, ['class'=>'img-fluid']) ?>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input custom-control-input-danger" type="checkbox" name="remove_featured_image" id="remove_featured_image" value=1>
                                <label for="remove_featured_image" class="custom-control-label">Remove Image</label>
                            </div>
                        </div>
                    <?php endif; ?>   
                </div>
            </div>   
            
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Layout</h3>
                </div>
                <div class="card-body">                
                    <?php
                        echo input('layout', [
                            'input' => [
                                'value'=> $page->layout, 
                                'options' => service('webly')->getLayouts()
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
    <script src="/templates/adminlte3/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<?= $this->endSection() ?>
