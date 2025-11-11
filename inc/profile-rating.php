<?php
function array_first_value($array)
{
  return array_shift(array_values($array));
}

function rating_precent($rating_array)
{
  $total = count($rating_array);
  $filled = 0;

  foreach ($rating_array as $key => $value) {
    if (!empty($value)) {
      $filled++;
    }
  }

  return round(($filled / $total) * 100);
}

function rating_class($rating_percent)
{
  if ($rating_percent < 40) :
    return 'low';
  elseif ($rating_percent < 100) :
    return 'medium';
  else :
    return 'high';
  endif;
}

function get_rating_round_precent($rating_percent)
{
  if ($rating_percent < 40) :
    return 10;
  elseif ($rating_percent < 100) :
    return 50;
  else :
    return 100;
  endif;
}

function get_profile_fields($user_id)
{
  $um = get_user_meta($user_id);

  return [
    'last_name' => $um['last_name'] ? array_first_value($um['last_name']) : null,
    'description' => $um['description'] ? array_first_value($um['description']) : null,
    'profile_photo' => unserialize(array_first_value($um['um_member_directory_data']))['profile_photo'] ?? null,
    'gender' => $um['gender'] ? unserialize(array_first_value($um['gender'])) : null,
    'position' => $um['position'] ? array_first_value($um['position']) : null,
    'location' => $um['location'] ? array_first_value($um['location']) : null,
  ];
}

function get_profile_rating_comment($rating_class)
{
  switch ($rating_class) {
    case 'low':
      return '<span class="profile-rating__progress-highlight profile-rating__progress-highlight--low">Эх...</span> Будет мало продаж (';
    case 'medium':
      return '<span class="profile-rating__progress-highlight profile-rating__progress-highlight--medium">Ура!</span> Больше шансов, что купят!';
    case 'high':
      return '<span class="profile-rating__progress-highlight profile-rating__progress-highlight--high">Отлично!</span> Ваш материал точно захотят приобрести!';
    default:
      return '';
  }
}
