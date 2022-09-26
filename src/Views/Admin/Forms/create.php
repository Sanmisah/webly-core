<?= $this->extend('Webly\Core\Views\Layouts\default') ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card card-primary card-outline card-tabs">
            <div class="card-header p-0 pt-1 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="form-tab" data-toggle="pill" href="#form" role="tab" aria-controls="form" aria-selected="true">Form</a>
                    </li>
                </ul>
            </div>
            <?= form_open_multipart() ?>
                <?= csrf_field() ?>
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
                                        ]
                                    ]); 
                                ?>
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
    <script src="/templates/adminlte3/dist/js/pages/common.js"></script>
<?= $this->endSection() ?>