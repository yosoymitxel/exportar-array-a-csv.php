<?php

function exportar_array_csv_guardar_csv($fileName,$array,$filePath){
    $result  = false;
    $headers = array_keys($array[0]);

    if (is_array($array)){
        //Crear archivo CSV
        $fd = fopen($filePath.'/'.$fileName.'.csv', 'w');

        if ($fd === false) {
            die("No se ha podido crear el archivo. Revise los permisos en la carpeta. <i>\"$filePath\"</i>");
        }

        //Inserta las cabeceras en el archivo
        if($headers) {
            fputcsv($fd, $headers, ";");
        }

        //Inserta los datos en el archivo
        foreach($array as $filas) {
            fputcsv($fd, $filas, ";");
        }

        //Cierra el archivo
        fclose($fd);

        $result  = true;
    }

    return $result;
}

function exportar_array_csv_descargar_csv($fileName,$array,$delimiter = ";"){
    $fd      = fopen('php://output', 'w');
    $headers = array_keys($array[0]);
  
    if ($fd === false) {
        die("No se ha podido crear el archivo en el servidor. Revise los permisos en la carpeta.");
    }

    header('Content-Type: application/csv');
    header('Content-Disposition: attachment; filename="' . $fileName . '";');

    //Inserta las cabeceras en el archivo
    if ($headers) {
        fputcsv($fd, $headers, $delimiter);
    }

    //Inserta los datos en el archivo
    foreach ($array as $filas) {
        fputcsv($fd, $filas, $delimiter);
    }

    //Cierra el archivo
    fclose($fd);
}
