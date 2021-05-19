<?php

if ( ! class_exists( 'MO_Admin_Notice' ) ) {

    class MO_Admin_Notice {
        public function __construct() {
            add_action( 'admin_notices', array( $this, 'admin_notice' ) );
            add_action( 'network_admin_notices', array( $this, 'admin_notice' ) );

            add_action( 'admin_init', array( $this, 'dismiss_admin_notice' ) );
        }

        public function dismiss_admin_notice() {
            if ( ! isset( $_GET['mo-adaction'] ) || $_GET['mo-adaction'] != 'mo_dismiss_adnotice' ) {
                return;
            }

            $url = admin_url();
            update_option( 'mo_dismiss_adnotice', 'true' );

            wp_redirect( $url );
            exit;
        }

        public function admin_notice() {

            global $pagenow;

            if($pagenow == 'index.php' || (isset($_GET['page']) && strpos($_GET['page'], 'wp-user-avatar') !== false)) {

                if (get_option('mo_dismiss_adnotice', 'false') == 'true') {
                    return;
                }

                if ($this->is_plugin_installed() && $this->is_plugin_active()) {
                    return;
                }

                $dismiss_url = esc_url_raw(
                    add_query_arg(
                        array(
                            'mo-adaction' => 'mo_dismiss_adnotice'
                        ),
                        admin_url()
                    )
                );
                $this->notice_css();
                $install_url = wp_nonce_url(
                    admin_url('update.php?action=install-plugin&plugin=mailoptin'),
                    'install-plugin_mailoptin'
                );

                $activate_url = wp_nonce_url(admin_url('plugins.php?action=activate&plugin=mailoptin%2Fmailoptin.php'), 'activate-plugin_mailoptin/mailoptin.php');
                ?>
                <div class="mo-admin-notice notice notice-success">
                    <div class="mo-notice-first-half">
                        <p>
                            <?php
                            printf(
                                __('Free optin form plugin that will increase revenue, %1$sincrease your email subscribers%2$s and keep them engaged with %1$sautomated and schedule newsletters%2$s.'),
                                '<span class="mo-stylize"><strong>', '</strong></span>');
                            ?>
                        </p>
                        <p style="text-decoration: underline;font-size: 12px;">Recommended by WP User Avatar</p>
                    </div>
                    <div class="mo-notice-other-half">
                        <?php if ( ! $this->is_plugin_installed()) : ?>
                            <a class="button button-primary button-hero" id="mo-install-mailoptin-plugin" href="<?php echo $install_url; ?>">
                                <?php _e('Install MailOptin Now for Free!'); ?>
                            </a>
                        <?php endif; ?>
                        <?php if ($this->is_plugin_installed() && ! $this->is_plugin_active()) : ?>
                            <a class="button button-primary button-hero" id="mo-activate-mailoptin-plugin" href="<?php echo $activate_url; ?>">
                                <?php _e('Activate MailOptin Now!'); ?>
                            </a>
                        <?php endif; ?>
                        <div class="mo-notice-learn-more">
                            <a target="_blank" href="https://mailoptin.io">Learn more</a>|<a href="<?php echo $dismiss_url;?>">Dismiss notice</a>
                        </div>
                    </div>
                    <a href="<?php echo $dismiss_url; ?>">
                        <button type="button" class="notice-dismiss">
                            <span class="screen-reader-text"><?php _e('Dismiss this notice'); ?>.</span>
                        </button>
                    </a>
                </div>
                <?php
            }
        }

        public function current_admin_url() {
            $parts = parse_url( home_url() );
            $uri   = $parts['scheme'] . '://' . $parts['host'];

            if ( array_key_exists( 'port', $parts ) ) {
                $uri .= ':' . $parts['port'];
            }

            $uri .= add_query_arg( array() );

            return $uri;
        }

        public function is_plugin_installed() {
            $installed_plugins = get_plugins();

            return isset( $installed_plugins['mailoptin/mailoptin.php'] );
        }

        public function is_plugin_active() {
            return is_plugin_active( 'mailoptin/mailoptin.php' );
        }

        public function notice_css() {
            ?>
            <style type="text/css">
                .mo-admin-notice {
                    background: #fff;
                    color: #000;
                    border-left-color: #46b450;
                    position: relative;
                }

                .mo-admin-notice .notice-dismiss:before {
                    color: #72777c;
                }

                .mo-admin-notice .mo-stylize {
                    line-height: 2;
                }

                .mo-admin-notice .button-primary {
                    background: #006799;
                    text-shadow: none;
                    border: 0;
                    box-shadow: none;
                }

                .mo-notice-first-half {
                    width: 66%;
                    display: inline-block;
                    margin: 10px 0;
                }

                .mo-notice-other-half {
                    width: 33%;
                    display: inline-block;
                    padding: 20px 0;
                    position: absolute;
                    text-align: center;
                }

                .mo-notice-first-half p {
                    font-size: 14px;
                }

                .mo-notice-learn-more a {
                    margin: 10px;
                }

                .mo-notice-learn-more {
                    margin-top: 10px;
                }
            </style>
            <?php
        }

        public static function instance() {
            static $instance = null;

            if ( is_null( $instance ) ) {
                $instance = new self();
            }

            return $instance;
        }
    }

    MO_Admin_Notice::instance();
}