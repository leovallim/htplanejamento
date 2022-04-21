<footer id="footer" class="wrapper footer">
    <div class="container footer__container">
        <?php 
            /**
             * 
             * Logo
             * 
             */
        ?>
        <div class="footer__branding">
            <a href="<?= get_home_url() ?>" class="footer__branding__link">
            <?php     
                if($args['logo'] === null):
                    bloginfo( 'name' );
                else:
                    ?><img src="<?= $args['logo']['url'] ?>" alt="<?= $args['logo']['alt'] ?>" class="footer__branding__image"><?php
                endif;
                ?>
            </a>
            <?php if($args['info'] !== null): ?>
                <div class="footer__branding__info">
                    <?= $args['info']; ?>
                </div>    
            <?php endif; ?>
        </div>
        <?php 
            /**
             * 
             * Navegação
             * 
             */

             if( !empty($args['nav']) ):
        ?>
        <div class="footer__nav">
            <ul class="footer__nav__list">
                <?php foreach($args['nav'] as $nav): ?>
                    <li class="footer__nav__item">
                        <?= ht_acf_link($nav['ht_footer_nav_item'], array('class' => 'footer__nav__link') ) ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php 
            endif; 

            /**
             * 
             * Social
             * 
             */

             if( !empty($args['social']) ):
        ?>
        <div class="footer__social">
            <ul class="footer__social__list">
                <?php foreach($args['social'] as $social): ?>
                    <li class="footer__social__item">
                        <a href="<?= $social['url'] ?>" class="footer__social__link"><?= $social['icon'] ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php 
            endif;
            /**
             * 
             * Créditos
             * 
             */
        ?>
        <div class="footer__developer">
            <a href="https://htcomunicacao.com.br" target="_blank" class="footer__developer__link">
                <span class="footer__developer__text">Desenvolvido por</span> 
                <img src="<?= get_template_directory_uri() ?>/dist/images/logo-ht-comunicacao.png" class="footer__developer__image" alt="Desenvolvido por HT Comunicação">
            </a>
        </div>
    </div>
</footer>