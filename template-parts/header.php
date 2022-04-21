<header class="header header__toggle">
    <div class="container heaader__container">
        <?php 
            /**
             * 
             *  Controle do menu
             * 
             */
        ?>
        <div class="header__control" data-action="menu"><i class="fa-solid fa-bars"></i> <span class="header__control__label">Menu</span></div>
        <?php 
            /**
             * 
             *  Logo do site
             * 
             */
        ?>
        <div class="header__logo">
            <a href="<?= get_home_url() ?>" class="header__logo__link">
                <?php     
                if($args['logo'] === null):
                    bloginfo( 'name' );
                else:
                    ?><img src="<?= $args['logo']['url'] ?>" alt="<?= $args['logo']['alt'] ?>" class="header__logo__image"><?php
                endif;
                ?>
            </a>
        </div>
        <?php 
            /**
             * 
             *  CTA do cabeçalho
             * 
             */
        ?>
        <div class="header__cta">
            <?php if($args['cta'] !== null): ?>
                <a href="<?= $args['cta']['url'] ?>" target="<?= $args['cta']['target'] ?? '_self'; ?>" class="header__cta__button"><?= $args['cta']['title'] ?></a>
            <?php endif; ?>
        </div>
        <?php 
            /**
             * 
             *  Container da navegação principal
             * 
             */
        ?>
        <div class="header__content">
            <i class="fa-solid fa-xmark header__control__close" data-action="menu"></i>
            <?php 
                /**
                 * 
                 *  Navegação principal
                 * 
                 */
            ?>
            <?php if($args['nav'] !== null): ?>
            <nav class="header__nav">
                <ul class="header__nav__list">
                    <?php foreach($args['nav'] as $nav): ?>
                        <li class="header__nav__item">
                            <a href="<?= $nav['ht_header_nav_item']['url'] ?>" class="header__nav__link" target="<?= $nav['ht_header_nav_item']['target'] ?? '_self' ?>"><?= $nav['ht_header_nav_item']['title'] ?></a>
                        </li>
                    <?php endforeach; ?>
                    <?php 
                    /**
                     * 
                     *  CTA na navegação principal
                     * 
                     */
                    ?>
                    <?php if($args['cta'] !== null): ?>
                        <li class="header__nav__item header__nav__item--cta">
                            <a href="<?= $args['cta']['url'] ?>" class="header__nav__link header__nav__link--cta" target="<?= $args['cta']['target'] ?? '_self' ?>"><?= $args['cta']['title'] ?></a>
                        </li>

                    <?php endif; ?>
                </ul>
            </nav>
            <?php endif; ?>

            <?php 
                /**
                 * 
                 *  Botões de redes sociais
                 * 
                 */
            ?>
            <?php if($args['social']): ?>
                <div class="header__social">
                    <ul class="header__social__list">
                    <?php foreach($args['social'] as $social): ?>
                        <li class="header__social__item">
                            <a href="<?= $social['url'] ?>" class="header__social__link"><?= $social['icon'] ?></a>
                        </li>
                    <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
        </div>
    </div>
</header>