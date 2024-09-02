<?php
/* Report only errors, hide warnings and notices */
error_reporting(E_ERROR | E_PARSE);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

$AppConfig = array (
        'db'                 
                                => array (
                                       
                'host'                                => 'php56-db',
                'user'                                => 'Anwar123',
                'password'                        => 'Anwar123',
                'database'                        => 'Anwar123',
         
                 /*                     

                'host'                                => 'localhost',
                'user'                                => 'root',
                'password'                        => '',
                'database'                        => 'tatar',
          */ 
             
        ),
                'Game'                         => array (
                'speed'                      => '50000000', // سرعة اللعبه
                'map'                      => '801', // حجم الخريطه
                'attack'        => '800', // سرعه الهجوم
                'protection'        => '24', // الحمايه بالساعات , ضف الساعه فقط 120 = 5 ايام فقط 
                'protectionx'        => '0', // تدبيل الحمايه يفضل 0
                'X'                 => '1328827643', // لاتغير الرقم
                'capacity'      => '650', // المخازن 
                'cranny'        => '100', // المخبأ وسعته
                'cp'            => '5000', // ولاء القرية الجديده
                'market'        => '10000', // حمولة التجار
                //قائمة بلاس 
                'plus1'          => '1', // مده قائمة بلاس باليوم
                'plus2'          => '1', // مدة زياده الموارد
                'plus3'          => '10', // سعر البلاس ترافيان 10 
                'plus4'          => '5', // سعر الزياده ترافيان 5
                'plus5'          => '1', // سعر ال
                'plus6'          => '1', // 
                'plus7'          => '35', //
                'plus8'          => '35',// انهاء التعزيزات فورا
                'plus9'          => '10', // البطل انهاء البطل 
                'plus10'          => '600',// نادي الذهب
                //سوق المحاربين
                'piyadeh1'        => '0.1', // سعر الجندي
                'piyadeh2'        => '0.3', // سعر الجندي
                'piyadeh3'        => '0.5', // سعر الجندي
                'piyadeh4'        => '0.1', // سعر الجندي

                'savareh1'        => '0.7',// سعر الفارس
                'savareh2'        => '0.9',// سعر الفارس القوس

                'shovalieh1'      => '1.1',// سعر المقلاع
                'shovalieh2'      => '1.3',// سعر 
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
                'startdate'             => '', //09/20/2012 05/20/2013------17:22
                'START_TIME'            => '' //00:00
        ),
        'plus'                        => array (
                'packages'        => array (
                       array (
                                'name'                => 'الاولى',
                                'gold'                => 50000,
                                'cost'                => 5,
                                'currency'        => 'usd',
                                'image'                => 'package_a.jpg',
                                'link'                => 'https://buy.stripe.com/test_aEU5lMgUt2Lxfcs9AA',
                        ),
                       array (
                                'name'                => 'الثانية',
                                'gold'                => 150000,
                                'cost'                => 10,
                                'currency'        => 'usd',
                                'image'                => 'package_a.jpg',
                                'link'                => 'https://buy.stripe.com/test_3cs6pQeMl3PB7K04gh',
                        ),
                       array (
                                'name'                => 'الثالثة',
                                'gold'                => 500000,
                                'cost'                => 20,
                                'currency'        => 'usd',
                                'image'                => 'package_b.jpg',
                                'link'                => 'https://buy.stripe.com/test_3cs3dE33DadZ4xOaEG',
                        ),
                       array (
                                'name'                => 'الرابعة',
                                'gold'                => 1500000,
                                'cost'                => 50,
                                'currency'        => 'usd',
                                'image'                => 'package_b.jpg',
                                'link'                => 'https://buy.stripe.com/test_3cs3dE33DadZ4xOaEG',
                        ),
                          array (
                                    'name'                => 'الخامسة',
                                    'gold'                => 3500000,
                                    'cost'                => 100,
                                    'currency'        => 'usd',
                                    'image'                => 'package_c.jpg',
                                    'link'                => 'https://buy.stripe.com/test_3cs3dE33DadZ4xOaEG',
                           ),
                                array (
                                        'name'                => 'السادسة',
                                        'gold'                => 8000000,
                                        'cost'                => 200,
                                        'currency'        => 'usd',
                                        'image'                => 'package_d.jpg',
                                        'link'                => 'https://buy.stripe.com/test_3cs3dE33DadZ4xOaEG',
                                 ),
                                array (
                                        'name'                => 'السابعة',
                                        'gold'                => 25000000,
                                        'cost'                => 500,
                                        'currency'        => 'usd',
                                        'image'                => 'package_d.jpg',
                                        'link'                => 'https://buy.stripe.com/test_3cs3dE33DadZ4xOaEG',
                                 ),
                                array (
                                        'name'                => 'الثامنة',
                                        'gold'                => 100000000,
                                        'cost'                => 1000,
                                        'currency'        => 'usd',
                                        'image'                => 'package_f.jpg',
                                        'link'                => 'https://buy.stripe.com/test_3cs3dE33DadZ4xOaEG',
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