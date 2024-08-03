<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Roadmap;
use App\Services\ImageService;
use Illuminate\Database\Seeder;

class RoadmapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roadmaps = [
            [
                "name" => "Python Mastery",
                "categoryId" => 6,
                "description" => "The Python Mastery Roadmap provides a comprehensive guide for learning Python, covering basics to advanced topics.",
                "image" => "python.png"
            ],
            [
                "name" => "Java Development",
                "categoryId" => 6,
                "description" => "The Java Development Roadmap outlines the steps to become proficient in Java programming, including core concepts and web development.",
                "image" => "java_development.png"
            ],
            [
                "name" => "JavaScript Essentials",
                "categoryId" => 6,
                "description" => "The JavaScript Essentials Roadmap offers a structured path to master JavaScript, covering fundamentals, libraries, and frameworks.",
                "image" => "javascript_essentials.png"
            ],
            [
                "name" => "C# Fundamentals",
                "categoryId" => 6,
                "description" => "The C# Fundamentals Roadmap provides a step-by-step guide to learning C#, including object-oriented programming and .NET development.",
                "image" => "csharp_fundamentals.png"
            ],
            [
                "name" => "Ruby on Rails Journey",
                "categoryId" => 6,
                "description" => "The Ruby on Rails Journey Roadmap helps you navigate through learning Ruby on Rails, a powerful web application framework.",
                "image" => "ruby_on_rails_journey.png"
            ],
            [
                "name" => "French Fluency",
                "categoryId" => 13,
                "description" => "The French Fluency Roadmap guides learners to achieve fluency in the French language, covering grammar, vocabulary, and cultural nuances.",
                "image" => "french_fluency.png"
            ],
            [
                "name" => "German Proficiency",
                "categoryId" => 13,
                "description" => "The German Proficiency Roadmap helps learners attain proficiency in German, focusing on grammar, pronunciation, and conversation skills.",
                "image" => "german_language_journey.png"
            ],
            [
                "name" => "Spanish Mastery",
                "categoryId" => 13,
                "description" => "The Spanish Mastery Roadmap provides a structured approach to mastering the Spanish language, covering grammar, listening, speaking, reading, and writing.",
                "image" => "spanish_proficiency.png"
            ],
            [
                "name" => "Italian Journey",
                "categoryId" => 13,
                "description" => "The Italian Journey Roadmap offers a step-by-step guide to learning Italian, from basic phrases to advanced language skills.",
                "image" => "italian_mastery.png"
            ],
            [
                'name' => 'Flutter',
                'categoryId' => 7,
                'description' => 'A comprehensive guide to mastering Flutter for building cross-platform mobile applications. Learn Flutter basics, UI design, state management, and how to build and deploy mobile apps for iOS and Android.',
                'image' => 'flutter_roadmap.png'
            ],
            [
                "name" => "التحليل 1",
                "categoryId" => 14,
                "description" => "تتضمن مادة التحليل 1 أربع أفكار رئيسية :المتتاليات - السلاسل - النهايات - الاشتقاق",
                "image" => "analysis.png"
            ],
            [
                "name" => "الفيزياء 1",
                "categoryId" => 14,
                "description" => "تتضمن مادة الفيزياء 1 الأفكار التالية :الكهرباء الساكنة - الحقل الكهربائي الساكن - الكمون الكهربائي - المكثفات ",
                "image" => "physics.png"
            ],
            [
                "name" => "رياضيات متقطعة",
                "categoryId" => 14,
                "description" => "تتضمن مادة الرياضيات المتقطعة الأفكار التالية :أدوات الربط - جداول الحقيقة - مفهومي التتولوجي والتناقض - التكافؤ المنطقي - الاقتضاء المنطقي - الاستدلال - الاستقراء الرياضي",
                "image" => "math.png"
            ],
            [
                "name" => "برمجة 1",
                "categoryId" => 14,
                "description" => "تتضمن مادة البرمجة 1 الأفكار التالية :مَن هو المبرمج  - لغات البرمجة - التعليمات الأساسية - المخططات التدفقية - أوامر الادخال والإخراج - أنواع المؤشرات - بنى الشرط والتكرار - المصفوفات والسلاسل ",
                "image" => "programming1.png"
            ],
            [
                "name" => "لغة 1",
                "categoryId" => 14,
                "description" => "English basics for Informatics Engineering level 1,2,3,4 ",
                "image" => "english.png"
            ],
            [
                "name" => "الثقافة",
                "categoryId" => 14,
                "description" => "تتضمن مادة الثقافة الفصول التالية : تاريخ سوريا المعاصر - الهوية الوطنية - التيارات السياسية في الوطن العربي - القضية الفلسطينية والصراع العربي الاسرائيلي - المتغيرات الدولية الراهنة",
                "image" => "culture.png"
            ],
            [
                "name" => "مبادئ عمل الحاسوب",
                "categoryId" => 14,
                "description" => "تتضمن مادة مبادئ عمل الحاسوب الافكار التالية: الأنظمة العددية - مكونات اللوحة الأم - أجهزة الدخل - نظام الإظهار - أنظمة التخزين - أنظمة الطباعة - أنظمة الترميز ",
                "image" => "basicscomputing.png"
            ],
            [
                "name" => "برمجة 2",
                "categoryId" => 14,
                "description" => "description",
                "image" => "programming1.png"
            ],
            [
                "name" => "تحليل 2",
                "categoryId" => 14,
                "description" => "description",
                "image" => "analysis2.png"
            ],
            [
                "name" => "فيزياء 2",
                "categoryId" => 14,
                "description" => "description",
                "image" => "physics2.png"
            ],
            [
                "name" => "عربي",
                "categoryId" => 14,
                "description" => "description",
                "image" => "arabic.png"
            ],
            [
                "name" => "لغة 2",
                "categoryId" => 14,
                "description" => "description",
                "image" => "english.png"
            ],
            [
                "name" => "جبر خطي",
                "categoryId" => 14,
                "description" => "description",
                "image" => "gebra.png"
            ],
            [
                "name" => "دارات كهربائية",
                "categoryId" => 14,
                "description" => "description",
                "image" => "electricty.png"
            ]
            , [
                "name" => "Operating Systmes #1",
                "categoryId" => 17,
                "description" => "Operating Systems #1:\n\t- Introduction to Operating Systems: Definition of operating systems and their basic functions, types of operating systems (e.g., Windows, Unix, Linux).\n\t- Process Management: Concept of process and thread, how to create and manage processes and threads, process states (e.g., running, waiting, terminated).\n\t- Memory Management: Methods of memory management (e.g., fixed memory, segmentation, paging), and the concept of segmentation and paging.\n\t- Storage Management: How to handle file systems, data storage, and management strategies.\n\t- Resource Management: How to manage shared resources (e.g., CPUs, memory).\n\t- Scheduling: Process scheduling strategies (e.g., round-robin scheduling, priority scheduling).\n\nOperating Systems 2:\n\t- File Systems: Details on advanced file systems (e.g., NTFS, EXT4), and how to handle files and folders.\n\t- Operating System Security: Strategies to secure the system and protect it from threats, managing permissions and users.\n\t- Advanced Processes: Managing advanced processes (e.g., inter-process communication, synchronization), and solving synchronization issues (e.g., contention, deadlock).",
                "image" => "basicscomputing.png"
            ], [
                "name" => "Operating Systmes #2",
                "categoryId" => 17,
                "description" => "Operating Systems #2:\n\t- File Systems: Detailed study of advanced file systems such as NTFS and EXT4, and learning how to handle files and folders effectively.\n\t- Operating System Security: Strategies for protecting the system from threats, managing user permissions, and securing data and the system.\n\t- Advanced Process Management: How to manage advanced processes, including inter-process communication and synchronization.\n\t- Synchronization and Resource Management: Handling synchronization issues such as contention and deadlock, and strategies for managing shared resources.\n\t- Multi-Operating Systems: Study of how multiple operating systems (e.g., distributed systems, virtual systems) work and how to manage them efficiently.\n\t- Operating System Development: Principles of designing and developing operating systems, and recent innovations in the field.",
                "image" => "basicscomputing.png"
            ],
        ];
        foreach ($roadmaps as $roadmap) {
            $roadmap1 = new Roadmap();
            $roadmap1->name = $roadmap['name'];
            $roadmap1->description = $roadmap['description'];
            $roadmap1->rate = 0;
            $category = Category::findOrFail($roadmap['categoryId']);

            $roadmap1->category()->associate($category->id);

            $roadmap1->save();
            $imageService = new ImageService();

            $imageService->storeImage($roadmap1,
                $roadmap['image'], 'roadMaps');


        }
    }
}
