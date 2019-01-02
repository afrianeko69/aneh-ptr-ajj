<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\CategoryClassification;
use App\Industry;
use App\Product;
use App\Profession;
use App\Services\AkuLaku;
use Request;

class HomeController
{
    public function suggestion(){
        $keyword = Request::get('keyword');
        $result = [];
        if (!empty($keyword)){
            $result = [
                'product' => Product::getProductSearch($keyword),
                'category_classification' => CategoryClassification::getCategoryClassificationSearch($keyword),
                'category' => Category::getCategorySearch($keyword),
                'industry' => Industry::getIndustrySearch($keyword),
                'profession' => Profession::getProfessionSearch($keyword)
            ];
            //cleaning empty results
            foreach ($result as $key => $value) {
                if (empty($value)) {
                    unset($result[$key]);
                }
            }
        }
        return json_encode($result);
    }
}