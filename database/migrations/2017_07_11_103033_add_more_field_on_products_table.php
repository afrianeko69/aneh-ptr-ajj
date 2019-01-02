<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMoreFieldOnProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table)
        {
            $table->double('price')->nullable();
            $table->decimal('discount_percentage', 5, 2)->nullable();
            $table->datetime('discount_start_at')->nullable();
            $table->datetime('discount_end_at')->nullable();
            $table->text('seo')->nullable();
            $table->integer('category_id')->nullable();
            $table->index(['category_id']);
            $table->integer('learning_method_id')->nullable();
            $table->index(['learning_method_id']);
            $table->string('industries')->nullable();
            $table->string('topics')->nullable();
            $table->string('providers')->nullable();
            $table->string('instructors')->nullable();
            $table->string('location_id')->nullable();
            $table->index(['location_id']);
            $table->string('location_detail')->nullable();
            $table->string('map')->nullable();
            $table->integer('quota')->unsigned()->nullable();
            $table->string('image')->nullable();
            $table->string('youtube_video_id')->nullable();
            $table->datetime('show_start_at')->nullable();
            $table->datetime('show_end_at')->nullable();
            $table->datetime('course_start_at')->nullable();
            $table->datetime('course_end_at')->nullable();
            $table->boolean('is_open_enrollment')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table)
        {
            if (Schema::hasColumn('products', 'price')) {
                $table->dropColumn('price');
            }
        });

        Schema::table('products', function (Blueprint $table)
        {
            if (Schema::hasColumn('products', 'discount')) {
                $table->dropColumn('discount');
            }
        });

        Schema::table('products', function (Blueprint $table)
        {
            if (Schema::hasColumn('products', 'discount_start_at')) {
                $table->dropColumn('discount_start_at');
            }
        });

        Schema::table('products', function (Blueprint $table)
        {
            if (Schema::hasColumn('products', 'discount_end_at')) {
                $table->dropColumn('discount_end_at');
            }
        });

        Schema::table('products', function (Blueprint $table)
        {
            if (Schema::hasColumn('products', 'seo')) {
                $table->dropColumn('seo');
            }
        });

        Schema::table('products', function (Blueprint $table)
        {
            if (Schema::hasColumn('products', 'category_id')) {
                $table->dropColumn('category_id');
            }
        });

        Schema::table('products', function (Blueprint $table)
        {
            if (Schema::hasColumn('products', 'learning_method_id')) {
                $table->dropIndex(['learning_method_id']);
            }
        });

        Schema::table('products', function (Blueprint $table)
        {
            if (Schema::hasColumn('products', 'learning_method_id')) {
                $table->dropColumn('learning_method_id');
            }
        });

        Schema::table('products', function (Blueprint $table)
        {
            if (Schema::hasColumn('products', 'industries')) {
                $table->dropColumn('industries');
            }
        });

        Schema::table('products', function (Blueprint $table)
        {
            if (Schema::hasColumn('products', 'topics')) {
                $table->dropColumn('topics');
            }
        });

        Schema::table('products', function (Blueprint $table)
        {
            if (Schema::hasColumn('products', 'providers')) {
                $table->dropColumn('providers');
            }
        });

        Schema::table('products', function (Blueprint $table)
        {
            if (Schema::hasColumn('products', 'instructors')) {
                $table->dropColumn('instructors');
            }
        });

        Schema::table('products', function (Blueprint $table)
        {
            if (Schema::hasColumn('products', 'location_id')) {
                $table->dropIndex(['location_id']);
            }
        });

        Schema::table('products', function (Blueprint $table)
        {
            if (Schema::hasColumn('products', 'location_id')) {
                $table->dropColumn('location_id');
            }
        });

        Schema::table('products', function (Blueprint $table)
        {
            if (Schema::hasColumn('products', 'location_detail')) {
                $table->dropColumn('location_detail');
            }
        });

        Schema::table('products', function (Blueprint $table)
        {
            if (Schema::hasColumn('products', 'map')) {
                $table->dropColumn('map');
            }
        });

        Schema::table('products', function (Blueprint $table)
        {
            if (Schema::hasColumn('products', 'quota')) {
                $table->dropColumn('quota');
            }
        });

        Schema::table('products', function (Blueprint $table)
        {
            if (Schema::hasColumn('products', 'image')) {
                $table->dropColumn('image');
            }
        });

        Schema::table('products', function (Blueprint $table)
        {
            if (Schema::hasColumn('products', 'youtube_video_id')) {
                $table->dropColumn('youtube_video_id');
            }
        });

        Schema::table('products', function (Blueprint $table)
        {
            if (Schema::hasColumn('products', 'show_start_at')) {
                $table->dropColumn('show_start_at');
            }
        });

        Schema::table('products', function (Blueprint $table)
        {
            if (Schema::hasColumn('products', 'show_end_at')) {
                $table->dropColumn('show_end_at');
            }
        });

        Schema::table('products', function (Blueprint $table)
        {
            if (Schema::hasColumn('products', 'course_start_at')) {
                $table->dropColumn('course_start_at');
            }
        });

        Schema::table('products', function (Blueprint $table)
        {
            if (Schema::hasColumn('products', 'course_end_at')) {
                $table->dropColumn('course_end_at');
            }
        });

        Schema::table('products', function (Blueprint $table)
        {
            if (Schema::hasColumn('products', 'is_open_enrollment')) {
                $table->dropColumn('is_open_enrollment');
            }
        });
    }
}
