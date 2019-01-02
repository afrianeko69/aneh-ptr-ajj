<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LandingPage extends Model
{
    const ICON_COUNT = 3;
    const TESTIMONY_COUNT = 2;

    /* Static landing page that will be called if the dynamic slug is not ready yet
     *
     * [ slug => controller name ]
     */
    const STATIC_SLUGS = [
        's1-ithb' => 'kuliahS1Ithb',
        's1-pintaria' => 'kuliahS1Pintaria',
    ];

    public function landing_page_interests()
    {
        return $this->hasMany(LandingPageInterest::class);
    }

    public function landing_page_icons()
    {
        return $this->hasMany(LandingPageIcon::class);
    }

    public function landing_page_testimonies()
    {
        return $this->hasMany(LandingPageTestimony::class);
    }

    public function landing_page_universities()
    {
        return $this->hasMany(LandingPageUniversity::class);
    }
}
