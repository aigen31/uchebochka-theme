<?php

namespace Uchebochka;
use WP_User;

/**
 * Summary of UserWrapper
 * The Class-Wrapper for Wordpress User
 * Provides convenient methods for retrieving user data and content.
 */
class UserWrapper{
    private ?WP_User $wp_user;
    private ?array $materials = null;

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
    public function getMaterials(): array{
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
    public function getMaterialCount(): int{
        return count($this->getMaterials());
    }

    /**
     * Summary of getUserData
     * Function for getting user fields, including additional meta fields
     * @return WP_User
     */
    public function getUserData(): WP_User{
        $this->wp_user->position = get_user_meta($this->wp_user->ID, 'position', true);
        $this->wp_user->education = get_user_meta($this->wp_user->ID, 'education', true);
        $this->wp_user->vkprofile = get_user_meta($this->wp_user->ID, 'vk_profile', true);
        $this->wp_user->tgprofile = get_user_meta($this->wp_user->ID, 'telegram_profile', true);
        return $this->wp_user;
    }
    
}

?>