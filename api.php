<?php
header('Content-Type: application/json');
$text = $_POST['text'];
$foto = $_FILES['foto']['name'];

$filedest = dirname(__FILE__) .'/'. $foto;
move_uploaded_file($_FILES['foto']['tmp_name'], $filedest);

$im = imagecreatefrompng($foto);

if($im && imagefilter($im, IMG_FILTER_GRAYSCALE))
{
    imagepng($im, $foto);
    $text = strtolower(str_replace(" ","",$text));
    print_r(json_encode((object) array(
      'text' => $text,
      'foto' => $foto,
     )));
}
else
{
  print_r(json_encode((object) array(
    'text' => "Error",
    'foto' => "",
   )));
}

imagedestroy($im);
?>
