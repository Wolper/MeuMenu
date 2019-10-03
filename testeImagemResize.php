<?php
   // O arquivo. Dependendo da configuração do PHP pode ser uma URL.
   $filename = 'original.jpg';
   //$filename = 'http://exemplo.com/original.jpg';

   // Largura e altura máximos (máximo, pois como é proporcional, o resultado varia)
   // No caso da pergunta, basta usar $_GET['width'] e $_GET['height'], ou só
   // $_GET['width'] e adaptar a fórmula de proporção abaixo.
   $width = 200;
   $height = 200;

   // Obtendo o tamanho original
   list($width_orig, $height_orig) = getimagesize($filename);

   // Calculando a proporção
   $ratio_orig = $width_orig/$height_orig;

   if ($width/$height > $ratio_orig) {
      $width = $height*$ratio_orig;
   } else {
      $height = $width/$ratio_orig;
   }

   // O resize propriamente dito. Na verdade, estamos gerando uma nova imagem.
   $image_p = imagecreatetruecolor($width, $height);
   $image = imagecreatefromjpeg($filename);
   imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);

   // Gerando a imagem de saída para ver no browser, qualidade 75%:
   header('Content-Type: image/jpeg');
   imagejpeg($image_p, null, 75);

   // Ou, se preferir, Salvando a imagem em arquivo:
   imagejpeg($image_p, 'nova.jpg', 75);
?>