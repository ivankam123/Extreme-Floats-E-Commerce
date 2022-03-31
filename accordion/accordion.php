<?php
/**
* Accordion Block Template.
*
* @param   array $block The block settings and attributes.
* @param   string $content The block inner HTML (empty).
* @param   bool $is_preview True during AJAX preview.
* @param   (int|string) $post_id The post ID this block is saved to.
*/

// Create id attribute allowing for custom "anchor" value.
$id = 'accordion-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'accordion';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $class_name .= ' align' . $block['align'];
}
?>

<?php if ( have_rows( 'accordion' ) ) : ?>

    <style type="text/css">
        #<?php echo $id; ?> {
            background: <?php the_field( 'accordion_background_color' ); ?>;
            border: 3px solid <?php the_field( 'accordion_border_color' ); ?>;
            color: <?php the_field( 'accordion_text_color' ); ?>;
        }
        #<?php echo $id; ?> .accordion-button {
            background: <?php the_field( 'accordion_background_color' ); ?>;
        }
    </style>

    <?php while ( have_rows( 'accordion' ) ) : ?>
        <?php the_row(); ?>
        <div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $class_name ); ?>">
            <h3>
                <button class="accordion-button">
                    <?php if ( get_sub_field( 'accordion_title' ) ) : ?>
                        <span class="accordion-title"><?php the_sub_field( 'accordion_title' ); ?></span>
                    <?php endif; ?>
                    <span class="accordion-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><title><?php _e( 'Plus' ); ?></title><path d="M24 10h-10v-10h-4v10h-10v4h10v10h4v-10h10z"/></svg></span>
                </button>
            </h3>
            <?php if ( get_sub_field( 'accordion_title' ) ) : ?>
                <div class="accordion-text"><?php the_sub_field( 'accordion_text' ); ?></div>
            <?php endif; ?>
        </div>
    <?php endwhile; ?>

<?php endif; ?>