<?php

namespace Database\Seeders;

use App\Models\CertificateIssue;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CertificateIssueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        // Seed 1
        CertificateIssue::create([
            // 'stud_certificate_name' => json_encode(['Certificate of Completion']),
            'stud_certificate_name' => ['ar' => 'شهادة الإنجاز', 'en' => 'Certificate of Completion'],

            // 'stud_full_name' => json_encode(['John Doe']),
            'stud_full_name' => ['ar' => 'خليل عبدالله عبده غالب راوح', 'en' => 'khaleel abdallah abdo ghalib raweh'],


            'stud_date_of_birth' => Carbon::parse('1990-01-01 00:00:00'),
            'stud_place_of_birth' => Carbon::parse('1990-01-01 00:00:00'),
            'stud_nationality' => 'American',
            'stud_country' => 'USA',
            'stud_city' => 'New York',
            'stud_phone' => '123456789',
            'stud_whatsup_phone' => '987654321',
            'stud_identity_type' => 'Passport',
            'stud_identity_attachment' => 'passport_image.jpg',
            'stud_certificate_status' => 0, // قيد المراجعة
            'stud_verification_code' => 'ABC123',
            'stud_certificate_release_date' => Carbon::parse('2024-01-01 00:00:00'),
            'stud_certificate_type' => 0, // From the site
            'stud_certificate_cost' => 0,
            'stud_certificate_file' => 'certificate.pdf',
            'course_id' => 1, // Assuming this course exists
            'status' => true,
            'published_on' => Carbon::now(),
            'created_by' => 'admin',
            'updated_by' => 'admin',
        ]);

        // Seed 2
        CertificateIssue::create([
            // 'stud_certificate_name' => json_encode(['Diploma in Technical Education']),
            'stud_certificate_name' => ['ar' => 'دبلوم التعليم الفني', 'en' => 'Diploma in Technical Education'],



            // 'stud_full_name' => json_encode(['Jane Smith']),
            'stud_full_name' => ['ar' => 'محمد عبدالله عبده غالب راوح', 'en' => 'mohamed abdallah abdo ghalib raweh'],

            'stud_date_of_birth' => Carbon::parse('1995-05-15 00:00:00'),
            'stud_place_of_birth' => Carbon::parse('1995-05-15 00:00:00'),
            'stud_nationality' => 'Canadian',
            'stud_country' => 'Canada',
            'stud_city' => 'Toronto',
            'stud_phone' => '555555555',
            'stud_whatsup_phone' => '444444444',
            'stud_identity_type' => 'National ID',
            'stud_identity_attachment' => 'national_id_image.jpg',
            'stud_certificate_status' => 2, // تم الاصدار
            'stud_verification_code' => 'XYZ789',
            'stud_certificate_release_date' => Carbon::parse('2024-06-15 00:00:00'),
            'stud_certificate_type' => 1, // Ministry of Technical Education
            'stud_certificate_cost' => 1,
            'stud_certificate_file' => 'diploma.pdf',
            'course_id' => 2, // Assuming this course exists
            'status' => true,
            'published_on' => Carbon::now(),
            'created_by' => 'admin',
            'updated_by' => 'admin',
        ]);
    }
}
