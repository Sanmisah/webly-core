<?= $this->extend('Webly\Core\Views\Layouts\default') ?>
<?= $this->section('content') ?>
<script>
    var index = <?= $form->form_fields ? count($form->form_fields) : 0 ?>;
</script>
<div class="row">
    <div class="col-lg-12">
        <div class="card card-primary card-outline card-tabs">
            <div class="card-header p-0 pt-1 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="form-tab" data-toggle="pill" href="#form" role="tab" aria-controls="form" aria-selected="true">Form</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="email-tab" data-toggle="pill" href="#email" role="tab" aria-controls="email" aria-selected="false">Email</a>
                    </li>
                </ul>
            </div>
            <?= form_open_multipart() ?>
                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-three-tabContent">
                        <div class="tab-pane fade show active" id="form" role="tabpanel" aria-labelledby="form-tab">                           
                            <div class="row">
                                <?php 
                                    echo isset($form->id) ? form_hidden('id', $form->id) : ''; 
                                    
                                    echo input('form', [  
                                        'div' => [
                                            'class' => 'col-12'
                                        ],                                                                      
                                        'input' => [
                                            'value'=> $form->form, 
                                        ],
                                        'help' => "Create Form using <strong>{$form->form}</strong> url"
                                    ]); 

                                    echo input('success_message', [  
                                        'div' => [
                                            'class' => 'col-6'
                                        ],                                                                      
                                        'input' => [
                                            'value'=> $form->success_message, 
                                        ]
                                    ]);
                                    
                                    echo input('error_message', [  
                                        'div' => [
                                            'class' => 'col-6'
                                        ],                                                                      
                                        'input' => [
                                            'value'=> $form->error_message, 
                                        ]
                                    ]);                                    

                                ?>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-lg-4">
                                    <?php 
                                        echo input('field', [
                                            'input' => [
                                                'placeholder' => 'field'
                                            ],
                                            'label' => false
                                        ]); 

                                        echo input('validations', [
                                            'input' => [
                                                'placeholder' => 'validations'
                                            ],
                                            'label' => false
                                        ]); 
                                    ?> 
                                    <button type="button" id="add-field" class="btn btn-primary btn-sm">Add Field</button>
                                </div>
                                <div class="col-lg-8">
                                    <table class="table table-sm" id="fields-table">
                                        <thead>
                                            <tr>
                                                <th class="col-sm-3">Field</th>
                                                <th class="col-sm-9">Validations</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                if(!empty($form->form_fields)) {
                                                foreach($form->form_fields as $i => $fields) : 
                                            ?>
                                            <tr id="tr<?= $i?>">
                                                <td><?= form_input(['name' => "form_fields[{$i}][field]", 'value' => $fields->field, 'class' => 'form-control']); ?></td>
                                                <td><?= form_input(['name' => "form_fields[{$i}][validations]", 'value' => $fields->validations, 'class' => 'form-control']); ?></td>
                                            </tr>
                                            <?php endforeach; ?>
                                            <?php } ?>
                                        </tbody>                                    
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="email" role="tabpanel" aria-labelledby="email-tab">
                            <?php 
                                echo input('email_to', [
                                    'input' => [
                                        'value'=> $form->email_to, 
                                    ],
                                    'help' => 'Valid comma-separated email list for Data Submit'
                                ]);                             

                                echo input('response_email_subject', [
                                    'input' => [
                                        'value'=> $form->response_email_subject, 
                                    ]
                                ]);  
                                
                                echo input('response_email_body', [
                                    'input' => [
                                        'rows'=>5,
                                        'value'=> $form->response_email_body,
                                        'class' => 'tinymce',
                                        'html_escape' => false
                                    ]
                                ], 
                                'textarea');                                  
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
    <script src="/templates/adminlte3/dist/js/pages/forms.js"></script>
<?= $this->endSection() ?>