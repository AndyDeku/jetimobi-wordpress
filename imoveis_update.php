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
        if ($value['updated_at'] != $post->post_date) {
            //echo 'Atualizando post '.$post->ID;
            //contrato e preço
            //Tipo de negócio - compra ou venda

            if (is_null($value['valor_venda'])) {
                $preco_venda = "Consulte";
            } else {
                $preco_venda = number_format($value['valor_venda'], 2, ',', '.');
            }

            if (is_null($value['valor_locacao'])) {
                $preco_locacao = "Consulte";
            } else {
                $preco_venda = number_format($value['valor_locacao'], 2, ',', '.');
            }


            if (is_null($value['valor_temporada'])) {
                $preco_temporada = "Consulte";
            } else {
                $preco_venda = number_format($value['valor_temporada'], 2, ',', '.');
            }

            if ($value['contrato'] == 'Compra') {
                $venda = true;
                $aluguel = false;
                $temporada = false;
            } elseif ($value['contrato'] == 'Locação') {
                $venda = false;
                $aluguel = true;
                $temporada = false;
            } elseif ($value['contrato'] == 'Compra,Locação') {
                $venda = true;
                $aluguel = true;
                $temporada = false;
            } elseif ($value['contrato'] == 'Compra,Temporada') {
                $venda = true;
                $aluguel = false;
                $temporada = true;
            } elseif ($value['contrato'] == 'Locação,Temporada') {
                $venda = false;
                $aluguel = true;
                $temporada = true;
            } elseif ($value['contrato'] == 'Compra,Locação,Temporada') {
                $venda = true;
                $aluguel = true;
                $temporada = true;
            }


            //$contrato = str_replace('Compra', 'Venda', $value['contrato']);

            //$contrato = str_replace('Locação', 'Aluguel', $value['contrato']);



            //tipo de imovel



            if ($value['subtipo'] == "Casa" || $value['subtipo'] == "Prédio") {

                $tipo_imovel = $value['subtipo'] . ' ' . $value['tipo'];

            } elseif ($value['tipo'] == "Terreno" || $value['tipo'] == "Box") {

                $tipo_imovel = $value['tipo'];

            } else {

                $tipo_imovel = $value['subtipo'];

            }






            $update_data = array(

                'ID' => $post->ID,

                //'post_title'  => $titulo,

                //'post_name'       => $slug,

                'post_date' => $value['updated_at'],

                'post_modified' => $value['updated_at'],

                //'post_content'  => $observacoes,

                //'post_author' => 2,



            );

            $atualiza = wp_update_post($update_data, true);

            if (is_wp_error($atualiza)) {

                $errors = $atualiza->get_error_messages();

                foreach ($errors as $error) {

                    echo $error;

                }

            }

            update_post_meta($post->ID, 'codigo', $value['codigo']);



            $bairro = $value['endereco_bairro'] . '-' . $value['endereco_cidade'];

            $bairro_so = $value['endereco_bairro'];

            $bairro_comp = array('name' => 'Centro', 'slug' => 'centro', 'taxonomy' => 'imovel_area');

            $def_estado = wp_update_term('', 'property_state', $value['endereco_estado']);

            $def_cidade = wp_update_term(null, 'property_city', $value['endereco_cidade']);

            $your_term = get_term_by('name', $bairro_so, 'property_area');

            if (false !== $your_term) {

                $def_bairro = wp_update_term($your_term->term_id, 'property_area', $bairro_comp);

            } else {

                $def_bairro = wp_insert_term($value['endereco_bairro'], 'property_area', array('slug' => $bairro_so));

            }

            $get_estado = get_term_by('name', $value['endereco_estado'], 'property_state');

            $get_cidade = get_term_by('name', $value['endereco_cidade'], 'property_city');

            $get_bairro = get_term_by('name', $bairro_so, 'property_area');

            $salva_estado = wp_set_object_terms($post->ID, $value['endereco_estado'], 'property_state');

            $salva_cidade = wp_set_object_terms($post->ID, $value['endereco_cidade'], 'property_city');

            $salva_bairro = wp_set_object_terms($post->ID, $bairro_so, 'property_area');


            // Associa estado (só se encontrou o termo)
            if ($get_bairro && !is_wp_error($get_bairro)) {
                update_option(
                    '_houzez_property_area_' . $get_bairro->term_taxonomy_id,
                    array('parent_country' => 'BR')
                );
            }
            // Associa estado (só se encontrou o termo)
            if ($get_estado && !is_wp_error($get_estado)) {
                update_option(
                    '_houzez_property_state_' . $get_estado->term_taxonomy_id,
                    array('parent_country' => 'BR')
                );
            }
            $descricaocidade = "";
            $img_id = 0;

            if ($value['endereco_cidade'] == "Maceió") {
                $descricaocidade = "Maceió, capital de Alagoas, é um dos destinos mais encantadores do Brasil. Conhecida como o “Caribe Brasileiro”, a cidade reúne praias de águas cristalinas, coqueirais e piscinas naturais que impressionam pela beleza. Além das paisagens, oferece rica cultura, gastronomia saborosa à base de frutos do mar e artesanato típico, como o bordado filé. Com orla estruturada, vida noturna animada e opções que vão do centro histórico às praias vizinhas, Maceió é o lugar ideal para viver momentos inesquecíveis entre natureza, cultura e hospitalidade.";
                $img_id = "https://novo.jarvisimoveis.com.br/wp-content/uploads/2025/09/maceio.jpg";
            } else if ($value['endereco_cidade'] == "Barra de Santo Antônio") {
                $descricaocidade = "Localizada no litoral norte de Alagoas, a Barra de Santo Antônio encanta por suas praias de águas claras, recifes e paisagens preservadas. A mais famosa é a Praia de Carro Quebrado, conhecida por suas falésias coloridas e cenários de tirar o fôlego. Além das belezas naturais, o município mantém viva a cultura local, com festas tradicionais, culinária típica e a hospitalidade de sua gente. Com um ambiente tranquilo e acolhedor, a Barra de Santo Antônio é o destino perfeito para quem busca contato com a natureza e momentos de descanso em meio às maravilhas do litoral alagoano.";
                $img_id = "https://novo.jarvisimoveis.com.br/wp-content/uploads/2025/09/barra-de-santo-antonio.webp";
            } else if ($value['endereco_cidade'] == "Barra de São Miguel") {
                $descricaocidade = "A poucos quilômetros de Maceió, a Barra de São Miguel é um dos destinos mais procurados do litoral sul de Alagoas. Suas praias de águas mornas e cristalinas, protegidas por recifes, formam piscinas naturais ideais para banho e mergulho. Além disso, o município é ponto de partida para passeios inesquecíveis até a Praia do Gunga, famosa por seus coqueirais e falésias coloridas. Com ótima infraestrutura turística, gastronomia regional e clima acolhedor, a Barra de São Miguel é perfeita tanto para descanso quanto para aventuras em meio às paisagens paradisíacas do estado.";
                $img_id = "https://novo.jarvisimoveis.com.br/wp-content/uploads/2025/09/barra-de-sao-miguel.webp";
            } else if ($value['endereco_cidade'] == "Japaratinga") {
                $descricaocidade = "Vizinha de Maragogi, a charmosa Japaratinga conquista com praias tranquilas, piscinas naturais e paisagens preservadas. Suas águas claras e mornas são ideais para mergulho e passeios de jangada, enquanto o clima acolhedor do vilarejo transmite simplicidade e autenticidade. Com belezas naturais, boa gastronomia e uma atmosfera rústica e charmosa, Japaratinga é o destino perfeito para quem busca sossego em meio ao paraíso do litoral alagoano.";
                $img_id = "https://novo.jarvisimoveis.com.br/wp-content/uploads/2025/09/Japaratinga.webp";
            } else if ($value['endereco_cidade'] == "Marechal Deodoro") {
                $descricaocidade = "Primeira capital de Alagoas, Marechal Deodoro reúne patrimônio histórico e belas praias. Suas ruas guardam igrejas e casarões coloniais, enquanto o litoral encanta com a Praia do Francês, uma das mais famosas do estado, além de lagoas e paisagens de rara beleza. Entre cultura, natureza e tradição, Marechal Deodoro é um destino que combina história e lazer em um só lugar.";
                $img_id = "https://novo.jarvisimoveis.com.br/wp-content/uploads/2025/09/Marechal-Deodoro-1.jpg";
            } else if ($value['endereco_cidade'] == "Paripueira") {
                $descricaocidade = "Localizada no litoral norte de Alagoas, Paripueira é famosa por suas piscinas naturais de águas mornas e cristalinas, formadas na maré baixa, ideais para mergulho e observação da vida marinha. Suas praias extensas e tranquilas oferecem um cenário perfeito para descanso, contato com a natureza e passeios de jangada. Com clima acolhedor e beleza preservada, Paripueira é um destino imperdível para quem busca sossego e paisagens encantadoras no litoral alagoano.";
                $img_id = "https://novo.jarvisimoveis.com.br/wp-content/uploads/2025/09/Paripueira-1.jpg";
            } else if ($value['endereco_cidade'] == "Passo de Camaragibe") {
                $descricaocidade = "Às margens da Rota Ecológica, Passo de Camaragibe encanta com suas praias tranquilas, coqueirais e águas cristalinas. O destino é ideal para quem busca contato direto com a natureza, seja em passeios pelas praias quase desertas, mergulhos em piscinas naturais ou trilhas ecológicas. Com atmosfera rústica e acolhedora, o município preserva tradições culturais e oferece uma experiência autêntica em meio às belezas do litoral alagoano.";
                $img_id = "https://novo.jarvisimoveis.com.br/wp-content/uploads/2025/09/Passo-de-Camaragibe.jpeg";
            } else if ($value['endereco_cidade'] == "Porto de Pedras") {
                $descricaocidade = "Localizado na Rota Ecológica, Porto de Pedras é um destino encantador do litoral norte de Alagoas. Suas praias tranquilas, rios e manguezais preservados oferecem cenários únicos para descanso e ecoturismo. O município também é ponto de acesso à famosa Praia do Patacho, uma das mais belas do Brasil. Com atmosfera rústica, gastronomia regional e contato direto com a natureza, Porto de Pedras é perfeito para quem busca tranquilidade e experiências autênticas à beira-mar.";
                $img_id = "https://novo.jarvisimoveis.com.br/wp-content/uploads/2025/09/Porto-de-Pedras.jpg";
            } else if ($value['endereco_cidade'] == "São Miguel dos Milagres") {
                $descricaocidade = "Na deslumbrante Rota Ecológica, São Miguel dos Milagres é um dos destinos mais encantadores do litoral norte de Alagoas. Com praias quase desertas, mar cristalino, piscinas naturais e jangadas coloridas, o vilarejo é perfeito para quem busca tranquilidade e contato com a natureza. Com pousadas charmosas, boa gastronomia e hospitalidade acolhedora, São Miguel dos Milagres oferece um cenário paradisíaco para dias de descanso inesquecíveis.";
                $img_id = "https://novo.jarvisimoveis.com.br/wp-content/uploads/2025/09/Sao-Miguel-dos-Milagres.webp";
            }

            if (!$get_cidade) {
                $created = wp_insert_term($value['endereco_cidade'], 'property_city');

                if (!is_wp_error($created)) {
                    $term_id = $created['term_id'];
                    $tax_id = $created['term_taxonomy_id'];
                    wp_update_term(
                        $term_id,
                        'property_city',
                        array('description' => sanitize_text_field($descricaocidade))
                    );

                    if ($img_id != 0) {
                        update_term_meta($term_id, 'term_image', $img_id);
                    }

                }
            } else {
                $term_id = $get_cidade->term_id;
                $tax_id = $get_cidade->term_taxonomy_id;
            }

            if (!empty($tax_id)) {
                $assoc_cidade = update_option('_houzez_property_city_' . $tax_id, array(
                    'parent_state' => $value['endereco_estado']
                ));
            }
            if ($get_bairro && !is_wp_error($get_bairro)) {
                $assoc_bairro = update_option('_houzez_property_area_' . $get_bairro->term_taxonomy_id, array('parent_city' => $value['endereco_cidade']));
            }
            $query2 = "

            SELECT $wpdb->posts.* 

            FROM $wpdb->posts, $wpdb->postmeta

            WHERE $wpdb->posts.ID = $wpdb->postmeta.post_id 

            AND $wpdb->postmeta.meta_key = 'id_corretor'

            AND $wpdb->posts.post_status = 'publish' 

            AND $wpdb->posts.post_type = 'jetimob_corretor' 

            AND $wpdb->postmeta.meta_value = '" . $value['id_corretor'] . "'            

            ";

            $res_cor = $wpdb->get_results($query2);

            if (!empty($res_cor)) {
                $corretor = $res_cor[0]->ID;
            } else {
                $corretor = null;
            }

            update_post_meta($post->ID, 'fave_agents', $corretor);



            update_post_meta($post->ID, 'venda', $venda);
            update_post_meta($post->ID, 'locacao', $aluguel);
            update_post_meta($post->ID, 'temporada', $temporada);

            update_post_meta($post->ID, 'valor_venda', $preco_venda);
            update_post_meta($post->ID, 'valor_locacao', $preco_locacao);
            update_post_meta($post->ID, 'valor_temporada', $preco_temporada);

            update_post_meta($post->ID, 'valor_venda_visivel', $value['valor_venda_visivel']);

            update_post_meta($post->ID, 'valor_locacao_visivel', $value['valor_locacao_visivel']);

            update_post_meta($post->ID, 'estado', $value['endereco_estado']);

            update_post_meta($post->ID, 'cidade', $value['endereco_cidade']);

            update_post_meta($post->ID, 'bairro', $value['endereco_bairro']);

            update_post_meta($post->ID, 'cep', $value['endereco_cep']);

            update_post_meta($post->ID, 'dormitorios', $value['dormitorios']);

            update_post_meta($post->ID, 'banheiros', $value['banheiros']);

            update_post_meta($post->ID, 'garagens', $value['garagens']);

            update_post_meta($post->ID, 'suites', $value['suites']);

            update_post_meta($post->ID, 'area_util', $value['area_util']);

            update_post_meta($post->ID, 'area_privativa', $value['area_privativa']);

            update_post_meta($post->ID, 'area_total', $value['area_total']);

            update_post_meta($post->ID, 'medida', $value['medida']);

            update_post_meta($post->ID, 'id_condominio', $value['id_condominio']);

            update_post_meta($post->ID, 'id_corretor', $value['id_corretor']);

            if ($value['destaque'] == "Em destaque") {

                update_post_meta($post->ID, 'destaque', 1);

            }

            //visualização no mapa
            $end_mapa = "";
            if ($value['endereco_cidade_visivel'] == false && $value['endereco_estado_visivel']) {
                $end_mapa = $value['endereco_estado'];
            } elseif ($value['endereco_bairro_visivel'] == false && $value['endereco_cidade_visivel'] && $value['endereco_estado_visivel']) {
                $end_mapa = $value['endereco_cidade'] . ', ' . $value['endereco_estado'];
            } elseif ($value['endereco_logradouro_visivel'] == false && $value['endereco_bairro_visivel'] && $value['endereco_cidade_visivel'] && $value['endereco_estado_visivel']) {
                $end_mapa = $value['endereco_bairro'] . ', ' . $value['endereco_cidade'] . ', ' . $value['endereco_estado'];
            } elseif ($value['endereco_complemento_visivel'] == false && $value['endereco_numero_visivel'] == false && $value['endereco_logradouro_visivel'] && $value['endereco_bairro_visivel'] && $value['endereco_cidade_visivel'] && $value['endereco_estado_visivel']) {
                $end_mapa = $value['endereco_logradouro'] . ', ' . $value['endereco_bairro'] . ', ' . $value['endereco_cidade'] . ', ' . $value['endereco_estado'];
                if (!is_null($value['condominio_nome'])) {
                    update_post_meta($post->ID, 'condominio_nome', $value['condominio_nome']);
                }
            } elseif ($value['endereco_complemento_visivel'] == false && $value['andar_visivel'] == false && $value['endereco_numero_visivel'] && $value['endereco_logradouro_visivel'] && $value['endereco_bairro_visivel'] && $value['endereco_cidade_visivel'] && $value['endereco_estado_visivel']) {

                $end_mapa = $value['endereco_logradouro'] . ' ' . $value['endereco_numero'] . ', ' . $value['endereco_bairro'] . ', ' . $value['endereco_cidade'] . ', ' . $value['endereco_estado'];

                if (!is_null($value['condominio_nome'])) {

                    update_post_meta($post->ID, 'condominio_nome', $value['condominio_nome']);

                }

            } elseif ($value['endereco_complemento_visivel'] == false && $value['andar_visivel'] && $value['endereco_numero_visivel'] && $value['endereco_logradouro_visivel'] && $value['endereco_bairro_visivel'] && $value['endereco_cidade_visivel'] && $value['endereco_estado_visivel']) {

                $end_mapa = $value['endereco_logradouro'] . ' ' . $value['endereco_numero'] . ', ' . $value['endereco_bairro'] . ', ' . $value['endereco_cidade'] . ', ' . $value['endereco_estado'];

                if (!is_null($value['condominio_nome'])) {

                    update_post_meta($post->ID, 'condominio_nome', $value['condominio_nome']);

                }

                if (!is_null($value['andar'])) {

                    update_post_meta($post->ID, 'andar', $value['andar']);

                }

            } elseif ($value['endereco_complemento_visivel'] && $value['andar_visivel'] && $value['endereco_complemento_visivel'] && $value['endereco_numero_visivel'] && $value['endereco_logradouro_visivel'] && $value['endereco_bairro_visivel'] && $value['endereco_cidade_visivel'] && $value['endereco_estado_visivel']) {

                $end_mapa = $value['endereco_logradouro'] . ' ' . $value['endereco_numero'] . ', ' . $value['endereco_bairro'] . ', ' . $value['endereco_cidade'] . ', ' . $value['endereco_estado'];

                if (!is_null($value['condominio_nome'])) {

                    update_post_meta($post->ID, 'condominio_nome', $value['condominio_nome']);

                }

                if (!is_null($value['andar'])) {

                    update_post_meta($post->ID, 'andar', $value['andar']);

                }

                if (!is_null($value['endereco_complemento'])) {

                    update_post_meta($post->ID, 'endereco_complemento', $value['endereco_complemento']);
                }
            }


            update_post_meta($post->ID, 'geoposicionamento_visivel', $value['geoposicionamento_visivel']);

            if ($value['geoposicionamento_visivel'] == 1) {

                $calcula = true;

                $latitude = $value['latitude'];

                $longitude = $value['longitude'];

                update_post_meta($post->ID, 'mostrar_streetview', true);

                update_post_meta($post->ID, 'mostrar_mapa', true);
                update_post_meta($post->ID, 'endereco_mapa', $end_mapa);

            } elseif ($value['geoposicionamento_visivel'] == 2) {

                $calcula = true;

                $latitude = $value['latitude'];

                $longitude = $value['longitude'];

                update_post_meta($post->ID, 'mostrar_streetview', 'hide');

                update_post_meta($post->ID, 'mostrar_mapa', true);
                update_post_meta($post->ID, 'endereco_mapa', $end_mapa);

            } else {

                $calcula = false;

                //$latitude = null;

                //$longitude = null;

                update_post_meta($post->ID, 'mostrar_streetview', false);

                update_post_meta($post->ID, 'mostrar_mapa', false);

            }


            update_post_meta($post->ID, 'latitude', $latitude);

            update_post_meta($post->ID, 'longitude', $longitude);

            $latlong = $latitude . "," . $longitude;

            update_post_meta($post->ID, 'geolocalizacao', $latlong);

            $tipomapa = $value['geoposicionamento_visivel'];

            update_post_meta($post->ID, 'tipo_mapa', $tipomapa);

            update_post_meta($post->ID, 'endereco_referencia', $value['endereco_referencia']);
            $endereco_visivel = $value['endereco_complemento_visivel'] || $value['andar_visivel'] || $value['endereco_complemento_visivel'] || $value['endereco_numero_visivel'] || $value['endereco_logradouro_visivel'] || $value['endereco_bairro_visivel'] || $value['endereco_cidade_visivel'] || $value['endereco_estado_visivel'];
            update_post_meta($post->ID, 'endereco_visivel', $endereco_visivel);


            if ($end_mapa != "") {

                update_post_meta($post->ID, 'endereco_complemento', $end_mapa);

            }



            wp_set_object_terms($post->ID, $tipo_imovel, 'tipo_imovel');
            if (count(explode(',', $value['imovel_comodidades'])) > 0 && $value['imovel_comodidades'] != null && $value['imovel_comodidades'] != "")
                wp_set_object_terms($post->ID, explode(',', $value['imovel_comodidades']), 'imovel_comodidades', true);

            if (!is_array($value['condominio_comodidades']) && count(explode(',', $value['condominio_comodidades'])) > 0 && $value['condominio_comodidades'] != null && $value['condominio_comodidades'] != "")
                wp_set_object_terms($post->ID, explode(',', $value['condominio_comodidades']), 'condominio_comodidades', true);
            else if (is_array($value['condominio_comodidades']) && count($value['condominio_comodidades']) > 0)
                wp_set_object_terms($post->ID, $value['condominio_comodidades'], 'condominio_comodidades', true);



            if ($value['status'] == 'Usado') {

                $situacao = null;

            } else {
                $situacao = $value['situacao'];
                //array_push($situacao, $value['situacao']);

                wp_set_object_terms($post->ID, $value['situacao'], 'situacao');
            }

            if ($value['mobiliado'] == 1) {

                //array_push($situacao, 'Mobiliado');
                //$situacao[] = "Mobiliado";
                wp_set_object_terms($post->ID, "Mobiliado", 'situacao', true);

            } elseif ($value['mobiliado'] == 2) {

                //array_push($situacao, 'Semiobiliado');
                wp_set_object_terms($post->ID, "Semimobiliado", 'situacao', true);
                //$situacao[] = "Semimobiliado";

            }

            if ($value['condominio_nome'] != null)
                wp_set_object_terms($post->ID, $value['condominio_nome'], 'condominio_nome');




            $metanull = null;

            if ($value['status'] != 'Usado') {
                $is_novo = 1;
                $novo = $value['status'];
                $tit_novo = 'Situação';
                wp_set_object_terms($post->ID, $value['status'], 'situacao', true);

            }




            /*

             if (!is_null($value['rural_area_aravel'])) {

                $aravel = number_format((float)$value['rural_area_aravel'], 2, '.', '').' '.$value['medida'];

                $tit_aravel = 'Área Arável';

                $is_aravel = 1;

            }
            */

            update_post_meta($post->ID, 'condominio', $value['valor_condominio']);
            update_post_meta($post->ID, 'condominio_visivel', $value['valor_condominio_visivel']);





            if ($value['valor_iptu_visivel'] == "1") {

                $iptu = 'R$ ' . $value['valor_iptu'];

                $tit_iptu = 'IPTU';

                $is_iptu = 1;



            }
            update_post_meta($post->ID, 'iptu', $value['valor_iptu']);
            update_post_meta($post->ID, 'iptu_visivel', $value['valor_iptu_visivel']);


            if ($value['mobiliado'] == 0 || !is_null($value['mobiliado'])) {

                $tit_mobiliado = null;

                $mobiliado = null;

            } elseif ($value['mobiliado'] != 0) {

                $is_mob = 1;

                $tit_mobiliado = 'Mobiliado';

                if ($value['mobiliado'] == 1) {

                    $mobiliado = 'Sim';

                } elseif ($value['mobiliado'] == 2) {

                    $mobiliado = 'Semimobiliado';

                }

            }

            $value['mobiliado'] = $mobiliado;

            if ($value['financiavel'] == 1) {

                $financiavel = "Sim";
                $tit_financiavel = 'Financiável';
                $is_financiavel = 1;
                wp_set_object_terms($post->ID, 'Financiável', 'financiamento');

            } elseif ($value['financiavel'] == 2) {
                $tit_financiavel = 'Financiável';
                $financiavel = 'Minha Casa Minha Vida';
                $is_financiavel = 1;
                wp_set_object_terms($post->ID, 'Minha Casa Minha Vida', 'financiamento');
                $rotulos[] = "Minha Casa Minha Vida";

            }



            if (!is_null($value['distancia_mar'])) {

                $mar = $value['distancia_mar'];

                $tit_mar = 'Distância do mar';

                $is_mar = 1;

            }

            if (!is_null($value['posicao'])) {

                $posicao = $value['posicao'];

                $tit_posicao = 'Posição';

                $is_posicao = 1;

            }

            if (!is_null($value['posicao_solar'])) {

                $posicao_solar = $value['posicao_solar'];

                $tit_posicao_solar = 'Posição Solar';

                $is_posicao_solar = 1;

            }

            if (!is_null($value['tipo_piso'])) {

                $piso = $value['tipo_piso'];

                $tit_piso = 'Piso';

                $is_piso = 1;

            }




            if ($value['exclusividade'] == 1) {

                $exclusivo = 'Sim';

                $tit_exclusivo = 'Exclusividade';

                $is_exclusivo = 1;

                $rotulos[] = $tit_exclusivo;

            } elseif ($value['exclusividade'] != 1) {

                $exclusivo = '';

                $tit_exclusivo = '';

            }



            if ($value['condominio_fechado'] == 1) {

                $cfechado = 'Sim';

                $tit_cfechado = 'Cond. Fechado';

                $is_cfechado = 1;



            } elseif ($value['condominio_fechado'] != 1) {

                $cfechado = '';

                $tit_cfechado = '';

            }

            if (!is_null($value['entrega_ano']) && !is_null($value['entrega_mes'])) {

                $entrega = $value['entrega_mes'] . '/' . $value['entrega_ano'];

                $is_entrega = 1;

                $tit_entrega = "Entrega";

            }

            //else { $tit_entrega = null; }



            /*if (!is_null($value['situacao'])) {

                $is_situacao = 1;

            }*/



            if (!is_null($value['tipo_construcao'])) {

                $is_construcao = 1;

            }
            $largura = "";
            if (!is_null($value['terreno_largura'])) {

                $is_largura = 1;
                $largura = $value['terreno_largura'];
                $tit_largura = 'Largura do terreno';

            }

            $comprimento = "";
            if (!is_null($value['terreno_comprimento'])) {

                $is_comprimento = 1;
                $comprimento = $value['terreno_comprimento'];
                $tit_comprimento = 'Comprimento do terreno';

            }







            update_post_meta($post->ID, 'caracteristicas', null);
            $t = update_post_meta(
                $post->ID,
                'caracteristicas',
                array(

                    isset($is_novo) ? array('caracteristica_titulo' => $tit_novo, 'caracteristica_valor' => $novo) : $metanull,

                    isset($is_entrega) ? array('caracteristica_titulo' => $tit_entrega, 'caracteristica_valor' => $entrega) : $metanull,

                    isset($is_areaprivativa) ? array('caracteristica_titulo' => $tit_areaprivativa, 'caracteristica_valor' => $areaprivativa) : $metanull,

                    isset($is_areatotal) ? array('caracteristica_titulo' => $tit_areatotal, 'caracteristica_valor' => $areatotal) : $metanull,

                    isset($is_largura) ? array('caracteristica_titulo' => $tit_largura, 'caracteristica_valor' => $largura) : $metanull,

                    isset($is_comprimento) ? array('caracteristica_titulo' => $tit_comprimento, 'caracteristica_valor' => $comprimento) : $metanull,

                    isset($is_construcao) ? array('caracteristica_titulo' => 'Tipo de Construção', 'caracteristica_valor' => $value['tipo_construcao']) : $metanull,

                    isset($is_aravel) ? array('caracteristica_titulo' => $tit_aravel, 'caracteristica_valor' => $aravel) : $metanull,

                    isset($is_mar) ? array('caracteristica_titulo' => $tit_mar, 'caracteristica_valor' => $mar) : $metanull,

                    isset($is_posicao) ? array('caracteristica_titulo' => $tit_posicao, 'caracteristica_valor' => $posicao) : $metanull,

                    isset($is_posicao_solar) ? array('caracteristica_titulo' => $tit_posicao_solar, 'caracteristica_valor' => $posicao_solar) : $metanull,

                    isset($is_piso) ? array('caracteristica_titulo' => $tit_piso, 'caracteristica_valor' => $piso) : $metanull,

                    isset($is_condominio) ? array('caracteristica_titulo' => $tit_condominio, 'caracteristica_valor' => $condominio) : $metanull,

                    isset($is_iptu) ? array('caracteristica_titulo' => $tit_iptu, 'caracteristica_valor' => $iptu) : $metanull,

                    isset($is_mob) ? array('caracteristica_titulo' => $tit_mobiliado, 'caracteristica_valor' => $mobiliado) : $metanull,

                    isset($is_financiavel) ? array('caracteristica_titulo' => $tit_financiavel, 'caracteristica_valor' => $financiavel) : $metanull,

                    isset($is_exclusivo) ? array('caracteristica_titulo' => $tit_exclusivo, 'caracteristica_valor' => $exclusivo) : $metanull,

                    isset($is_cfechado) ? array('caracteristica_titulo' => $tit_cfechado, 'caracteristica_valor' => $cfechado) : $metanull,

                )

            );



            delete_post_meta($post->ID, 'galeria_imagens', '');

            delete_post_meta($post->ID, 'slider', '');

            delete_post_meta($post->ID, 'imagem_slider', '');



            $imagens = $value['imagens'];
            $galeria = [];
            if (!is_null($imagens) && count($imagens) > 0 && is_array($imagens)) {
                foreach ($imagens as $ind => $imagem) {
                    add_post_meta($post->ID, 'galeria_imagens', $imagem['link']);
                }

                $ibagens = $value['imagens'][0]['link'];

                add_post_meta($post->ID, 'slider', 'yes');

                add_post_meta($post->ID, 'imagem_slider', $ibagens);

                add_post_meta($post->ID, 'fifu_image_url', $ibagens);
            }





            delete_post_meta($post->ID, 'fave_floor_plans_enable', '');

            delete_post_meta($post->ID, 'floor_plans', '');

            $plantas = $value['plantas'];

            if (!is_null($plantas) && count($plantas) > 0 && is_array($plantas)) {

                foreach ($plantas as $key => $planta) {

                    if (is_null($planta['titulo'])) {
                        $planta['titulo'] = "Planta";
                    }

                    $addplanta[] = array('fave_plan_title' => $planta['titulo'], 'fave_plan_image' => $planta['link']);



                }

                add_post_meta($post->ID, 'fave_floor_plans_enable', 'enable');

                add_post_meta($post->ID, 'floor_plans', $addplanta);

            } else {

                add_post_meta($post->ID, 'fave_floor_plans_enable', 'disable');
            }



            delete_post_meta($post->ID, 'tour_virtual', '');



            if (!is_null($value['tour360'])) {
                if (is_array($value['tour360']) && isset($value['tour360'][0])) {
                    add_post_meta($post->ID, 'tour_virtual', $value['tour360'][0]);
                    add_post_meta($post->ID, 'tour_virtual_enable', '1');
                } else {

                    add_post_meta($post->ID, 'tour_virtual_enable', '0');
                }
            } else {

                add_post_meta($post->ID, 'tour_virtual_enable', '0');
            }



            delete_post_meta($post->ID, 'video', '');
            if (!is_null($value['videos'])) {
                if (is_array($value['videos']) && isset($value['videos'][0])) {
                    add_post_meta($post->ID, 'video', $value['videos'][0]['link']);
                    unset($verifica_video);
                    add_post_meta($post->ID, 'video_enable', '1');
                } else {
                    add_post_meta($post->ID, 'video_enable', '0');
                }
            } else {
                add_post_meta($post->ID, 'video_enable', '0');
            }

            //wp_set_object_terms($post->ID, $rotulos, 'property_label');        


            //unset(var);

            unset($patterns);

            unset($replacements);

            unset($verifica_tour);

            unset($ibagens);

            unset($res_cor);

            unset($corretor);

            unset($rotulos);

            unset($plantas);

            unset($addplanta);

            unset($t);

            unset($is_novo);

            unset($tit_novo);

            unset($novo);

            unset($tit_construcao);

            unset($tit_situacao);

            unset($tit_areaprivativa);

            unset($tit_areatotal);

            unset($tit_aravel);

            unset($tit_mar);

            unset($tit_posicao);

            unset($tit_posicao_solar);

            unset($tit_piso);

            unset($tit_condominio);

            unset($tit_iptu);

            unset($tit_mob);

            unset($tit_financiavel);

            unset($tit_exclusivo);

            unset($tit_cfechado);

            unset($tit_entrega);

            unset($construcao);

            unset($situacao);

            unset($areaprivativa);

            unset($areatotal);

            unset($aravel);

            unset($img_id);

            unset($descricaocidade);

            unset($mar);

            unset($posicao);

            unset($posicao_solar);

            unset($piso);

            unset($condominio);

            unset($iptu);

            unset($mob);

            unset($financiavel);

            unset($exclusivo);

            unset($cfechado);

            unset($entrega);

            unset($is_construcao);

            unset($is_situacao);

            unset($is_areaprivativa);

            unset($is_areatotal);

            unset($is_aravel);

            unset($is_mar);

            unset($is_posicao);

            unset($is_posicao_solar);

            unset($is_piso);

            unset($is_condominio);

            unset($is_iptu);

            unset($is_mob);

            unset($is_financiavel);

            unset($is_exclusivo);

            unset($is_cfechado);

            unset($is_entrega);

            unset($end_mapa);

            unset($imovel_destacado);

            unset($contrato);

            unset($tipo_imovel);

            unset($rotulos);

            unset($cfechado);

            unset($mobiliado);

            unset($condominio);

            unset($iptu);

            unset($posicao);

            unset($posicao_solar);

            unset($galeria);

            unset($exclusivo);

            unset($mar);

            unset($aravel);

            unset($areatotal);

            unset($areaprivativa);

            unset($bairro);

            unset($preco_apos);

            unset($valor_locacao);

            unset($valor_venda);

            //unset($observacoes);

            //unset($slug);

            //unset($titulo);

            unset($set_bairro);

            unset($latlong);

            unset($tipomapa);

            unset($largura);

            unset($comprimento);

            //unset($post->ID);
            $date = date('d/m/Y h:i:s a', time());
            echo $date . ' - post atualizado - ' . $post->ID . ' - Código:' . $value['codigo'];
            echo PHP_EOL;

            echo "<br>";
            unset($date);
        } else {
            echo 'OK - ' . $post->ID;
            echo PHP_EOL;
        }

    }
}
?>