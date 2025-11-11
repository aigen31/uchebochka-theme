<div class="cf-item">
  <div class="cf-item__fields cf-grid">
    <label>Название
      <input type="text" maxlength="255" name="advanced_training[name][]" value="<?= $args['name'] ?>" placeholder="Название">
    </label>
    <label>Организация или спикер
      <input type="text" maxlength="255" name="advanced_training[organization][]" value="<?= $args['organization'] ?>" placeholder="Организация или спикер">
    </label>
    <label>Год
      <input type="number" max="<?php echo date('Y') ?>" min="1900" name="advanced_training[year][]" value="<?= $args['year'] ?>" placeholder="Год">
    </label>
  </div>
  <div class="cf-item__actions">
    <button type="button" class="btn btn--accent cf-up">↑</button>
    <button type="button" class="btn btn--accent cf-down">↓</button>
    <button type="button" class="btn btn--accent cf-remove">Удалить</button>
  </div>
</div>