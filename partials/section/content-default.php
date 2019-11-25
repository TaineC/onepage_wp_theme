<?php
    $slug = get_post_field('post_name');
?>

<section class="resume-section p-3 p-lg-5 d-flex flex-column <?php the_field('css_classes')?>" id="<?php echo $slug ?>">
        <div class="my-auto">
          <h2 class="mb-5"><?php the_title() ?></h2>
          <p class="mb-0"><?php the_content() ?></p>
        </div>
      </section>

      <hr class="m-0">