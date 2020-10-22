<?php

/* 
 * import data
 */

function pikowroks_dummy_importer_files()
{
  $main_domain = 'http://demo.themepiko.com/stock/';

  return array(
    array(
      'import_file_name'             => 'Default',
      'categories'                   => array('Demo'),
      'local_import_file'            => PIKOWORKS_DUMMY_DIR_PATH . 'dummy/default/dummy.xml',
      'local_import_widget_file'     => PIKOWORKS_DUMMY_DIR_PATH . 'dummy/default/widgets.json',
      'local_import_redux'           => array(
        array(
          'file_path'   => PIKOWORKS_DUMMY_DIR_PATH . 'dummy/default/options.json',
          'option_name' => 'xtocky',
        ),
      ),
      'import_preview_image_url'     => PIKOWORKS_DUMMY_BASE_URL . 'dummy/default/screenshot.jpg',
      'preview_url'                  => $main_domain . 'default',
    ),
    array(
      'import_file_name'             => 'Main',
      'categories'                   => array('Demo'),
      'local_import_file'            => PIKOWORKS_DUMMY_DIR_PATH . 'dummy/main/dummy.xml',
      'local_import_widget_file'     => PIKOWORKS_DUMMY_DIR_PATH . 'dummy/main/widgets.json',
      'local_import_redux'           => array(
        array(
          'file_path'   => PIKOWORKS_DUMMY_DIR_PATH . 'dummy/main/options.json',
          'option_name' => 'xtocky',
        ),
      ),
      'import_preview_image_url'     => PIKOWORKS_DUMMY_BASE_URL . 'dummy/main/screenshot.jpg',
      'preview_url'                  => $main_domain . 'default',
    ),
    array(
      'import_file_name'             => 'Electronics',
      'categories'                   => array('Demo'),
      'local_import_file'            => PIKOWORKS_DUMMY_DIR_PATH . 'dummy/electronics/dummy.xml',
      'local_import_widget_file'     => PIKOWORKS_DUMMY_DIR_PATH . 'dummy/electronics/widgets.json',
      'local_import_redux'           => array(
        array(
          'file_path'   => PIKOWORKS_DUMMY_DIR_PATH . 'dummy/electronics/options.json',
          'option_name' => 'xtocky',
        ),
      ),
      'import_preview_image_url'     => PIKOWORKS_DUMMY_BASE_URL . 'dummy/electronics/screenshot.jpg',
      'preview_url'                  => $main_domain . 'electronics',
    ),
    array(
      'import_file_name'             => 'Petstock',
      'categories'                   => array('Demo'),
      'local_import_file'            => PIKOWORKS_DUMMY_DIR_PATH . 'dummy/petstock/dummy.xml',
      'local_import_widget_file'     => PIKOWORKS_DUMMY_DIR_PATH . 'dummy/petstock/widgets.json',
      'local_import_redux'           => array(
        array(
          'file_path'   => PIKOWORKS_DUMMY_DIR_PATH . 'dummy/petstock/options.json',
          'option_name' => 'xtocky',
        ),
      ),
      'import_preview_image_url'     => PIKOWORKS_DUMMY_BASE_URL . 'dummy/petstock/screenshot.jpg',
      'preview_url'                  => $main_domain . 'petstock',
    ),
    array(
      'import_file_name'             => 'Motostock',
      'categories'                   => array('Demo'),
      'local_import_file'            => PIKOWORKS_DUMMY_DIR_PATH . 'dummy/motostock/dummy.xml',
      'local_import_widget_file'     => PIKOWORKS_DUMMY_DIR_PATH . 'dummy/motostock/widgets.json',
      'local_import_redux'           => array(
        array(
          'file_path'   => PIKOWORKS_DUMMY_DIR_PATH . 'dummy/motostock/options.json',
          'option_name' => 'xtocky',
        ),
      ),
      'import_preview_image_url'     => PIKOWORKS_DUMMY_BASE_URL . 'dummy/motostock/screenshot.jpg',
      'preview_url'                  => $main_domain . 'motostock',
    ),
    array(
      'import_file_name'             => 'Babyshop',
      'categories'                   => array('Demo'),
      'local_import_file'            => PIKOWORKS_DUMMY_DIR_PATH . 'dummy/babyshop/dummy.xml',
      'local_import_widget_file'     => PIKOWORKS_DUMMY_DIR_PATH . 'dummy/babyshop/widgets.json',
      'local_import_redux'           => array(
        array(
          'file_path'   => PIKOWORKS_DUMMY_DIR_PATH . 'dummy/babyshop/options.json',
          'option_name' => 'xtocky',
        ),
      ),
      'import_preview_image_url'     => PIKOWORKS_DUMMY_BASE_URL . 'dummy/babyshop/screenshot.jpg',
      'preview_url'                  => $main_domain . 'babyshop',
    ),
    array(
      'import_file_name'             => 'Organic',
      'categories'                   => array('Demo'),
      'local_import_file'            => PIKOWORKS_DUMMY_DIR_PATH . 'dummy/organic/dummy.xml',
      'local_import_widget_file'     => PIKOWORKS_DUMMY_DIR_PATH . 'dummy/organic/widgets.json',
      'local_import_redux'           => array(
        array(
          'file_path'   => PIKOWORKS_DUMMY_DIR_PATH . 'dummy/organic/options.json',
          'option_name' => 'xtocky',
        ),
      ),
      'import_preview_image_url'     => PIKOWORKS_DUMMY_BASE_URL . 'dummy/organic/screenshot.jpg',
      'preview_url'                  => $main_domain . 'organic',
    ),
    array(
      'import_file_name'             => 'Wedding',
      'categories'                   => array('Demo'),
      'local_import_file'            => PIKOWORKS_DUMMY_DIR_PATH . 'dummy/wedding/dummy.xml',
      'local_import_widget_file'     => PIKOWORKS_DUMMY_DIR_PATH . 'dummy/wedding/widgets.json',
      'local_import_redux'           => array(
        array(
          'file_path'   => PIKOWORKS_DUMMY_DIR_PATH . 'dummy/wedding/options.json',
          'option_name' => 'xtocky',
        ),
      ),
      'import_preview_image_url'     => PIKOWORKS_DUMMY_BASE_URL . 'dummy/wedding/screenshot.jpg',
      'preview_url'                  => $main_domain . 'wedding',
    ),
    array(
      'import_file_name'             => 'Furniture',
      'categories'                   => array('Demo'),
      'local_import_file'            => PIKOWORKS_DUMMY_DIR_PATH . 'dummy/furniture/dummy.xml',
      'local_import_widget_file'     => PIKOWORKS_DUMMY_DIR_PATH . 'dummy/furniture/widgets.json',
      'local_import_redux'           => array(
        array(
          'file_path'   => PIKOWORKS_DUMMY_DIR_PATH . 'dummy/furniture/options.json',
          'option_name' => 'xtocky',
        ),
      ),
      'import_preview_image_url'     => PIKOWORKS_DUMMY_BASE_URL . 'dummy/furniture/screenshot.jpg',
      'preview_url'                  => $main_domain . 'furniture',
    ),
    array(
      'import_file_name'             => 'Jewelry',
      'categories'                   => array('Demo'),
      'local_import_file'            => PIKOWORKS_DUMMY_DIR_PATH . 'dummy/jewelry/dummy.xml',
      'local_import_widget_file'     => PIKOWORKS_DUMMY_DIR_PATH . 'dummy/jewelry/widgets.json',
      'local_import_redux'           => array(
        array(
          'file_path'   => PIKOWORKS_DUMMY_DIR_PATH . 'dummy/jewelry/options.json',
          'option_name' => 'xtocky',
        ),
      ),
      'import_preview_image_url'     => PIKOWORKS_DUMMY_BASE_URL . 'dummy/jewelry/screenshot.jpg',
      'preview_url'                  => $main_domain . 'jewelry',
    ),
    array(
      'import_file_name'             => 'Cosmetics',
      'categories'                   => array('Demo'),
      'local_import_file'            => PIKOWORKS_DUMMY_DIR_PATH . 'dummy/cosmetics/dummy.xml',
      'local_import_widget_file'     => PIKOWORKS_DUMMY_DIR_PATH . 'dummy/cosmetics/widgets.json',
      'local_import_redux'           => array(
        array(
          'file_path'   => PIKOWORKS_DUMMY_DIR_PATH . 'dummy/cosmetics/options.json',
          'option_name' => 'xtocky',
        ),
      ),
      'import_preview_image_url'     => PIKOWORKS_DUMMY_BASE_URL . 'dummy/cosmetics/screenshot.jpg',
      'preview_url'                  => $main_domain . 'cosmetics',
    ),
    array(
      'import_file_name'             => 'Dokan',
      'categories'                   => array('Demo', 'Multi Vendor'),
      'local_import_file'            => PIKOWORKS_DUMMY_DIR_PATH . 'dummy/dokan/dummy.xml',
      'local_import_widget_file'     => PIKOWORKS_DUMMY_DIR_PATH . 'dummy/dokan/widgets.json',
      'local_import_redux'           => array(
        array(
          'file_path'   => PIKOWORKS_DUMMY_DIR_PATH . 'dummy/dokan/options.json',
          'option_name' => 'xtocky',
        ),
      ),
      'import_preview_image_url'     => PIKOWORKS_DUMMY_BASE_URL . 'dummy/dokan/screenshot.jpg',
      'import_notice'                => wp_kses(__('IMPORTANT: Please Active first: Dokan Multi vendor Plugins if not active this plugins importing demo content missing. <a href="https://wordpress.org/plugins/dokan-lite/" target="_blank">Dokan Plugins download</a>', 'pikoworks_dummy'), array('br', 'a' => array('href' => array(),'target' => array() ), 'b')),
      'preview_url'                  => $main_domain . 'dokan',
    ),
    array(
      'import_file_name'             => 'Vendor',
      'categories'                   => array('Demo', 'Multi Vendor'),
      'local_import_file'            => PIKOWORKS_DUMMY_DIR_PATH . 'dummy/vendor/dummy.xml',
      'local_import_widget_file'     => PIKOWORKS_DUMMY_DIR_PATH . 'dummy/vendor/widgets.json',
      'local_import_redux'           => array(
        array(
          'file_path'   => PIKOWORKS_DUMMY_DIR_PATH . 'dummy/vendor/options.json',
          'option_name' => 'xtocky',
        ),
      ),
      'import_preview_image_url'     => PIKOWORKS_DUMMY_BASE_URL . 'dummy/vendor/screenshot.jpg',
      'import_notice'                => wp_kses(__('IMPORTANT: Please Active first: WC Multi vendor and BuddyPress Plugins if not active those plugins importing demo content missing. <a href="https://wordpress.org/plugins/wc-vendors/" target="_blank">Dokan Plugins download</a> and <a href="https://wordpress.org/plugins/buddypress/" target="_blank">BuddyPress Plugins download</a>', 'pikoworks_dummy'), array('br', 'a' => array('href' => array(),'target' => array() ), 'b')),
      'preview_url'                  => $main_domain . 'vendor',
    ),
    array(
      'import_file_name'             => 'Demo_rtl',
      'categories'                   => array('Demo', 'RTL'),
      'local_import_file'            => PIKOWORKS_DUMMY_DIR_PATH . 'dummy/demo_rtl/dummy.xml',
      'local_import_widget_file'     => PIKOWORKS_DUMMY_DIR_PATH . 'dummy/demo_rtl/widgets.json',
      'local_import_redux'           => array(
        array(
          'file_path'   => PIKOWORKS_DUMMY_DIR_PATH . 'dummy/demo_rtl/options.json',
          'option_name' => 'xtocky',
        ),
      ),
      'import_preview_image_url'     => PIKOWORKS_DUMMY_BASE_URL . 'dummy/demo_rtl/screenshot.jpg',
      'preview_url'                  => $main_domain . 'rtl',
    ),
    array(
      'import_file_name'             => 'Sunglass',
      'categories'                   => array('Demo'),
      'local_import_file'            => PIKOWORKS_DUMMY_DIR_PATH . 'dummy/sunglass/dummy.xml',
      'local_import_widget_file'     => PIKOWORKS_DUMMY_DIR_PATH . 'dummy/sunglass/widgets.json',
      'local_import_redux'           => array(
        array(
          'file_path'   => PIKOWORKS_DUMMY_DIR_PATH . 'dummy/sunglass/options.json',
          'option_name' => 'xtocky',
        ),
      ),
      'import_preview_image_url'     => PIKOWORKS_DUMMY_BASE_URL . 'dummy/sunglass/screenshot.jpg',
      'preview_url'                  => $main_domain . 'sunglass',
    ),
    array(
      'import_file_name'             => 'Home_2',
      'categories'                   => array('Home Page'),
      'local_import_file'            => PIKOWORKS_DUMMY_DIR_PATH . 'dummy/home_2/dummy.xml',
      'import_preview_image_url'     => PIKOWORKS_DUMMY_BASE_URL . 'dummy/home_2/screenshot.jpg',
      'preview_url'                  => $main_domain . 'default/home2/',
    ),
    array(
      'import_file_name'             => 'Home_3',
      'categories'                   => array('Home Page'),
      'local_import_file'            => PIKOWORKS_DUMMY_DIR_PATH . 'dummy/home_3/dummy.xml',
      'import_preview_image_url'     => PIKOWORKS_DUMMY_BASE_URL . 'dummy/home_3/screenshot.jpg',
      'preview_url'                  => $main_domain . 'default/home3/',
    ),
    array(
      'import_file_name'             => 'Home_4',
      'categories'                   => array('Home Page'),
      'local_import_file'            => PIKOWORKS_DUMMY_DIR_PATH . 'dummy/home_4/dummy.xml',
      'import_preview_image_url'     => PIKOWORKS_DUMMY_BASE_URL . 'dummy/home_4/screenshot.jpg',
      'preview_url'                  => $main_domain . 'default/home4/',
    ),
    array(
      'import_file_name'             => 'Home_5',
      'categories'                   => array('Home Page'),
      'local_import_file'            => PIKOWORKS_DUMMY_DIR_PATH . 'dummy/home_5/dummy.xml',
      'import_preview_image_url'     => PIKOWORKS_DUMMY_BASE_URL . 'dummy/home_5/screenshot.jpg',
      'preview_url'                  => $main_domain . 'default/home5/',
    ),
    array(
      'import_file_name'             => 'Home_6',
      'categories'                   => array('Home Page'),
      'local_import_file'            => PIKOWORKS_DUMMY_DIR_PATH . 'dummy/home_6/dummy.xml',
      'import_preview_image_url'     => PIKOWORKS_DUMMY_BASE_URL . 'dummy/home_6/screenshot.jpg',
      'preview_url'                  => $main_domain . 'default/home6/',
    ),
    array(
      'import_file_name'             => 'Home_7',
      'categories'                   => array('Home Page'),
      'local_import_file'            => PIKOWORKS_DUMMY_DIR_PATH . 'dummy/home_7/dummy.xml',
      'import_preview_image_url'     => PIKOWORKS_DUMMY_BASE_URL . 'dummy/home_7/screenshot.jpg',
      'preview_url'                  => $main_domain . 'default/home7/',
    ),
    array(
      'import_file_name'             => 'Home_8',
      'categories'                   => array('Home Page'),
      'local_import_file'            => PIKOWORKS_DUMMY_DIR_PATH . 'dummy/home_8/dummy.xml',
      'import_preview_image_url'     => PIKOWORKS_DUMMY_BASE_URL . 'dummy/home_8/screenshot.jpg',
      'preview_url'                  => $main_domain . 'default/home8/',
    ),
    array(
      'import_file_name'             => 'Home_9',
      'categories'                   => array('Home Page'),
      'local_import_file'            => PIKOWORKS_DUMMY_DIR_PATH . 'dummy/home_9/dummy.xml',
      'import_preview_image_url'     => PIKOWORKS_DUMMY_BASE_URL . 'dummy/home_9/screenshot.jpg',
      'preview_url'                  => $main_domain . 'default/home9/',
    ),
    array(
      'import_file_name'             => 'Home_10',
      'categories'                   => array('Home Page'),
      'local_import_file'            => PIKOWORKS_DUMMY_DIR_PATH . 'dummy/home_10/dummy.xml',
      'import_preview_image_url'     => PIKOWORKS_DUMMY_BASE_URL . 'dummy/home_10/screenshot.jpg',
      'preview_url'                  => $main_domain . 'default/home10/',
    ),
    array(
      'import_file_name'             => 'Home_11',
      'categories'                   => array('Home Page'),
      'local_import_file'            => PIKOWORKS_DUMMY_DIR_PATH . 'dummy/home_11/dummy.xml',
      'import_preview_image_url'     => PIKOWORKS_DUMMY_BASE_URL . 'dummy/home_11/screenshot.jpg',
      'preview_url'                  => $main_domain . 'default/home11/',
    ),
    array(
      'import_file_name'             => 'Home_12',
      'categories'                   => array('Home Page'),
      'local_import_file'            => PIKOWORKS_DUMMY_DIR_PATH . 'dummy/home_12/dummy.xml',
      'import_preview_image_url'     => PIKOWORKS_DUMMY_BASE_URL . 'dummy/home_12/screenshot.jpg',
      'preview_url'                  => $main_domain . 'default/home12/',
    ),
    array(
      'import_file_name'             => 'vendor_home',
      'categories'                   => array('Home Page'),
      'local_import_file'            => PIKOWORKS_DUMMY_DIR_PATH . 'dummy/vendor_home/dummy.xml',
      'import_preview_image_url'     => PIKOWORKS_DUMMY_BASE_URL . 'dummy/vendor_home/screenshot.jpg',
      'preview_url'                  => $main_domain . 'vendor/',
    ),
    array(
      'import_file_name'             => 'About_us',
      'categories'                   => array('Other Page'),
      'local_import_file'            => PIKOWORKS_DUMMY_DIR_PATH . 'dummy/about_us/dummy.xml',
      'import_preview_image_url'     => PIKOWORKS_DUMMY_BASE_URL . 'dummy/about_us/screenshot.jpg',
      'preview_url'                  => $main_domain . 'default/about-us/',
    ),
    array(
      'import_file_name'             => 'About_Me',
      'categories'                   => array('Other Page'),
      'local_import_file'            => PIKOWORKS_DUMMY_DIR_PATH . 'dummy/about_me/dummy.xml',
      'import_preview_image_url'     => PIKOWORKS_DUMMY_BASE_URL . 'dummy/about_me/screenshot.jpg',
      'preview_url'                  => $main_domain . 'default/about-me/',
    ),
    array(
      'import_file_name'             => 'Faq',
      'categories'                   => array('Other Page'),
      'local_import_file'            => PIKOWORKS_DUMMY_DIR_PATH . 'dummy/faq/dummy.xml',
      'import_preview_image_url'     => PIKOWORKS_DUMMY_BASE_URL . 'dummy/faq/screenshot.jpg',
      'preview_url'                  => $main_domain . 'default/faq/',
    ),
    array(
      'import_file_name'             => 'Team',
      'categories'                   => array('Other Page'),
      'local_import_file'            => PIKOWORKS_DUMMY_DIR_PATH . 'dummy/team/dummy.xml',
      'import_preview_image_url'     => PIKOWORKS_DUMMY_BASE_URL . 'dummy/team/screenshot.jpg',
      'preview_url'                  => $main_domain . 'default/team-layout/',
    ),
    array(
      'import_file_name'             => 'Portfolios',
      'categories'                   => array('Other Page'),
      'local_import_file'            => PIKOWORKS_DUMMY_DIR_PATH . 'dummy/portfolios/dummy.xml',
      'import_preview_image_url'     => PIKOWORKS_DUMMY_BASE_URL . 'dummy/portfolios/screenshot.jpg',
      'preview_url'                  => $main_domain . 'default/portfolios/portfolio-grid-4col/',
    ),
    array(
      'import_file_name'             => 'Testimonial',
      'categories'                   => array('Other Page'),
      'local_import_file'            => PIKOWORKS_DUMMY_DIR_PATH . 'dummy/testimonial/dummy.xml',
      'import_preview_image_url'     => PIKOWORKS_DUMMY_BASE_URL . 'dummy/testimonial/screenshot.jpg',
      'preview_url'                  => $main_domain . 'default/testimonial-layout/',
    ),

  );
}
add_filter('pt-ocdi/import_files', 'pikowroks_dummy_importer_files');

