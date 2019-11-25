<?php
    $slug = get_post_field('post_name');
?>

<section class="resume-section p-3 p-lg-5 d-flex d-column" id="about">
        <div class="my-auto">
          <h1 class="mb-0"><?php the_field('first_name')?>
            <span class="text-primary"><?php the_field('last_name')?></span>
          </h1>
          <div class="subheading mb-5"><?php the_field('address')?>
            <a href="mailto:name@email.com"><?php the_field('email')?></a>
          </div>
          <p class="lead mb-5">I am experienced in leveraging agile frameworks to provide a robust synopsis for high level overviews. Iterative approaches to corporate strategy foster collaborative thinking to further the overall value proposition.</p>
          <!-- social media icons -->

          <?php echo do_shortcode('[social-media]') ?>
        </div>
      </section>

      <hr class="m-0">