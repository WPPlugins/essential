<?php
 	wp_enqueue_style("ess_slider");
 	wp_enqueue_style("font-awesome");
	wp_enqueue_media(); 
?>

<script type="text/javascript">
jQuery(function($) {
	$("#add_slides_btn").click(function(e) {
		e.preventDefault();
		
        wp.media.editor.send.attachment = function(props, attachment) {
            var prefix = $(".slide").length + 1;
            
            //console.log(attachment);
        	$("#slides").append(
                "<tr class='slide'>" +
                	"<th scope='row'><a class='remove_slide'></a><div><img class='sort_item' src='" + attachment.url + "'/><div></th>" +
                	"<td>" +
                		"<input type='hidden' name='slides[slide" + prefix + "][slide_content]' value='" + attachment.url + "' />" +
                		"<input type='text' name='slides[slide" + prefix + "][img_title]' class='regular-text' placeholder='<?= __("Image title text", "essential"); ?>' /><br />" +
                		"<input type='text' name='slides[slide" + prefix + "][img_alt]' class='regular-text' placeholder='<?= __("Image alt text", "essential"); ?>' /><br />" +
                		"<input type='text' name='slides[slide" + prefix + "][img_link_to_url]' class='regular-text' placeholder='<?= __("Link to URL", "essential"); ?>' /><br />" +
                		"<input type='checkbox' name='slides[slide" + prefix + "][img_new_tab]' id='" + attachment.id + "_" + prefix + "' /><label for=" + attachment.id + "_" + prefix + "><?= __("Open new tab?", "essential"); ?></label>" +
            		"</td>" +
                "</tr>"
            );

			//apply sortable by drag and drop
        	applySortable();
        	applyRemoveSlide();
        }

        wp.media.editor.open();

        //hide some items
        $(".media-menu .media-menu-item:contains('Media Library')").remove();//'media library' tab
	});

	//apply sortable
	function applySortable() {
		$(".sortable > tbody").sortable({
	    	handle: ".sort_item",
	    	placeholder: "ui-sortable-placeholder"
	    });
	}

	function applyRemoveSlide() {
		$(".remove_slide").unbind("click").click(function() {
			$(this).parents(".slide").fadeOut(function() {
				$(this).remove();
			});
		});
	}

	//handlediv
	$(".ess_slider_config .postbox .handlediv").click(function() {
		$(this).parent().toggleClass('closed');
	});

	$(".submitdelete").click(function(e) {
		if(!confirm("<?= __("Are you sure?", "essential"); ?>")) {
			return false;
		}
	});
	
	applySortable();
	applyRemoveSlide();
});
</script>

