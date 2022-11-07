<?php
function get_autor_name($id)
{
    $cv = &get_instance();
    $row_array= $cv->dbmodel->get_autor_name_from_DB($id);
    $name = $row_array['b_name'];
    return $name;
}
