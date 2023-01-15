<?php

class Helper
{
    public static function createTree(array &$elements, $parentId = 0)
    {

        $branch = [];

        foreach ($elements as &$element) {

            if ($element['parent_id'] == $parentId) {
                $children = static::createTree($elements, $element['id']);
                if ($children) {
                    $element['children'] = $children;
                }
                $branch[$element['id']] = $element;
                unset($element);
            }
        }
        return $branch;
    }

    public static function renderTree($tree) {        
        if(!is_null($tree) && count($tree) > 0) {
            echo '<ul>';
            foreach($tree as $node) {
                $tab = (isset($node['children'])) ? '<span class="tab plus">+</span>' : '<span class="tab">&nbsp;</span>';
                echo '<li class="title" id="' . $node['id'] . '">' . $tab . $node['title'];
                echo '<div class="description" id="desc_' . $node['id'] . '">' . $node['description'] . '</div>';
                if (isset($node['children'])) {
                    static::renderTree($node['children']);
                }                
                echo '</li>';
            }
            echo '</ul>';
        }
    }

    public static function renderAdminTree($tree, $cat)
    {
        if(!is_null($tree) && count($tree) > 0) {
            echo '<ul class="admin">';
            foreach($tree as $node) {
                echo '<li>';
                static::renderUpdateForm($node, $cat);
                if (isset($node['children'])) {
                    static::renderAdminTree($node['children'], $cat);
                }                
                echo '</li>';
            }
            echo '</ul>';
        }

    }

    public static function renderParentSelect($data, $id, $stream=True)
    {
        $out = '<label for="parent_'. $id . '">Родитель</label>';
        $out .= '<select class="form-select" name="parent_id" id="parent_'. $id . '">';
        $out .= '<option value="null">Корень</option>';
        foreach ($data as $key => $value) {
            $sel = ($value['id'] === $id) ? ' selected ' : '';
            $out .= '<option '. $sel . 'value="' . $value['id'] . '">' . $value['title'] . '</option>';
        }
        $out .= '</select>';
        if ($stream) {
            echo $out;
        } else {
            return $out;
        }
    }

    public static function renderUpdateForm($data, $cat)
    {
        $out = '<form action="update.php" method="post">';
        $out .= '<div class=""><div class="row">';
        $out .= '<div class="col">';
        $out .= '<input name="id" value="' . $data['id'].'" type="hidden" />';
        $out .= '<input name="isDelete" value="0" type="hidden" />';
        $out .= static::renderParentSelect($cat, $data['parent_id'], false);
        $out .= '</div>';
        $out .= '<div class="col">';
        $out .= '<label for="title'. $data['id'] .'" class="form-label">Название</label>';
        $out .= '<input name="title" value="' . $data['title'].'" type="text" class="form-control" id="title'. $data['id'] .'" placeholder="Название">';
        $out .= '</div>';
        $out .= '<div class="col">';
        $out .= '<label for="description'. $data['id'] .'" class="form-label">Описание</label>';
        $out .= '<textarea name="description" rows="3" class="form-control" id="description'. $data['id'] .'">' . $data['description']. '</textarea>';
        $out .= '</div>';
        $out .= '<div class="col buttons">';
        $out .= '<button type="submit" class="btn btn-primary">Изменить</button>';
        $out .= '<button type="button" class="btn btn-danger">Удалить</button>';
        $out .= '</div>';
        $out .= '</div></div>';
        $out .= '</form>';
        echo $out;
    }
}