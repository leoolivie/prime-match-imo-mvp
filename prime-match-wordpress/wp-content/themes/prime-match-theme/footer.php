<footer class="section">
    <div class="lux-container" style="display:flex; justify-content:space-between; flex-wrap:wrap; gap:1rem;">
        <div>
            <p style="letter-spacing:0.3em; text-transform:uppercase; font-size:0.8rem;">
                © <?php echo date('Y'); ?> Prime Match Imo
            </p>
            <p style="color:rgba(255,255,255,0.5); max-width:360px;">
                <?php esc_html_e('Tecnologia proprietária hospedada em WordPress, otimizada para ambientes compartilhados.', 'prime-match'); ?>
            </p>
        </div>
        <nav>
            <?php
            wp_nav_menu([
                'theme_location' => 'footer',
                'menu_class'     => 'nav nav--footer',
                'container'      => false,
                'fallback_cb'    => false,
            ]);
            ?>
        </nav>
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
