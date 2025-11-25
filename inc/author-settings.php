<?php


// Adding a route with variable retrieval
add_action('init', function() {
    add_rewrite_rule(
        '^o-sebe/([^/]+)/?$',
        'index.php?pagename=o-sebe&user_login=$matches[1]',
        'top'
    );
});

add_filter('query_vars', function($vars) {
    $vars[] = 'user_login';
    return $vars;
});

// Replacing breadcrumbs
add_filter('wpseo_breadcrumb_links', function($links) {
    $user_login = get_query_var('user_login'); 
    if ($user_login) {
        try{
            $userWrapper = new \Uchebochka\UserWrapper($user_login);
            $full_name = trim($userWrapper->getUserData()->first_name . ' ' . $userWrapper->getUserData()->last_name);
            $links[count($links) - 1]['text'] = $full_name;
        }catch(\Exception $e){
            
        }
    }
    return $links;
});
