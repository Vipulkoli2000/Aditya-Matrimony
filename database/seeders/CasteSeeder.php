<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CasteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        
        // Clear existing data
        DB::table('sub_castes')->truncate();
        DB::table('castes')->truncate();

        // Caste mappings based on caste.txt file
        $casteMappings = [
            'Arya' => ['Arya Kshatriya'],
            'Brahmin' => [
                'Arya Vaishya',
                'Brahmin',
                'Bramhastriya',
                'Chitpavana Brahmin',
                'Daivajna Brahmin',
                'Deshasth Samvedi',
                'Deshastha Rugvedi',
                'Deshastha Yajurvedi',
                'Devrukhe',
                'Dhima Brahmins',
                'Gouda Saraswat Brahmin',
                'Gujurathi',
                'Havyaka Brahmin',
                'Hoysala Karnataka Brahmin',
                'Kandi',
                'Karahade',
                'Konkanasth Brahmin',
                'Punjabi',
                'Saraswat Brahmin',
                'Vaishnav Brahmin'
            ],
            'Gujrathi' => ['Gujrathi', 'Mistri'],
            'Halba' => ['Halba', 'Koshti'],
            'Kshatriya' => ['Kshatriya', 'Khumawat'],
            'Maratha' => ['96 Kuli Maratha', 'Kunabi', 'Maratha Teli', 'Prajapati'],
            'Vaishya' => ['Yadanyaseni']
        ];

        // All other castes that will be treated as independent castes without sub-castes
        $independentCastes = [
            'Agarwal', 'Agri', 'Ahir', 'Ahir Gawali', 'Ahir Sonar', 'Arora', 'Arya Samaj', 'Arya Vysya',
            'Badgujar', 'Bairagi', 'Bania', 'Banjara', 'Barai', 'Bari', 'Beldar', 'Bengali', 'Berad', 'Bhamti',
            'Bhandari', 'Bhanushali', 'Bharadi', 'Bhat', 'Bhatt', 'Bhavsar', 'Bhilla', 'Bhoi', 'Bhope', 'Billava',
            'Borul', 'Brahma Kshatriya', 'Buddhist', 'Burud', 'Chambhar', 'Chandravanshi', 'Chaurasia', 'Chitode Wani',
            'Chitrakathi', 'CKP', 'Dangat', 'Dashnam', 'Davari', 'Devadiga', 'Devang Koshthi', 'Dever', 'Devli',
            'Dhangar', 'Dhobi', 'Dhor', 'Ezhava', 'Gabit', 'Ganali', 'Garhwali Kumaoni', 'Gavandi', 'Gawali',
            'Ghatti', 'Ghisadi', 'Golha', 'Golla', 'Gollewar', 'Gomantak', 'Gond', 'Gondhali', 'Gopal', 'Gosavi',
            'Goswami', 'Gowari', 'Gowda', 'Gujar', 'Gujarati Mochi', 'Gurav', 'Halbi', 'Hindu', 'Hindu (Joshi)',
            'Hindu (Mavchi)', 'Hindu (Yelmar)', 'Hindu Namdhari', 'Hindu Nirhali', 'Hindu Pardeshi', 'Hindu Raval',
            'Hindu Shegar', 'Hindu Takari', 'Hindu Talwar', 'Holar', 'Jain', 'Jaiswal', 'Jangam', 'Jogi Nath',
            'Joshi', 'Kachhi', 'Kahar', 'Kaikadi', 'Kakayya', 'Kalal', 'Kalan', 'Kalar', 'Kapewar', 'Kapu',
            'Karwari', 'Kasar', 'Kashi Kapadi', 'Kayastha', 'Kharvi', 'Khatik', 'Khatri', 'Kohli', 'Kokana',
            'Kolhati', 'Koli', 'Koli Mahadev', 'Komati', 'Konkani', 'Kudal Deshakar', 'Kulwant Vani', 'Kumbhar',
            'Lad', 'Ladshakhiy Vani', 'Lava Patil', 'Leva Gurjar', 'Leva Patidar', 'Lingayat', 'Linqayatwani',
            'Lohar', 'Lonari', 'Loni', 'Madiga', 'Maheshwari', 'Mali', 'Mana', 'Mang', 'Mangalorean Tulu',
            'Mannervarlu', 'Marwari', 'Matang', 'Maurya', 'Modh Vania', 'Mogaveera', 'Munnuru Kapu', 'Nabhik',
            'Naidu', 'Nair', 'Namdev', 'Nath', 'Nathpanthi Gosavi', 'Navnath Gosavi', 'Neve', 'Neve Vani',
            'Nhavi', 'Not Disclose', 'Nutan Maratha', 'Otari', 'Pachkalshi', 'Padmashali', 'Panchal', 'Pardhi',
            'Parit', 'Patel', 'Pathare Prabhu', 'Patharvat', 'Pawar', 'Perika', 'Pujari', 'Raghuvanshi',
            'Rajastani Brahmin', 'Rajput', 'Ramoshi', 'Rawal', 'Reddy', 'Rohidas', 'Sagar', 'Sahastrarjun Kshatriya',
            'Sangar', 'Sarode', 'Savji', 'SC', 'Shilwant', 'Shimpi', 'Shivyogi', 'Sindhi', 'Somvanshi', 'Sonar',
            'ST', 'Suryavanshi Kshatriya', 'Sutar', 'Swakula Sali', 'Tambat', 'Tamil', 'Tamrakar', 'Teli', 'Telugu',
            'Telugu Mali', 'Thakar', 'Thakur', 'Vadar', 'Vaidu', 'Vaish', 'Vaishnav', 'Vaishnav Lad', 'Vaishya Vani',
            'Valmiki', 'Vani', 'Vaniya', 'Vanjari', 'Veer', 'Veershaiv Kakkaya', 'Velama', 'Vinkar', 'Vishwakarma',
            'Vysya', 'Warli', 'Yadav'
        ];

        // Step 1: Insert primary castes that have sub-castes
        $casteIds = [];
        foreach (array_keys($casteMappings) as $caste) {
            $casteIds[$caste] = DB::table('castes')->insertGetId([
                'name' => $caste,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        // Step 2: Insert independent castes (castes without sub-castes)
        $independentCasteData = [];
        foreach ($independentCastes as $caste) {
            $independentCasteData[] = [
                'name' => $caste,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }
        DB::table('castes')->insert($independentCasteData);

        // Step 3: Insert sub-castes for castes that have them
        $subCasteData = [];
        foreach ($casteMappings as $caste => $subCastes) {
            foreach ($subCastes as $subCaste) {
                $subCasteData[] = [
                    'caste_id' => $casteIds[$caste],
                    'name' => $subCaste,
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }
        }
        DB::table('sub_castes')->insert($subCasteData);

        Schema::enableForeignKeyConstraints();
    }
}
