<?php
get_header();
$tax_query = array('relation' => 'AND');
$meta_query = array('relation' => 'AND');

// -------------------------
// TAXONOMIAS
// -------------------------
$tipo_imovel = get_query_var('tipo_imovel'); // /tipo_imovel/apartamento
if (!empty($tipo_imovel)) {
    $tax_query[] = array(
        'taxonomy' => 'tipo_imovel',
        'field' => 'slug',
        'terms' => (array) sanitize_text_field($tipo_imovel),
    );
}

$area = get_query_var('area'); // /area/luxo
if (!empty($area)) {
    $tax_query[] = array(
        'taxonomy' => 'area',
        'field' => 'slug',
        'terms' => (array) sanitize_text_field($area),
        'include_children' => true,
    );
}

$cidade = get_query_var('cidade'); // /cidade/sp

if (!empty($cidade)) {
    $tax_query[] = array(
        'taxonomy' => 'cidade',
        'field' => 'slug',
        'terms' => (array) sanitize_text_field($cidade),
        'include_children' => true,
    );
}

$estado = get_query_var('estado'); // /estado/rs
if (!empty($estado)) {
    $tax_query[] = array(
        'taxonomy' => 'estado',
        'field' => 'slug',
        'terms' => (array) sanitize_text_field($estado),
        'include_children' => true,
    );
}

$comodidade_imovel = get_query_var('imovel_comodidades'); // /imovel_comodidades/elevador
if (!empty($comodidade_imovel)) {
    $tax_query[] = array(
        'taxonomy' => 'imovel_comodidades',
        'field' => 'slug',
        'terms' => (array) sanitize_text_field($comodidade_imovel),
        'operator' => 'AND',
    );
}

$comodidade_condominio = get_query_var('condominio_comodidades'); // /condominio_comodidades/piscina
if (!empty($comodidade_condominio)) {
    $tax_query[] = array(
        'taxonomy' => 'condominio_comodidades',
        'field' => 'slug',
        'terms' => (array) sanitize_text_field($comodidade_condominio),
        'operator' => 'AND',
    );
}

// -------------------------
// META QUERIES
// -------------------------
$dormitorios = get_query_var('dormitorios'); // /dormitorios/3
if (!empty($dormitorios)) {
    $meta_query[] = array(
        'key' => 'dormitorios',
        'value' => absint($dormitorios),
        'compare' => '=',
        'type' => 'NUMERIC',
    );
}

$suites = get_query_var('suites'); // /suites/2
if (!empty($suites)) {
    if ($suites === '0' || $suites === 0) {
        // Se for exatamente 0 -> busca imóveis sem suítes (0, null ou vazio)
        $meta_query[] = array(
            'relation' => 'OR',
            array(
                'key' => 'suites',
                'value' => 0,
                'compare' => '=',
                'type' => 'NUMERIC',
            ),
            array(
                'key' => 'suites',
                'value' => '',
                'compare' => '=',
            ),
            array(
                'key' => 'suites',
                'compare' => 'NOT EXISTS',
            ),
        );
    } elseif ($suites !== '') {
        // Se for diferente de vazio/null, compara normalmente
        $meta_query[] = array(
            'key' => 'suites',
            'value' => absint($suites),
            'compare' => '=',
            'type' => 'NUMERIC',
        );
    }
}

$banheiros = get_query_var('banheiros'); // /banheiros/2
if (!empty($banheiros)) {
    $meta_query[] = array(
        'key' => 'banheiros',
        'value' => absint($banheiros),
        'compare' => '=',
        'type' => 'NUMERIC',
    );
}

$garagens = get_query_var('garagens'); // /vagas/1
if (!empty($garagens) && !empty($garagens)) {
    if ($garagens === '0' || $garagens === 0) {
        // Se for exatamente 0 -> busca imóveis sem garagem (0, null ou vazio)
        $meta_query[] = array(
            'relation' => 'OR',
            array(
                'key' => 'garagens',
                'value' => 0,
                'compare' => '=',
                'type' => 'NUMERIC',
            ),
            array(
                'key' => 'garagens',
                'value' => '',
                'compare' => '=',
            ),
            array(
                'key' => 'garagens',
                'compare' => 'NOT EXISTS', // trata quando não tem meta cadastrada
            ),
        );
    } elseif ($garagens !== '') {
        // Se for diferente de vazio/null, compara normalmente
        $meta_query[] = array(
            'key' => 'garagens',
            'value' => absint($garagens),
            'compare' => '=',
            'type' => 'NUMERIC',
        );
    }
}


$valor_min = get_query_var('valor_min'); // /valor_min/100000
$valor_max = get_query_var('valor_max'); // /valor_max/500000
if (!empty($valor_min) && !empty($valor_max)) {
    $meta_query[] = array(
        'key' => 'valor_venda',
        'value' => array(absint($valor_min), absint($valor_max)),
        'compare' => 'BETWEEN',
        'type' => 'NUMERIC',
    );
}
// -------------------------
// ARGS POR REQUESTS
// -------------------------
if (!empty($_REQUEST['tipo_imovel'])) {
    $tax_query[] = array(
        'taxonomy' => 'tipo_imovel',
        'field' => 'slug',
        'terms' => (array) sanitize_text_field($_REQUEST['tipo_imovel']),
    );
}

if (!empty($_REQUEST['area'])) {
    $tax_query[] = array(
        'taxonomy' => 'area',
        'field' => 'slug',
        'terms' => (array) sanitize_text_field($_REQUEST['area']),
        'include_children' => true,
    );
}

if (!empty($_REQUEST['cidade'])) {
    $tax_query[] = array(
        'taxonomy' => 'cidade',
        'field' => 'slug',
        'terms' => (array) sanitize_text_field($_REQUEST['cidade']),
        'include_children' => true,
    );
}

