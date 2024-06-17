<?php get_header(); // load header ?>

<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
<?php
$categories = get_the_category();
?>    

<section class="py-5">
    <div class="container px-5 my-5">
        <div class="row gx-5">
            <div class="col-lg-3">
                <div class="d-flex align-items-center mt-lg-5 mb-4">
                    <img class="img-fluid rounded-circle" src="<?php echo get_avatar_url(get_the_author_meta('ID'), array('size' => 50)); ?>" alt="..." />
                    <div class="ms-3">
                        <div class="fw-bold"><?php the_author(); ?></div>
                        <div class="text-muted">
                            <?php
                            $counter = 0;
                            foreach ($categories as $category) {
                                $counter++;
                                echo $category->name;
                                if ($counter != count($categories)) echo ', '; 
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <!-- Post content-->
                <article>
                    <!-- Post header-->
                    <header class="mb-4">
                        <!-- Post title-->
                        <h1 class="fw-bolder mb-1"><?php the_title(); ?></h1>
                        <!-- Post meta content-->
                        <div class="text-muted fst-italic mb-2"><?php the_time('F jS, Y'); ?></div>
                        <!-- Post categories-->
                        <?php
                        foreach ($categories as $category) {
                            echo '<a class="badge bg-secondary text-decoration-none link-light me-2" href="'.get_category_link($category->cat_ID).'">'.$category->name.'</a>';
                        }
                        ?>
                    </header>
                    <!-- Preview image figure-->
                    <figure class="mb-4"><img class="img-fluid rounded" src="<?php the_post_thumbnail_url(get_the_ID(), 'full'); ?>" alt="..." /></figure>
                    <!-- Post content-->
                    <section class="mb-5">
                        <?php the_content(); ?>
                    </section>
                </article>
            </div>
        </div>
    </div>
</section>

<?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); // load footer ?>
