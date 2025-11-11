<?php

function get_customers_unresolved_ticket_count()
{
  if (class_exists('WPSC_Ticket')) {
    $cache_key = 'customers_unresolved_ticket_count_' . get_current_user_id();
    $cached = wp_cache_get($cache_key, 'support_candy');
    if ($cached !== false) {
      return $cached;
    }

    $filters = array('items_per_page' => 1);
    $more_settings = get_option('wpsc-tl-ms-agent-view');
    $current_user_id = get_current_user_id();
    global $wpdb;
    $customer_id = $wpdb->get_var(
      $wpdb->prepare(
        "SELECT id FROM {$wpdb->prefix}psmsc_customers WHERE user = %d",
        $current_user_id
      )
    );

    $filters = array(
      'items_per_page' => 1,
      'meta_query' => array(
        'relation' => 'AND',
        array(
          'slug'    => 'status',
          'compare' => 'IN',
          'val'     => $more_settings['unresolved-ticket-statuses'],
        ),
        array(
          'slug'    => 'customer',
          'compare' => '=',
          'val'     => $customer_id,
        ),
      ),
    );
    $response = WPSC_Ticket::find($filters);

    wp_cache_set($cache_key, $response['total_items'], 'support_candy', 60);

    return $response['total_items'];
  } else {
    throw new Exception('SupportCandy plugin is not active.');
  }
}

function the_customers_unresolved_ticket_count()
{
  try {
    echo get_customers_unresolved_ticket_count();
  } catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
  }
}

function the_unresolved_ticket_message()
{
  echo get_unresolved_ticket_message();
}

function get_unresolved_ticket_message()
{
  try {
    $count = get_customers_unresolved_ticket_count();
    if ($count > 0) {
      $result = sprintf('<b>Есть обращения</b> (%s)', $count);
    } else {
      $result = 'Сообщения';
    }
  } catch (Exception $e) {
    $result = 'Error: ' . $e->getMessage();
  }

  return $result;
}
