<?php
/**
 * Getting Started Help Notic
 **/
function author_personal_blog_general_admin_notice(){
?>
<div data-dismissible="disable-done-notice-forever" class="notice notice-info author-personal-blog-welcome-notice">
    <div class="author-personal-blog-notice-wrapper">
        <div class="author-personal-blog-notice-inner">
            <div class="notice-thumbnail-col">
              <img src="<?php echo esc_url(get_theme_file_uri('assets/img/author-portfolio-pro-thumb.png'));?>" alt="<?php esc_attr_e('Author Portfolio Pro', 'author-personal-blog');?>">
            </div>
            <div class="notice-content-col">
              <h3>
               <?php esc_html_e('Thank you for installing the Author Personal Blog WordPress Theme.', 'author-personal-blog'); ?>
              </h3>
              <p class="notice-desc">
              <?php esc_html_e('Ready to create a stunning author website? Click the Install Starter Author Website Templates button, and you\'ll be redirected to our demo page to get started.', 'author-personal-blog'); ?>
              </p>
              <p>
              <a class="author-personal-blog-btn-get-started button button-primary author-personal-blog-button-padding" href="#" data-name="" data-slug="">
                <?php esc_html_e( 'Install Starter Author Website Templates', 'author-personal-blog' );?>
              </a>
              <a target="_blank" href="<?php echo esc_url('https://rswpthemes.com/documentations/');?>" class="button button-highlight btn-doc button-primary" style="color:#fff;">
                <span style="margin-top:4px;margin-right:5px;" class="dashicons dashicons-video-alt3"></span>
                <?php esc_html_e( ' Video Documentation', 'author-personal-blog' );?>
            </a>
            <a target="_blank" href="<?php echo esc_url(author_personal_blog_utm_url('welcome_notice'));?>" class="button button-highlight upgrade-to-pro button-primary">
                <?php esc_html_e( 'Upgrade To Pro', 'author-personal-blog' );?>
            </a>
            <a href="?author_personal_blog_notice_dismissed" style="text-decoration: none; float: right;">
              <?php esc_html_e( 'Dismiss Notice', 'author-personal-blog' );?>
            </a>
            </p>
            </div>
        </div>
    </div>
</div>
<?php
}

if ( isset( $_GET['author_personal_blog_notice_dismissed'] ) ){
   update_option('author_personal_blog_help_notice', 'notice_author_personal_blog_dismissed');
   set_transient('apb_welcome_notice_dismissed_time', time(), 2 * 60 * 60);
}

add_action('admin_init', function(){
    $author_personal_blog_help_notice = get_option('author_personal_blog_help_notice', '');
    if('notice_author_personal_blog_dismissed' === $author_personal_blog_help_notice) {
        $dismissed_time = get_transient('apb_welcome_notice_dismissed_time');
        if (false === $dismissed_time || time() > $dismissed_time + ( 2 * 60 * 60 )) {
            delete_option('author_personal_blog_notice_dismissed');
            delete_transient('apb_welcome_notice_dismissed_time');
            add_action('admin_notices', 'author_personal_blog_general_admin_notice');
        }
    }
});

$author_personal_blog_help_notice = get_option('author_personal_blog_help_notice', '');
if (($author_personal_blog_help_notice != 'notice_author_personal_blog_dismissed' || $author_personal_blog_help_notice === '') ){
   add_action('admin_notices', 'author_personal_blog_general_admin_notice');
}