<div class="wrap">
	<h2>
		<?= (isset($_GET["id"]) ? __("Edit Slider", "essential") : __("Add New Slider", "essential")); ?>
		
		<a class="add-new-h2" href="#" id="add_slides_btn"><?= __("Add Slides", "essential"); ?></a>
	</h2>
	
	<?php settings_errors(); ?>
	
	<form class="ess_slider_frm" method="post" action="<?= $ess_current_url."&job=save"?>">
		<input type="hidden" name="id"
			value="<?= (empty($slider) ? 0 : $slider["id"]); ?>" />

		<div id="poststuff">
			<div id="post-body" class="metabox-holder columns-2">
				<!-- the most simple of a slider -->
				<div id="post-body-content">
					<div id="titlediv">
						<div id="titlewrap">
							<input id="title" name="title" class="regular-text" type="text"
								placeholder="<?= __("Title of slider", "essential"); ?>"
								value="<?= @esc_html($slider["title"]); ?>" />
						</div>
					</div>

					<!-- items -->
					<?php //new dBug($slider); ?>
					<table id="slides" class="form-table sortable">
					<?php if(isset($slider["slides"])): ?>
						<?php foreach($slider["slides"] as $a_slide): ?>
						<tr class="slide">
							<th scope="row"><a class="remove_slide"></a>
							<div>
									<img class="sort_item"
										src="<?= @esc_html($a_slide["content"]); ?>" />
									<div></th>
							<td><input type="hidden"
								name="slides[slide<?= @esc_html($a_slide["id"]); ?>][slide_id]"
								value="<?= @esc_html($a_slide["id"]); ?>" /> <input
								type="hidden"
								name="slides[slide<?= @esc_html($a_slide["id"]); ?>][slide_content]"
								value="<?= @esc_html($a_slide["content"]); ?>" /> <input
								type="text"
								name="slides[slide<?= @esc_html($a_slide["id"]); ?>][img_title]"
								class="regular-text"
								placeholder="<?= __("Image title text", "essential"); ?>"
								value="<?= @esc_html($a_slide["img_title"]); ?>" /><br /> <input
								type="text"
								name="slides[slide<?= @esc_html($a_slide["id"]); ?>][img_alt]"
								class="regular-text"
								placeholder="<?= __("Image alt text", "essential"); ?>"
								value="<?= @esc_html($a_slide["img_alt"]); ?>" /><br /> <input
								type="text"
								name="slides[slide<?= @esc_html($a_slide["id"]); ?>][img_link_to_url]"
								class="regular-text"
								placeholder="<?= __("Link to URL", "essential"); ?>"
								value="<?= @esc_html($a_slide["img_link_to_url"]); ?>" /><br />
								<input type="checkbox"
								name="slides[slide<?= @esc_html($a_slide["id"]); ?>][img_new_tab]"
								id="<?= @esc_html($a_slide["id"]); ?>_"
								<?= @($a_slide["img_open_new_tab"] ? " checked='checked' " : ""); ?> /><label
								for="<?= @esc_html($a_slide["id"]); ?>_"><?= __("Open new tab?", "essential"); ?></label>
							</td>
						</tr>
						<?php endforeach; ?>
					<?php endif; ?>
					</table>
					
					<?= submit_button(__("Save Slider", "essential")); ?>
				</div>

				<!-- config part at right side -->
				<div id="postbox-container-1"
					class="postbox-container ess_slider_config">
					<div id="side-sortables" class="meta-box-sortables ui-sortable">
						<?php if(!empty($slider)): ?>
						<!-- usage -->
						<div id="shortcode_div" class="postbox">
							<div class="handlediv" title="Click to toggle">
								<br>
							</div>
							<h3 class="hndle">
								<span><?= __("Usage", "essential"); ?></span>
							</h3>
							<div class="inside">
								<div class="submitbox" id="submitpost">
									<div id="minor-publishing">
										<strong><u><?= __("Shortcode", "essential"); ?></u></strong> <span
											class="howto"><?= __("Paste into your post/page content.", "essential"); ?></span>
										<p style="color: red;">[ess_slider id=<?= $slider["id"];?>]</p>
		
										<strong><u><?= __("PHP codes", "essential"); ?></u></strong> <span
											class="howto"><?= __("Paste into your template files.", "essential"); ?></span>
										<p>
											<code>
												<&#63;php<br /> 
													echo do_shortcode("[ess_slider id=<?= $slider["id"];?>]");<br />
												&#63;>
											</code>
										</p>
									</div>
									
									<div id="major-publishing-actions">
										<div id="delete-action">
											<a class="submitdelete deletion" href="<?= $ess_current_url."&job=delete&id=".$slider["id"]; ?>"><?= __("Delete this slider", "essential"); ?></a>
										</div>
										<div class="clear"></div>
									</div>
								</div>
							</div>
						</div>
						<?php endif; ?>
						
						<div id="settings_div" class="postbox">
							<div class="handlediv" title="Click to toggle">
								<br>
							</div>
							<h3 class="hndle">
								<span><?= __("Settings", "essential"); ?></span>
							</h3>
							<div class="inside">
								<table class="settings">
									<tr>
										<td><label for="width"><?= __("Width", "essential"); ?></label></td>
										<td><input type="text" size="5" name="width" id="width"
											value="<?= @(esc_html($slider["width"])); ?>" /> px</td>
									</tr>
									<tr>
										<td><label for="height"><?= __("Height", "essential"); ?></label></td>
										<td><input type="text" size="5" name="height" id="height"
											value="<?= @(esc_html($slider["height"])); ?>" /> px</td>
									</tr>
									<tr>
										<td><label for="auto_play"><?= __("Auto play", "essential"); ?></label></td>
										<td><input type="checkbox" id="auto_play" name="auto_play"
											<?= @($slider["auto_play"] ? " checked='checked' " : ""); ?> /></td>
									</tr>
									<!-- 
									<tr>
										<td><label for="auto_loop"><?= __("Loop", "essential"); ?></label></td>
										<td><input type="checkbox" id="auto_loop" name="auto_loop" <?= @($slider["auto_loop"] ? " checked='checked' " : ""); ?> /></td>
									</tr>
									 -->
									<tr>
										<td><label for="prev_next"><?= __("Prev/Next button", "essential"); ?></label></td>
										<td><input type="checkbox" id="prev_next" name="prev_next"
											<?= @($slider["prev_next"] ? " checked='checked' " : ""); ?> /></td>
									</tr>
									<tr>
										<td><label for="bullet_nav"><?= __("Bullet navigation", "essential"); ?></label></td>
										<td><input type="checkbox" id="bullet_nav" name="bullet_nav"
											<?= @($slider["bullet_nav"] ? " checked='checked' " : ""); ?> /></td>
									</tr>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			<br class="clear" />
		</div>
	</form>
</div>