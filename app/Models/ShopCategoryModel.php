<?php

namespace App\Models;

use GrahamCampbell\ResultType\Result;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ShopCategoryModel extends Model
{
    use HasFactory;

    public $table = 'shop_categories';

    public function product()
    {
        return $this->hasMany('App\Model\ShopProductModel', 'cat_id', 'id');
    }

    public static function outputLevelCategories($input_categories, &$output_categories, $parent_id = 0, $lvl = 1)
    {
        if (count($input_categories) > 0) {
            foreach ($input_categories as $key =>  $category) {
                $category = (array) $category;
                if ($category['parent_id'] == $parent_id) {
                    $category['level'] = $lvl;
                    $output_categories[] = (array) $category;
                    unset($input_categories[$key]);

                    $new_parent_id = $category['id'];
                    $new_level = $lvl + 1;
                    self::outputLevelCategories($input_categories, $output_categories, $new_parent_id, $new_level);
                }
            }
        }
    }

    public static function getCategoryRecursive()
    {
        $result = array();
        $source = ShopCategoryModel::all()->toArray();
        self::outputLevelCategories($source, $result);
        return $result;
    }

    public static function outputLevelCategoriesExcept($input_categories, &$output_categories, $parent_id = 0, $lvl = 1, $except)
    {
        if (count($input_categories) > 0) {
            foreach ($input_categories as $key => $category) {
                if ($category['parent_id'] == $parent_id) {
                    $category['level'] = $lvl;
                    if ($category['id'] != $except) {
                        $output_categories[] = (array)$category;
                    }
                    unset($input_categories[$key]);

                    if ($category['id'] != $except) {
                        $new_parent_id = $category['id'];
                        $new_level = $lvl + 1;
                        self::outputLevelCategoriesExcept($input_categories, $output_categories, $new_parent_id, $new_level, $except);
                    }
                }
            }
        }
    }

    public static function getCategoryRecursiveExcept($except)
    {
        $result = array();
        $source = ShopCategoryModel::all()->toArray();
        self::outputLevelCategoriesExcept($source, $result, 0, 1, $except);
        return $result;
    }

    public static function getCategoryMenu()
    {
        $source = DB::table('shop_categories')->orderBy('sort_no', 'ASC')->get()->array();
        $result = array();
        self::outputLevelCategories($source, $result);
        return $result;
    }

    // public static function buildMenuHTML($input_categories, &$html, $parent_id = 0, $lvl = 1)
    // {
    //     if (count($input_categories) > 0) {
    //         if ($lvl == 1) {
    //             $html .= "<ul class=\"nav navbar-nav \">";
    //         } elseif ($lvl == 2) {
    //             $html .= "<ul class=\"dropdown-menu multi\">
    //                             <div class=\"row\">
    //                                 <ul class=\"multi-column-dropdown\">";
    //         } else {
    //             // Không hiện
    //         }

    //         foreach ($input_categories as $key => $category) {
    //             if ($category['parent_id'] == $parent_id) {
    //                 $category['level'] = $lvl;
    //                 $menu_link = url($category['link']);

    //                 if ($lvl == 1) {
    //                     $li_class = (isset($category['total']) && ($category['total'] > 0)) ? 'dropdown ' : '';
    //                     $html .= '<li class="' . $li_class . '"><a href="' . $menu_link . '" class="hyper"><span>';
    //                 } elseif ($lvl == 2) {
    //                     $html .= '<li><a href="' . $menu_link . '"><i class="fa fa-angle-right" aria-hidden="true"></i>';
    //                 } else {
    //                 }
    //                 if ($lvl == 1 || $lvl == 2) {
    //                     $html .= $category['name'];
    //                 }
    //                 unset($input_categories[$key]);

    //                 $new_parent_id = $category['id'];

    //                 if ($lvl == 1 && (isset($category['total']) && ($category['total'] > 0))) {
    //                     $html .= '<b class="caret"></b>';
    //                 }

    //                 $new_level = $lvl + 1;
    //                 self::buildMenuHTML($input_categories, $html, $new_parent_id, $new_level);

    //                 if ($lvl == 1) {
    //                     $html .= '</span></a></li>';
    //                 } elseif ($lvl == 2) {
    //                     $html .= '</a></li>';
    //                 } else {
    //                 }
    //             }
    //         }
    //         if ($lvl == 1) {
    //             $html .= "</ul>";
    //         } elseif ($lvl == 2) {
    //             $html .= "</ul><div class=\"clearfix\"></div>
    //                             </div>
    //                         </ul>";
    //         } else {
    //             // Không hiện
    //         }
    //     }
    // }

    // public static function getMenuUlLi($source)
    // {
    //     $html_menu = '';
    //     self::buildMenuHTML($source, $html_menu);
    //     return $html_menu;
    // }

    // $menus_items_header_html = MenuItemModel::getMenuUlLi($menus_items_header);
}
