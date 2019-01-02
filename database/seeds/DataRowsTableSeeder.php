<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\DataRow;
use TCG\Voyager\Models\DataType;

class DataRowsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     */
    public function run()
    {
        $postDataType = DataType::where('slug', 'posts')->firstOrFail();
        $pageDataType = DataType::where('slug', 'pages')->firstOrFail();
        $userDataType = DataType::where('slug', 'users')->firstOrFail();
        $categoryDataType = DataType::where('slug', 'categories')->firstOrFail();
        $menuDataType = DataType::where('slug', 'menus')->firstOrFail();
        $roleDataType = DataType::where('slug', 'roles')->firstOrFail();
        $providerDataType = DataType::where('slug', 'providers')->firstOrFail();
        $instructorDataType = DataType::where('slug', 'instructors')->firstOrFail();
        $locationDataType = DataType::where('slug', 'locations')->firstOrFail();
        $learningMethodDataType = DataType::where('slug', 'learning-methods')->firstOrFail();
        $industryDataType = DataType::where('slug', 'industries')->firstOrFail();
        $bannerDataType = DataType::where('slug', 'banners')->firstOrFail();
        $topicDataType = DataType::where('slug', 'topics')->firstOrFail();
        $productDataType = DataType::where('slug', 'products')->firstOrFail();
        $contentDataType = DataType::where('slug', 'contents')->firstOrFail();
        $videoDataType = DataType::where('slug', 'videos')->firstOrFail();
        $affiliateDataType = DataType::where('slug', 'affiliates')->firstOrFail();
        $bundleDataType = DataType::where('slug', 'bundles')->firstOrFail();
        $promoDataType = DataType::where('slug', 'promo')->firstOrFail();
        $ratingReviewDataType = DataType::where('slug', 'rating-reviews')->firstOrFail();
        $postTagsDataType = DataType::where('slug', 'post-tags')->firstOrFail();
        $categoryClassificationDataType = DataType::where('slug', 'categories-classification')->firstOrFail();
        $professionDataType = DataType::where('slug', 'professions')->firstOrFail();
        $testimonyDataType = DataType::where('slug', 'testimonies')->firstOrFail();
        $newsDataType = DataType::where('slug', 'news')->firstOrFail();
        $landingPageDataType = DataType::where('slug', 'landing-pages')->firstOrFail();

        $dataRow = $this->dataRow($affiliateDataType, 'id');

        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'Id',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($affiliateDataType, 'name');

        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Name',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                        "validation": {
                            "rule": "required"
                        }
                    }',
                'order'        => 2,
            ])->save();
        }

        $dataRow = $this->dataRow($affiliateDataType, 'domain_url');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Domain URL',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                        "validation": {
                            "rule": "required"
                        }
                    }',
                'order'        => 3,
            ])->save();
        }

        $dataRow = $this->dataRow($affiliateDataType, 'created_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'created_at',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 3,
            ])->save();
        }

        $dataRow = $this->dataRow($affiliateDataType, 'updated_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'updated_at',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 4,
            ])->save();
        }


        $dataRow = $this->dataRow($videoDataType, 'id');

        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'Id',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($videoDataType, 'title');

        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Title',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 2,
            ])->save();
        }

        $dataRow = $this->dataRow($videoDataType, 'description');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text_area',
                'display_name' => 'Description',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 3,
            ])->save();
        }


        $dataRow = $this->dataRow($videoDataType, 'image');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'          => 'image',
                'display_name'  => 'Image',
                'required'      => 1,
                'browse'        => 1,
                'read'          => 1,
                'edit'          => 1,
                'add'           => 1,
                'delete'        => 1,
                'details'       => '
                    {
                        "validation": {
                            "rule": "required|mimes:jpeg,jpg,png"
                        }
                    }
                ',
                'order'         => 4,
            ])->save();
        }

        $dataRow = $this->dataRow($videoDataType, 'youtube_id');

        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Youtube ID',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 5,
            ])->save();
        }

        $dataRow = $this->dataRow($videoDataType, 'created_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'created_at',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 6,
            ])->save();
        }

        $dataRow = $this->dataRow($videoDataType, 'updated_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'updated_at',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 7,
            ])->save();
        }


        $dataRow = $this->dataRow($contentDataType, 'id');

        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'Id',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($contentDataType, 'key');

        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Key',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 2,
            ])->save();
        }

        $dataRow = $this->dataRow($contentDataType, 'title');

        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Name',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 3,
            ])->save();
        }

        $dataRow = $this->dataRow($contentDataType, 'description');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'rich_text_box',
                'display_name' => 'Description',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 4,
            ])->save();
        }


        $dataRow = $this->dataRow($contentDataType, 'created_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'created_at',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 5,
            ])->save();
        }

        $dataRow = $this->dataRow($contentDataType, 'updated_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'updated_at',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 6,
            ])->save();
        }

        $dataRow = $this->dataRow($postDataType, 'id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'ID',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($postDataType, 'author_id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Author',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 0,
                'delete'       => 1,
                'details'      => '',
                'order'        => 2,
            ])->save();
        }

        $dataRow = $this->dataRow($postDataType, 'category_name');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'select_dropdown',
                'display_name' => 'Category',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'details'      => '',
                'order'        => 3,
            ])->save();
        }

        $dataRow = $this->dataRow($postDataType, 'title');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Title',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 4,
            ])->save();
        }

        $dataRow = $this->dataRow($postDataType, 'excerpt');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text_area',
                'display_name' => 'excerpt',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 5,
            ])->save();
        }

        $dataRow = $this->dataRow($postDataType, 'body');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'rich_text_box',
                'display_name' => 'Body',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 6,
            ])->save();
        }

        $dataRow = $this->dataRow($postDataType, 'image');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'image',
                'display_name' => 'Post Image',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '
{
    "resize": {
        "width": "1000",
        "height": "null"
    },
    "quality": "70%",
    "upsize": true,
    "thumbnails": [
        {
            "name": "medium",
            "scale": "50%"
        },
        {
            "name": "small",
            "scale": "25%"
        },
        {
            "name": "cropped",
            "crop": {
                "width": "300",
                "height": "250"
            }
        }
    ]
}',
                'order'        => 7,
            ])->save();
        }

        $dataRow = $this->dataRow($postDataType, 'slug');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'slug',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '
{
    "slugify": {
        "origin": "title",
        "forceUpdate": true
    }
}',
                'order'        => 8,
            ])->save();
        }

        $dataRow = $this->dataRow($postDataType, 'meta_description');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text_area',
                'display_name' => 'meta_description',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 9,
            ])->save();
        }

        $dataRow = $this->dataRow($postDataType, 'meta_keywords');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text_area',
                'display_name' => 'meta_keywords',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 10,
            ])->save();
        }

        $dataRow = $this->dataRow($postDataType, 'status');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'select_dropdown',
                'display_name' => 'status',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '
{
    "default": "DRAFT",
    "options": {
        "PUBLISHED": "published",
        "DRAFT": "draft",
        "PENDING": "pending"
    }
}',
                'order'        => 11,
            ])->save();
        }

        $dataRow = $this->dataRow($postDataType, 'created_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'created_at',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 12,
            ])->save();
        }

        $dataRow = $this->dataRow($postDataType, 'updated_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'updated_at',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 13,
            ])->save();
        }

        $dataRow = $this->dataRow($pageDataType, 'id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'id',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($pageDataType, 'author_id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'author_id',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 2,
            ])->save();
        }

        $dataRow = $this->dataRow($pageDataType, 'title');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'title',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 3,
            ])->save();
        }

        $dataRow = $this->dataRow($pageDataType, 'excerpt');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text_area',
                'display_name' => 'excerpt',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 4,
            ])->save();
        }

        $dataRow = $this->dataRow($pageDataType, 'body');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'rich_text_box',
                'display_name' => 'body',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 5,
            ])->save();
        }

        $dataRow = $this->dataRow($pageDataType, 'slug');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'slug',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => json_encode([
                    'slugify' => [
                        'origin' => 'title',
                    ],
                ]),
                'order'        => 6,
            ])->save();
        }

        $dataRow = $this->dataRow($pageDataType, 'meta_description');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'meta_description',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 7,
            ])->save();
        }

        $dataRow = $this->dataRow($pageDataType, 'meta_keywords');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'meta_keywords',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 8,
            ])->save();
        }

        $dataRow = $this->dataRow($pageDataType, 'status');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'select_dropdown',
                'display_name' => 'status',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => json_encode([
                    'default' => 'INACTIVE',
                    'options' => [
                        'INACTIVE' => 'INACTIVE',
                        'ACTIVE'   => 'ACTIVE',
                    ],
                ]),
                'order'        => 9,
            ])->save();
        }

        $dataRow = $this->dataRow($pageDataType, 'created_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'created_at',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 10,
            ])->save();
        }

        $dataRow = $this->dataRow($pageDataType, 'updated_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'updated_at',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 11,
            ])->save();
        }

        $dataRow = $this->dataRow($pageDataType, 'image');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'image',
                'display_name' => 'image',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 12,
            ])->save();
        }

        $dataRow = $this->dataRow($userDataType, 'id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'id',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($userDataType, 'name');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'name',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 2,
            ])->save();
        }

        $dataRow = $this->dataRow($userDataType, 'email');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'email',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 3,
            ])->save();
        }

        $dataRow = $this->dataRow($userDataType, 'password');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'password',
                'display_name' => 'password',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'details'      => '',
                'order'        => 4,
            ])->save();
        }

        $dataRow = $this->dataRow($userDataType, 'remember_token');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'remember_token',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 5,
            ])->save();
        }

        $dataRow = $this->dataRow($userDataType, 'created_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'created_at',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 6,
            ])->save();
        }

        $dataRow = $this->dataRow($userDataType, 'updated_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'updated_at',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 7,
            ])->save();
        }

        $dataRow = $this->dataRow($userDataType, 'avatar');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'image',
                'display_name' => 'avatar',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 8,
            ])->save();
        }

        $dataRow = $this->dataRow($menuDataType, 'id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'id',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($menuDataType, 'name');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'name',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 2,
            ])->save();
        }

        $dataRow = $this->dataRow($menuDataType, 'created_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'created_at',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 3,
            ])->save();
        }

        $dataRow = $this->dataRow($menuDataType, 'updated_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'updated_at',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 4,
            ])->save();
        }

        $dataRow = $this->dataRow($categoryDataType, 'id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'id',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($categoryDataType, 'name');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'name',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 4,
            ])->save();
        }

        $dataRow = $this->dataRow($categoryDataType, 'created_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'created_at',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 6,
            ])->save();
        }

        $dataRow = $this->dataRow($categoryDataType, 'updated_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'updated_at',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 7,
            ])->save();
        }

        $dataRow = $this->dataRow($roleDataType, 'id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'id',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($roleDataType, 'name');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Name',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 2,
            ])->save();
        }

        $dataRow = $this->dataRow($roleDataType, 'created_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'created_at',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 3,
            ])->save();
        }

        $dataRow = $this->dataRow($roleDataType, 'updated_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'updated_at',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 4,
            ])->save();
        }

        $dataRow = $this->dataRow($roleDataType, 'display_name');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Display Name',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 5,
            ])->save();
        }

        $dataRow = $this->dataRow($postDataType, 'seo_title');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'seo_title',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 14,
            ])->save();
        }

        $dataRow = $this->dataRow($postDataType, 'featured');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'checkbox',
                'display_name' => 'featured',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 15,
            ])->save();
        }

        $dataRow = $this->dataRow($userDataType, 'role_id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'role_id',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 9,
            ])->save();
        }

        $dataRow = $this->dataRow($providerDataType, 'id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'          => 'number',
                'display_name'  => 'Id',
                'required'      => 1,
                'browse'        => 0,
                'read'          => 0,
                'edit'          => 0,
                'add'           => 0,
                'delete'        => 0,
                'details'       => '',
                'order'         => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($providerDataType, 'name');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'          => 'text',
                'display_name'  => 'Name',
                'required'      => 1,
                'browse'        => 1,
                'read'          => 1,
                'edit'          => 1,
                'add'           => 1,
                'delete'        => 1,
                'details'       => '
                    {
                        "validation": {
                            "rule": "required"
                        }
                    }
                ',
                'order'         => 2,
            ])->save();
        }

        $dataRow = $this->dataRow($providerDataType, 'description');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'          => 'rich_text_box',
                'display_name'  => 'Description',
                'required'      => 1,
                'browse'        => 1,
                'read'          => 1,
                'edit'          => 1,
                'add'           => 1,
                'delete'        => 1,
                'details'       => '
                    {
                        "validation": {
                            "rule": "required"
                        }
                    }
                ',
                'order'         => 3,
            ])->save();
        }

        $dataRow = $this->dataRow($providerDataType, 'logo');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'          => 'image',
                'display_name'  => 'Logo',
                'required'      => 1,
                'browse'        => 1,
                'read'          => 1,
                'edit'          => 1,
                'add'           => 1,
                'delete'        => 1,
                'details'       => '
                    {
                        "validation": {
                            "rule": "required|mimes:jpeg,jpg,png"
                        }
                    }
                ',
                'order'         => 4,
            ])->save();
        }

        $dataRow = $this->dataRow($providerDataType, 'created_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'          => 'timestamp',
                'display_name'  => 'created_at',
                'required'      => 0,
                'browse'        => 0,
                'read'          => 1,
                'edit'          => 0,
                'add'           => 0,
                'delete'        => 0,
                'details'       => '',
                'order'         => 5,
            ])->save();
        }

        $dataRow = $this->dataRow($providerDataType, 'updated_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'          => 'timestamp',
                'display_name'  => 'updated_at',
                'required'      => 0,
                'browse'        => 0,
                'read'          => 0,
                'edit'          => 0,
                'add'           => 0,
                'delete'        => 0,
                'details'       => '',
                'order'         => 6,
            ])->save();
        }

        $dataRow = $this->dataRow($providerDataType, 'tagline');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'          => 'text',
                'display_name'  => 'Tagline',
                'required'      => 1,
                'browse'        => 1,
                'read'          => 1,
                'edit'          => 1,
                'add'           => 1,
                'delete'        => 1,
                'details'       => '
                    {
                        "validation": {
                            "rule": "required"
                        }
                    }
                ',
                'order'         => 7,
            ])->save();
        }

        $dataRow = $this->dataRow($providerDataType, 'provider_code');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'          => 'text',
                'display_name'  => 'Provider Code',
                'required'      => 0,
                'browse'        => 0,
                'read'          => 1,
                'edit'          => 1,
                'add'           => 1,
                'delete'        => 1,
                'order'         => 8,
            ])->save();
        }

        $dataRow = $this->dataRow($instructorDataType, 'id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'Id',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($instructorDataType, 'name');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Name',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                    "validation": {
                        "rule": "required"
                    }
                }',
                'order'        => 2,
            ])->save();
        }

        $dataRow = $this->dataRow($instructorDataType, 'title');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Title',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                    "validation": {
                        "rule": "required"
                    }
                }',
                'order'        => 3,
            ])->save();
        }

        $dataRow = $this->dataRow($instructorDataType, 'email');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Email',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 4,
            ])->save();
        }

        $dataRow = $this->dataRow($instructorDataType, 'description');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'rich_text_box',
                'display_name' => 'Description',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                    "validation": {
                        "rule": "required"
                    }
                }',
                'order'        => 5,
            ])->save();
        }

        $dataRow = $this->dataRow($instructorDataType, 'profile_picture');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'image',
                'display_name' => 'Profile Picture',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                    "validation": {
                        "rule": "required|mimes:jpeg,jpg,png"
                    }
                }',
                'order'        => 6,
            ])->save();
        }

        $dataRow = $this->dataRow($instructorDataType, 'created_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'created_at',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 7,
            ])->save();
        }

        $dataRow = $this->dataRow($instructorDataType, 'updated_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'updated_at',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 8,
            ])->save();
        }

        $dataRow = $this->dataRow($locationDataType, 'id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'Id',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($locationDataType, 'name');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Location',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                    "validation": {
                        "rule": "required",
                        "messages": {
                            "required": "This location field is required"
                        }
                    }
                }',
                'order'        => 2,
            ])->save();
        }

        $dataRow = $this->dataRow($locationDataType, 'created_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'created_at',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 3,
            ])->save();
        }

        $dataRow = $this->dataRow($locationDataType, 'updated_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'updated_at',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 4,
            ])->save();
        }

        $dataRow = $this->dataRow($learningMethodDataType, 'id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'Id',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($learningMethodDataType, 'name');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Learning Method',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                    "validation": {
                        "rule": "required",
                        "messages": {
                            "required": "This learning method field is required."
                        }
                    }
                }',
                'order'        => 2,
            ])->save();
        }

        $dataRow = $this->dataRow($learningMethodDataType, 'created_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'created_at',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 3,
            ])->save();
        }

        $dataRow = $this->dataRow($learningMethodDataType, 'updated_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'updated_at',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 4,
            ])->save();
        }

        $dataRow = $this->dataRow($industryDataType, 'id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'Id',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($industryDataType, 'name');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Name',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                    "validation": {
                        "rule": "required"
                    }
                }',
                'order'        => 2,
            ])->save();
        }

        $dataRow = $this->dataRow($industryDataType, 'created_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'created_at',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 3,
            ])->save();
        }

        $dataRow = $this->dataRow($industryDataType, 'updated_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'updated_at',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 4,
            ])->save();
        }

        $dataRow = $this->dataRow($industryDataType, 'banner');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'image',
                'display_name' => 'Banner Image',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'details'      => '{
                        "validation": {
                            "rule": "mimes:jpeg,jpg,png"
                        }
                    }',
                'order'        => 5,
            ])->save();
        }

        $dataRow = $this->dataRow($testimonyDataType, 'id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'Id',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($testimonyDataType, 'name');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Name',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                    "validation": {
                        "rule": "required"
                    }
                }',
                'order'        => 2,
            ])->save();
        }

        $dataRow = $this->dataRow($testimonyDataType, 'title');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Title',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 3,
            ])->save();
        }

        $dataRow = $this->dataRow($testimonyDataType, 'photo');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'image',
                'display_name' => 'Photo',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                    "validation": {
                        "rule": "mimes:png,jpg,jpeg|dimensions:max_width=365,max_height=512"
                    }
                }',
                'order'        => 4,
            ])->save();
        }

        $dataRow = $this->dataRow($testimonyDataType, 'testimony');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'rich_text_box',
                'display_name' => 'Testimony',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                    "validation": {
                        "rule": "required"
                    }
                }',
                'order'        => 5,
            ])->save();
        }

        $dataRow = $this->dataRow($testimonyDataType, 'sort');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'Sort',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                    "validation": {
                        "rule": "nullable|numeric|min:0"
                    }
                }',
                'order'        => 6,
            ])->save();
        }

        $dataRow = $this->dataRow($testimonyDataType, 'youtube_video_id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Youtube Video Id',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 7,
            ])->save();
        }

        $dataRow = $this->dataRow($testimonyDataType, 'created_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'created_at',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 8,
            ])->save();
        }

        $dataRow = $this->dataRow($testimonyDataType, 'updated_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'updated_at',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 9,
            ])->save();
        }

        //BANNERS
        $dataRow = $this->dataRow($bannerDataType, 'id');

        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'Id',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($bannerDataType, 'name');

        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Name',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                    "validation": {
                        "rule": "required"
                    }
                }',
                'order'        => 2,
            ])->save();
        }

        $dataRow = $this->dataRow($bannerDataType, 'description');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'rich_text_box',
                'display_name' => 'Description',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 3,
            ])->save();
        }

        $dataRow = $this->dataRow($bannerDataType, 'image');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'image',
                'display_name' => 'Image',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                    "validation": {
                        "rule": "required|mimes:jpeg,jpg,png"
                    }
                }',
                'order'        => 4,
            ])->save();
        }

        $dataRow = $this->dataRow($bannerDataType, 'sort');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'Sort',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 5,
            ])->save();
        }

        $dataRow = $this->dataRow($bannerDataType, 'url');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'URL',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 6,
            ])->save();
        }

        $dataRow = $this->dataRow($bannerDataType, 'created_at');

        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'created_at',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 7,
            ])->save();
        }

        $dataRow = $this->dataRow($bannerDataType, 'updated_at');

        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'updated_at',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 8,
            ])->save();
        }

        $dataRow = $this->dataRow($topicDataType, 'id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'Id',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($topicDataType, 'name');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Name',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                    "validation": {
                        "rule": "required"
                    }
                }',
                'order'        => 2,
            ])->save();
        }

        $dataRow = $this->dataRow($topicDataType, 'created_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'created_at',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 3,
            ])->save();
        }

        $dataRow = $this->dataRow($topicDataType, 'updated_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'updated_at',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 4,
            ])->save();
        }
        
        //Remove Category slug, parent_id and order field
        $dataRow = $this->dataRow($categoryDataType, 'parent_id');
        if ($dataRow->exists) {
            $dataRow->delete();
        }

        $dataRow = $this->dataRow($categoryDataType, 'slug');
        if ($dataRow->exists) {
            $dataRow->delete();
        }

        $dataRow = $this->dataRow($categoryDataType, 'order');
        if ($dataRow->exists) {
            $dataRow->delete();
        }

        $dataRow = $this->dataRow($productDataType, 'id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'Id',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($productDataType, 'name');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Product Name',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                    "validation": {
                        "rule": "required",
                        "messages": {
                            "required": "The product name field is required."
                        }
                    }
                }',
                'order'        => 2,
            ])->save();
        }

        $dataRow = $this->dataRow($productDataType, 'slug');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Slug',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                    "validation": {
                        "rule": "required"
                    }
                }',
                'order'        => 3,
            ])->save();
        }

        $dataRow = $this->dataRow($productDataType, 'description');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'rich_text_box',
                'display_name' => 'Description',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                    "validation": {
                        "rule": "required"
                    }
                }',
                'order'        => 4,
            ])->save();
        }

        $dataRow = $this->dataRow($productDataType, 'price');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Price',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                    "validation": {
                        "rule": "nullable|numeric|min:0|required_with:discount_percentage"
                    }
                }',
                'order'        => 5,
            ])->save();
        }

        $dataRow = $this->dataRow($productDataType, 'discount_percentage');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'Discount Percentage',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                    "validation": {
                        "rule": "nullable|numeric|min:0|max:99"
                    }
                }',
                'order'        => 6,
            ])->save();
        }

        $dataRow = $this->dataRow($productDataType, 'discount_start_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'Discount Start At',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                    "validation": {
                        "rule": "nullable|date|required_with:discount_percentage"
                    },
                    "format": "d F Y H:i:s"
                }',
                'order'        => 7,
            ])->save();
        }

        $dataRow = $this->dataRow($productDataType, 'discount_end_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'Discount End At',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                    "validation": {
                        "rule": "nullable|date|required_with:discount_percentage|after_or_equal:discount_start_at"
                    },
                    "format": "d F Y H:i:s"
                }',
                'order'        => 8,
            ])->save();
        }

        $dataRow = $this->dataRow($productDataType, 'seo');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text_area',
                'display_name' => 'SEO',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                    "validation": {
                        "rule": "required"
                    }
                }',
                'order'        => 9,
            ])->save();
        }

        $dataRow = $this->dataRow($productDataType, 'category');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'select_multiple',
                'display_name' => 'Category',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                    "validation": {
                        "rule": "required",
                        "messages": {
                            "required": "The category field is required."
                        }
                    },
                    "default": "",
                    "null": "",
                    "relationship": {
                        "key": "id",
                        "label": "name"
                    }
                }',
                'order'        => 10,
            ])->save();
        }

        $dataRow = $this->dataRow($productDataType, 'learning_method_id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'select_dropdown',
                'display_name' => 'Learning Method',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                    "validation": {
                        "rule": "required",
                        "messages": {
                            "required": "The learning method field is required."
                        }
                    },
                    "default": "",
                    "null": "",
                    "relationship": {
                        "key": "id",
                        "label": "name"
                    }
                }',
                'order'        => 11,
            ])->save();
        }

        $dataRow = $this->dataRow($productDataType, 'industries');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'select_multiple',
                'display_name' => 'Industries',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                    "validation": {
                        "rule": "required"
                    },
                    "default": "",
                    "null": "",
                    "relationship": {
                        "key": "id",
                        "label": "name"
                    }
                }',
                'order'        => 12,
            ])->save();
        }

        $dataRow = $this->dataRow($productDataType, 'topics');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'select_multiple',
                'display_name' => 'Topics',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                    "validation": {
                        "rule": "required"
                    },
                    "default": "",
                    "null": "",
                    "relationship": {
                        "key": "id",
                        "label": "name"
                    }
                }',
                'order'        => 13,
            ])->save();
        }

        $dataRow = $this->dataRow($productDataType, 'providers');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'select_multiple',
                'display_name' => 'Providers',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                    "validation": {
                        "rule": "required"
                    },
                    "default": "",
                    "null": "",
                    "relationship": {
                        "key": "id",
                        "label": "name"
                    }
                }',
                'order'        => 14,
            ])->save();
        }

        $dataRow = $this->dataRow($productDataType, 'user_participant_discounts');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'select_multiple',
                'display_name' => 'Multiple Participants Discount',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                    "default": "",
                    "null": "",
                    "relationship": {
                        "key": "id",
                        "label": "participant_number"
                    }
                }',
                'order'        => 9,
            ])->save();
        }

        $dataRow = $this->dataRow($productDataType, 'related_products');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'select_multiple',
                'display_name' => 'Show reviews from other Products?',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                    "default": "",
                    "null": "",
                    "relationship": {
                        "key": "id",
                        "label": "name"
                    }
                }',
                'order'        => 43,
            ])->save();
        }

        $dataRow = $this->dataRow($productDataType, 'instructors');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'select_multiple',
                'display_name' => 'Instructors',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                    "validation": {
                        "rule": "required"
                    },
                    "default": "",
                    "null": "",
                    "relationship": {
                        "key": "id",
                        "label": "name"
                    }
                }',
                'order'        => 15,
            ])->save();
        }

        $dataRow = $this->dataRow($productDataType, 'location_id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'select_dropdown',
                'display_name' => 'Location',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                    "default": "",
                    "null": "",
                    "relationship": {
                        "key": "id",
                        "label": "name"
                    }
                }',
                'order'        => 16,
            ])->save();
        }

        $dataRow = $this->dataRow($productDataType, 'location_detail');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text_area',
                'display_name' => 'Location Detail',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 17,
            ])->save();
        }

        $dataRow = $this->dataRow($productDataType, 'map');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Map',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 18,
            ])->save();
        }

        $dataRow = $this->dataRow($productDataType, 'image');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'image',
                'display_name' => 'Image (ratio: 1:1)',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                    "validation": {
                        "rule": "required|mimes:jpeg,jpg,png|dimensions:ratio=1",
                        "messages": {
                            "dimensions": "The image field ratio must be 1:1."
                        }
                    }
                }',
                'order'        => 19,
            ])->save();
        }

        $dataRow = $this->dataRow($productDataType, 'youtube_video_id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Youtube Video URL',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                    "validation": {
                        "rule": "nullable"
                    }
                }',
                'order'        => 20,
            ])->save();
        }

        $dataRow = $this->dataRow($productDataType, 'course_start_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'Course Start At',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                    "validation": {
                        "rule": "nullable|date"
                    }
                }',
                'order'        => 21,
            ])->save();
        }

        $dataRow = $this->dataRow($productDataType, 'course_end_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'Course End At',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                    "validation": {
                        "rule": "nullable|date|after_or_equal:course_start_at"
                    }
                }',
                'order'        => 22,
            ])->save();
        }

        $dataRow = $this->dataRow($productDataType, 'show_start_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'Periode Tayang Awal',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                    "validation": {
                        "rule": "nullable|date"
                    },
                    "format": "d F Y H:i:s"
                }',
                'order'        => 23,
            ])->save();
        }

        $dataRow = $this->dataRow($productDataType, 'show_end_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'Periode Tayang Akhir',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                    "validation": {
                        "rule": "nullable|date|after_or_equal:show_start_at"
                    },
                    "format": "d F Y H:i:s"
                }',
                'order'        => 24,
            ])->save();
        }

        $dataRow = $this->dataRow($productDataType, 'quota');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'Kapasitas Peserta',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                    "validation": {
                        "rule": "nullable|numeric",
                        "messages": {
                            "numeric": "The kapasitas peserta field must be numeric."
                        }
                    }
                }',
                'order'        => 25,
            ])->save();
        }

        $dataRow = $this->dataRow($productDataType, 'is_open_enrollment');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'select_dropdown',
                'display_name' => 'Is Open Enrollment',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                    "validation": {
                        "rule": "required|boolean"
                    },
                    "default": "1",
                    "options": {
                        "1": "Open Enrollment",
                        "0": "Not Open Enrollment"
                    }
                }',
                'order'        => 26,
            ])->save();
        }

        $dataRow = $this->dataRow($productDataType, 'created_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'created_at',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 27,
            ])->save();
        }

        $dataRow = $this->dataRow($productDataType, 'updated_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'updated_at',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 28,
            ])->save();
        }

        $dataRow = $this->dataRow($productDataType, 'is_content_ready');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'select_dropdown',
                'display_name' => 'Is Content Ready (Content not ready will cause the product can not be accessed)',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                    "validation": {
                        "rule": "required|boolean"
                    },
                    "default": "1",
                    "options": {
                        "1": "Content Ready",
                        "0": "Not Ready"
                    }
                }',
                'order'        => 29,
            ])->save();
        }

        $dataRow = $this->dataRow($productDataType, 'is_lead_form_active');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'select_dropdown',
                'display_name' => 'Is Lead Form Active (If not active, Mohon Info Form is hidden on the Product Detail and Produk option on Homepage Mohon Info Form)',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                    "validation": {
                        "rule": "required|boolean"
                    },
                    "default": "1",
                    "options": {
                        "1": "Lead Form Active",
                        "0": "Lead Form Not Active"
                    }
                }',
                'order'        => 30,
            ])->save();
        }

        $dataRow = $this->dataRow($topicDataType, 'name');
        if ($dataRow->exists) {
            $dataRow->update([
                'display_name' => 'Topic',
                'details'      => '{
                    "validation": {
                        "rule": "required",
                        "messages": {
                            "required": "The topic field is required."
                        }
                    }
                }'
            ]);
        }

        $dataRow = $this->dataRow($industryDataType, 'name');
        if ($dataRow->exists) {
            $dataRow->update([
                'display_name' => 'Industry',
                'details'      => '{
                    "validation": {
                        "rule": "required",
                        "messages": {
                            "required": "The industry field is required."
                        }
                    }
                }'
            ]);
        }

        $dataRow = $this->dataRow($videoDataType, 'title');
        if ($dataRow->exists) {
            $dataRow->update([
                'details' => '{
                    "validation": {
                        "rule": "required"
                    }
                }'
            ]);
        }
        
        $dataRow = $this->dataRow($categoryDataType, 'name');
        if ($dataRow->exists) {
            $dataRow->update([
                'display_name' => 'Category',
                'details' => '{
                    "validation": {
                        "rule": "required",
                        "messages": {
                            "required": "The category field is required."
                        }
                    }
                }'
            ]);
        }

        $dataRow = $this->dataRow($contentDataType, 'key');
        if ($dataRow->exists) {
            $dataRow->update([
                'details' => '{
                    "validation": {
                        "rule": "required",
                        "messages": {
                            "required": "The key field is required."
                        }
                    }
                }'
            ]);
        }

        $dataRow = $this->dataRow($contentDataType, 'title');
        if ($dataRow->exists) {
            $dataRow->update([
                'details' => '{
                    "validation": {
                        "rule": "required",
                        "messages": {
                            "required": "The title field is required."
                        }
                    }
                }'
            ]);
        }

        $dataRow = $this->dataRow($contentDataType, 'description');
        if ($dataRow->exists) {
            $dataRow->update([
                'details' => '{
                    "validation": {
                        "rule": "required",
                        "messages": {
                            "required": "The description field is required."
                        }
                    }
                }'
            ]);
        }

        $dataRow = $this->dataRow($pageDataType, 'title');
        if ($dataRow->exists) {
            $dataRow->update([
                'details' => '{
                    "validation": {
                        "rule": "required"
                    }
                }'
            ]);
        }

        $dataRow = $this->dataRow($productDataType, 'name');
        if ($dataRow->exists) {
            $dataRow->update([
                'display_name' => 'Product Name',
                'details'      => '{
                    "validation": {
                        "rule": "required",
                        "messages": {
                            "required": "The product name field is required."
                        }
                    }
                }'
            ]);
        }

        $dataRow = $this->dataRow($productDataType, 'slug');
        if ($dataRow->exists) {
            $dataRow->update([
                'details'      => '',
            ]);
        }

        $dataRow = $this->dataRow($productDataType, 'description');
        if ($dataRow->exists) {
            $dataRow->update([
                'details'      => ''
            ]);
        }

        $dataRow = $this->dataRow($productDataType, 'seo');
        if ($dataRow->exists) {
            $dataRow->update([
                'details'      => '',
            ]);
        }

        $dataRow = $this->dataRow($productDataType, 'learning_method_id');
        if ($dataRow->exists) {
            $dataRow->update([
                'details'      => '{
                    "default": "",
                    "null": "",
                    "relationship": {
                        "key": "id",
                        "label": "name"
                    }
                }',
            ]);
        }

        $dataRow = $this->dataRow($productDataType, 'industries');
        if ($dataRow->exists) {
            $dataRow->update([
                'details'      => '{
                    "default": "",
                    "null": "",
                    "relationship": {
                        "key": "id",
                        "label": "name"
                    }
                }',
            ]);
        }

        $dataRow = $this->dataRow($productDataType, 'topics');
        if ($dataRow->exists) {
            $dataRow->update([
                'details'      => '{
                    "default": "",
                    "null": "",
                    "relationship": {
                        "key": "id",
                        "label": "name"
                    }
                }',
            ]);
        }

        $dataRow = $this->dataRow($productDataType, 'providers');
        if ($dataRow->exists) {
            $dataRow->update([
                'details'      => '{
                    "default": "",
                    "null": "",
                    "relationship": {
                        "key": "id",
                        "label": "name"
                    }
                }',
            ]);
        }

        $dataRow = $this->dataRow($productDataType, 'instructors');
        if ($dataRow->exists) {
            $dataRow->update([
                'details'      => '{
                    "default": "",
                    "null": "",
                    "relationship": {
                        "key": "id",
                        "label": "name"
                    }
                }',
            ]);
        }

        $dataRow = $this->dataRow($productDataType, 'image');
        if ($dataRow->exists) {
            $dataRow->update([
                'display_name' => 'Image (800x533)',
                'details'      => '{
                    "validation": {
                        "rule": "mimes:jpeg,jpg,png|dimensions:max_width=800,max_height=533"
                    }
                }',
            ]);
        }

        $dataRow = $this->dataRow($productDataType, 'is_open_enrollment');
        if ($dataRow->exists) {
            $dataRow->update([
                'browse'       => 0,
                'details'      => '{
                    "validation": {
                        "rule": "required"
                    },
                    "default": "1",
                    "options": {
                        "3": "Open Bundle Enrollment",
                        "2": "Direct Link",
                        "1": "Open Enrollment",
                        "0": "Not Open Enrollment"
                    }
                }',
            ]);
        }

        $dataRow = $this->dataRow($productDataType, 'youtube_video_id');
        if ($dataRow->exists) {
            $dataRow->update([
                'display_name' => 'Youtube Video ID',
            ]);
        }

        $dataRow = $this->dataRow($affiliateDataType, 'name');
        if ($dataRow->exists) {
            $dataRow->update([
                'details' => '{
                    "validation": {
                        "rule": "required"
                    }
                }'
            ]);
        }

        $dataRow = $this->dataRow($affiliateDataType, 'domain_url');
        if ($dataRow->exists) {
            $dataRow->update([
                'details' => '{
                    "validation": {
                        "rule": "required"
                    }
                }'
            ]);
        }

        $dataRow = $this->dataRow($userDataType, 'affiliate_id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'select_dropdown',
                'display_name' => 'Affiliate',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                    "default": "",
                    "null": "",
                    "relationship": {
                        "key": "id",
                        "label": "name"
                    }
                }'
            ])->save();
        }

        $dataRow = $this->dataRow($bannerDataType, 'product_id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'select_dropdown',
                'display_name' => 'Product',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                    "default": "",
                    "null": "",
                    "options": {
                        "0": "-- Pilih Product --"
                    },
                    "relationship": {
                        "key": "id",
                        "label": "name"
                    }
                }',
                'order'        => 5
            ])->save();
        }


        $dataRow = $this->dataRow($affiliateDataType, 'logo');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'          => 'image',
                'display_name'  => 'Logo',
                'required'      => 1,
                'browse'        => 1,
                'read'          => 1,
                'edit'          => 1,
                'add'           => 1,
                'delete'        => 1,
                'details'       => '
                    {
                        "validation": {
                            "rule": "mimes:jpeg,jpg,png"
                        }
                    }
                ',
                'order'         => 6,
            ])->save();
        }

        $dataRow = $this->dataRow($bundleDataType, 'id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'Id',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($bundleDataType, 'name');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Bundle Name',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                    "validation": {
                        "rule": "required",
                        "messages": {
                            "required": "The bundle name field is required."
                        }
                    }
                }',
                'order'        => 2,
            ])->save();
        }

        $dataRow = $this->dataRow($bundleDataType, 'price');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Price',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                    "validation": {
                        "rule": "required|numeric|min:0"
                    }
                }',
                'order'        => 3,
            ])->save();
        }

        $dataRow = $this->dataRow($bundleDataType, 'products');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'select_multiple',
                'display_name' => 'Products (min: 2 products)',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                    "validation": {
                        "rule": "required|min:2"
                    },
                    "default": "",
                    "null": "",
                    "relationship": {
                        "key": "id",
                        "label": "name"
                    }
                }',
                'order'        => 7,
            ])->save();
        }

        $dataRow = $this->dataRow($bundleDataType, 'products.*');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'select_multiple',
                'display_name' => 'Products',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                    "validation": {
                        "rule": "required",
                        "messages": {
                            "required": "The product field is required."
                        }
                    },
                    "default": "",
                    "null": "",
                    "relationship": {
                        "key": "id",
                        "label": "name"
                    }
                }',
                'order'        => 8,
            ])->save();
        }

        $dataRow = $this->dataRow($bundleDataType, 'product_sort.*');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'select_multiple',
                'display_name' => 'Product Sorts',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                    "validation": {
                        "rule": "required",
                        "messages": {
                            "required": "The product sort field is required."
                        }
                    },
                    "default": "",
                    "null": ""
                }',
                'order'        => 9,
            ])->save();
        }

        $dataRow = $this->dataRow($bundleDataType, 'created_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'created_at',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 8,
            ])->save();
        }

        $dataRow = $this->dataRow($bundleDataType, 'updated_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'updated_at',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 9,
            ])->save();
        }

        $dataRow = $this->dataRow($bundleDataType, 'discount');
        if($dataRow->exists) {
            $dataRow->delete();
        }

        $dataRow = $this->dataRow($bundleDataType, 'discount_start_at');
        if($dataRow->exists) {
            $dataRow->delete();
        }

        $dataRow = $this->dataRow($bundleDataType, 'discount_end_at');
        if($dataRow->exists) {
            $dataRow->delete();
        }

        $dataRow = $this->dataRow($bundleDataType, 'start_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'Bundle Start At',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                    "validation": {
                        "rule": "required|date",
                        "messages": {
                            "required": "The bundle start at is required.",
                            "date": "The bundle start at must be in date format."
                        }
                    },
                    "format": "d F Y H:i:s"
                }',
                'order'        => 5,
            ])->save();
        }

        $dataRow = $this->dataRow($bundleDataType, 'end_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'Bundle End At',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                    "validation": {
                        "rule": "required|date|after_or_equal:start_at",
                        "messages": {
                            "required": "The bundle end at is required.",
                            "date": "The bundle end at must be in date format.",
                            "after_or_equal": "The bundle end at must be after or equal to bundle start at."
                        }
                    },
                    "format": "d F Y H:i:s"
                }',
                'order'        => 6,
            ])->save();
        }

        $dataRow = $this->dataRow($bannerDataType, 'image');
        if ($dataRow->exists) {
            $dataRow->update([
                'display_name' => 'Image Medium (1700x750)',
                'details' => '{
                    "validation": {
                        "rule": "mimes:jpeg,jpg,png|dimensions:max_width=1700,max_height=750"
                    }
                }'
            ]);
        }

        $dataRow = $this->dataRow($affiliateDataType, 'logo');
        if ($dataRow->exists) {
            $dataRow->update([
                'display_name' => 'Logo (200x90)',
                'details' => '{
                    "validation": {
                        "rule": "mimes:jpeg,jpg,png"
                    }
                }'
            ]);
        }
        
        $dataRow = $this->dataRow($videoDataType, 'image');
        if ($dataRow->exists) {
            $dataRow->update([
                'display_name' => 'Image (337x205)',
                'details' => '{
                    "validation": {
                        "rule": "mimes:jpeg,jpg,png"
                    }
                }'
            ]);
        }

        $dataRow = $this->dataRow($affiliateDataType, 'logged_in_domain_url');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Logged In Domain URL',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                        "validation": {
                            "rule": "required"
                        }
                    }',
                'order'        => 9,
            ])->save();
        }

        $dataRow = $this->dataRow($affiliateDataType, 'oauth_client_id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'Oauth Client ID',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 10,
            ])->save();
        }

        $dataRow = $this->dataRow($affiliateDataType, 'oauth_secret');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Oauth Secret',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 11,
            ])->save();
        }

        $dataRow = $this->dataRow($affiliateDataType, 'longitude');
        if ($dataRow->exists) {
            $dataRow->delete();
        }

        $dataRow = $this->dataRow($affiliateDataType, 'latitude');
        if ($dataRow->exists) {
            $dataRow->delete();
        }

        $dataRow = $this->dataRow($affiliateDataType, 'streetview_embed_code');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text_area',
                'display_name' => 'Streetview Embed Code',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 12,
            ])->save();
        }

        $dataRow = $this->dataRow($instructorDataType, 'profile_picture');
        if ($dataRow->exists) {
            $dataRow->update([
                'display_name' => 'Profile Picture (360x230)',
                'details'      => '{
                    "validation": {
                        "rule": "mimes:jpeg,jpg,png"
                    }
                }',
            ]);
        }

        $dataRow = $this->dataRow($providerDataType, 'logo');
        if ($dataRow->exists) {
            $dataRow->update([
                'display_name'  => 'Logo (360x230)',
                'required'      => 0,
                'details'       => '
                    {
                        "validation": {
                            "rule": "mimes:jpeg,jpg,png"
                        }
                    }
                ',
            ]);
        }
        
        $dataRow = $this->dataRow($pageDataType, 'image');
        if ($dataRow->exists) {
            $dataRow->update([
                'display_name'  => 'Image (1600x527)',
                'details'      => '{
                        "validation": {
                            "rule": "mimes:jpeg,jpg,png|dimensions:max_width=1600,max_height=527"
                        }
                    }',
            ]);
        }
        
        $dataRow = $this->dataRow($postDataType, 'image');
        if ($dataRow->exists) {
            $dataRow->update([
                'display_name' => 'Post Image (275x183)'
            ]);
        }

        $dataRow = $this->dataRow($pageDataType, 'affiliate_id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'select_dropdown',
                'display_name' => 'Affiliate',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => json_encode([
                    'default'  => '',
                    'null'     => '',
                    'options'  => [
                        '' => '-- None --',
                    ],
                    'relationship' => [
                        'key'   => 'id',
                        'label' => 'name',
                    ],
                ]),
                'order'        => 13,
            ])->save();
        }


        $dataRow = $this->dataRow($contentDataType, 'affiliate_id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'select_dropdown',
                'display_name' => 'Affiliate',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => json_encode([
                    'default'  => '',
                    'null'     => '',
                    'options'  => [
                        '' => '-- None --',
                    ],
                    'relationship' => [
                        'key'   => 'id',
                        'label' => 'name',
                    ],
                ]),
                'order'        => 7,
            ])->save();
        }

        $dataRow = $this->dataRow($affiliateDataType, 'favicon');
        
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'image',
                'display_name' => 'Favicon',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                    "validation": {
                        "rule": "required|mimes:png"
                    }
                }',
                'order'        => 13,
            ])->save();
        }
        
        $dataRow = $this->dataRow($affiliateDataType, 'site_title');
        
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Site Title',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 14,
            ])->save();
        }
        $dataRow = $this->dataRow($postDataType, 'title');
        if ($dataRow->exists) {
            $dataRow->update([
                'details'      => '
                {
                    "validation": {
                        "rule": "required"
                    }
                }'
            ]);
        }
        $dataRow = $this->dataRow($postDataType, 'body');
        if ($dataRow->exists) {
            $dataRow->update([
                'details'      => '
                {
                    "validation": {
                        "rule": "required"
                    }
                }'
            ]);
        }

        $dataRow = $this->dataRow($postDataType, 'excerpt');
        if ($dataRow->exists) {
            $dataRow->update([
                'details'      => '
                {
                    "validation": {
                        "rule": "required"
                    }
                }'
            ]);
        }

        $dataRow = $this->dataRow($userDataType, 'registered_from');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Registered From',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 11,
            ])->save();
        }

        $dataRow = $this->dataRow($userDataType, 'join_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'Join At',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 12,
            ])->save();
        }

        $dataRow = $this->dataRow($videoDataType, 'hexa_color');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Hexa Color',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 8,
            ])->save();
        }

        $dataRow = $this->dataRow($productDataType, 'jobs');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'rich_text_box',
                'display_name' => 'Jobs',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 30,
            ])->save();
        }

        $dataRow = $this->dataRow($productDataType, 'career');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'rich_text_box',
                'display_name' => 'career',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 31,
            ])->save();
        }

        $dataRow = $this->dataRow($promoDataType, 'id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'Id',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($promoDataType, 'promo_code');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Promo Code',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                        "validation": {
                            "rule": "required|regex:/^[A-Z0-9]+$/",
                            "messages": {
                                "regex": "The promo code must be uppercase and only contain A-Z and 0-9"
                            }
                        }
                    }',
                'order'        => 2,
            ])->save();
        }

        $dataRow = $this->dataRow($promoDataType, 'description');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'rich_text_box',
                'display_name' => 'Description',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 3,
            ])->save();
        }

        $dataRow = $this->dataRow($promoDataType, 'product');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'select_multiple',
                'display_name' => 'Product',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                    "validation": {
                        "rule": "required_without:bundle"
                    },
                    "default": "",
                    "null": "",
                    "relationship": {
                        "key": "id",
                        "label": "name"
                    }
                }',
                'order'        => 4,
            ])->save();
        }
        
        $dataRow = $this->dataRow($promoDataType, 'bundle');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'select_multiple',
                'display_name' => 'Bundle',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                    "validation": {
                        "rule": "required_without:product"
                    },
                    "default": "",
                    "null": "",
                    "relationship": {
                        "key": "id",
                        "label": "name"
                    }
                }',
                'order'        => 5,
            ])->save();
        }

        $dataRow = $this->dataRow($promoDataType, 'discount_type');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'select_dropdown',
                'display_name' => 'Discount Type',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                        "validation": {
                            "rule": "required"
                        },
                        "default": "Amount",
                        "options": {
                            "Amount": "Amount",
                            "Percentage": "Percentage"
                        }
                    }',
                'order'        => 6,
            ])->save();
        }

        $dataRow = $this->dataRow($promoDataType, 'discount_value');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'Discount Value',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                        "validation": {
                            "rule": "required"
                        }
                    }',
                'order'        => 7,
            ])->save();
        }

        $dataRow = $this->dataRow($promoDataType, 'start_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'Start Date Time',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                    "validation": {
                        "rule": "required|date",
                        "messages": {
                            "required": "Start date is required"
                        }
                    }
                }',
                'order'        => 8,
            ])->save();
        }

        $dataRow = $this->dataRow($promoDataType, 'end_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'End Date Time',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                    "validation": {
                        "rule": "required|date|after_or_equal:start_at",
                        "messages": {
                            "required": "End date is required",
                            "after_or_equal": "End date must be after or equal start date"
                        }
                    }
                }',
                'order'        => 9,
            ])->save();
        }

        $dataRow = $this->dataRow($promoDataType, 'created_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'created_at',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 10,
            ])->save();
        }

        $dataRow = $this->dataRow($promoDataType, 'updated_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'updated_at',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 11,
            ])->save();
        }

        $dataRow = $this->dataRow($ratingReviewDataType, 'id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'Id',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($ratingReviewDataType, 'reviewer_name');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Reviewer Name',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                        "validation": {
                            "rule": "required"
                        }
                    }',
                'order'        => 2,
            ])->save();
        }

        $dataRow = $this->dataRow($ratingReviewDataType, 'reviewer_email');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Reviewer Email',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                        "validation": {
                            "rule": "required|email"
                        }
                    }',
                'order'        => 3,
            ])->save();
        }

        $dataRow = $this->dataRow($ratingReviewDataType, 'product_id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'select_dropdown',
                'display_name' => 'Product',
                'details'      => '{
                    "validation": {
                        "rule": "required",
                        "messages": {
                            "required": "The product field is required."
                        }
                    },
                    "default": "",
                    "null": "",
                    "relationship": {
                        "key": "id",
                        "label": "name"
                    }
                }',
                'order'        => 4,
            ])->save();
        }

        $dataRow = $this->dataRow($ratingReviewDataType, 'review');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'rich_text_box',
                'display_name' => 'Review',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 5,
            ])->save();
        }

        $dataRow = $this->dataRow($ratingReviewDataType, 'rating');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'Rating',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                        "validation": {
                            "rule": "required|numeric|min:0|max:5"
                        }
                    }',
                'order'        => 6,
            ])->save();
        }

        $dataRow = $this->dataRow($ratingReviewDataType, 'status');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'select_dropdown',
                'display_name' => 'Status',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                        "validation": {
                            "rule": "required"
                        },
                        "default": "Pending",
                        "options": {
                            "Pending": "Pending",
                            "Approved": "Approved",
                            "Rejected": "Rejected"
                        }
                    }',
                'order'        => 7,
            ])->save();
        }

        $dataRow = $this->dataRow($ratingReviewDataType, 'created_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'created_at',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 8,
            ])->save();
        }

        $dataRow = $this->dataRow($ratingReviewDataType, 'updated_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'updated_at',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 9,
            ])->save();
        }

        $dataRow = $this->dataRow($bannerDataType, 'image_large');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'image',
                'display_name' => 'Image Large (1600x550)',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                        "validation": {
                            "rule": "mimes:jpeg,jpg,png|dimensions:width=1600,height=550"
                        }
                    }',
                'order'        => 9,
            ])->save();
        }

        $dataRow = $this->dataRow($bannerDataType, 'image_small');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'image',
                'display_name' => 'Image Small (500x350)',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                        "validation": {
                            "rule": "mimes:jpeg,jpg,png|dimensions:width=500,height=350"
                        }
                    }',
                'order'        => 10,
            ])->save();
        }

        $dataRow = $this->dataRow($productDataType, 'seo_title');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'SEO Title',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 31,
            ])->save();
        }

        $dataRow = $this->dataRow($productDataType, 'meta_description');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text_area',
                'display_name' => 'Meta Description',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 32,
            ])->save();
        }

        $dataRow = $this->dataRow($videoDataType, 'hexa_color');
        if ($dataRow->exists) {
            $dataRow->delete();
        }

        $dataRow = $this->dataRow($pageDataType, 'title_tag');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Title Tag',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 14,
            ])->save();
        }

        $dataRow = $this->dataRow($pageDataType, 'meta_description');
        if ($dataRow->exists) {
            $dataRow->update([
                'type'         => 'text_area',
            ]);
        }

        $dataRow = $this->dataRow($postTagsDataType, 'id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'Id',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($postTagsDataType, 'name');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Post Tag',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                    "validation": {
                        "rule": "required",
                        "messages": {
                            "required": "This tags field is required."
                        }
                    }
                }',
                'order'        => 2,
            ])->save();
        }

        $dataRow = $this->dataRow($postTagsDataType, 'created_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'created_at',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 3,
            ])->save();
        }

        $dataRow = $this->dataRow($postTagsDataType, 'updated_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'updated_at',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 4,
            ])->save();
        }

        $dataRow = $this->dataRow($postDataType, 'post_tag');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'select_multiple',
                'display_name' => 'Post Tag',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                    "default": "",
                    "null": "",
                    "relationship": {
                        "key": "id",
                        "label": "name"
                    }
                }',
                'order'        => 16,
            ])->save();
        }

        $dataRow = $this->dataRow($industryDataType, 'sort');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'Popular Industry Sort',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                    "validation": {
                        "rule": "nullable|numeric|min:0"
                    }
                }',
                'order'        => 5,
            ])->save();
        }

                
        $dataRow = $this->dataRow($categoryClassificationDataType, 'id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'Id',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($categoryClassificationDataType, 'name');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Categories Classification',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                    "validation": {
                        "rule": "required",
                        "messages": {
                            "required": "Categories Classification is required."
                        }
                    }
                }',
                'order'        => 2,
            ])->save();
        }

        $dataRow = $this->dataRow($categoryClassificationDataType, 'created_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'created_at',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 3,
            ])->save();
        }

        $dataRow = $this->dataRow($categoryClassificationDataType, 'updated_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'updated_at',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 4,
            ])->save();
        }

        $dataRow = $this->dataRow($professionDataType, 'id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'Id',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($professionDataType, 'name');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Profession',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                    "validation": {
                        "rule": "required",
                        "messages": {
                            "required": "Profession is required."
                        }
                    }
                }',
                'order'        => 2,
            ])->save();
        }

        $dataRow = $this->dataRow($professionDataType, 'sort');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'Sort',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                    "validation": {
                        "rule": "nullable|numeric|min:0"
                    }
                }',
                'order'        => 3,
            ])->save();
        }

        $dataRow = $this->dataRow($professionDataType, 'created_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'created_at',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 4,
            ])->save();
        }

        $dataRow = $this->dataRow($professionDataType, 'updated_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'updated_at',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 5,
            ])->save();
        }


        $dataRow = $this->dataRow($productDataType, 'professions');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'select_multiple',
                'display_name' => 'Profession',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                    "default": "",
                    "null": "",
                    "relationship": {
                        "key": "id",
                        "label": "name"
                    }
                }',
                'order'        => 33,
            ])->save();
        }

        $dataRow = $this->dataRow($productDataType, 'sort');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'Popular Products Sort',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'details'      => '{
                    "validation": {
                        "rule": "nullable|numeric|min:0"
                    }
                }',
                'order'        => 34,
            ])->save();
        }

        $dataRow = $this->dataRow($productDataType, 'category_classification_id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'select_dropdown',
                'display_name' => 'Category Classification',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'details'      => '{
                    "validation": {
                        "rule": "required",
                        "messages": {
                            "required": "The category classification field is required."
                        }
                    },
                    "default": "",
                    "null": "",
                    "relationship": {
                        "key": "id",
                        "label": "name"
                    }
                }',
                'order'        => 35,
            ])->save();
        }

        $dataRow = $this->dataRow($productDataType, 'banner');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'image',
                'display_name' => 'Banner Image',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'details'      => '{
                        "validation": {
                            "rule": "mimes:jpeg,jpg,png"
                        }
                    }',
                'order'        => 36,
            ])->save();
        }

        $dataRow = $this->dataRow($productDataType, 'banner');
        if ($dataRow->exists) {
            $dataRow->update([
                'display_name' => 'Banner Image (1600 x 527)',
                'details'      => '{
                        "validation": {
                            "rule": "mimes:jpeg,jpg,png|dimensions:max_width=1600,max_height=527"
                        }
                    }',
            ]);
        }

        $dataRow = $this->dataRow($categoryDataType, 'thumbnail_image');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'image',
                'display_name' => 'Thumbnail Image (350 x 233)',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '
                    {
                        "validation": {
                            "rule": "mimes:jpeg,jpg,png|dimensions:width=350,height=233"
                        }
                    }
                ',
                'order'        => 8,
            ])->save();
        }

        $dataRow = $this->dataRow($categoryDataType, 'thumbnail_image');
        if ($dataRow->exists) {
            $dataRow->update([
                'display_name' => 'Thumbnail Image (350 x 233)',
                'details'      => '
                    {
                        "validation": {
                            "rule": "mimes:jpeg,jpg,png|dimensions:max_width=350,max_height=233"
                        }
                    }
                '
            ]);
        }

        $dataRow = $this->dataRow($categoryDataType, 'image');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'image',
                'display_name' => 'Image (1600x1067)',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '
                    {
                        "validation": {
                            "rule": "mimes:jpeg,jpg,png|dimensions:width=1600,height=1067"
                        }
                    }
                ',
                'order'        => 9,
            ])->save();
        }

        $dataRow = $this->dataRow($categoryDataType, 'image');
        if ($dataRow->exists) {
            $dataRow->update([
                'display_name' => 'Image (1600x527)',
                'details'      => '
                    {
                        "validation": {
                            "rule": "mimes:jpeg,jpg,png|dimensions:max_width=1600,max_height=527"
                        }
                    }
                ',
            ]);
        }

        $dataRow = $this->dataRow($productDataType, 'category_id');
        if($dataRow->exists) {
            $dataRow->delete();
        }


        //Remove category_id from Post
        $dataRow = $this->dataRow($postDataType, 'category_id');
        if ($dataRow->exists) {
            $dataRow->delete();
        }

        $dataRow = $this->dataRow($categoryDataType, 'category_sort');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'Popular Category Sort',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'details'      => '{
                    "validation": {
                        "rule": "nullable|numeric|min:0"
                    }
                }',
                'order'        => 5,
            ])->save();
        }

        $dataRow = $this->dataRow($categoryDataType, 'icon_category');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'image',
                'display_name' => 'Category Icon',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 0,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'details'      => '{
                        "validation": {
                            "rule": "mimes:jpeg,jpg,png"
                        }
                    }',
                'order'        => 11,
            ])->save();
        }

        $dataRow = $this->dataRow($categoryDataType, 'icon_category');
        if ($dataRow->exists) {
            $dataRow->update([
                'display_name' => 'Category Icon',
                'details'      => '{
                        "validation": {
                            "rule": "mimes:jpeg,jpg,png,svg"
                        }
                    }',
            ]);
        }

        $dataRow = $this->dataRow($professionDataType, 'icon');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'image',
                'display_name' => 'Profession Icon',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                    "validation": {
                        "rule": "mimes:jpeg,jpg,png",
                        "messages": {
                            "mimes": "The profession icon field type must be between jpeg, jpg and png."
                        }
                    }
                }',
                'order'        => 6,
            ])->save();
        }

        $dataRow = $this->dataRow($professionDataType, 'icon');
        if ($dataRow->exists) {
            $dataRow->update([
                'display_name' => 'Profession Icon',
                'details'      => '{
                    "validation": {
                        "rule": "mimes:jpeg,jpg,png,svg",
                        "messages": {
                            "mimes": "The profession icon field type must be between jpeg, jpg, png and svg."
                        }
                    }
                }',
            ]);
        }

        $dataRow = $this->dataRow($professionDataType, 'banner');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'image',
                'display_name' => 'Banner Image',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                    "validation": {
                        "rule": "mimes:jpeg,jpg,png",
                        "messages": {
                            "mimes": "The banner image field type must be between jpeg, jpg and png."
                        }
                    }
                }',
                'order'        => 7,
            ])->save();
        }

        $dataRow = $this->dataRow($professionDataType, 'banner');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'display_name' => 'Banner Image (1600 x 527)',
                'details'      => '{
                    "validation": {
                        "rule": "mimes:jpeg,jpg,png|dimensions:max_width=1600,max_height=527",
                        "messages": {
                            "mimes": "The banner image field type must be between jpeg, jpg and png."
                        }
                    }
                }',
            ]);
        }

        $dataRow = $this->dataRow($professionDataType, 'description');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'rich_text_box',
                'display_name' => 'Description',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 8,
            ])->save();
        }

        $dataRow = $this->dataRow($professionDataType, 'excerpt');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text_area',
                'display_name' => 'Excerpt',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 9,
            ])->save();
        }

        $dataRow = $this->dataRow($professionDataType, 'jooble');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Jooble',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 11,
            ])->save();
        }

        $dataRow = $this->dataRow($professionDataType, 'youtube_video_id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'YouTube Video ID',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 12,
            ])->save();
        }

        $dataRow = $this->dataRow($professionDataType, 'pay');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text_area',
                'display_name' => 'Gaji',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 13,
            ])->save();
        }

        $dataRow = $this->dataRow($professionDataType, 'pay');
        if ($dataRow->exists) {
            $dataRow->update([
                'type'         => 'rich_text_box',
            ]);
        }

        $dataRow = $this->dataRow($professionDataType, 'task');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text_area',
                'display_name' => 'Tugas',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 14,
            ])->save();
        }

        $dataRow = $this->dataRow($professionDataType, 'task');
        if ($dataRow->exists) {
            $dataRow->update([
                'type'         => 'rich_text_box',
            ]);
        }

        $dataRow = $this->dataRow($professionDataType, 'knowledge');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text_area',
                'display_name' => 'Pengetahuan',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 15,
            ])->save();
        }

        $dataRow = $this->dataRow($professionDataType, 'knowledge');
        if ($dataRow->exists) {
            $dataRow->update([
                'type'         => 'rich_text_box',
            ]);
        }

        $dataRow = $this->dataRow($professionDataType, 'skill');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text_area',
                'display_name' => 'Keterampilan dan Kemampuan',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 16,
            ])->save();
        }

        $dataRow = $this->dataRow($professionDataType, 'skill');
        if ($dataRow->exists) {
            $dataRow->update([
                'type'         => 'rich_text_box',
            ]);
        }

        $dataRow = $this->dataRow($professionDataType, 'is_content_ready');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'select_dropdown',
                'display_name' => 'Is Content Ready (Content not ready will cause the profession can not be accessed)',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                    "validation": {
                        "rule": "required|boolean"
                    },
                    "default": "1",
                    "options": {
                        "1": "Content Ready",
                        "0": "Not Ready"
                    }
                }',
                'order'        => 17,
            ])->save();
        }

        $dataRow = $this->dataRow($industryDataType, 'icon');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'image',
                'display_name' => 'Industry Icon',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                    "validation": {
                        "rule": "mimes:jpeg,jpg,png",
                        "messages": {
                            "mimes": "The industry icon field type must be between jpeg, jpg and png."
                        }
                    }
                }',
                'order'        => 7,
            ])->save();
        }

        $dataRow = $this->dataRow($productDataType, 'sort');
        if ($dataRow->exists) {
            $dataRow->update([
                'browse'       => 1,
                'details'      => '{
                    "validation": {
                        "rule": "nullable|numeric|min:0|max:5"
                    }
                }',
            ]);
        }

        $dataRow = $this->dataRow($industryDataType, 'icon');
        if ($dataRow->exists) {
            $dataRow->update([
                'display_name' => 'Industry Icon',
                'details'      => '{
                    "validation": {
                        "rule": "mimes:jpeg,jpg,png,svg",
                        "messages": {
                            "mimes": "The industry icon field type must be between jpeg, jpg, png and svg."
                        }
                    }
                }',
            ]);
        }

        $dataRow = $this->dataRow($productDataType, 'location_detail');
        if ($dataRow->exists) {
            $dataRow->update([
                'browse'       => 0,
            ]);
        }

        $dataRow = $this->dataRow($productDataType, 'selected_bundle_id');
        if ($dataRow->exists) {
            $dataRow->update([
                'read'       => 0,
            ]);
        }

        $dataRow = $this->dataRow($productDataType, 'crm_interest_name');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'CRM Interest Field',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                    "validation": {
                        "rule": "required",
                        "messages": {
                            "required": "The CRM Interest Field is required."
                        }
                    }
                }',
                'order'        => 36,
            ])->save();
        }

        $dataRow = $this->dataRow($productDataType, 'is_learning_material_showed');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'select_dropdown',
                'display_name' => 'Materi Belajar',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                    "validation": {
                        "rule": "required|boolean"
                    },
                    "default": "1",
                    "options": {
                        "1": "Show Materi Belajar",
                        "0": "Do not show Materi Belajar"
                    }
                }',
                'order'        => 37,
            ])->save();
        }

        $dataRow = $this->dataRow($instructorDataType, 'signature');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'image',
                'display_name' => 'Signature Image',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                    "validation": {
                        "rule": "mimes:jpeg,jpg,png"
                    }
                }',
                'order'        => 9,
            ])->save();
        }

        $dataRow = $this->dataRow($productDataType, 'is_tryout');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'select_dropdown',
                'display_name' => 'Is Tryout?',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                    "validation": {
                        "rule": "required|boolean"
                    },
                    "default": "0",
                    "options": {
                        "0": "Is Not Tryout",
                        "1": "Is Tryout"
                    }
                }',
                'order'        => 38,
            ])->save();
        }

        $dataRow = $this->dataRow($professionDataType, 'image');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'image',
                'display_name' => 'Image (800x533)',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                    "validation": {
                        "rule": "mimes:jpeg,jpg,png|dimensions:max_width=800,max_height=533"
                    }
                }',
                'order'        => 10,
            ])->save();
        }

        $dataRow = $this->dataRow($productDataType, 'instruction');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'rich_text_box',
                'display_name' => 'Instruction',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                    "validation": {
                        "rule": "required_if:is_tryout,==,1",
                        "messages": {
                            "required_if": "This instruction field is required"
                        }
                    }
                }',
                'order'        => 39,
            ])->save();
        }

        $dataRow = $this->dataRow($productDataType, 'module_number');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'Module Number',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                    "validation": {
                        "rule": "nullable|numeric"
                    }
                }',
                'order'        => 40,
            ])->save();
        }

        $dataRow = $this->dataRow($productDataType, 'excerpt');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text_area',
                'display_name' => 'Excerpt',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                    "validation": {
                        "rule": "required"
                    }
                }',
                'order'        => 41,
            ])->save();
        }

        $dataRow = $this->dataRow($productDataType, 'is_review_shown');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'select_dropdown',
                'display_name' => 'Is Review Active? (If not active, Ulasan is hidden on the Product Detail and Kelas Saya)',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                    "validation": {
                        "rule": "required|boolean"
                    },
                    "default": "0",
                    "options": {
                        "1": "Review Active",
                        "0": "Review Not Active"
                    }
                }',
                'order'        => 42,
            ])->save();
        }

        $dataRow = $this->dataRow($productDataType, 'selected_bundle_id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'select_dropdown',
                'display_name' => 'Bundle Enrollment',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                    "validation": {
                        "rule": "required"
                    },
                    "default": "",
                    "null": "",
                    "relationship": {
                        "key": "id",
                        "label": "name"
                    }
                }',
                'order'        => 43,
            ])->save();
        }

        $dataRow = $this->dataRow($newsDataType, 'id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'ID',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($newsDataType, 'title');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Title',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 2,
            ])->save();
        }


        $dataRow = $this->dataRow($newsDataType, 'excerpt');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text_area',
                'display_name' => 'excerpt',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 3,
            ])->save();
        }

        $dataRow = $this->dataRow($newsDataType, 'body');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'rich_text_box',
                'display_name' => 'Body',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 4,
            ])->save();
        }

        $dataRow = $this->dataRow($newsDataType, 'image');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'image',
                'display_name' => 'News Image',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '
                    {
                        "resize": {
                            "width": "1000",
                            "height": "null"
                        },
                        "quality": "70%",
                        "upsize": true,
                        "thumbnails": [
                            {
                                "name": "medium",
                                "scale": "50%"
                            },
                            {
                                "name": "small",
                                "scale": "25%"
                            },
                            {
                                "name": "cropped",
                                "crop": {
                                    "width": "275",
                                    "height": "183"
                                }
                            }
                        ]
                    }',
                'order'        => 5,
            ])->save();
        }

        $dataRow = $this->dataRow($newsDataType, 'slug');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'slug',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '
                    {
                        "slugify": {
                            "origin": "title",
                            "forceUpdate": true
                        }
                    }',
                'order'        => 6,
            ])->save();
        }

        $dataRow = $this->dataRow($newsDataType, 'seo_title');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'SEO Title',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 7,
            ])->save();
        }

        $dataRow = $this->dataRow($newsDataType, 'meta_description');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text_area',
                'display_name' => 'meta_description',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 8,
            ])->save();
        }

        $dataRow = $this->dataRow($newsDataType, 'meta_keywords');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text_area',
                'display_name' => 'meta_keywords',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 9,
            ])->save();
        }

        $dataRow = $this->dataRow($newsDataType, 'status');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'select_dropdown',
                'display_name' => 'status',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '
                    {
                        "default": "DRAFT",
                        "options": {
                            "PUBLISHED": "published",
                            "DRAFT": "draft",
                            "PENDING": "pending"
                        }
                    }',
                'order'        => 10,
            ])->save();
        }

        $dataRow = $this->dataRow($newsDataType, 'created_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'created_at',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 11,
            ])->save();
        }

        $dataRow = $this->dataRow($newsDataType, 'updated_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'updated_at',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 12,
            ])->save();
        }

        $dataRow = $this->dataRow($productDataType, 'direct_link_url');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Direct Link URL',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'order'        => 41,
            ])->save();
        }

        $dataRow = $this->dataRow($professionDataType, 'products');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'select_multiple',
                'display_name' => 'Product',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                    "default": "",
                    "null": "",
                    "relationship": {
                        "key": "id",
                        "label": "name"
                    }
                }',
                'order'        => 12,
            ])->save();
        }

        $dataRow = $this->dataRow($productDataType, 'social_share_required');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'select_dropdown',
                'display_name' => 'Social Media Share Requirement',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                    "default": "0",
                    "options": {
                        "0": "Social Media Share is not required",
                        "1": "Social Media Share is required"
                    }
                }',
                'order'        => 42,
            ])->save();
        }

        $dataRow = $this->dataRow($landingPageDataType, 'slug');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Slug (ex. pintaria.com/kuliah/online/slug)',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                    "validation": {
                        "rule": "required"
                    }
                }',
                'order'        => 1,
            ])->save();
        }
        
        if ($dataRow->exists) {
            $dataRow->update([
                'display_name' => 'Slug (ex. pintaria.com/kuliah/online/kelas-karyawan/[slug])',
            ]);
        }

        $dataRow = $this->dataRow($landingPageDataType, 'title');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Title tag',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                    "validation": {
                        "rule": "required"
                    }
                }',
                'order'        => 2,
            ])->save();
        }

        $dataRow = $this->dataRow($landingPageDataType, 'meta_description');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text_area',
                'display_name' => 'Meta description',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 3,
            ])->save();
        }

        $dataRow = $this->dataRow($landingPageDataType, 'interests');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'select_multiple',
                'display_name' => 'Interest',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                    "relationship": {
                        "key": "id",
                        "label": "name"
                    }
                }',
                'order'        => 4,
            ])->save();
        }

        if ($dataRow->exists) {
            $dataRow->update([
                'read'       => 0,
            ]);
        }

        $dataRow = $this->dataRow($landingPageDataType, 'main_title');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'rich_text_box',
                'display_name' => 'Title #1',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 5,
            ])->save();
        }

        $dataRow = $this->dataRow($landingPageDataType, 'main_description');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'rich_text_box',
                'display_name' => 'Description #1',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 6,
            ])->save();
        }

        $dataRow = $this->dataRow($landingPageDataType, 'main_image');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'image',
                'display_name' => 'Main image',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                    "rule": "mime:jpg,jpeg,png"
                }',
                'order'        => 7,
            ])->save();
        }

        if ($dataRow->exists) {
            $dataRow->update([
                'display_name' => 'Main image (1920x1152)',
                'details'      => '{
                    "validation": {
                        "rule": "mimes:jpeg,jpg,png,ico,svg|dimensions:width=1920,height=1152"
                    }
                }',
            ]);
        }

        $dataRow = $this->dataRow($landingPageDataType, 'feature_bg_color');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Background Hexa Color',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 8,
            ])->save();
        }

        $dataRow = $this->dataRow($landingPageDataType, 'feature_title');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'rich_text_box',
                'display_name' => 'Title #2',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 8,
            ])->save();
        }

        $dataRow = $this->dataRow($landingPageDataType, 'feature_description');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'rich_text_box',
                'display_name' => 'Description #2',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 9,
            ])->save();
        }

        $dataRow = $this->dataRow($landingPageDataType, 'icons');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'select_multiple',
                'display_name' => 'Icons',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                    "relationship": {
                        "key": "id",
                        "label": "name"
                    }
                }',
                'order'        => 10,
            ])->save();
        }

        if ($dataRow->exists) {
            $dataRow->update([
                'read'       => 0,
            ]);
        }

        $dataRow = $this->dataRow($landingPageDataType, 'icon_images.*');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'image',
                'display_name' => 'Icon image (200x200)',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                    "validation": {
                        "rule": "mimes:jpeg,jpg,png,ico,svg|dimensions:width=200,height=200"
                    }
                }',
                'order'        => 10,
            ])->save();
        }

        $dataRow = $this->dataRow($landingPageDataType, 'testimony_title');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'rich_text_box',
                'display_name' => 'Title #3',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 11,
            ])->save();
        }

        $dataRow = $this->dataRow($landingPageDataType, 'testimony_description');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'rich_text_box',
                'display_name' => 'Description #3',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 12,
            ])->save();
        }

        $dataRow = $this->dataRow($landingPageDataType, 'testimonies');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'select_multiple',
                'display_name' => 'Testimonials',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                    "relationship": {
                        "key": "id",
                        "label": "name"
                    }
                }',
                'order'        => 13,
            ])->save();
        }

        if ($dataRow->exists) {
            $dataRow->update([
                'read'       => 0,
            ]);
        }

        $dataRow = $this->dataRow($landingPageDataType, 'testimony_images.*');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'image',
                'display_name' => 'Person Image (200x200)',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                    "validation": {
                        "rule": "mimes:jpeg,jpg,png,ico,svg|dimensions:width=200,height=200"
                    }
                }',
                'order'        => 13,
            ])->save();
        }

        $dataRow = $this->dataRow($landingPageDataType, 'university_title');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'rich_text_box',
                'display_name' => 'Title #4',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 14,
            ])->save();
        }

        $dataRow = $this->dataRow($landingPageDataType, 'universities');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'select_multiple',
                'display_name' => 'Universities/Degrees',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                    "relationship": {
                        "key": "id",
                        "label": "name"
                    }
                }',
                'order'        => 15,
            ])->save();
        }

        if ($dataRow->exists) {
            $dataRow->update([
                'read'       => 0,
            ]);
        }

        $dataRow = $this->dataRow($landingPageDataType, 'university_images.*');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'image',
                'display_name' => 'Image (400x206)',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                    "validation": {
                        "rule": "mimes:jpeg,jpg,png,ico,svg|dimensions:width=400,height=206"
                    }
                }',
                'order'        => 15,
            ])->save();
        }

        if ($dataRow->exists) {
            $dataRow->update([
                'read'       => 0,
            ]);
        }

        $dataRow = $this->dataRow($landingPageDataType, 'footer_content');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'rich_text_box',
                'display_name' => 'Footer #1',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 16,
            ])->save();
        }

        $dataRow = $this->dataRow($landingPageDataType, 'footer_note');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'rich_text_box',
                'display_name' => 'Footer #2',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 17,
            ])->save();
        }

        $dataRow = $this->dataRow($landingPageDataType, 'is_content_ready');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'select_dropdown',
                'display_name' => 'Content Ready',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{
                    "validation": {
                        "rule": "required|boolean"
                    },
                    "default": "0",
                    "options": {
                        "1": "Ready",
                        "0": "Not Ready"
                    }
                }',
                'order'        => 18,
            ])->save();
        }
    }

    /**
     * [dataRow description].
     *
     * @param [type] $type  [description]
     * @param [type] $field [description]
     *
     * @return [type] [description]
     */
    protected function dataRow($type, $field)
    {
        return DataRow::firstOrNew([
                'data_type_id' => $type->id,
                'field'        => $field,
            ]);
    }
}
