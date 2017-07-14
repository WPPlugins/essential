<?php
 	wp_enqueue_style("ess_slider");
?>

<script type="text/javascript">
jQuery(function($) {
	$(".del_btn").click(function() {
		var selected_sliders = $("input[name='selected_sliders[]']:checked");
		if(!selected_sliders.length) {
			return false;
		}

		$("#sliders_frm").prop("action", "<?= $ess_current_url; ?>&job=delete").submit();
	});
});
</script>

<div class="wrap">
	<h2>
		<?= __("Sliders", "essential"); ?>
		<a class="add-new-h2" href="<?= $ess_current_url."&job=edit"; ?>"><?= __("Add New", "essential"); ?></a>
	</h2>
	
	<?php settings_errors(); ?>
	
	<form method="post" id="sliders_frm">
		<table class="wp-list-table widefat fixed posts">
			<thead>
				<tr>
					<th class="manage-column column-cb check-column" id="cb" scope="col">
						<label for="cb-select-all-1" class="screen-reader-text"><?= __("Select All", "essential"); ?></label><input type="checkbox" id="cb-select-all-1">
					</th>
					<th class="manage-column column-title" id="title" scope="col">
						<a href="#">
							<span><?= __("Title", "essential"); ?></span><span class="sorting-indicator"></span>
						</a>
					</th>
					<th class="manage-column column-author" id="author" scope="col"><?= __("Author", "essential"); ?></th>
					<th class="manage-column column-date" id="date" scope="col">
						<a href="#">
							<span><?= __("Date", "essential"); ?></span><span class="sorting-indicator"></span>
						</a>
					</th>
				</tr>
			</thead>
			
			<tbody>
			<?php foreach($list as $item): ?>
				<tr>
					<th class="check-column" scope="row"><input type="checkbox" name="selected_sliders[]" value="<?= esc_html($item["id"]); ?>" /></th>
					<td>
						<strong>
							<a class="row-title" href="<?= $ess_current_url; ?>&job=edit&id=<?= esc_html($item["id"]); ?>"><?= esc_html($item["title"]); ?></a>
						</strong>
					</td>
					<td><?= esc_html($item["author_name"]) ?></td>
					<td><?= esc_html(date($GLOBALS["ess_date_format"], strtotime($item["updated_date"]))); ?></td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
		
		<?php if(!empty($list)): ?>
		<p class="submit">
			<input type="button" class="button button-primary del_btn" value="<?= __("Delete selected", "essential"); ?>" />
		</p>
		<?php else: ?>
		<br />
		<p class="description">
			<?= __("You have no any Sliders now.", "essential"); ?>
		</p>
		<?php endif; ?>
	</form>
	
</div>