<?php

namespace App\Services;

class Departement
{
    public function __construct()
    {

    }

    public static function getDepartements()
    {
        return [
            'S1 Akuntansi - UMHT',
            'S1 Akuntansi - UNKRIS',
            'S1 Akuntansi - UPJ',
            'S1 Akuntansi - USAHID',
            'S1 Manajemen - STM Labora',
            'S1 Manajemen - UMHT',
            'S1 Manajemen - UNKRIS',
            'S1 Manajemen - USAHID',
            'S1 Sistem Informasi - UPJ',
            'S1 Teknik Informatika - UMHT',
            'S1 Teknik Informatika - UNKRIS',
        ];
    }

    public static function getDepartementsPintaria()
    {
        return [
            'S1 Akuntansi - UAI',
            'S1 Akuntansi - UMHT',
            'S1 Akuntansi - UNKRIS',
            'S1 Akuntansi - USAHID',
            'S1 Hukum - UAI',
            'S1 Manajemen - STM Labora',
            'S1 Manajemen - UAI',
            'S1 Manajemen - UMHT',
            'S1 Manajemen - UNKRIS',
            'S1 Manajemen - USAHID',
            'S1 Teknik Informatika - UMHT',
            'S1 Teknik Informatika - UNKRIS',
            'S2 Manajemen - UKRIDA',
            'S2 Manajemen - USAHID',
            'S2 Komunikasi - UMJ',
        ];
    }

    public static function getDepartementsS1Pintaria()
    {
        return [
            'S1 Akuntansi - UAI',
            'S1 Akuntansi - USAHID',
            'S1 Hukum - UAI',
            'S1 Manajemen - UAI',
            'S1 Manajemen - USAHID', 
        ];
    }

    public static function getLevelOfEducations()
    {
        return [
            'SMA' => 'SMA',
            'SMK' => 'SMK',
            'D1' => 'D1',
            'D2' => 'D2',
            'D3' => 'D3',
            'D4' => 'D4',
            'S1' => 'S1',
            'S2' => 'S2',
            'S3' => 'S3'
        ];
    }

    public static function getLocations()
    {
        return [
            'Bekasi',
            'Bogor',
            'Depok',
            'Jakarta Barat',
            'Jakarta Pusat',
            'Jakarta Selatan',
            'Jakarta Timur',
            'Jakarta Utara',
            'Tangerang Kota',
            'Tangerang Selatan',
            'Lainnya'
        ];
    }

    public static function getApplicantCategories()
    {
        return [
            'Individu',
            'Perusahaan/Kolektif',
        ];
    }
}
