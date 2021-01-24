(function() {
    tinymce.create('tinymce.plugins.noo_before_after_button', {
        init: function(editor, url){
            editor.addButton('noo_before_after_button', {
				title: 'Insert/edit Noo Before After Shortcode',
				cmd: 'noo-before-after',
				image: url + '/icon.png'
			});
            this.editor = editor;
			this.url = url;

			this._events = {
				disableUndo: function(e){
					return false
				}
			};

            var btnAction = function(){
				var textSelection = this.getTextSelection(),
					handler = $nba.fn.handleShortcodeCall.apply(window, textSelection);
				if (handler.selection !== undefined) {
					// Updating selection: seeking DOM elements for each selection part
					this.applySelection(handler.selection[0], handler.selection[1]);
				}
				if (handler.action === 'insert') {
					$nba.shortcodelist.unbind('select').bind('select', function(name){
                        var content = editor.getContent({format: 'html'}),
                            startTrigger = '!nba-selection-start!',
                            endTrigger = '!nba-selection-end!',
                            newContent = content.substr(0, handler.selection[0]) + startTrigger + content.substring(handler.selection[0], handler.selection[1]) + endTrigger + content.substr(handler.selection[1]);
                        editor.setContent(newContent);
                        // Looking for selection triggers
                        var startContainer, startOffset,
                            endContainer, endOffset,
                            nodeWalker = document.createTreeWalker(editor.getBody(), NodeFilter.SHOW_TEXT, null, false),
                            node;
                        while (node = nodeWalker.nextNode()) {
                            if (!startContainer) {
                                if ((startOffset = node.nodeValue.indexOf(startTrigger)) !== -1) {
                                    node.nodeValue = node.nodeValue.substr(0, startOffset) + node.nodeValue.substr(startOffset + startTrigger.length);
                                    startContainer = node;
                                }
                            }
                            if (!endContainer) {
                                if ((endOffset = node.nodeValue.indexOf(endTrigger)) !== -1) {
                                    node.nodeValue = node.nodeValue.substr(0, endOffset) + node.nodeValue.substr(endOffset + endTrigger.length);
                                    endContainer = node;
                                }
                            }
                        }
                        if (startContainer) {
                            if (endContainer) {
                                var rng = editor.selection.getRng();
                                rng.setStart(startContainer, startOffset);
                                rng.setEnd(endContainer, endOffset);
                                editor.selection.setRng(rng);
                            } else {
                                editor.selection.setCursorLocation(startContainer, startOffset);
                            }
                            // Restoring textarea default value
                            editor.getElement().value = content;
                        } else {
                            editor.setContent(content);
                        }
						editor.insertContent($nba.fn.generateShortcode(name));
						range = editor.selection.getRng();
						editor.selection.setCursorLocation(range.endContainer, range.endOffset - 1);
						btnAction();
					});
					$nba.shortcodelist.show();
				} else if (handler.action === 'edit') {
					$nba.builder.unbind('save').bind('save', function(values, defaults){
						var shortcode = $nba.fn.generateShortcode(handler.shortcode, values, defaults);
						shortcode = shortcode.replace(/\n/g, '<br> ');
                        var content = editor.getContent({format: 'html'}),
                            startTrigger = '!nba-selection-start!',
                            endTrigger = '!nba-selection-end!',
                            newContent = content.substr(0, handler.selection[0]) + startTrigger + content.substring(handler.selection[0], handler.selection[1]) + endTrigger + content.substr(handler.selection[1]);
                        editor.setContent(newContent);
                        // Looking for selection triggers
                        var startContainer, startOffset,
                            endContainer, endOffset,
                            nodeWalker = document.createTreeWalker(editor.getBody(), NodeFilter.SHOW_TEXT, null, false),
                            node;
                        while (node = nodeWalker.nextNode()) {
                            if (!startContainer) {
                                if ((startOffset = node.nodeValue.indexOf(startTrigger)) !== -1) {
                                    node.nodeValue = node.nodeValue.substr(0, startOffset) + node.nodeValue.substr(startOffset + startTrigger.length);
                                    startContainer = node;
                                }
                            }
                            if (!endContainer) {
                                if ((endOffset = node.nodeValue.indexOf(endTrigger)) !== -1) {
                                    node.nodeValue = node.nodeValue.substr(0, endOffset) + node.nodeValue.substr(endOffset + endTrigger.length);
                                    endContainer = node;
                                }
                            }
                        }
                        if (startContainer) {
                            if (endContainer) {
                                var rng = editor.selection.getRng();
                                rng.setStart(startContainer, startOffset);
                                rng.setEnd(endContainer, endOffset);
                                editor.selection.setRng(rng);
                            } else {
                                editor.selection.setCursorLocation(startContainer, startOffset);
                            }
                            // Restoring textarea default value
                            editor.getElement().value = content;
                        } else {
                            editor.setContent(content);
                        }
						editor.insertContent(shortcode);
					});
					$nba.builder.show(handler.shortcode, handler.values);
				}
			}.bind(this);

			editor.addCommand('noo-before-after', btnAction);
        },

        disableUndo: function(){
			this.editor.on('BeforeAddUndo', this._events.disableUndo);
		},

        enableUndo: function(){
			this.editor.off('BeforeAddUndo', this._events.disableUndo);
		},

        getTextSelection: function(){
			var range = this.editor.selection.getRng(),
				startTrigger = '!nba-selection-start!',
				endTrigger = '!nba-selection-end!',
				content = this.editor.getContent({format: 'html'}),
				startOffset, endOffset;
			this.disableUndo();
			this.editor.selection.setContent(startTrigger + this.editor.selection.getContent() + endTrigger);
			startOffset = this.editor.getContent().indexOf(startTrigger);
			endOffset = this.editor.getContent().indexOf(endTrigger);
			if (startOffset !== -1 && endOffset !== -1 && endOffset > startOffset) endOffset -= startTrigger.length;
			this.editor.setContent(content);
			this.enableUndo();
			return [content, startOffset, endOffset];
		},

        applySelection: function(start, end){
			var content = this.editor.getContent({format: 'html'}),
				startTrigger = '!nba-selection-start!',
				endTrigger = '!nba-selection-end!',
				newContent = content.substr(0, start) + startTrigger + content.substring(start, end) + endTrigger + content.substr(end);
			this.disableUndo();
			this.editor.setContent(newContent);
			// Looking for selection triggers
			var startContainer, startOffset,
				endContainer, endOffset,
				nodeWalker = document.createTreeWalker(this.editor.getBody(), NodeFilter.SHOW_TEXT, null, false),
				node;
			while (node = nodeWalker.nextNode()) {
				if (!startContainer) {
					if ((startOffset = node.nodeValue.indexOf(startTrigger)) !== -1) {
						node.nodeValue = node.nodeValue.substr(0, startOffset) + node.nodeValue.substr(startOffset + startTrigger.length);
						startContainer = node;
					}
				}
				if (!endContainer) {
					if ((endOffset = node.nodeValue.indexOf(endTrigger)) !== -1) {
						node.nodeValue = node.nodeValue.substr(0, endOffset) + node.nodeValue.substr(endOffset + endTrigger.length);
						endContainer = node;
					}
				}
			}
			if (startContainer) {
				if (endContainer) {
					var rng = this.editor.selection.getRng();
					rng.setStart(startContainer, startOffset);
					rng.setEnd(endContainer, endOffset);
					this.editor.selection.setRng(rng);
				} else {
					this.editor.selection.setCursorLocation(startContainer, startOffset);
				}
				// Restoring textarea default value
				this.editor.getElement().value = content;
			} else {
				this.editor.setContent(content);
			}
			this.enableUndo();
		},

		getInfo: function(){
			return {
				longname: 'NooTheme Shortcodes',
				author: 'NooTheme',
				authorurl: 'https://nootheme.com/',
				infourl: 'https://nootheme.com/',
				version: '1.0'
			};
		}
    });

    // Register plugin
	tinymce.PluginManager.add('noo_before_after_button', tinymce.plugins.noo_before_after_button);
})(jQuery);
