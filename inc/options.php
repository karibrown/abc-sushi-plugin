<?php 
function abcsushi_add_submenu() {
add_submenu_page( 'themes.php', 'Artsy Sushi Options Page', 'Theme Options', 'manage_options', 'theme_options', 'my_theme_options_page');
}
add_action( 'admin_menu', 'abcsushi_add_submenu' );
//add option page to sub-menu //
function abcsushi_settings_init(){
register_setting( 'theme_options', 'abcsushi_options_settings' );

add_settings_section(
	'abcsushi_options_page_section',
	'you can change the color scheme for your website here',
	'abcsushi_options_page_section_callback',
	'theme_options'
	);
function abcsushi_options_page_section_callback() { echo __( 'Provide a brief description of the section.', 'abc-sushi' ); }

	add_settings_field(
	'abcsushi_text_field',
	__('Insert Text Here', 'abc-sushi'), 'abcsushi_text_field_render', 'theme_options', 'abcsushi_options_page_section');

	add_settings_field(
	'abcsushi_checkbox_field',
	__( 'Choose and Check boxes accodingly', 'abc-sushi' ), 'abcsushi_checkbox_field_render', 'theme_options', 'abcsushi_options_page_section');
	
	add_settings_field(
	'abcsushi_radio_field',
	__( 'Choose an option', 'abc-sushi' ), 'abcsushi_radio_field_render',  'theme_options', 'abcsushi_options_page_section'
	);
	add_settings_field('abcsushi_textarea_field',
	__( 'Enter content Here', 'abc-sushi' ), 'abcsushi_textarea_field_render',
	'theme_options', 'abcsushi_options_page_section');
	
	add_settings_field('abcsushi_select_field',
	__( 'Choose from the dropdown', 'abc-sushi' ), 'abcsushi_select_field_render', 'theme_options',
	'abcsushi_options_page_section');
	
	function abcsushi_checkbox_field_render() {
$options = get_option( 'abcsushi_options_settings' );
?>
<input type="checkbox" name="abcsushi_options_settings[abcsushi_checkbox_field]" <?php if (isset($options['abcsushi_checkbox_field'])) checked( 'on', ($options['abcsushi_checkbox_field']) ) ; ?> value="on" />
<label>Turn it On</label>
<?php
}
function abcsushi_radio_field_render() {
$options = get_option( 'abcsushi_options_settings' );
?>
<input type="color1" name="abcsushi_options_settings[abcsushi_radio_field]" <?php if (isset($options['abcsushi_radio_field'])) checked( $options['abcsushi_radio_field'], 1 ); ?> value="1" /> <label>Choice One</label><br />
<input type="color2" name="abcsushi_options_settings[abcsushi_radio_field]" <?php if (isset($options['abcsushi_radio_field'])) checked( $options['abcsushi_radio_field'], 2 ); ?> value="2" /> <label>Choice Two</label><br />
<input type="font1" name="abcsushi_options_settings[abcsushi_radio_field]" <?php if (isset($options['abcsushi_radio_field'])) checked( $options['abcsushi_radio_field'], 3 ); ?> value="3" /> <label>Choice Three</label>

<?php
}
function abcsushi_text_field_render() {
$options = get_option( 'abcsushi_options_settings' ); ?>
<input type="text" name="abcsushi_options_settings[abcsushi_text_field]" value="<?php if (isset($options['abcsushi_text_field'])) echo $options['abcsushi_text_field']; ?>" />
<?php
}
function abcsushi_textarea_field_render() {
$options = get_option( 'abcsushi_options_settings' );
?>
<textarea cols="40" rows="5" name="abcsushi_options_settings[abcsushi_textarea_field]"><?php

if (isset($options['abcsushi_textarea_field'])) echo $options['abcsushi_textarea_field']; ?></textarea>

<?php
}
function abcsushi_select_field_render() {
$options = get_option( 'abcsushi_options_settings' );
?>
<select name="abcsushi_options_settings[abcsushi_select_field]">
<option value="1" <?php if (isset($options['abcsushi_select_field'])) selected( $options['abcsushi_select_field'], 1 ); ?>>Option 1</option>
<option value="2" <?php if (isset($options['abcsushi_select_field'])) selected( $options['abcsushi_select_field'], 2 ); ?>>Option 2</option>
<option value="3" <?php if (isset($options['abcsushi_select_field'])) selected( $options['abcsushi_select_field'], 3 ); ?>>Option 3<option>
</select>
<?php
}
function my_theme_options_page(){ ?>
<form action="options.php" method="post"> <h2>Abc Sushi Options Page</h2> <?php
settings_fields( 'theme_options' ); do_settings_sections( 'theme_options' ); submit_button();
?>
</form>
<?php
}
}

function theme_options(){

echo(" this is the testing for option 1 ");

}
add_action( 'admin_init', 'abcsushi_settings_init' );

//retrieved from : https://slate.sheridancollege.ca/d2l/le/content/266318/viewContent/4305729/View//