if (!empty($_REQUEST['estado'])) {
    $tax_query[] = array(
        'taxonomy' => 'estado',
        'field' => 'slug',
        'terms' => (array) sanitize_text_field($_REQUEST['estado']),
        'include_children' => true,
    );
}

if (!empty($_REQUEST['comodidade_imovel'])) {
    $tax_query[] = array(
        'taxonomy' => 'comodidade_imovel',
        'field' => 'slug',
        'terms' => array_map('sanitize_text_field', (array) $_REQUEST['comodidade_imovel']),
        'operator' => 'AND',
    );
}

if (!empty($_REQUEST['comodidade_condominio'])) {
    $tax_query[] = array(
        'taxonomy' => 'comodidade_condominio',
        'field' => 'slug',
        'terms' => array_map('sanitize_text_field', (array) $_REQUEST['comodidade_condominio']),
        'operator' => 'AND',
    );
}

// -------------------------
// META QUERIES
// -------------------------
if (!empty($_REQUEST['dormitorios'])) {
    $meta_query[] = array(
        'key' => 'dormitorios',
        'value' => absint($_REQUEST['dormitorios']),
        'compare' => '=',
        'type' => 'NUMERIC',
    );
}

if (!empty($_REQUEST['suites'])) {
    $suites = trim($_REQUEST['suites']);
    if ($suites === '0' || $suites === 0) {
        // Se for exatamente 0 -> busca imóveis sem suítes (0, null ou vazio)
        $meta_query[] = array(
            'relation' => 'OR',
            array(
                'key' => 'suites',
                'value' => 0,
                'compare' => '=',
                'type' => 'NUMERIC',
            ),
            array(
                'key' => 'suites',
                'value' => '',
                'compare' => '=',
            ),
            array(
                'key' => 'suites',
                'compare' => 'NOT EXISTS',
            ),
        );
    } elseif ($suites !== '') {
        // Se for diferente de vazio/null, compara normalmente
        $meta_query[] = array(
            'key' => 'suites',
            'value' => absint($suites),
            'compare' => '=',
            'type' => 'NUMERIC',
        );
    }
}

if (!empty($_REQUEST['banheiros'])) {
    $meta_query[] = array(
        'key' => 'banheiros',
        'value' => absint($_REQUEST['banheiros']),
        'compare' => '=',
        'type' => 'NUMERIC',
    );
}

if (isset($_REQUEST['garagens'])) {
    $garagens = trim($_REQUEST['garagens']);

    if ($garagens === '0' || $garagens === 0) {
        // Se for exatamente 0 -> busca imóveis sem garagem (0, null ou vazio)
        $meta_query[] = array(
            'relation' => 'OR',
            array(
                'key' => 'garagens',
                'value' => 0,
                'compare' => '=',
                'type' => 'NUMERIC',
            ),
            array(
                'key' => 'garagens',
                'value' => '',
                'compare' => '=',
            ),
            array(
                'key' => 'garagens',
                'compare' => 'NOT EXISTS', // trata quando não tem meta cadastrada
            ),
        );
    } elseif ($garagens !== '') {
        // Se for diferente de vazio/null, compara normalmente
        $meta_query[] = array(
            'key' => 'garagens',
            'value' => absint($garagens),
            'compare' => '=',
            'type' => 'NUMERIC',
        );
    }
}


if (!empty($_REQUEST['valor_min']) && !empty($_REQUEST['valor_max'])) {
    $meta_query[] = array(
        'key' => 'valor',
        'value' => array(absint($_REQUEST['valor_min']), absint($_REQUEST['valor_max'])),
        'compare' => 'BETWEEN',
        'type' => 'NUMERIC',
    );
}
// -------------------------
// ARGS DA QUERY
// -------------------------

$args = array(
    'post_type' => array('imovel'),
    'post_status' => array('published'),
    'nopaging' => false,
    'posts_per_page' => '28',
    'order' => 'DESC',
    'orderby' => 'id',
);
// Só adiciona se tiver algo
if (count($tax_query) > 1) {
    $args['tax_query'] = $tax_query;
}
if (count($meta_query) > 1) {
    $args['meta_query'] = $meta_query;
}
function create_taxonomy_select($taxonomy, $name, $placeholder = 'Selecione', $multiple = false)
{
    $terms = get_terms([
        'taxonomy' => $taxonomy,
        'hide_empty' => true,
    ]);

    // se for múltiplo, adiciona []
    $select_name = $multiple ? $name . '[]' : $name;

    // pega valor do filtro (prioridade: $_REQUEST > query_var)
    $selected_value = null;
    if (isset($_REQUEST[$name])) {
        $selected_value = $_REQUEST[$name];
    } elseif (get_query_var($name)) {
        $selected_value = get_query_var($name);
    }

    echo '<select name="' . esc_attr($select_name) . '"' . ($multiple ? ' multiple' : '') . '>';
    echo '<option value="">' . esc_html($placeholder) . '</option>';

    foreach ($terms as $term) {
        $selected = '';

        if ($multiple && is_array($selected_value) && in_array($term->slug, $selected_value)) {
            $selected = ' selected';
        } elseif (!$multiple && $selected_value === $term->slug) {
            $selected = ' selected';
        }

        echo '<option value="' . esc_attr($term->slug) . '"' . $selected . '>' . esc_html($term->name) . '</option>';
    }

    echo '</select>';
}


