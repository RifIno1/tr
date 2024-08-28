<?php
/* Report only errors, hide warnings and notices
error_reporting(E_ERROR | E_PARSE);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
*/
$AppConfig = array (
        'db'                 
                                => array (
                   /*                   
                'host'                                => 'php56-db',
                'user'                                => 'Anwar123',
                'password'                        => 'Anwar123',
                'database'                        => 'Anwar123',
*/
 
                'host'                                => 'localhost',
                'user'                                => 'root',
                'password'                        => '',
                'database'                        => 'tatar',
                 
                
        ),
                'Game'                         => array (
                'speed'                      => '10000', // سرعة اللعبه
                'map'                      => '801', // حجم الخريطه
                'attack'        => '30', // سرعه الهجوم
                'protection'        => '1', // الحمايه بالساعات , ضف الساعه فقط 120 = 5 ايام فقط 
                'protectionx'        => '0', // تدبيل الحمايه يفضل 0
                'X'                 => '1328827643', // لاتغير الرقم
                'capacity'      => '1000', // المخازن 
                'cranny'        => '1000', // المخبأ وسعته
                'cp'            => '1000', // ولاء القرية الجديده
                'market'        => '10000', // حمولة التجار
                //قائمة بلاس 
                'plus1'          => '3', // مده قائمة بلاس باليوم
                'plus2'          => '3', // مدة زياده الموارد
                'plus3'          => '5', // سعر البلاس ترافيان 10 
                'plus4'          => '5', // سعر الزياده ترافيان 5
                'plus5'          => '2', // سعر ال
                'plus6'          => '3', // 
                'plus7'          => '500', //
                'plus8'          => '1000',// انهاء التعزيزات فورا
                'plus9'          => '10', // البطل انهاء البطل 
                'plus10'          => '600',// نادي الذهب
                //سوق المحاربين
                'piyadeh'        => '1.00', // سعر الجندي
                'savareh'        => '1.05',// سعر الفارس
                'shovalieh'      => '2.00',// سعر المقلاع
                //3am
                'bonous'        => '200',// 
                'day_game'        => '(2013/07/21)',//
                'day_tatar'        => '(2013/04/26)',//
                'day_art'        => '(2013/03/18)', //
                'online'        => '9000', // 
                'freegold'       => '1000000', // 
                'pepole'         => '1000', //
                'over'          => '30', // غير مهم 
                'RegisterOver'  => '10', // موعد أغلاق التسجيل
                'artover'  => '0', // موعد ضهور التحف بالايام
                'tatarover'  => '1'// موعد ضه,ر التتار بالايام فقط
        ),
        'page'                 => array (

                'ar_title'                        => 'حرب التتار',
                'en_title'                        => 'Tatar War',
                'asset_version'                => 'c4b7aaaadef'
        ),
        'system'         => array (
                'adminName'         => 'admin', 
                'adminPassword'          => 'admin',
                'lang'                                => 'ar',
                'admin_email'                => 'admin@tatars.com',
                'email'                         => 'Tatar-WaR',
                'installkey'                 => 'achraf',
                'calltatar'                 => 'tatar',
                'artefact'                 => 'tohaf',
                'total_players'                 => '1000',
                'startdate'             => '', //09/20/2012 05/20/2013------17:22
                'START_TIME'            => '' //00:00
        ),
        'plus'                        => array (
                'packages'        => array (
                       array (
                                'name'                => 'الاولى',
                                'gold'                => 150,
                                'cost'                => 1,
                                'currency'        => 'usd',
                                'image'                => 'gold.jpg'
                        ),
                       array (
                                'name'                => 'الثانية',
                                'gold'                => 3000,
                                'cost'                => 3,
                                'currency'        => 'usd',
                                'image'                => 'gold.jpg'
                        ),
                       array (
                                'name'                => 'الثالثة',
                                'gold'                =>4000,
                                'cost'                => 5,
                                'currency'        => 'usd',
                                'image'                => 'gold.jpg'
                        ),
                       array (
                                'name'                => 'الرابعة',
                                'gold'                => 9000,
                                'cost'                => 10,
                                'currency'        => 'usd',
                                'image'                => 'gold.jpg'
                        ),
                       array (
                                'name'                => 'الخامسه',
                                'gold'                => 30000,
                                'cost'                => 30,
                                'currency'        => 'usd',
                                'image'                => 'gold.jpg'
                        ),
                       array (
                                'name'                => 'السادسه',
                                'gold'                => 40000,
                                'cost'                => 50,
                                'currency'        => 'usd',
                                'image'                => 'gold.jpg'
                        ),
                       array (
                                'name'                => 'السابعه',
                                'gold'                => 60000,
                                'cost'                => 75,
                                'currency'        => 'usd',
                                'image'                => 'gold.jpg'
                        ),
                       array (
                                'name'                => 'الثامنه.عرض خاص',
                                'gold'                => 200000,
                                'cost'                => 100,
                                'currency'        => 'usd',
                                'image'                => 'gold.jpg'
                        ),
                ),
                'payments' => array (
                        'cashu'        => array (
                                'testMode'                => FALSE,
                                'name'                        => 'CashU',
                                'image'                        => 'cashu.gif',
                                'serviceName'         => 'tc1-gold',
                                'merchant_id'        => 'راسل الادارة',
                                'key'                        => 'jhgf',
                                'testKey'                => 'yrf',
                                'returnKey'                => 'fff',
                                'currency'                => 'usd'
                                ),
                )
        )

);