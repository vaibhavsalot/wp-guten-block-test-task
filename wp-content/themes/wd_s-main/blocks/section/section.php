<?php
/**
 * Section Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during backend preview render.
 * @param   int $post_id The post ID the block is rendering content against.
 *          This is either the post ID currently being displayed inside a query loop,
 *          or the post ID of the post hosting this block.
 * @param   array $context The context provided to the block by the post or it's parent block.
 */

// Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
	$anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'section-block';
if ( ! empty( $block['className'] ) ) {
	$class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
	$class_name .= ' align' . $block['align'];
}

// Load values and assign defaults.
$text = get_field( 'main_heading' ) ?: 'Your Gellry here...';

?>
<div <?php echo $anchor; ?>class="<?php echo esc_attr( $class_name ); ?>" >
	<div class="section-block-inn" >
		<?php if ( ! empty( $text ) ) : ?>
			<h1><?php echo esc_html( $text ); ?></h1>
		<?php endif; ?>
		<?php if ( have_rows( 'info_box_list' ) ) : ?>
		<div class="infobox-section">
			<ul class="infobox-items">
				<?php
				while ( have_rows( 'info_box_list' ) ) :
					the_row();
					$image            = get_sub_field( 'info_icon' );
					$info_title       = get_sub_field( 'info_title' );
					$info_description = get_sub_field( 'info_description' );
					$info_cta         = get_sub_field( 'info_cta' );
					if ( ! empty( $image ) || ! empty( $info_title ) || ! empty( $info_description ) ) :
						?>
					<li>
						<?php echo wp_get_attachment_image( $image, 'full' ); ?>
						<?php echo ( ! empty( $info_title ) ) ? '<h2>' . $info_title . '</h2>' : ' '; ?>
						<?php echo ( ! empty( $info_description ) ) ? '<p>' . $info_description . '</p>' : ''; ?>
						<?php
						if ( ! empty( $info_cta ) ) :
							$link_url    = $info_cta['url'];
							$link_title  = $info_cta['title'];
							$link_target = $info_cta['target'] ? $info_cta['target'] : '_self';
							?>
							<a class="button" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
						<?php endif; ?>
					</li>
					<?php endif; ?>
				<?php endwhile; ?>
				</div>
			</ul>
		<?php endif; ?>
	</div>
</div>
