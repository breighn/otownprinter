<?php
/**
 * @package cshero
 */
global $cs_span,$masonry_filter;
$class='cs-masonry-layout-item '.$cs_span.' ';
if($masonry_filter){
	global $cs_cat_class;
	$class .= "category-".$cs_cat_class;
}
?>
<?php global $smof_data,$post; ?>
<article id="post-<?php the_ID(); ?>" <?php post_class($class); ?>>
	<div class="cs-blog row">
		
		<?php
			$video_source = get_post_meta($post->ID, 'cs_post_video_source', true);
			$video_height = get_post_meta($post->ID, 'cs_post_video_height', true);
			if($video_source):
				?>
				<div class="cs-blog-media">
				<?php
				switch ($video_source) {
					case 'post':
						$shortcode = cshero_get_shortcode_from_content('playlist');
						if(!$shortcode){
							$shortcode = cshero_get_shortcode_from_content('video');
						}
						if($shortcode):
							echo do_shortcode($shortcode);
						endif;
						break;
					case 'youtube':
						$video_youtube = get_post_meta($post->ID, 'cs_post_video_youtube', true);
						if($video_youtube){
							echo do_shortcode('[cs-video height="'.$video_height.'"]'.$video_youtube.'[/cs-video]');
						}
						break;
					case 'vimeo':
						$video_vimeo = get_post_meta($post->ID, 'cs_post_video_vimeo', true);
						if($video_vimeo){
							echo do_shortcode('[cs-video height="'.$video_height.'"]'.$video_vimeo.'[/cs-video]');
						}
						break;
					case 'media':
						$video_type = get_post_meta($post->ID, 'cs_post_audio_type', true);
						$preview_image = get_post_meta($post->ID, 'cs_post_preview_image', true);
						$video_file = get_post_meta($post->ID, 'cs_post_video_url', true);
						if($video_file){
							echo do_shortcode('[video height="'.$video_height.'" '.$video_type.'="'.$video_file.'" poster="'.$preview_image.'"][/video]');
						}
						break;
				}
				?>
				</div>
		<?php elseif (has_post_thumbnail() && ! post_password_required() && ! is_attachment()): ?>
			<div class="cs-blog-media">
				<div class="cs-blog-thumbnail ">
					<?php the_post_thumbnail('medium'); ?>
				</div><!-- .entry-thumbnail -->
				<?php echo  cshero_read_more_render(); ?>
			</div>
		<?php endif; ?>
		<header class="cs-blog-header">
			<?php echo cshero_title_render(); ?>
		</header><!-- .entry-header -->
	</div>
</article><!-- #post-## -->
