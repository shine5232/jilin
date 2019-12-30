<?php
namespace app\admin\validate;

use think\Validate;

class Brand extends Validate
{
    protected $rule = [
        'brand_name' => 'require|unique:brand,brand_name',
        'brand_img'  => 'require',
    ];
    protected $message = [
        'brand_name.require' => '[brand_name]品牌名称不能为空',
        'brand_name.unique'  => '[brand_name]品牌名称已存在',
        'brand_img.require'  => '[brand_img]品牌图标不能为空',
    ];

    protected $scene = [
        'add'  => ['brand_name', 'brand_img'],
        'edit' => ['brand_name', 'brand_img'],
    ];
}