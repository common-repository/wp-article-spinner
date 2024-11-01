<?php
class WPAS_Table {
    public static function get () {
        global $wpdb;

	if (isset($_GET["num"])) { $num = $_GET["num"]; } else { $num = 1; }
	$offset = $num * 15 - 15;
        $rows = $wpdb->get_results('SELECT * FROM ' . WPAS_TABLE . ' ORDER BY id DESC LIMIT 15 OFFSET ' . $offset, ARRAY_A);

        return $rows;
    }

    public static function count_articles () {
        global $wpdb;

        $count = $wpdb->get_var( $wpdb->prepare('SELECT COUNT(*) FROM ' . WPAS_TABLE, array()) );

        return $count;
    }

    public static function get_article ($id) {
        global $wpdb;

        $row = $wpdb->get_row('SELECT * FROM ' . WPAS_TABLE . ' WHERE id = ' . $wpdb->escape($id), ARRAY_A);

        return $row;
    }

    public static function insert ($row) {
        global $wpdb;

        return $wpdb->insert(WPAS_TABLE, array(
            'title'        => stripslashes_deep($row['title']), 
            'content'    => stripslashes_deep($row['content']),
            'project'    => stripslashes_deep($row['project']),
            'keywords'    => stripslashes_deep($row['keywords']),
            'images'    => stripslashes_deep($row['images']),
            'youtube'    => stripslashes_deep($row['youtube'])
        ));
    }

    public static function update ($id, $row) {
        global $wpdb;

        $update = array();

        if (isset($row['title'])) {
            $update['title'] = stripslashes_deep($row['title']);
        }

        if (isset($row['content'])) {
            $update['content'] = stripslashes_deep($row['content']);
        }

        if (isset($row['project'])) {
            $update['project'] = stripslashes_deep($row['project']);
        }

        if (isset($row['keywords'])) {
            $update['keywords'] = stripslashes_deep($row['keywords']);
        }

        if (isset($row['images'])) {
            $update['images'] = stripslashes_deep($row['images']);
        }

        if (isset($row['youtube'])) {
            $update['youtube'] = stripslashes_deep($row['youtube']);
        }

        if (count($update)) {
            return $wpdb->update(WPAS_TABLE, $update, array('id' => $id), array('%s', '%s'), array('%d'));
        }

        return false;
    }

    public static function delete ($id) {
        global $wpdb;

        return $wpdb->query('DELETE FROM ' . WPAS_TABLE . ' WHERE id = ' . $wpdb->escape($id));
    }

    public static function last () {
        global $wpdb;

        $last = $wpdb->get_var( $wpdb->prepare( 'SELECT id FROM ' . WPAS_TABLE . ' ORDER BY id DESC LIMIT 1', array()) );

        return $last;
    }
}

class WPAS_Blogs_Table {
    public static function get () {
        global $wpdb;

	if (isset($_GET["num"])) { $num = $_GET["num"]; } else { $num = 1; }
	$offset = $num * 15 - 15;
        $rows = $wpdb->get_results('SELECT * FROM ' . WPAS_BLOGS_TABLE . ' ORDER BY id DESC LIMIT 15 OFFSET ' . $offset, ARRAY_A);

        return $rows;
    }

    public static function count_blogs () {
        global $wpdb;

        $count = $wpdb->get_var( $wpdb->prepare('SELECT COUNT(*) FROM ' . WPAS_BLOGS_TABLE, array()) );

        return $count;
    }

    public static function get_blog ($id) {
        global $wpdb;

        $row = $wpdb->get_row('SELECT * FROM ' . WPAS_BLOGS_TABLE . ' WHERE id = ' . $wpdb->escape($id), ARRAY_A);

        return $row;
    }

    public static function insert ($row, $categories) {
        global $wpdb;

        return $wpdb->insert(WPAS_BLOGS_TABLE, array(
            'url'        => stripslashes_deep($row['url']),
            'name'        => stripslashes_deep($row['name']), 
            'user'    => wpas_encrypt(stripslashes_deep($row['user'])),
            'password'    => wpas_encrypt(stripslashes_deep($row['password'])),
            'categories'    => stripslashes_deep($categories)
        ));
    }

    public static function update ($id, $row, $categories) {
        global $wpdb;

        $update = array();

        if (isset($row['url'])) {
            $update['url'] = stripslashes_deep($row['url']);
        }

        if (isset($row['name'])) {
            $update['name'] = stripslashes_deep($row['name']);
        }

        if (isset($row['user'])) {
            $update['user'] = wpas_encrypt(stripslashes_deep($row['user']));
        }

        if (isset($row['password'])) {
            $update['password'] = wpas_encrypt(stripslashes_deep($row['password']));
        }

        if (isset($row['categories'])) {
            $update['categories'] = stripslashes_deep($categories);
        }

        if (count($update)) {
            return $wpdb->update(WPAS_BLOGS_TABLE, $update, array('id' => $id), array('%s', '%s'), array('%d'));
        }

        return false;
    }

    public static function delete ($id) {
        global $wpdb;

        return $wpdb->query('DELETE FROM ' . WPAS_BLOGS_TABLE . ' WHERE id = ' . $wpdb->escape($id));
    }
}

class WPAS_Anchor_Table {
    public static function get () {
        global $wpdb;

	if (isset($_GET["num"])) { $num = $_GET["num"]; } else { $num = 1; }
	$offset = $num * 10 - 10;
        $rows = $wpdb->get_results('SELECT * FROM ' . WPAS_ANCHOR_TABLE . ' ORDER BY id DESC LIMIT 10 OFFSET ' . $offset, ARRAY_A);

        return $rows;
    }

    public static function count_anchors () {
        global $wpdb;

        $count = $wpdb->get_var( $wpdb->prepare('SELECT COUNT(*) FROM ' . WPAS_ANCHOR_TABLE, array()) );

        return $count;
    }

    public static function get_anchor ($id) {
        global $wpdb;

        $row = $wpdb->get_row('SELECT * FROM ' . WPAS_ANCHOR_TABLE . ' WHERE id = ' . $wpdb->escape($id), ARRAY_A);

        return $row;
    }

    public static function insert ($row) {
        global $wpdb;

        return $wpdb->insert(WPAS_ANCHOR_TABLE, array(
            'anchor_title'        => stripslashes_deep($row['anchor_title']), 
            'keywords'    => stripslashes_deep($row['keywords']),
            'urls'    => stripslashes_deep($row['urls'])
        ));
    }

    public static function update ($id, $row) {
        global $wpdb;

        $update = array();

        if (isset($row['anchor_title'])) {
            $update['anchor_title'] = stripslashes_deep($row['anchor_title']);
        }

        if (isset($row['keywords'])) {
            $update['keywords'] = stripslashes_deep($row['keywords']);
        }

        if (isset($row['urls'])) {
            $update['urls'] = stripslashes_deep($row['urls']);
        }

        if (count($update)) {
            return $wpdb->update(WPAS_ANCHOR_TABLE, $update, array('id' => $id), array('%s', '%s'), array('%d'));
        }

        return false;
    }

    public static function delete ($id) {
        global $wpdb;

        return $wpdb->query('DELETE FROM ' . WPAS_ANCHOR_TABLE . ' WHERE id = ' . $wpdb->escape($id));
    }

    public static function last () {
        global $wpdb;

        $last = $wpdb->get_var( $wpdb->prepare( 'SELECT id FROM ' . WPAS_ANCHOR_TABLE . ' ORDER BY id DESC LIMIT 1', array()) );

        return $last;
    }
}
?>
