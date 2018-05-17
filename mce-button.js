(function() {
	tinymce.create('tinymce.plugins.GDPlayer', {
		init: function(ed, url) {
			ed.addButton('GDPlayer', {
				title: 'Insert Videos With GD Player',
				image: url+'/GEmbed.png',
				onclick: function() {
					var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
					W = W - 80;
					H = H - 124;
					tb_show('Insert Videos With GD Player', '#TB_inline?inlineId=GDPlayerpopup&width=' + W + '&height=' + H);
					jQuery("#TB_window").animate({
						height: H + 40 + 'px'
					});
					return false;
				}
			});
		},
		createControl: function(n, cm) {
			return null;
		},
		getInfo: function() {
			return {
				longname: 'GDPlayer for WordPress',
				author: 'Luan Elezi',
				authorurl: 'https://ingolin.com/',
				infourl: 'https://ingolin.com/support/',
				version: '1.1'
			};
		}
	});
	tinymce.PluginManager.add('GDPlayer', tinymce.plugins.GDPlayer);
	
	jQuery(function() {
		//get the checkbox defaults
		var autoplay_default = jQuery('#GDPlayer-autoplay-default').val();
		if ( autoplay_default == 'on' )
			autoplay_checked = ' checked';
		else
			autoplay_checked = '';
		
		var preload_default = jQuery('#GDPlayer-preload-default').val();
		if ( preload_default == 'on' )
			preload_checked = ' checked';
		else
			preload_checked = '';

		
		var form = jQuery('<div id="GDPlayerpopup">\
		<table id="GDPlayertable" class="form-table">\
			<tr>\
				<th><label for="GDPlayer-gdrive">Google Drive Source</label></th>\
				<td><input type="text" name="GDPlayer-gdrive" id="GDPlayer-gdrive"><br>\
				<small>Add Link For Goole Drive Videos. (Works Only With Pro Version)</small></td>\
			</tr>\
			<tr>\
				<th><label for="GDPlayer-mp4">MP4 Source</label></th>\
				<td><input type="text" name="GDPlayer-mp4" id="GDPlayer-mp4"><br>\
				<small>Add Link For MP4 Videos.</small></td>\
			</tr>\
			<tr>\
				<th><label for="GDPlayer-webm">WebM Source</label></th>\
				<td><input type="text" name="GDPlayer-webm" id="GDPlayer-webm"><br>\
				<small>Add Link For WebM Videos.</small></td>\
			</tr>\
			<tr>\
				<th><label for="GDPlayer-ogg">OGG Source</label></th>\
				<td><input type="text" name="GDPlayer-ogg" id="GDPlayer-ogg"><br>\
				<small>Add Link For OGG Videos.</small></td>\
			</tr>\
			<tr>\
				<th><label for="GDPlayer-youtube">YouTube Url</label></th>\
				<td><input type="text" name="GDPlayer-youtube" id="GDPlayer-youtube"><br>\
				<small>Add Link For YouTube Videos.</small></td>\
			</tr>\
			<tr>\
				<th><label for="GDPlayer-poster">Poster Image</label></th>\
				<td><input type="text" name="GDPlayer-poster" id="GDPlayer-poster"><br>\
				<small>The location of the (Image) poster frame for the video.</small></td>\
			</tr>\
			<tr>\
				<th><label for="GDPlayer-width">Width</label></th>\
				<td><input type="text" name="GDPlayer-width" id="GDPlayer-width"><br>\
				<small>The width of the video.</small></td>\
			</tr>\
			<tr>\
				<th><label for="GDPlayer-height">Height</label></th>\
				<td><input type="text" name="GDPlayer-height" id="GDPlayer-height"><br>\
				<small>The height of the video.</small></td>\
			</tr>\
			<tr>\
				<th><label for="GDPlayer-preload">Preload</label></th>\
				<td><input id="GDPlayer-preload" name="GDPlayer-preload" type="checkbox"'+preload_checked+' /></td>\
			</tr>\
			<tr>\
				<th><label for="GDPlayer-autoplay">Autoplay</label></th>\
				<td><input id="GDPlayer-autoplay" name="GDPlayer-autoplay" type="checkbox"'+autoplay_checked+' /></td>\
			</tr>\
			<tr>\
				<th><label for="GDPlayer-loop">Loop</label></th>\
				<td><input id="GDPlayer-loop" name="GDPlayer-loop" type="checkbox" /></td>\
			</tr>\
			<tr>\
				<th><label for="GDPlayer-controls">Show Player Controls</label></th>\
				<td><input id="GDPlayer-controls" name="GDPlayer-controls" type="checkbox" checked /></td>\
			</tr>\
			<tr>\
				<th><label for="GDPlayer-id">ID</label></th>\
				<td><input type="text" name="GDPlayer-id" id="GDPlayer-id"><br>\
				<small>Add a custom ID to your video player.</small></td>\
			</tr>\
			<tr>\
				<th><label for="GDPlayer-class">Class</label></th>\
				<td><input type="text" name="GDPlayer-class" id="GDPlayer-class"><br>\
				<small>Add a custom class to your player. Use full for floating the video player using \'alignleft\' or \'alignright\'.</small></td>\
			</tr>\
		</table>\
		<p class="submit">\
				<input type="button" id="GDPlayer-submit" class="button-primary" value="Insert Video" name="submit" />\
		</p>\
		</div>');
		var table = form.find('table');
		form.appendTo('body').hide();

		
		form.find('#GDPlayer-submit').click(function(){
			
			var shortcode = '[GDPlayer';
			
			//text options
			var options = { 
			    'gdrive'   : '',
				'mp4'      : '',
				'webm'     : '',
				'ogg'      : '',
				'poster'   : '',
				'width'    : '',
				'height'   : '',
				'id'       : '',
				'class'    : ''
			};
			
			for(var index in options) {
				var value = table.find('#GDPlayer-' + index).val();
				
				// attaches the attribute to the shortcode only if it's different from the default value
				if ( value !== options[index] )
					shortcode += ' ' + index + '="' + value + '"';
			}
			
			//checkbox options
			options = { 
				'autoplay' : autoplay_default,
				'preload'  : preload_default,
				'loop'     : '',
				'controls' : 'on'
			};
			
			for(var index in options) {
				var value = table.find('#GDPlayer-' + index).is(':checked');
				
				if ( value == true )
					checked = 'on';
				else
					checked = '';
				
				// attaches the attribute to the shortcode only if it's different from the default value
				if ( checked !== options[index] )
					shortcode += ' ' + index + '="' + value + '"';
			}
			
			//close the shortcode
			shortcode += ']';
			
			// inserts the shortcode into the active editor
			tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
			
			// closes Thickbox
			tb_remove();
		});
	});
})();
