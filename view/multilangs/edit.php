<?php
 	//wp_enqueue_style("ess_slider");
 	wp_enqueue_style("font-awesome");
	wp_enqueue_media(); 
	
	/* <script type="text/javascript">
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
	
				applySortable();
				applyRemoveSlide();
	});
	</script> */
?>

<div class="wrap">
	<h2>
		<?= __("Config supported Languages", "essential"); ?>
		
		<a class="add-new-h2" href="#" id="add_slides_btn"><?= __("Add Language", "essential"); ?></a>
	</h2>
	
	<form class="ess_multilangs_frm" method="post" action="<?= $ess_current_url."&job=save"?>">
		<div id="poststuff">
			<div id="post-body">
				
				<?= submit_button(__("Save", "essential")); ?>
			</div>
		</div>
	</form>
</div>