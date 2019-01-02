<?php

namespace App;
use App\CategoryClassification;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;


class CategoryClassification extends Model
{
    use Searchable;
    
    public static function getCategoryClassificationSearch($keyword)
    {
        $category_classification = CategoryClassification::search($keyword)->get();
        $result = array();
        if (!$category_classification->isEmpty()){
            foreach ($category_classification as $k => $category) {
                $result[$k]['name'] = $category->name;
                $result[$k]['url'] = url('program').'?kategori='.$category->name;
            }
        }
        return $result;
    }
    
    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        return array_only($this->toArray(), ['name']);
    }
}
