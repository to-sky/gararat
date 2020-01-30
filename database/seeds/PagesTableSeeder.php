<?php

use Illuminate\Database\Seeder;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('home_page')->insert([
            'hp_id' => 1,
            'block_1' => 'Agricultural tractors, equipment, genuine spare parts and qualified service',
            'block_2' => 'GARARAT – the first e-hypermarket for agricultural tractors, equipment and spare parts!',
            'block_3' => '<h2 style="margin-top:0cm;background:#FBFBFB"><span style="color: rgb(23, 23, 23); text-align: justify; background-color: rgb(255, 255, 255); font-size: 14px; letter-spacing: 0.2px;">GARARAT is a reliable equipment, genuine spare parts
                            and qualified service for all branches of agriculture. We provide a full range
                            of services: from consultations when choosing equipment to warranty and post-warranty
                            maintenance.</span><br></h2>',
            'block_4' => 'GARARAT Group of companies',
            'block_5' => '<p class="MsoNormal"><span lang="EN-GB">GARARAT – international
group of companies specialised in </span><a href="https://gararat.com/catalog/1"><span lang="EN-GB">agricultural tractors, equipment</span></a><a href="https://gararat.com/catalog/2"><span lang="EN-GB">, spare parts</span></a><span lang="EN-GB"> and </span><a href="https://gararat.com/services"><span lang="EN-GB">services</span></a><span lang="EN-GB">.<o:p></o:p></span></p><p>

<span lang="EN-GB" style="font-size:11.0pt;line-height:107%;font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;;
mso-ascii-theme-font:minor-latin;mso-fareast-font-family:Calibri;mso-fareast-theme-font:
minor-latin;mso-hansi-theme-font:minor-latin;mso-bidi-font-family:Calibri;
mso-bidi-theme-font:minor-latin;mso-ansi-language:EN-GB;mso-fareast-language:
EN-US;mso-bidi-language:AR-SA">More than 20 years we work in the field of
agricultural equipment. Our </span><span style="font-size:11.0pt;line-height:
107%;font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;;mso-ascii-theme-font:minor-latin;
mso-fareast-font-family:Calibri;mso-fareast-theme-font:minor-latin;mso-hansi-theme-font:
minor-latin;mso-bidi-font-family:Arial;mso-bidi-theme-font:minor-bidi;
mso-ansi-language:RU;mso-fareast-language:EN-US;mso-bidi-language:AR-SA"><a href="https://gararat.com/contacts"><span lang="EN-GB">Group</span></a></span><span lang="EN-GB" style="font-size:11.0pt;line-height:107%;font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;;
mso-ascii-theme-font:minor-latin;mso-fareast-font-family:Calibri;mso-fareast-theme-font:
minor-latin;mso-hansi-theme-font:minor-latin;mso-bidi-font-family:Calibri;
mso-bidi-theme-font:minor-latin;mso-ansi-language:EN-GB;mso-fareast-language:
EN-US;mso-bidi-language:AR-SA"> consist of 9 sales and service points around
Egypt and an Assembly plant in Alexandria.</span><br></p>',
            'block_1_ar' => 'جرارات زراعية , معدات , قطع غيار اصلية و خدمة مؤهلة',
            'block_2_ar' => 'جرارات هو اول سوق إليكترونى للجرارات الزراعية و المعدات وقطع الغيار',
            'block_3_ar' => '<p class="MsoNormal" dir="RTL" style="text-align:right;direction:rtl;unicode-bidi:
embed"><span lang="AR-SA" style="font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;mso-ascii-font-family:
Calibri;mso-ascii-theme-font:minor-latin;mso-hansi-font-family:Calibri;
mso-hansi-theme-font:minor-latin;mso-bidi-font-family:Arial;mso-bidi-theme-font:
minor-bidi;mso-ansi-language:EN-US">جرارت يقدم</span><span lang="AR-SA" style="font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;mso-ascii-font-family:Calibri;
mso-ascii-theme-font:minor-latin;mso-hansi-font-family:Calibri;mso-hansi-theme-font:
minor-latin;mso-ansi-language:EN-US"> معدات موثوقة وقطع غيار أصلية وخدمة مؤهلة لجميع
فروع الزراعة. <o:p></o:p></span></p><p>

<span lang="AR-SA" dir="RTL" style="font-size:11.0pt;line-height:107%;font-family:
&quot;Arial&quot;,&quot;sans-serif&quot;;mso-ascii-font-family:Calibri;mso-ascii-theme-font:minor-latin;
mso-fareast-font-family:Calibri;mso-fareast-theme-font:minor-latin;mso-hansi-font-family:
Calibri;mso-hansi-theme-font:minor-latin;mso-ansi-language:EN-US;mso-fareast-language:
EN-US;mso-bidi-language:AR-SA">نحن نقدم مجموعة كاملة من الخدمات: من الاستشارات عند
اختيار المعدات إلى الضمان والصيانة فترة ما بعد الضمان.</span><br></p>',
            'block_4_ar' => 'مجموعة شركات جرارات',
            'block_5_ar' => '<p class="MsoNormal" dir="RTL" style="text-align:right;direction:rtl;unicode-bidi:
embed"><span lang="AR-SA" style="font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;mso-ascii-font-family:
Calibri;mso-ascii-theme-font:minor-latin;mso-hansi-font-family:Calibri;
mso-hansi-theme-font:minor-latin;mso-ansi-language:EN-GB">جرارات يمثل مجموعة من
الشركات الدولية المتخصصة فى ال</span><span lang="AR-EG" style="font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;
mso-ascii-font-family:Calibri;mso-ascii-theme-font:minor-latin;mso-hansi-font-family:
Calibri;mso-hansi-theme-font:minor-latin;mso-bidi-font-family:Arial;mso-bidi-theme-font:
minor-bidi;color:#171717;mso-ansi-language:EN-US;mso-bidi-language:AR-EG">جرارات
زراعية ,و المعدات و قطع الغيار و الخدمات.<o:p></o:p></span></p><p>

<span lang="AR-EG" dir="RTL" style="font-size:11.0pt;line-height:107%;font-family:
&quot;Arial&quot;,&quot;sans-serif&quot;;mso-ascii-font-family:Calibri;mso-ascii-theme-font:minor-latin;
mso-fareast-font-family:Calibri;mso-fareast-theme-font:minor-latin;mso-hansi-font-family:
Calibri;mso-hansi-theme-font:minor-latin;mso-bidi-theme-font:minor-bidi;
color:#171717;mso-ansi-language:EN-US;mso-fareast-language:EN-US;mso-bidi-language:
AR-EG">نحن نعمل منذ أكثر من عشرون عام فى مجال المعدات الزراعية. يمثل مجموعتنا
تسع نقاط بيع وخدمة بجميع أرجاء مصر و مصنع التجميع بمدينة الاسكندرية</span><br></p>'

        ]);
    }
}
