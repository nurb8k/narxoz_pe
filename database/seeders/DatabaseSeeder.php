<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Lesson;
use App\Models\Place;
use App\Models\Section;
use App\Models\Student;
use App\Models\Subscription;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

//        $user1 = \App\Models\User::query()->firstOrCreate(
//            ['identifier' => 's22017245',
//                'email' => 'test.student@narxoz.kz',],
//            ['identifier' => 's22017245',
//                'email' => 'test.student@narxoz.kz',
//                'password' => \Illuminate\Support\Facades\Hash::make('secretPass')]
//        );
//        $user1->students()->firstOrCreate(['gpa' => 3]);
//        $user2 = \App\Models\User::query()->firstOrCreate(
//            [
//                'identifier' => 'f22017266',
//                'email' => 'test.coach@narxoz.kz',
//
//            ],
//            [
//                'identifier' => 'f22017266',
//                'email' => 'test.coach@narxoz.kz',
//                'password' => \Illuminate\Support\Facades\Hash::make('secretPass')
//            ]
//        );
//
//        $user2->teachers()->firstOrCreate(
//            [
//                'about' => 'best coach'
//            ]
//        );
        $url = 'https://narxoz.edu.kz/images/tild3766-3765-4631-a431-343334326238__1.svg';

        $sections = [
            ['title' => 'ОФП', 'description' => 'Óбщая физи́ческая подготóвка (ОФП) — система[1] физических упражнений для укрепления здоровья и развития всех физических качеств (ловкости, координации, выносливости, гибкости, скорости, силы), направленных на всестороннее физическое развитие человека. При составлении набора упражнений ОФП следует избегать узкой специализации и излишнего развития одного физического качества за счёт и в ущерб остальных[2]. ОФП отличают от СФП.',],
            ['title' => 'Спортивные игры', 'description' => 'Спортивные игры, виды игровых состязаний, основой которых являются различные технические и тактические приёмы поражения в процессе противоборства определённой цели спортивным снарядом (обычно им является мяч спортивный, целью — ворота, площадка и т. п. соперников); содержание и организация С. и. регламентируются официальными правилами. Большинство С. и. представляет собой комплексы естественных движений, физических упражнений (бег, прыжки, метания, удары и т.п.), выполняемые игроком или взаимодействующими партнёрами в борьбе с соперником и направленные на создание игровых ситуаций, которые в итоге обеспечивают победу. Во многих С. и. спортсмены вступают в непосредственную, контактную борьбу. Широкое распространение С. и. обусловлено их доступностью, относительной простотой содержания и организации, силой эмоционального воздействия на участников и зрителей. Различают С. и. командные (например, волейбол, гандбол, крикет, все виды хоккея), личные (например, боулинг, кёрлинг, шахматы, шашки) и игры, существующие как личные и командные (например, бадминтон, гольф, настольный теннис, теннис). С. и. культивируются среди людей разного пола и возраста; некоторые, как правило, требующие большой физической нагрузки и силового единоборства (например, водное поло, регби, хоккей) — только среди мужчин. Правила проведения С. и. разрабатываются соответствующими международными федерациями; национальные С. и. (американский футбол, городки, лякросс, рус. шашки и др.) — национальными федерациями, которые способствуют развитию игр и организуют международные и национальные соревнования (см. Международные спортивные объединения, Спортивные федерации). По С. и. проводятся чемпионаты мира, континентов, отдельных стран, С. и. входят в программы Олимпийских игр, региональных и др. комплексных соревнований (например, Панамериканские игры, Всемирные студенческие игры, Спартакиада народов СССР). В СССР культивируется большинство С. и., получивших мировое признание. Федерации СССР по С. и. являются членами соответствующих международных федераций. В 1974 в СССР проведены всесоюзные чемпионаты по 16 видам С. и.; около 22,5 млн. чел., в том числе 6,7 млн., имевших спортивные разряды, и свыше 6 тыс. мастеров спорта, занимались С. и.; сов. спортсмены участвовали в 14 чемпионатах мира и Европы по С. и. и в 8 из них заняли первые места. В ряде стран С. и. считают биллиард, некоторые карточные игры, например бридж, и т. п. От С. и. следует отличать многочисленные подвижные игры спортивного характера (типа лапты, серсо, крокета, «пятнашек», «чижика» и т. п.), не имеющие строго регламентированных правил, системы организации и не требующие специальной подготовки .О содержании, организации и истории С. и. см. статьи об отдельных играх, например Волейбол.',],
            ['title' => 'Настольный теннис', 'description' => 'Настольный теннис — олимпийский вид спорта, спортивная игра с мячом, в которой используют специальные ракетки и игровой стол, разграниченный сеткой пополам.',],
            ['title' => 'Шахмат', 'description' => 'Ша́хматы (перс. شاه مات ‘шах мат’, буквальный перевод «шах умер»[4]) — настольная логическая игра с шахматными фигурами на 64-клеточной доске, сочетающая в себе элементы искусства (в том числе в части шахматной композиции), науки и спорта[5].В шахматы обычно играют два игрока (именуемые шахматистами) друг против друга. Также возможна игра одной группы шахматистов против другой или против одного игрока, такие партии зачастую именуются консультационными. Кроме того, существует практика сеансов одновременной игры, когда против одного сильного игрока играет несколько противников, каждый на отдельной доске.Правила игры в основном сложились к XV веку; в современных официальных турнирах применяются правила Международной шахматной федерации[6], которыми регламентируются не только передвижение фигур, но и права судьи, правила поведения игроков и контроль времени. Игра, осуществляемая дистанционно — например, по переписке, по телефону или через Интернет — имеет особые правила. Существует множество вариантов шахмат, отличающихся от классических: с нестандартными правилами, фигурами, размерами доски и т. п. Соответствующий раздел шахматной композиции — сказочные шахматы. Некоторые аспекты шахматной игры изучаются в математике (например, классические «Задача о ходе коня» и «Задача о восьми ферзях»), в том числе при помощи компьютерного моделирования.',],
        ];
