<?php
/**
 * Template Name: Contact Us
 *
 */

get_header();

while ( have_posts() ) : the_post();
    $the_header = the_title('', '', false);
    $the_content = get_the_content();
endwhile;

?>

    <section id="wizard_bg">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1 text-center">
                    <h2 style="text-decoration: underline;"><?php echo $the_header; ?></h2>
                    <p><strong><?php echo $the_content; ?></strong></p>
                </div>
            </div><!-- End row -->
            <div class="row">
                <div class="col-md-4">

                    <h4>Please check spam folder if you do not see a reply. Replies are sent within 24 hours (normally, just a couple of hours) Hotmail & Outlook accounts, especially, often mistake replies as spam.</h4>

                    <ul id="contact-info">
                        <li><a href="<?php echo get_option( 'ffpc_social_facebook_url' ); ?>"><i class="icon-facebook contactus_social"></i> Follow Us On Facebook</a></li>
                        <li><a href="<?php echo get_option( 'ffpc_social_twitter_url' ); ?>"><i class="icon-twitter contactus_social"></i> Follow Us On Twitter</a></li>
                        <li><a href="<?php echo get_option( 'ffpc_social_google_url' ); ?>"><i class="icon-google contactus_social"></i> Follow Us On Google Plus</a></li>
                        <li><a href="<?php echo get_option( 'ffpc_social_youtube_url' ); ?>"><i class="icon-youtube-4 contactus_social"></i> Follow Us On YouTube</a></li>
                    </ul>
                    <ul style="list-style: none; margin: 5px 0; padding: 5px 0;">
                        <li><strong class="phone"><?php echo get_option( 'ffpc_contact_phone' ); ?></strong><br><small><?php echo get_option( 'ffpc_contact_hour' ); ?></small></li>
                        <li>Questions? <a href="#"><?php echo get_option( 'ffpc_contact_email' ); ?></a></li>
                    </ul>

                    <hr>
                </div>
                <div class="col-md-8">
                    <div id="survey_container">
                        <form name="example-1" id="wrapped" action="" method="POST" >
                            <div id="middle-wizard">
                                <div class="step">
                                    <div class="row">
                                        <h3 class="col-md-10">CONTACT FOR QUOTE & AVAILABILITY</h3>
                                        <div class="col-md-6">
                                            <div class="form-group"><label for="firstname">Your First Name:</label> <input type="text" name="firstname"
                                                                           class="required form-control" id="firstname" required
                                                                           placeholder="First name"></div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group"><label for="lastname">Your Last Name:</label> <input type="text" name="lastname"
                                                                           class="required form-control" id="lastname" required
                                                                           placeholder="Last name"></div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group"><label for="email">Your Email Address:</label> <input type="email" name="email"
                                                                           class="required form-control" id="email" required
                                                                           placeholder="Your Email Address"></div>
                                        </div><!-- end col-md-6 -->
                                        <div class="col-md-6">
                                            <div class="form-group"><label for="phone">Your Contact No.:</label> <input type="text" name="phone"
                                                                           class="form-control" id="phone"
                                                                           placeholder="Your Contact No."></div>
                                        </div><!-- end col-md-6 -->
                                        <div class="col-md-6">
                                            <div class="form-group"><label for="event_date">Your Event Date:</label> <input type="date" name="event_date" id="event_date" required
                                                                           class="form-control"></div>
                                        </div><!-- end col-md-6 -->
                                        <div class="col-md-6">
                                            <div class="form-group"><label for="event_time">Event Start Time:</label> <input type="time" name="event_time" id="event_time" required
                                                                           class="form-control"></div>
                                        </div><!-- end col-md-6 -->
                                        <div class="col-md-12">
                                            <div class="form-group"><label for="event_details">Additional details such as type of event & audience:</label> <textarea name="event_details" id="event_details" required
                                                                           class="form-control"></textarea></div>
                                        </div><!-- end col-md-6 -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="lead_source">How did you find The Magic Guy?:</label>
                                                <div class="styled-select">
                                                    <select name="lead_source" id="lead_source" class="form-control" onchange="checkOtherSource();">
                                                        <option value="none chosen"></option>
                                                        <option value="Google">Google</option>
                                                        <option value="Yahoo">Yahoo</option>
                                                        <option value="Bing">Bing</option>
                                                        <option value="Craigslist">Craigslist</option>
                                                        <option value="Kijiji">Kijiji</option>
                                                        <option value="Help We've got kids">Help We've Got Kids</option>
                                                        <option value="city family guide">City Family Guide</option>
                                                        <option value="Magic Guy Flyer">Magic Guy Flyer</option>
                                                        <option value="other">*Other? Please type in the box:*</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div><!-- end col-md-6 -->
                                        <div class="col-md-6">
                                            <div class="form-group"><label for="lead_source_other">Lead Source Other</label> <input type="text" disabled="disabled" name="lead_source_other" id="lead_source_other" required
                                                                                                                                    class="form-control"></div>
                                        </div><!-- end col-md-6 -->
                                    </div><!-- end row -->
                                </div><!-- end step-->
                            </div><!-- end middle-wizard -->

                            <div id="bottom-wizard">
                                <button type="submit" name="Submit" class="forward">Submit</button>
                            </div><!-- end bottom-wizard -->
                        </form>

                    </div><!-- end Survey container -->
                </div>
        </div>
    </section><!-- end section main container -->

<script type="text/javascript">
    function checkOtherSource(){
        var selectedValue = $('#lead_source').val();
        if (selectedValue === 'other'){
            $('#lead_source_other').removeAttr("disabled");
        } else {
            $('#lead_source_other').val("");
            $('#lead_source_other').attr("disabled", "disabled");
        }
    }
</script>

<?php get_footer(); ?>