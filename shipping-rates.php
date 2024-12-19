<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Define shipping rates
//  =================== Dry rates ====================
// Define base and additional rates for each region

$percent_discount = 0; // No discount now. Set 0.2 for 20% discount for additional items

// Region 1: Tokyo
$dry_base_r1 = 1100;
$dry_additional_r1 = $dry_base_r1 - ($dry_base_r1 * $percent_discount);
// Region 2: Kantou, Tyubu, Hokuriku, Shinetsu, Touhoku
$dry_base_r2 = 1150;
$dry_additional_r2 = $dry_base_r2 - ($dry_base_r2 * $percent_discount);
// Region 3: Kansai
$dry_base_r3 = 1200;
$dry_additional_r3 = $dry_base_r3 - ($dry_base_r3 * $percent_discount);
// Region 4: Tyugoku, Shikoku
$dry_base_r4 = 1300;
$dry_additional_r4 = $dry_base_r4 - ($dry_base_r4 * $percent_discount);
// Region 5: Kyusyu, Hokkaido
$dry_base_r5 = 1500;
$dry_additional_r5 = $dry_base_r5 - ($dry_base_r5 * $percent_discount);
// Region 6: Okinawa
$dry_base_r6 = 1800;
$dry_additional_r6 = $dry_base_r6 - ($dry_base_r6 * $percent_discount);

//  =================== Chilled rates ====================
// Chilled base and additional
// Region 1: Tokyo
$chilled_base_r1 = 1450;
$chilled_additional_r1 = $chilled_base_r1 - ($chilled_base_r1 * $percent_discount);
// Region 2: Kantou, Tyubu, Hokuriku, Shinetsu, Touhoku
$chilled_base_r2 = 1500;
$chilled_additional_r2 = $chilled_base_r2 - ($chilled_base_r2 * $percent_discount);
// Region 3: Kansai
$chilled_base_r3 = 1500;
$chilled_additional_r3 = $chilled_base_r3 - ($chilled_base_r3 * $percent_discount);
// Region 4: Tyugoku, Shikoku
$chilled_base_r4 = 1500;
$chilled_additional_r4 = $chilled_base_r4 - ($chilled_base_r4 * $percent_discount);
// Region 5: Kyusyu, Hokkaido
$chilled_base_r5 = 1850;
$chilled_additional_r5 = $chilled_base_r5 - ($chilled_base_r5 * $percent_discount);
// Region 6: Okinawa
$chilled_base_r6 = 2100;
$chilled_additional_r6 = $chilled_base_r6 - ($chilled_base_r6 * $percent_discount);


//  =================== Frozen rates ====================
// Frozen base and additional
// Region 1: Tokyo
$frozen_base_r1 = 2400;
$frozen_additional_r1 = $frozen_base_r1 - ($frozen_base_r1 * $percent_discount);
// Region 2: Kantou, Tyubu, Hokuriku, Shinetsu, Touhoku
$frozen_base_r2 = 2400;
$frozen_additional_r2 = $frozen_base_r2 - ($frozen_base_r2 * $percent_discount);
// Region 3: Kansai
$frozen_base_r3 = 2500;
$frozen_additional_r3 = $frozen_base_r3 - ($frozen_base_r3 * $percent_discount);
// Region 4: Tyugoku, Shikoku
$frozen_base_r4 = 2600;
$frozen_additional_r4 = $frozen_base_r4 - ($frozen_base_r4 * $percent_discount);
// Region 5: Kyusyu, Hokkaido
$frozen_base_r5 = 2800;
$frozen_additional_r5 = $frozen_base_r5 - ($frozen_base_r5 * $percent_discount);
// Region 6: Okinawa
$frozen_base_r6 = 4100;
$frozen_additional_r6 = $frozen_base_r6 - ($frozen_base_r6 * $percent_discount);

