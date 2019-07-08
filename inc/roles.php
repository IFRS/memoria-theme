<?php
add_action('after_switch_theme', 'ifrs_memoria_theme_addRoles');

function ifrs_memoria_theme_addRoles () {
    $admin = get_role('administrator');
    $admin->add_cap('assign_unidades');
    $admin->add_cap('manage_unidades');
    $admin->add_cap('manage_unidades');
    $admin->add_cap('create_registros');
    $admin->add_cap('edit_registros');
    $admin->add_cap('manage_registros');

    $editor = get_role('editor');
    $editor->add_cap('assign_unidades');
    $editor->add_cap('create_registros');
    $editor->add_cap('edit_registros');
    $editor->add_cap('manage_registros');
}

add_action('switch_theme', 'ifrs_memoria_theme_removeRoles');

function ifrs_memoria_theme_removeRoles() {
    $admin = get_role('administrator');
    $admin->remove_cap('assign_unidades');
    $admin->remove_cap('manage_unidades');
    $admin->remove_cap('manage_unidades');
    $admin->remove_cap('create_registros');
    $admin->remove_cap('edit_registros');
    $admin->remove_cap('manage_registros');

    $editor = get_role('editor');
    $editor->remove_cap('assign_unidades');
    $editor->remove_cap('create_registros');
    $editor->remove_cap('edit_registros');
    $editor->remove_cap('manage_registros');
}
