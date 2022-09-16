<?= $this->extend('Webly\Core\Views\Layouts\default') ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card card-primary card-outline card-tabs">
            <form method="post">
                <?= csrf_field() ?>
                <div class="card-body">
                    <?php 
                        echo isset($menu->id) ? form_hidden('id', $menu->id) : ''; 

                        echo input('menu', [                                
                            'input' => [
                                'value'=> $menu->menu, 
                            ]
                        ]); 
                    ?>
                    <input type="hidden" name="menu_items" id="menu_items" value="<?= $menu->menu_items ?>">
                    <div class="row">
                        <div class="col-lg-6">
                            <?php 
                                echo input('menu_name'); 

                                $items = config('Content')->items;

                                echo input('menu_item', [                                
                                    'input' => [
                                        'options'=> $items, 
                                    ]
                                ], "select");                            
                            ?> 
                            <button type="button" id="add-menu" class="btn btn-primary btn-sm">Add Menu</button>                      
                        </div>
                        <div class="col-lg-6">
                            <?= $this->include('Webly\Core\Views\Admin\Menus\menu') ?>
                        </div>                        
                    </div>                    
                </div>
                <div class="card-footer">
                    <div class="float-right">
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </div>
            </form>    
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('css') ?>
    <link rel="stylesheet" href="/templates/adminlte3/dist/css/pages/menus.css">
<?= $this->endSection() ?>

<?= $this->section('js') ?>
    <script src="/templates/adminlte3/dist/js/pages/common.js"></script>
    <script src="/templates/adminlte3/dist/js/string-utils.js"></script>
    <script src="/templates/adminlte3/plugins/jquery-sortable-lists/jquery-sortable-lists.js"></script>
    <script src="/templates/adminlte3/dist/js/pages/menus.js"></script>
<?= $this->endSection() ?>