function create_taxonomy_checkboxes($taxonomy, $name)
{
    $terms = get_terms([
        'taxonomy' => $taxonomy,
        'hide_empty' => true,
    ]);

    foreach ($terms as $term) {
        $checked = '';
        if (isset($_GET[$name]) && is_array($_GET[$name]) && in_array($term->slug, $_GET[$name])) {
            $checked = ' checked';
        }

        echo '<label style="display:block; margin-bottom:4px;">';
        echo '<input type="checkbox" name="' . esc_attr($name) . '[]" value="' . esc_attr($term->slug) . '"' . $checked . '> ';
        echo esc_html($term->name);
        echo '</label>';
    }
}


function create_meta_select($key, $name, $options, $placeholder = 'Selecione')
{
    echo '<select name="' . esc_attr($name) . '">';
    echo '<option value="">' . esc_html($placeholder) . '</option>';
    foreach ($options as $value) {
        $selected = (isset($_GET[$name]) && $_GET[$name] == $value) ? ' selected' : '';
        echo '<option value="' . esc_attr($value) . '"' . $selected . '>' . esc_html($value) . '</option>';
    }
    echo '</select>';
}
$dormitorios_options = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
$suites_options = [1, 2, 3, 4, 5];
$banheiros_options = [1, 2, 3, 4, 5];
$vagas_options = [1, 2, 3, 4, 5];
// The Query
$query = new WP_Query($args);

?>
<style>
    main,
    main>.fusion-row {
        max-width: 100% !important;
        width: 100% !important;
    }

    .pagination .nav-links {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
    }

    .page-numbers {
        align-items: center;
        justify-content: center;
        display: flex;
        width: 30px;
        height: 30px;
        margin-left: calc((30px) / 10);
        margin-right: calc((30px) / 10);
    }

    .prev,
    .next {
        width: 100px;
    }

    .page-numbers:hover {
        color: white;
        background-color: #e94e1a;
    }
    .fusion-page-title-bar .fusion-builder-row.fusion-row {
        display: none;
    }
    .fusion-body .fusion-flex-container.fusion-builder-row-1{
        padding-bottom: 0!important;
    }
</style>

