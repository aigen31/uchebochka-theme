<?php



// Adding a route with variable retrieval
add_action('init', function() {
    $author_route = uchebka_plugin()->page_routes()::PAGE_AUTHOR->path();

    add_rewrite_rule(
        "^$author_route/([^/]+)/?$",
        'index.php?pagename='+$author_route+'&user_login=$matches[1]',
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
            $user_wrapper = new \Uchebochka\User_Wrapper($user_login);
            $full_name = trim($user_wrapper->get_user_data()->first_name . ' ' . $user_wrapper->get_user_data()->last_name);
            $links[count($links) - 1]['text'] = $full_name;
        }catch(\Exception $e){
            
        }
    }
    return $links;
});
