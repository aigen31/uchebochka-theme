<template id="tpl-advanced-training-item">
  <div class="cf-item">
    <div class="cf-item__fields cf-grid">
      <label>Название
        <input type="text" maxlength="255" name="advanced_training[name][]" value="" placeholder="Название">
      </label>
      <label>Организация или спикер
        <input type="text" maxlength="255" name="advanced_training[organization][]" value="" placeholder="Организация или спикер">
      </label>
      <label>Год
        <input type="number" max="<?php echo date('Y') ?>" min="1900" name="advanced_training[year][]" value="" placeholder="Год">
      </label>
    </div>
    <div class="cf-item__actions">
      <button type="button" class="button cf-up">↑</button>
      <button type="button" class="button cf-down">↓</button>
      <button type="button" class="button cf-remove">Удалить</button>
    </div>
  </div>
</template>

<template id="tpl-work-item">
  <div class="cf-item">
    <div class="cf-item__fields cf-grid">
      <label>Организация
        <input type="text" maxlength="255" name="work[organization][]" value="" placeholder="Организация">
      </label>
      <label>Должность
        <input type="text" maxlength="255" name="work[specialization][]" value="" placeholder="Специальность">
      </label>
      <label>Год
        <input type="number" max="<?php echo date('Y') ?>" min="1900" name="work[year][]" value="" placeholder="Год">
      </label>
      <label>Стаж работы
        <input type="number" max="100" min="1" name="work[experience][]" value="" placeholder="Стаж работы">
      </label>
    </div>
    <div class="cf-item__actions">
      <button type="button" class="btn btn--accent cf-up">↑</button>
      <button type="button" class="btn btn--accent cf-down">↓</button>
      <button type="button" class="btn btn--accent cf-remove">Удалить</button>
    </div>
  </div>
</template>