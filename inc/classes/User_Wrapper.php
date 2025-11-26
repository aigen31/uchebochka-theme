<?php

namespace Uchebochka;
use WP_User;

/**
 * Summary of UserWrapper
 * The Class-Wrapper for Wordpress User
 * Provides convenient methods for retrieving user data and content.
 */
class User_Wrapper{
    private ?WP_User $wp_user;
    private ?array $materials = null;
    private ?array $meta = null;

    /**
     * Summary of __construct
     * Constructor accept user ID or login
     * @param string|int $user ID or Login of User
     * @throws \Exception if user not found
     */
    public function __construct(string|int $user)
    {
        if(is_int($user)){
            $wp_user = get_user_by('id', $user);
            if(!$wp_user){
                throw new \Exception("Пользователь с ID $user не найден!");
            }
            $this->wp_user = $wp_user;
        }else{
            $wp_user = get_user_by('login', $user);
            if(!$wp_user){
                throw new \Exception("Пользователь с логином $user не найден!");
            }
            $this->wp_user = $wp_user;
        }
    }

    /**
     * Summary of getMaterials
     * Function get all list posts with type metodic_post
     * It is cached to avoid making multiple queries to the database.
     * @return array - array or empty array materials
     */
    public function get_materials(): array{
        if($this->materials === null){
            $this->materials = get_posts([
                "author" => $this->wp_user->ID,
                'post_type' => 'metodic_post',
                'post_status' => 'publish'
            ]) ?: [];
        }
        return $this->materials;
        
    }
    
    /**
     * Summary of getMaterialCount
     * Get the number of user materials
     * @return int - number of posts
     */
    public function get_materials_count(): int{
        return count($this->get_materials());
    }

    /**
     * Summary of getUserData
     * Function for getting user fields, including additional meta fields
     * @return WP_User
     */
    public function get_user_data(): WP_User{
        if($this->meta === null){
            $this->meta = uchebka_plugin()->user_helper()->get_user_data($this->wp_user);
             foreach ($this->meta as $key => $value) { 
                $this->wp_user->$key = $value; 
            }
        }
        return $this->wp_user;
    }
    
}

?>