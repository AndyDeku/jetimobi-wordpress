<?php

date_default_timezone_set('America/Sao_Paulo');
(string) $caminho = dirname(__FILE__);
require_once($caminho . '/../../../wp-blog-header.php');
$jetimob_options = get_option('jetimob_option_name');
global $user_ID, $wpdb;

function Generate_Featured_Image($image_url, $post_id)
{
    $upload_dir = wp_upload_dir();
    $image_data = file_get_contents($image_url);
    $filename = basename($image_url);
    if (wp_mkdir_p($upload_dir['path']))
        $file = $upload_dir['path'] . '/' . $filename;
    else
        $file = $upload_dir['basedir'] . '/' . $filename;
    file_put_contents($file, $image_data);
    $wp_filetype = wp_check_filetype($filename, null);
    $attachment = array(
        'post_mime_type' => $wp_filetype['type'],
        'post_title' => sanitize_file_name($filename),
        'post_content' => '',
        'post_status' => 'inherit'
    );
    $attach_id = wp_insert_attachment($attachment, $file, $post_id);
    require_once(ABSPATH . 'wp-admin/includes/image.php');
    $attach_data = wp_generate_attachment_metadata($attach_id, $file);
    $res1 = wp_update_attachment_metadata($attach_id, $attach_data);
    $res2 = set_post_thumbnail($post_id, $attach_id);
}

$headers = array('http' => array('method' => 'GET', 'header' => 'Content: type=application/json, charset:utf-8'));
$context = stream_context_create($headers);
$arquivo = $caminho . '/jetimob.json';
$str = file_get_contents($arquivo, FILE_USE_INCLUDE_PATH, $context);
//$str1=utf8_encode($str);
$str1 = json_decode($str, true);

/*

Caso queira utilizar as funções da versão anterior do plugin, comente a partir da linha contendo "foreach" até o último "}" antes do fechamento da tag PHP "?>".

Também descomente a linha abaixo correspondente ao tema utilizado: Houzez ou Realia.
Será necessário refazer essa configuração após cada atualização do plugin, pelo menos por enquanto.
É recomendado que utilize as funções do plugin ao invés de funções de tema.
Não será fornecido suporte para integrações com temas específicos.
*/

//REALIA
//include('themes/Realia/imoveis_update.php');

//HOUZEZ
//include('themes/Houzez/imoveis_update.php');

foreach ($str1 as $key => $value) {
    $check = get_posts(array(
        'post_type' => 'imovel',
        'post_status' => 'publish',
        'meta_query' => array(
            array(
                'key' => 'codigo',
                'value' => $value['codigo'],
                'compare' => '='
            )
        ),
    ));

    foreach ($check as $post) {

        delete_post_meta($post->ID, 'slider', '');

        delete_post_meta($post->ID, 'imagem_slider', '');



        $imagens = $value['imagens'];
        $ibagens = "";
        if (!is_null($imagens) && count($imagens) > 0 && is_array($imagens)) {

            $ibagens = $value['imagens'][0]['link'];

            $galeria = [];

            add_post_meta($post->ID, 'slider', 'yes');

            add_post_meta($post->ID, 'imagem_slider', $ibagens);

            add_post_meta($post->ID, 'fifu_image_url', $ibagens);

            $thumbnail_id = get_post_thumbnail_id($post->ID);
            $current_thumb_url = $thumbnail_id ? wp_get_attachment_url($thumbnail_id) : '';

            if ($ibagens && $ibagens !== $current_thumb_url) {
                // só atualiza se a imagem for diferente
                update_post_meta($post->ID, '_thumbnail_id', '-1');
                Generate_Featured_Image($ibagens, $post->ID);
                sleep(1);
            }
            echo $ibagens;
            echo "<br>";

        }
        unset($ibagens);
        unset($imagens);
    }
}