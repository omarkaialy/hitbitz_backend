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
                "name" => "نظم الشتغيل 1",
                "categoryId" => 17,
                "description" => "نظم التشغيل 1:\n\t- مقدمة في نظم التشغيل: تعريف نظم التشغيل ووظائفه الأساسية، وأنواع نظم التشغيل (مثل: Windows، Unix، Linux).\n\t- إدارة العمليات: مفهوم العملية (Process) والخيط (Thread)، وكيفية إنشاء وإدارة العمليات والخيوط، وحالات العملية (مثل: التشغيل، الانتظار، الإنهاء).\n\t- إدارة الذاكرة: طرق إدارة الذاكرة (مثل: الذاكرة الثابتة، التجزئة، الترحيل)، ومفهوم التجزئة والتجميع (Segmentation and Paging).\n\t- إدارة التخزين: كيفية التعامل مع نظم الملفات، واستراتيجيات تخزين البيانات وإدارتها.\n\t- إدارة الموارد: كيفية إدارة الموارد المشتركة (مثل: وحدات المعالجة المركزية، الذاكرة).\n\t- الجدولة: استراتيجيات جدولة العمليات (مثل: جدولة دوائرية، جدولة الأولوية).\n\nنظم التشغيل 2:\n\t- نظم الملفات: تفاصيل عن نظم الملفات المتقدمة (مثل: NTFS، EXT4)، وكيفية التعامل مع الملفات والمجلدات.\n\t- أمان نظم التشغيل: استراتيجيات تأمين النظام وحمايته من التهديدات، وإدارة الصلاحيات والمستخدمين.\n\t- العمليات المتقدمة: إدارة العمليات المتقدمة (مثل: التواصل بين العمليات، التزامن)، وحل مشاكل التزامن (مثل: التنافس، التوقف).",
                "image" => "basicscomputing.png"
            ], [
                "name" => "نظم التشغيل 2",
                "categoryId" => 17,
                "description" => "نظم التشغيل 2:\n\t- نظم الملفات: دراسة تفصيلية لنظم الملفات المتقدمة مثل NTFS وEXT4، وتعلم كيفية التعامل مع الملفات والمجلدات بفعالية.\n\t- أمان نظم التشغيل: استراتيجيات حماية النظام من التهديدات، وإدارة صلاحيات المستخدمين، وكيفية تأمين البيانات والنظام.\n\t- إدارة العمليات المتقدمة: كيفية إدارة العمليات المتقدمة، بما في ذلك التواصل بين العمليات والتزامن.\n\t- التزامن وإدارة الموارد: معالجة مشاكل التزامن مثل التنافس والتوقف، واستراتيجيات إدارة الموارد المشتركة.\n\t- أنظمة تشغيل متعددة: دراسة حول كيفية عمل أنظمة تشغيل متعددة (مثل: الأنظمة الموزعة، الأنظمة الافتراضية) وكيفية إدارتها بكفاءة.\n\t- تطوير نظم التشغيل: مبادئ تصميم وتطوير نظم التشغيل، والابتكارات الحديثة في هذا المجال.",
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