//  =================== Frozen Seperate rates ====================
// Frozen base and additional
// Region 1: Tokyo
$frozen_seperate_base_r1 = 4550;
$frozen_seperate_additional_r1 = $frozen_seperate_base_r1 - ($frozen_seperate_base_r1 * $percent_discount);
// Region 2: Kantou, Tyubu, Hokuriku, Shinetsu, Touhoku
$frozen_seperate_base_r2 = 4650;
$frozen_seperate_additional_r2 = $frozen_seperate_base_r2 - ($frozen_seperate_base_r2 * $percent_discount);
// Region 3: Kansai
$frozen_seperate_base_r3 = 4700;
$frozen_seperate_additional_r3 = $frozen_seperate_base_r3 - ($frozen_seperate_base_r3 * $percent_discount);
// Region 4: Tyugoku, Shikoku
$frozen_seperate_base_r4 = 4800;
$frozen_seperate_additional_r4 = $frozen_seperate_base_r4 - ($frozen_seperate_base_r4 * $percent_discount);
// Region 5: Kyusyu, Hokkaido
$frozen_seperate_base_r5 = 5350;
$frozen_seperate_additional_r5 = $frozen_seperate_base_r5 - ($frozen_seperate_base_r5 * $percent_discount);
// Region 6: Okinawa
$frozen_seperate_base_r6 = 5900;
$frozen_seperate_additional_r6 = $frozen_seperate_base_r6 - ($frozen_seperate_base_r6 * $percent_discount);


