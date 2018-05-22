<?php
if (isset($_GET['name'])) {
    $name = $_GET['name'];
} else {
    echo 'Имя не указано!';
    exit();
}
//$name = 'рома';
$image = imagecreatetruecolor(600, 420);

$backColor = imagecolorallocate($image, 255, 255, 255);
$textColor = imagecolorallocate($image, 0, 15, 90);
        
$certificateFile = __DIR__.'\sertificate.png';
if (!file_exists($certificateFile)) {
    echo 'Файл сертификата не найден!';
    exit;
}

$certificate = imagecreatefrompng($certificateFile);

imagefill($image, 0, 0, $backColor);
imagecopy($image, $certificate, 10, 10, 0, 0, 600, 420);
//imagecopy($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h)

$fontFile = __DIR__.'\font.ttf';
if (!file_exists($certificateFile)) {
    echo 'Шрифт не найден!';
    exit;
}

imagettftext($image, 40, 0, 50, 200, $textColor, $fontFile, $name.', ты молодец!');
header('Content-Type: image/jpeg');
imagepng($image);