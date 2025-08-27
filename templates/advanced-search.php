<?php /* Template Name: resultados da busca */ ?>

<?php
//get_header();
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
</style>

<div id="post-796" class="post-796 page type-page status-publish hentry">
    <span class="entry-title rich-snippet-hidden">Resultado da Busca</span><span class="vcard rich-snippet-hidden"><span
            class="fn"><a href="#" title="Posts de andre" rel="author">#</a></span></span><span
        class="updated rich-snippet-hidden"></span>
    <div class="post-content">
        <div class="fusion-fullwidth fullwidth-box fusion-builder-row-6 fusion-flex-container hundred-percent-fullwidth non-hundred-percent-height-scrolling"
            style="background-color: rgba(255,255,255,0);background-position: center center;background-repeat: no-repeat;border-width: 0px 0px 0px 0px;border-color:#e2e2e2;border-style:solid;">
            <div class="fusion-builder-row fusion-row fusion-flex-align-items-flex-start"
                style="width:104% !important;max-width:104% !important;margin-left: calc(-4% / 2 );margin-right: calc(-4% / 2 );">
                <?php

                // -------------------------
                // TAXONOMIAS
                // -------------------------
                if (!empty($_REQUEST['tipo_imovel'])) {
                    $tax_query[] = array(
                        'taxonomy' => 'tipo_imovel',
                        'field' => 'slug',
                        'terms' => (array) sanitize_text_field($_REQUEST['tipo_imovel']),
                    );
                }

                if (!empty($_REQUEST['property_area'])) {
                    $tax_query[] = array(
                        'taxonomy' => 'property_area',
                        'field' => 'slug',
                        'terms' => (array) sanitize_text_field($_REQUEST['property_area']),
                        'include_children' => true,
                    );
                }

                if (!empty($_REQUEST['property_city'])) {
                    $tax_query[] = array(
                        'taxonomy' => 'property_city',
                        'field' => 'slug',
                        'terms' => (array) sanitize_text_field($_REQUEST['property_city']),
                        'include_children' => true,
                    );
                }

                if (!empty($_REQUEST['property_state'])) {
                    $tax_query[] = array(
                        'taxonomy' => 'property_state',
                        'field' => 'slug',
                        'terms' => (array) sanitize_text_field($_REQUEST['property_state']),
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
                    $meta_query[] = array(
                        'key' => 'suites',
                        'value' => absint($_REQUEST['suites']),
                        'compare' => '=',
                        'type' => 'NUMERIC',
                    );
                }

                if (!empty($_REQUEST['banheiros'])) {
                    $meta_query[] = array(
                        'key' => 'banheiros',
                        'value' => absint($_REQUEST['banheiros']),
                        'compare' => '=',
                        'type' => 'NUMERIC',
                    );
                }

                if (!empty($_REQUEST['vagas'])) {
                    $meta_query[] = array(
                        'key' => 'vagas',
                        'value' => absint($_REQUEST['vagas']),
                        'compare' => '=',
                        'type' => 'NUMERIC',
                    );
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


                // The Query
                $query = new WP_Query($args);

                if ($query->have_posts()):
                    $i = 6;
                    // Start the Loop.
                    while ($query->have_posts()):
                        $query->the_post();
                        var_dump($post);
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
                        $bairro = wp_get_post_terms($post->ID, 'property_area', array('number' => 1));
                        $cidade = wp_get_post_terms($post->ID, 'property_city', array('number' => 1));
                        $estado = wp_get_post_terms($post->ID, 'property_state', array('number' => 1));
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
                                                echo "R$ " . $valor_venda;
                                            else
                                                echo "Consulte Valores";
                                        else if (!is_null($valor_locacao) && $locacao > 0)
                                            if (get_post_meta($post->ID, 'valor_locacao_visivel', true) == '1')
                                                echo "R$ " . $valor_locacao;
                                            else
                                                echo "Consulte Valores";
                                        else if (!is_null($valor_temporada) && $temporada > 0)
                                            if (get_post_meta($post->ID, 'valor_temporada_visivel', true) == '1')
                                                echo "R$ " . $valor_temporada;
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
                                        style="color: black; width: 100%; text-transform:uppercase; margin-bottom: 20px">
                                        <strong><?php echo the_title(); ?></strong>
                                    </h2>
                                    <div style="width:100%; display: grid;grid-template-columns: repeat(2, 1fr); gap: 20px;">
                                        <?php if (!is_null($valor_venda) && $venda > 0) {
                                            if (get_post_meta($post->ID, 'valor_venda_visivel', true) == '1') { ?>
                                                <h5 style="color: black; width: 100%; margin-top: 0; margin-bottom: 15px;"><strong>R$
                                                        <?php echo $valor_venda; ?></strong></h5>
                                            <?php } else { ?>
                                                <h5 style="color: black; width: 100%; margin-top: 0; margin-bottom: 15px;">
                                                    <strong>Consulte Valores</strong>
                                                </h5>
                                            <?php }
                                        } ?>
                                        <?php if (!is_null($valor_locacao) && $locacao > 0) {
                                            if (get_post_meta($post->ID, 'valor_locacao_visivel', true) == '1') { ?>
                                                <h5 style="color: black; width: 100%; margin-top: 0; margin-bottom: 15px;"><strong>R$
                                                        <?php echo $valor_locacao; ?></strong></h5>
                                            <?php } else { ?>
                                                <h5 style="color: black; width: 100%; margin-top: 0; margin-bottom: 15px;">
                                                    <strong>Consulte Valores</strong>
                                                </h5>
                                            <?php }
                                        } ?>

                                        <?php if (!is_null($valor_temporada) && $temporada > 0) {
                                            if (get_post_meta($post->ID, 'valor_temporada_visivel', true) == '1') { ?>
                                                <h5 style="color: black; width: 100%; margin-top: 0; margin-bottom: 15px;"><strong>R$
                                                        <?php echo $valor_temporada; ?></strong></h5>
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
                                        <?php if (!is_null($area_total) && $area_total > 0) { ?>
                                            <h5 style="color: black; width: 100%; margin-top: 0; margin-bottom: 15px;"><i
                                                    class="fas fa-vector-square"></i> <strong><?php echo $area_total; ?></strong>m²
                                            </h5>
                                        <?php } else if (!is_null($area_util) && $area_util > 0) { ?>
                                                <h5 style="color: black; width: 100%; margin-top: 0; margin-bottom: 15px;"><i
                                                        class="fas fa-vector-square"></i> <strong><?php echo $area_util; ?></strong>m²
                                                </h5>
                                        <?php } ?>
                                        <?php if (!is_null($dorms) && $dorms > 0) { ?>
                                            <h5 style="color: black; width: 100%; margin-top: 0; margin-bottom: 15px;"><i
                                                    class="fas fa-bed"></i> <strong><?php echo $dorms; ?> Quartos</strong></h5>
                                        <?php } ?>
                                        <?php if (!is_null($suites) && $suites > 0) { ?>
                                            <h5 style="color: black; width: 100%; margin-top: 0; margin-bottom: 15px;"><i
                                                    class="fas fa-bed"></i> <strong><?php echo $suites; ?> Suítes</strong></h5>
                                        <?php } ?>
                                        <?php if (!is_null($banheiros) && $banheiros > 0) { ?>
                                            <h5 style="color: black; width: 100%; margin-top: 0; margin-bottom: 15px;"><i
                                                    class="fas fa-bath"></i> <strong><?php echo $banheiros; ?> Banheiros</strong>
                                            </h5>
                                        <?php } ?>
                                        <?php if (!is_null($vagas) && $vagas > 0) { ?>
                                            <h5 style="color: black; width: 100%; margin-top: 0; margin-bottom: 15px;"><i
                                                    class="fas fa-car"></i> <strong><?php echo $vagas; ?> Vagas</strong></h5>
                                        <?php } ?>
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
                    endwhile;
                    ?>
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
                    echo 'Nada encontrado';

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
        padding: 20px 30px;
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
//get_footer();