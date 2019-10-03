<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Image
 *
 * @author dikson
 */
class Image {

    private static $filename = "http://localhost/MeuMenu/assets/images/meumenu.jpg";
    private static $width;
    private static $height;
    private static $largura = 200;
    private static $altura = 200;

    public static function validarTipoImagem($file): bool {
        $tipos = array('image/jpeg', 'image/jpg', 'image/png');

        
            $fileType = $file['imagem']['type'];
            if (in_array($fileType, $tipos)):
                die(var_dump($file));
            else:
                return FALSE;
            endif;
     }

    public static function redimensionar() {
        list(self::$width, self::$height) = getimagesize(self::$filename);
        $ratio = self::$width / self::$height;

        if ((self::$largura / self::$altura) > $ratio):
            self::$largura = self::$altura * $ratio;
        else:
            self::$altura = self::$largura * $ratio;
        endif;

        $imagemFinal = imagecreatetruecolor(self::$altura, self::$largura);
        $imagemOriginal = imagecreatefromjpeg(self::$filename);

        imagecopyresampled($imagemFinal, $imagemOriginal, 0, 0, 0, 0, self::$largura, self::$altura, self::$width, self::$height);

        imagejpeg($imagemFinal, "meumenu.jpg", 100);
    }

}
