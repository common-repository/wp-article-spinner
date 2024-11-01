<section id="my-plugin" class="wrap">

    <div id="icon-themes" class="icon32"><br></div>

    <h2>Saved Articles <a class="add-new-h2" href="?page=wp-article-spinner">Add New</a></h2>

    <?php echo curl_enable_notice(); ?>

    <?php if (isset($_POST["wpas_delete_data"])) : ?>
	<div id="message" class="updated"><p>Article deleted successfully.</p></div>
    <?php endif ?>

    <p>To post a spun article to one of your WordPress blogs click on "Edit Article".</p>

    <h3>Your Articles</h3>


	<table class="wp-list-table widefat fixed users" cellspacing="0">
	<thead>
	<tr>

	<th scope='col' id='article_id' class='manage-column column-role'  style="">Article ID</th>
	<th scope='col' id='project' class='manage-column column-role'  style="">Project Name</th>
	<th scope='col' id='title' class='manage-column column-role'  style="">Title</th>
	<th scope='col' id='content' class='manage-column column-role'  style="">Content</th>
	<th scope='col' id='edit' class='manage-column column-role'  style=""></th>
	<th scope='col' id='delete' class='manage-column column-role'  style=""></th>

	</tr>
	</thead>

	<tfoot>
	<tr>
	<th scope='col'  class='manage-column column-role'  style="">Article ID</th>
	<th scope='col'  class='manage-column column-role'  style="">Project Name</th>
	<th scope='col'  class='manage-column column-role'  style="">Title</th>
	<th scope='col'  class='manage-column column-role'  style="">Content</th>
	<th scope='col'  class='manage-column column-role'  style=""></th>
	<th scope='col'  class='manage-column column-role'  style=""></th>
	</tr>
	</tfoot>

    <?php if (count($wpas_data)) : ?>
	<tbody id="the-list" class='list:user'>
            <?php foreach ($wpas_data as $data) : ?>
		
	<tr id="article-<?php echo $data['id']; ?>" class="alternate">

	<td>#<?php echo $data["id"]; ?></td>
	<td><?php echo wpas_truncate($data["project"]); ?></td>
	<td><?php echo wpas_truncate($data["title"]); ?></td>
	<td><?php echo wpas_truncate($data["content"]); ?></td>
	<td><a href="<?php echo '?page=wp-article-spinner&id=' . $data['id']; ?>">Edit Article</a></td>
	<td><form method="post" action="" onsubmit="return confirm('Are you sure you want to delete: <?php echo $data['project']; ?>?')">
            <input type="hidden" name="wpas_delete_data" value="1">
            <input type="hidden" name="wpas_id" value="<?php echo $data['id'] ?>">
            <input type="submit" class="button-secondary action" value="Delete Article"></form></td>

	</tr>
	</tbody>
            <?php endforeach ?>

	<?php else : ?>

	    <tbody>
		<td>No articles saved yet.</td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	    </tbody>

	<?php endif ?>
    </table>

<?php if ($wpas_count > 15) : ?>
<p><?php wpas_pagination(ceil($wpas_count / 15), '?page=wp-article-spinner-articles'); ?></p>
<?php endif ?>

</section>


