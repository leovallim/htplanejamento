<?php if(!empty($args['calendar'])): ?>
    <div class="calendar">
        <aside class="calendar__sidebar">
            <img src="<?= get_template_directory_uri() ?>/dist/images/logo-ht-comunicacao.png" alt="Logo HT Comunicação" class="calendar__sidebar__logo">
            <div class="calendar__sidebar__contianer">
                <h1 class="calendar__sidebar__title"><?= get_queried_object(  )->post_title; ?></h1>
            </div>
        </aside>
        <main class="calendar__main">
            <?php foreach($args['calendar'] as $i => $calendar): ?>
                <article id="calendarioo-<?= $i ?>" class="calendar__item">
                
                    <h2 class="calendar__item__title"><?= $calendar['mounth'] ?> - <?= get_queried_object(  )->post_title; ?></h2>
                    <div class="calendar__item__container">
                        <div class="calendar__item__detail">
                            <h3 class="calendar__item__subtitle">Para ficar de olho em <?= $calendar['mounth']; ?></h3>
                            <?php if(!empty($calendar['details'])): ?>
                                <?= wpautop($calendar['details']); ?>
                            <?php else: ?>
                                <p>Nenhuma nota cadastrada no período.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="calendar__item__dates">
                        <?php if(!empty($calendar['days'])): ?>
                            <?php foreach($calendar['days'] as $day): ?>
                                <div class="calendar__item__day">
                                    <h3 class="calendar__item__day__title">
                                        <?php 
                                            $date = new DateTime($day['date']);
                                            echo $date->format('d/m');
                                        ?>
                                    </h3>
                                    <?php if(!empty($day['events'])): ?>
                                        <?php foreach($day['events'] as $event): ?>
                                            <div class="calendar__item__day__event">
                                                <?= $event['event'] ?> <?= get_event_badges($event['type']); ?>
                                                <?= get_event_plans($event['plans']); ?>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>    
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    <div class="calendar__inline">
                        <?= get_inline_calendar($calendar['last_day'], $calendar['dates']) ?>
                    </div>
                </article>
            <?php endforeach; ?>
        </main>
    </div>
<?php else: ?>
    <section class="calendar__no-result">
        Nenhum item cadastrado ainda
    </section>
<?php endif; ?>