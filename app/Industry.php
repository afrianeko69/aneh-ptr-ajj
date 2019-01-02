<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;


class Industry extends Model
{
    use Searchable;
    public static function getIndustrySearch($keyword)
    {
        $industries = Industry::search($keyword)->get();
        $result = array();
        if (!$industries->isEmpty()){
            foreach ($industries as $k => $industry) {
                $result[$k]['name'] = $industry->name;
                $result[$k]['url'] = url('program').'?industri_program='.$industry->name;
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
