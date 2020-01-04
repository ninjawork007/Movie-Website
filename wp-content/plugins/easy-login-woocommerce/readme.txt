=== Login/Signup Popup ( Inline Form + Woocommerce ) ===
Contributors: XootiX
Donate link: https://www.paypal.me/xootix
Tags: woocommerce login popup, woocommerce signup popup, woocommerce login, woocommerce, login popup, signup, ajax login, ajax modal, login modal
Requires at least: 3.0.1
Tested up to: 5.2.1
Stable tag: 1.3
License: GPLv2
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Allow users to login/signup anywhere from the site with the simple pop up.

== Description ==
[Live Demo](http://demo.xootix.com/easy-login-for-woocommerce/)
Login/Signup Popup is a simple & light weight plugin which allow users to login/signup anywhere from the site with the simple pop up without refreshing page.

### Features And Options:
* Supports Woocommerce
* Fully Ajaxed.
* Login , Sign up , Lost Password form.
* Login from anywere on the page using shortcode.
* Fully Customizable.
* WPML compatible

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/ directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress
3. Click on Login/Signup Popup on the dashboard.

== Frequently Asked Questions ==

= How to setup? =
1. Go to apperance->menus
2. Under Login Popup Tab , select the desired option.

= Shortcodes =
Use shortcode [xoo_el_action] to include it anywhere on the website.
To trigger particular form.
Login         - [xoo_el_action action="login"]
Registration  - [xoo_el_action action="register"]
Lost Password - [xoo_el_action action="lost-password"]

You can also trigger popup using class.
Login         - xoo-el-login-tgr
Register      - xoo-el-reg-tgr
Lost Password - xoo-el-lostpw-tgr
For eg: <a class="xoo-el-login-tgr">Login</a>

= How to translate? =
1. Download PoEdit.
2. Open the easy-login-woocommerce.pot file in PoEdit. (/plugins/easy-login-woocommerce/languages/
   easy-login-woocommerce.pot)
3. Create new translation & translate the text.
4. Save the translated file with name "easy-login-woocommerce-Language_code". For eg: German(easy-login-woocommerce-de_DE)
   , French(easy-login-woocommerce-fr_FR). -- [Language code list](https://make.wordpress.org/polyglots/teams/)
5. Save Location: Your wordpress directory/wp-content/languages/


= How to override templates? =
Same way as you do for woocommerce.
Plugin template files are under easy-login-woocommerce/templates folder.
If you want to edit the template , say for login form. Template is xoo-el-login-section.php.
Create a woocommerce folder in your theme's directory & create a new file with name xoo-el-login-section.php , make the desired changes.


== Screenshots ==
1. Login Form.
2. Registration form with input validation
3. Lost password form.
4. Lost password email sent


== Changelog ==

= 1.3 =
* Major Release.
* New - Form input icons.
* New - Remember me checkbox.
* New - Terms and conditions checkbox.
* Tweak - Template changes
* Tweak - Removed font awesome icons , added custom font icons.

= 1.2 =
* Fix - Not working on mobile devices.
* New - Sidebar Image.
* New - Popup animation.

= 1.1 =
* Fix - Not working on mobile devices.
* New - Extra input padding.

= 1.0.0 =
* Initial Public Release.