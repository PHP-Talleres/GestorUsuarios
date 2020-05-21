<?php

    function SpanishDate($FechaStamp)
    {
        $ano = date('Y',$FechaStamp);
        $mes = date('n',$FechaStamp);
        $dia = date('d',$FechaStamp);
        $diasemana = date('w',$FechaStamp);
        $diassemanaN= array("Domingo","Lunes","Martes","Miércoles",
        "Jueves","Viernes","Sábado");
        $mesesN=array(1=>"Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio",
        "Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        return $diassemanaN[$diasemana].", $dia de ". $mesesN[$mes] ." de $ano ";
    }

    function  crear_imagen()
    {
        $im = imagecreate(400, 400) or die("Error en la creacion de imagenes");
        $R = rand(0,255);
        $G = rand(0,255);
        $B = rand(0,255);
        $color_fondo = imagecolorallocate($im, $R, $G, $B);
        $cantidadRectangulos = rand(0,10);
        for ($i=0; $i < $cantidadRectangulos; $i++) {
            $R = rand(0, 255);
            $G = rand(0, 255);
            $B = rand(0, 255);
            $x1 = rand(0,380);
            $y1 = rand(0, 380);
            $x2 = rand(10, 400);
            $y2 = rand(10, 400);
            imagefilledrectangle($im,   $x1,  $y1, $x2, $y2,  imagecolorallocate($im,$R,$G,$B)); //rectangulo (lleno)
        }
        $cantidadelipses = rand(0, 2);
        for ($i=0; $i < $cantidadelipses; $i++) {
            $R = rand(0, 255);
            $G = rand(0, 255);
            $B = rand(0, 255);
            $cx = rand(0, 380);
            $cy = rand(0, 380);
            $width = rand(10, 100);
            $height = rand(10, 200);
            imagefilledellipse($im, $cx, $cy, $width, $height, imagecolorallocate($im, $R, $G, $B));
        }
        imagepng($im, "images/imagen.png");
        imagedestroy($im);
    }

?>