//        $places = [
//            [
//                'title' => 'Зал Нархоз',
//                'address' => 'Жандосова 55',
//                'image' => $url
//            ], [
//                'title' => 'Стадион Нархоз',
//                'address' => 'Жандосова 55',
//                'image' => $url
//            ]
//        ];
//        $students = [
//           [ 'identifier' => 's22013465', 'gpa' => 3, 'password' =>'secretPass'],
//           [ 'identifier' => 's22013467', 'gpa' => 3,'password' =>'secretPass'],
//           [ 'identifier' => 's22013468', 'gpa' => 3,'password' =>'secretPass'],
//           [ 'identifier' => 's22013469', 'gpa' => 3, 'password' =>'secretPass'],
//           [ 'identifier' => 's22013460', 'gpa' => 3, 'password' =>'secretPass'],
//           [ 'identifier' => 's22013431', 'gpa' => 3,'password' =>'secretPass'],
//           [ 'identifier' => 's23013441', 'gpa' => 3, 'password' =>'secretPass'],
//           [ 'identifier' => 's23013451', 'gpa' => 3,'password' =>'secretPass'],
//           [ 'identifier' => 's23013461', 'gpa' => 3,'password' =>'secretPass'],
//           [ 'identifier' => 's23013471', 'gpa' => 3,'password' =>'secretPass'],
//           [ 'identifier' => 's25013481', 'gpa' => 3,'password' =>'secretPass'],
//           [ 'identifier' => 's26013491', 'gpa' => 3,'password' =>'secretPass'],
//           [ 'identifier' => 's27013401', 'gpa' => 3,'password' =>'secretPass'],
//           [ 'identifier' => 's27010401', 'gpa' => 3,'password' =>'secretPass'],
//           [ 'identifier' => 's27011401', 'gpa' => 3,'password' =>'secretPass'],
//           [ 'identifier' => 's27012401', 'gpa' => 3,'password' =>'secretPass'],
//           [ 'identifier' => 's27014401', 'gpa' => 3,'password' =>'secretPass'],
//           [ 'identifier' => 's27015401', 'gpa' => 3,'password' =>'secretPass'],
//           [ 'identifier' => 's27016401', 'gpa' => 3,'password' =>'secretPass'],
//
//        ];
//        $teachers = [
//            [ 'identifier' => 'f22013465', 'about' => 'sssss','password' =>'secretPass'],
//            [ 'identifier' => 'f22013467', 'about' => 'wdsss','password' =>'secretPass'],
//            [ 'identifier' => 'f22013468', 'about' => 'sffdss','password' =>'secretPass'],
//            [ 'identifier' => 'f22013469', 'about' => 'sewwddd','password' =>'secretPass'],
//            [ 'identifier' => 'f22013460', 'about' => 'dwwddswa','password' =>'secretPass'],
//            [ 'identifier' => 'f27014401', 'about' => 'ssdeesqq22','password' =>'secretPass'],
//            [ 'identifier' => 'f27015401', 'about' => 'sefwwea','password' =>'secretPass'],
//            [ 'identifier' => 'f27016401', 'about' => 'eweddwwws','password' =>'secretPass'],
//        ];
//        foreach ($places as $place) {
//            $placeV = Place::query()->firstOrCreate($place, $place);
//        }

