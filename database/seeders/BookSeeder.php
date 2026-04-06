<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $books = [
            [
                'title' => 'Laravel: From Novice to Professional',
                'author' => 'Mohammad Safari',
                'publisher' => 'TechMedia Publishing',
                'isbn' => '978-602-6232-18-5',
                'description' => 'Panduan lengkap belajar Laravel dari dasar hingga mahir. Cocok untuk pemula yang ingin mempelajari framework PHP paling populer ini.',
                'stock' => 5,
                'status' => 'available',
                'cover_image' => 'https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?w=300&h=400&fit=crop'
            ],
            [
                'title' => 'Pemrograman Web dengan PHP dan MySQL',
                'author' => 'Abdul Kadir',
                'publisher' => 'Andi Publisher',
                'isbn' => '978-979-29-1234-5',
                'description' => 'Buku komplit untuk mempelajari pemrograman web menggunakan PHP dan MySQL. Includes contoh proyek lengkap.',
                'stock' => 3,
                'status' => 'available',
                'cover_image' => 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?w=300&h=400&fit=crop'
            ],
            [
                'title' => 'JavaScript: The Good Parts',
                'author' => 'Douglas Crockford',
                'publisher' => 'O\'Reilly Media',
                'isbn' => '978-0-596-51774-8',
                'description' => 'Menjelaskan bagian-bagian terbaik dari JavaScript yang sering diabaikan namun sangat powerful.',
                'stock' => 4,
                'status' => 'available',
                'cover_image' => 'https://images.unsplash.com/photo-1627398242454-45a1465c2479?w=300&h=400&fit=crop'
            ],
            [
                'title' => 'Clean Code: A Handbook of Agile Software Craftsmanship',
                'author' => 'Robert C. Martin',
                'publisher' => 'Prentice Hall',
                'isbn' => '978-0-13-235088-4',
                'description' => 'Panduan menulis kode yang bersih, mudah dibaca, dan mudah dipelihara.',
                'stock' => 2,
                'status' => 'available',
                'cover_image' => 'https://images.unsplash.com/photo-1461749280684-dccba630e2f6?w=300&h=400&fit=crop'
            ],
            [
                'title' => 'Design Patterns: Elements of Reusable Object-Oriented Software',
                'author' => 'Erich Gamma',
                'publisher' => 'Addison-Wesley',
                'isbn' => '978-0-201-63361-0',
                'description' => 'Buku klasik tentang design patterns dalam pemrograman berorientasi objek.',
                'stock' => 3,
                'status' => 'available',
                'cover_image' => 'https://images.unsplash.com/photo-1504639725590-34d0984388bd?w=300&h=400&fit=crop'
            ],
            [
                'title' => 'Database System Concepts',
                'author' => 'Abraham Silberschatz',
                'publisher' => 'McGraw Hill',
                'isbn' => '978-0-07-802215-9',
                'description' => 'Buku referensi lengkap tentang konsep dan implementasi sistem basis data.',
                'stock' => 4,
                'status' => 'available',
                'cover_image' => 'https://images.unsplash.com/photo-1544383835-bda2bc66a55d?w=300&h=400&fit=crop'
            ],
            [
                'title' => 'Artificial Intelligence: A Modern Approach',
                'author' => 'Stuart Russell',
                'publisher' => 'Pearson',
                'isbn' => '978-0-13-604259-4',
                'description' => 'Buku teks standar untuk mata kuliah kecerdasan buatan.',
                'stock' => 2,
                'status' => 'available',
                'cover_image' => 'https://images.unsplash.com/photo-1677442136019-21780ecad995?w=300&h=400&fit=crop'
            ],
            [
                'title' => 'The Pragmatic Programmer',
                'author' => 'David Thomas',
                'publisher' => 'Addison-Wesley',
                'isbn' => '978-0-13-595705-9',
                'description' => 'Panduan praktis untuk menjadi programmer yang lebih baik.',
                'stock' => 3,
                'status' => 'available',
                'cover_image' => 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?w=300&h=400&fit=crop'
            ],
            [
                'title' => 'Structure and Interpretation of Computer Programs',
                'author' => 'Harold Abelson',
                'publisher' => 'MIT Press',
                'isbn' => '978-0-262-51087-5',
                'description' => 'Buku klasik yang mengajarkan fondasi pemrograman dengan Scheme.',
                'stock' => 2,
                'status' => 'available',
                'cover_image' => 'https://images.unsplash.com/photo-1516116216624-53e697fedbea?w=300&h=400&fit=crop'
            ],
            [
                'title' => 'Operating System Concepts',
                'author' => 'Abraham Silberschatz',
                'publisher' => 'Wiley',
                'isbn' => '978-1-118-09375-7',
                'description' => 'Konsep dasar sistem operasi yang wajib diketahui setiap developer.',
                'stock' => 3,
                'status' => 'available',
                'cover_image' => 'https://images.unsplash.com/photo-1518770660439-4636190af475?w=300&h=400&fit=crop'
            ],
            [
                'title' => 'Computer Networks',
                'author' => 'Andrew S. Tanenbaum',
                'publisher' => 'Pearson',
                'isbn' => '978-0-13-212695-3',
                'description' => 'Pemahaman mendalam tentang jaringan komputer.',
                'stock' => 2,
                'status' => 'available',
                'cover_image' => 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?w=300&h=400&fit=crop'
            ],
            [
                'title' => 'Python Crash Course',
                'author' => 'Eric Matthes',
                'publisher' => 'No Starch Press',
                'isbn' => '978-1-59327-928-8',
                'description' => 'Belajar Python dengan cepat melalui proyek-proyek menarik.',
                'stock' => 5,
                'status' => 'available',
                'cover_image' => 'https://images.unsplash.com/photo-1526379095098-d400fd0bf935?w=300&h=400&fit=crop'
            ]
        ];

        foreach ($books as $book) {
            Book::create($book);
        }
    }
}
