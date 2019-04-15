<?php
/*
 * Template Name: Страница видео
 */

get_header(); ?>



    <div id="primary" class="content-area  page-media ">
        <div class="bredscrumb">
            <h1 class="page-title-main">
                <?php echo get_the_title(); ?>
            </h1>
        </div>
        <div class="container">
            <div class="row">

                <div class="start-content">
                     <?php
                     $query_count = new WP_Query( array('post_type' => 'media',    'meta_key' => 'type', 'meta_value' => 'video' ) );



                        $args = array(
                            'posts_per_page' => '10',
                            'post_type' => 'media',
                            'meta_key'		=> 'type',
                            'meta_value'	=> 'video',
                            'paged' => (get_query_var('paged')) ? get_query_var('paged') : 1
                        );

                        $the_query = new WP_Query($args);




                        ?>
                    <div class="row">
                    <ul class="cat-media">
                        <li >
                            <a href="/medias"  data-type="all">
                                <div class="media-img-block">
                                <img  class="media-main" src="<?php echo get_theme_file_uri('/assets/images/all.png') ?>"  alt="Картинка" />
                                <img  class="media-active" src="<?php echo get_theme_file_uri('/assets/images/all2.png') ?>"  alt="Картинка" />
                                </div>
                                <h3>
                                    Последние<br>
                                    файлы
                                </h3>
                            </a>
                        </li>
                         <li>
                             <a href="/gallery-media"  data-type="gallery" >
                                <div class="media-img-block">
                                <img  class="media-main" src="<?php echo get_theme_file_uri('/assets/images/gallery.png') ?>"  alt="Картинка" />
                                <img  class="media-active" src="<?php echo get_theme_file_uri('/assets/images/gallery2.png') ?>"  alt="Картинка" />
                                </div>
                                <h3>
                                    Фото
                                </h3>
                            </a>
                        </li>
                         <li class="active">
                             <a href="/video-media" data-type="video" >
                                <div class="media-img-block">
                                <img  class="media-main" src="<?php echo get_theme_file_uri('/assets/images/video.png') ?>"  alt="Картинка" />
                                <img  class="media-active" src="<?php echo get_theme_file_uri('/assets/images/video2.png') ?>"  alt="Картинка" />
                                </div>
                                <h3>
                                    Видео
                                </h3>
                            </a>
                        </li>
                    </ul>

                        <?php

                        if ($the_query->have_posts()) : ?>
                                <div class="list-media video-page">
                                    <div class="row">
                                <?php
                            $i =0;
                            while ($the_query->have_posts()) :
                                $the_query->the_post();
                                $post_id = $the_query->post->ID;

//                                    if($query_count->found_posts >= 6){
//
//                                        set_query_var( 'id',$i);
//                                        get_template_part('inc/video-media-masonry');
//
//                                    }else{
                                            $video = get_field('video');

                                            ?>
                                                <div  class="media-walp media-video-<?=$i; ?>  col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                    <div >
                                                        <a href="<?php the_permalink(); ?>" title="<?= __('ссылка на медиа', 'light'); ?>"  >
                                                            <img src="<?=  parse_youtube($video);?>"   alt="<?= get_the_title(); ?>" />
                                                            <div class="event-image-overlay"></div>
                                                            <h3 class="media-block-title">
                                                                <?= get_the_title(); ?>
                                                            </h3>
                                                            <div class="media-block-play"></div>
                                                        </a>


                                                    </div>


                                                </div>
                                    <?php
                                 //   }

                                    $i++;





                            endwhile;?>

                        <?php
                                //  bug with echo masonry
//                        if($query_count->found_posts >= 6) {
//                            echo '    </div>  </div>';
//                        }



                            echo ' </div> </div>';
                            $GLOBALS['wp_query'] = $the_query;
                            the_posts_pagination([
                                'show_all' => false,
                                'prev_text' => __('<', 'light'),
                                'next_text' => __('>', 'light'),
                                'end_size' => '2',     // количество страниц на концах
                                'mid_size' => '2',
                                'screen_reader_text' => __(' ', 'light'),
                            ]);
                        endif;
                        ?>


                </div>
            </div>
        </div>

    </div>

<?php get_footer();
