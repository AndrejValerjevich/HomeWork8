<?php

class GenerateByGD
{
    public function create_certificate($user_name, $right_answers, $all_answers) {
        $image = imagecreatetruecolor(500,353);

        $text_color = imagecolorallocate($image, 129,15,90);
        $background_color = imagecolorallocate($image, 255,255,255);

        $image_box = imagecreatefromjpeg(__DIR__ . '/img/certificate.jpg');

        $font_file = __DIR__.'/font/Poiret_One.ttf';

        imagefill($image,0,0,$background_color);
        imagecopy($image, $image_box, 0,0,0,0, 500, 353);
        imagettftext($image,30,0,45,130, $text_color, $font_file, "Владелец сертификата:");
        imagettftext($image,30,0,170,190, $text_color, $font_file, "$user_name");
        imagettftext($image,30,0,145,260, $text_color, $font_file, "$right_answers/$all_answers баллов!");
        header('Content-Type: image/jpeg');
        imagejpeg($image,NULL,100);
    }//Генерация сертификата в случае успешной передачи данных через $_GET

    public function create_certificate_collapse() {
        $image = imagecreatetruecolor(500,353);

        $text_color = imagecolorallocate($image, 129,15,90);
        $background_color = imagecolorallocate($image, 255,255,255);

        $image_box = imagecreatefromjpeg(__DIR__ . '/img/certificate.jpg');

        $font_file = __DIR__.'/font/Poiret_One.ttf';

        imagefill($image,0,0,$background_color);
        imagecopy($image, $image_box, 0,0,0,0, 500, 353);
        imagettftext($image,30,0,120,190, $text_color, $font_file, "А ввести имя?");
        header('Content-Type: image/jpeg');
        imagejpeg($image,NULL,100);
    }//Генерация сертификата с предупреждением о забытом имени

    public function create_captcha($code) {
        $image = imagecreatetruecolor(300,120);

        $text_color = imagecolorallocate($image, 255,255,255);
        $background_color = imagecolorallocate($image, 255,255,255);

        $image_box = imagecreatefromjpeg(__DIR__ . '/img/captcha.jpg');

        $font_file = __DIR__.'/font/Poiret_One.ttf';

        imagefill($image,0,0,$background_color);
        imagecopy($image, $image_box, 0,0,0,0, 300, 120);
        imagettftext($image,40,0,30,80, $text_color, $font_file, "$code");
        header('Content-Type: image/jpeg');
        imagejpeg($image,NULL,100);
    }
}

?>