<section id="my-plugin" class="wrap">

    <div id="icon-edit-pages" class="icon32 icon32-posts-page"><br></div>

    <h2>Spin Your Article <a class="add-new-h2" href="?page=wp-article-spinner">Add New</a></h2>

    <?php echo curl_enable_notice(); ?>

    <?php if ($_POST["sbm"]=="Save Article" or $_POST["sbm"]=="Update Article") : ?>
	<?php if (empty($_POST["project"]) or empty($_POST["content"])) : ?>
	    <div id="message" class="updated"><p><b>Error:</b> project name and content field must be filled in.</p></div>
	<?php elseif ($_POST["sbm"] == "Save Article") : ?>
	    <div id="message" class="updated"><p>Article saved successfully!</p></div>
	<?php elseif ($_POST["sbm"] == "Update Article") : ?>
	    <div id="message" class="updated"><p>Article updated successfully!</p></div>
	<?php endif ?>
    <?php endif ?>

    <?php if ($_POST["sbm"]=="Submit Article") : ?>
	<?php if (empty($_POST["title"]) or empty($_POST["content"])) : ?>
	    <div id="message" class="updated"><p><b>Error:</b> title and content fields must be filled in.</p></div>
	<?php elseif (!empty($xmlrpc_result)) : ?>
	    <div id="message" class="updated"><p>Article posted successfully! <a href="<?php echo $url; ?>" target="_blank">Click here</a> to view it.</p></div>
	<?php elseif (empty($xmlrpc_result)) : ?>
	    <div id="message" class="updated"><p><b>Error:</b> post attempt unsuccessful!</p></div>
	<?php endif ?>
    <?php endif ?>

    <p><i>For video tutorials <a href="http://www.danielwachtel.com/products/wp-article-spinner" target="_blank" class="wpas_link">click here</a>. Spinning format is</i> { | }</p>

    <form id="article_spinning" method="post" action="">

        <p>
            <label>
                Project Name<br>
                <input type="text" name="project" size="50" value="<?php if (!empty($_POST['project'])){ echo $_POST['project']; } else { echo $wpas_data['project']; } ?>">
            </label>
        </p>

        <p>
            <label>
                Spun Title<br>
                <input type="text" name="title" size="50" value="<?php if (!empty($_POST['title'])){ echo $_POST['title']; } else { echo $wpas_data['title']; } ?>">
            </label>
        </p>

        <p>
            <label>
                Spun Content<br>
                <textarea name="content" rows="10" cols="80"><?php if (!empty($_POST['content'])){ echo stripslashes_deep($_POST['content']); } else { echo stripslashes_deep($wpas_data['content']); } ?></textarea>
            </label>
        </p>

	<p>
            <label>
        	Image URLs - max images:
            </label>
		<select name="wpas_max_images">
		    <?php wpas_select_maximum($_POST['wpas_max_images']); ?>
		</select>
                <br><textarea name="images" rows="3" cols="80"><?php if (!empty($_POST['images'])){ echo stripslashes_deep($_POST['images']); } else { echo stripslashes_deep($wpas_data['images']); } ?></textarea>
        </p>

	<p>
            <label>
                YouTube URLs - max videos:
	    </label>
		<select name="wpas_max_videos">
		    <?php wpas_select_maximum($_POST['wpas_max_videos']); ?>
		</select>
                <br><textarea name="youtube" rows="3" cols="80"><?php if (!empty($_POST['youtube'])){ echo stripslashes_deep($_POST['youtube']); } else { echo stripslashes_deep($wpas_data['youtube']); } ?></textarea>
        </p>

        <p>
            <label>
                Keywords (comma separated, can be spun)<br>
                <input type="text" name="keywords" size="50" value="<?php if (!empty($_POST['keywords'])){ echo $_POST['keywords']; } else { echo $wpas_data['keywords']; } ?>">
            </label>
        </p>

        <p>

        <p>
            <input type="hidden" name="wpas_article_id" value="<?php if (isset($_GET['id'])) { echo $_GET['id']; } elseif (!empty($_POST['wpas_article_id'])) { echo $_POST['wpas_article_id']; } else { echo $wpas_last_id; } ?>">
            <input type="submit" class="button-secondary action" name="sbm" value="Spin Article">
	    <?php if (isset($_GET["id"]) or isset($wpas_last_id) or !empty($_POST["wpas_article_id"])) : ?>
            <input type="hidden" name="wpas_update_data" value="1">
	    <input type="submit" class="button-secondary action" name="sbm" value="Update Article">
	    <?php else : ?>
            <input type="hidden" name="wpas_insert_data" value="1">
	    <input type="submit" class="button-secondary action" name="sbm" value="Save Article">
	    <?php endif ?>
        </p>

	<input type="radio" name="view_type" value="copy_article" <?php if($_POST['view_type']!='view_article') { echo 'checked'; } ?>> Copy Article
	<span class="wpas_radio"><input type="radio" name="view_type" value="view_article" <?php if($_POST['view_type']=='view_article') { echo 'checked'; } ?>> View Article</span>

    <?php if ($_POST["sbm"]=="Spin Article" and $_POST["view_type"]=="view_article") : ?>
   	
	<h3 id="wpas_output">Output</h3>

	<div id="content_box" class="wpas_rounded_corners">

	<div id="title_output">
	    <p>
		<b><?php echo wp_article_spin($_POST['title']); ?></b>
            </p>
	</div>

	<div id="content_output">

	<?php $final_content = wpas_insert_random(wp_article_spin($_POST["content"]), $_POST["images"], $_POST["wpas_max_images"], $_POST["youtube"], $_POST["wpas_max_videos"]); echo stripslashes_deep(str_replace("\r", "<br>", $final_content)); ?>
	</div>

	<div id="keywords_output">
	    <p>
		Keywords: <b><?php echo wp_article_spin($_POST['keywords']); ?></b>
            </p>
	</div>

	</div>

	<?php endif ?>

	<?php if($_POST['sbm']=='Spin Article' and $_POST["view_type"]=="copy_article") : ?>

	<h3 id="wpas_output">Output</h3>

  	<p><input type="text" name="wpas_spun_title" size="50" value="<?php echo wp_article_spin($_POST['title']); ?>"></p>
	<textarea name="wpas_spun_content" rows="10" cols="80"><?php $final_content = wpas_insert_random(wp_article_spin($_POST["content"]), $_POST["images"], $_POST["wpas_max_images"], $_POST["youtube"], $_POST["wpas_max_videos"]); echo stripslashes_deep($final_content); ?></textarea>
  	<p><input type="wpas_spun_keywords" name="" size="50" value="<?php echo wp_article_spin($_POST['keywords']); ?>"></p>

	<?php endif ?>

	<br><h3>Post to Blog</h3>

	<div class="tablenav top">
	
	<label for="wpas_blog_name">Blog Name</label>
	<select name="wpas_blog_name" id="wpas_blog_name">
	<?php if (count($wpas_blog_data)) : ?>
	   <option value="">Select a blog</option>
           <?php foreach ($wpas_blog_data as $data) : ?>
 	   <option value="<?php echo $data['id']; ?>"><?php echo $data['name']; ?></option>
           <?php endforeach ?>
	<?php else : ?>
 	   <option value="">No blogs saved</option>
	<?php endif ?>
	</select>

	<label for="wpas_blog_category">Category</label>
	<span id="wpas_category_div">
	    <select name="wpas_blog_category">
		<option value=""></option>
	    </select>
	</span>
 
        <input type="submit" class="button-primary action" name="sbm" value="Submit Article">
	</div>

    </form>

	<div id="test"></div>

</section>
