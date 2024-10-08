<?php
/* Report only errors, hide warnings and notices  */
error_reporting(E_ERROR | E_PARSE);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);


$AppConfig = array (
        'db'                 
                                => array (
                     
                'host'                                => 'localhost',
                'user'                                => 'root',
                'password'                        => '',
                'database'                        => 'tatar',
             
                        
        ),
                'Game'                         => array (
                'speed'                      => '500', // سرعة اللعبه
                'map'                      => '801', // حجم الخريطه
                'attack'        => '8', // سرعه الهجوم
                'protection'        => '24', // الحمايه بالساعات , ضف الساعه فقط 120 = 5 ايام فقط 
                'protectionx'        => '0', // تدبيل الحمايه يفضل 0
                'X'                 => '1328827643', // لاتغير الرقم
                'capacity'      => '650', // المخازن 
                'cranny'        => '100', // المخبأ وسعته
                'cp'            => '5000', // ولاء القرية الجديده
                'market'        => '50000', // حمولة التجار
                //قائمة بلاس 
                'plus1'          => '7', // مده قائمة بلاس باليوم
                'plus2'          => '7', // مدة زياده الموارد
                'plus3'          => '50', // سعر البلاس ترافيان 10 
                'plus4'          => '10', // سعر الزياده ترافيان 5
                'plus5'          => '1', // سعر ال
                'plus6'          => '1', // 
                'plus7'          => '35', //
                'plus8'          => '35',// انهاء التعزيزات فورا
                'plus9'          => '10', // البطل انهاء البطل 
                'plus10'          => '600',// نادي الذهب
                //سوق المحاربين
                'piyadeh1'        => '0.01', // سعر الجندي
                'piyadeh2'        => '0.03', // سعر الجندي
                'piyadeh3'        => '0.05', // سعر الجندي
                'piyadeh4'        => '0.01', // سعر الجندي

                'savareh1'        => '0.07',// سعر الفارس
                'savareh2'        => '0.09',// سعر الفارس القوس

                'shovalieh1'      => '0.11',// سعر المقلاع
                'shovalieh2'      => '0.13',// سعر 
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
                'admin_email'                => 'info@xtwar.com',
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
                                'link'                => 'https://buy.stripe.com/cN29C56gNfYCfg46ow',
                        ),
                       array (
                                'name'                => 'الثانية',
                                'gold'                => 150000,
                                'cost'                => 10,
                                'currency'        => 'usd',
                                'image'                => 'package_a.jpg',
                                'link'                => 'https://buy.stripe.com/cN25lP20xaEi5Fu145',
                        ),
                       array (
                                'name'                => 'الثالثة',
                                'gold'                => 500000,
                                'cost'                => 20,
                                'currency'        => 'usd',
                                'image'                => 'package_b.jpg',
                                'link'                => 'https://buy.stripe.com/14k01vgVreUygk8dQS',
                        ),
                       array (
                                'name'                => 'الرابعة',
                                'gold'                => 1500000,
                                'cost'                => 50,
                                'currency'        => 'usd',
                                'image'                => 'package_b.jpg',
                                'link'                => 'https://buy.stripe.com/7sI01vdJf4fU2ti003',
                        ),
                          array (
                                    'name'                => 'الخامسة',
                                    'gold'                => 3500000,
                                    'cost'                => 100,
                                    'currency'        => 'usd',
                                    'image'                => 'package_c.jpg',
                                    'link'                => 'https://buy.stripe.com/6oE15zbB75jY2ti5ko',
                           ),
                                array (
                                        'name'                => 'السادسة',
                                        'gold'                => 8000000,
                                        'cost'                => 200,
                                        'currency'        => 'usd',
                                        'image'                => 'package_d.jpg',
                                        'link'                => 'https://buy.stripe.com/dR6eWp34BfYC4Bq7sx',
                                 ),
                                array (
                                        'name'                => 'السابعة',
                                        'gold'                => 25000000,
                                        'cost'                => 500,
                                        'currency'        => 'usd',
                                        'image'                => 'package_d.jpg',
                                        'link'                => 'https://buy.stripe.com/28o3dH48F7s69VK4gm',
                                 ),
                                array (
                                        'name'                => 'الثامنة',
                                        'gold'                => 75000000,
                                        'cost'                => 1000,
                                        'currency'        => 'usd',
                                        'image'                => 'package_f.jpg',
                                        'link'                => 'https://buy.stripe.com/8wMdSleNj3bQ8RG14b',
                                 ),

                       
                ),
                'payments' => array (
                        
                )
        )

);