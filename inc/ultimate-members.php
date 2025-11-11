<?php

add_action('um_main_profile_fields', function () {
	if (!function_exists('um_profile_id')) return;

	$profile_user_id   = um_profile_id();
	$advanced_training = carbon_get_user_meta($profile_user_id, 'advanced_training') ?: [];
	$work_places       = carbon_get_user_meta($profile_user_id, 'work') ?: [];
	$is_editing        = UM()->fields()->editing;

	if ($is_editing) {
		$nonce = wp_create_nonce('um_cf_front_save_' . $profile_user_id);
	}
?>

	<div class="um-field um-custom-field cf-frontend-wrap">
		<?php if ($is_editing): ?>
			<input type="hidden" name="cf_front_nonce" value="<?= esc_attr($nonce) ?>">
		<?php endif; ?>

		<div class="cf-group" data-group="advanced_training">
			<div class="cf-group__head">
				<h3>Повышения квалификации</h3>
				<?php if ($is_editing): ?>
					<button type="button" class="btn btn--accent cf-add-training">Добавить</button>
				<?php endif; ?>
			</div>

			<?php if ($is_editing): ?>
				<div class="advanced-training-wrapper">
					<?php foreach ($advanced_training as $item):
						get_template_part('/template-parts/ultimate-members/advanced-training', '', [
							'name' => esc_attr($item['name'] ?? ''),
							'organization' => esc_attr($item['organization'] ?? ''),
							'year' => esc_attr($item['year'] ?? '')
						]);
					endforeach; ?>
				</div>
			<?php else: ?>
				<?php if ($advanced_training): ?>
					<ul class="cf-list-view">
						<?php foreach ($advanced_training as $item):
							$name = trim((string)($item['name'] ?? ''));
							$organization = trim((string)($item['organization'] ?? ''));
							$year = trim((string)($item['year'] ?? ''));
							$parts = array_filter([$name, $organization, $year ? "год: $year" : '']);
							if ($parts === '') continue; ?>
							<li><?= esc_html(implode(', ', $parts)) ?></li>
						<?php endforeach; ?>
					</ul>
				<?php else: ?>
					<p>Нет данных</p>
				<?php endif; ?>
			<?php endif; ?>
		</div>

		<div class="cf-group" data-group="work">
			<div class="cf-group__head">
				<h3>Места работы</h3>
				<?php if ($is_editing): ?>
					<button type="button" class="btn btn--accent cf-add-work">Добавить</button>
				<?php endif; ?>
			</div>

			<?php if ($is_editing): ?>
				<div class="work-wrapper">
					<?php foreach ($work_places as $item):
						get_template_part('/template-parts/ultimate-members/work-item', '', [
							'organization' => esc_attr($item['organization'] ?? ''),
							'specialization' => esc_attr($item['specialization'] ?? ''),
							'year' => esc_attr($item['year'] ?? ''),
							'experience' => esc_attr($item['experience'] ?? ''),
						]);
					endforeach; ?>
				</div>
			<?php else: ?>
				<?php if ($work_places): ?>
					<ul class="cf-list-view">
						<?php foreach ($work_places as $item):
							$company = trim((string)($item['organization'] ?? ''));
							$spec    = trim((string)($item['specialization'] ?? ''));
							$year    = trim((string)($item['year'] ?? ''));
							$exp     = trim((string)($item['experience'] ?? ''));
							$parts   = array_filter([$company, $spec, $year ? "год: $year" : '', $exp ? "стаж: $exp лет" : '']);
							if (!$parts) continue; ?>
							<li><?= esc_html(implode(', ', $parts)) ?></li>
						<?php endforeach; ?>
					</ul>
				<?php else: ?>
					<p>Нет данных</p>
				<?php endif; ?>
			<?php endif; ?>
		</div>

		<?php if ($is_editing):
			get_template_part('/template-parts/ultimate-members/templates', '');
		endif; ?>
	</div>
<?php
}, 101);


add_action('profile_update', function ($user_id, $old_user_data) {
	if ((int)$user_id !== get_current_user_id() && !current_user_can('edit_user', $user_id)) {
		return;
	}

	$has_training = isset($_POST['advanced_training']) && is_array($_POST['advanced_training']);
	$has_work     = isset($_POST['work']) && is_array($_POST['work']);

	if (!$has_training && !$has_work) {
		carbon_set_user_meta($user_id, 'work', []);
		carbon_set_user_meta($user_id, 'advanced_training', []);
		return;
	}

	if (empty($_POST['cf_front_nonce']) || !wp_verify_nonce($_POST['cf_front_nonce'], 'um_cf_front_save_' . $user_id)) {
		return;
	}

	$build_complex = function (array $src, array $keys) {
		$rows = [];
		$length = 0;
		foreach ($keys as $k) {
			if (!empty($src[$k]) && is_array($src[$k])) {
				$length = max($length, count($src[$k]));
			}
		}
		for ($i = 0; $i < $length; $i++) {
			$row = [];
			foreach ($keys as $k) {
				$val = $src[$k][$i] ?? '';
				$row[$k] = is_string($val) ? sanitize_text_field($val) : '';
			}

			$impl = implode('', $row);
			if ($impl === '') continue;
			$rows[] = $row;
		}
		return $rows;
	};

	$adv = isset($_POST['advanced_training']) ? $build_complex($_POST['advanced_training'], ['name', 'organization', 'year']) : [];
	carbon_set_user_meta($user_id, 'advanced_training', $adv);

	$work = isset($_POST['work']) ? $build_complex($_POST['work'], ['organization', 'specialization', 'year', 'experience']) : [];
	carbon_set_user_meta($user_id, 'work', $work);
}, 10, 2);

add_filter('um_profile_query_make_posts', 'urok_profile_custom_post_types', 10, 2);
function urok_profile_custom_post_types($args)
{
	$args['post_type'] = ['metodic_post', 'curses_post'];
	return $args;
}
