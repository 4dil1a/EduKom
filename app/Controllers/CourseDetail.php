<?php

namespace App\Controllers;

class CourseDetail extends BaseController
{
    public function detail($id)
    {
        // Data contoh kursus berdasarkan ID
        $courses = [
            1 => [
                'title' => 'Belajar Desain dengan Canva',
                'date' => 'Selasa, 7 Januari 2022',
                'instructors' => 'John Doe & Jane Doe',
                'description' => 'Kursus ini membahas dasar-dasar desain grafis menggunakan Canva.',
            ],
            2 => [
                'title' => 'Kursus Web Development',
                'date' => 'Selasa, 14 Januari 2022',
                'instructors' => 'Alice & Bob',
                'description' => 'Pelajari cara membangun website dengan HTML, CSS, dan JavaScript.',
            ],
            3 => [
                'title' => 'Kursus Desain Grafis',
                'date' => 'Senin, 21 Januari 2022',
                'instructors' => 'Michael & Sarah',
                'description' => 'Pelajari alat desain seperti Photoshop dan Illustrator.',
            ],
            4 => [
                'title' => 'Kursus Digital Marketing',
                'date' => 'Rabu, 28 Januari 2022',
                'instructors' => 'Emily & James',
                'description' => 'Kuasai strategi pemasaran digital untuk meningkatkan bisnis Anda.',
            ],
        ];

        // Periksa apakah kursus ada
        if (!isset($courses[$id])) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Kursus dengan ID $id tidak ditemukan.");
        }

        // Kirim data ke view
        return view('/auth/course_detail', ['course' => $courses[$id]]);
    }
}