<div id="post-796" class="post-796 page type-page status-publish hentry">
    <span class="entry-title rich-snippet-hidden">Imoveis</span>
    <span class="vcard rich-snippet-hidden">
        <span class="fn"><a href="#" title="Posts de Jetimobi" rel="author">Jetimobi</a></span>
    </span>
    <span class="updated rich-snippet-hidden"></span>
    <div class="post-content">
        <form action="/imovel" method="get">
            <div class="fusion-fullwidth fullwidth-box fusion-builder-row-13 fusion-flex-container nonhundred-percent-fullwidth non-hundred-percent-height-scrolling"
                style="background-color: rgba(255,255,255,0);background-position: center center;background-repeat: no-repeat;border-width: 0px 0px 0px 0px;border-color:#e2e2e2;border-style:solid;">
                <div class="fusion-builder-row fusion-row fusion-flex-align-items-flex-start"
                    style="max-width:100%;margin-left: calc(-4% / 2 );margin-right: calc(-4% / 2 );">
                    <div
                        class="fusion-layout-column fusion_builder_column fusion-builder-column-01 fusion_builder_column_1_4 1_4 fusion-flex-column">
                        <div class="fusion-column-wrapper fusion-flex-justify-content-flex-start fusion-content-layout-column"
                            style="background-position: left top; background-repeat: no-repeat; background-size: cover; padding: 0px; min-height: 0px;">
                            <label>Tipo de Imóvel
                                <?php
                                create_taxonomy_select('tipo_imovel', 'tipo_imovel', 'Tipo de Imóvel');
                                ?>
                            </label>
                        </div>
                    </div>
                    <style type="text/css">
                        .fusion-body .fusion-builder-column-01 {
                            width: 25% !important;
                            margin-top: 0px;
                            margin-bottom: 20px;
                        }

                        .fusion-builder-column-01>.fusion-column-wrapper {
                            padding-top: 0px !important;
                            padding-right: 0px !important;
                            margin-right: 1.68%;
                            padding-bottom: 0px !important;
                            padding-left: 0px !important;
                            margin-left: 1.68%;
                        }

                        @media only screen and (max-width:1024px) {
                            .fusion-body .fusion-builder-column-01 {
                                width: 25% !important;
                                order: 0;
                            }

                            .fusion-builder-column-01>.fusion-column-wrapper {
                                margin-right: 1.68%;
                                margin-left: 1.68%;
                            }
                        }

                        @media only screen and (max-width:640px) {
                            .fusion-body .fusion-builder-column-01 {
                                width: 100% !important;
                                order: 0;
                            }

                            .fusion-builder-column-01>.fusion-column-wrapper {
                                margin-right: 1.92%;
                                margin-left: 1.92%;
                            }
                        }
                    </style>
                    <div
                        class="fusion-layout-column fusion_builder_column fusion-builder-column-02 fusion_builder_column_1_4 1_4 fusion-flex-column">
                        <div class="fusion-column-wrapper fusion-flex-justify-content-flex-start fusion-content-layout-column"
                            style="background-position: left top; background-repeat: no-repeat; background-size: cover; padding: 0px; min-height: 0px;">
                            <label>Bairro
                                <?php
                                create_taxonomy_select('area', 'area', 'Bairro');
                                ?>
                            </label>
                        </div>
                    </div>
                    <style type="text/css">
                        .fusion-body .fusion-builder-column-02 {
                            width: 25% !important;
                            margin-top: 0px;
                            margin-bottom: 20px;
                        }

                        .fusion-builder-column-02>.fusion-column-wrapper {
                            padding-top: 0px !important;
                            padding-right: 0px !important;
                            margin-right: 1.68%;
                            padding-bottom: 0px !important;
                            padding-left: 0px !important;
                            margin-left: 1.68%;
                        }

                        @media only screen and (max-width:1024px) {
                            .fusion-body .fusion-builder-column-02 {
                                width: 25% !important;
                                order: 0;
                            }

                            .fusion-builder-column-02>.fusion-column-wrapper {
                                margin-right: 1.68%;
                                margin-left: 1.68%;
                            }
                        }

                        @media only screen and (max-width:640px) {
                            .fusion-body .fusion-builder-column-02 {
                                width: 100% !important;
                                order: 0;
                            }

                            .fusion-builder-column-02>.fusion-column-wrapper {
                                margin-right: 1.92%;
                                margin-left: 1.92%;
                            }
                        }
                    </style>
                    <div
                        class="fusion-layout-column fusion_builder_column fusion-builder-column-03 fusion_builder_column_1_4 1_4 fusion-flex-column">
                        <div class="fusion-column-wrapper fusion-flex-justify-content-flex-start fusion-content-layout-column"
                            style="background-position: left top; background-repeat: no-repeat; background-size: cover; padding: 0px; min-height: 0px;">
                            <label>Cidade
                                <?php
                                create_taxonomy_select('cidade', 'cidade', 'Cidade');
                                ?>
                            </label>
                        </div>
                    </div>
                    <style type="text/css">
                        .fusion-body .fusion-builder-column-03 {
                            width: 25% !important;
                            margin-top: 0px;
                            margin-bottom: 20px;
                        }

                        .fusion-builder-column-03>.fusion-column-wrapper {
                            padding-top: 0px !important;
                            padding-right: 0px !important;
                            margin-right: 1.68%;
                            padding-bottom: 0px !important;
                            padding-left: 0px !important;
                            margin-left: 1.68%;
                        }

                        @media only screen and (max-width:1024px) {
                            .fusion-body .fusion-builder-column-03 {
                                width: 25% !important;
                                order: 0;
                            }

                            .fusion-builder-column-03>.fusion-column-wrapper {
                                margin-right: 1.68%;
                                margin-left: 1.68%;
                            }
                        }

                        @media only screen and (max-width:640px) {
                            .fusion-body .fusion-builder-column-03 {
                                width: 100% !important;
                                order: 0;
                            }

                            .fusion-builder-column-03>.fusion-column-wrapper {
                                margin-right: 1.92%;
                                margin-left: 1.92%;
                            }
                        }
                    </style>
                    <div
                        class="fusion-layout-column fusion_builder_column fusion-builder-column-04 fusion_builder_column_1_4 1_4 fusion-flex-column">
                        <div class="fusion-column-wrapper fusion-flex-justify-content-flex-start fusion-content-layout-column"
                            style="background-position: left top; background-repeat: no-repeat; background-size: cover; padding: 0px; min-height: 0px;">
                            <label>Estado
                                <?php
                                create_taxonomy_select('estado', 'estado', 'Estado');
                                ?>
                            </label>
                        </div>
                    </div>
                    <style type="text/css">
                        .fusion-body .fusion-builder-column-04 {
                            width: 25% !important;
                            margin-top: 0px;
                            margin-bottom: 20px;
                        }

                        .fusion-builder-column-04>.fusion-column-wrapper {
                            padding-top: 0px !important;
                            padding-right: 0px !important;
                            margin-right: 1.68%;
                            padding-bottom: 0px !important;
                            padding-left: 0px !important;
                            margin-left: 1.68%;
                        }

                        @media only screen and (max-width:1024px) {
                            .fusion-body .fusion-builder-column-04 {
                                width: 25% !important;
                                order: 0;
                            }

                            .fusion-builder-column-04>.fusion-column-wrapper {
                                margin-right: 1.68%;
                                margin-left: 1.68%;
                            }
                        }

                        @media only screen and (max-width:640px) {
                            .fusion-body .fusion-builder-column-04 {
                                width: 100% !important;
                                order: 0;
                            }

                            .fusion-builder-column-04>.fusion-column-wrapper {
                                margin-right: 1.92%;
                                margin-left: 1.92%;
                            }
                        }
                    </style>

                    <div
                        class="fusion-layout-column fusion_builder_column fusion-builder-column-07 fusion_builder_column_1_4 1_4 fusion-flex-column">
                        <div class="fusion-column-wrapper fusion-flex-justify-content-flex-start fusion-content-layout-column"
                            style="background-position: left top; background-repeat: no-repeat; background-size: cover; padding: 0px; min-height: 0px;">
                            <label>Quartos
                                <?php
                                create_meta_select('dormitorios', 'dormitorios', $dormitorios_options, 'Quartos');
                                ?>
                            </label>
                        </div>
                    </div>
                    <style type="text/css">
                        .fusion-body .fusion-builder-column-07 {
                            width: 25% !important;
                            margin-top: 0px;
                            margin-bottom: 20px;
                        }

                        .fusion-builder-column-07>.fusion-column-wrapper {
                            padding-top: 0px !important;
                            padding-right: 0px !important;
                            margin-right: 1.68%;
                            padding-bottom: 0px !important;
                            padding-left: 0px !important;
                            margin-left: 1.68%;
                        }

                        @media only screen and (max-width:1024px) {
                            .fusion-body .fusion-builder-column-07 {
                                width: 25% !important;
                                order: 0;
                            }

                            .fusion-builder-column-07>.fusion-column-wrapper {
                                margin-right: 1.68%;
                                margin-left: 1.68%;
                            }
                        }

                        @media only screen and (max-width:640px) {
                            .fusion-body .fusion-builder-column-07 {
                                width: 100% !important;
                                order: 0;
                            }

                            .fusion-builder-column-07>.fusion-column-wrapper {
                                margin-right: 1.92%;
                                margin-left: 1.92%;
                            }
                        }
                    </style>
                    <div
                        class="fusion-layout-column fusion_builder_column fusion-builder-column-08 fusion_builder_column_1_4 1_4 fusion-flex-column">
                        <div class="fusion-column-wrapper fusion-flex-justify-content-flex-start fusion-content-layout-column"
                            style="background-position: left top; background-repeat: no-repeat; background-size: cover; padding: 0px; min-height: 0px;">
                            <label>Suítes
                                <?php
                                create_meta_select('suites', 'suites', $suites_options, 'Suítes');
                                ?>
                            </label>
                        </div>
                    </div>
                    <style type="text/css">
                        .fusion-body .fusion-builder-column-08 {
                            width: 25% !important;
                            margin-top: 0px;
                            margin-bottom: 20px;
                        }

                        .fusion-builder-column-08>.fusion-column-wrapper {
                            padding-top: 0px !important;
                            padding-right: 0px !important;
                            margin-right: 1.68%;
                            padding-bottom: 0px !important;
                            padding-left: 0px !important;
                            margin-left: 1.68%;
                        }

                        @media only screen and (max-width:1024px) {
                            .fusion-body .fusion-builder-column-08 {
                                width: 25% !important;
                                order: 0;
                            }

                            .fusion-builder-column-08>.fusion-column-wrapper {
                                margin-right: 1.68%;
                                margin-left: 1.68%;
                            }
                        }

                        @media only screen and (max-width:640px) {
                            .fusion-body .fusion-builder-column-08 {
                                width: 100% !important;
                                order: 0;
                            }

                            .fusion-builder-column-08>.fusion-column-wrapper {
                                margin-right: 1.92%;
                                margin-left: 1.92%;
                            }
                        }
                    </style>
                    <div
                        class="fusion-layout-column fusion_builder_column fusion-builder-column-09 fusion_builder_column_1_4 1_4 fusion-flex-column">
                        <div class="fusion-column-wrapper fusion-flex-justify-content-flex-start fusion-content-layout-column"
                            style="background-position: left top; background-repeat: no-repeat; background-size: cover; padding: 0px; min-height: 0px;">
                            <label>Banheiros
                                <?php
                                create_meta_select('banheiros', 'banheiros', $banheiros_options, 'Banheiros');
                                ?>
                            </label>
                        </div>
                    </div>
                    <style type="text/css">
                        .fusion-body .fusion-builder-column-09 {
                            width: 25% !important;
                            margin-top: 0px;
                            margin-bottom: 20px;
                        }

                        .fusion-builder-column-09>.fusion-column-wrapper {
                            padding-top: 0px !important;
                            padding-right: 0px !important;
                            margin-right: 1.68%;
                            padding-bottom: 0px !important;
                            padding-left: 0px !important;
                            margin-left: 1.68%;
                        }

                        @media only screen and (max-width:1024px) {
                            .fusion-body .fusion-builder-column-09 {
                                width: 25% !important;
                                order: 0;
                            }

                            .fusion-builder-column-09>.fusion-column-wrapper {
                                margin-right: 1.68%;
                                margin-left: 1.68%;
                            }
                        }

                        @media only screen and (max-width:640px) {
                            .fusion-body .fusion-builder-column-09 {
                                width: 100% !important;
                                order: 0;
                            }

                            .fusion-builder-column-09>.fusion-column-wrapper {
                                margin-right: 1.92%;
                                margin-left: 1.92%;
                            }
                        }
                    </style>
                    <div
                        class="fusion-layout-column fusion_builder_column fusion-builder-column-010 fusion_builder_column_1_4 1_4 fusion-flex-column">
                        <div class="fusion-column-wrapper fusion-flex-justify-content-flex-start fusion-content-layout-column"
                            style="background-position: left top; background-repeat: no-repeat; background-size: cover; padding: 0px; min-height: 0px;">
                            <label>Vagas de Garagem
                                <?php
                                create_meta_select('garagens', 'garagens', $vagas_options, 'Vagas');
                                ?>
                            </label>
                        </div>
                    </div>
                    <style type="text/css">
                        .fusion-body .fusion-builder-column-010 {
                            width: 25% !important;
                            margin-top: 0px;
                            margin-bottom: 20px;
                        }

                        .fusion-builder-column-010>.fusion-column-wrapper {
                            padding-top: 0px !important;
                            padding-right: 0px !important;
                            margin-right: 1.68%;
                            padding-bottom: 0px !important;
                            padding-left: 0px !important;
                            margin-left: 1.68%;
                        }

                        @media only screen and (max-width:1024px) {
                            .fusion-body .fusion-builder-column-010 {
                                width: 25% !important;
                                order: 0;
                            }

                            .fusion-builder-column-010>.fusion-column-wrapper {
                                margin-right: 1.68%;
                                margin-left: 1.68%;
                            }
                        }

                        @media only screen and (max-width:640px) {
                            .fusion-body .fusion-builder-column-010 {
                                width: 100% !important;
                                order: 0;
                            }

                            .fusion-builder-column-010>.fusion-column-wrapper {
                                margin-right: 1.92%;
                                margin-left: 1.92%;
                            }
                        }
                    </style>

                </div>
                <style type="text/css">
                    .fusion-body .fusion-flex-container.fusion-builder-row-13 {
                        padding-top: 0px;
                        margin-top: 0px;
                        padding-right: 30px;
                        padding-bottom: 0px;
                        margin-bottom: 0px;
                        padding-left: 30px;
                    }
                </style>
            </div>
            <div class="fusion-fullwidth fullwidth-box fusion-builder-row-15 fusion-flex-container hundred-percent-fullwidth non-hundred-percent-height-scrolling"
                style="background-color: rgba(255,255,255,0);background-position: center center;background-repeat: no-repeat;border-width: 0px 0px 0px 0px;border-color:#e2e2e2;border-style:solid;">
                <div class="fusion-builder-row fusion-row fusion-flex-align-items-flex-start fusion-flex-justify-content-flex-end"
                    style="width:104% !important;max-width:104% !important;margin-left: calc(-4% / 2 );margin-right: calc(-4% / 2 );">
                    <div
                        class="fusion-layout-column fusion_builder_column fusion-builder-column-06 fusion_builder_column_1_4 1_4 fusion-flex-column">
                        <div class="fusion-column-wrapper fusion-flex-justify-content-flex-start fusion-content-layout-column"
                            style="background-position: left top; background-repeat: no-repeat; background-size: cover; padding: 0px; min-height: 0px;">
                            <div style="text-align:center;">
                                <style type="text/css">
                                    .fusion-button.button-1 {
                                        border-radius: 4px;
                                    }

                                    .fusion-button.button-1 .fusion-button-text {
                                        text-transform: uppercase;
                                    }
                                </style><button type="submit"
                                    class="fusion-button button-flat fusion-button-default-size button-default button-1 fusion-button-span-yes fusion-button-default-type"
                                    target="_self" href="#"><i class="fa-search fas button-icon-left"
                                        aria-hidden="true"></i><span
                                        class="fusion-button-text">Pesquiisar</span></button>
                            </div>
                        </div>
                    </div>
                    <style type="text/css">
                        .fusion-body .fusion-builder-column-06 {
                            width: 25% !important;
                            margin-top: 0px;
                            margin-bottom: 20px;
                        }

                        .fusion-builder-column-06>.fusion-column-wrapper {
                            padding-top: 0px !important;
                            padding-right: 0px !important;
                            margin-right: 1.68%;
                            padding-bottom: 0px !important;
                            padding-left: 0px !important;
                            margin-left: 1.68%;
                        }

                        @media only screen and (max-width:1024px) {
                            .fusion-body .fusion-builder-column-06 {
                                width: 25% !important;
                                order: 0;
                            }

                            .fusion-builder-column-06>.fusion-column-wrapper {
                                margin-right: 1.68%;
                                margin-left: 1.68%;
                            }
                        }

                        @media only screen and (max-width:640px) {
                            .fusion-body .fusion-builder-column-06 {
                                width: 100% !important;
                                order: 0;
                            }

                            .fusion-builder-column-06>.fusion-column-wrapper {
                                margin-right: 1.92%;
                                margin-left: 1.92%;
                            }
                        }
                    </style>
                </div>
                <style type="text/css">
                    .fusion-body .fusion-flex-container.fusion-builder-row-15 {
                        padding-top: 0px;
                        margin-top: 0px;
                        padding-right: 30px;
                        padding-bottom: 0px;
                        margin-bottom: 0px;
                        padding-left: 30px;
                    }
                </style>
            </div>
        </form>
        <div class="fusion-fullwidth fullwidth-box fusion-builder-row-6 fusion-flex-container hundred-percent-fullwidth non-hundred-percent-height-scrolling"
            style="background-color: rgba(255,255,255,0);background-position: center center;background-repeat: no-repeat;border-width: 0px 0px 0px 0px;border-color:#e2e2e2;border-style:solid;">
            <div class="fusion-builder-row fusion-row fusion-flex-align-items-flex-start"
                style="width:104% !important;max-width:104% !important;margin-left: calc(-4% / 2 );margin-right: calc(-4% / 2 );">
                <?php if ($query->have_posts()): ?>
                    <?php
                    $i = 6;
                    // Start the Loop.
                    while ($query->have_posts()):
                        $query->the_post();
                        /*
                         * Include the Post-Format-specific template for the content.
                         * If you want to override this in a child theme, then include a file
                         * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                         */
                        //get_template_part( 'template-parts/content/content', 'excerpt' );
                        //the_excerpt();
                
                        // End the loop.
                
                        $venda = get_post_meta($post->ID, 'venda', true);
                        $locacao = get_post_meta($post->ID, 'locacao', true);
                        $temporada = get_post_meta($post->ID, 'temporada', true);
                        $valor_venda = get_post_meta($post->ID, 'valor_venda', true);
                        $valor_locacao = get_post_meta($post->ID, 'valor_locacao', true);
                        $valor_temporada = get_post_meta($post->ID, 'valor_temporada', true);
                        $codigo = get_post_meta($post->ID, 'codigo', true);
                        $area_total = get_post_meta($post->ID, 'area_total', true);
                        $area_util = get_post_meta($post->ID, 'area_util', true);
                        $dorms = get_post_meta($post->ID, 'dormitorios', true);
                        $suites = get_post_meta($post->ID, 'suites', true);
                        $banheiros = get_post_meta($post->ID, 'banheiros', true);
                        $vagas = get_post_meta($post->ID, 'garagens', true);
                        $fifu_image_url = get_post_meta($post->ID, 'fifu_image_url', true);
                        $endereco_complemento = get_post_meta($post->ID, 'endereco_complemento', true);
                        $bairro = wp_get_post_terms($post->ID, 'area', array('number' => 1));
                        $cidade = wp_get_post_terms($post->ID, 'cidade', array('number' => 1));
                        $estado = wp_get_post_terms($post->ID, 'estado', array('number' => 1));
                        ?>
                        <div
                            class="fusion-layout-column fusion_builder_column fusion-builder-column-<?php echo $i ?> fusion_builder_column_1_2 1_2 fusion-flex-column imoveiscontent fusion-column-inner-bg-wrapper">
                            <div class="fusion-column-wrapper fusion-flex-justify-content-flex-end fusion-content-layout-column"
                                style="padding: 20px 30px; min-height: 0px;" data-bg-url="<?php echo $fifu_image_url ?>">
                                <div class="fusion-text fusion-text-1"
                                    style="display:flex; flex-wrap: wrap; transform:translate3d(0,0,0); align-items:center; justify-content:flex-end;">
                                    <div class="col-text-1">
                                        <h2 style="color:white; margin-top: 0; margin-bottom: 10px; text-align: right;"><strong><?php if (!is_null($valor_venda) && $venda > 0)
                                            if (get_post_meta($post->ID, 'valor_venda_visivel', true) == '1')
                                                echo "R$ " . number_format($valor_venda, 2, ',', '.');
                                            else
                                                echo "Consulte Valores";
                                        else if (!is_null($valor_locacao) && $locacao > 0)
                                            if (get_post_meta($post->ID, 'valor_locacao_visivel', true) == '1')
                                                echo "R$ " . number_format($valor_locacao, 2, ',', '.');
                                            else
                                                echo "Consulte Valores";
                                        else if (!is_null($valor_temporada) && $temporada > 0)
                                            if (get_post_meta($post->ID, 'valor_temporada_visivel', true) == '1')
                                                echo "R$ " . number_format($valor_temporada, 2, ',', '.');
                                            else
                                                echo "Consulte Valores";
                                        else
                                            echo "Consulte Valores";
                                        ?></strong></h2>
                                    </div>
                                    <div class="col-text-2">
                                        <h6
                                            style="color:white; margin-top: 0; margin-bottom: 10px; text-align: right; text-transform: uppercase">
                                            <?php echo the_title(); ?>
                                        </h6>
                                    </div>
                                </div>
                                <div class="texto-cima" style="display: none">
                                    <h2 class="blog-shortcode-post-title entry-title"
                                        style="color: black; width: 100%; text-transform:uppercase; margin-bottom: 0px">
                                        <strong><?php echo the_title(); ?></strong>
                                    </h2>
                                    <div style="width:100%;">
                                        <div
                                            style="width:100%; display: grid;grid-template-columns: repeat(1, 1fr); gap: 5px; padding: 0px;">
                                            <?php if (!is_null($valor_venda) && $venda > 0) {
                                                if (get_post_meta($post->ID, 'valor_venda_visivel', true) == '1') { ?>
                                                    <h5 style="color: black; width: 100%; margin-top: 0; margin-bottom: 15px;">
                                                        <strong>R$
                                                            <?php echo number_format($valor_venda, 2, ',', '.'); ?></strong></h5>
                                                <?php } else { ?>
                                                    <h5 style="color: black; width: 100%; margin-top: 0; margin-bottom: 15px;">
                                                        <strong>Consulte Valores</strong>
                                                    </h5>
                                                <?php }
                                            } ?>
                                            <?php if (!is_null($valor_locacao) && $locacao > 0) {
                                                if (get_post_meta($post->ID, 'valor_locacao_visivel', true) == '1') { ?>
                                                    <h5 style="color: black; width: 100%; margin-top: 0; margin-bottom: 15px;">
                                                        <strong>R$
                                                            <?php echo number_format($valor_locacao, 2, ',', '.'); ?></strong></h5>
                                                <?php } else { ?>
                                                    <h5 style="color: black; width: 100%; margin-top: 0; margin-bottom: 15px;">
                                                        <strong>Consulte Valores</strong>
                                                    </h5>
                                                <?php }
                                            } ?>

                                            <?php if (!is_null($valor_temporada) && $temporada > 0) {
                                                if (get_post_meta($post->ID, 'valor_temporada_visivel', true) == '1') { ?>
                                                    <h5 style="color: black; width: 100%; margin-top: 0; margin-bottom: 15px;">
                                                        <strong>R$
                                                            <?php echo number_format($valor_temporada, 2, ',', '.'); ?></strong></h5>
                                                <?php } else { ?>
                                                    <h5 style="color: black; width: 100%; margin-top: 0; margin-bottom: 15px;">
                                                        <strong>Consulte Valores</strong>
                                                    </h5>
                                                <?php }
                                            } ?>
                                            <h5 style="color: black; width: 100%; margin-top: 0; margin-bottom: 15px;"><i
                                                    class="fas fa-map-marker-alt"></i>
                                                <strong><?php echo esc_html($endereco_complemento); ?></strong>
                                            </h5>
                                        </div>
                                        <div
                                            style="width:100%; display: grid;grid-template-columns: repeat(2, 1fr); gap: 5px; padding: 0px;">
                                            <?php if (!is_null($area_total) && $area_total > 0) { ?>
                                                <h5 style="color: black; width: 100%; margin-top: 0; margin-bottom: 15px;"><i
                                                        class="fas fa-vector-square"></i>
                                                    <strong><?php echo $area_total; ?></strong>m²
                                                </h5>
                                            <?php } else if (!is_null($area_util) && $area_util > 0) { ?>
                                                    <h5 style="color: black; width: 100%; margin-top: 0; margin-bottom: 15px;"><i
                                                            class="fas fa-vector-square"></i>
                                                        <strong><?php echo $area_util; ?></strong>m²
                                                    </h5>
                                            <?php } ?>
                                            <?php if (!is_null($dorms) && $dorms > 0) { ?>
                                                <h5 style="color: black; width: 100%; margin-top: 0; margin-bottom: 15px;"><i
                                                        class="fas fa-bed"></i> <strong><?php echo $dorms; ?> Quartos</strong></h5>
                                            <?php } ?>
                                            <?php if (!is_null($suites) && $suites > 0) { ?>
                                                <h5 style="color: black; width: 100%; margin-top: 0; margin-bottom: 15px;"><i
                                                        class="fas fa-door-open"></i> <strong><?php echo $suites; ?> Suítes</strong>
                                                </h5>
                                            <?php } ?>
                                            <?php if (!is_null($banheiros) && $banheiros > 0) { ?>
                                                <h5 style="color: black; width: 100%; margin-top: 0; margin-bottom: 15px;"><i
                                                        class="fas fa-bath"></i> <strong><?php echo $banheiros; ?>
                                                        Banheiros</strong>
                                                </h5>
                                            <?php } ?>
                                            <?php if (!is_null($vagas) && $vagas > 0) { ?>
                                                <h5 style="color: black; width: 100%; margin-top: 0; margin-bottom: 15px;"><i
                                                        class="fas fa-car"></i> <strong><?php echo $vagas; ?> Vagas</strong></h5>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div
                                        style="width: 100%; background-color: black; text-transform: uppercase; color: white; text-align: center; margin: 0px!important; height: 70px; font-weight: bold; font-size: 20px;">
                                        Ver Detalhes +</h4>
                                    </div>
                                </div>
                            </div>
                            <span class="fusion-column-inner-bg hover-type-zoomin">
                                <a href="<?php echo get_post_permalink(); ?>">
                                    <span class="fusion-column-inner-bg-image"
                                        style="background-image: url('<?php echo $fifu_image_url ?>');background-image: linear-gradient(180deg, rgba(0,0,0,0.5) 0%,rgba(0,0,0,0.5) 100%),url(<?php echo $fifu_image_url ?>);background-position:left top;background-repeat:no-repeat;-webkit-background-size:cover;-moz-background-size:cover;-o-background-size:cover;background-size:cover;"></span>

                                </a>
                            </span>
                        </div>
                        <style type="text/css">
                            .fusion-body .fusion-builder-column-<?php echo $i ?> {
                                width: 50% !important;
                                margin-top: 0px;
                                margin-bottom: 20px;
                            }

                            .fusion-builder-column-<?php echo $i ?>>.fusion-column-wrapper {
                                padding-top: 20px !important;
                                padding-right: 30px !important;
                                margin-right: 1.152%;
                                padding-bottom: 20px !important;
                                padding-left: 30px !important;
                                margin-left: 1.152%;
                            }

                            .fusion-flex-container .fusion-row .fusion-builder-column-<?php echo $i ?>>.fusion-column-inner-bg {
                                margin-right: 1.152%;
                                margin-left: 1.152%;
                            }

                            @media only screen and (max-width:1024px) {
                                .fusion-body .fusion-builder-column-<?php echo $i ?> {
                                    width: 50% !important;
                                    order: 0;
                                }

                                .fusion-builder-column-<?php echo $i ?>>.fusion-column-wrapper {
                                    margin-right: 1.152%;
                                    margin-left: 1.152%;
                                }

                                .fusion-flex-container .fusion-row .fusion-builder-column-<?php echo $i ?>>.fusion-column-inner-bg {
                                    margin-right: 1.152%;
                                    margin-left: 1.152%;
                                }
                            }

                            @media only screen and (max-width:640px) {
                                .fusion-body .fusion-builder-column-<?php echo $i ?> {
                                    width: 100% !important;
                                    order: 0;
                                }

                                .fusion-builder-column-<?php echo $i ?>>.fusion-column-wrapper {
                                    margin-right: 1.92%;
                                    margin-left: 1.92%;
                                }

                                .fusion-flex-container .fusion-row .fusion-builder-column-<?php echo $i ?>>.fusion-column-inner-bg {
                                    margin-right: 1.92%;
                                    margin-left: 1.92%;
                                }
                            }
                        </style>

                        <?php
                        $i++;
                    endwhile; ?>

                </div>

            </div>
            <?php the_posts_pagination(array(
                'mid_size' => 5,  // número de páginas de cada lado da atual
                'end_size' => 2,  // páginas que sempre aparecem no início e no fim
                'prev_text' => __('« Anterior', 'seutema'),
                'next_text' => __('Próximo »', 'seutema'),
            ));
            ?>

            <?php
                // If no content, include the "No posts found" template.
            else:
                echo '<h4 style="text-align: center;width: 100%;">Nada encontrado</h4>';

            endif;
            ?>
    </div>
</div>
<style type="text/css">
    /*.imoveiscontent:hover{
        margin-bottom: 60px !important;
    }*/
    .imoveiscontent:hover .fusion-column-wrapper {
        padding: 0px !important;
    }

    .imoveiscontent:hover .fusion-column-wrapper>.fusion-text {
        display: none !important;
    }

    .imoveiscontent:hover .fusion-column-wrapper>.texto-cima {
        display: flex !important;
        flex-wrap: wrap;
        align-items: flex-end;
    }

    select {
        width: 100%;
    }

    .fusion-body .fusion-flex-container.fusion-builder-row-6 {
        padding-top: 0px;
        margin-top: 0px;
        padding-right: 30px;
        padding-bottom: 0px;
        margin-bottom: 0px;
        padding-left: 30px;
    }

    .col-text-1 {
        width: 40%;
    }

    .col-text-2 {
        width: 45%;
    }

    @media only screen and (max-width:1520px) {

        .col-text-1,
        .col-text-2 {
            width: 50%;
        }
    }

    @media only screen and (max-width:1402px) {

        .col-text-1,
        .col-text-2 {
            width: 100%;
        }
    }

    .texto-cima {
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.44);
    }

    .texto-cima h2,
    .texto-cima div {
        padding: 19px 19px;
    }

    .grids4 {
        width: 100%;
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 20px;
    }

    @media only screen and (max-width:640px) {
        .fusion-body .fusion-flex-container.fusion-builder-row-6 {
            padding-top: 0px;
            margin-top: 0px;
            padding-right: 0px;
            padding-bottom: 0px;
            margin-bottom: 0px;
            padding-left: 0px;
        }
    }
</style>
<?php
get_footer();