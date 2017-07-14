<div class="wrap">
	<h2>
		<?= __("Multi Languages", "essential"); ?>
		<a class="add-new-h2" href="<?= $ess_current_url."&job=edit"; ?>"><?= __("Config supported Languages", "essential"); ?></a>
	</h2>
	
	<ul class="subsubsub"></ul>
	
	<form>
		<table class="wp-list-table widefat fixed posts">
			<thead>
				<tr>
					<th class="manage-column column-cb check-column" id="cb" scope="col">
						<label for="cb-select-all-1" class="screen-reader-text">Select All</label><input type="checkbox" id="cb-select-all-1">
					</th>
					<th class="manage-column column-title" id="title" scope="col">
						<a href="#">
							<span><?= __("Language Name", "essential"); ?></span><span class="sorting-indicator"></span>
						</a>
					</th>
					<th class="manage-column" id="flag" scope="col"><?= __("Flag", "essential"); ?></th>
				</tr>
			</thead>
			
			<tbody>
			<?php foreach($list as $item): ?>
				<tr>
					<th class="check-column" scope="row"><input type="checkbox" name="selected_sliders[]" value="<?= esc_html($item["id"]); ?>" /></th>
					<td>
						<strong>
							<a href="<?= $ess_current_url; ?>&job=edit&id=<?= esc_html($item["id"]); ?>"><?= esc_html($item["title"]); ?></a>
						</strong>
					</td>
					<td><?= esc_html($item["author_name"]) ?></td>
					<td><?= esc_html(date($GLOBALS["ess_date_format"], strtotime($item["updated_date"]))); ?></td>
				</tr>
			<?php endforeach; ?>
			
			<?php if(empty($list)): ?>
				<tr><td colspan="2"><i><?= __("Empty", "essential"); ?></i></td></tr>
			<?php endif; ?>
			</tbody>
		</table>
	</form>
	
</div>