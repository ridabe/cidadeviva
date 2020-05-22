<div class="apsc-boards-tabs" id="apsc-board-social-profile-settings">
     <div class="apsc-tab-wrapper">
          <!---Facebook-->
          <div class="apsc-option-outer-wrapper">
               <h4><?php _e( 'Facebook', 'accesspress-social-counter' ) ?></h4>
               <div class="apsc-option-inner-wrapper">
                    <label><?php _e( 'Display Counter', 'accesspress-social-counter' ) ?></label>
                    <div class="apsc-option-field">
                         <label>
                              <input type="checkbox" name="social_profile[facebook][active]" value="1" class="apsc-counter-activation-trigger" <?php if ( isset( $apsc_settings[ 'social_profile' ][ 'facebook' ][ 'active' ] ) ) { ?>checked="checked"<?php } ?>/><?php _e( 'Show/Hide', 'accesspress-social-counter' ); ?>
                         </label>
                    </div>
               </div>
               <div class="apsc-option-inner-wrapper ">
                    <label for="apsc-facebook-method">
                         <?php _e( 'Facebook Counter Extraction', 'ap-social-pro' ) ?>
                    </label>
                    <div class="apsc-option-field">
                         <label class="apsc-fb-method">
                              <input type="radio" name="social_profile[facebook][method]" value="1" class="apss-facebook-method" id="" <?php echo isset( $apsc_settings[ 'social_profile' ][ 'facebook' ][ 'method' ] ) && $apsc_settings[ 'social_profile' ][ 'facebook' ][ 'method' ] == '1' ? ' checked="checked" ' : '1111'; ?>/>
                              <?php _e( 'Method 1', 'ap-social-pro' ); ?>
                         </label>
                         <div class="apsc-option-note"><?php _e( 'Method 1 you will require to enter your app id and app secret. Due to recent changes in Facebook API, most of our clients have been complaining that "Method 1" does not work.  ', 'ap-social-pro' ); ?></div>

                         <label class="apsc-fb-method">
                              <input type="radio" name="social_profile[facebook][method]" value="2" class="apss-facebook-method" id="" <?php echo isset( $apsc_settings[ 'social_profile' ][ 'facebook' ][ 'method' ] ) && $apsc_settings[ 'social_profile' ][ 'facebook' ][ 'method' ] == '2' ? 'checked="checked"' : '2222'; ?>/>
                              <?php _e( 'Method 2', 'ap-social-pro' ); ?>
                         </label>
                         <div class="apsc-option-note"><?php _e( 'Method 2 makes use of a third party API "WidgetPack" to do the work. Please login to your Facebook account using the "FB Connect" button and connect WidgetPack to Facebook. Once done, you will notice that the image and name of your page will be displayed beneath the "FB Connect" button in the plugin settings. When you click on it, All the details will automatically be entered in the fields beneath the "FB Connect Button". Note: Your FB login details will NOT be stored.', 'ap-social-pro' ); ?></div>
                    </div>
               </div>
               <div class="apss-facebook-method-1" id="apss-facebook-method-1" <?php echo ( isset( $apsc_settings[ 'social_profile' ][ 'facebook' ][ 'method' ] ) && $apsc_settings[ 'social_profile' ][ 'facebook' ][ 'method' ] == '1' ) ? 'style=display:block;' : 'style=display:none;'; ?>>
                    <div class="apsc-option-extra">
                         <div class="apsc-option-inner-wrapper">
                              <label><?php _e( 'Facebook Page ID', 'accesspress-social-counter' ); ?></label>
                              <div class="apsc-option-field">
                                   <input type="text" name="social_profile[facebook][page_id]" value="<?php echo esc_attr( $apsc_settings[ 'social_profile' ][ 'facebook' ][ 'page_id' ] ); ?>"/>
                                   <div class="apsc-option-note"><?php _e( 'Please enter the page ID or page name.For example:If your page url is https://www.facebook.com/AccessPressThemes then your page ID is AccessPressThemes.', 'accesspress-social-counter' ); ?>
                                   </div>

                              </div>
                         </div>
                         <div class="apsc-option-inner-wrapper">
                              <label><?php _e( 'Facebook App ID', 'accesspress-social-counter' ); ?></label>
                              <div class="apsc-option-field">
                                   <input type="text" name="social_profile[facebook][app_id]" value="<?php echo isset( $apsc_settings[ 'social_profile' ][ 'facebook' ][ 'app_id' ] ) ? esc_attr( $apsc_settings[ 'social_profile' ][ 'facebook' ][ 'app_id' ] ) : ''; ?>"/>
                                   <div class="apsc-option-note"><?php _e( 'Please go to <a href="https://developers.facebook.com/" target="_blank">https://developers.facebook.com/</a> and create an app and get the App ID', 'accesspress-social-counter' ); ?>
                                   </div>
                              </div>
                         </div>
                         <div class="apsc-option-inner-wrapper">
                              <label><?php _e( 'Facebook App Secret', 'accesspress-social-counter' ); ?></label>
                              <div class="apsc-option-field">
                                   <input type="text" name="social_profile[facebook][app_secret]" value="<?php echo isset( $apsc_settings[ 'social_profile' ][ 'facebook' ][ 'app_secret' ] ) ? esc_attr( $apsc_settings[ 'social_profile' ][ 'facebook' ][ 'app_secret' ] ) : ''; ?>"/>
                                   <div class="apsc-option-note"><?php _e( 'Please go to <a href="https://developers.facebook.com/" target="_blank">https://developers.facebook.com/</a> and create an app and get the App Secret', 'accesspress-social-counter' ); ?>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
               <div class="apss-facebook-method-2" id="apss-facebook-method-2" <?php echo ( isset( $apsc_settings[ 'social_profile' ][ 'facebook' ][ 'method' ] ) && $apsc_settings[ 'social_profile' ][ 'facebook' ][ 'method' ] == '2' ) ? 'style=display:block;' : 'style=display:none;'; ?>>
                    <style>
                         .apsc-main-wrap .apsc-fb-pages-list{
                              width: 60%;
                         }

                         .apsc-fb-pages-list .apsc-page:hover
                         {
                              pointer: cusor;
                              background-color: #eee;
                         }

                         .apsc-fb-pages-list .apsc-page .apsc-page-photo
                         {
                              float:left;
                         }
                         .apsc-fb-pages-list .apsc-page .apsc-page-name
                         {
                              width: 50%;
                              float: left;
                              margin-left: 5px;
                         }
                         .apsc-page-photo{
                              height: 55px;
                              width:55px;
                         }

                         .apsc-fb-pages-list .apsc-page {
                              width: 25%;
                              margin-top: 10px;
                              float: left;
                              display: flex;
                              -webkit-align-items: center;
                              align-items: center;
                              cursor: pointer;
                              margin-right: 20px;
                         }
                    </style>
                    <div class="apsc-option-inner-wrapper apsc-row-even">
                         <label><?php _e( 'Facebook Login', 'ap-social-pro' ); ?></label>
                         <div class="apsc-option-field">
                              <button type="button" id="apsc_fb_connect"><?php _e( 'FB Connect', 'ap-social-pro' ); ?></button>
                              <div class="apsc-fb-pages-list"></div>
                         </div>
                    </div>
                    <div class="apsc-option-inner-wrapper apsc-row-even">
                         <label><?php _e( 'Page Name', 'ap-social-pro' ); ?></label>
                         <div class="apsc-option-field">
                              <input type="text" id="" class="apsc-page-name" name="social_profile[facebook][page_name]" value="<?php (isset( $apsc_settings[ 'social_profile' ][ 'facebook' ][ 'page_name' ] ) && ! empty( $apsc_settings[ 'social_profile' ][ 'facebook' ][ 'page_name' ] )) ? esc_attr_e( $apsc_settings[ 'social_profile' ][ 'facebook' ][ 'page_name' ] ) : ''; ?>" class="apsc-page-name" placeholder="<?php _e( 'Page Name', 'ap-social-pro' ); ?>" readonly />
                              <div class="apsc-option-note"><?php _e( ' ', 'ap-social-pro' ); ?></div>
                         </div>
                    </div>
                    <div class="apsc-option-inner-wrapper apsc-row-even">
                         <label><?php _e( 'Page ID', 'ap-social-pro' ); ?></label>
                         <div class="apsc-option-field">
                              <input type="text" class="apsc-page-id" id="" name="social_profile[facebook][fb_page_id]" value="<?php (isset( $apsc_settings[ 'social_profile' ][ 'facebook' ][ 'fb_page_id' ] ) && ! empty( $apsc_settings[ 'social_profile' ][ 'facebook' ][ 'fb_page_id' ] )) ? esc_attr_e( $apsc_settings[ 'social_profile' ][ 'facebook' ][ 'fb_page_id' ] ) : ''; ?>" class="apsc-page-name" placeholder="<?php _e( 'Page ID', 'ap-social-pro' ); ?>" readonly />
                              <div class="apsc-option-note"><?php _e( ' ', 'ap-social-pro' ); ?></div>
                         </div>
                    </div>
                    <div class="apsc-option-inner-wrapper apsc-row-even">
                         <label><?php _e( 'Access Token', 'ap-social-pro' ); ?></label>
                         <div class="apsc-option-field">
                              <input type="text" id="" class="apsc-page-token" name="social_profile[facebook][access_token]" value="<?php (isset( $apsc_settings[ 'social_profile' ][ 'facebook' ][ 'access_token' ] ) && ! empty( $apsc_settings[ 'social_profile' ][ 'facebook' ][ 'access_token' ] )) ? esc_attr_e( $apsc_settings[ 'social_profile' ][ 'facebook' ][ 'access_token' ] ) : ''; ?>" class="apsc-page-name" placeholder="<?php _e( 'Access Token', 'ap-social-pro' ); ?>" readonly />
                              <div class="apsc-option-note"><?php _e( ' ', 'ap-social-pro' ); ?></div>
                         </div>
                    </div>
                    <img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-widget-id="<?php echo 'apss-facebook-method-2'; ?>" onload="fbrev_init({widgetId: this.getAttribute('data-widget-id')})" style="display:none">
               </div>
               <div class="apsc-option-inner-wrapper apsc-row-odd">
                    <label><?php _e( 'Default Count', 'ap-social-pro' ); ?></label>
                    <div class="apsc-option-field">
                         <input type="text" name="social_profile[facebook][default_count]" value="<?php
                         if ( isset( $apsc_settings[ 'social_profile' ][ 'facebook' ][ 'default_count' ] ) ) {
                              echo $apsc_settings[ 'social_profile' ][ 'facebook' ][ 'default_count' ];
                         } else {
                              echo '';
                         }
                         ?>"/>
                         <div class="apsc-option-note"><?php _e( 'Please enter the default count to show instead of 0 when API\'s are not available.', 'ap-social-pro' ); ?></div>
                    </div>
               </div>
               <div class="apsc-extra-note"><?php _e( 'Please use: [aps-get-count social_media="facebook"] to get the Facebook Count only.You can also pass count_format parameter too in this shortcode to format your count.Formats are "short" for abbreviated format and "comma" for comma separated formats.' ); ?></div>
          </div>
          <!---Facebook-->

          <!--Twitter-->
          <div class="apsc-option-outer-wrapper">
               <h4><?php _e( 'Twitter', 'accesspress-social-counter' ) ?></h4>
               <div class="apsc-option-inner-wrapper">
                    <label><?php _e( 'Display Counter', 'accesspress-social-counter' ) ?></label>
                    <div class="apsc-option-field">
                         <label>
                              <input type="checkbox" name="social_profile[twitter][active]" value="1" class="apsc-counter-activation-trigger" <?php if ( isset( $apsc_settings[ 'social_profile' ][ 'twitter' ][ 'active' ] ) ) { ?>checked="checked"<?php } ?>/><?php _e( 'Show/Hide', 'accesspress-social-counter' ); ?>
                         </label>
                    </div>
               </div>
               <div class="apsc-option-extra">
                    <div class="apsc-option-inner-wrapper">
                         <label><?php _e( 'Twitter Username', 'accesspress-social-counter' ); ?></label>
                         <div class="apsc-option-field">
                              <input type="text" name="social_profile[twitter][username]" value="<?php echo esc_attr( $apsc_settings[ 'social_profile' ][ 'twitter' ][ 'username' ] ); ?>"/>
                              <div class="apsc-option-note">
                                   <?php _e( 'Please enter the twitter username.For example:apthemes', 'accesspress-social-counter' ); ?>
                              </div>
                         </div>
                    </div>
                    <div class="apsc-option-inner-wrapper">
                         <label><?php _e( 'Twitter Consumer Key', 'accesspress-social-counter' ); ?></label>
                         <div class="apsc-option-field">
                              <input type="text" name="social_profile[twitter][consumer_key]" value="<?php echo esc_attr( $apsc_settings[ 'social_profile' ][ 'twitter' ][ 'consumer_key' ] ); ?>"/>
                              <div class="apsc-option-note">
                                   <?php _e( 'Please create an app on Twitter through this link:', 'accesspress-social-counter' ); ?><a href="https://dev.twitter.com/apps" target="_blank">https://dev.twitter.com/apps</a><?php _e( ' and get this information.' ); ?>
                              </div>
                         </div>
                    </div>
                    <div class="apsc-option-inner-wrapper">
                         <label><?php _e( 'Twitter Consumer Secret', 'accesspress-social-counter' ); ?></label>
                         <div class="apsc-option-field">
                              <input type="text" name="social_profile[twitter][consumer_secret]" value="<?php echo esc_attr( $apsc_settings[ 'social_profile' ][ 'twitter' ][ 'consumer_secret' ] ); ?>"/>
                              <div class="apsc-option-note">
                                   <?php _e( 'Please create an app on Twitter through this link:', 'accesspress-social-counter' ); ?>
                                   <a href="https://dev.twitter.com/apps" target="_blank">https://dev.twitter.com/apps </a>
                                   <?php _e( ' and get this information.' ); ?>
                              </div>
                         </div>
                    </div>
                    <div class="apsc-option-inner-wrapper">
                         <label><?php _e( 'Twitter Access Token', 'accesspress-social-counter' ); ?></label>
                         <div class="apsc-option-field">
                              <input type="text" name="social_profile[twitter][access_token]" value="<?php echo esc_attr( $apsc_settings[ 'social_profile' ][ 'twitter' ][ 'access_token' ] ); ?>"/>
                              <div class="apsc-option-note">
                                   <?php _e( 'Please create an app on Twitter through this link:', 'accesspress-social-counter' ); ?>
                                   <a href="https://dev.twitter.com/apps" target="_blank">https://dev.twitter.com/apps </a>
                                   <?php _e( ' and get this information.' ); ?>
                              </div>
                         </div>
                    </div>
                    <div class="apsc-option-inner-wrapper">
                         <label><?php _e( 'Twitter Access Token Secret', 'accesspress-social-counter' ); ?></label>
                         <div class="apsc-option-field">
                              <input type="text" name="social_profile[twitter][access_token_secret]" value="<?php echo esc_attr( $apsc_settings[ 'social_profile' ][ 'twitter' ][ 'access_token_secret' ] ); ?>"/>
                              <div class="apsc-option-note">
                                   <?php _e( 'Please create an app on Twitter through this link:', 'accesspress-social-counter' ); ?>
                                   <a href="https://dev.twitter.com/apps" target="_blank">https://dev.twitter.com/apps </a>
                                   <?php _e( ' and get this information.' ); ?>
                              </div>
                         </div>
                    </div>
                    <div class="apsc-option-inner-wrapper apsc-row-odd">
                         <label><?php _e( 'Default Count', 'ap-social-pro' ); ?></label>
                         <div class="apsc-option-field">
                              <input type="text" name="social_profile[twitter][default_count]" value="<?php echo isset( $apsc_settings[ 'social_profile' ][ 'twitter' ][ 'default_count' ] ) && $apsc_settings[ 'social_profile' ][ 'twitter' ][ 'default_count' ] != '' ? $apsc_settings[ 'social_profile' ][ 'twitter' ][ 'default_count' ] : ''; ?>"/>
                              <div class="apsc-option-note"><?php _e( 'Please enter the default count to show instead of 0 when API\'s are not available.', 'ap-social-pro' ); ?></div>
                         </div>
                    </div>
               </div>
               <div class="apsc-extra-note"><?php _e( 'Please use: [aps-get-count social_media="twitter"] to get the Twitter Count only.You can also pass count_format parameter too in this shortcode to format your count.Formats are "short" for abbreviated format and "comma" for comma separated formats.' ); ?></div>
          </div>
          <!--Twitter-->

          <!--Instagram-->
          <div class="apsc-option-outer-wrapper">
               <h4><?php _e( 'Instagram', 'accesspress-social-counter' ) ?></h4>
               <div class="apsc-option-inner-wrapper">
                    <label><?php _e( 'Display Counter', 'accesspress-social-counter' ) ?></label>
                    <div class="apsc-option-field"><label><input type="checkbox" name="social_profile[instagram][active]" value="1" class="apsc-counter-activation-trigger" <?php if ( isset( $apsc_settings[ 'social_profile' ][ 'instagram' ][ 'active' ] ) ) { ?>checked="checked"<?php } ?>/><?php _e( 'Show/Hide', 'accesspress-social-counter' ); ?></label></div>
               </div>
               <div class="apsc-option-extra">
                    <div class="apsc-option-inner-wrapper">
                         <label><?php _e( 'Instagram Username', 'accesspress-social-counter' ); ?></label>
                         <div class="apsc-option-field">
                              <input type="text" name="social_profile[instagram][username]" value="<?php echo esc_attr( $apsc_settings[ 'social_profile' ][ 'instagram' ][ 'username' ] ); ?>"/>
                              <div class="apsc-option-note"><?php _e( 'Please enter the instagram username', 'accesspress-social-counter' ); ?></div>
                         </div>
                    </div>
                    <div class="apsc-option-inner-wrapper">
                         <label><?php _e( 'Instagram User ID', 'accesspress-social-counter' ); ?></label>
                         <div class="apsc-option-field">
                              <input type="text" name="social_profile[instagram][user_id]" value="<?php echo esc_attr( $apsc_settings[ 'social_profile' ][ 'instagram' ][ 'user_id' ] ); ?>"/>
                              <div class="apsc-option-note"><?php _e( 'Please enter the instagram user ID.You can get this information from <a href="http://instagram.pixelunion.net/" target="_blank">http://www.pinceladasdaweb.com.br/instagram/access-token/</a>', 'accesspress-social-counter' ); ?></div>
                         </div>
                    </div>
                    <div class="apsc-option-inner-wrapper">
                         <label><?php _e( 'Instagram Access Token', 'accesspress-social-counter' ); ?></label>
                         <div class="apsc-option-field">
                              <input type="text" name="social_profile[instagram][access_token]" value="<?php echo esc_attr( $apsc_settings[ 'social_profile' ][ 'instagram' ][ 'access_token' ] ); ?>"/>
                              <div class="apsc-option-note"><?php _e( 'Please enter the instagram Access Token.You can get this information from <a href="http://instagram.pixelunion.net/" target="_blank">http://instagram.pixelunion.net/</a>', 'accesspress-social-counter' ); ?></div>
                         </div>
                    </div>
                    <div class="apsc-option-inner-wrapper apsc-row-odd">
                         <label><?php _e( 'Default Count', 'ap-social-pro' ); ?></label>
                         <div class="apsc-option-field">
                              <input type="text" name="social_profile[instagram][default_count]" value="<?php echo isset( $apsc_settings[ 'social_profile' ][ 'instagram' ][ 'default_count' ] ) && $apsc_settings[ 'social_profile' ][ 'instagram' ][ 'default_count' ] != '' ? $apsc_settings[ 'social_profile' ][ 'instagram' ][ 'default_count' ] : ''; ?>"/>
                              <div class="apsc-option-note"><?php _e( 'Please enter the default count to show instead of 0 when API\'s are not available.', 'ap-social-pro' ); ?></div>
                         </div>
                    </div>
               </div>
               <div class="apsc-extra-note"><?php _e( 'Please use: [aps-get-count social_media="instagram"] to get the Instagram Count only.You can also pass count_format parameter too in this shortcode to format your count.Formats are "short" for abbreviated format and "comma" for comma separated formats.' ); ?></div>
          </div>
          <!--Instagram-->

          <!--Youtube-->
          <div class="apsc-option-outer-wrapper">
               <h4><?php _e( 'Youtube', 'accesspress-social-counter' ) ?></h4>
               <div class="apsc-option-inner-wrapper">
                    <label><?php _e( 'Display Counter', 'accesspress-social-counter' ) ?></label>
                    <div class="apsc-option-field"><label><input type="checkbox" name="social_profile[youtube][active]" value="1" class="apsc-counter-activation-trigger" <?php if ( isset( $apsc_settings[ 'social_profile' ][ 'youtube' ][ 'active' ] ) ) { ?>checked="checked"<?php } ?>/><?php _e( 'Show/Hide', 'accesspress-social-counter' ); ?></label></div>
               </div>
               <div class="apsc-option-extra">
                    <div class="apsc-option-inner-wrapper">
                         <label><?php _e( 'Youtube Channel ID', 'accesspress-social-counter' ); ?></label>
                         <div class="apsc-option-field">
                              <input type="text" name="social_profile[youtube][channel_id]" value="<?php echo isset( $apsc_settings[ 'social_profile' ][ 'youtube' ][ 'channel_id' ] ) ? esc_attr( $apsc_settings[ 'social_profile' ][ 'youtube' ][ 'channel_id' ] ) : ''; ?>"/>
                              <div class="apsc-option-note"><?php _e( 'Please enter the youtube channel ID.Your channel ID looks like: UC4WMyzBds5sSZcQxyAhxJ8g. And please note that your channel ID is different from username.Please go <a href="https://support.google.com/youtube/answer/3250431?hl=en" target="_blank">here</a> to know how to get your channel ID.', 'accesspress-social-counter' ); ?></div>
                         </div>
                    </div>
                    <div class="apsc-option-inner-wrapper">
                         <label><?php _e( 'Youtube Channel URL', 'accesspress-social-counter' ); ?></label>
                         <div class="apsc-option-field">
                              <input type="text" name="social_profile[youtube][channel_url]" value="<?php echo esc_attr( $apsc_settings[ 'social_profile' ][ 'youtube' ][ 'channel_url' ] ); ?>"/>
                              <div class="apsc-option-note"><?php _e( 'Please enter the youtube channel URL.For example:https://www.youtube.com/user/accesspressthemes', 'accesspress-social-counter' ); ?></div>
                         </div>
                    </div>
                    <div class="apsc-option-inner-wrapper">
                         <label><?php _e( 'Youtube API Key', 'accesspress-social-counter' ); ?></label>
                         <div class="apsc-option-field">
                              <input type="text" name="social_profile[youtube][api_key]" value="<?php echo isset( $apsc_settings[ 'social_profile' ][ 'youtube' ][ 'api_key' ] ) ? esc_attr( $apsc_settings[ 'social_profile' ][ 'youtube' ][ 'api_key' ] ) : ''; ?>"/>
                              <div class="apsc-option-note"><?php _e( 'To get your API Key, first create a project/app in <a href="https://console.developers.google.com/project" target="_blank">https://console.developers.google.com/project</a> and then turn on both Youtube Data and Analytics API from "APIs & auth >APIs inside your project.Then again go to "APIs & auth > APIs > Credentials > Public API access" and then click "CREATE A NEW KEY" button, select the "Browser key" option and click in the "CREATE" button, and then copy your API key and paste in above field.', 'accesspress-social-counter' ); ?></div>
                         </div>
                    </div>
                    <div class="apsc-option-inner-wrapper">
                         <label><?php _e( 'Default Subscribers Count', 'accesspress-social-counter' ); ?></label>
                         <div class="apsc-option-field">
                              <input type="text" name="social_profile[youtube][subscribers_count]" value="<?php echo isset( $apsc_settings[ 'social_profile' ][ 'youtube' ][ 'subscribers_count' ] ) ? esc_attr( $apsc_settings[ 'social_profile' ][ 'youtube' ][ 'subscribers_count' ] ) : 0; ?>"/>
                              <div class="apsc-option-note"><?php _e( 'Please enter total number of subscribers that your youtube channel has in case the API fetching is failed for automatic update.', 'accesspress-social-counter' ); ?></div>
                         </div>
                    </div>
               </div>
               <div class="apsc-extra-note"><?php _e( 'Please use: [aps-get-count social_media="youtube"] to get the Youtube Count only.You can also pass count_format parameter too in this shortcode to format your count.Formats are "short" for abbreviated format and "comma" for comma separated formats.' ); ?></div>
          </div>
          <!--Youtube-->

          <!--Sound Cloud-->
          <div class="apsc-option-outer-wrapper">
               <h4><?php _e( 'Sound Cloud', 'accesspress-social-counter' ) ?></h4>
               <div class="apsc-option-inner-wrapper">
                    <label><?php _e( 'Display Counter', 'accesspress-social-counter' ) ?></label>
                    <div class="apsc-option-field"><label><input type="checkbox" name="social_profile[soundcloud][active]" value="1" class="apsc-counter-activation-trigger" <?php if ( isset( $apsc_settings[ 'social_profile' ][ 'soundcloud' ][ 'active' ] ) ) { ?>checked="checked"<?php } ?>/><?php _e( 'Show/Hide', 'accesspress-social-counter' ); ?></label></div>
               </div>
               <div class="apsc-option-extra">
                    <div class="apsc-option-inner-wrapper">
                         <label><?php _e( 'SoundCloud Username', 'accesspress-social-counter' ); ?></label>
                         <div class="apsc-option-field">
                              <input type="text" name="social_profile[soundcloud][username]" value="<?php echo $apsc_settings[ 'social_profile' ][ 'soundcloud' ][ 'username' ]; ?>"/>
                              <div class="apsc-option-note"><?php _e( 'Please enter the SoundCloud username.For example:bchettri', 'accesspress-social-counter' ); ?></div>
                         </div>
                    </div>
                    <div class="apsc-option-inner-wrapper">
                         <label><?php _e( 'SoundCloud Client ID', 'accesspress-social-counter' ); ?></label>
                         <div class="apsc-option-field">
                              <input type="text" name="social_profile[soundcloud][client_id]" value="<?php echo esc_attr( $apsc_settings[ 'social_profile' ][ 'soundcloud' ][ 'client_id' ] ); ?>"/>
                              <div class="apsc-option-note"><?php _e( 'Please enter the SoundCloud APP Client ID.You can get this information from <a href="http://soundcloud.com/you/apps/new">http://soundcloud.com/you/apps/new</a> after creating a new app', 'accesspress-social-counter' ); ?></div>
                         </div>
                    </div>
                    <div class="apsc-option-inner-wrapper apsc-row-even">
                         <label><?php _e( 'Default Count', 'ap-social-pro' ); ?></label>
                         <div class="apsc-option-field">
                              <input type="text" name="social_profile[soundcloud][default_count]" value="<?php echo isset( $apsc_settings[ 'social_profile' ][ 'soundcloud' ][ 'default_count' ] ) && $apsc_settings[ 'social_profile' ][ 'soundcloud' ][ 'default_count' ] != '' ? $apsc_settings[ 'social_profile' ][ 'soundcloud' ][ 'default_count' ] : ''; ?>"/>
                              <div class="apsc-option-note"><?php _e( 'Please enter the default count to show instead of 0 when API\'s are not available.', 'ap-social-pro' ); ?></div>
                         </div>
                    </div>
               </div>
               <div class="apsc-extra-note"><?php _e( 'Please use: [aps-get-count social_media="soundcloud"] to get the SoundCloud Count only.You can also pass count_format parameter too in this shortcode to format your count.Formats are "short" for abbreviated format and "comma" for comma separated formats.' ); ?></div>
          </div>
          <!--Sound Cloud-->

          <!--Dribbble-->
          <div class="apsc-option-outer-wrapper">
               <h4><?php _e( 'Dribbble', 'accesspress-social-counter' ) ?></h4>
               <div class="apsc-option-inner-wrapper">
                    <label><?php _e( 'Display Counter', 'accesspress-social-counter' ) ?></label>
                    <div class="apsc-option-field"><label><input type="checkbox" name="social_profile[dribbble][active]" value="1" class="apsc-counter-activation-trigger" <?php if ( isset( $apsc_settings[ 'social_profile' ][ 'dribbble' ][ 'active' ] ) ) { ?>checked="checked"<?php } ?>/><?php _e( 'Show/Hide', 'accesspress-social-counter' ); ?></label></div>
               </div>
               <div class="apsc-option-extra">
                    <div class="apsc-option-inner-wrapper">
                         <label><?php _e( 'Dribbble Username', 'accesspress-social-counter' ); ?></label>
                         <div class="apsc-option-field">
                              <input type="text" name="social_profile[dribbble][username]" value="<?php echo esc_attr( $apsc_settings[ 'social_profile' ][ 'dribbble' ][ 'username' ] ); ?>"/>
                              <div class="apsc-option-note"><?php _e( 'Please enter your dribbble username.For example:Creativedash', 'accesspress-social-counter' ); ?></div>
                         </div>
                    </div>
               </div>
               <div class="apsc-option-inner-wrapper apsc-row-odd">
                    <label><?php _e( 'Access Token', 'ap-social-pro' ); ?></label>
                    <div class="apsc-option-field">
                         <input type="text" name="social_profile[dribbble][access_token]" value="<?php
                         if ( isset( $apsc_settings[ 'social_profile' ][ 'dribbble' ][ 'access_token' ] ) ) {
                              echo $apsc_settings[ 'social_profile' ][ 'dribbble' ][ 'access_token' ];
                         }
                         ?>"/>
                         <div class="apsc-option-note"><?php _e( 'Please enter access token from your dribbble app.', 'ap-social-pro' ); ?></div>
                         <div class="apsc-option-note">
                              How to get access token? <br />
                              please login to your dribbble account first and go to <a href='https://dribbble.com/account/applications/new' target='_blank'>this</a> link and create an app. There you will need to enter your app name, Description, Website URL, Callback URL and need to accept the dribbble API terms and conditions and Click on Register Application button. Upon Registration after page reload you will get your client access token. This is the required access token.
                         </div>
                    </div>
               </div>
               <div class="apsc-option-inner-wrapper apsc-row-even">
                    <label><?php _e( 'Default Count', 'ap-social-pro' ); ?></label>
                    <div class="apsc-option-field">
                         <input type="text" name="social_profile[dribbble][default_count]" value="<?php echo isset( $apsc_settings[ 'social_profile' ][ 'dribbble' ][ 'default_count' ] ) && $apsc_settings[ 'social_profile' ][ 'dribbble' ][ 'default_count' ] != '' ? $apsc_settings[ 'social_profile' ][ 'dribbble' ][ 'default_count' ] : ''; ?>"/>
                         <div class="apsc-option-note"><?php _e( 'Please enter the default count to show instead of 0 when API\'s are not available.', 'ap-social-pro' ); ?></div>
                    </div>
               </div>
               <div class="apsc-extra-note"><?php _e( 'Please use: [aps-get-count social_media="dribbble"] to get the Dribbble Count only.You can also pass count_format parameter too in this shortcode to format your count.Formats are "short" for abbreviated format and "comma" for comma separated formats.' ); ?></div>
          </div>
          <!--Dribbble-->

          <!--Posts-->
          <div class="apsc-option-outer-wrapper">
               <h4><?php _e( "Posts", 'accesspress-social-counter' ) ?></h4>
               <div class="apsc-option-inner-wrapper">
                    <label><?php _e( 'Display Counter', 'accesspress-social-counter' ); ?></label>
                    <div class="apsc-option-field"><label><input type="checkbox" name="social_profile[posts][active]" value="1" class="apsc-counter-activation-trigger" <?php if ( isset( $apsc_settings[ 'social_profile' ][ 'posts' ][ 'active' ] ) ) { ?>checked="checked"<?php } ?>/><?php _e( 'Show/Hide', 'accesspress-social-counter' ); ?></label></div>
               </div>
               <div class="apsc-extra-note"><?php _e( 'Please use: [aps-get-count social_media="posts"] to get the Posts Count only.You can also pass count_format parameter too in this shortcode to format your count.Formats are "short" for abbreviated format and "comma" for comma separated formats.' ); ?></div>
          </div>
          <!--Posts-->

          <!--Comments-->
          <div class="apsc-option-outer-wrapper">
               <h4><?php _e( "Comments", 'accesspress-social-counter' ); ?></h4>
               <div class="apsc-option-inner-wrapper">
                    <label><?php _e( 'Display Counter', 'accesspress-social-counter' ); ?></label>
                    <div class="apsc-option-field"><label><input type="checkbox" name="social_profile[comments][active]" value="1" class="apsc-counter-activation-trigger" <?php if ( isset( $apsc_settings[ 'social_profile' ][ 'comments' ][ 'active' ] ) ) { ?>checked="checked"<?php } ?>/><?php _e( 'Show/Hide', 'accesspress-social-counter' ); ?></label></div>
               </div>
               <div class="apsc-extra-note"><?php _e( 'Please use: [aps-get-count social_media="comments"] to get the Comments Count only.You can also pass count_format parameter too in this shortcode to format your count.Formats are "short" for abbreviated format and "comma" for comma separated formats.' ); ?></div>
          </div>
          <!--Comments-->

     </div>
     <?php
include(SC_PATH . '/inc/backend/boards/save-button.php');
?>
</div>
