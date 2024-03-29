<?php

namespace Database\Seeders;

use App\Models\CourseCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {


        // $this->call(WorldSeeder::class);
        // $this->call(WorldStatusSeeder::class);

        $this->call(EntrustSeeder::class);
        $this->call(SpecializationSeeder::class);
        $this->call(LecturerSeeder::class);
        // $this->call(UserAddressSeeder::class); //This will be only for user khaleel user
        $this->call(ProductCategorySeeder::class);
        $this->call(CardCategorySeeder::class);
        $this->call(InstructorSeeder::class);
        $this->call(CourseCategorySeeder::class);
        $this->call(CourseSeeder::class);
        $this->call(CourseReviewSeeder::class);


        $this->call(TagSeeder::class);
        // $this->call(ProductSeeder::class);
        $this->call(CardSeeder::class);
        $this->call(MainSliderSeeder::class);
        $this->call(AdvSliderSeeder::class);
        $this->call(ProductTagSeeder::class);
        $this->call(CouponSeeder::class);
        $this->call(ProductReviewSeeder::class);
        // $this->call(ShippingCompanySeeder::class);
        $this->call(PaymentMethodSeeder::class);
        $this->call(OrderSeeder::class);
        $this->call(CommonQuestionSeeder::class);
        $this->call(PaymentCategorySeeder::class);
        $this->call(PaymentMethodOfflineSeeder::class);

        $this->call(NewsSeeder::class);
        $this->call(WebMenuSeeder::class);
        $this->call(CompanyMenuSeeder::class);
        $this->call(TopicsMenuSeeder::class);
        $this->call(TracksMenuSeeder::class);
        $this->call(SupportMenuSeeder::class);

        $this->call(SiteSettingSeeder::class);

        $this->call(CurrencySeeder::class);

        $this->call(PostSeeder::class);

        $this->call(CardCodeSeeder::class);
        // last called 
        $this->call(TopicSeeder::class);
        $this->call(RequirementSeeder::class);
        $this->call(PhotoSeeder::class);
        $this->call(ReviewSeeder::class);
    }
}
