<?php
/**
 * Template Name: Faq
 *
 */

get_header();

while ( have_posts() ) : the_post();
    $the_header = the_title('', '', false);
    $the_content = get_the_content();
endwhile;
?>

    <!--<section id="sub-header">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1 text-center">
                    <h2 style="text-decoration: underline;"><?php /*echo $the_header; */?></h2>
                    <div style="text-align: justify"><strong><?php /*echo $the_content; */?></strong></div>
                </div>
            </div>
        </div>
        <div class="divider_top"></div>
    </section>-->

    <section id="sub-header">
        <div class="container">
            <h3 style="text-align: center;"><?php echo $the_header; ?></h3>
            <hr/>
            <div style="text-align: justify"><strong><p><?php echo $the_content; ?></p></strong></div>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel-group" id="accordion">
                        <?php
                        $args = array( 'post_type' => 'faqs', 'numberposts' => -1, 'order' => 'ASC', 'post_status' => array('publish'), );
                        $loop = new WP_Query( $args );
                        $count = 0;
                        while ( $loop->have_posts() ) : $loop->the_post();
                            $count++;
                            ?>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $count?>"><strong><?php the_title() ?></strong><i class="indicator icon-plus pull-right"></i></a>
                                </h4>
                            </div>
                            <div id="collapse<?php echo $count?>" class="panel-collapse collapse">
                                <div class="panel-body"><strong style="color: #333333"><?php the_content() ?></strong></div>
                            </div>
                        </div>
                        <?php endwhile; ?>
                    </div>
                </div><!-- End col-md-8 -->
            </div>
        </div>
    </section>

<?php get_footer(); ?>