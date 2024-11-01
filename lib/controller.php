<?php
function wp_article_spinner_admin_menu() {
add_menu_page('WP Article Spinner', 'WP Article Spinner', 'administrator',
'wp-article-spinner', 'wp_article_spinner_html_page');
    
add_submenu_page('wp-article-spinner', 'Manage Articles', 'Manage Articles',
'administrator', 'wp-article-spinner-articles', 'wp_article_spinner_database_page');

add_submenu_page('wp-article-spinner', 'Manage WP Blogs', 'Manage WP Blogs',
'administrator', 'wp-article-spinner-blogs', 'wp_article_spinner_blogs_page');

add_submenu_page('wp-article-spinner', 'Anchor Text Spinner', 'Anchor Text Spinner',
'administrator', 'wp-anchor-text-spinner', 'wp_anchor_text_spinner_page');
}


function wp_article_spinner_html_page() {

    # Insert data
    if (isset($_POST['wpas_insert_data']) and $_POST["sbm"]!="Spin Article" and $_POST["sbm"]!="Submit Article") {
	if (!empty($_POST["project"]) and !empty($_POST["content"])) {
	    WPAS_Table::insert($_POST);
	    $wpas_last_id = WPAS_Table::last();
	}
    }

   # Update data
    if (isset($_POST['wpas_update_data']) and $_POST["sbm"]!="Spin Article" and $_POST["sbm"]!="Submit Article") {
	if (!empty($_POST["project"]) and !empty($_POST["content"])) {
	    WPAS_Table::update($_POST["wpas_article_id"], $_POST);
	    $wpas_last_id = $_POST["wpas_article_id"];
	}
    }

   # Get single article
   if (isset($_GET["id"])) {
	$wpas_data = WPAS_Table::get_article($_GET["id"]);
   }

   # Post article via XML-RPC
   if (($_POST["sbm"]=="Submit Article")) {

	$title = wp_article_spin($_POST['title']);
	$img_and_vid = wpas_insert_random(wp_article_spin($_POST["content"]), $_POST["images"], $_POST["wpas_max_images"], $_POST["youtube"], $_POST["wpas_max_videos"]);
	$content = stripslashes_deep($img_and_vid);

	if (!empty($title) and !empty($content)) {
	    $keywords = wp_article_spin($_POST['keywords']);
	    $category = $_POST["wpas_blog_category"];
	
	    $blog = WPAS_Blogs_Table::get_blog($_POST["wpas_blog_name"]);
	    $url = $blog["url"];
	    $admin = wpas_decrypt($blog["user"]);
	    $pass = wpas_decrypt($blog["password"]);

	$xmlrpc_result = wpas_xmlrpc($title,$content,$url,$admin,$pass,$category,$keywords);
	}
   }

   $wpas_blog_data = WPAS_Blogs_Table::get();

   include WPAS_DOCROOT . '/views/spinner.php';
}


function wp_article_spinner_database_page() {

    # Delete data
    if (isset($_POST['wpas_delete_data'])) {
        WPAS_Table::delete($_POST['wpas_id']);
    }

    # Get data
    $wpas_data = WPAS_Table::get();
    $wpas_count = WPAS_Table::count_articles();

    # Include view
    include WPAS_DOCROOT . '/views/articles.php';
}

function wp_article_spinner_blogs_page() {

    # Insert data
    if (isset($_POST['wpas_insert_blog_data'])) {
	if (!empty($_POST["name"]) and !empty($_POST["url"]) and !empty($_POST["user"]) and !empty($_POST["password"])) {
	    $url = $_POST["url"];
	    $user = $_POST["user"];
	    $password = $_POST["password"];

	    $get_categories = wpas_get_categories($url,$user,$password);
	    $categories = wpas_categories_to_string($get_categories);

	    if (strlen($categories) > 1){
		WPAS_Blogs_Table::insert($_POST, $categories);
		$wpas_success = "1";
	    }
	}
    }

   # Update data
   if (isset($_POST['wpas_update_blog_data'])) {
	if (!empty($_POST["name"]) and !empty($_POST["url"]) and !empty($_POST["user"]) and !empty($_POST["password"])) {
	    $url = $_POST["url"];
	    $user = $_POST["user"];
	    $password = $_POST["password"];

	    $get_categories = wpas_get_categories($url,$user,$password);
	    $categories = wpas_categories_to_string($get_categories);

	    if (strlen($categories) > 1){
		WPAS_Blogs_Table::update($_POST["wpas_blog_id"], $_POST, $categories);
		$wpas_success = "1";
	    }
	}
   }

    # Delete data
    if (isset($_POST['wpas_blog_delete'])) {
        WPAS_Blogs_Table::delete($_POST['wpas_id']);
    }

   # Get single blog
   if (isset($_POST["wpas_edit_blog"])) {
	$wpas_blog = WPAS_Blogs_Table::get_blog($_POST["wpas_id"]);
   }

   # Get blog categories
   if (isset($_GET["blog_id"])) {
	$wpas_blog_id = WPAS_Blogs_Table::get_blog($_GET["blog_id"]);
	$wpas_blog_categories = $wpas_blog_id["categories"];
   }

    # Get data
    $wpas_data = WPAS_Blogs_Table::get();
    $wpas_count = WPAS_Blogs_Table::count_blogs();
   
    include WPAS_DOCROOT . '/views/blogs.php';
}

function wp_anchor_text_spinner_page (){

    # Insert data
    if (isset($_POST['wpas_insert_data']) and $_POST["sbm"]=="Save") {
	if (!empty($_POST["anchor_title"]) and !empty($_POST["keywords"]) and !empty($_POST["urls"])) {
	    WPAS_Anchor_Table::insert($_POST);
	    $wpas_last_id = WPAS_Anchor_Table::last();
	    $wpas_success = "1";
	}
    }

   # Update data
    if (isset($_POST['wpas_update_data']) and $_POST["sbm"]=="Update") {
	if (!empty($_POST["anchor_title"]) and !empty($_POST["keywords"]) and !empty($_POST["urls"])) {
	    WPAS_Anchor_Table::update($_POST["wpas_anchor_id"], $_POST);
	    $wpas_last_id = $_POST["wpas_anchor_id"];
	}
    }

   # Get single anchor text
   if (isset($_POST["wpas_edit_data"])) {
	$wpas_anchor = WPAS_Anchor_Table::get_anchor($_POST["wpas_edit_id"]);
   }


    # Delete data
    if (isset($_POST['wpas_delete_data'])) {
        WPAS_Anchor_Table::delete($_POST['wpas_id']);
    }

    # Get data
    $wpas_data = WPAS_Anchor_Table::get();
    $wpas_count = WPAS_Anchor_Table::count_anchors();

    include WPAS_DOCROOT . '/views/anchor_spinner.php';
}
?>
