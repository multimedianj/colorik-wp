<?php
//-- Functions here
?>

<?php include 'src/functions/loginStyles.php' ?>
<?php include 'src/functions/adminStyles.php' ?>

<?php include 'src/functions/Understrap.php' ?>
<?php include 'src/functions/ACF.php' ?>
<?php include 'src/functions/PostTypes.php' ?>
<?php include 'src/functions/Taxonomies.php' ?>

<?php
//-- Remove Widgets from appareance in admin
function remove_widgets_submenu() {
    global $submenu;

    // remove "Widgets" submenu
    foreach($submenu['themes.php'] as $key=>$item) {
        if ($item[2]=='widgets.php') {
            unset($submenu['themes.php'][$key]);
            break;
        }
    }
}
add_action('admin_head', 'remove_widgets_submenu');  

function widgets_redirect() {
    // Restrict the access to widgets page
    $result = stripos($_SERVER['REQUEST_URI'], 'widgets.php');
    if ($result!==false) {
        wp_redirect(get_option('siteurl') . '/wp-admin/index.php');
    }
}
add_action('admin_menu', 'widgets_redirect');
?>