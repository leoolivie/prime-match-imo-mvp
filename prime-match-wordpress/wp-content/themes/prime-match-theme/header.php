<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<header class="section" style="padding-bottom:0;">
    <div class="lux-container" style="display:flex; justify-content:space-between; align-items:center; gap:1rem; flex-wrap:wrap;">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="logo" style="font-weight:600; letter-spacing:0.35em; text-transform:uppercase;">
            <?php bloginfo('name'); ?>
        </a>
        <nav>
            <?php
            wp_nav_menu([
                'theme_location' => 'primary',
                'menu_class'     => 'nav',
                'container'      => false,
                'fallback_cb'    => false,
            ]);
            ?>
        </nav>
    </div>
</header>
