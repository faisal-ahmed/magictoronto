<?php
/*
Plugin Name: FFPC Social Tool
Plugin URI: http://google.com/
Description: This Plugin manages some social networks.
Author: RockStar Techie Solutions
Version: 1
Author URI: http://google.com/
*/

/**
 * Get live tweets from an account, depending on the parameter
 * Returns an stdClass object's array
 */
function ffpc_get_last_tweet() {
			
	$count = 1;
	$defaultName = get_option( 'ffpc_social_twitter_acc' );
	if($defaultName)
		$screen_name = $defaultName;
			
	if($screen_name == "") $screen_name = "RockStar Techie Solutions";
	try {
		$feed_url = 'http://twitter.com/statuses/user_timeline.rss?screen_name='.$screen_name.'&count='.$count;					
		$content = @file_get_contents($feed_url);
		$x = new SimpleXmlElement($content);   
		
		echo '<a href="'.$x->channel->item->link.'" class="link_tweet floatleft">'.
                $x->channel->item->title.
              '</a>
              <a href="http://twitter.com/'.$screen_name.'" class="link_follow floatright">Follow</a>';
	
	}catch (Exception $e){
		echo $e->getMessage();
	}
}

function ffpc_get_social_links() {
?>
    <ul id="follow_us">
        <li><a href="<?php echo get_option( 'ffpc_social_facebook_url' ); ?>"><i class="icon-facebook"></i></a></li>
        <li><a href="<?php echo get_option( 'ffpc_social_twitter_url' ); ?>"><i class="icon-twitter"></i></a></li>
        <li><a href="<?php echo get_option( 'ffpc_social_google_url' ); ?>"><i class="icon-google"></i></a></li>
        <li><a href="<?php echo get_option( 'ffpc_social_youtube_url' ); ?>"><i class="icon-youtube-4"></i></a></li>
    </ul>
    <ul>
        <li><strong class="phone"><?php echo get_option( 'ffpc_contact_phone' ); ?></strong><br><small><?php echo get_option( 'ffpc_contact_hour' ); ?></small></li>
        <li>Questions? <a href="#"><?php echo get_option( 'ffpc_contact_email' ); ?></a></li>
    </ul>
    <div class="clear"></div>
<?php
}

//Register FB Widget
function csn_facebook_widget() {
?>

	<div class="connect_with_us">
        <div class="clear"></div>
		<div class="connect_title">
			<a href="<?php echo get_option( 'ffpc_social_facebook_url' ); ?>" target="_blank" class="link_facebook floatright">Facebook</a>
			<div class="clear"></div>
		</div>
										
		<div class="connect_box">
            <iframe src="//www.facebook.com/plugins/likebox.php?href=<?php echo get_option( 'ffpc_social_facebook_url' ); ?>%2F186739231679&amp;width=212&amp;height=590&amp;colorscheme=light&amp;show_faces=true&amp;border_color&amp;stream=true&amp;header=true&amp;appId=277087095642440" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:212px; height:590px;" allowTransparency="true"></iframe>
		</div>
	</div>
<?php
}

register_sidebar_widget("CSN_Facebook_Widget", "csn_facebook_widget");
/********** Admin Panel **************************/
add_action('admin_menu', 'ffpc_plugin_menu');

function ffpc_plugin_menu() {
	add_options_page('FFPC Social Tool', 'FFPC Social Tool', 'manage_options', 'ffpc-social-id', 'ffpcSocial_options');
	//add_submenu_page( 'admin.php?page=ffpc_settings', 'FFPC Social Tool', 'Social Tool', 'manage_options', 'ffpc-social-id', 'ffpcSocial_options');
}

function ffpcSocial_options() {
	if (!current_user_can('manage_options'))  {
		wp_die( __('You do not have sufficient permissions to access this page.') );
	}
	
    if( isset($_POST['ffpc_social_hidden']) && $_POST['ffpc_social_hidden'] == 'Y' ) {
        update_option( 'ffpc_social_twitter_url', $_POST['ffpc_social_twitter_url'] );
        update_option( 'ffpc_social_google_url', $_POST['ffpc_social_google_url'] );
        update_option( 'ffpc_social_facebook_url', $_POST['ffpc_social_facebook_url'] );
        update_option( 'ffpc_social_youtube_url', $_POST['ffpc_social_youtube_url'] );
        update_option( 'ffpc_contact_phone', $_POST['ffpc_contact_phone'] );
        update_option( 'ffpc_contact_hour', $_POST['ffpc_contact_hour'] );
        update_option( 'ffpc_contact_email', $_POST['ffpc_contact_email'] );
		echo '<div class="updated"><p><strong>Settings Saved.</strong></p></div>';
	}
    ?>
<h2>FFPC Social Tools Settings</h2>
<form name="form1" method="post" action="">
	<input type="hidden" name="ffpc_social_hidden" value="Y">
		<table>
			<tr>
				<td>
					Google URL:
				</td>
				<td>
					<input type="text" name="ffpc_social_google_url" value="<?php echo get_option( 'ffpc_social_google_url' ); ?>" size="50">
				</td>
			</tr>
			<tr>
				<td>
					Twitter URL:
				</td>
				<td>
					<input type="text" name="ffpc_social_twitter_url" value="<?php echo get_option( 'ffpc_social_twitter_url' ); ?>" size="50">
				</td>
			</tr>
			<tr>
				<td>
					Facebook URL:
				</td>
				<td>
					<input type="text" name="ffpc_social_facebook_url" value="<?php echo get_option( 'ffpc_social_facebook_url' ); ?>" size="50">
				</td>
			</tr>
			<tr>
				<td>
					Youtube URL:
				</td>
				<td>
					<input type="text" name="ffpc_social_youtube_url" value="<?php echo get_option( 'ffpc_social_youtube_url' ); ?>" size="50">
				</td>
			</tr>
            <tr>
				<td>
                    Contact Phone:
				</td>
				<td>
					<input type="text" name="ffpc_contact_phone" value="<?php echo get_option( 'ffpc_contact_phone' ); ?>" size="50">
				</td>
			</tr>
            <tr>
				<td>
                    Contact Hour:
				</td>
				<td>
					<input type="text" name="ffpc_contact_hour" value="<?php echo get_option( 'ffpc_contact_hour' ); ?>" size="50">
				</td>
			</tr>
            <tr>
				<td>
                    Contact Email:
				</td>
				<td>
					<input type="text" name="ffpc_contact_email" value="<?php echo get_option( 'ffpc_contact_email' ); ?>" size="50">
				</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>
					<p class="submit">
					<input type="submit" name="Submit" class="button-primary" value="<?php esc_attr_e('Save Changes') ?>" />
					</p>
				</td>
			</tr>
		</table>
	<hr />
</form>
</div>

<?php	
}
?>