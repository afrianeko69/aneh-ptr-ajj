<?php

namespace App\Traits;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\UrlWindow;

trait PaginationHelper {
    /**
     * Copied and modified from \Illuminate\Pagination\LengthAwarePaginator::render
     * 
     * Make custom pagination pages
     *
     * @param \Illuminate\Pagination\LengthAwarePaginator $paginator
     * @param int $onEachSide
     * @return array $elements
     */
    public static function render(LengthAwarePaginator $paginator, $onEachSide = 2)
    {
        $window = UrlWindow::make($paginator, $onEachSide);
        $elements = array_filter([
            is_array($window['slider']) ? null : (
                count($window['first']) < count($window['last']) ? null :
                    $window['first']),
            is_array($window['slider']) ? '...' : null,
            $window['slider'],
            is_array($window['last']) ? '...' : null,
            is_array($window['slider']) ? null : (
                count($window['last']) < count($window['first']) ? null :
                    $window['last']),
        ]);
        return PaginationHelper::correct($elements);
    }

    /** 
     * Correct the given pagination elements
     * 
     * @param array $elements
     * @param int $max_items
     * @return array $elements
     */

    public static function correct($elements, $max_items = 5)
    {
        $elements = array_values($elements);
        $current = PaginationHelper::countElements($elements, $max_items);
        if ($current <= $max_items) {
            return $elements;
        } else {
            # Determine the type of this pagination elements
            if (is_array($elements[0])) {
                # [[page1,2,3,4], '...]
                $i = 0;
                $temp_keys = array_keys($elements[$i]); // To circumvent php notice warning
                $j = array_pop($temp_keys);
                $first = true;
            } else {
                # either ['...', [page1,2,3], '...'] or ['...', [page1,2,3,4]]
                $i = 1;
                $j = array_keys($elements[$i])[0];
                $first = false;
            }

            for ($j; $current > $max_items; $first ? $j-- : $j++) {
                unset($elements[$i][$j]);   
                $current--;
            }

            return $elements;
        }
    }

    /**
     * Count number of pagination elements
     *
     * @param array $elements
     * @param int $max_items
     * @return int $count
     */
    public static function countElements($elements, $max_items = 5)
    {
        $count = 0;
        foreach ($elements as $element) {
            if (is_string($element)) {
                $count++;
            } elseif (is_array($element)) {
                foreach ($element as $page) {
                    if (is_string($page)) {
                        $count++;
                    }
                }
            }
        }
        
        return $count;
    }
}
