<?php

/*
 Cosas por hacer:
 1) Hacer que en el punto 1 se cojan los datos necesarios del json y procesarlos
 2) Procesar los datos del punto 3, de modo que se devuelva el formato que se pide
 3) Todo el punto 3
 */

echo "-- MENU --\n";
echo "1. Informacion de Streamer\n";
echo "2. Consultar Streams en Vivo\n";
echo "3. Consultar Streams mas Enriquecidos\n";
echo "Elige una opción: ";

$opcion_menu = trim(fgets(STDIN));

switch($opcion_menu){
    case "1":
        echo "Introduzca el ID del Streamer:";
        $id_usuario = trim(fgets(STDIN));

        $url = "https://api.twitch.tv/helix/users?id=" . $id_usuario;
        // Configurar los encabezados
        $headers = [
            "Authorization: Bearer 09pmsrc1ov1mkg0ajinfnd5ty585j0",
            "Client-Id: 3kvc11lm0hiyfqxs32i127986wbep6"
        ];

        // Inicializar cURL
        $ch = curl_init();

        // Configurar opciones de cURL
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // Ejecutar la solicitud
        $response = curl_exec($ch);

        // Obtener el código de estado HTTP
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        // Verificar el código de estado
        if ($httpCode == 200) {
            echo "✅ Respuesta exitosa (200 OK)\n";
            //Procesamos el JSON
            /*$data = json_decode($response, true);
            $id = $data["id"];
            $login = $data["user_login"];
            $username = $data["user_name"];
            $type = $data["type"];
            //$broadcaster_type = $data[""];
            $description = $data["title"];
            $profile_image_url = $data[""];
            $offline_image_url = $data[""];
            $view_count = $data["viewer_count"];
            $created_at = $data["started_at"];
*/
        } else {
            echo "⚠️ Código de error: $httpCode\n";
        }

        echo "Codigo de peticion: " . $httpCode;
        break;
    case "2":
        $url = "https://api.twitch.tv/helix/streams";
        // Configurar los encabezados
        $headers = [
            "Authorization: Bearer 09pmsrc1ov1mkg0ajinfnd5ty585j0",
            "Client-Id: 3kvc11lm0hiyfqxs32i127986wbep6"
        ];

        // Inicializar cURL
        $ch = curl_init();

        // Configurar opciones de cURL
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // Ejecutar la solicitud
        $response = curl_exec($ch);

        // Obtener el código de estado HTTP
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        // Verificar el código de estado
        if ($httpCode == 200) {
            echo "✅ Respuesta exitosa (200 OK)\n";
            //Procesamos el JSON
            $data = json_decode($response, true);
            foreach ($data[""] as $stream) {            //Falta encontrar ahi que elemento es en el $data["XXX"]
                $username = $stream["user_name"];
                $title = $stream["title"];
            }

        } else {
            echo "⚠️ Código de error: $httpCode\n";
        }

        break;
    case "3":
        echo "Introduzca el limite de streams:";
        $limite_streams = trim(fgets(STDIN));
        //Obtener la informacion de los streams (viene ordenada por num de espectadores)
        $url = "https://api.twitch.tv/helix/streams";
        // Configurar los encabezados
        $headers = [
            "Authorization: Bearer 09pmsrc1ov1mkg0ajinfnd5ty585j0",
            "Client-Id: 3kvc11lm0hiyfqxs32i127986wbep6"
        ];

        // Inicializar cURL
        $ch = curl_init();

        // Configurar opciones de cURL
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // Ejecutar la solicitud
        $response = curl_exec($ch);

        // Obtener el código de estado HTTP
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        // Verificar el código de estado
        if ($httpCode == 200) {
            echo "✅ Respuesta exitosa (200 OK)\n";

        } else {
            echo "⚠️ Código de error: $httpCode\n";
        }

        //Buscar la informacion de los streamers de la lista con su user_id
        //Mezclar informacion para reenviarla
        break;
}

// Cerrar la conexión cURL
curl_close($ch);
?>
