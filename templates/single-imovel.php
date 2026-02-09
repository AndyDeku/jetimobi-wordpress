<?php

get_header(); ?>

<style>
    main,
    main>.fusion-row {
        max-width: 100% !important;
        width: 100% !important;
        padding-left: 0 !important;
        padding-top: 0 !important;
        padding-right: 0 !important;
    }
    input, select, textarea{
        border: none!important;
        border-bottom: 1px solid black!important;
        background-color: transparent!important;
        color: black!important;
        border-radius: 0px!important;
    }
    input::placeholder { color: black; }
    input::-webkit-input-placeholder { color: black; }
    input:-ms-input-placeholder { color: black; }
    input::-ms-input-placeholder { color: black; }
    textarea::placeholder { color: black!important; }
    textarea::-webkit-input-placeholder { color: black!important; }
    textarea:-ms-input-placeholder { color: black!important; }
    textarea::-ms-input-placeholder { color: black!important; }

    .post-content {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;
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
            $images = get_post_meta($post->ID, 'galeria_imagens', false);
            $endereco_complemento = get_post_meta($post->ID, 'endereco_complemento', true);
            $terms = wp_get_post_terms($post->ID, 'cidade');
            $cidade = $description = $image_url =$city_slug = "";
            
            if (!empty($terms) && !is_wp_error($terms)) {
                $term = $terms[0]; // pega o primeiro termo (se tiver mais de um, ajuste aqui)
        
                // ID do termo
                $term_id = $term->term_id;

                // Nome da cidade
                $cidade = $term->name;

    $city_slug = $term->slug;
                // Descrição da cidade
                $description = $term->description;

                // Caso esteja salvo como link direto (sem attachment)
                $image_url = get_term_meta($term_id, 'term_image', true);
            }
            $fifu_image_url = get_post_meta($post->ID, 'fifu_image_url', true);
            ?>
            <div class="fusion-fullwidth fullwidth-box fusion-builder-row-007 fusion-flex-container hundred-percent-fullwidth non-hundred-percent-height-scrolling fusion-sticky-container"
                style="background-color: rgb(255, 255, 255); background-position: center center; background-repeat: no-repeat; border-width: 0px 0px 1px; border-color: rgb(0, 0, 0); border-style: solid; width:100%;"
                data-transition-offset="0" data-scroll-offset="0" data-sticky-small-visibility="1"
                data-sticky-medium-visibility="1" data-sticky-large-visibility="1" data-sticky_kit="true">
                <div class="fusion-builder-row fusion-row fusion-flex-align-items-center fusion-flex-justify-content-center"
                    style="width:104% !important; margin-left: calc(-4% / 2 );margin-right: calc(-4% / 2 );">
                    <div
                        class="fusion-layout-column fusion_builder_column fusion-builder-column-00<?php echo $j ?>  fusion_builder_column_4_5 4_5 fusion-flex-column">
                        <div class="fusion-column-wrapper fusion-flex-justify-content-flex-start fusion-content-layout-column"
                            style="background-position: left top; background-repeat: no-repeat; background-size: cover; padding: 0px; min-height: 0px;">
                            <style type="text/css">
                                @media only screen and (max-width:1024px) {
                                    .fusion-title.fusion-title-1 {
                                        margin-top: 10px !important;
                                        margin-bottom: 0px !important;
                                    }
                                }

                                @media only screen and (max-width:640px) {
                                    .fusion-title.fusion-title-1 {
                                        margin-top: 10px !important;
                                        margin-bottom: 10px !important;
                                    }
                                }
                            </style>
                            <div class="fusion-title title fusion-title-1 fusion-sep-none fusion-title-text fusion-title-size-three fusion-border-below-title"
                                style="margin-top:10px;margin-bottom:0px;">
                                <div class="flex-button-sticky">
                                    <div>
                                        <style type="text/css">
                                            .fusion-button.button-1 .fusion-button-text,
                                            .fusion-button.button-1 i {
                                                color: #ffffff;
                                            }

                                            .fusion-button.button-1 .fusion-button-icon-divider {
                                                border-color: #ffffff;
                                            }

                                            .fusion-button.button-1:hover .fusion-button-text,
                                            .fusion-button.button-1:hover i,
                                            .fusion-button.button-1:focus .fusion-button-text,
                                            .fusion-button.button-1:focus i,
                                            .fusion-button.button-1:active .fusion-button-text,
                                            .fusion-button.button-1:active {
                                                color: #ffffff;
                                            }

                                            .fusion-button.button-1:hover .fusion-button-icon-divider,
                                            .fusion-button.button-1:hover .fusion-button-icon-divider,
                                            .fusion-button.button-1:active .fusion-button-icon-divider {
                                                border-color: #ffffff;
                                            }

                                            .fusion-button.button-1:hover,
                                            .fusion-button.button-1:focus,
                                            .fusion-button.button-1:active {
                                                border-color: #ffffff;
                                            }

                                            .fusion-button.button-1 {
                                                border-color: #ffffff;
                                                border-radius: 4px;
                                            }

                                            .fusion-button.button-1 {
                                                background: #e94e1a;
                                                width: 100%;
                                                padding: 13px 0px !important;
                                                height: 100%;
                                                display: flex;
                                                justify-content: center;
                                                align-items: center;
                                            }

                                            .fusion-button.button-1:hover,
                                            .button-1:focus,
                                            .fusion-button.button-1:active {
                                                background: rgba(233, 78, 26, 0.73);
                                            }
                                        </style>
                                        <a class="fusion-button button-flat fusion-button-default-size button-custom button-1 fusion-button-default-span fusion-button-default-type"
                                            target="_self" href="/imovel"><i
                                                class="fa-angle-left fas" aria-hidden="true"></i></a>
                                    </div>
                                    <div>
                                        <h5 class="title-heading-left" style="margin:0;color:#000000;">
                                            <?php echo the_title(); ?>
                                        </h5>
                                        <p style="margin:0;"><?php echo $endereco_complemento; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <style type="text/css">
                        .fusion-body .fusion-builder-column-00<?php echo $j ?> {
                            width: 80% !important;
                            margin-top: 0px;
                            margin-bottom: 0px;
                        }

                        .fusion-builder-column-00<?php echo $j ?>>.fusion-column-wrapper {
                            padding-top: 0px !important;
                            padding-right: 0px !important;
                            margin-right: 2.4%;
                            padding-bottom: 0px !important;
                            padding-left: 0px !important;
                            margin-left: 2.4%;
                        }

                        .flex-button-sticky div:first-child {
                            width: 10%;
                            padding: 10px;
                        }

                        .flex-button-sticky div:last-child {
                            width: 90%;
                            padding: 10px;
                        }


                        @media only screen and (max-width:1024px) {
                            .fusion-body .fusion-builder-column-00<?php echo $j ?> {
                                width: 80% !important;
                                order: 0;
                            }

                            .fusion-builder-column-00<?php echo $j ?>>.fusion-column-wrapper {
                                margin-right: 2.4%;
                                margin-left: 2.4%;
                            }
                        }

                        @media only screen and (max-width:900px) {

                            .flex-button-sticky div:first-child {
                                width: 15%;
                            }

                            .flex-button-sticky div:last-child {
                                width: 85%;
                            }
                        }

                        @media only screen and (max-width:640px) {
                            .fusion-body .fusion-builder-column-00<?php echo $j ?> {
                                width: 100% !important;
                                order: 0;
                            }

                            .flex-button-sticky div:first-child {
                                width: 100%;
                            }

                            .flex-button-sticky div:last-child {
                                width: 100%;
                            }

                            .fusion-body .fusion-builder-column-00<?php echo $j ?>h5,
                            .fusion-body .fusion-builder-column-00<?php echo $j ?>p {
                                text-align: center !important;
                            }

                            .fusion-builder-column-00<?php echo $j ?>>.fusion-column-wrapper {
                                margin-right: 1.92%;
                                margin-left: 1.92%;
                            }
                        }
                    </style>
                    <div
                        class="fusion-layout-column fusion_builder_column fusion-builder-column-10<?php echo $j ?>  fusion_builder_column_1_5 1_5 fusion-flex-column">
                        <div class="fusion-column-wrapper fusion-flex-justify-content-flex-start fusion-content-layout-column"
                            style="background-position: left top; background-repeat: no-repeat; background-size: cover; padding: 0px; min-height: 0px;">
                            <style type="text/css">
                                @media only screen and (max-width:1024px) {
                                    .fusion-title.fusion-title-2 {
                                        margin-top: 0px !important;
                                        margin-bottom: 0px !important;
                                    }
                                }

                                @media only screen and (max-width:640px) {
                                    .fusion-title.fusion-title-2 {
                                        margin-top: 0px !important;
                                        margin-bottom: 0px !important;
                                    }
                                }
                            </style>
                            <div class="fusion-title title fusion-title-2 fusion-sep-none fusion-title-text fusion-title-size-three fusion-border-below-title"
                                style="margin-top:10px;margin-bottom:0px;">
                                <?php if (!is_null($valor_venda) && $venda > 0) {
                                    if (get_post_meta($post->ID, 'valor_venda_visivel', true) == '1') { ?>
                                        <h5 class="title-heading-left" style="margin:0;color:#000000; text-align: right;">
                                            <?php echo number_format($valor_venda, 2, ',', '.'); ?>
                                        </h5>
                                    <?php } else { ?>
                                        <h5 class="title-heading-left" style="margin:0;color:#000000; text-align: right;">
                                            Consulte
                                            Valores</h5>
                                    <?php }
                                } ?>
                                <?php if (!is_null($valor_locacao) && $locacao > 0) {
                                    if (get_post_meta($post->ID, 'valor_locacao_visivel', true) == '1') { ?>
                                        <h5 class="title-heading-left" style="margin:0;color:#000000; text-align: right;">
                                            <?php echo number_format($valor_locacao, 2, ',', '.'); ?>
                                        </h5>
                                    <?php } else { ?>
                                        <h5 class="title-heading-left" style="margin:0;color:#000000; text-align: right;">
                                            Consulte
                                            Valores</h5>
                                    <?php }
                                } ?>

                                <?php if (!is_null($valor_temporada) && $temporada > 0) {
                                    if (get_post_meta($post->ID, 'valor_temporada_visivel', true) == '1') { ?>
                                        <h5 class="title-heading-left" style="margin:0;color:#000000; text-align: right;">
                                            <?php echo number_format($valor_temporada, 2, ',', '.'); ?>
                                        </h5>
                                    <?php } else { ?>
                                        <h5 class="title-heading-left" style="margin:0;color:#000000; text-align: right;">
                                            Consulte
                                            Valores</h5>
                                    <?php }
                                } ?>
                            </div>
                            <div class="fusion-text fusion-text-1" style="transform:translate3d(0,0,0);">
                                <p style="margin:0; text-align: right;">Ref <?php echo $codigo ?></p>
                            </div>
                        </div>
                    </div>
                    <style type="text/css">
                        .fusion-body .fusion-builder-column-10<?php echo $j ?> {
                            width: 20% !important;
                            margin-top: 0px;
                            margin-bottom: 0px;
                        }

                        .fusion-builder-column-10<?php echo $j ?>>.fusion-column-wrapper {
                            padding-top: 0px !important;
                            padding-right: 0px !important;
                            margin-right: 9.6%;
                            padding-bottom: 0px !important;
                            padding-left: 0px !important;
                            margin-left: 9.6%;
                        }

                        .flex-button-sticky {
                            display: flex;
                            flex-wrap: wrap;
                        }


                        @media only screen and (max-width:1024px) {
                            .fusion-body .fusion-builder-column-10<?php echo $j ?> {
                                width: 20% !important;
                                order: 0;
                            }

                            .fusion-builder-column-10<?php echo $j ?>>.fusion-column-wrapper {
                                margin-right: 9.6%;
                                margin-left: 9.6%;
                            }
                        }

                        @media only screen and (max-width:640px) {
                            .fusion-body .fusion-builder-column-10<?php echo $j ?> {
                                width: 100% !important;
                                order: 0;
                            }

                            .fusion-body .fusion-builder-column-10<?php echo $j ?>h5,
                            .fusion-body .fusion-builder-column-10<?php echo $j ?>p {
                                text-align: center !important;
                            }

                            .fusion-builder-column-10<?php echo $j ?>>.fusion-column-wrapper {
                                margin-right: 1.92%;
                                margin-left: 1.92%;
                            }
                        }
                    </style>
                </div>
                <style type="text/css">
                    .fusion-body .fusion-flex-container.fusion-builder-row-007 {
                        padding-top: 10px;
                        margin-top: 0px;
                        padding-right: 30px;
                        padding-bottom: 10px;
                        margin-bottom: 0px;
                        padding-left: 30px;
                    }

                    .fusion-body .fusion-flex-container.fusion-builder-row-007>.fusion-builder-row {
                        max-width: 1300px !important;
                    }
                </style>
            </div>
            <div class="fusion-fullwidth fullwidth-box fusion-builder-row-7 fusion-flex-container hundred-percent-fullwidth non-hundred-percent-height-scrolling"
                style="background-color: rgba(255,255,255,0);background-position: center center;background-repeat: no-repeat;border-width: 0px 0px 0px 0px;border-color:#e2e2e2;border-style:solid; margin-top: 30px;">
                <div class="fusion-builder-row fusion-row fusion-flex-align-items-flex-start"
                    style="width:104% !important;max-width:104% !important;margin-left: calc(-4% / 2 );margin-right: calc(-4% / 2 );">
                    <div
                        class="fusion-layout-column fusion_builder_column fusion-builder-column-<?php echo $j ?> fusion_builder_column_1_1 1_1 fusion-flex-column">
                        <div class="fusion-column-wrapper fusion-flex-justify-content-flex-start fusion-content-layout-column"
                            style="background-position: left top; background-repeat: no-repeat; background-size: cover; padding: 0px; min-height: 0px;">
                            <div class="fusion-text fusion-text-1" style="transform:translate3d(0,0,0);">
                                <div class="detalhe">
                                    <ul class="lidetalhe">

                                        <?php if (!is_null($dorms) && $dorms > 0) { ?>
                                            <li style="margin-left: 10px; margin-right: 10px;"
                                                title="<?php echo $dorms; ?> Quartos">
                                                <div>
                                                    <i class="fas fa-bed"></i>
                                                </div>
                                                <div>
                                                    <p><strong><?php echo $dorms; ?></strong></p>
                                                    <p>Quartos</p>
                                                </div>
                                            </li>
                                        <?php } ?>
                                        <?php if (!is_null($suites) && $suites > 0) { ?>
                                            <li style="margin-left: 10px; margin-right: 10px;"
                                                title="<?php echo $suites; ?> Suítes">
                                                <div>
                                                    <i class="fas fa-door-open"></i>
                                                </div>
                                                <div>
                                                    <p><strong><?php echo $suites; ?></strong></p>
                                                    <p>Suítes</p>
                                                </div>
                                            </li>
                                        <?php } ?>
                                        <?php if (!is_null($banheiros) && $banheiros > 0) { ?>
                                            <li style="margin-left: 10px; margin-right: 10px;"
                                                title="<?php echo $banheiros ?> Banheiros">
                                                <div>
                                                    <i class="fas fa-bath"></i>
                                                </div>
                                                <div>
                                                    <p><strong><?php echo $banheiros; ?></strong></p>
                                                    <p>Banheiros</p>
                                                </div>
                                            </li>
                                        <?php } ?>
                                        <?php if (!is_null($vagas) && $vagas > 0) { ?>
                                            <li style="margin-left: 10px; margin-right: 10px;"
                                                title="<?php echo $vagas; ?> Vagas de Garagem">
                                                <div>
                                                    <i class="fas fa-car"></i>
                                                </div>
                                                <div>
                                                    <p><strong><?php echo $vagas; ?></strong></p>
                                                    <p>Vagas</p>
                                                </div>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                    <div class="grids2">
                                        <div class="button-fotos">
                                            <style type="text/css">
                                                .fusion-button.button-2 .fusion-button-text,
                                                .fusion-button.button-2 i {
                                                    color: #ffffff;
                                                }

                                                .fusion-button.button-2 .fusion-button-icon-divider {
                                                    border-color: #ffffff;
                                                }

                                                .fusion-button.button-2:hover .fusion-button-text,
                                                .fusion-button.button-2:hover i,
                                                .fusion-button.button-2:focus .fusion-button-text,
                                                .fusion-button.button-2:focus i,
                                                .fusion-button.button-2:active .fusion-button-text,
                                                .fusion-button.button-2:active {
                                                    color: #ffffff;
                                                }

                                                .fusion-button.button-2:hover .fusion-button-icon-divider,
                                                .fusion-button.button-2:hover .fusion-button-icon-divider,
                                                .fusion-button.button-2:active .fusion-button-icon-divider {
                                                    border-color: #ffffff;
                                                }

                                                .fusion-button.button-2:hover,
                                                .fusion-button.button-2:focus,
                                                .fusion-button.button-2:active {
                                                    border-color: #ffffff;
                                                }

                                                .fusion-button.button-2 {
                                                    border-color: #ffffff;
                                                    border-radius: 4px;
                                                }

                                                .fusion-button.button-2 {
                                                    background: #e94e1a;
                                                    width: 100%;
                                                    padding: 13px 0px;
                                                }

                                                .fusion-button.button-2:hover,
                                                .button-2:focus,
                                                .fusion-button.button-2:active {
                                                    background: rgba(233, 78, 26, 0.73);
                                                }
                                            </style>
                                            <a class="fusion-button button-flat fusion-button-default-size button-custom button-2 fusion-button-default-span fusion-button-default-type"
                                                target="_self" href="#fotos"><i class="fa-image fas button-icon-left"
                                                    aria-hidden="true"></i><span class="fusion-button-text">Fotos</span></a>
                                        </div>
                                        <div class="button-fotos">
                                            <style type="text/css">
                                                .fusion-button.button-3 .fusion-button-text,
                                                .fusion-button.button-3 i {
                                                    color: #ffffff;
                                                }

                                                .fusion-button.button-3 .fusion-button-icon-divider {
                                                    border-color: #ffffff;
                                                }

                                                .fusion-button.button-3:hover .fusion-button-text,
                                                .fusion-button.button-3:hover i,
                                                .fusion-button.button-3:focus .fusion-button-text,
                                                .fusion-button.button-3:focus i,
                                                .fusion-button.button-3:active .fusion-button-text,
                                                .fusion-button.button-3:active {
                                                    color: #ffffff;
                                                }

                                                .fusion-button.button-3:hover .fusion-button-icon-divider,
                                                .fusion-button.button-3:hover .fusion-button-icon-divider,
                                                .fusion-button.button-3:active .fusion-button-icon-divider {
                                                    border-color: #ffffff;
                                                }

                                                .fusion-button.button-3:hover,
                                                .fusion-button.button-3:focus,
                                                .fusion-button.button-3:active {
                                                    border-color: #ffffff;
                                                }

                                                .fusion-button.button-3 {
                                                    border-color: #ffffff;
                                                    border-radius: 4px;
                                                }

                                                .fusion-button.button-3 {
                                                    background: #e94e1a;
                                                    width: 100%;
                                                    padding: 13px 0px;
                                                }

                                                .fusion-button.button-3:hover,
                                                .button-3:focus,
                                                .fusion-button.button-3:active {
                                                    background: rgba(233, 78, 26, 0.73);
                                                }
                                            </style>
                                            <a class="fusion-button button-flat fusion-button-default-size button-custom button-3 fusion-button-default-span fusion-button-default-type"
                                                target="_self" href="#localizacao"><i
                                                    class="fa-map-marker-alt fas button-icon-left"
                                                    aria-hidden="true"></i><span
                                                    class="fusion-button-text">Localização</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="text-align:center;">
                                <span class=" fusion-imageframe imageframe-none imageframe-1 hover-type-none"
                                    style="margin-top:20px;margin-bottom:20px;">
                                    <img fetchpriority="high" decoding="async" title="maceio-full"
                                        src="<?php echo $fifu_image_url ?>" class="img-responsive wp-image-4905" style="max-width: 100%; width: auto; height: 600px;">
                                </span>
                            </div>

                        </div>
                    </div>

                    <style type="text/css">
                        .texto-container {
                            max-height: 8em;
                            /* ~5 linhas (5 * 1.5em) */
                            overflow: hidden;
                            line-height: 1.5em;
                            transition: max-height 0.6s ease-in-out;
                            /* bem suave */
                        }

                        .texto-container.expandido {
                            max-height: 3000px;
                            /* valor grande para expandir */
                        }

                        .ver-toggle {
                            cursor: pointer;
                            display: inline-block;
                            margin-top: 8px;
                            position: relative;
                            transition: color 0.3s ease;
                            --tw-text-opacity: 1;
                            color: rgb(133 133 133 / var(--tw-text-opacity, 1));
                            transition: all 0.9s ease;
                        }

                        .ver-toggle::after {
                            content: "";
                            position: absolute;
                            left: 0;
                            bottom: -2px;
                            width: 100%;
                            height: 2px;
                            background: blue;
                            transform: scaleX(0);
                            transform-origin: left;
                            transition: transform 0.3s ease;
                        }

                        .ver-toggle:hover::after {
                            transform: scaleX(1);
                        }

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
                        max-width: 1300px;
                        width: 100%;
                        padding-right: 30px;
                        padding-bottom: 0px;
                        margin-bottom: 0px;
                        padding-left: 30px;
                    }
                </style>
            </div>
            <div class="fusion-fullwidth fullwidth-box fusion-builder-row-2<?php echo $j ?> fusion-flex-container textcontainer nonhundred-percent-fullwidth non-hundred-percent-height-scrolling"
                style="background-color: rgba(255,255,255,0);background-position: center center;background-repeat: no-repeat;border-width: 0px 0px 0px 0px;border-color:#e2e2e2;border-style:solid; width: 100%; z-index: 2;">
                <div class="fusion-builder-row fusion-row fusion-flex-align-items-flex-start"
                    style="max-width:1352px;margin-left: calc(-4% / 2 );margin-right: calc(-4% / 2 );">
                    <div
                        class="fusion-layout-column fusion_builder_column fusion-builder-column-2<?php echo $j ?> fusion_builder_column_2_3 2_3 fusion-flex-column">
                        <div class="fusion-column-wrapper fusion-flex-justify-content-flex-start fusion-content-layout-column"
                            style="background-position: left top; background-repeat: no-repeat; background-size: cover; padding: 0px; min-height: 0px;">
                            <div class="fusion-text fusion-text-1" style="transform:translate3d(0,0,0);">
                                <h3>Descrição</h3>

                                <div class="container-texto">
                                    <div class="texto-container" id="texto">
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
                                    </div>
                                    <span class="ver-toggle" id="toggle" style="display:none;">Ver mais</span>
                                </div>
                                <h3>Informações</h3>
                                <?php if ((!is_null($area_total) && $area_total > 0) || (!is_null($area_util) && $area_util > 0)) { ?>
                                    <h3>Áreas</h3>
                                    <div class="areas">
                                        <?php if (!is_null($area_total) && $area_total > 0) { ?>
                                            <div class="area">
                                                <i class="fas fa-vector-square"></i>
                                                <div class="medicao">
                                                    <strong><?php echo $area_total; ?>m²</strong>
                                                </div>
                                                <div class="textoarea">Área Total</div>
                                            </div>
                                        <?php } ?>
                                        <?php if (!is_null($area_util) && $area_util > 0) { ?>
                                            <div class="area">
                                                <i class="fas fa-vector-square"></i>
                                                <div class="medicao">
                                                    <strong><?php echo $area_util; ?>m²</strong>
                                                </div>
                                                <div class="textoarea">Área Útil</div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                                <h3>Características</h3>
                                <?php
                                $caracteristicas = get_post_meta($post->ID, 'caracteristicas');
                                echo '<ul class="styles grids">';
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
                                <?php if ($description != "") { ?>
                                    <div class="cidadelocalizacao">
                                        <?php if ($image_url != "") { ?>
                                            <div class="imgcidade"
                                                style="background: url(<?php echo esc_url($image_url) ?>); background-repeat: no-repeat; background-position: center; background-size: cover">
                                            </div>
                                        <?php } ?>
                                        <div class="description">
                                            <h3><?php echo $cidade ?></h3>
                                            <p><?php echo $description ?></p>
                                            <a class="ver-toggle" href="/cidade/<?php echo $city_slug ?>"><strong>VER LOCALIZAÇÃO</strong></a>
                                        </div>
                                    </div>
                                <?php } ?>

                            </div>
                        </div>
                    </div>
                    <style type="text/css">
                        .fusion-body .fusion-builder-column-2<?php echo $j ?> {
                            width: 66.666666666667% !important;
                            margin-top: 0px;
                            margin-bottom: 20px;
                        }

                        .cidadelocalizacao {
                            display: flex;
                            flex-wrap: wrap;
                            width: 100%;
                            background: #e2e2e2;
                            border-radius: 10px;
                            margin-top: 20px;
                            margin-bottom: 20px;
                        }

                        .imgcidade {
                            width: 30%;
                            border-top-left-radius: 10px;
                            border-bottom-left-radius: 10px;
                            min-height: 200px;
                        }

                        .description {
                            width: 70%;
                            padding: 20px 30px;
                        }

                        .description h3 {
                            margin-top: 0;
                            margin-bottom: 7px;
                        }

                        .fusion-builder-column-2<?php echo $j ?>>.fusion-column-wrapper {
                            padding-top: 0px !important;
                            padding-right: 0px !important;
                            margin-right: 2.88%;
                            padding-bottom: 0px !important;
                            padding-left: 0px !important;
                            margin-left: 2.88%;
                        }

                        @media only screen and (max-width:1024px) {
                            .fusion-body .fusion-builder-column-2<?php echo $j ?> {
                                width: 66.666666666667% !important;
                                order: 0;
                            }

                            .fusion-builder-column-2<?php echo $j ?>>.fusion-column-wrapper {
                                margin-right: 2.88%;
                                margin-left: 2.88%;
                            }
                        }

                        @media only screen and (max-width:820px) {
                            .imgcidade {
                                width: 100%;
                                border-top-left-radius: 10px;
                                border-top-right-radius: 10px;
                            }

                            .description {
                                width: 100%;
                                padding: 20px 30px;
                            }

                            .fusion-body .fusion-builder-column-2<?php echo $j ?> {
                                width: 100% !important;
                                order: 0;
                            }

                            .fusion-builder-column-2<?php echo $j ?>>.fusion-column-wrapper {
                                margin-right: 1.92%;
                                margin-left: 1.92%;
                            }
                        }
                    </style>
                    <div
                        class="fusion-layout-column fusion_builder_column fusion-builder-column-3<?php echo $j ?> formulariocontato fusion_builder_column_1_3 1_3 fusion-flex-column">
                        <div class="fusion-column-wrapper fusion-flex-justify-content-flex-start fusion-content-layout-column"
                            style="background-position: left top; background-repeat: no-repeat; background-size: cover; background-color: transparent; border-radius: 10px; overflow: hidden; padding: 20px 30px 30px 20px; min-height: 0px;">
                            <style type="text/css">
                                @media only screen and (max-width:1024px) {
                                    .fusion-title.fusion-title-3<?php echo $j ?> {
                                        margin-top: 10px !important;
                                        margin-bottom: 15px !important;
                                    }
                                }

                                @media only screen and (max-width:640px) {
                                    .fusion-title.fusion-title-3<?php echo $j ?> {
                                        margin-top: 10px !important;
                                        margin-bottom: 10px !important;
                                    }
                                }
                            </style>
                            <div class="fusion-title title fusion-title-3<?php echo $j ?> fusion-sep-none fusion-title-text fusion-title-size-four fusion-border-below-title"
                                style="margin-top:10px;margin-bottom:15px;">
                                <h4 class="title-heading-left md-text-align-center sm-text-align-center"
                                    style="margin:0;color:black;">
                                    <div class="body-lg flex items-center font-headline font-bold text-blue-150">Deseja
                                        saber mais?
                                    </div>
                                </h4>
                            </div>
                            <div class="wpcf7 js" id="wpcf7-f14064-p796-o1" lang="pt-BR" dir="ltr" data-wpcf7-id="14064">
                                <div class="screen-reader-response">
                                    <p role="status" aria-live="polite" aria-atomic="true"></p>
                                    <ul></ul>
                                </div>
                                <form action="/teste#wpcf7-f14064-p796-o1" method="post" class="wpcf7-form init"
                                    aria-label="Formulários de contato" novalidate="novalidate" data-status="init">
                                    <fieldset class="hidden-fields-container"><input type="hidden" name="_wpcf7"
                                            value="14064"><input type="hidden" name="_wpcf7_version" value="6.1.1"><input
                                            type="hidden" name="_wpcf7_locale" value="pt_BR"><input type="hidden"
                                            name="_wpcf7_unit_tag" value="wpcf7-f14064-p796-o1"><input type="hidden"
                                            name="_wpcf7_container_post" value="796"><input type="hidden"
                                            name="_wpcf7_posted_data_hash" value="">
                                    </fieldset>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p><label><span class="wpcf7-form-control-wrap" data-name="your-name"><input
                                                            size="40" maxlength="400"
                                                            class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required formcontatocoopercon"
                                                            autocomplete="name" aria-required="true" aria-invalid="false"
                                                            placeholder="Nome" value="" type="text" name="your-name"></span>
                                                </label>
                                            </p>
                                        </div>
                                        <div class="col-md-12">
                                            <p><label><span class="wpcf7-form-control-wrap" data-name="your-email"><input
                                                            size="40" maxlength="400"
                                                            class="wpcf7-form-control wpcf7-email wpcf7-validates-as-required wpcf7-text wpcf7-validates-as-email"
                                                            autocomplete="email" aria-required="true" aria-invalid="false"
                                                            placeholder="E-mail" value="" type="email"
                                                            name="your-email"></span>
                                                </label>
                                            </p>
                                        </div>
                                        <div class="col-md-12">
                                            <p><label><span class="wpcf7-form-control-wrap" data-name="tel"><input size="40"
                                                            maxlength="400"
                                                            class="wpcf7-form-control wpcf7-tel wpcf7-text wpcf7-validates-as-tel"
                                                            aria-invalid="false" placeholder="(99) 99999-9999" value=""
                                                            type="tel" name="tel"></span> </label>
                                            </p>
                                        </div>
                                        <input class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"
                                            aria-required="true" aria-invalid="false" placeholder="Assunto"
                                            value="<?php echo the_title(); ?>" type="hidden" name="your-subject" />
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p><label><span class="wpcf7-form-control-wrap"
                                                        data-name="your-message"><textarea cols="40" rows="10"
                                                            maxlength="2000"
                                                            class="wpcf7-form-control wpcf7-textarea wpcf7-validates-as-required"
                                                            aria-required="true" aria-invalid="false"
                                                            placeholder="Digite aqui sua mensagem"
                                                            name="your-message"></textarea></span> </label>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p><button class="wpcf7-form-control wpcf7-submit has-spinner w-100"
                                                    type="submit" value="" style="color: white; background: rgba(233, 78, 26); width: 100%;">ENVIAR</button>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="fusion-alert alert custom alert-custom fusion-alert-center wpcf7-response-output alert-dismissable"
                                        style="border-width:1px;"><button type="button" class="close toggle-alert"
                                            data-dismiss="alert" aria-hidden="true">×</button>
                                        <div class="fusion-alert-content-wrapper"><span class="fusion-alert-content"></span>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <style type="text/css">
                        .fusion-body .fusion-builder-column-3<?php echo $j ?> {
                            width: 33.333333333333% !important;
                            margin-top: 0px;
                            margin-bottom: 20px;
                        }

                        .fusion-builder-column-3<?php echo $j ?>>.fusion-column-wrapper {
                            padding-top: 20px !important;
                            padding-right: 30px !important;
                            margin-right: 5.76%;
                            padding-bottom: 30px !important;
                            padding-left: 20px !important;
                            margin-left: 5.76%;
                        }

                        @media only screen and (max-width:1024px) {
                            .fusion-body .fusion-builder-column-3<?php echo $j ?> {
                                width: 33.333333333333% !important;
                                order: 0;
                            }

                            .fusion-builder-column-3<?php echo $j ?>>.fusion-column-wrapper {
                                margin-right: 5.76%;
                                margin-left: 5.76%;
                            }
                        }

                        @media only screen and (max-width:820px) {
                            .fusion-body .fusion-builder-column-3<?php echo $j ?> {
                                width: 100% !important;
                                order: 0;
                            }

                            .fusion-builder-column-3<?php echo $j ?>>.fusion-column-wrapper {
                                margin-right: 1.92%;
                                margin-left: 1.92%;
                            }
                        }
                    </style>
                </div>
                <style type="text/css">
                    .fusion-body .fusion-flex-container.fusion-builder-row-2<?php echo $j ?> {
                        padding-top: 0px;
                        margin-top: 0px;
                        padding-right: 30px;
                        padding-bottom: 0px;
                        margin-bottom: 0px;
                        padding-left: 30px;
                    }
                </style>
            </div>
            <div class="fusion-fullwidth fullwidth-box fusion-builder-row-10 fusion-flex-container nonhundred-percent-fullwidth non-hundred-percent-height-scrolling"
                style="background-color: rgba(255,255,255);background-position: center center;background-repeat: no-repeat;border-width: 0px 0px 0px 0px;border-color:#e2e2e2;border-style:solid; z-index: 2000; width: 100%;">
                <div class="fusion-builder-row fusion-row fusion-flex-align-items-flex-start"
                    style="width:104% !important;max-width:1352px !important;margin-left: calc(-4% / 2 );margin-right: calc(-4% / 2 );">
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

                                //if($geopos_visivel > 0){ 
                                ?>


                                <?php if ($geopos_visivel == 1) { ?>
                                    <div class="fusion-text fusion-text-1"
                                        style="transform:translate3d(0,0,0); padding-left: 30px; padding-right: 30px;"
                                        id="localizacao">
                                        <h3 style="">Descubra o seu novo bairro</h3>
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
                                        style="transform:translate3d(0,0,0); padding-left: 30px; padding-right: 30px;"
                                        id="localizacao">
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
                        padding-right: 30px;
                        padding-bottom: 0px;
                        margin-bottom: 0px;
                        padding-left: 30px;
                    }
                </style>
            </div>
            <?php
            if (!is_null($images)):
                $k = $j + 2;
                ?>

                <div class="fusion-fullwidth fullwidth-box fusion-builder-row-9 fusion-flex-container hundred-percent-fullwidth non-hundred-percent-height-scrolling"
                    id="fotos"
                    style="background-color: rgba(255,255,255);background-position: center center;background-repeat: no-repeat;border-width: 0px 0px 0px 0px;border-color:#e2e2e2;border-style:solid; z-index: 2000; width:100%">
                    <div class="fusion-builder-row fusion-row fusion-flex-align-items-flex-start"
                        style="width:104% !important;max-width:1352px !important;margin-left: calc(-4% / 2 );margin-right: calc(-4% / 2 );">
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
                        }

                        .grids {
                            width: 100%;
                            display: grid;
                            grid-template-columns: repeat(2, 1fr);
                            gap: 20px;
                        }

                        .grids2 {
                            display: grid;
                            grid-template-columns: repeat(2, 1fr);
                            gap: 20px;
                        }

                        .areas {
                            width: 100%;
                            display: grid;
                            grid-template-columns: repeat(2, 1fr);
                            gap: 20px;
                        }

                        .wpcf7 .wpcf7-form.sent .wpcf7-response-output {
                            background-color: #12b878 !important;
                            border: 1px solid #12b878 !important;
                            color: white !important;
                        }

                        .area {
                            display: flex;
                            flex-wrap: wrap;
                            width: 100%;
                            justify-content: center;
                            align-items: center;
                            background: rgb(148, 148, 148, 0.61);
                            padding: 30px 10px;
                            border-radius: 10px;
                        }

                        .area i{
                            font-size: 40px;
                        }
                        .area i,
                        .area div {
                            width: 100%;
                            text-align: center;
                        }

                        .area i,
                        .area .medicao {
                            font-weight: bold;
                        }

                        .lidetalhe {
                            display: grid;
                            grid-template-columns: repeat(4, 1fr);
                            gap: 20px;
                            list-style-type: none;
                            padding: 0;
                            width: 60%;
                            margin-top: 0px;
                        }

                        .detalhe {
                            display: flex;
                            flex-wrap: wrap;
                            justify-content: space-between;
                            width: 100%;
                        }

                        .lidetalhe li {
                            display: flex;
                            flex-wrap: wrap;
                            justify-content: center;
                            align-items: center;
                        }

                        .lidetalhe li i {
                            margin-right: 5px;
                            font-size: 40px;
                        }
                        .lidetalhe li div{
                            width: 50%;
                        }
                        .lidetalhe li p{
                            margin-bottom: 0!important;
                            line-height: 1;
                        }

                        @media only screen and (max-width:983px) {
                            .lidetalhe, .grids2 {
                                width: 100%;
                            }
                        }


                        @media only screen and (max-width:800px) {
                            .lidetalhe li, .grids li {
                                width: 100%;
                            }
                            .grids,
                            .areas,
                            {
                                display: flex;
                                flex-wrap: wrap;
                                width: 100%;
                            }

                            .grids div {
                                width: 100%;
                            }
                        }

                        @media only screen and (max-width:640px) {

                            .lidetalhe li div:first-child{
                                width: 20%;
                            }
                            .lidetalhe li div:last-child{
                                width: 80%;
                            }
                            .grids2,  .lidetalhe  {
                                display: flex;
                                flex-wrap: wrap;
                                width: 100%;
                            }
                            .lidetalhe li,
                            .lidetalhe,
                            .button-fotos {
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
<script>
    window.addEventListener('scroll', function () {
        if (window.innerWidth >= 900) {
            const textContainer = document.querySelector('.textcontainer');
            const form = document.querySelector('.formulariocontato');

            if (!textContainer || !form) return;

            const rect = textContainer.getBoundingClientRect();
            const top = rect.top + window.scrollY;
            const bottom = rect.bottom + window.scrollY;

            // Calcula a posição da borda esquerda do textcontainer
            const right = rect.right + window.scrollX;

            // Verifica se o scroll atual está dentro do range da .textcontainer
            if (window.scrollY >= top && window.scrollY <= bottom) {
                form.classList.add(
                    'non-hundred-percent-height-scrolling',
                    'fusion-container-stuck',
                    'fusion-sticky-transition'
                );
                form.style.position = 'fixed';
                form.style.bottom = '32px';
                if (window.innerWidth > 1725) {
                    form.style.right = '278px';
                    form.style.setProperty('width', '23%', 'important');
                } else if (window.innerWidth <= 1725 && window.innerWidth >= 1577) {
                    form.style.right = '190px';
                    form.style.setProperty('width', '26%', 'important');
                } else if (window.innerWidth <= 1577 && window.innerWidth >= 1424) {
                    form.style.right = '52px';
                    form.style.setProperty('width', '30%', 'important');
                } else {
                    form.style.right = '0px';
                    form.style.width = '';
                }
            } else {
                form.classList.remove(
                    'non-hundred-percent-height-scrolling',
                    'fusion-container-stuck',
                    'fusion-sticky-transition'
                );
                form.style.position = '';
                form.style.bottom = '';
                form.style.right = '';
                form.style.width = '';
            }
        }
    });

    window.addEventListener('scroll', function () {
        if (window.innerWidth >= 900) {
            document.querySelectorAll('.fusion-sticky-container').forEach(function (el) {
                if (window.scrollY > 0) {
                    el.classList.add(
                        'non-hundred-percent-height-scrolling',
                        'fusion-container-stuck',
                        'fusion-sticky-transition'
                    );
                    el.style.position = 'fixed';
                    el.style.top = '32px';
                } else {
                    el.classList.remove(
                        'non-hundred-percent-height-scrolling',
                        'fusion-container-stuck',
                        'fusion-sticky-transition'
                    );
                    el.style.position = '';
                    el.style.top = '';
                }
            });
        }
    });
    document.addEventListener("DOMContentLoaded", function () {
        const texto = document.getElementById("texto");
        const toggle = document.getElementById("toggle");

        if (!texto || !toggle) return;

        // Clonar o texto para medir altura real
        const clone = texto.cloneNode(true);
        clone.style.maxHeight = "none";
        clone.style.visibility = "hidden";
        clone.style.position = "absolute";
        clone.style.height = "auto";
        clone.style.whiteSpace = "normal"; // garante que quebras de linha sejam respeitadas
        document.body.appendChild(clone);

        const fullHeight = clone.offsetHeight;
        const lineHeight = parseFloat(getComputedStyle(texto).lineHeight);

        const limitedHeight = lineHeight * 5; // altura de 5 linhas

        // Mostra ou oculta o toggle baseado na altura do texto
        if (fullHeight > limitedHeight) {
            toggle.style.display = "inline-block";
        } else {
            toggle.style.display = "none";
        }

        document.body.removeChild(clone);

        // Toggle "Ver mais / Ver menos"
        toggle.addEventListener("click", function () {
            if (texto.classList.contains("expandido")) {
                texto.classList.remove("expandido");
                toggle.textContent = "Ver mais";
            } else {
                texto.classList.add("expandido");
                toggle.textContent = "Ver menos";
            }
        });
    });
</script>
<?php
get_footer();