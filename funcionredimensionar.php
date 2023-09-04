    <?php
        function redimensionarImg($imagen, $medida_final){
                //1. Obtener atributos de la imagen
                list($ancho_orig, $alto_orig, $nrotipo) = getimagesize($imagen);
                //2. Crear una variable de imagen segun el tipo
            switch($nrotipo){
                case 2: $img_orig = imagecreatefromjpeg($imagen);
                    break;
                case 3: $img_orig = imagecreatefrompng($imagen);
                    break;
            }
            //3. Calcular la dimension faltante
                if($ancho_orig < $alto_orig){
                    $aspecto = $ancho_orig/$alto_orig;
                    $alto_final = $medida_final / $aspecto;
            
                }else{
                    $aspecto = $ancho_orig/$alto_orig;
                    $ancho_final = $medida_final * $aspecto;
                }
            
            //4. Creamos el lienzo blanco para la nueva imagen
                $nueva_img = imageCreateTruecolor($ancho_final, $medida_final);
            //5. Copiamos la imagen original en el lienzo blanco
                imagecopyresampled($nueva_img, $img_orig,0,0,0,0,$ancho_final, $medida_final, $ancho_orig, $alto_orig);
                
            //6. Se destruye la imagen original para liberar memoria
                imagedestroy($img_orig);
            //7. Calidad de la imagen
                $calidad = 70;
            //8. Nombre de archivo final
                $nombre_img = time().'-'.$imagen;
            // 9. Guardamos la neuva imagen en la carpeta imagenes 
                imagejpeg($nueva_img, "imagenes/".$nombre_img, $calidad);
            // 10. Retorno el nombre de la nueva imagen
                return $nombre_img;
        }
     
    ?>
