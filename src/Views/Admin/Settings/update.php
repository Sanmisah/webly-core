<?= $this->extend('Webly\Core\Views\Layouts\default') ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card card-primary card-outline card-tabs">
            <div class="card-header p-0 pt-1 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="website-tab" data-toggle="pill" href="#website" role="tab" aria-controls="website" aria-selected="true">Website</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="email-tab" data-toggle="pill" href="#email" role="tab" aria-controls="email" aria-selected="false">Email</a>
                    </li>
                </ul>
            </div>
            <form method="post">
                <?= csrf_field() ?>
                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-three-tabContent">
                        <div class="tab-pane fade show active" id="website" role="tabpanel" aria-labelledby="website-tab">
                            <?php 
                                echo input('website_title', [                                
                                    'input' => [
                                        'value'=> service('settings')->get('App.website_title'), 
                                    ]
                                ]); 

                                echo input('template', [                                
                                    'input' => [
                                        'value'=> service('settings')->get('App.template'), 
                                        'options' => service('webly')->getTemplates()
                                    ]
                                ], 'select');                                 

                                echo input('global_metadata', [
                                    'input' => [
                                        'rows'=>5,
                                        'value'=> service('settings')->get('App.global_metadata'), 
                                        'html_escape' => false
                                    ]
                                ], 
                                'textarea');
                            ?>
                        </div>
                        <div class="tab-pane fade" id="email" role="tabpanel" aria-labelledby="email-tab">
                            <div class="row">
                                <?php 
                                    echo input('from_email', [
                                        'div' => [
                                            'class' => 'col-3'
                                        ],
                                        'input' => [
                                            'value'=> service('settings')->get('Email.fromEmail'), 
                                        ]
                                    ]); 

                                    echo input('from_name', [
                                        'div' => [
                                            'class' => 'col-3'
                                        ],                                    
                                        'input' => [
                                            'value'=> service('settings')->get('Email.fromName'), 
                                        ]
                                    ]);                                 
                                ?>
                            </div>
                            <hr />
                            <div class="row">
                                <?php 
                                    echo input('protocol', [
                                        'div' => [
                                            'class' => 'col-3'
                                        ],
                                        'input' => [
                                            'value'=> service('settings')->get('Email.protocol'), 
                                            'options' => ['mail'=>'mail', 'sendmail'=>'sendmail', 'smtp'=>'smtp']
                                        ]
                                    ],
                                    'select');

                                    echo input('mail_path', [
                                        'div' => [
                                            'class' => 'col-6',
                                            'id' => 'divMailPath',
                                            'style' => 'display:none;'
                                        ],
                                        'input' => [
                                            'value'=> service('settings')->get('Email.mailPath')
                                        ]
                                    ]);                            
                                ?>
                            </div>
                            <hr />
                            <div id="divSMTP" style="display:none;">                    
                                <div class="row">
                                    <?php 
                                        echo input('SMTP_host', [ 
                                            'div' => [
                                                'class' => 'col-6'
                                            ],        
                                            'input' => [
                                                'value'=> service('settings')->get('Email.SMTPHost'), 
                                            ]
                                        ]); 

                                        echo input('SMTP_user', [
                                            'div' => [
                                                'class' => 'col-6'
                                            ],                                    
                                            'input' => [
                                                'value'=> service('settings')->get('Email.SMTPUser'), 
                                            ]
                                        ]);

                                        echo input('SMTP_pass', [
                                            'div' => [
                                                'class' => 'col-6'
                                            ],                                    
                                            'input' => [
                                                'value'=> service('settings')->get('Email.SMTPPass'), 
                                            ]
                                        ]);                                
                                    ?>
                                </div>
                                <div class="row">                           
                                    <?php 
                                        echo input('SMTP_port', [
                                            'div' => [
                                                'class' => 'col-2'
                                            ],
                                            'input' => [
                                                'value'=> service('settings')->get('Email.SMTPPort'), 
                                            ]
                                        ]); 

                                        echo input('SMTP_timeout', [
                                            'div' => [
                                                'class' => 'col-2'
                                            ],                                    
                                            'input' => [
                                                'value'=> service('settings')->get('Email.SMTPTimeout'), 
                                            ]
                                        ]);
                                        
                                        echo input('SMTP_crypto', [
                                            'div' => [
                                                'class' => 'col-2'
                                            ],                                    
                                            'input' => [
                                                'value'=> service('settings')->get('Email.SMTPCrypto'), 
                                                'options' => ['ssl'=>'ssl', 'tls'=>'tls']
                                            ],
                                            'label' => [
                                                'label' => 'SMTP Crypto'
                                            ],
                                        ], "select");                                        
                                    ?>                                
                                </div>
                            </div>
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
    <script src="/templates/adminlte3/dist/js/pages/settings.js"></script>
<?= $this->endSection() ?>