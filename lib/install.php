<?php
// create article database table
function wp_article_spinner_install () {
    global $wpdb;

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';

    dbDelta('
        CREATE TABLE `' . WPAS_TABLE . '` (
          `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
          `title` longtext CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
          `content` longtext CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
          `project` longtext CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
          `keywords` longtext CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
          `images` longtext CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
          `youtube` longtext CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
          PRIMARY KEY (`id`),
          UNIQUE KEY `id` (`id`)
        ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
    ');
}

// drop article database table
function wp_article_spinner_uninstall () {
    global $wpdb;

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';

    dbDelta('DROP TABLE `' . WPAS_TABLE . '`');
}

// create blog database table
function wp_article_spinner_blogs_install () {
    global $wpdb;

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';

    dbDelta('
        CREATE TABLE `' . WPAS_BLOGS_TABLE . '` (
          `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
          `name` longtext CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
          `url` longtext CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
          `user` longtext CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
          `password` longtext CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
          `categories` longtext CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
          PRIMARY KEY (`id`),
          UNIQUE KEY `id` (`id`)
        ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
    ');
}

// drop blog database table
function wp_article_spinner_blogs_uninstall () {
    global $wpdb;

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';

    dbDelta('DROP TABLE `' . WPAS_BLOGS_TABLE . '`');
}

// create anchor text database table
function wp_anchor_text_spinner_install () {
    global $wpdb;

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';

    dbDelta('
        CREATE TABLE `' . WPAS_ANCHOR_TABLE . '` (
          `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
          `anchor_title` longtext CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
          `keywords` longtext CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
          `urls` longtext CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
          PRIMARY KEY (`id`),
          UNIQUE KEY `id` (`id`)
        ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
    ');
}

// drop anchor text database table
function wp_anchor_text_spinner_uninstall () {
    global $wpdb;

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';

    dbDelta('DROP TABLE `' . WPAS_ANCHOR_TABLE . '`');
}
?>
