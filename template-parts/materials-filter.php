<!-- FILTERS -->

<div class="section-materials__filter">
  <div class="filter-close mob">
    <img src="<?php // echo get_template_directory_uri(); 
              ?>/img/close.svg" alt="">
  </div>
  <form id="filter-form" method="get" class="filter-column">
    <?php
    $template = 'template-parts/terms';
    $args = [
      'taxonomy' => 'metodic_category',
      'max_visible' => 5,
    ];

    get_template_part('template-parts/terms', 'sidebar', array_merge($args, [
      'parent_id' => 2,
      'sidebar_id' => 1,
      'title' => 'Тип',
      'slug' => 'type',
    ]));

    get_template_part('template-parts/terms', 'sidebar', array_merge($args, [
      'parent_id' => 11,
      'sidebar_id' => 2,
      'title' => 'Категории',
      'slug' => 'category',
    ]));

    get_template_part('template-parts/terms', 'sidebar', array_merge($args, [
      'parent_id' => 20,
      'sidebar_id' => 3,
      'title' => 'Класс',
      'slug' => 'class',
    ]));
    ?>

    <!-- Фильтр по стоимости -->
    <div class="filter-section">
      <div class="filter-title">Стоимость</div>
      <div class="price-inputs">
        <div>
          <input type="number" id="min-price" name="min_price" placeholder="0" min="0" max="15000" value="<?php echo isset($_GET['min_price']) ? floatval($_GET['min_price']) : '0'; ?>"
            data-min="0" data-max="15000">
          <small class="text-muted">мин</small>
        </div>
        <div>
          <input type="number" id="max-price" name="max_price" placeholder="15000" min="0" max="15000" value="<?php echo isset($_GET['max_price']) ? floatval($_GET['max_price']) : '15000'; ?>"
            data-min="0" data-max="15000">
          <small class="text-muted">макс</small>
        </div>
      </div>
      <div class="price-slider">
        <input type="range" class="price-range" id="price-range" min="0" max="15000" step="100"
          value="<?php echo isset($_GET['max_price']) ? floatval($_GET['max_price']) : '15000'; ?>" data-min="0" data-max="15000">
      </div>
    </div>
    <!-- Кнопка применения фильтра -->
    <button class="apply-filter" type="submit">Применить фильтр</button>
  </form>
</div>

<!-- END FILTERS -->