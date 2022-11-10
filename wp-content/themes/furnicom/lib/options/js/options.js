jQuery(document).ready(function(){
	
	
	if(jQuery('#last_tab').val() == ''){

		jQuery('.furnicom-opts-group-tab:first').slideDown('fast');
		jQuery('#furnicom-opts-group-menu li:first').addClass('active');
	
	}else{
		
		tabid = jQuery('#last_tab').val();
		jQuery('#'+tabid+'_section_group').slideDown('fast');
		jQuery('#'+tabid+'_section_group_li').addClass('active');
		
	}
	
	
	jQuery('input[name="'+furnicom_opts.opt_name+'[defaults]"]').click(function(){
		if(!confirm(furnicom_opts.reset_confirm)){
			return false;
		}
	});
	
	jQuery('.furnicom-opts-group-tab-link-a').click(function(){
		relid = jQuery(this).attr('data-rel');
		
		jQuery('#last_tab').val(relid);
		
		jQuery('.furnicom-opts-group-tab').each(function(){
			if(jQuery(this).attr('id') == relid+'_section_group'){
				jQuery(this).show();
			}else{
				jQuery(this).hide();
			}
			
		});
		
		jQuery('.furnicom-opts-group-tab-link-li').each(function(){
				if(jQuery(this).attr('id') != relid+'_section_group_li' && jQuery(this).hasClass('active')){
					jQuery(this).removeClass('active');
				}
				if(jQuery(this).attr('id') == relid+'_section_group_li'){
					jQuery(this).addClass('active');
				}
		});
	});
	
	
	
	
	if(jQuery('#furnicom-opts-save').is(':visible')){
		jQuery('#furnicom-opts-save').delay(4000).slideUp('slow');
	}
	
	if(jQuery('#furnicom-opts-imported').is(':visible')){
		jQuery('#furnicom-opts-imported').delay(4000).slideUp('slow');
	}	
	
	jQuery('input, textarea, select').change(function(){
		jQuery('#furnicom-opts-save-warn').slideDown('slow');
	});
	
	
	jQuery('#furnicom-opts-import-code-button').click(function(){
		if(jQuery('#furnicom-opts-import-link-wrapper').is(':visible')){
			jQuery('#furnicom-opts-import-link-wrapper').fadeOut('fast');
			jQuery('#import-link-value').val('');
		}
		jQuery('#furnicom-opts-import-code-wrapper').fadeIn('slow');
	});
	
	jQuery('#furnicom-opts-import-link-button').click(function(){
		if(jQuery('#furnicom-opts-import-code-wrapper').is(':visible')){
			jQuery('#furnicom-opts-import-code-wrapper').fadeOut('fast');
			jQuery('#import-code-value').val('');
		}
		jQuery('#furnicom-opts-import-link-wrapper').fadeIn('slow');
	});
	
	
	
	
	jQuery('#furnicom-opts-export-code-copy').click(function(){
		if(jQuery('#furnicom-opts-export-link-value').is(':visible')){jQuery('#furnicom-opts-export-link-value').fadeOut('slow');}
		jQuery('#furnicom-opts-export-code').toggle('fade');
	});
	
	jQuery('#furnicom-opts-export-link').click(function(){
		if(jQuery('#furnicom-opts-export-code').is(':visible')){jQuery('#furnicom-opts-export-code').fadeOut('slow');}
		jQuery('#furnicom-opts-export-link-value').toggle('fade');
	});
	
	

	
	
	
});