<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CompanyRequest;

class CompanyRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CompanyRequest::create([
            'cp_user_name' => 'John Doe',
            'cp_user_email' => 'john@example.com',
            'cp_user_phone' => '1234567890',
            'cp_company_name' => 'Example Corp',
            'cp_job_title' => 'CEO',
            'cp_company_size' => '100-500',
            'cp_company_country' => 'USA',
            'cp_company_city' => 'New York',
            'status' => true,
            'published_on' => now(),
            'created_by' => 'Seeder',
        ]);

        CompanyRequest::create([
            'cp_user_name' => 'Jane Smith',
            'cp_user_email' => 'jane@example.com',
            'cp_user_phone' => '0987654321',
            'cp_company_name' => 'Tech Solutions',
            'cp_job_title' => 'CTO',
            'cp_company_size' => '50-100',
            'cp_company_country' => 'Canada',
            'cp_company_city' => 'Toronto',
            'status' => false,
            'published_on' => now(),
            'created_by' => 'Seeder',
        ]);

        CompanyRequest::create([
            'cp_user_name' => 'Mike Johnson',
            'cp_user_email' => 'mike@example.com',
            'cp_user_phone' => '1122334455',
            'cp_company_name' => 'Innovate LLC',
            'cp_job_title' => 'COO',
            'cp_company_size' => '500-1000',
            'cp_company_country' => 'UK',
            'cp_company_city' => 'London',
            'status' => true,
            'published_on' => now(),
            'created_by' => 'Seeder',
        ]);
    }
}
