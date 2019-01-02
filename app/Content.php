<?php

namespace App;

use App\Affiliate;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    CONST APA_ITU_PINTARIA = 'apa-itu-pintaria';
    CONST TAMBAH_PINTAR = 'tambah-pintar-dalam-60-detik';
    CONST PUNYA_WAKTU = 'punya-waktu-lebih-banyak';
    CONST PARTNER_KAMI = 'jadilah-partner-kami';
    CONST NEWSLETTER = 'berlangganan-newsletter';
    CONST INFORMASI = 'ingin-informasi-lebih-lengkap';
    CONST SEO_DESCRIPTION = 'homepage-seo-description';
    CONST SEARCH_PLACEHOLDER = 'search-placeholder';
    
    protected $fillable = [
        'affiliate_id',
        'title',
        'description',
        'key'
    ];

    public function affiliateId()
    {
    	return $this->belongsTo(Affiliate::class, 'affiliate_id');
    }
}
