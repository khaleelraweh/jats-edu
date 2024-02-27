<?php

namespace Database\Seeders;

use App\Models\Photo;
use App\Models\ProductCategory;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds. 
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();


        $colthes['category_name'] = ['ar' => 'ملابس', 'en' => 'Clothes', 'ca' => 'Clothes',];
        $colthes['description'] = ['ar' => 'معلومات اكثر عن الملابس ', 'en' => 'More information about Clothes', 'ca' => 'el cuerno clothes',];
        $colthes['section'] = 1;
        $colthes['created_by'] = 'admin';
        $colthes['status'] = true;
        $colthes['published_on'] = $faker->dateTime();
        $colthes['parent_id'] = null;
        $colthes =  ProductCategory::create($colthes);


        $women_t_shirt['category_name'] = ['ar' => 'قمصان نسائية', 'en' => 'women_t_shirt', 'ca' => 'women_t_shirt',];
        $women_t_shirt['description'] = ['ar' => 'معلومات اكثر عن القمصان نسائية ', 'en' => 'More information about women_t_shirt', 'ca' => 'el cuerno women_t_shirt',];
        $women_t_shirt['section'] = 1;
        $women_t_shirt['created_by'] = 'admin';
        $women_t_shirt['status'] = true;
        $women_t_shirt['published_on'] = $faker->dateTime();
        $women_t_shirt['parent_id'] = $colthes->id;
        $women_t_shirt =  ProductCategory::create($women_t_shirt);



        $shoes['category_name'] = ['ar' => 'احذية', 'en' => 'shoes', 'ca' => 'shoes',];
        $shoes['description'] = ['ar' => 'معلومات اكثر عن الاحذية ', 'en' => 'More information about shoes', 'ca' => 'el cuerno shoes',];
        $shoes['section'] = 1;
        $shoes['created_by'] = 'admin';
        $shoes['status'] = true;
        $shoes['published_on'] = $faker->dateTime();
        $shoes['parent_id'] = null;
        $shoes =  ProductCategory::create($shoes);

        $wowem_shoes['category_name'] = ['ar' => 'احذية نسائية', 'en' => 'wowem_shoes', 'ca' => 'wowem_shoes',];
        $wowem_shoes['description'] = ['ar' => 'معلومات اكثر عن الاحذية نسائية ', 'en' => 'More information about wowem_shoes', 'ca' => 'el cuerno wowem_shoes',];
        $wowem_shoes['section'] = 1;
        $wowem_shoes['created_by'] = 'admin';
        $wowem_shoes['status'] = true;
        $wowem_shoes['published_on'] = $faker->dateTime();
        $wowem_shoes['parent_id'] = $shoes->id;
        $wowem_shoes =  ProductCategory::create($wowem_shoes);


        $watches['category_name'] = ['ar' => 'ساعات', 'en' => 'watches', 'ca' => 'watches',];
        $watches['description'] = ['ar' => 'معلومات اكثر عن الساعات ', 'en' => 'More information about watches', 'ca' => 'el cuerno watches',];
        $watches['section'] = 1;
        $watches['created_by'] = 'admin';
        $watches['status'] = true;
        $watches['published_on'] = $faker->dateTime();
        $watches['parent_id'] = null;
        $watches =  ProductCategory::create($watches);

        $women_watches['category_name'] = ['ar' => 'ساعات نسائية', 'en' => 'women_watches', 'ca' => 'women_watches',];
        $women_watches['description'] = ['ar' => 'معلومات اكثر عن الساعات نسائية ', 'en' => 'More information about women_watches', 'ca' => 'el cuerno women_watches',];
        $women_watches['section'] = 1;
        $women_watches['created_by'] = 'admin';
        $women_watches['status'] = true;
        $women_watches['published_on'] = $faker->dateTime();
        $women_watches['parent_id'] = null;
        $women_watches =  ProductCategory::create($women_watches);


        $electronies['category_name'] = ['ar' => 'كهربائيات', 'en' => 'electronies', 'ca' => 'electronies',];
        $electronies['description'] = ['ar' => 'معلومات اكثر عن الكهربائيات ', 'en' => 'More information about electronies', 'ca' => 'el cuerno electronies',];
        $electronies['section'] = 1;
        $electronies['created_by'] = 'admin';
        $electronies['status'] = true;
        $electronies['published_on'] = $faker->dateTime();
        $electronies['parent_id'] = null;
        $electronies =  ProductCategory::create($electronies);


        $women_electronies['category_name'] = ['ar' => 'كهربائيات نسائية', 'en' => 'women_electronies', 'ca' => 'women_electronies',];
        $women_electronies['description'] = ['ar' => 'معلومات اكثر عن الكهربائيات نسائية ', 'en' => 'More information about women_electronies', 'ca' => 'el cuerno women_electronies',];
        $women_electronies['section'] = 1;
        $women_electronies['created_by'] = 'admin';
        $women_electronies['status'] = true;
        $women_electronies['published_on'] = $faker->dateTime();
        $women_electronies['parent_id'] = null;
        $women_electronies =  ProductCategory::create($women_electronies);
    }
}
