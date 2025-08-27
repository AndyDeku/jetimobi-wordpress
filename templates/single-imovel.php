<?php

get_header(); ?>

<style>
    /* main,
    main>.fusion-row {
        max-width: 100% !important;
        width: 100% !important;
        padding-left: 0 !important;
        padding-right: 0 !important;
    }
*/
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

<div id="post-<?php echo $post->ID ?>" class="post-<?php echo $post->ID ?> page type-page status-publish hentry">
    <span class="entry-title rich-snippet-hidden">Imoveis</span><span class="vcard rich-snippet-hidden"><span
            class="fn"><a href="#" title="Posts de andre" rel="author">#</a></span></span><span
        class="updated rich-snippet-hidden"></span>
    <div class="post-content">
        <?php
        $j = 8;
        // Start the Loop.
        while (have_posts()):
            the_post();
            ?>
            <?php
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
            ?>
            <div class="fusion-fullwidth fullwidth-box fusion-builder-row-7 fusion-flex-container hundred-percent-fullwidth non-hundred-percent-height-scrolling"
                style="background-color: rgba(255,255,255,0);background-position: center center;background-repeat: no-repeat;border-width: 0px 0px 0px 0px;border-color:#e2e2e2;border-style:solid;">
                <div class="fusion-builder-row fusion-row fusion-flex-align-items-flex-start"
                    style="width:104% !important;max-width:104% !important;margin-left: calc(-4% / 2 );margin-right: calc(-4% / 2 );">
                    <div
                        class="fusion-layout-column fusion_builder_column fusion-builder-column-<?php echo $j ?> fusion_builder_column_1_1 1_1 fusion-flex-column">
                        <div class="fusion-column-wrapper fusion-flex-justify-content-flex-start fusion-content-layout-column"
                            style="background-position: left top; background-repeat: no-repeat; background-size: cover; padding: 0px; min-height: 0px;">
                            <div class="fusion-text fusion-text-1" style="transform:translate3d(0,0,0);">
                                <?php if (!is_null($valor_venda) && $venda > 0) {
                                    if (get_post_meta($post->ID, 'valor_venda_visivel', true) == '1') { ?>
                                        <h4 style="margin-top: 0"><i class="fas fa-money-bill-wave"
                                                style="margin-right: 5px"></i><strong><?php echo $valor_venda; ?></strong>
                                        </h4>
                                    <?php } else { ?>
                                        <h4 style="margin-top: 0"><i class="fas fa-money-bill-wave" style="margin-right: 5px"></i>
                                            Consulte Valores</h4>
                                    <?php }
                                } ?>
                                <?php if (!is_null($valor_locacao) && $locacao > 0) {
                                    if (get_post_meta($post->ID, 'valor_locacao_visivel', true) == '1') { ?>
                                        <h4 style="margin-top: 0"><i class="fas fa-money-bill-wave"
                                                style="margin-right: 5px"></i><strong><?php echo $valor_locacao; ?></strong>
                                        </h4>
                                    <?php } else { ?>
                                        <h4 style="margin-top: 0"><i class="fas fa-money-bill-wave" style="margin-right: 5px"></i>
                                            Consulte Valores</h4>
                                    <?php }
                                } ?>

                                <?php if (!is_null($valor_temporada) && $temporada > 0) {
                                    if (get_post_meta($post->ID, 'valor_temporada_visivel', true) == '1') { ?>
                                        <h4 style="margin-top: 0"><i class="fas fa-money-bill-wave"
                                                style="margin-right: 5px"></i><strong><?php echo $valor_temporada; ?></strong>
                                        </h4>
                                    <?php } else { ?>
                                        <h4 style="margin-top: 0"><i class="fas fa-money-bill-wave" style="margin-right: 5px"></i>
                                            Consulte Valores</h4>
                                    <?php }
                                } ?>

                                <ul class="lidetalhe">
                                    <?php if (!is_null($area_total) && $area_total > 0) { ?>
                                        <li style="margin-left: 10px; margin-right: 10px;"><i class="fas fa-vector-square"></i>
                                            <strong><?php echo $area_total; ?>m²</strong> de Área Total

                                        </li>
                                    <?php } ?>
                                    <?php if (!is_null($area_util) && $area_util > 0) { ?>
                                        <li style="margin-left: 10px; margin-right: 10px;"><i class="fas fa-vector-square"></i>
                                            <strong><?php echo $area_util; ?>m²</strong> de Área Útil
                                        </li>
                                    <?php } ?>
                                    <?php if (!is_null($dorms) && $dorms > 0) { ?>
                                        <li style="margin-left: 10px; margin-right: 10px;"><i class="fas fa-bed"></i>
                                            <strong><?php echo $dorms; ?></strong> Quartos
                                        </li>
                                    <?php } ?>
                                    <?php if (!is_null($suites) && $suites > 0) { ?>
                                        <li style="margin-left: 10px; margin-right: 10px;"><i class="fas fa-bed"></i>
                                            <strong><?php echo $suites; ?></strong> Suítes
                                        </li>
                                    <?php } ?>
                                    <?php if (!is_null($banheiros) && $banheiros > 0) { ?>
                                        <li style="margin-left: 10px; margin-right: 10px;"><i class="fas fa-bath"></i>
                                            <strong><?php echo $banheiros ?></strong> Banheiros
                                        </li>
                                    <?php } ?>
                                    <?php if (!is_null($vagas) && $vagas > 0) { ?>
                                        <li style="margin-left: 10px; margin-right: 10px;"><i class="fas fa-car"></i>
                                            <strong><?php echo $vagas; ?></strong> Vagas de Garagem
                                        </li>
                                    <?php } ?>
                                </ul>
                                <h3>Descrição</h3>
                                <?php
                                the_content(
                                    sprintf(
                                        wp_kses(
                                            /* translators: %s: Name of current post. Only visible to screen readers */
                                            __('Continuar lendo<span class="screen-reader-text"> "%s"</span>', 'jetimob'),
                                            array(
                                                'span' => array(
                                                    'class' => array(),
                                                ),
                                            )
                                        ),
                                        get_the_title()
                                    )
                                );

                                wp_link_pages(
                                    array(
                                        'before' => '<div class="page-links">' . __('Pages:', 'jetimob'),
                                        'after' => '</div>',
                                    )
                                );
                                ?>

                                <h3>Características</h3>
                                <?php
                                $caracteristicas = get_post_meta($post->ID, 'caracteristicas');
                                echo '<ul>';
                                foreach ($caracteristicas[0] as $caracteristica) {
                                    if (!empty($caracteristica['caracteristica_titulo']) && !empty($caracteristica['caracteristica_valor'])) {
                                        echo '<li>' . $caracteristica['caracteristica_titulo'] . ': ' . $caracteristica['caracteristica_valor'] . '</li>';
                                    }
                                }
                                echo '</ul>';
                                ?>
                                <?php
                                $imovel_terms = get_the_term_list($post->ID, 'imovel_comodidades', '<ul class="styles grids"><li>', '</li><li>', '</li></ul>');
                                if (count_chars($imovel_terms) > 0 && $imovel_terms != "" && $imovel_terms != null) {
                                    ?>
                                    <h3>Comodidades do Imóvel</h3>
                                    <?php
                                    echo $imovel_terms;
                                    ?>
                                <?php } ?>
                                <?php
                                $condominio_terms = get_the_term_list($post->ID, 'condominio_comodidades', '<ul class="styles grids"><li>', '</li><li>', '</li></ul>');
                                if (count_chars($condominio_terms) > 0 && $condominio_terms != "" && $condominio_terms != null) {
                                    ?>
                                    <h3>Comodidades do Condomínio</h3>
                                    <?php
                                    echo $condominio_terms;
                                    ?>
                                <?php } ?>

                            </div>
                        </div>
                    </div>

                    <style type="text/css">
                        .fusion-body .fusion-builder-column-<?php echo $j ?> {
                            width: 100% !important;
                            margin-top: 0px;
                            margin-bottom: 20px;
                        }

                        .fusion-builder-column-<?php echo $j ?>>.fusion-column-wrapper {
                            padding-top: 0px !important;
                            padding-right: 0px !important;
                            margin-right: 1.92%;
                            padding-bottom: 0px !important;
                            padding-left: 0px !important;
                            margin-left: 1.92%;
                        }

                        @media only screen and (max-width:1024px) {
                            .fusion-body .fusion-builder-column-<?php echo $j ?> {
                                width: 100% !important;
                                order: 0;
                            }

                            .fusion-builder-column-<?php echo $j ?>>.fusion-column-wrapper {
                                margin-right: 1.92%;
                                margin-left: 1.92%;
                            }
                        }

                        @media only screen and (max-width:640px) {
                            .fusion-body .fusion-builder-column-<?php echo $j ?> {
                                width: 100% !important;
                                order: 0;
                            }

                            .fusion-builder-column-<?php echo $j ?>>.fusion-column-wrapper {
                                margin-right: 1.92%;
                                margin-left: 1.92%;
                            }
                        }
                    </style>
                </div>
                <style type="text/css">
                    .fusion-body .fusion-flex-container.fusion-builder-row-7 {
                        padding-top: 0px;
                        margin-top: 0px;
                        padding-right: 30px;
                        padding-bottom: 0px;
                        margin-bottom: 0px;
                        padding-left: 30px;
                    }
                </style>
            </div>

            <div class="fusion-fullwidth fullwidth-box fusion-builder-row-10 fusion-flex-container hundred-percent-fullwidth non-hundred-percent-height-scrolling"
                style="background-color: rgba(255,255,255,0);background-position: center center;background-repeat: no-repeat;border-width: 0px 0px 0px 0px;border-color:#e2e2e2;border-style:solid;">
                <div class="fusion-builder-row fusion-row fusion-flex-align-items-flex-start"
                    style="width:104% !important;max-width:104% !important;margin-left: calc(-4% / 2 );margin-right: calc(-4% / 2 );">
                    <div
                        class="fusion-layout-column fusion_builder_column fusion-builder-column-<?php echo $j + 1 ?> fusion_builder_column_1_1 1_1 fusion-flex-column">
                        <div class="fusion-column-wrapper fusion-flex-justify-content-flex-start fusion-content-layout-column"
                            style="background-position: left top; background-repeat: no-repeat; background-size: cover; padding: 0px; min-height: 0px;">

                            <div class="fusion-text fusion-text-1" style="transform:translate3d(0,0,0);">
                                <?php
                                $options = get_site_option('jetimob_option_name');
                                $maps_api = $options['gmaps'];
                                $geopos_visivel = get_post_meta($post->ID, 'geoposicionamento_visivel', true);
                                $lat = get_post_meta($post->ID, 'latitude', true);
                                $long = get_post_meta($post->ID, 'longitude', true);

                                $endereco_complemento = get_post_meta($post->ID, 'endereco_complemento', true);
                                //if($geopos_visivel > 0){ 
                                ?>


                                <?php if ($geopos_visivel == 1) { ?>
                                    <div class="fusion-text fusion-text-1"
                                        style="transform:translate3d(0,0,0); padding-left: 30px; padding-right: 30px;">
                                        <h3 style="">Localização</h3>
                                        <h5 style="color: black; width: 100%; margin-top: 0;"><i
                                                class="fas fa-map-marker-alt"></i>
                                            <?php echo esc_html($endereco_complemento); ?>
                                        </h5>
                                    </div>
                                    <iframe width="100%" height="450" style="border:0" loading="lazy" allowfullscreen
                                        referrerpolicy="no-referrer-when-downgrade"
                                        src="https://www.google.com/maps?q=<?php echo $lat; ?>,<?php echo $long; ?>&hl=pt&z=15&output=embed">
                                    </iframe>

                                <?php } ?>
                                <?php if ($geopos_visivel == 2) { ?>
                                    <div class="fusion-text fusion-text-1"
                                        style="transform:translate3d(0,0,0); padding-left: 30px; padding-right: 30px;">
                                        <h3 style="">Localização</h3>
                                        <h5 style="color: black; width: 100%; margin-top: 0;"><i
                                                class="fas fa-map-marker-alt"></i>
                                            <?php echo esc_html($endereco_complemento); ?>
                                        </h5>
                                    </div>
                                    <iframe width="100%" height="450" style="border:0" loading="lazy" allowfullscreen
                                        referrerpolicy="no-referrer-when-downgrade"
                                        src="https://www.google.com/maps?q=<?php echo $lat; ?>,<?php echo $long; ?>&hl=pt&z=15&output=embed">
                                    </iframe>

                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <style type="text/css">
                        .fusion-body .fusion-builder-column-<?php echo $j + 1 ?> {
                            width: 100% !important;
                            margin-top: 0px;
                            margin-bottom: 20px;
                        }

                        .fusion-builder-column-<?php echo $j + 1 ?>>.fusion-column-wrapper {
                            padding-top: 0px !important;
                            padding-right: 0px !important;
                            margin-right: 1.92%;
                            padding-bottom: 0px !important;
                            padding-left: 0px !important;
                            margin-left: 1.92%;
                        }

                        @media only screen and (max-width:1024px) {
                            .fusion-body .fusion-builder-column-<?php echo $j + 1 ?> {
                                width: 100% !important;
                                order: 0;
                            }

                            .fusion-builder-column-<?php echo $j + 1 ?>>.fusion-column-wrapper {
                                margin-right: 1.92%;
                                margin-left: 1.92%;
                            }
                        }

                        @media only screen and (max-width:640px) {
                            .fusion-body .fusion-builder-column-<?php echo $j + 1 ?> {
                                width: 100% !important;
                                order: 0;
                            }

                            .fusion-builder-column-<?php echo $j + 1 ?>>.fusion-column-wrapper {
                                margin-right: 1.92%;
                                margin-left: 1.92%;
                            }
                        }
                    </style>
                </div>
                <style type="text/css">
                    .fusion-body .fusion-flex-container.fusion-builder-row-10 {
                        padding-top: 0px;
                        margin-top: 0px;
                        padding-right: 0px;
                        padding-bottom: 0px;
                        margin-bottom: 0px;
                        padding-left: 0px;
                        width: 100%;
                    }
                </style>
            </div>
            <?php
            $images = get_post_meta($post->ID, 'galeria_imagens', false);
            if (!is_null($images)):
                $k = $j + 2;
                ?>

                <div class="fusion-fullwidth fullwidth-box fusion-builder-row-9 fusion-flex-container hundred-percent-fullwidth non-hundred-percent-height-scrolling"
                    style="background-color: rgba(255,255,255,0);background-position: center center;background-repeat: no-repeat;border-width: 0px 0px 0px 0px;border-color:#e2e2e2;border-style:solid;">
                    <div class="fusion-builder-row fusion-row fusion-flex-align-items-flex-start"
                        style="width:104% !important;max-width:104% !important;margin-left: calc(-4% / 2 );margin-right: calc(-4% / 2 );">
                        <div
                            class="fusion-layout-column fusion_builder_column fusion-builder-column-<?php echo $k ?> fusion_builder_column_1_1 1_1 fusion-flex-column">
                            <div class="fusion-column-wrapper fusion-flex-justify-content-flex-start fusion-content-layout-column"
                                style="background-position: left top; background-repeat: no-repeat; background-size: cover; padding: 0px; min-height: 0px;">

                                <div class="fusion-text fusion-text-1" style="transform:translate3d(0,0,0);">
                                    <h3>Fotos</h3>
                                </div>
                                <style type="text/css">
                                    .fusion-gallery-1 .fusion-gallery-image {
                                        border: 0px solid #e2e2e2;
                                        height: 300px;
                                    }

                                    .fusion-gallery-1 .fusion-gallery-image img {
                                        width: 100%;
                                        height: 100%;
                                        object-fit: cover;
                                        object-position: center;
                                    }
                                </style>
                                <div class="fusion-gallery fusion-gallery-container fusion-grid-3 fusion-columns-total-3 fusion-gallery-layout-grid fusion-gallery-1"
                                    style="margin: -5px; position: relative; display:flex; flex-wrap: wrap;">
                                    <?php $i = 1;
                                    $top = 0;
                                    $left = 0;
                                    foreach ($images as $image): ?>
                                        <div style="padding: 5px; display: block;"
                                            class="fusion-grid-column fusion-gallery-column fusion-gallery-column-<?php echo $i ?>">
                                            <div class="fusion-gallery-image fusion-gallery-image-liftup"><a
                                                    href="<?php echo $image; ?>" rel="noreferrer"
                                                    data-rel="iLightbox[gallery_image_1]" class="fusion-lightbox" target="_self"
                                                    data-caption=""><img fetchpriority="high" decoding="async"
                                                        src="<?php echo $image; ?>" width="1500" alt="" title="" aria-label=""
                                                        class="img-responsive wp-image-<?php echo $i ?>"
                                                        srcset="<?php echo $image; ?>"
                                                        sizes="(min-width: 1200px) 33vw, (min-width: 2200px) 100vw, (min-width: 784px) 617px, (min-width: 712px) 784px, (min-width: 640px) 712px, "></a>
                                            </div>
                                        </div>


                                        <?php
                                        $i++;
                                    endforeach; ?>
                                </div>
                            </div>
                        </div>
                        <style type="text/css">
                            .fusion-body .fusion-builder-column-<?php echo $k ?> {
                                width: 100% !important;
                                margin-top: 0px;
                                margin-bottom: 20px;
                            }

                            .fusion-builder-column-<?php echo $k ?>>.fusion-column-wrapper {
                                padding-top: 0px !important;
                                padding-right: 0px !important;
                                margin-right: 1.92%;
                                padding-bottom: 0px !important;
                                padding-left: 0px !important;
                                margin-left: 1.92%;
                            }

                            .fusion-gallery-column {
                                width: 33.333333333%;
                            }

                            @media only screen and (max-width:1024px) {
                                .fusion-gallery-column {
                                    width: 50%;
                                }

                                .fusion-body .fusion-builder-column-<?php echo $k ?> {
                                    width: 100% !important;
                                    order: 0;
                                }

                                .fusion-builder-column-<?php echo $k ?>>.fusion-column-wrapper {
                                    margin-right: 1.92%;
                                    margin-left: 1.92%;
                                }
                            }

                            @media only screen and (max-width:640px) {
                                .fusion-gallery-column {
                                    width: 100%;
                                }

                                .fusion-body .fusion-builder-column-<?php echo $k ?> {
                                    width: 100% !important;
                                    order: 0;
                                }

                                .fusion-builder-column-<?php echo $k ?>>.fusion-column-wrapper {
                                    margin-right: 1.92%;
                                    margin-left: 1.92%;
                                }
                            }
                        </style>
                    </div>

                    <style type="text/css">
                        .fusion-body .fusion-flex-container.fusion-builder-row-9 {
                            padding-top: 0px;
                            margin-top: 0px;
                            padding-right: 30px;
                            padding-bottom: 0px;
                            margin-bottom: 0px;
                            padding-left: 30px;
                            width: 100%;
                        }

                        .grids {
                            width: 100%;
                            display: grid;
                            grid-template-columns: repeat(2, 1fr);
                            gap: 20px;
                        }

                        .lidetalhe {
                            display: grid;
                            grid-template-columns: repeat(3, 1fr);
                            gap: 20px;
                            list-style-type: none;
                            padding: 0;
                        }

                        @media only screen and (max-width:800px) {
                            .lidetalhe {
                                display: flex;
                                flex-wrap: wrap;
                            }

                            .lidetalhe li {
                                width: 100%;
                            }

                            .grids {
                                display: flex;
                                flex-wrap: wrap;
                            }

                            .grids div {
                                width: 100%;
                            }
                        }
                    </style>
                </div>

            <?php endif; ?>

            <?php
            $j += 2;
        endwhile;
        ?>
    </div>
</div>

<?php
get_footer();