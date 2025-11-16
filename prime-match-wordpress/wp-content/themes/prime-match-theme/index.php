<?php get_header(); ?>
<main class="section">
    <div class="lux-container">
        <?php
        if (have_posts()) {
            while (have_posts()) {
                the_post();
                the_content();
            }
        } else {
            echo '<p>' . esc_html__('Nenhum conteúdo encontrado.', 'prime-match') . '</p>';
        }
        ?>
    </div>
</main>
<?php get_footer(); ?>
