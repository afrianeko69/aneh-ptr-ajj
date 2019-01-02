<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \TCG\Voyager\Models\Category as VoyagerPage;
use Laravel\Scout\Searchable;
use App\Product;


class Category extends VoyagerPage
{
    use Searchable;

    /**
     * The columns of the full text index
     */
    protected $searchable = [
        'name'
    ];

    public function productId()
    {
        return $this->belongsTo(Product::class);
    }

    public function products()
    {
    	return $this->belongsToMany(Product::class);
    }

    public function getFullPathIconUrlAttribute() {
        return asset_cdn($this->icon_category);
    }

    public static function getCategorySearch($keyword)
    {
        $categories = Category::search($keyword)->get();
        $result = array();
        if (!$categories->isEmpty()){
            foreach ($categories as $k => $category) {
                $result[$k]['name'] = $category->name;
                $result[$k]['url'] = url('program').'?kategori_program='.$category->name;
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