<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
            with font-awesome or any other icon font library -->
        <?php
            $user = auth()->user();
            
            $menus = config('Menu')->menu;
            ksort($menus);
            
            foreach($menus as $item => $menu) {                
                if(isset($menu['submenu']) && $user->can(...$menu['permissions'])) {
                    $active = '';
                    foreach($menu['submenu'] as $submenu) {
                        if(strpos(current_url(), $submenu['url'])) {
                            $active = 'active';
                            break;
                        }
                    }
                    echo "
                        <li class='nav-item menu-open'>
                            <a href='#' class='nav-link {$active}'>
                                <i class='{$menu["icon"]}'></i>
                                {$menu["menu"]}
                                <i class='right fas fa-angle-left'></i>
                            </a>                                                    
                    ";
                        echo "<ul class='nav nav-treeview'>";
                            foreach($menu['submenu'] as $submenu) {
                                if($user->can(...$submenu['permissions'])) {
                                    $active = strpos(current_url(), $submenu['url']) ? 'active' : '';
                                    echo "
                                        <li class='nav-item'>
                                            <a href='{$submenu["url"]}' class='nav-link {$active}'>
                                                <i class='{$submenu["icon"]}'></i>
                                                {$submenu["menu"]}
                                            </a>
                                        </li>
                                    ";
                                }
                            }
                        echo "</ul>";
                    echo "</li>";
                } else {
                    if($user->can(...$menu['permissions'])) {
                        $active = strpos($menu['url'], uri_string()) ? 'active' : '';
                        echo "
                            <li class='nav-item'>
                                <a href='{$menu["url"]}' class='nav-link {$active}'>
                                    <i class='{$menu["icon"]}'></i>
                                    {$menu["menu"]}
                                </a>
                            </li>
                        ";
                    }
                }
            }
        ?>
    </ul>
</nav>