$shipping_rates = array(

    // ================ Region 1 Tokyo ==================
    // Tokyo
    'JP13' => array(
        'base' => $dry_base_r1, 'additional' => $dry_additional_r1,
        'chilled_base' => $chilled_base_r1, 'chilled_additional' => $chilled_additional_r1,
        'frozen_base' => $frozen_base_r1, 'frozen_additional' => $frozen_additional_r1,
        'frozen_seperate_base' => $frozen_seperate_base_r1, 'frozen_seperate_additional' => $frozen_seperate_additional_r1,
    ),
    // ================ Region 1 Tokyo ==================X


    //================= Region 2 Kantou =================
    // Ibaraki, Tochigi, Gunma, Saitama, Chiba, Kanagawa	
    'JP08' => array(
        'base' => $dry_base_r2, 'additional' => $dry_additional_r2,
        'chilled_base' => $chilled_base_r2, 'chilled_additional' => $chilled_additional_r2,
        'frozen_base' => $frozen_base_r2, 'frozen_additional' => $frozen_additional_r2,
        'frozen_seperate_base' => $frozen_seperate_base_r2, 'frozen_seperate_additional' => $frozen_seperate_additional_r2,
    ),
    'JP09' => array(
        'base' => $dry_base_r2, 'additional' => $dry_additional_r2,
        'chilled_base' => $chilled_base_r2, 'chilled_additional' => $chilled_additional_r2,
        'frozen_base' => $frozen_base_r2, 'frozen_additional' => $frozen_additional_r2,
        'frozen_seperate_base' => $frozen_seperate_base_r2, 'frozen_seperate_additional' => $frozen_seperate_additional_r2,
    ),
    'JP10' => array(
        'base' => $dry_base_r2, 'additional' => $dry_additional_r2,
        'chilled_base' => $chilled_base_r2, 'chilled_additional' => $chilled_additional_r2,
        'frozen_base' => $frozen_base_r2, 'frozen_additional' => $frozen_additional_r2,
        'frozen_seperate_base' => $frozen_seperate_base_r2, 'frozen_seperate_additional' => $frozen_seperate_additional_r2,
    ),
    'JP11' => array(
        'base' => $dry_base_r2, 'additional' => $dry_additional_r2,
        'chilled_base' => $chilled_base_r2, 'chilled_additional' => $chilled_additional_r2,
        'frozen_base' => $frozen_base_r2, 'frozen_additional' => $frozen_additional_r2,
        'frozen_seperate_base' => $frozen_seperate_base_r2, 'frozen_seperate_additional' => $frozen_seperate_additional_r2,
    ),
    'JP12' => array(
        'base' => $dry_base_r2, 'additional' => $dry_additional_r2,
        'chilled_base' => $chilled_base_r2, 'chilled_additional' => $chilled_additional_r2,
        'frozen_base' => $frozen_base_r2, 'frozen_additional' => $frozen_additional_r2,
        'frozen_seperate_base' => $frozen_seperate_base_r2, 'frozen_seperate_additional' => $frozen_seperate_additional_r2,
    ),
    'JP14' => array(
        'base' => $dry_base_r2, 'additional' => $dry_additional_r2,
        'chilled_base' => $chilled_base_r2, 'chilled_additional' => $chilled_additional_r2,
        'frozen_base' => $frozen_base_r2, 'frozen_additional' => $frozen_additional_r2,
        'frozen_seperate_base' => $frozen_seperate_base_r2, 'frozen_seperate_additional' => $frozen_seperate_additional_r2,
    ),
    // Tyubu
    //  Yamanashi,  Gifu, Shizuoka, Aichi	
    'JP19' => array(
        'base' => $dry_base_r2, 'additional' => $dry_additional_r2,
        'chilled_base' => $chilled_base_r2, 'chilled_additional' => $chilled_additional_r2,
        'frozen_base' => $frozen_base_r2, 'frozen_additional' => $frozen_additional_r2,
        'frozen_seperate_base' => $frozen_seperate_base_r2, 'frozen_seperate_additional' => $frozen_seperate_additional_r2,
    ),
    'JP21' => array(
        'base' => $dry_base_r2, 'additional' => $dry_additional_r2,
        'chilled_base' => $chilled_base_r2, 'chilled_additional' => $chilled_additional_r2,
        'frozen_base' => $frozen_base_r2, 'frozen_additional' => $frozen_additional_r2,
        'frozen_seperate_base' => $frozen_seperate_base_r2, 'frozen_seperate_additional' => $frozen_seperate_additional_r2,
    ),
    'JP22' => array(
        'base' => $dry_base_r2, 'additional' => $dry_additional_r2,
        'chilled_base' => $chilled_base_r2, 'chilled_additional' => $chilled_additional_r2,
        'frozen_base' => $frozen_base_r2, 'frozen_additional' => $frozen_additional_r2,
        'frozen_seperate_base' => $frozen_seperate_base_r2, 'frozen_seperate_additional' => $frozen_seperate_additional_r2,
    ),
    'JP23' => array(
        'base' => $dry_base_r2, 'additional' => $dry_additional_r2,
        'chilled_base' => $chilled_base_r2, 'chilled_additional' => $chilled_additional_r2,
        'frozen_base' => $frozen_base_r2, 'frozen_additional' => $frozen_additional_r2,
        'frozen_seperate_base' => $frozen_seperate_base_r2, 'frozen_seperate_additional' => $frozen_seperate_additional_r2,
    ),

    // Hokuriku
    // Toyama, Ishikawa, Fukui	
    'JP16' => array(
        'base' => $dry_base_r2, 'additional' => $dry_additional_r2,
        'chilled_base' => $chilled_base_r2, 'chilled_additional' => $chilled_additional_r2,
        'frozen_base' => $frozen_base_r2, 'frozen_additional' => $frozen_additional_r2,
        'frozen_seperate_base' => $frozen_seperate_base_r2, 'frozen_seperate_additional' => $frozen_seperate_additional_r2,
    ),
    'JP17' => array(
        'base' => $dry_base_r2, 'additional' => $dry_additional_r2,
        'chilled_base' => $chilled_base_r2, 'chilled_additional' => $chilled_additional_r2,
        'frozen_base' => $frozen_base_r2, 'frozen_additional' => $frozen_additional_r2,
        'frozen_seperate_base' => $frozen_seperate_base_r2, 'frozen_seperate_additional' => $frozen_seperate_additional_r2,
    ),
    'JP18' => array(
        'base' => $dry_base_r2, 'additional' => $dry_additional_r2,
        'chilled_base' => $chilled_base_r2, 'chilled_additional' => $chilled_additional_r2,
        'frozen_base' => $frozen_base_r2, 'frozen_additional' => $frozen_additional_r2,
        'frozen_seperate_base' => $frozen_seperate_base_r2, 'frozen_seperate_additional' => $frozen_seperate_additional_r2,
    ),

    // Shinetsu
    // Niigata, Nagano
    'JP15' => array(
        'base' => $dry_base_r2, 'additional' => $dry_additional_r2,
        'chilled_base' => $chilled_base_r2, 'chilled_additional' => $chilled_additional_r2,
        'frozen_base' => $frozen_base_r2, 'frozen_additional' => $frozen_additional_r2,
        'frozen_seperate_base' => $frozen_seperate_base_r2, 'frozen_seperate_additional' => $frozen_seperate_additional_r2,
    ),
    'JP20' => array(
        'base' => $dry_base_r2, 'additional' => $dry_additional_r2,
        'chilled_base' => $chilled_base_r2, 'chilled_additional' => $chilled_additional_r2,
        'frozen_base' => $frozen_base_r2, 'frozen_additional' => $frozen_additional_r2,
        'frozen_seperate_base' => $frozen_seperate_base_r2, 'frozen_seperate_additional' => $frozen_seperate_additional_r2,
    ),

    // touhoku
    // Aomori, Iwate, Miyagi, Akita, Yamagata, Fukushima
    'JP02' => array(
        'base' => $dry_base_r2, 'additional' => $dry_additional_r2,
        'chilled_base' => $chilled_base_r2, 'chilled_additional' => $chilled_additional_r2,
        'frozen_base' => $frozen_base_r2, 'frozen_additional' => $frozen_additional_r2,
        'frozen_seperate_base' => $frozen_seperate_base_r2, 'frozen_seperate_additional' => $frozen_seperate_additional_r2,
    ),
    'JP03' => array(
        'base' => $dry_base_r2, 'additional' => $dry_additional_r2,
        'chilled_base' => $chilled_base_r2, 'chilled_additional' => $chilled_additional_r2,
        'frozen_base' => $frozen_base_r2, 'frozen_additional' => $frozen_additional_r2,
        'frozen_seperate_base' => $frozen_seperate_base_r2, 'frozen_seperate_additional' => $frozen_seperate_additional_r2,
    ),
    'JP04' => array(
        'base' => $dry_base_r2, 'additional' => $dry_additional_r2,
        'chilled_base' => $chilled_base_r2, 'chilled_additional' => $chilled_additional_r2,
        'frozen_base' => $frozen_base_r2, 'frozen_additional' => $frozen_additional_r2,
        'frozen_seperate_base' => $frozen_seperate_base_r2, 'frozen_seperate_additional' => $frozen_seperate_additional_r2,
    ),
    'JP05' => array(
        'base' => $dry_base_r2, 'additional' => $dry_additional_r2,
        'chilled_base' => $chilled_base_r2, 'chilled_additional' => $chilled_additional_r2,
        'frozen_base' => $frozen_base_r2, 'frozen_additional' => $frozen_additional_r2,
        'frozen_seperate_base' => $frozen_seperate_base_r2, 'frozen_seperate_additional' => $frozen_seperate_additional_r2,
    ),
    'JP06' => array(
        'base' => $dry_base_r2, 'additional' => $dry_additional_r2,
        'chilled_base' => $chilled_base_r2, 'chilled_additional' => $chilled_additional_r2,
        'frozen_base' => $frozen_base_r2, 'frozen_additional' => $frozen_additional_r2,
        'frozen_seperate_base' => $frozen_seperate_base_r2, 'frozen_seperate_additional' => $frozen_seperate_additional_r2,
    ),
    'JP07' => array(
        'base' => $dry_base_r2, 'additional' => $dry_additional_r2,
        'chilled_base' => $chilled_base_r2, 'chilled_additional' => $chilled_additional_r2,
        'frozen_base' => $frozen_base_r2, 'frozen_additional' => $frozen_additional_r2,
        'frozen_seperate_base' => $frozen_seperate_base_r2, 'frozen_seperate_additional' => $frozen_seperate_additional_r2, 'frozen_seperate_additional' => $frozen_seperate_additional_r2,
    ),

    //================= Region 2 Kantou =================X


    //================= Region 3 Kansai =================
    // Osaka, Kyoto, Hyogo, Nara, Mie, Shiga, Wakayama	
    'JP26' => array(
        'base' => $dry_base_r3, 'additional' => $dry_additional_r3,
        'chilled_base' => $chilled_base_r3, 'chilled_additional' => $chilled_additional_r3,
        'frozen_base' => $frozen_base_r3, 'frozen_additional' => $frozen_additional_r3,
        'frozen_seperate_base' => $frozen_seperate_base_r3, 'frozen_seperate_additional' => $frozen_seperate_additional_r3,
    ),
    'JP27' => array(
        'base' => $dry_base_r3, 'additional' => $dry_additional_r3,
        'chilled_base' => $chilled_base_r3, 'chilled_additional' => $chilled_additional_r3,
        'frozen_base' => $frozen_base_r3, 'frozen_additional' => $frozen_additional_r3,
        'frozen_seperate_base' => $frozen_seperate_base_r3, 'frozen_seperate_additional' => $frozen_seperate_additional_r3,
    ),
    'JP28' => array(
        'base' => $dry_base_r3, 'additional' => $dry_additional_r3,
        'chilled_base' => $chilled_base_r3, 'chilled_additional' => $chilled_additional_r3,
        'frozen_base' => $frozen_base_r3, 'frozen_additional' => $frozen_additional_r3,
        'frozen_seperate_base' => $frozen_seperate_base_r3, 'frozen_seperate_additional' => $frozen_seperate_additional_r3,
    ),
    'JP29' => array(
        'base' => $dry_base_r3, 'additional' => $dry_additional_r3,
        'chilled_base' => $chilled_base_r3, 'chilled_additional' => $chilled_additional_r3,
        'frozen_base' => $frozen_base_r3, 'frozen_additional' => $frozen_additional_r3,
        'frozen_seperate_base' => $frozen_seperate_base_r3, 'frozen_seperate_additional' => $frozen_seperate_additional_r3,
    ),
    'JP30' => array(
        'base' => $dry_base_r3, 'additional' => $dry_additional_r3,
        'chilled_base' => $chilled_base_r3, 'chilled_additional' => $chilled_additional_r3,
        'frozen_base' => $frozen_base_r3, 'frozen_additional' => $frozen_additional_r3,
        'frozen_seperate_base' => $frozen_seperate_base_r3, 'frozen_seperate_additional' => $frozen_seperate_additional_r3,
    ),
    'JP25' => array(
        'base' => $dry_base_r3, 'additional' => $dry_additional_r3,
        'chilled_base' => $chilled_base_r3, 'chilled_additional' => $chilled_additional_r3,
        'frozen_base' => $frozen_base_r3, 'frozen_additional' => $frozen_additional_r3,
        'frozen_seperate_base' => $frozen_seperate_base_r3, 'frozen_seperate_additional' => $frozen_seperate_additional_r3,
    ),
    'JP24' => array(
        'base' => $dry_base_r3, 'additional' => $dry_additional_r3,
        'chilled_base' => $chilled_base_r3, 'chilled_additional' => $chilled_additional_r3,
        'frozen_base' => $frozen_base_r3, 'frozen_additional' => $frozen_additional_r3,
        'frozen_seperate_base' => $frozen_seperate_base_r3, 'frozen_seperate_additional' => $frozen_seperate_additional_r3,
    ),

    //================= Region 3 Kansai =================X

    //================= Region 4 ========================
    // Tyugoku
    // Okayama, Hiroshima, Tottori, Shimane, Yamaguchi	
    'JP33' => array(
        'base' => $dry_base_r4, 'additional' => $dry_additional_r4,
        'chilled_base' => $chilled_base_r4, 'chilled_additional' => $chilled_additional_r4,
        'frozen_base' => $frozen_base_r4, 'frozen_additional' => $frozen_additional_r4,
        'frozen_seperate_base' => $frozen_seperate_base_r4, 'frozen_seperate_additional' => $frozen_seperate_additional_r4,
    ),
    'JP34' => array(
        'base' => $dry_base_r4, 'additional' => $dry_additional_r4,
        'chilled_base' => $chilled_base_r4, 'chilled_additional' => $chilled_additional_r4,
        'frozen_base' => $frozen_base_r4, 'frozen_additional' => $frozen_additional_r4,
        'frozen_seperate_base' => $frozen_seperate_base_r4, 'frozen_seperate_additional' => $frozen_seperate_additional_r4,
    ),
    'JP31' => array(
        'base' => $dry_base_r4, 'additional' => $dry_additional_r4,
        'chilled_base' => $chilled_base_r4, 'chilled_additional' => $chilled_additional_r4,
        'frozen_base' => $frozen_base_r4, 'frozen_additional' => $frozen_additional_r4,
        'frozen_seperate_base' => $frozen_seperate_base_r4, 'frozen_seperate_additional' => $frozen_seperate_additional_r4,
    ),
    'JP32' => array(
        'base' => $dry_base_r4, 'additional' => $dry_additional_r4,
        'chilled_base' => $chilled_base_r4, 'chilled_additional' => $chilled_additional_r4,
        'frozen_base' => $frozen_base_r4, 'frozen_additional' => $frozen_additional_r4,
        'frozen_seperate_base' => $frozen_seperate_base_r4, 'frozen_seperate_additional' => $frozen_seperate_additional_r4,
    ),

    // Shikoku
    // Kagawa, Tokushima, Ehime, Kochi, Yamaguchi	
    'JP37' => array(
        'base' => $dry_base_r4, 'additional' => $dry_additional_r4,
        'chilled_base' => $chilled_base_r4, 'chilled_additional' => $chilled_additional_r4,
        'frozen_base' => $frozen_base_r4, 'frozen_additional' => $frozen_additional_r4,
        'frozen_seperate_base' => $frozen_seperate_base_r4, 'frozen_seperate_additional' => $frozen_seperate_additional_r4,
    ),

    'JP35' => array(
        'base' => $dry_base_r4, 'additional' => $dry_additional_r4,
        'chilled_base' => $chilled_base_r4, 'chilled_additional' => $chilled_additional_r4,
        'frozen_base' => $frozen_base_r4, 'frozen_additional' => $frozen_additional_r4,
        'frozen_seperate_base' => $frozen_seperate_base_r4, 'frozen_seperate_additional' => $frozen_seperate_additional_r4,
    ),

    'JP36' => array(
        'base' => $dry_base_r4, 'additional' => $dry_additional_r4,
        'chilled_base' => $chilled_base_r4, 'chilled_additional' => $chilled_additional_r4,
        'frozen_base' => $frozen_base_r4, 'frozen_additional' => $frozen_additional_r4,
        'frozen_seperate_base' => $frozen_seperate_base_r4, 'frozen_seperate_additional' => $frozen_seperate_additional_r4,
    ),
    'JP38' => array(
        'base' => $dry_base_r4, 'additional' => $dry_additional_r4,
        'chilled_base' => $chilled_base_r4, 'chilled_additional' => $chilled_additional_r4,
        'frozen_base' => $frozen_base_r4, 'frozen_additional' => $frozen_additional_r4,
        'frozen_seperate_base' => $frozen_seperate_base_r4, 'frozen_seperate_additional' => $frozen_seperate_additional_r4,
    ),
    'JP39' => array(
        'base' => $dry_base_r4, 'additional' => $dry_additional_r4,
        'chilled_base' => $chilled_base_r4, 'chilled_additional' => $chilled_additional_r4,
        'frozen_base' => $frozen_base_r4, 'frozen_additional' => $frozen_additional_r4,
        'frozen_seperate_base' => $frozen_seperate_base_r4, 'frozen_seperate_additional' => $frozen_seperate_additional_r4,
    ),

    //================= Region 4 ========================X

    //================= Region 5 ========================
    // Kyusyu
    // Fukuoka, Saga, Nagasaki, Kumamoto, Oita, Miyazaki, Kagoshima	
    'JP40' => array(
        'base' => $dry_base_r5, 'additional' => $dry_additional_r5,
        'chilled_base' => $chilled_base_r5, 'chilled_additional' => $chilled_additional_r5,
        'frozen_base' => $frozen_base_r5, 'frozen_additional' => $frozen_additional_r5,
        'frozen_seperate_base' => $frozen_seperate_base_r5, 'frozen_seperate_additional' => $frozen_seperate_additional_r5,

    ),
    'JP41' => array(
        'base' => $dry_base_r5, 'additional' => $dry_additional_r5,
        'chilled_base' => $chilled_base_r5, 'chilled_additional' => $chilled_additional_r5,
        'frozen_base' => $frozen_base_r5, 'frozen_additional' => $frozen_additional_r5,
        'frozen_seperate_base' => $frozen_seperate_base_r5, 'frozen_seperate_additional' => $frozen_seperate_additional_r5,
    ),
    'JP42' => array(
        'base' => $dry_base_r5, 'additional' => $dry_additional_r5,
        'chilled_base' => $chilled_base_r5, 'chilled_additional' => $chilled_additional_r5,
        'frozen_base' => $frozen_base_r5, 'frozen_additional' => $frozen_additional_r5,
        'frozen_seperate_base' => $frozen_seperate_base_r5, 'frozen_seperate_additional' => $frozen_seperate_additional_r5,
    ),
    'JP43' => array(
        'base' => $dry_base_r5, 'additional' => $dry_additional_r5,
        'chilled_base' => $chilled_base_r5, 'chilled_additional' => $chilled_additional_r5,
        'frozen_base' => $frozen_base_r5, 'frozen_additional' => $frozen_additional_r5,
        'frozen_seperate_base' => $frozen_seperate_base_r5, 'frozen_seperate_additional' => $frozen_seperate_additional_r5,
    ),
    'JP44' => array(
        'base' => $dry_base_r5, 'additional' => $dry_additional_r5,
        'chilled_base' => $chilled_base_r5, 'chilled_additional' => $chilled_additional_r5,
        'frozen_base' => $frozen_base_r5, 'frozen_additional' => $frozen_additional_r5,
        'frozen_seperate_base' => $frozen_seperate_base_r5, 'frozen_seperate_additional' => $frozen_seperate_additional_r5,
    ),
    'JP45' => array(
        'base' => $dry_base_r5, 'additional' => $dry_additional_r5,
        'chilled_base' => $chilled_base_r5, 'chilled_additional' => $chilled_additional_r5,
        'frozen_base' => $frozen_base_r5, 'frozen_additional' => $frozen_additional_r5,
        'frozen_seperate_base' => $frozen_seperate_base_r5, 'frozen_seperate_additional' => $frozen_seperate_additional_r5,
    ),
    'JP46' => array(
        'base' => $dry_base_r5, 'additional' => $dry_additional_r5,
        'chilled_base' => $chilled_base_r5, 'chilled_additional' => $chilled_additional_r5,
        'frozen_base' => $frozen_base_r5, 'frozen_additional' => $frozen_additional_r5,
        'frozen_seperate_base' => $frozen_seperate_base_r5, 'frozen_seperate_additional' => $frozen_seperate_additional_r5,
    ),
    // Hokkaido
    'JP01' => array(
        'base' => $dry_base_r5, 'additional' => $dry_additional_r5,
        'chilled_base' => $chilled_base_r5, 'chilled_additional' => $chilled_additional_r5,
        'frozen_base' => $frozen_base_r5, 'frozen_additional' => $frozen_additional_r5,
        'frozen_seperate_base' => $frozen_seperate_base_r5, 'frozen_seperate_additional' => $frozen_seperate_additional_r5,
    ),

    //================= Region 5 ========================X

    //================= Region 6 ========================
    // Okinawa
    'JP47' => array(
        'base' => $dry_base_r6, 'additional' => $dry_additional_r6,
        'chilled_base' => $chilled_base_r6, 'chilled_additional' => $chilled_additional_r6,
        // 'frozen_base' => $frozen_base_r6, 'frozen_additional' => $frozen_additional_r6,
        // 'frozen_seperate_base' => $frozen_seperate_base_r6, 'frozen_seperate_additional' => $frozen_seperate_additional_r6,

    ),
    //================= Region 6 ========================X

);
