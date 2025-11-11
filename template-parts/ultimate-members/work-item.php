<div class="cf-item">
  <div class="cf-item__fields cf-grid">
    <label>Организация
      <input type="text" maxlength="255" name="work[organization][]" value="<?= $args['organization'] ?>" placeholder="Организация">
    </label>
    <label>Должность
      <input type="text" maxlength="255" name="work[specialization][]" value="<?= $args['specialization'] ?>" placeholder="Специальность">
    </label>
    <label>Год
      <input type="number" max="<?php echo date('Y') ?>" min="1900" name="work[year][]" value="<?= $args['year'] ?>" placeholder="Год">
    </label>
    <label>Стаж работы
      <input type="number" max="100" min="1" name="work[experience][]" value="<?= $args['experience'] ?>" placeholder="Стаж работы">
    </label>
  </div>
  <div class="cf-item__actions">
    <button type="button" class="btn btn--accent cf-up">↑</button>
    <button type="button" class="btn btn--accent cf-down">↓</button>
    <button type="button" class="btn btn--accent cf-remove">Удалить</button>
  </div>
</div>