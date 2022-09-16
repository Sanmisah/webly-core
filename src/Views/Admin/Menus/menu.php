<?php
    $str = "";
    $i = 0;

    function getChildren($items, &$str, &$i) {
        if(!empty($items)) {
            $str .= "<ul>";
            foreach($items as $item) {
                $i++;
                $str .= "<li id='{$item->id}' data-value='{$item->value}' data-slug='{$item->slug}' data-route='{$item->route}'>";
                $str .= "<div>{$item->value}<a class='clickable btn-onto btn btn-xs btn-danger float-right deleteMenu'><i class='clickable fa fa-times'></i></a></div>";
                getChildren($item->children, $str, $i);
                $str .= "</li>";
            }
            $str .= "</ul>";
        } else {
            return false;
        }
    }

    $menus = json_decode($menu->menu_items);

    if(!empty($menus)) {
        foreach($menus as $item) {
            $i++;
            $str .= "<li id='{$item->id}' data-value='{$item->value}' data-slug='{$item->slug}' data-route='{$item->route}'>";
            $str .= "<div>{$item->value}<a class='clickable btn-onto btn btn-xs btn-danger float-right deleteMenu'><i class='fa fa-times'></i></a></div>";
            getChildren($item->children, $str, $i);
            $str .= "</li>";
        }
    }
?>
<script>
    var menuIndex = <?php echo json_encode($i) ?>;
</script>


<div class="treeview">
    <ul id="sTree2" class="sTree bgC4">
        <?= $str ?>
    </ul>
</div>
<!-- <div class="treeview">
    <ul id="sTree2" class="sTree bgC4">
        <li class="bgC4" id="item_1" data-value="Home" data-slug="/" data-route="\simpl\core\controllers\admin\pagescontroller::update/1">
            <div>Home</div>
        </li>

        <li class="bgC4" id="item_2" data-value="About" data-slug="about" data-route="\simpl\core\controllers\admin\pagescontroller::update/1">
            <div>
                About                
            </div>
            <ul>
                <li class="bgC4" id="item_3" data-value="Vision" data-slug="vision" data-route="\simpl\core\controllers\admin\pagescontroller::update/1"><div>Vision</div></li>
                <li class="bgC4" id="item_4" data-value="Mission" data-slug="mission" data-route="\simpl\core\controllers\admin\pagescontroller::update/1"><div>Misson</div></li>
            </ul>
        </li>
    </ul> 
</div> -->
