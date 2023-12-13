<?php
$existingsThemeOptions = get_option( 'theme_mods_author-personal-blog' );
if (array_key_exists('social_links', $existingsThemeOptions)) {
    $existing_social_icons = $existingsThemeOptions['social_links'];
    $social_media_fields = array(
        'facebook' => 'Facebook',
        'twitter' => 'Twitter',
        'instagram' => 'Instagram',
        'tiktok' => 'Tiktok',
        'linkedin' => 'Linkedin',
        'pinterest' => 'Pinterest',
        'line' => 'Line',
        'github' => 'Github',
        'discord' => 'Discord',
        'youtube' => 'Youtube',
        'wordpress' => 'WordPress',
        'slack' => 'Slack',
        'apple' => 'Apple',
        'stack-overflow' => 'Stack-overflow',
        'kickstarer' => 'Kickstarer',
        'dribble' => 'Dribble',
        'codepen' => 'Codepen',
        'whatsapp' => 'Whatsapp',
        'medium' => 'Medium',
        'goodreads-g' => 'Goodreads'
    );

    foreach ( $existing_social_icons as $existing_link ) {
        foreach ( $social_media_fields as $field => $label ) {
            if (strpos($existing_link['social_link'], $field) !== false) {
                set_theme_mod( $field, $existing_link['social_link'] );
            }
        }
    }
    unset( $existingsThemeOptions['social_links'] );
    update_option( 'theme_mods_author-personal-blog', $existingsThemeOptions );
}
