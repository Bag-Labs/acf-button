<?php
/**
 * ACF Button for ACF v5
 *
 * @package acf-button
 */

// exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// check if class already exists.
if ( ! class_exists( 'acf_field_button' ) ) :

	/**
	 * Class ACF_Button_Field
	 *
	 * @package acf-button
	 */
	class ACF_Button_Field extends acf_field {

		/**
		 *  Function __construct
		 *
		 *  This function will setup the field type data
		 *
		 *  @type    function
		 *  @date    5/09/2016
		 *  @since   1.0.0
		 *  @since   1.7.0 Added rel and anchor to button options.
		 *
		 *  @param   $settings (array) the $settings array.
		 *  @return  void
		 */
		public function __construct( $settings ) {
			/*
			*  name (string) Single word, no spaces. Underscores allowed
			*/
			$this->name = 'button';

			/*
			*  label (string) Multiple words, can include spaces, visible when selecting a field type
			*/
			$this->label = __( 'Button', 'acf-button' );

			/*
			*  category (string) basic | content | choice | relational | jquery | layout | CUSTOM GROUP NAME.
			*/
			$this->category = 'basic';

			/*
			*  defaults (array) Array of default settings which are merged into the field object. These are used later in settings.
			*/
			$this->defaults = array(
				'default_text'   => '',
				'allow_advanced' => array(
					'type',
					'target',
					'color',
				),
				'default_target' => '',
				'default_color'  => 'primary',
				'default_size'   => '',
				'default_style'  => '',
				'default_type'   => 'post',
			);

			/*
			*  l10n (array) Array of strings that are used in JavaScript. This allows JS strings to be translated in PHP and loaded via:
			*  var message = acf._e('button', 'error');
			*/
			$this->l10n = array(
				'error' => __( 'Error! Please enter a higher value', 'acf-button' ),
			);

			// settings (array) Store plugin settings (url, path, version) as a reference for later use with assets.
			$this->settings = $settings;

			// do not delete!
			parent::__construct();

		}


		/**
		 *  Function render_field_settings()
		 *
		 *  Create extra settings for your field. These are visible when editing a field
		 *
		 *  @type    action
		 *  @since   1.0.0
		 *  @since   1.7.0 Added rel and anchor to button options.
		 *  @date    23/01/13
		 *
		 *  @param   $field (array) the $field being edited.
		 *  @return  void
		 */
		public function render_field_settings( $field ) {

			/**
			 *  Function acf_render_field_setting
			 *
			 *  This function will create a setting for your field. Simply pass the $field parameter and an array of field settings.
			 *  The array of settings does not require a `value` or `prefix`; These settings are found from the $field array.
			 *
			 *  More than one setting can be added by copy/paste the above code.
			 *  Please note that you must also have a matching $defaults value for the field name (font_size)
			 */
			acf_render_field_setting(
				$field, array(
					'label'        => __( 'Allow Advanced Options', 'acf-button' ),
					'instructions' => __( 'Display advanced button options (size, color, style and target)', 'acf-button' ),
					'type'         => 'checkbox',
					'name'         => 'allow_advanced',
					'choices'      => array(
						'type'   => __( 'Type', 'acf-button' ),
						'target' => __( 'Target', 'acf-button' ),
						'color'  => __( 'Color', 'acf-button' ),
						'size'   => __( 'Size', 'acf-button' ),
						'style'  => __( 'Style', 'acf-button' ),
						'class'  => __( 'Class', 'acf-button' ),
						'anchor' => __( 'Anchor', 'acf-button' ),
						'rel'    => __( 'Relationship (rel attribute)', 'acf-button' ),
					),
				)
			);

			acf_render_field_setting(
				$field, array(
					'label' => __( 'Default Button Text', 'acf-button' ),
					'type'  => 'text',
					'name'  => 'default_text',
				)
			);

			acf_render_field_setting(
				$field, array(
					'label'   => __( 'Set default target', 'acf-button' ),
					'type'    => 'select',
					'name'    => 'default_target',
					'choices' => array(
						''       => __( 'Same Window', 'acf-button' ),
						'_blank' => __( 'New Window', 'acf-button' ),
					),
				)
			);

			acf_render_field_setting(
				$field, array(
					'label'   => __( 'Default Color', 'acf-button' ),
					'type'    => 'select',
					'name'    => 'default_color',
					'choices' => array(
						'primary'   => __( 'Primary', 'acf-button' ),
						'secondary' => __( 'Secondary', 'acf-button' ),
						'success'   => __( 'Success', 'acf-button' ),
						'alert'     => __( 'Alert', 'acf-button' ),
						'warning'   => __( 'Warning', 'acf-button' ),
						'info'      => __( 'Info', 'acf-button' ),
						'disabled'  => __( 'Disabled', 'acf-button' ),
					),
				)
			);

			acf_render_field_setting(
				$field, array(
					'label'   => __( 'Default Size', 'acf-button' ),
					'type'    => 'select',
					'name'    => 'default_size',
					'choices' => array(
						'tiny'  => __( 'Tiny', 'acf-button' ),
						'small' => __( 'Small', 'acf-button' ),
						''      => __( 'Normal', 'acf-button' ),
						'large' => __( 'Large', 'acf-button' ),
						'huge'  => __( 'Huge', 'acf-button' ),
					),
				)
			);

			acf_render_field_setting(
				$field, array(
					'label'   => __( 'Default Style', 'acf-button' ),
					'type'    => 'select',
					'name'    => 'default_style',
					'choices' => array(
						''         => __( 'Normal', 'acf-button' ),
						'expanded' => __( 'Expanded', 'acf-button' ),
						'hollow'   => __( 'Hollow', 'acf-button' ),
						'round'    => __( 'Round', 'acf-button' ),
						'radius'   => __( 'Radius', 'acf-button' ),
					),
				)
			);

			$type_choices = array(
				'custom' => __( 'Custom URL', 'acf-button' ),
				'post'   => __( 'Link to WordPress Content', 'acf-button' ),
			);

			// $args = array(
			// 	'public'   => true,
			// 	'_builtin' => false,
			// );

			// $ignore = array(
			// 	'page',
			// 	'post',
			// 	'attachment',
			// 	'acf-field',
			// 	'acf-field-group',
			// );

			// $cpts = get_post_types( $args, 'objects' );
			// if ( $cpts ) {
			// 	foreach ( $cpts as $cpt ) {
			// 		$name                  = $cpt->name;
			// 		$label                 = $cpt->label;
			// 		$type_choices[ $name ] = $label;
			// 	}
			// }

			acf_render_field_setting(
				$field, array(
					'label'   => __( 'Default Type', 'acf-button' ),
					'type'    => 'select',
					'name'    => 'default_type',
					'choices' => $type_choices,
				)
			);
		}


		/**
		 *  Function render_field()
		 *
		 *  Create the HTML interface for your field
		 *
		 *  @type    action
		 *  @since   1.0.0
		 *  @since   1.7.0 Added rel and anchor to button options.
		 *  @date    23/01/13
		 *
		 *  @param   $field (array) the $field being rendered.
		 *  @return  void
		 */
		public function render_field( $field ) {

			$field = array_merge( $this->defaults, $field );

			// Review the data of $field.
			// This will show what data is available.
			// set defaults if values do not yet exist.
			if ( ! isset( $field['value']['text'] ) ) {
				if ( isset( $field['default_text'] ) ) {
					$field['value']['text'] = $field['default_text'];
				} else {
					$field['value']['text'] = '';
				}
			}
			if ( ! isset( $field['value']['post'] ) ) {
				$field['value']['post'] = '';
			}
			if ( ! isset( $field['value']['url'] ) ) {
				$field['value']['url'] = '';
			}
			if ( ! isset( $field['value']['target'] ) ) {
				if ( isset( $field['default_target'] ) ) {
					$field['value']['target'] = $field['default_target'];
				} else {
					$field['value']['target'] = '';
				}
			}
			if ( ! isset( $field['value']['color'] ) ) {
				if ( isset( $field['default_color'] ) ) {
					$field['value']['color'] = $field['default_color'];
				} else {
					$field['value']['color'] = '';
				}
			}
			if ( ! isset( $field['value']['size'] ) ) {
				if ( isset( $field['default_size'] ) ) {
					$field['value']['size'] = $field['default_size'];
				} else {
					$field['value']['size'] = '';
				}
			}
			if ( ! isset( $field['value']['style'] ) ) {
				if ( isset( $field['default_style'] ) ) {
					$field['value']['style'] = $field['default_style'];
				} else {
					$field['value']['style'] = '';
				}
			}
			if ( ! isset( $field['value']['class'] ) ) {
				$field['value']['class'] = '';
			}
			if ( ! isset( $field['value']['anchor'] ) ) {
				$field['value']['anchor'] = '';
			}
			if ( ! isset( $field['value']['rel'] ) ) {
				$field['value']['rel'] = '';
			}
			if ( ! isset( $field['value']['page_link'] ) ) {
				$field['value']['page_link'] = '';
			}
			if ( ! isset( $field['value']['type'] ) ) {
				if ( isset( $field['default_type'] ) ) {
					$field['value']['type'] = $field['default_type'];
				} else {
					$field['value']['type'] = 'post';
				}
			}

			?>
<style>
	.acf-field .acf-label label[for="acf-<?php echo esc_attr( $field['key'] ); ?>"] { 
		display: none;
	}
	.acf-field .acf-input .acf-button fieldset {
		border: 1px solid #eee;
		padding: .5rem 1rem 1rem;
	}
	.acf-button .acf-label {
		margin-bottom: 5px;
	}
	.acf-button-subfield {
		margin-top: 10px;
	}
	.acf-button .acf-input input {
		line-height: 18px;
	}
</style>
<div class="acf-button" id="acf-<?php echo esc_attr( $field['key'] ); ?>" data-key="<?php echo esc_attr( $field['key'] ); ?>">
	<fieldset>
		<legend><?php echo esc_attr( $field['label'] ); ?></legend>
		<div class="acf-button-subfield acf-button-text">
			<div class="acf-label">
				<label for="<?php echo esc_attr( $field['name'] ); ?>_text">Text</label>
			</div>
			<div class="acf-input">
				<input  type="text" 
						name="<?php echo esc_attr( $field['name'] ); ?>[text]"
						id="<?php echo esc_attr( $field['name'] ); ?>_text" 
						value="<?php echo esc_attr( $field['value']['text'] ); ?>" 
				/>
			</div>
		</div>
<?php

// When button link type is allowed, display the ui for type.
if ( 'type' === $field['allow_advanced'] ||
		is_array( $field['allow_advanced'] ) &&
		in_array( 'type', $field['allow_advanced'], true ) ) {
?>

		<div class="acf-button-subfield acf-button-type">
			<div class="acf-label">
				<label for="<?php echo esc_attr( $field['key'] ); ?>_type">Link Type</label>
				<p class="description">What type of content will the button link to?</p>
			</div>
			<div class="acf-input">
				<?php
					$selected = $field['value']['type'];
					$args     = array(
						'public' => true,
					);

					$ignore = array(
						'page',
						'post',
						'attachment',
						'acf-field',
						'acf-field-group',
					);
					$cpts   = get_post_types( $args, 'objects' );

					?>
					<select 
						name="<?php echo esc_attr( $field['name'] ); ?>[type]"
						id="<?php echo esc_attr( $field['key'] ); ?>_type"
					>
						<option value="custom" 
						<?php
						if ( 'custom' === $selected ) {
							echo 'selected';
						}
						?>
						>Link to URL</option>
						<option value="post" 
						<?php
						if ( 'custom' !== $selected ) {
							echo 'selected';
						}
						?>
						>Link to WordPress Content</option>
						</select>
				</div>
			</div>
<?php
}

// When button link type is allowed, display the ui for type.
if ( 'type' === $field['allow_advanced'] ||
		is_array( $field['allow_advanced'] ) &&
		in_array( 'type', $field['allow_advanced'], true ) ||
		'post' === $field['default_type'] ) {

			$posttypes = array();
			$ignore    = array(
				'attachment',
				'acf-field',
				'acf-field-group',
			);
			foreach ( $cpts as $cpt ) {
				// exclude.
				if ( ! in_array( $cpt->name, $ignore, true ) ) {
					$posttypes[] = $cpt->name;
				}
			}

			?>
			<div class="acf-button-subfield acf-button-post acf-button-link">
				<div class="acf-label">
					<label for="<?php echo esc_attr( $field['key'] ); ?>_post">Content Link</label>
					<p class="description"></p>
				</div>
				<div class="acf-input">
					<?php
					$selected = $field['value']['post'];

					// query arguments.
					$args = array(
						'post_type'      => $posttypes,
						'posts_per_page' => -1,
						'order'          => 'ASC',
						'orderby'        => 'type title',
					);

					$myposts = get_posts( $args );
					?>
					<select 
							name="<?php echo esc_attr( $field['name'] ); ?>[post]"
							id="<?php echo esc_attr( $field['key'] ); ?>_post"
					>
					<?php
						$post_type = '';
					foreach ( $myposts as $post ) {
						$this_post_type = get_post_type( $post );

						if ( $post_type !== $this_post_type ) {
							if ( '' !== $post_type ) {
								echo '</optgroup>';
							}
							$post_type = $this_post_type;
							echo '<optgroup label="' . esc_attr( get_post_type_object( $post_type )->labels->name ) . '">';
						}

						$this_id    = $post->ID;
						$this_title = get_the_title( $this_id );
						?>
						<option value="<?php echo esc_attr( $this_id ); ?>" 
							<?php
							if ( intval($selected) === intval($this_id) ) {
								echo 'selected';
							}
							?>
							><?php echo esc_html( $this_title ); ?></option>
						<?php
					}
					?>
						</optgroup>
					</select>
				</div>
			</div>
<?php
}

// When button link type is allowed, display the ui for type.
if ( 'type' === $field['allow_advanced'] ||
		is_array( $field['allow_advanced'] ) &&
		in_array( 'type', $field['allow_advanced'], true ) ||
		'custom' === $field['default_type'] ) {
?>

			<div class="acf-button-subfield acf-button-link acf-button-url">
				<div class="acf-label">
					<label for="<?php echo esc_attr( $field['key'] ); ?>_url">URL</label>
				</div>
				<div class="acf-input">
					<input  type="url" 
						name="<?php echo esc_attr( $field['name'] ); ?>[url]" 
						id="<?php echo esc_attr( $field['key'] ); ?>_url" 
						value="<?php echo esc_attr( $field['value']['url'] ); ?>" 
					/>
				</div>
			</div>

		<?php
}

// When button anchor is allowed, display the ui for anchor.
if ( 'anchor' === $field['allow_advanced'] ||
		is_array( $field['allow_advanced'] ) &&
		in_array( 'anchor', $field['allow_advanced'], true ) ) {
?>

		<div class="acf-button-subfield acf-button-anchor">
			<div class="acf-label">
				<label for="<?php echo esc_attr( $field['name'] ); ?>[anchor]">Anchor</label>
			</div>
			<div class="acf-input">
				<div class="acf-input-prepend">#</div>
				<div class="acf-input-wrap">
					<input  type="text" 
							name="<?php echo esc_attr( $field['name'] ); ?>[anchor]" 
							id="<?php echo esc_attr( $field['name'] ); ?>[anchor]" 
							value="<?php echo esc_attr( $field['value']['anchor'] ); ?>" 
					/>
				</div>
			</div>
		</div>

<?php }

// When button color is allowed, display the ui for color.
if ( 'color' === $field['allow_advanced'] ||
		is_array( $field['allow_advanced'] ) &&
		in_array( 'color', $field['allow_advanced'], true ) ) {
?>

		<div class="acf-button-subfield acf-button-color">
			<div class="acf-label">
				<label for="<?php echo esc_attr( $field['key'] ); ?>_color">Color</label>
			</div>
			<div class="acf-input">
			<?php
				$color_values = array(
					'Primary'   => 'primary',
					'Secondary' => 'secondary',
					'Success'   => 'success',
					'Alert'     => 'alert',
					'Info'      => 'info',
					'Warning'   => 'warning',
					'Disabled'  => 'disabled',
				);
			?>
				<select
						name="<?php echo esc_attr( $field['name'] ); ?>[color]"
						id="<?php echo esc_attr( $field['name'] ); ?>[color]"
				>
				<?php foreach ( $color_values as $key => $value ){ ?>
					<option value="<?php echo esc_attr( $value ); ?>"
					<?php if ( $value === $field['value']['color'] ) {
						echo 'selected';
					} ?>
					><?php echo esc_html( $key ); ?></option>
				<?php }	?>
				</select>
			</div>
		</div>

<?php
// when color ui is not allowed, display hidden field to load in the default color from the field group.
} else {
?>
		<input
			type="hidden"
			name="<?php echo esc_attr( $field['name'] ); ?>[color]"
			value="<?php echo esc_attr( $field['value']['color'] ); ?>"
		/>
<?php
}

// When button size is allowed, display the ui for size.
if ( 'size' === $field['allow_advanced'] ||
		is_array( $field['allow_advanced'] ) &&
		in_array( 'size', $field['allow_advanced'], true ) ) {
		?>

		<div class="acf-button-subfield acf-button-size">
			<div class="acf-label">
				<label for="<?php echo esc_attr( $field['name'] ); ?>[size]">Size</label>
			</div>
			<div class="acf-input">
			<?php
				$size_values = array(
					'Tiny'   => 'tiny',
					'Small'  => 'small',
					'Normal' => '',
					'Large'  => 'large',
					'Huge'   => 'huge',
				);
			?>
				<select
						name="<?php echo esc_attr( $field['name'] ); ?>[size]"
						id="<?php echo esc_attr( $field['name'] ); ?>[size]"
				>
				<?php foreach ( $size_values as $key => $value ){ ?>
					<option value="<?php echo esc_attr( $value ); ?>"
					<?php if ( $value === $field['value']['size'] ) {
						echo 'selected';
					} ?>
					><?php echo esc_html( $key ); ?></option>
				<?php }	?>
				</select>
			</div>
		</div>

<?php
// when size ui is not allowed, add hidden field to store default size.
} else {
?>
		<input type="hidden" name="<?php echo esc_attr( $field['name'] ); ?>[size]" value="<?php echo esc_attr( $field['value']['size'] ); ?>" />
<?php
}

// When button style is allowed, display the ui for style.
if ( 'style' === $field['allow_advanced'] ||
		is_array( $field['allow_advanced'] ) &&
		in_array( 'style', $field['allow_advanced'], true ) ) {
?>

		<div class="acf-button-subfield acf-button-style">
			<div class="acf-label">
				<label for="<?php echo esc_attr( $field['name'] ); ?>[style]">Style</label>
			</div>
			<div class="acf-input">
			<?php
				$style_values = array(
					'Normal'   => '',
					'Extended' => 'extended',
					'Hollow'   => 'hollow',
					'Round'    => 'round',
					'Radius'   => 'radius',
				);
			?>
				<select
						name="<?php echo esc_attr( $field['name'] ); ?>[style]"
						id="<?php echo esc_attr( $field['name'] ); ?>[style]"
				>
				<?php foreach ( $style_values as $key => $value ){ ?>
					<option value="<?php echo esc_attr( $value ); ?>"
					<?php if ( $value === $field['value']['style'] ) {
						echo 'selected';
					} ?>
					><?php echo esc_html( $key ); ?></option>
				<?php }	?>
				</select>
			</div>
		</div>
<?php
// when style ui is not allowed, load the defualt style in a hidden field.
} else {
?>
		<input type="hidden" name="<?php echo esc_attr( $field['name'] ); ?>[style]" value="<?php echo esc_attr( $field['value']['style'] ); ?>" />
<?php
}

// When button target is allowed, display the ui for target.
if ( 'target' === $field['allow_advanced'] ||
		is_array( $field['allow_advanced'] ) &&
		in_array( 'target', $field['allow_advanced'], true ) ) {
?>

		<div class="acf-button-subfield acf-button-target">
			<div class="acf-label">
				<label for="<?php echo esc_attr( $field['name'] ); ?>[target]">Target</label>
			</div>
			<div class="acf-input">
			<?php
				$target_values = array(
					'Open in same window'   => '',
					'Open in new window/tab (target="_blank")' => '_blank',
				);
			?>
				<select
						name="<?php echo esc_attr( $field['name'] ); ?>[target]"
						id="<?php echo esc_attr( $field['name'] ); ?>[target]"
				>
				<?php foreach ( $target_values as $key => $value ){ ?>
					<option value="<?php echo esc_attr( $value ); ?>"
					<?php if ( $value === $field['value']['target'] ) {
						echo 'selected';
					} ?>
					><?php echo esc_html( $key ); ?></option>
				<?php }	?>
				</select>
			</div>
		</div>

<?php
// if target ui is not allowed, add default to hidden field.
} else {
?>
		<input type="hidden" name="<?php echo esc_attr( $field['name'] ); ?>[target]" value="<?php echo esc_attr( $field['value']['target'] ); ?>" />
<?php
}

// When button class is allowed, display the ui for class.
if ( 'class' === $field['allow_advanced'] ||
		is_array( $field['allow_advanced'] ) &&
		in_array( 'class', $field['allow_advanced'], true ) ) {
?>

		<div class="acf-button-subfield acf-button-class">
			<div class="acf-label">
				<label for="<?php echo esc_attr( $field['name'] ); ?>[class]">Custom Class(es)</label>
			</div>
			<div class="acf-input">
				<input  type="text" 
						name="<?php echo esc_attr( $field['name'] ); ?>[class]" 
						id="<?php echo esc_attr( $field['name'] ); ?>[class]" 
						value="<?php echo esc_attr( $field['value']['class'] ); ?>" 
				/>
			</div>
		</div>

<?php }

// When button rel is allowed, display the ui for rel.
if ( 'rel' === $field['allow_advanced'] ||
		is_array( $field['allow_advanced'] ) &&
		in_array( 'rel', $field['allow_advanced'], true ) ) {
?>

		<div class="acf-button-subfield acf-button-rel">
			<div class="acf-label">
				<label for="<?php echo esc_attr( $field['name'] ); ?>[rel]">Button link rel</label>
			</div>
			<div class="acf-input">
			<?php
				$rel_values = array(
					'none'   => '',
					'alternate' => 'alternate',
					'author' => 'author',
					'bookmark' => 'bookmark',
					'external' => 'external',
					'help' => 'help',
					'license' => 'license',
					'next' => 'next',
					'nofollow' => 'nofollow',
					'noreferrer' => 'noreferrer',
					'prev' => 'prev',
					'search' => 'search',
					'tag' => 'tag',
				);
			?>
				<select
						name="<?php echo esc_attr( $field['name'] ); ?>[rel]"
						id="<?php echo esc_attr( $field['name'] ); ?>[rel]"
				>
				
				<?php foreach ( $rel_values as $key => $value ){ ?>
					<option value="<?php echo esc_attr( $value ); ?>"
					<?php if ( $value === $field['value']['rel'] ) {
						echo 'selected';
					} ?>
					><?php echo esc_html( $key ); ?></option>
				<?php }	?>
					
				</select>
			</div>
		</div>

<?php } ?>

	</fieldset>
</div>
<?php
		}


		/**
		 * Function input_admin_enqueue_scripts()
		 *
		 * Scripts and styles for input type.
		 */
		public function input_admin_enqueue_scripts() {

			// vars.
			$url     = $this->settings['url'];
			$version = $this->settings['version'];

			// register & include JS.
			wp_register_script( 'acf-input-button', "{$url}js/input.js", array( 'acf-input' ), $version );
			wp_enqueue_script( 'acf-input-button' );

			// register & include CSS.
			wp_register_style( 'acf-input-button', "{$url}css/input.css", array( 'acf-input' ), $version );
			wp_enqueue_style( 'acf-input-button' );

		}



		/**
		 *  Function format_value()
		 *
		 *  This filter is appied to the $value after it is loaded from the db and before it is returned to the template
		 *
		 *  @type    filter
		 *  @since   1.0.0
		 *  @since   1.7.0 Added rel and anchor to button options.
		 *  @date    23/01/13
		 *
		 *  @param type $value (mixed) the value which was loaded from the database.
		 *  @param type $post_id (mixed) the $post_id from which the value was loaded.
		 *  @param type $field (array) the field array holding all the field options.
		 *
		 *  @return type $value (mixed) the modified value.
		 */
		public function format_value( $value, $post_id, $field ) {

			// bail early if no value.
			if ( empty( $value ) ||
			'' === $value['text'] ) {

				return;
			}

			// set defaults.
			$url    = '';
			$target = '';
			$rel    = '';
			$class  = 'button';
			// get url - if url exists use it, if not use the page id to get permalink.
			if ( 'custom' === $field['default_type'] ) {
				$url = $value['url'];
			} else {
				$url  = get_permalink( $field['value']['post'] );
			}

			// get target.
			if ( isset( $value['target'] ) &&
			'_blank' === $value['target'] ) {
				$target = ' target="_blank" ';
			}

			// get rel.
			if ( isset( $value['rel'] ) ) {
				$rel = ' rel="' . $value['rel'] . '" ';
			}

			// append size classes.
			if ( isset( $value['size'] ) ) {
				$class .= ' ' . $value['size'];
			}

			// append color classes.
			if ( isset( $value['color'] ) ) {
				$class .= ' ' . $value['color'];
			}

			// append style classes.
			if ( isset( $value['style'] ) ) {
				$class .= ' ' . $value['style'];
			}

			// append custom classes.
			if ( isset( $value['class'] ) ) {
				$class .= ' ' . $value['class'];
			}

			// append anchor.
			if ( isset( $value['anchor'] ) && $value['anchor'] !== '' ) {
				$url .= '#' . $value['anchor'];
			}

			$value = '<a 
						href="' . $url . '" 
						class="' . $class . '"' . 
						$target . 
						$rel . 
					'>' . 
						$value['text'] . 
					'</a>';

			// return.
			return $value;
		}


	}


	// initializes.
	new ACF_Button_Field( $this->settings );


	// class_exists check.
endif;

?>
