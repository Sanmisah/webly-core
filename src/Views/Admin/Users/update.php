<?= $this->extend('Webly\Core\Views\Layouts\default') ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card card-primary card-outline card-tabs">
            <form method="post">
                <?= csrf_field() ?>
                <div class="card-body">
                    <?php 
                        echo isset($user->id) ? form_hidden('id', $user->id) : ''; 
                        echo input('name', [                                
                            'input' => [
                                'value'=> $user->name, 
                            ]
                        ]);      

                        echo input('email', [                                
                            'input' => [
                                'value'=> $user->email, 
                            ]
                        ]);                         

                        echo input('password', [                                
                            'input' => [
                                'value'=> $user->password, 
                            ],
                        ]); 
                        
                        $groups = $user->getGroups();
                    ?>
                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" name="group[]" id="group-admin" value="admin" <?= in_array('admin', $groups) ? 'checked' : '' ?> >
                            <label for="group-admin" class="custom-control-label">Admin</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" name="group[]" id="group-editor" value="editor" <?= in_array('editor', $groups) ? 'checked' : '' ?>>
                            <label for="group-editor" class="custom-control-label">Editor</label>
                        </div>
                        <?php $validation =  \Config\Services::validation(); ?>
                        <span class='error invalid-feedback' style="display:block;"><?= $validation->getError('group'); ?></span>
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
<?= $this->endSection() ?>