<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class ShopCategoryModel extends Model
{
    use HasFactory;
    use Sluggable;

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    
    public $table = 'shop_categories';

    public function product() {
        return $this->hasMany('App\Model\ShopProductModel','cat_id','id');
    }

    public static function outputLevelCategories($input_categories, &$output_categories, $parent_id = 0, $lvl = 1) {

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

    public static function getCategoryRecursive() {
        $result = array();
        $source = ShopCategoryModel::all()->toArray();

        self::outputLevelCategories($source, $result);

        return $result;
    }

    public static function outputLevelCategoriesExcept($input_categories, &$output_categories, $parent_id = 0, $lvl = 1, $except) {

        if (count($input_categories) > 0) {
            foreach ($input_categories as $key => $category) {
                if ($category['parent_id'] == $parent_id) {
                    $category['level'] = $lvl;
                    if ($category['id'] != $except) {
                        $output_categories[] = (array)$category;
                    }
                    unset($input_categories[$key]);

                    if ($category['id'] != $except)  {
                        $new_parent_id = $category['id'];
                        $new_level = $lvl + 1;
                        self::outputLevelCategoriesExcept($input_categories, $output_categories, $new_parent_id, $new_level, $except);
                    }

                }
            }
        }
    }

    public static function getCategoryRecursiveExcept($except) {
        $result = array();
        $source = ShopCategoryModel::all()->toArray();

        self::outputLevelCategoriesExcept($source, $result, 0, 1, $except);

        return $result;
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name',
            ]
        ];
    }
}
