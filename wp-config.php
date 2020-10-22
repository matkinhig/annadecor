<?php
/**
 * Cấu hình cơ bản cho WordPress
 *
 * Trong quá trình cài đặt, file "wp-config.php" sẽ được tạo dựa trên nội dung 
 * mẫu của file này. Bạn không bắt buộc phải sử dụng giao diện web để cài đặt, 
 * chỉ cần lưu file này lại với tên "wp-config.php" và điền các thông tin cần thiết.
 *
 * File này chứa các thiết lập sau:
 *
 * * Thiết lập MySQL
 * * Các khóa bí mật
 * * Tiền tố cho các bảng database
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Thiết lập MySQL - Bạn có thể lấy các thông tin này từ host/server ** //
/** Tên database MySQL */
define( 'DB_NAME', 'annadecor' );

/** Username của database */
define( 'DB_USER', 'root' );

/** Mật khẩu của database */
define( 'DB_PASSWORD', '' );

/** Hostname của database */
define( 'DB_HOST', 'localhost' );

/** Database charset sử dụng để tạo bảng database. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Kiểu database collate. Đừng thay đổi nếu không hiểu rõ. */
define('DB_COLLATE', '');

/**#@+
 * Khóa xác thực và salt.
 *
 * Thay đổi các giá trị dưới đây thành các khóa không trùng nhau!
 * Bạn có thể tạo ra các khóa này bằng công cụ
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * Bạn có thể thay đổi chúng bất cứ lúc nào để vô hiệu hóa tất cả
 * các cookie hiện có. Điều này sẽ buộc tất cả người dùng phải đăng nhập lại.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '~@U3Y-o7*dvX=dD+@BO#a[`eD//Ad}8Hz{fF73qvpg{[&.D is:S>mL<C`}A[qXI' );
define( 'SECURE_AUTH_KEY',  '5dey~+Z,(H@O5z7;|8!#EBg6o.J@lv+~{$4|,l5P~vQy>_7)O!TNiVTC+D508)c2' );
define( 'LOGGED_IN_KEY',    '-K,HQ_[y%0Pmr/Dakg_}5^~:d(/F-UGV)h[ 3Vy4wyJJe-_XfGwp<c)C2#)uXDGk' );
define( 'NONCE_KEY',        ';P<hkSBw;@g%n_OQ?/Uh7MTFrFLx<)Siy*|t2B0XYrc;4AaHy||7l<Wtjs8]e<d&' );
define( 'AUTH_SALT',        '}wJ,O_C:a)QGLJcUAOi>M@MU9dPoB44GnZ-GQ:D26~ZdUlE2NUsmZh8kUMGfp;GT' );
define( 'SECURE_AUTH_SALT', 'V%~YV#4ChxL!X 45B7Nr^%p>1dPjKoy6lRT_h0I+4xxMP!d!nIWasQ$lzc-{H4(Y' );
define( 'LOGGED_IN_SALT',   '%Fk9f`j#kL.mz8iuSWQZXEJ00ljlU#H,R9[L=n+,wgGRPlhz;#>O%ly|Ofjx*)&z' );
define( 'NONCE_SALT',       'C/.Vv(9K(g/4VF#GA`88x<m!NqSETY9#3/HeD}}Gg<R`1`V%Md}b2Wy24ZdVo9|!' );

/**#@-*/

/**
 * Tiền tố cho bảng database.
 *
 * Đặt tiền tố cho bảng giúp bạn có thể cài nhiều site WordPress vào cùng một database.
 * Chỉ sử dụng số, ký tự và dấu gạch dưới!
 */
$table_prefix = 'wp_';

/**
 * Dành cho developer: Chế độ debug.
 *
 * Thay đổi hằng số này thành true sẽ làm hiện lên các thông báo trong quá trình phát triển.
 * Chúng tôi khuyến cáo các developer sử dụng WP_DEBUG trong quá trình phát triển plugin và theme.
 *
 * Để có thông tin về các hằng số khác có thể sử dụng khi debug, hãy xem tại Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* Đó là tất cả thiết lập, ngưng sửa từ phần này trở xuống. Chúc bạn viết blog vui vẻ. */

/** Đường dẫn tuyệt đối đến thư mục cài đặt WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Thiết lập biến và include file. */
require_once(ABSPATH . 'wp-settings.php');
