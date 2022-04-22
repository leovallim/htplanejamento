<section class="header">
    <div class="header__cover">
        <img src="<?= get_template_directory_uri() ?>/dist/images/bg-main.jpg" alt="<?= $args['cover']['alt'] ?>" class="header__cover__image">
    </div>
    <div class="wrapper  header__info">
        <div class="container header__container">
            <img src="<?= get_template_directory_uri() ?>/dist/images/avatar.jpeg" alt="Logo da HT Comunicação" class="header__info__avatar">
            <?php if(get_queried_object(  )->post_title): ?><h1 class="title" style="text-align:center; font-size:1.5rem"><?= get_queried_object(  )->post_title ?></h1><?php endif; ?>
        </div>
    </div>
</section>