<section id="my-plugin" class="wrap">

    <div id="icon-edit-pages" class="icon32 icon32-posts-page"><br></div>

    <h2>Anchor Text Spinner <a class="add-new-h2" href="?page=wp-anchor-text-spinner">Add New</a></h2>

    <?php echo curl_enable_notice(); ?>

    <?php if ($_POST["sbm"]=="Save" or $_POST["sbm"]=="Update") : ?>
	<?php if (empty($_POST["anchor_title"]) or empty($_POST["keywords"]) or empty($_POST["urls"])) : ?>
	    <div id="message" class="updated"><p><b>Error:</b> all fields must be filled in.</p></div>
	<?php elseif ($_POST["sbm"] == "Save") : ?>
	    <div id="message" class="updated"><p>Anchor text saved successfully!</p></div>
	<?php elseif ($_POST["sbm"] == "Update") : ?>
	    <div id="message" class="updated"><p>Anchor text updated successfully!</p></div>
	<?php endif ?>
    <?php endif ?>

    <?php if (isset($_POST["wpas_delete_data"])) : ?>
	<div id="message" class="updated"><p>Anchor text deleted successfully.</p></div>
    <?php endif ?>

    <form id="article_spinning" method="post" action="">

        <p>
            <label>
                Project Title<br>
                <input type="text" name="anchor_title" size="50" value="<?php if (!empty($_POST['anchor_title'])){ echo stripslashes_deep($_POST['anchor_title']); } else { echo stripslashes_deep($wpas_anchor['anchor_title']); } ?>">
            </label>
        </p>

        <p>
            <label>
                Keywords (one per line)<br>
                <textarea name="keywords" rows="6" cols="80"><?php if (!empty($_POST['keywords'])){ echo stripslashes_deep($_POST['keywords']); } else { echo stripslashes_deep($wpas_anchor['keywords']); } ?></textarea>
            </label>
        </p>

        <p>
            <label>
                URLs (one per line)<br>
                <textarea name="urls" rows="6" cols="80"><?php if (!empty($_POST['urls'])){ echo stripslashes_deep($_POST['urls']); } else { echo stripslashes_deep($wpas_anchor['urls']); } ?></textarea>
            </label>
        </p>

	<input type="submit" class="button-secondary action" name="sbm" value="Spin Anchor Text">
        <input type="hidden" name="wpas_anchor_id" value="<?php if (isset($_POST['wpas_edit_id'])) { echo $_POST['wpas_edit_id']; } elseif (!empty($_POST['wpas_anchor_id'])) { echo $_POST['wpas_anchor_id']; } else { echo $wpas_last_id; } ?>">
	<?php if (($_POST["sbm"]=="Save" and isset($wpas_success)) or $_POST["sbm"]=="Update" or isset($_POST["wpas_edit_data"]) or ($_POST["sbm"]=="Spin Anchor Text" and isset($_POST["wpas_update_data"]))) : ?>
            <input type="hidden" name="wpas_update_data" value="1">
	    <input type="submit" class="button-secondary action" name="sbm" value="Update">
	<?php else : ?>
            <input type="hidden" name="wpas_insert_data" value="1">
	    <input type="submit" class="button-secondary action" name="sbm" value="Save">
	<?php endif ?>

    </form>

    <?php if ($_POST["sbm"]=="Spin Anchor Text") : ?>

	<h3 id="wpas_output">Output</h3>

        <p>
            <label>
                Spun Anchor Text<br>
                <textarea name="content" rows="8" cols="80"><?php echo wpas_spin_anchor($_POST["keywords"], $_POST["urls"]); ?></textarea>
            </label>
        </p>

    <?php endif ?>

    <h3>Saved Anchor Texts</h3>


	<table class="wp-list-table widefat fixed users" cellspacing="0">
	<thead>
	<tr>

	<th scope='col' id='anchor_title' class='manage-column column-role'  style="">Project Name</th>
	<th scope='col' id='keywords' class='manage-column column-role'  style="">Keywords</th>
	<th scope='col' id='urls' class='manage-column column-role'  style="">URLs</th>
	<th scope='col' id='edit' class='manage-column column-role'  style=""></th>
	<th scope='col' id='delete' class='manage-column column-role'  style=""></th>

	</tr>
	</thead>

	<tfoot>
	<tr>
	<th scope='col'  class='manage-column column-role'  style="">Project Name</th>
	<th scope='col'  class='manage-column column-role'  style="">Keywords</th>
	<th scope='col'  class='manage-column column-role'  style="">URLs</th>
	<th scope='col'  class='manage-column column-role'  style=""></th>
	<th scope='col'  class='manage-column column-role'  style=""></th>
	</tr>
	</tfoot>

    <?php if (count($wpas_data)) : ?>
	<tbody id="the-list" class='list:user'>
            <?php foreach ($wpas_data as $data) : ?>
		
	<tr id="article-<?php echo $data['id']; ?>" class="alternate">

	<td><?php echo wpas_truncate($data["anchor_title"]); ?></td>
	<td><?php echo wpas_commas(wpas_truncate($data["keywords"])); ?></td>
	<td><?php echo wpas_commas(wpas_truncate($data["urls"])); ?></td>
	<td><form method="post" action="">
            <input type="hidden" name="wpas_edit_data" value="1">
            <input type="hidden" name="wpas_edit_id" value="<?php echo $data['id'] ?>">
            <input type="submit" class="button-secondary action" value="Edit Spin"></form></td>
	<td><form method="post" action="" onsubmit="return confirm('Are you sure you want to delete: <?php echo $data['anchor_title']; ?>?')">
            <input type="hidden" name="wpas_delete_data" value="1">
            <input type="hidden" name="wpas_id" value="<?php echo $data['id'] ?>">
            <input type="submit" class="button-secondary action" value="Delete"></form></td>

	</tr>
	</tbody>
            <?php endforeach ?>

	<?php else : ?>

	    <tbody>
		<td>No anchor texts saved yet.</td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	    </tbody>

	<?php endif ?>
    </table>

<?php if ($wpas_count > 10) : ?>
<p><?php wpas_pagination(ceil($wpas_count / 10), '?page=wp-anchor-text-spinner'); ?></p>
<?php endif ?>

</section>
