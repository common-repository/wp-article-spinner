<section id="my-plugin" class="wrap">

    <div id="icon-themes" class="icon32"><br></div>

    <h2>WordPress Blogs <a class="add-new-h2" href="?page=wp-article-spinner-blogs">Add New</a></h2>

    <?php if ($_POST["sbm"]=="Add Blog" or $_POST["sbm"]=="Update Blog") : ?>
	<?php if (empty($_POST["name"]) or empty($_POST["url"]) or empty($_POST["user"]) or empty($_POST["password"])) : ?>
	    <div id="message" class="updated"><p><b>Error:</b> all fields must be filled in.</p></div>
	<?php elseif (empty($wpas_success)) : ?>
	    <div id="message" class="updated"><p>Couldn't connect to the blog. Make sure that XML-RPC is enabled and double-check the fields below.</p></div>
	<?php elseif (!empty($wpas_success) and $_POST["sbm"]=="Add Blog") : ?>
	    <div id="message" class="updated"><p>Blog saved successfully.</p></div>
	<?php elseif (!empty($wpas_success) and $_POST["sbm"]=="Update Blog") : ?>
	    <div id="message" class="updated"><p>Blog updated successfully.</p></div>
	<?php endif ?>
    <?php endif ?>

    <?php if (isset($_POST["wpas_blog_delete"])) : ?>
	<div id="message" class="updated"><p>Blog deleted successfully.</p></div>
    <?php endif ?>

    <?php echo curl_enable_notice(); ?>

    <p><b>Notice:</b> if you are posting to a WordPress installation under version 3.5 XML-RPC must be enabled manually.<br>To enable this option go to Settings > Writing > Enable XML-RPC (near the bottom of the page).</p>

    <form id="article_spinning" method="post" action="">

	<br><table class="wpas_table">

	<tr valign="top">
	<th scope="row"><label for="name">Blog Name</label></th>
        <td><input type="text" name="name" size="50" value="<?php if (!$wpas_success and !empty($_POST['name'])) { echo $_POST['name']; } elseif (!$wpas_success) { echo $wpas_blog['name']; } ?>"></td>
	</tr>

	<tr valign="top">
	<th scope="row"><label for="url">Blog URL</label></th>
        <td><input type="text" name="url" size="50" value="<?php if (!$wpas_success and !empty($_POST['url'])) { echo $_POST['url']; } elseif (!$wpas_success) { echo $wpas_blog['url']; } ?>"></td>
	</tr>

	<tr valign="top">
	<th scope="row"><label for="user">Username</label></th>
	<td><input type="text" name="user" size="50" value="<?php if (!$wpas_success and !empty($_POST['user'])) { echo $_POST['user']; } elseif (!$wpas_success and !empty($wpas_blog['user'])) { echo wpas_decrypt($wpas_blog['user']); } ?>"></td>
	</tr>

	<tr valign="top">
	<th scope="row"><label for="password">Password</label></th>
	<td><input type="text" name="password" size="50" value="<?php if (!$wpas_success and !empty($_POST['password'])) { echo $_POST['password']; } elseif (!$wpas_success and !empty($wpas_blog['password'])) { echo wpas_decrypt($wpas_blog['password']); } ?>"></td>
	</tr>

	<tr valign="top">
	<th scope="row">

	<?php if($_POST["sbm"]=="Edit Blog" or ($_POST["sbm"]=="Update Blog" and empty($wpas_success))) : ?>
	<input type="hidden" name="wpas_blog_id" value="<?php echo $_POST['wpas_id']; ?>">
	<input type="hidden" name="wpas_update_blog_data" value="1">
	<input type="submit" class="button-primary action" name="sbm" value="Update Blog">
	<?php else : ?>
	<input type="hidden" name="wpas_insert_blog_data" value="1">
	<input type="submit" class="button-primary action" name="sbm" value="Add Blog">
	<?php endif ?>
	</th>
	<td>

	</td>	
	</tr>

	</table>
    </form>

    <br><h3>Your Blogs</h3>


	<table class="wp-list-table widefat fixed users" cellspacing="0">
	<thead>
	<tr>

	<th scope='col' id='blog_name' class='manage-column column-role'  style="">Blog Name</th>
	<th scope='col' id='blog_url' class='manage-column column-role'  style="">Blog URL</th>
	<th scope='col' id='blog_categories' class='manage-column column-role'  style="">Categories</th>
	<th scope='col' id='edit' class='manage-column column-role'  style=""></th>
	<th scope='col' id='delete' class='manage-column column-role'  style=""></th>

	</tr>
	</thead>

	<tfoot>
	<tr>
	<th scope='col'  class='manage-column column-role'  style="">Blog Name</th>
	<th scope='col'  class='manage-column column-role'  style="">Blog URL</th>
	<th scope='col'  class='manage-column column-role'  style="">Categories</th>
	<th scope='col'  class='manage-column column-role'  style=""></th>
	<th scope='col'  class='manage-column column-role'  style=""></th>
	</tr>
	</tfoot>

    <?php if (count($wpas_data)) : ?>
	<tbody id="the-list" class='list:user'>

        <?php foreach ($wpas_data as $data) : ?>
		
	<tr id="blog-<?php echo $data['id']; ?>" class="alternate">

	<td><?php echo $data["name"]; ?></td>
	<td><a href="<?php echo $data['url']; ?>" target="_blank"><?php echo $data['url']; ?></a></td>
	<td><?php wpas_categories_to_select($data["categories"]); ?></td>
	<td><form method="post" action="">
            <input type="hidden" name="wpas_edit_blog" value="1">
            <input type="hidden" name="wpas_id" value="<?php echo $data['id']; ?>">
            <input type="submit" name="sbm" class="button-secondary action" value="Edit Blog">
	</form></td>
	<td><form method="post" action="" onsubmit="return confirm('Are you sure you want to delete: <?php echo $data['name']; ?>?')">
            <input type="hidden" name="wpas_blog_delete" value="1">
            <input type="hidden" name="wpas_id" value="<?php echo $data['id']; ?>">
            <input type="submit" name="sbm" class="button-secondary action" value="Delete Blog"></form></td>

	</tr>
	</tbody>

        <?php endforeach ?>

	<?php else : ?>
	<tbody>
	<td>No blogs added yet.</td>
	<td></td>
	<td></td>
	<td></td>
	</tbody>

    <?php endif ?>

    </table>

    <?php if (isset($_GET["blog_id"])) : ?>
	<span id="categories_list">
	    <?php echo wpas_categories_to_select($wpas_blog_categories); ?>
	</span>
    <?php endif ?>

    <?php if ($wpas_count > 15) : ?>
	<p><?php wpas_pagination(ceil($wpas_count / 15), '?page=wp-article-spinner-blogs'); ?></p>
    <?php endif ?>

</section>
