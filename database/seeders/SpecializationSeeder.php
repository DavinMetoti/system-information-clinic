<?php

namespace Database\Seeders;

use App\Models\Specialization;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpecializationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Specialization::create([
            'name' => 'Cardiology',
            'slug' => 'cardiology',
            'description' => 'Specialization in heart and blood vessel disorders.',
        ]);
        Specialization::create([
            'name' => 'Neurology',
            'slug' => 'neurology',
            'description' => 'Specialization in nervous system disorders.',
        ]);
        Specialization::create([
            'name' => 'Pediatrics',
            'slug' => 'pediatrics',
            'description' => 'Specialization in medical care for children.',
        ]);
        Specialization::create([
            'name' => 'Orthopedics',
            'slug' => 'orthopedics',
            'description' => 'Specialization in musculoskeletal system disorders.',
        ]);
        Specialization::create([
            'name' => 'Dermatology',
            'slug' => 'dermatology',
            'description' => 'Specialization in skin disorders.',
        ]);
        Specialization::create([
            'name' => 'Psychiatry',
            'slug' => 'psychiatry',
            'description' => 'Specialization in mental health disorders.',
        ]);
        Specialization::create([
            'name' => 'Gynecology',
            'slug' => 'gynecology',
            'description' => 'Specialization in women\'s reproductive health.',
        ]);
        Specialization::create([
            'name' => 'Ophthalmology',
            'slug' => 'ophthalmology',
            'description' => 'Specialization in eye disorders.',
        ]);
        Specialization::create([
            'name' => 'ENT (Ear, Nose, Throat)',
            'slug' => 'ent',
            'description' => 'Specialization in ear, nose, and throat disorders.',
        ]);
        Specialization::create([
            'name' => 'Gastroenterology',
            'slug' => 'gastroenterology',
            'description' => 'Specialization in digestive system disorders.',
        ]);
        Specialization::create([
            'name' => 'Urology',
            'slug' => 'urology',
            'description' => 'Specialization in urinary tract disorders.',
        ]);
        Specialization::create([
            'name' => 'Pulmonology',
            'slug' => 'pulmonology',
            'description' => 'Specialization in lung and respiratory system disorders.',
        ]);
        Specialization::create([
            'name' => 'Endocrinology',
            'slug' => 'endocrinology',
            'description' => 'Specialization in hormone and metabolic disorders.',
        ]);
        Specialization::create([
            'name' => 'Oncology',
            'slug' => 'oncology',
            'description' => 'Specialization in cancer diagnosis and treatment.',
        ]);
        Specialization::create([
            'name' => 'Nephrology',
            'slug' => 'nephrology',
            'description' => 'Specialization in kidney diseases.',
        ]);
        Specialization::create([
            'name' => 'Rheumatology',
            'slug' => 'rheumatology',
            'description' => 'Specialization in joint, muscle, and autoimmune diseases.',
        ]);
        Specialization::create([
            'name' => 'Anesthesiology',
            'slug' => 'anesthesiology',
            'description' => 'Specialization in pain relief and patient care before, during, and after surgery.',
        ]);
        Specialization::create([
            'name' => 'Radiology',
            'slug' => 'radiology',
            'description' => 'Specialization in medical imaging techniques for diagnosis.',
        ]);
        Specialization::create([
            'name' => 'Internal Medicine',
            'slug' => 'internal-medicine',
            'description' => 'Specialization in prevention, diagnosis, and treatment of adult diseases.',
        ]);
        Specialization::create([
            'name' => 'General Surgery',
            'slug' => 'general-surgery',
            'description' => 'Specialization in surgical procedures covering a broad range of conditions.',
        ]);
    }
}