function pikoworks_dummy_after_importer_setup($selected_import)
{
  // Assign menus to their locations.
  $main_menu = get_term_by('name', 'Primary Menu', 'nav_menu');
  $login_menu = get_term_by('name', 'Primary Login Menu', 'nav_menu');
  $top_menu = get_term_by('name', 'Top Menu', 'nav_menu');
  $footer_menu = get_term_by('name', 'Footer Menu', 'nav_menu');
  $category_menu = get_term_by('name', 'Vertical Menu', 'nav_menu');
  $secondary_menu = get_term_by('name', 'Scondary Menu Style6', 'nav_menu');

  set_theme_mod(
    'nav_menu_locations',
    array(
      'primary' => $main_menu->term_id,
      'primary_login' => $login_menu->term_id,
      'top_menu' => $top_menu->term_id,
      'footer' => $footer_menu->term_id,
      'category' => $category_menu->term_id,
      'secondary' => $secondary_menu->term_id,
    )
  );

  // Assign front page and posts page (blog page).
  $front_page_id = get_page_by_title('Home');
  $blog_page_id  = get_page_by_title('Blog');

  update_option('show_on_front', 'page');
  update_option('page_on_front', $front_page_id->ID);
  update_option('page_for_posts', $blog_page_id->ID);


  if (class_exists('RevSlider')) {

    if ('Default' === $selected_import['import_file_name']) {
      $slider_array = array(
        PIKOWORKS_DUMMY_DIR_PATH . "dummy/default/slider.zip"
      );
    }elseif ('Main' === $selected_import['import_file_name']) {
      $slider_array = array(
        PIKOWORKS_DUMMY_DIR_PATH . "dummy/main/slider.zip"
      );
    }elseif ('Electronics' === $selected_import['import_file_name']) {
      $slider_array = array(
        PIKOWORKS_DUMMY_DIR_PATH . "dummy/electronics/slider.zip",
        PIKOWORKS_DUMMY_DIR_PATH . "dummy/electronics/slider1.zip"
      );
    }elseif ('Petstock' === $selected_import['import_file_name']) {
      $slider_array = array(
        PIKOWORKS_DUMMY_DIR_PATH . "dummy/petstock/h1_slider1.zip",
        PIKOWORKS_DUMMY_DIR_PATH . "dummy/petstock/h2_slider1.zip",
        PIKOWORKS_DUMMY_DIR_PATH . "dummy/petstock/h3_slider1.zip"
      );
    }elseif ('Motostock' === $selected_import['import_file_name']) {
      $slider_array = array(
        PIKOWORKS_DUMMY_DIR_PATH . "dummy/motostock/h1_Slider_1.zip",
        PIKOWORKS_DUMMY_DIR_PATH . "dummy/motostock/h2_slider_1.zip",
        PIKOWORKS_DUMMY_DIR_PATH . "dummy/motostock/h3-slider_1.zip"
      );
    }elseif ('Babyshop' === $selected_import['import_file_name']) {
      $slider_array = array(
        PIKOWORKS_DUMMY_DIR_PATH . "dummy/babyshop/home1.zip",
        PIKOWORKS_DUMMY_DIR_PATH . "dummy/babyshop/home2.zip",
        PIKOWORKS_DUMMY_DIR_PATH . "dummy/babyshop/home_3.zip"
      );
    }elseif ('Organic' === $selected_import['import_file_name']) {
      $slider_array = array(
        PIKOWORKS_DUMMY_DIR_PATH . "dummy/organic/home-01.zip",
        PIKOWORKS_DUMMY_DIR_PATH . "dummy/organic/home-02.zip",
        PIKOWORKS_DUMMY_DIR_PATH . "dummy/organic/home-03.zip"
      );
    }elseif ('Wedding' === $selected_import['import_file_name']) {
      $slider_array = array(
        PIKOWORKS_DUMMY_DIR_PATH . "dummy/wedding/home1.zip",
        PIKOWORKS_DUMMY_DIR_PATH . "dummy/wedding/home2.zip",
        PIKOWORKS_DUMMY_DIR_PATH . "dummy/wedding/home_3.zip"
      );
    }elseif ('Furniture' === $selected_import['import_file_name']) {
      $slider_array = array(
        PIKOWORKS_DUMMY_DIR_PATH . "dummy/furniture/slider.zip"
      );
    }elseif ('Jewelry' === $selected_import['import_file_name']) {
      $slider_array = array(
        PIKOWORKS_DUMMY_DIR_PATH . "dummy/jewelry/slider.zip"
      );
    }elseif ('Cosmetics' === $selected_import['import_file_name']) {
      $slider_array = array(
        PIKOWORKS_DUMMY_DIR_PATH . "dummy/cosmetics/slider.zip"
      );
    }elseif ('Dokan' === $selected_import['import_file_name']) {
      $slider_array = array(
        PIKOWORKS_DUMMY_DIR_PATH . "dummy/dokan/slider.zip"
      );
    }elseif ('Vendor' === $selected_import['import_file_name']) {
      $slider_array = array(
        PIKOWORKS_DUMMY_DIR_PATH . "dummy/vendor/slider.zip",
        PIKOWORKS_DUMMY_DIR_PATH . "dummy/vendor/slider1.zip"
      );
    }elseif ('Demo_rtl' === $selected_import['import_file_name']) {
      $slider_array = array(
        PIKOWORKS_DUMMY_DIR_PATH . "dummy/demo_rtl/slider.zip"
      );
    }elseif ('Sunglass' === $selected_import['import_file_name']) {
      $slider_array = array(
        PIKOWORKS_DUMMY_DIR_PATH . "dummy/sunglass/home-1.zip",
        PIKOWORKS_DUMMY_DIR_PATH . "dummy/sunglass/home_2.zip",
        PIKOWORKS_DUMMY_DIR_PATH . "dummy/sunglass/home_3.zip"
      );
    }elseif ('Home_2' === $selected_import['import_file_name']) {
      $slider_array = array(
        PIKOWORKS_DUMMY_DIR_PATH . "dummy/home_2/slider.zip"
      );
    }elseif ('Home_3' === $selected_import['import_file_name']) {
      $slider_array = array(
        PIKOWORKS_DUMMY_DIR_PATH . "dummy/home_3/slider.zip"
      );
    }elseif ('Home_4' === $selected_import['import_file_name']) {
      $slider_array = array(
        PIKOWORKS_DUMMY_DIR_PATH . "dummy/home_4/slider.zip"
      );
    }elseif ('Home_5' === $selected_import['import_file_name']) {
      $slider_array = array(
        PIKOWORKS_DUMMY_DIR_PATH . "dummy/home_5/slider.zip"
      );
    }elseif ('Home_6' === $selected_import['import_file_name']) {
      $slider_array = array(
        PIKOWORKS_DUMMY_DIR_PATH . "dummy/home_6/slider.zip"
      );
    }elseif ('Home_7' === $selected_import['import_file_name']) {
      $slider_array = array(
        PIKOWORKS_DUMMY_DIR_PATH . "dummy/home_7/slider.zip"
      );
    }elseif ('Home_8' === $selected_import['import_file_name']) {
      $slider_array = array(
        PIKOWORKS_DUMMY_DIR_PATH . "dummy/home_8/slider.zip"
      );
    }elseif ('Home_9' === $selected_import['import_file_name']) {
      $slider_array = array(
        PIKOWORKS_DUMMY_DIR_PATH . "dummy/home_9/slider.zip"
      );
    }elseif ('Home_10' === $selected_import['import_file_name']) {
      $slider_array = array(
        PIKOWORKS_DUMMY_DIR_PATH . "dummy/home_10/slider.zip"
      );
    }elseif ('Home_11' === $selected_import['import_file_name']) {
      $slider_array = array(
        PIKOWORKS_DUMMY_DIR_PATH . "dummy/home_11/slider.zip"
      );
    }elseif ('Home_12' === $selected_import['import_file_name']) {
      $slider_array = array(
        PIKOWORKS_DUMMY_DIR_PATH . "dummy/home_12/slider.zip"
      );
    }elseif ('vendor_home' === $selected_import['import_file_name']) {
      $slider_array = array(
        PIKOWORKS_DUMMY_DIR_PATH . "dummy/vendor_home/slider.zip"
      );
    }

    $slider = new RevSlider();

    foreach ($slider_array as $filepath) {
      $slider->importSliderFromPost(true, true, $filepath);
    }

    echo esc_html(' Slider processed', 'pikoworks_dummy');
  }

}
add_action('pt-ocdi/after_import', 'pikoworks_dummy_after_importer_setup');
