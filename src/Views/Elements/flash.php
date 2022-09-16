<?php
    if (session('error') !== null) {
        echo "
            <div class='alert alert-danger alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                ". session('error') . "
            </div>
        ";
    }

    if (session('success') !== null) {
        echo "
            <div class='alert alert-success alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                ". session('success') . "
            </div>
        ";
    }    
?>