//        foreach ($students as $student) {
//            $password = $student['password'];
//            $idf = $student['identifier'];
//            $userV = User::query()->firstOrCreate(['identifier'=>$idf], ['identifier'=>$idf, 'password'=>$password]);
//            unset($student['password']);
//            unset($student['identifier']);
//            Student::query()->firstOrCreate(['user_identifier'=>$idf], $student);
//        }
//        foreach ($teachers as $teacher) {
//            $password = $teacher['password'];
//            $idf = $teacher['identifier'];
//            $userV = User::query()->firstOrCreate(['identifier'=>$idf], ['identifier'=>$idf, 'password'=>$password]);
//            unset($teacher['password']);
//            unset($teacher['identifier']);
//            Teacher::query()->firstOrCreate(['user_identifier'=>$idf], $teacher);
//        }

//        foreach ($sections as $section) {
//            $sectionV = Section::query()->firstOrCreate($section, $section);
//            Lesson::query()->firstOrCreate(['section_id' => $sectionV])
//        }


        $lessons = [
            [
                'section_id' => 1,
                'teacher_id' => 1,
                'title' => 'ОФП',
//                'characteristics' => ['1', '2', '3'],
                'description' => 'ОФП',
                'poster' => $url,
                'status' => 'active',
                'type' => 'group',
                'start_time' => '10:00',
                'end_time' => '11:00',
                'start_date' => '2022-04-13',
                'capacity' => 20,
                'day_of_week' => 'monday',
                'place_id' => 1,
            ], [
                'section_id' => 1,
                'teacher_id' => 1,
                'title' => 'ОФП',
//                'characteristics' => ['1', '2', '3'],
                'description' => 'ОФП',
                'poster' => $url,
                'status' => 'active',
                'type' => 'group',
                'start_time' => '10:00',
                'end_time' => '11:00',
                'start_date' => '2022-04-13',
                'capacity' => 20,
                'day_of_week' => 'monday',
                'place_id' => 1,
            ], [
                'section_id' => 1,
                'teacher_id' => 1,
                'title' => 'ОФП',
//                'characteristics' => ['1', '2', '3'],
                'description' => 'ОФП',
                'poster' => $url,
                'status' => 'active',
                'type' => 'group',
                'start_time' => '10:00',
                'end_time' => '11:00',
                'start_date' => '2022-04-13',
                'capacity' => 20,
                'day_of_week' => 'monday',
                'place_id' => 1,
            ], [
                'section_id' => 1,
                'teacher_id' => 1,
                'title' => 'ОФП',
//                'characteristics' => ['1', '2', '3'],
                'description' => 'ОФП',
                'poster' => $url,
                'status' => 'active',
                'type' => 'group',
                'start_time' => '10:00',
                'end_time' => '11:00',
                'start_date' => '2022-04-13',
                'capacity' => 20,
                'day_of_week' => 'monday',
                'place_id' => 1,
            ], [
                'section_id' => 1,
                'teacher_id' => 1,
                'title' => 'ОФП',
//                'characteristics' => ['1', '2', '3'],
                'description' => 'ОФП',
                'poster' => $url,
                'status' => 'active',
                'type' => 'group',
                'start_time' => '10:00',
                'end_time' => '11:00',
                'start_date' => '2022-04-13',
                'capacity' => 20,
                'day_of_week' => 'monday',
                'place_id' => 1,
            ],

        ];

//        foreach ($lessons as $lesson) {
//            Lesson::query()->firstOrCreate($lesson, $lesson);
//        }

        Subscription::create([
            'lesson_id' => 4,
            'student_id' => 1,
            'attendance_type' => 'attending',
            'group' => '21.04.2024 10:00',
        ]);
    }
}
