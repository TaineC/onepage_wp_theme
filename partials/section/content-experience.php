<?php
    $slug = get_post_field('post_name');
?>

<section class="resume-section p-3 p-lg-5 d-flex flex-column <?php the_field('css_classes')?>" id="<?php echo $slug ?>">
        <div class="my-auto">
          <h2 class="mb-5"><?php the_title() ?></h2>
        </div>
          <?php
              $args = array('post_type' => 'experience');
              $the_query = new WP_Query( $args );
                        
              while ( $the_query->have_posts() ) {
                $the_query->the_post();

                // echo '<p>'.get_the_title().'<p>';
                get_template_part('partials/experiences/content','default');
              }
              wp_reset_postdata();
            ?>
        </div>
      </section>

      <hr class="m-0">