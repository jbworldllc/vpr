!function($){
	if (window.$nba.mixins === undefined) window.$nba.mixins = {};

	/**
	 * Class mutator, allowing bind, unbind, and trigger class instance events
	 * @type {{}}
	 */
	$nba.mixins.Events = {
		/**
		 * Attach a handler to an event for the class instance
		 * @param {String} eventType A string containing event type, such as 'beforeShow' or 'change'
		 * @param {Function} handler A function to execute each time the event is triggered
		 */
		bind: function(eventType, handler){
			if (this.$$events === undefined) this.$$events = {};
			if (this.$$events[eventType] === undefined) this.$$events[eventType] = [];
			this.$$events[eventType].push(handler);
			return this;
		},
		/**
		 * Remove a previously-attached event handler from the class instance
		 * @param {String} eventType A string containing event type, such as 'beforeShow' or 'change'
		 * @param {Function} [handler] The function that is to be no longer executed.
		 * @chainable
		 */
		unbind: function(eventType, handler){
			if (this.$$events === undefined || this.$$events[eventType] === undefined) return this;
			if (handler !== undefined) {
				var handlerPos = $.inArray(handler, this.$$events[eventType]);
				if (handlerPos != -1) {
					this.$$events[eventType].splice(handlerPos, 1);
				}
			} else {
				this.$$events[eventType] = [];
			}
			return this;
		},
		/**
		 * Execute all handlers and behaviours attached to the class instance for the given event type
		 * @param {String} eventType A string containing event type, such as 'beforeShow' or 'change'
		 * @param {Array} extraParameters Additional parameters to pass along to the event handler
		 * @chainable
		 */
		trigger: function(eventType, extraParameters){
			if (this.$$events === undefined || this.$$events[eventType] === undefined || this.$$events[eventType].length == 0) return this;
			for (var index = 0; index < this.$$events[eventType].length; index++) {
				this.$$events[eventType][index].apply(this, extraParameters);
			}
			return this;
		}
	};

	/**
	 * $nba.Field class
	 * Boundable events: beforeShow, afterShow, change, beforeHide, afterHide
	 * @param control
	 * @param form - container form
	 * @constructor
	 */
	$nba.Field = function(control, form){
		this.$control = $(control);
        this.form = form;
		if (this.$control.data('nbafield'))
		    return this.$control.data('nbafield');
		this.type = this.$control.data('param_type');
		this.name = this.$control.data('param_name');
		this.$input = this.$control.find('input[name], textarea[name], select[name]');
		this.inited = false;

		// Overloading by a certain type's declaration, moving parent functions to "parent" namespace: init => parentInit
		if ($nba.Field[this.type] !== undefined) {
			for (var fn in $nba.Field[this.type]) {
				if (!$nba.Field[this.type].hasOwnProperty(fn)) continue;
				if (this[fn] !== undefined) {
					var parentFn = 'parent' + fn.charAt(0).toUpperCase() + fn.slice(1);
					this[parentFn] = this[fn];
				}
				this[fn] = $nba.Field[this.type][fn];
			}
		}

		this.$control.data('nbafield', this);

		// Init on the first show
		var initEvent = function(){
			this.init();
			this.inited = true;
			this.unbind('beforeShow', initEvent);
		}.bind(this);
		this.bind('beforeShow', initEvent);
	};
	$.extend($nba.Field.prototype, $nba.mixins.Events, {
		init: function(){
			this.$input.on('change', function(){
				this.trigger('change', [this.getValue()]);
			}.bind(this));
		},
		deinit: function(){
		},
		getValue: function(){
			return this.$input.val();
		},
		setValue: function(value){
			this.$input.val(value);

			this.render();
			this.trigger('change', [value]);
		},
		render: function(){
		}
	});

    /**
     * $nba.Field type: select/dropdown
     */
    $nba.Field['select'] = $nba.Field['dropdown'] = {
        init: function(){
            this.$input.on('change keyup', function(){
                this.trigger('change', [this.getValue()]);
            }.bind(this));
        }
    };

    /**
     * $nba.Field type: radio
     */
    $nba.Field['radio'] = {
        getValue: function(){
            var value = '';
            this.$input.each( function(index, radio) {
                if( radio.checked) value = $(this).attr('value');
            });
            return value;
        },
        setValue: function(value){
            this.$input.each( function(index, radio) {
                radio.checked = false;
                if( $(radio).attr('value') == value ) radio.checked = true;
            });
            this.render();
            this.trigger('change', [value]);
        }
    };

	/**
	 * $nba.Field type: checkbox
	 */
	$nba.Field['checkbox'] = {
		init: function(){
			this.parentInit();
			this.$checkboxes = this.$control.find('input[type="checkbox"]');
			this._events = {
				change: function(){
					var value = '';
					this.$checkboxes.each(function(index, checkbox){
						if (checkbox.checked) value += ((value != '') ? ',' : '') + checkbox.value;
					}.bind(this));
					this.$input.val(value).trigger('change');
				}.bind(this)
			};
			this.$checkboxes.on('change', this._events.change);
		},

		render: function(){
			var value = this.getValue().split(',');
			this.$checkboxes.each(function(index, checkbox){
				$(checkbox).attr('checked', ($.inArray(checkbox.value, value) != -1) ? 'checked' : false);
			}.bind(this));
		}
	};

	/**
	 * $nba.Field type: exploded_textarea
	 */
	$nba.Field['exploded_textarea'] = {
        init: function(){
            this.parentInit();
            this.$textarea = this.$control.find('textarea');
            this._events = {
                change: function(){
                    var value = this.encode( this.$textarea.val() );
                    this.$input.val(value).trigger('change');
                }.bind(this)
            };
            this.$textarea.on('change', this._events.change);
        },
        getValue: function(){
        	var value = this.$input.val();
        	value = value.match(/\n/g) ? this.encode( value ) : value;

        	return value;
        },
        render: function(){
            var value = this.decode( this.getValue() );
            this.$textarea.val(value);
        },
        encode: function( value ) {
        	return value.replace(/\n/g, ",");
		},
        decode: function( value ) {
        	return value.split(',').join("\n");
		}
	};

    /**
     * $nba.Field type: textarea_safe
     */
    $nba.Field['textarea_safe'] = {
        init: function(){
            this.parentInit();
            this.$textarea = this.$control.find('textarea');
            this._events = {
                change: function(){
                    var value = this.$textarea.val();
                    value = value.match(/"|(http)/) ? this.encode( value ) : value;

                    this.$input.val(value).trigger('change');
                }.bind(this)
            };
            this.$textarea.on('change', this._events.change);
        },
        getValue: function(){
            var value = this.$input.val();
            value = ( value.match(/"|(http)/) && ! value.match(/^#E\-8_/) ) ? this.encode( value ) : value;

            return value;
        },
        render: function(){
            var value = this.getValue();
            value = value && value.match(/^#E\-8_/) ? this.decode( value ) : value;

            this.$textarea.val(value);
        },
        encode: function( value ) {
            return "#E-8_" + $nba.fn.base64_encode($nba.fn.rawurlencode( value ) );
        },
        decode: function( value ) {
            return $nba.fn.rawurldecode($nba.fn.base64_decode(value.replace(/^#E\-8_/, "")));
        }
    };

	/**
	 * $nba.Field type: exploded_textarea_safe
	 */
	$nba.Field['exploded_textarea_safe'] = {
        init: function(){
            this.parentInit();
            this.$textarea = this.$control.find('textarea');
            this._events = {
                change: function(){
                    var value = this.$textarea.val();
                    value = this.encode( value );

                    this.$input.val(value).trigger('change');
                }.bind(this)
            };
            this.$textarea.on('change', this._events.change);
        },
        getValue: function(){
            var value = this.$input.val();
            value = ( value.match(/\n/g) || ( value.match(/"|(http)/) && ! value.match(/^#E\-8_/) ) ) ? this.encode( value ) : value;

            return value;
        },
        render: function(){
            var value = this.getValue();
            value = this.decode( value );

            this.$textarea.val(value);
        },
        encode: function( value ) {
        	value = value.replace(/\n/g, ",");
            return ( value.match(/"|(http)/) ? "#E-8_" + $nba.fn.base64_encode($nba.fn.rawurlencode( value ) ) : value );
        },
        decode: function( value ) {
            value = value && value.match(/^#E\-8_/) ? $nba.fn.rawurldecode($nba.fn.base64_decode(value.replace(/^#E\-8_/, ""))) : value;
            value = value.split(',').join("\n");

            return value;
        }
	};

    /**
     * $nba.Field type: textarea_raw_html
     */
    $nba.Field['textarea_raw_html'] = {
        init: function(){
            this.parentInit();
            this.$textarea = this.$control.find('textarea');
            this._events = {
                change: function(){
                    var value = this.$textarea.val();
                    value = this.encode( value );

                    this.$input.val(value).trigger('change');
                }.bind(this)
            };
            this.$textarea.on('change', this._events.change);
        },
		getValue: function() {
            var value = this.$input.val();
            var inputtedValue = this.$textarea.val();

            if( value && value == inputtedValue ) {
            	value = this.encode( value );
			}

			return value;
		},
        render: function(){
            var value = this.getValue();
            value = value ? this.decode( value ) : '';

            this.$textarea.val(value);
        },
        encode: function( value ) {
            return $nba.fn.base64_encode($nba.fn.rawurlencode( value ) );
        },
        decode: function( value ) {
            return $nba.fn.rawurldecode($nba.fn.base64_decode(value.trim()));
        }
    };

	/**
	 * $nba.Field type: textarea_html
	 */
	$nba.Field['textarea_html'] = {
		init: function(){
			if (window.tinyMCEPreInit === undefined || !this.$control.is(':visible')) {
				setTimeout(this.init.bind(this), 100);
				return;
			}
			var id = this.$input.attr('id');
			if (id.indexOf('__i__') != -1) return;
			this.$container = this.$control.find('.nba-swysiwyg');
			var curEd = tinymce.get(id);
			var content;
			if (curEd != null) {
				content = curEd.getContent();
				curEd.remove();
			}
			this.mceSettings = this.$container[0].onclick() || {};
			tinyMCEPreInit.mceInit[id] = $.extend(tinyMCEPreInit.mceInit['noo-image-comparison'] || {}, this.mceSettings, {
				selector: '#' + id,
				setup: function(editor){
					editor.on('change', function(){
						tinymce.get(id).save();
						this.$input.trigger('change');
						this.$input.val(window.switchEditors.pre_wpautop(editor.getContent()));
					}.bind(this));
					editor.on('init', function(){
						if (content) editor.setContent(content);
					});
					this.$input.on('keyup', function(){
						editor.setContent(window.switchEditors.wpautop(this.$input.val()));
					}.bind(this));
					this.editor = editor;
				}.bind(this)
			});
			// Removing NooTheme button from html field editor
			tinyMCEPreInit.mceInit[id].toolbar1 = tinyMCEPreInit.mceInit[id].toolbar1.replace(',noo-image-comparison', '');

			tinymce.init(tinyMCEPreInit.mceInit[id]);
			// Quick Tags
			tinyMCEPreInit.qtInit[id] = {id: id};
			this.$container.find('.quicktags-toolbar').remove();
			quicktags(tinyMCEPreInit.qtInit[id]);
			QTags._buttonsInit();
		},

		render: function(){
			if (this.editor === undefined) return;
			var value = this.getValue();
			this.editor.setContent(value);
		}
	};

    /**
     * $nba.Field type: colorpicker
     */
    $nba.Field['colorpicker'] = {
        init: function(){
            this.parentInit();
            this.changeTimer = null;
            this._events = {
                change: function(value){
                    clearTimeout(this.changeTimer);
                    this.changeTimer = setTimeout(function(){
                        this.$input.trigger('change');
                    }.bind(this), 100);
                }.bind(this)
            };
            this.$input.wpColorPicker({
                change: this._events.change
            });
        },
        render: function(){
            var value = this.getValue();
            this.$input.wpColorPicker('color', value);
        }
    };

    createImgItem = function(attachment) {
        if (!attachment || !attachment.attributes.id) return '';
        var html = '<li data-id="' + attachment.id + '">' +
            '<a class="nba-imgattach-delete" href="javascript:void(0)">&times;</a>' +
            '<img width="150" height="150" class="attachment-thumbnail" src="';
        if (attachment.attributes.sizes !== undefined) {
            var size = (attachment.attributes.sizes.thumbnail !== undefined) ? 'thumbnail' : 'full';
            html += attachment.attributes.sizes[size].url;
        }
        html += '"></li>';
        var $item = $(html);
        if (attachment.attributes.sizes === undefined) {
            // Loading missing image via ajax
            attachment.fetch({
                success: function(){
                    var size = (attachment.attributes.sizes.thumbnail !== undefined) ? 'thumbnail' : 'full';
                    $item.find('img').attr('src', attachment.attributes.sizes[size].url);
                }.bind(this)
            });
        }
        return $item;
	};


    $nba.Field['param_group'] = {
        init: function() {
            this.parentInit();

            var btnToggle = $('.column_toggle');
            var btnClone = $('.column_clone');
            var btnDelete = $('.column_delete');
            this.$btnAddItem = this.$control.find('.nba_param_group-add_content');


            this._events = {
                createItem: function(event) {
                    event.preventDefault();
                	this.createItem();
				}.bind(this),
                showElement: function(event) {
                    event.preventDefault();
                    this.$curItem = $(event.target).closest('li');
                    this.showElement(this.$curItem);
                }.bind(this),
                deleteItem: function(event) {
                    event.preventDefault();
                    this.$curItem = $(event.target).closest('li');
                    var confDelete = confirm('Press OK to delete section, Cancel to leave');
                    if(confDelete)
                    	this.$curItem.remove();
                }.bind(this),
                cloneItem: function(event) {
                    event.preventDefault();
                    this.$curItem = $(event.target).closest('li');
                    this.cloneItem(this.$curItem);
                }.bind(this),
            };

            this._events.render;
            btnToggle.on('click', this._events.showElement);
            this.$btnAddItem.on('click', this._events.createItem);
            btnDelete.on('click', this._events.deleteItem);
            btnClone.on('click', this._events.cloneItem);

            $('.nba_param_group-list').sortable({
				items: "> .nba_param",
				handle: ".column_move",
                placeholder: "nba-placeholder"
			});
            $('.nba_param_group-list').disableSelection();
        },

        render: function() {
        	$('.nba_param').remove();
            var value = this.getValue();
            if(value !== '' & value != null) {
                value = decodeURIComponent(value);
                value = json_decode(value);

                for (var i = 0; i < value.length; i++) {
                    this.createItem(value[i], i);
                }
            }
        },

        createItem: function(data) {
        	this.$blank_item = this.$control.find('.nba_param_group_blank');
        	this.$list = this.$btnAddItem.parent();
        	this.$clonedDiv = this.$blank_item.clone(true).addClass('nba_param').removeClass('nba_param_group_blank');
        	var clonedDiv = this.$clonedDiv;
            clonedDiv.insertBefore('.nba_param_group_blank');

            var pgInputData = {};
            var pgInputs = clonedDiv.find('input[name], textarea[name], select[name]');
            pgInputs.each(function() {
                pgInputData[$(this).attr('name')] = '';
            });

            if(typeof data == 'object') {
                var pgInputNewData = $.extend(pgInputData, data);
            } else {
                var pgInputNewData = pgInputData;
            }


            $.map(pgInputNewData, function(v, k) {

                var input = clonedDiv.find('input[name="' + k + '"]');
                input.val(v);

                //media
                if (input.data('type') && input.data('type') == 'image') {

                    var imgAttachs = input.parents('.nba-imgattach');
                    var list = imgAttachs.find('.nba-imgattach-list');
                    var multiple = imgAttachs.data('multiple');
                    var btnAddImg = imgAttachs.find('.nba-imgattach-add');
                    var value = v,
                        items = {},
                        currentIds = [],
                        neededIds = value ? value.split(',').map(Number) : [];
                    list.children().toArray().forEach(function(item){
                        var $item = $(item),
                            id = parseInt($item.data('id'));
                        items[id] = $item;
                        currentIds.push(id);
                    });
                     var index = 0;
                    for (index = 0; index < neededIds.length; index++) {
                        var id = neededIds[index],
                            currentIndex = currentIds.indexOf(id, index);
                        if (currentIndex == index) continue;
                        if (currentIndex == -1) {
                            // Creating the new item
                            var attachment = wp.media.attachment(id);
                            items[id] = createImgItem(attachment);
                        } else {
                            // Moving existing item
                            currentIds.splice(currentIndex, 1);
                        }
                        if (index == 0) {
                            items[id].prependTo(list);
                        } else {
                            items[id].insertAfter(items[neededIds[index - 1]]);
                        }
                        currentIds.splice(index, 0, id);
                    }
                    for (; index < currentIds.length; index++) {
                        // Removing the excess items
                        items[currentIds[index]].remove();
                    }

                    //open media
                    btnAddImg.on('click', function() {
                        if (this.frame === undefined) {
                            this.frame = wp.media({
                                title: imgAttachs.attr('title'),
                                multiple: multiple ? 'add' : false,
                                library: {type: 'image'},
                                button: {text: imgAttachs.attr('title')}
                            });
                            this.frame.on('open', function(){
                                var value = input.val(),
                                    initialIds = value ? value.split(',').map(Number) : [],
                                    selection = this.frame.state().get('selection');
                                initialIds.forEach(function(id){
                                    selection.add(wp.media.attachment(id));
                                });
                            }.bind(this));
                            this.frame.on('select', function(){
                                var value = input.val(),
                                    initialIds = value ? value.split(',').map(Number) : [],
                                    selection = this.frame.state().get('selection'),
                                    updatedIds = [];
                                selection.forEach(function(attachment){
                                    if (attachment.id && initialIds.indexOf(attachment.id) == -1) {
                                        // Adding the new images
                                        list.append(createImgItem(attachment));
                                    }
                                    //updatedIds.splice(value, 1);
                                    updatedIds.push(attachment.id);
                                }.bind(this));

                                initialIds.forEach(function(id){
                                    if (updatedIds.indexOf(id) == -1) {
                                        // Deleting images that are not present in the recent selection
                                        list.find('[data-id="' + id + '"]').remove();
                                    }
                                }.bind(this));
                                //update value
                                var oldValue = value,
                                    imgIds = list.children().toArray().map(function(item){
                                        return parseInt(item.getAttribute('data-id'));
                                    }),
                                    newValue = imgIds.join(',');
                                if (newValue != oldValue) {
                                    input.val(newValue).trigger('change');
                                }
                            }.bind(this));
                        }
                        this.frame.open();
                    });
                    list.on('click', '.nba-imgattach-delete', function(event) {
                        $(event.target).closest('li').remove();
                        //update value
                        var oldValue = v,
                            imgIds = list.children().toArray().map(function(item){
                                return parseInt(item.getAttribute('data-id'));
                            }),
                            newValue = imgIds.join(',');
                        if (newValue != oldValue) {
                            input.val(newValue).trigger('change');
                        }
                    });
                }
            });
        },

        showElement: function(curItem) {
        	if(curItem.hasClass('nba_param_group-collapsed')) {
        		$('.nba_param').addClass('nba_param_group-collapsed');
                curItem.removeClass('nba_param_group-collapsed');
			} else {
                curItem.addClass('nba_param_group-collapsed');
			}
		},

		cloneItem: function (curItem) {
			curItem.clone(true).addClass('nba_param_group-collapsed').insertAfter(curItem);

        }
    }

    updateInput = function(old_value, list, input) {
        var oldValue = old_value,
            imgIds = list.children().toArray().map(function(item){
                return parseInt(item.getAttribute('data-id'));
            }),
            newValue = imgIds.join(',');
        if (newValue != oldValue) {
            input.val(newValue).trigger('change');
        }
    }

    openMediaUploaderPG = function(pgframe, imgAttachs, input, list, value, multiple) {
        if (pgframe === undefined) {
            pgframe = wp.media({
                title: imgAttachs.attr('title'),
                multiple: multiple ? 'add' : false,
                library: {type: 'image'},
                button: {text: imgAttachs.attr('title')}
            });
            pgframe.on('open', function(){
                var value = value,
                    initialIds = value ? value.split(',').map(Number) : [],
                    selection = pgframe.state().get('selection');
                initialIds.forEach(function(id){
                    selection.add(wp.media.attachment(id));
                });
            });
            pgframe.on('select', function(){
                var value = value,
                    initialIds = value ? value.split(',').map(Number) : [],
                    selection = pgframe.state().get('selection'),
                    updatedIds = [];
                selection.forEach(function(attachment){
                    if (attachment.id && initialIds.indexOf(attachment.id) == -1) {
                        // Adding the new images
                        list.append(createImgItem(attachment));
                    }
                    updatedIds.push(attachment.id);
                });
                initialIds.forEach(function(id){
                    if (updatedIds.indexOf(id) == -1) {
                        // Deleting images that are not present in the recent selection
                        list.find('[data-id="' + id + '"]').remove();
                    }
                });
                updateInput(value, list, input);
            });
        }
        //pgframe.open();
    }

    /**
	 * $nba.Field type: attach_images
	 */
	$nba.Field['attach_image'] = $nba.Field['attach_images'] = {

		init: function(){
			this.parentInit();

			this.$field = this.$control.find('.nba-imgattach');
			this.multiple = this.$field.data('multiple');
			this.$list = this.$field.find('.nba-imgattach-list');
			this.$btnAdd = this.$field.find('.nba-imgattach-add');
            if(!this.$control.parents('.nba-form-control').hasClass('type_param_group')) {
                this._events = {
                    openMediaUploader: this.openMediaUploader.bind(this),
                    deleteImg: function (event) {
                        $(event.target).closest('li').remove();
                        this.updateInput();
                    }.bind(this),
                    updateInput: this.updateInput.bind(this)
                };

                if (this.multiple) {
                    this.$list.sortable({stop: this._events.updateInput});
                }
                this.$btnAdd.on('click', this._events.openMediaUploader);
                this.$list.on('click', '.nba-imgattach-delete', this._events.deleteImg);
            }
		},

		render: function(){
			var value = this.getValue(),
				items = {},
				currentIds = [],
				neededIds = value ? value.split(',').map(Number) : [];
			this.$list.children().toArray().forEach(function(item){
				var $item = $(item),
					id = parseInt($item.data('id'));
				items[id] = $item;
				currentIds.push(id);
			});

			var index = 0;
			for (index = 0; index < neededIds.length; index++) {
				var id = neededIds[index],
					currentIndex = currentIds.indexOf(id, index);
				if (currentIndex == index) continue;
				if (currentIndex == -1) {
					// Creating the new item
					var attachment = wp.media.attachment(id);
					items[id] = this.createItem(attachment);
				} else {
					// Moving existing item
					currentIds.splice(currentIndex, 1);
				}
				if (index == 0) {
					items[id].prependTo(this.$list);
				} else {
					items[id].insertAfter(items[neededIds[index - 1]]);
				}
				currentIds.splice(index, 0, id);
			}
			for (; index < currentIds.length; index++) {
				// Removing the excess items
				items[currentIds[index]].remove();
			}
		},
		updateInput: function(){
			var oldValue = this.getValue(),
				imgIds = this.$list.children().toArray().map(function(item){
					return parseInt(item.getAttribute('data-id'));
				}),
				newValue = imgIds.join(',');
			if (newValue != oldValue) {
				this.$input.val(newValue).trigger('change');
			}
		},
		openMediaUploader: function(){
			if (this.frame === undefined) {
				this.frame = wp.media({
					title: this.$btnAdd.attr('title'),
					multiple: this.multiple ? 'add' : false,
					library: {type: 'image'},
					button: {text: this.$btnAdd.attr('title')}
				});
				this.frame.on('open', function(){
					var value = this.getValue(),
						initialIds = value ? value.split(',').map(Number) : [],
						selection = this.frame.state().get('selection');
					initialIds.forEach(function(id){
						selection.add(wp.media.attachment(id));
					});
				}.bind(this));
				this.frame.on('select', function(){
					var value = this.getValue(),
						initialIds = value ? value.split(',').map(Number) : [],
						selection = this.frame.state().get('selection'),
						updatedIds = [];
					selection.forEach(function(attachment){
						if (attachment.id && initialIds.indexOf(attachment.id) == -1) {
							// Adding the new images
							this.$list.append(this.createItem(attachment));
						}
						updatedIds.push(attachment.id);
					}.bind(this));
					initialIds.forEach(function(id){
						if (updatedIds.indexOf(id) == -1) {
							// Deleting images that are not present in the recent selection
							this.$list.find('[data-id="' + id + '"]').remove();
						}
					}.bind(this));
					this.updateInput();
				}.bind(this));
			}
			this.frame.open();
		},
		/**
		 * Prepare item's dom from WP attachment object
		 * @param {Object} attachment
		 * @return {jQuery}
		 */
		createItem: function(attachment){
			if (!attachment || !attachment.attributes.id) return '';
			var html = '<li data-id="' + attachment.id + '">' +
				'<a class="nba-imgattach-delete" href="javascript:void(0)">&times;</a>' +
				'<img width="150" height="150" class="attachment-thumbnail" src="';
			if (attachment.attributes.sizes !== undefined) {
				var size = (attachment.attributes.sizes.thumbnail !== undefined) ? 'thumbnail' : 'full';
				html += attachment.attributes.sizes[size].url;
			}
			html += '"></li>';
			var $item = $(html);
			if (attachment.attributes.sizes === undefined) {
				// Loading missing image via ajax
				attachment.fetch({
					success: function(){
						var size = (attachment.attributes.sizes.thumbnail !== undefined) ? 'thumbnail' : 'full';
						$item.find('img').attr('src', attachment.attributes.sizes[size].url);
					}.bind(this)
				});
			}
			return $item;
		}

	};

    /**
     * $nba.Field type: select
     */
    $nba.Field['params_preset'] = {
    	init: function() {
    		this.parentInit();
            this._events = {
                change: function(){
                    this.render();
                }.bind(this)
            };
            this.$input.on('change', this._events.change);
		},
        render: function(){
        	var params = this.$input.find('option:selected').data('params');
        	this.setOtherParams( params );
        },
		setOtherParams: function( params ) {
            var form = this.form;
            Object.keys(params).forEach( function( key ) {
                form.fields[key].setValue( params[key] );
            } );
		}
    };

	/**
	 * $nba.Field type: vc_link
	 */
	$nba.Field['vc_link'] = {
		init: function(){
			this.$document = $(document);
			this.$btn = this.$control.find('.nba-linkdialog-btn');
			this.$linkUrl = this.$control.find('.nba-linkdialog-url');
			this.$linkTitle = this.$control.find('.nba-linkdialog-title');
			this.$linkTarget = this.$control.find('.nba-linkdialog-target');
			this._events = {
				open: function(event){
					wpLink.open(this.$input.attr('id'));
					wpLink.textarea = this.$input;
					var data = this.decodeLink(this.getValue());
					$('#wp-link-url').val(data.url);
					$('#wp-link-text').val(data.title);
					$('#wp-link-target').prop('checked', (data.target == '_blank'));
					if( ! $("#link-options .vc-link-nofollow").length ) {
                        $vc_link_nofollow = $('<div class="link-target vc-link-nofollow"><label><span></span> <input type="checkbox" id="vc-link-nofollow"> Add nofollow option to link</label></div>');
                        $vc_link_nofollow.insertAfter($("#link-options .link-target"));
                    }
                    $("#vc-link-nofollow").prop('checked', (data.rel == 'nofollow'));
					$('#wp-link-submit').on('click', this._events.submit);
					this.$document.on('wplink-close', this._events.close);
				}.bind(this),
				submit: function(event){
					event.preventDefault();
					var wpLinkText = $('#wp-link-text').val(),
						linkAtts = wpLink.getAttrs(),
						linkRel = $("#vc-link-nofollow")[0].checked ? "nofollow" : "";
					this.setValue(this.encodeLink(linkAtts.href, wpLinkText, linkAtts.target, linkRel));
					this.$input.trigger('change');
					this._events.close();
				}.bind(this),
				close: function(){
					this.$document.off('wplink-close', this._events.close);
					$('#wp-link-submit').off('click', this._events.submit);
					if (typeof wpActiveEditor != 'undefined') wpActiveEditor = undefined;
					wpLink.close();
				}.bind(this)
			};

			this.$btn.on('click', this._events.open);
		},
		render: function(){
			var value = this.getValue(),
				parts = value.split('|'),
				data = {};
			for (var i = 0; i < parts.length; i++) {
				var part = parts[i].split(':', 2);
				if (part.length > 1) data[part[0]] = decodeURIComponent(part[1]);
			}
			this.$linkTitle.text(data.title || '');
			this.$linkUrl.text(this.shortenUrl(data.url || ''));
			this.$linkTarget.text(data.target || '');
		},
		/**
		 * Get shortened version of URL with url's beginning and end
		 * @param url
		 */
		shortenUrl: function(url){
			return (url.length <= 50) ? url : (url.substr(0, 20) + '...' + url.substr(url.length - 21));
		},
		encodeLink: function(url, title, target, rel){
			var result = 'url:' + encodeURIComponent(url);
			if (title) result += '|title:' + encodeURIComponent(title);
			if (target) result += '|target:' + encodeURIComponent(target);
			if (rel) result += '|rel:' + encodeURIComponent(rel);
			return result;
		},
		decodeLink: function(link){
			var atts = link.split('|'),
				result = {url: '', title: '', target: '', rel: ''};
			atts.forEach(function(value, index){
				var param = value.split(':', 2);
				result[param[0]] = decodeURIComponent(param[1]).trim();
			});
			return result;
		}
	};

	/**
	 * $nba.Field type: iconpicker
	 */
	$nba.Field['iconpicker'] = {
		rendered: false,
		render: function(){
			if( ! this.rendered ) {
                var settings = $.extend({
                    iconsPerPage: 64,
                    iconDownClass: "fip-fa fa fa-arrow-down",
                    iconUpClass: "fip-fa fa fa-arrow-up",
                    iconLeftClass: "fip-fa fa fa-arrow-left",
                    iconRightClass: "fip-fa fa fa-arrow-right",
                    iconSearchClass: "fip-fa fa fa-search",
                    iconCancelClass: "fip-fa fa fa-remove",
                    iconBlockClass: "fip-fa"
                }, this.$input.data("settings"));
                this.$input.fontIconPicker(settings);

                this.rendered = true;
			}
		}
	};

	/**
	 * $nba.Field type: google_fonts
	 */
	$nba.Field['google_fonts'] = {
        init: function(){
            this.parentInit();
            this.$fontFamily = this.$control.find('select.nba-google_fonts-font_family-select');
            this.$fontStyle = this.$control.find('select.nba-google_fonts-font_style-select');
            this._events = {
                familyChange: function() {
                    this.renderStyle().trigger('change');
                }.bind(this),
				styleChange: function() {
                    var font_family = this.$fontFamily.val(),
                        font_style = this.$fontStyle.val();
                    font_family = ( typeof font_family === 'string' ) && 0 < font_family.length ? 'font_family' + ":" + encodeURIComponent(font_family) : '';
                    font_style = ( typeof font_style === 'string' ) && 0 < font_style.length ? 'font_style' + ":" + encodeURIComponent(font_style) : '';
                    var value = ( font_family !== '' && font_style !== '' ) ? font_family + '|' + font_style : font_family + font_style;

                    this.$input.val(value).trigger('change');
				}.bind(this)
            };
            this.$fontFamily.on('change', this._events.familyChange);
            this.$fontStyle.on('change', this._events.styleChange);
        },
        render: function(){
            var value = this.getValue(),
                parts = value.split('|'),
                data = {};
            for (var i = 0; i < parts.length; i++) {
                var part = parts[i].split(':', 2);
                if (part.length > 1) data[part[0]] = decodeURIComponent(part[1]);
            }
            this.$fontFamily.val(data.font_family || '');
            this.renderStyle().val(data.font_style || '');
        },
		renderStyle: function(){
            var $font_family_selected = this.$fontFamily.find(":selected"),
                font_types = $font_family_selected.attr("data[font_types]"),
                str_arr = font_types.split(","),
                oel = "",
                default_f_style = this.$fontFamily.attr("default[font_style]");
            for (var str_inner in str_arr) {
                var str_arr_inner = str_arr[str_inner].split(":"),
                    selected = "";
                if( ( typeof default_f_style === 'string' ) && 0 < default_f_style.length && str_arr[str_inner] == default_f_style ) {
                    selected = "selected";
                }
                oel = oel + "<option " + selected + ' value="' + str_arr[str_inner] + '" data[font_weight]="' + str_arr_inner[1] + '" data[font_style]="' + str_arr_inner[2] + '">' + str_arr_inner[0] + "</option>";
            }

            return this.$fontStyle.html(oel);
		}
	};

	/**
	 * $nba.Tabs class
	 *
	 * Boundable events: beforeShow, afterShow, beforeHide, afterHide
	 *
	 * @param container
	 * @constructor
	 */
	$nba.Tabs = function(container){
		this.$container = $(container);
		this.$items = this.$container.find('.nba-tabs-item');
		this.$sections = this.$container.find('.nba-tabs-section');
		this.items = this.$items.toArray().map($);
		this.sections = this.$sections.toArray().map($);
		this.active = 0;
		this.items.forEach(function($elm, index){
			$elm.on('click', this.open.bind(this, index));
		}.bind(this));
	};
	$.extend($nba.Tabs.prototype, $nba.mixins.Events, {
		open: function(index){
			if (index == this.active || this.sections[index] == undefined) return;
			if (this.sections[this.active] !== undefined) {
				this.trigger('beforeHide', [this.active, this.sections[this.active], this.items[this.active]]);
				this.sections[this.active].hide();
				this.items[this.active].removeClass('active');
				this.trigger('afterHide', [this.active, this.sections[this.active], this.items[this.active]]);
			}
			this.trigger('beforeShow', [index, this.sections[index], this.items[index]]);
			this.sections[index].show();
			this.items[index].addClass('active');
			this.trigger('afterShow', [index, this.sections[index], this.items[index]]);
			this.active = index;
		}
	});

	/**
	 * $nba.Form class
	 * @param container
	 * @constructor
	 */
	$nba.Form = function(container){
		this.$container = $(container);
		this.$tabs = this.$container.find('.nba-tabs');
		if (this.$tabs.length) {
			this.tabs = new $nba.Tabs(this.$tabs);
		}

		// Dependencies rules and the list of dependent fields for all the affecting fields
		this.dependency = {};
		this.affects = {};

		this.$fields = this.$container.find('.nba-form-control');
		this.fields = {};

		this.$fields.each(function(index, control){
			var $control = $(control),
				name = $control.data('param_name');
            this.fields[name] = new $nba.Field($control, this);
            this.fields[name].trigger('beforeShow');

			var $dependency = $control.find('.nba-form-control-dependency');
			if ($dependency.length) {
				var dependency = ($dependency[0].onclick() || {});
				if( dependency.element !== undefined ) {
                    this.dependency[name] = dependency;
                    if (this.affects[dependency.element] === undefined)
                    	this.affects[dependency.element] = [];
                    this.affects[dependency.element].push(name);
                }
			}
		}.bind(this));

		$.each(this.affects, function(name, affectedList){
			var onChangeFn = function(){
				for (var index = 0; index < affectedList.length; index++) {
                    if (this.shouldBeVisible(affectedList[index])) {
                        this.fields[affectedList[index]].$control.show();
                    } else {
                        this.fields[affectedList[index]].$control.hide();
                    }
                    if (this.dependency[affectedList[index]].callback !== undefined && window[this.dependency[affectedList[index]].callback] !== undefined) {
                        window[this.dependency[affectedList[index]].callback]();
                    }
				}
			}.bind(this);
			//this.fields[name].bind('change', onChangeFn);
			onChangeFn();
		}.bind(this));
	};
	$.extend($nba.Form.prototype, {
		/**
		 * Get a particular field value
		 * @param {String} name Field name
		 * @return {String}
		 */
		getValue: function(name){
			return (this.fields[name] === undefined) ? null : this.fields[name].getValue();
		},
		setValue: function(name, value){
			if (this.fields[name] !== undefined) this.field[name].setValue(value);
		},
		getValues: function(){
			var values = {};

			$.each(this.fields, function(name, field){
				values[name] = field.getValue();
			}.bind(this));
			return values;
		},
		setValues: function(values){
			$.each(values, function(name, value){
                if(typeof value === 'object') {
                    if (this.fields[name] !== undefined && value !== undefined && value !== null) {
                    	var this_fields = this.fields;

						$.each(value, function(arr_pg_name, arr_pg_value) {
                            $.map(arr_pg_value, function(v, i){

                                if (this_fields[i] !== undefined) {
                                    this_fields["input"].setValue(v);

                                }
                            });
						});
                    }
                } else {
                    if (this.fields[name] !== undefined)
                    	this.fields[name].setValue(value);
                }
			}.bind(this));
		},
		generateParamGroupItem: function() {

		},
		/**
		 * Check if the field should be visible
		 * @param {String} name
		 * @return {Boolean}
		 */
		shouldBeVisible: function(name){
            if (this.dependency[name] === undefined) return true;
            var dep = this.dependency[name],
                value = this.fields[dep.element].getValue();
            if (dep.not_empty !== undefined) {
                return value !== undefined && value !== null && value.length > 0;
            }
            if (dep.value !== undefined) {
                return (dep.value instanceof Array) ? (dep.value.indexOf(value) != -1) : (value == dep.value);
            }
            return true;
		}
	});

	/**
	 * $nba.Elist class: A popup with elements list to choose from. Behaves as a singleton.
	 * Boundable events: beforeShow, afterShow, beforeHide, afterHide, select
	 * @constructor
	 */
	$nba.ShortcodeList = function(){
		if ($nba.shortcodelist !== undefined) return $nba.shortcodelist;
		this.$container = $('.nba-shortcode-list');
		if (this.$container.length > 0) this.init();
	};
	$.extend($nba.ShortcodeList.prototype, $nba.mixins.Events, {
		init: function(){
			this.$closer = this.$container.find('.nba-shortcode-list-closer');
			this.$list = this.$container.find('.nba-shortcode-list-list');
			this._events = {
				select: function(event){
					var $item = $(event.target).closest('.nba-shortcode-list-item');
					this.hide();
					this.trigger('select', [$item.data('name')]);
				}.bind(this),
				hide: this.hide.bind(this)
			};
			this.$closer.on('click', this._events.hide);
			this.$list.on('click', '.nba-shortcode-list-item', this._events.select);
		},
		show: function(){
			if (this.$container.length == 0) {
				// Loading elements list html via ajax
				$.ajax({
					type: 'post',
					url: $nba.ajaxUrl,
					data: {
						action: 'nba_get_shortcode_list_html'
					},
					success: function(html){
						this.$container = $(html).css('display', 'none').appendTo($(document.body));
						this.init();
						this.show();
					}.bind(this),
                    error: function(xhr, textStatus, errorThrown) {
                        console.log(errorThrown);
                    },
				});
				return;
			}

			this.trigger('beforeShow');
			this.$container.css('display', 'block');
			this.trigger('afterShow');
		},
		hide: function(){
			this.trigger('beforeHide');
			this.$container.css('display', 'none');
			this.trigger('afterHide');
		},
		load: function(){
            if (this.$container.length == 0) {
                // Loading elements list html via ajax
                $.ajax({
                    type: 'post',
                    url: $nba.ajaxUrl,
                    data: {
                        action: 'nba_get_shortcode_list_html'
                    },
                    success: function(html){
                        this.$container = $(html).css('display', 'none').appendTo($(document.body));
                        this.init();

                        // Preload to save time
                        $nba.builder.load();
                    }.bind(this),
                    error: function(xhr, textStatus, errorThrown) {
                        console.log(errorThrown);
                    },
                });
                return;
            }
		}
	});
	// Singleton instance
	$nba.shortcodelist = new $nba.ShortcodeList;

	// Preload to save time
	setTimeout( function() {
		$nba.shortcodelist.load();
	}, 10000);

	/**
	 * $nba.Builder class: A popup with loadable elements forms
	 * Boundable events: beforeShow, afterShow, beforeHide, afterHide, save
	 * @constructor
	 */
	$nba.Builder = function(){
		this.$container = $('.nba-builder');
		if (this.$container.length != 0) this.init();
	};
	$.extend($nba.Builder.prototype, $nba.mixins.Events, {
		init: function(){
			this.$title = this.$container.find('.nba-builder-title');
			this.titles = this.$title[0].onclick() || {};
			this.$title.removeAttr('onclick');
			this.$closer = this.$container.find('.nba-builder-closer, .nba-builder-btn.for_close');
			// Form containers and class instances
			this.$forms = {};
			this.forms = {};
			// Set of default values for each elements form
			this.defaults = {};
			this.$container.find('.nba-form').each(function(index, form){
				var $form = $(form).css('display', 'none'),
					name = $form.data('shortcode');
				this.$forms[name] = $form;
			}.bind(this));
			this.$btnSave = this.$container.find('.nba-builder-btn.for_save');
			// Active element
			this.active = false;
			this._events = {
				hide: this.hide.bind(this),
				save: this.save.bind(this)
			};
			this.$closer.on('click', this._events.hide);
			this.$btnSave.on('click', this._events.save);
		},
		/**
		 * Show element form for a specified element name and initial values
		 * @param {String} name
		 * @param {Object} values
		 */
		show: function(name, values){
			if (this.$container.length == 0) {
				// Loading builder and initial form's html
				$.ajax({
					type: 'post',
					url: $nba.ajaxUrl,
					data: {
						action: 'nba_get_builder_html'
					},
					success: function(html){
						if (html == '') return;
						html = $nba.fn.enqueueAssets(html);
						this.$container = $(html).css('display', 'none').appendTo($(document.body));
						this.init();
						this.show(name, values);
					}.bind(this),
                    error: function(xhr, textStatus, errorThrown) {
                        console.log(errorThrown);
                    },
				});
				return;
			}

			if (this.forms[name] === undefined) {
				// Initializing Form on the first show
				if (this.$forms[name] === undefined) return;
				this.forms[name] = new $nba.Form(this.$forms[name]);
				this.defaults[name] = this.forms[name].getValues();
			}
			// Filling missing values with defaults
			values = $.extend({}, this.defaults[name], values);
			//set value to form when edit shortcode.
			this.forms[name].setValues(values);
			if (this.forms[name].tabs !== undefined) this.forms[name].tabs.open(0);
			this.$forms[name].css('display', 'block');
			this.$title.html(this.titles[name] || '');
			this.active = name;
			this.trigger('beforeShow');
			this.$container.css('display', 'block');
			this.trigger('afterShow');
		},
		hide: function(){
			this.trigger('beforeHide');
			this.$container.css('display', 'none');
			if (this.$forms[this.active] !== undefined) this.$forms[this.active].css('display', 'none');
			this.trigger('afterHide');
		},
		load: function(){
            if (this.$container.length == 0) {
                // Loading builder and initial form's html
                $.ajax({
                    type: 'post',
                    url: $nba.ajaxUrl,
                    data: {
                        action: 'nba_get_builder_html'
                    },
                    success: function(html){

                        if (html == '') return;
                        html = $nba.fn.enqueueAssets(html);
                        this.$container = $(html).css('display', 'none').appendTo($(document.body));
                        this.init();
                    }.bind(this),
                    error: function(xhr, textStatus, errorThrown) {
                        console.log(errorThrown);
                    },
                });
                return;
            }
		},
		/**
		 * Get values of the active form
		 * @return {Object}
		 */
		getValues: function(){
			return (this.forms[this.active] !== undefined) ? this.forms[this.active].getValues() : {};
		},
		/**
		 * Get default values of the active form
		 * @return {Object}
		 */
		getDefaults: function(){
			return (this.defaults[this.active] || {});
		},
		save: function(){
			var forms = $('.nba-builder').find('.nba-form');
			var formActive = this.active;
            var paramsChildRemove = [];
            var formValues = {};
            forms.each(function(findex, fobj) {
                var curForm = $(fobj);
                var curFormShortCode = curForm.data('shortcode');
                if(curFormShortCode === formActive) {
                    var container = curForm;
                    var control = container.find('.nba-form-control');

                    control.each(function(cindex, cobj) {
                        var curControl = $(cobj);
                        var name = curControl.data('param_name');
                        var type = curControl.data('param_type');
                        if(type == 'param_group') {
                            formValues[name] = "";
                            curControl.each(function(gindex, gobj) {
                                var curGroupObj = $(gobj);
                                var row = curGroupObj.find('.nba_param');
                                var paramGroupValue = [];
                                if(row.length < 1) {
                                    paramGroupValue = [{}];
                                } else {
                                    row.each(function (rindex, robj) {
                                        var curRowObj = $(robj);
                                        paramGroupValue[rindex] = {};
                                        var items = curRowObj.find('.nba-form-control');
                                        items.each(function (iidex, iobj) {
                                            var curItem = $(iobj);
                                            var itemName = curItem.data('param_name');
                                            var itemValue = curItem.find('input[name], select[name], textarea[name]').val();
                                            if (itemValue !== '')
                                                paramGroupValue[rindex][itemName] = itemValue;
                                            if ($.inArray(itemName, paramsChildRemove) == -1)
                                                paramsChildRemove.push(itemName);
                                        });
                                    });
                                }
                                formValues[name] = encodeURIComponent(json_encode(paramGroupValue));
                            });
                        } else {
                            formValues[name] = curControl.find('input[name="'+name+'"], select[name="'+name+'"], textarea[name="'+name+'"]').val();
                        }
                    });
                }
            });
            Object.keys(formValues).forEach(function(key) {
                if($.inArray(key, paramsChildRemove) !== -1)
                    delete formValues[key];
            });
            this.hide();
			this.trigger('save', [formValues, this.getDefaults()]);
		}
	});
	// Singletone instance
	$nba.builder = new $nba.Builder;

}(jQuery);

// Helper functions
!function($){
	if ($nba.fn === undefined) $nba.fn = {};
	/**
	 * Retrieve all attributes from the shortcodes tag. (WordPress-function js analog).
	 * @param text
	 * @return {Array} List of attributes and their value
	 */
	$nba.fn.shortcodeParseAtts = function(text){
		// Fixing tinymce transformations
		text = text.replace(/\<br \/\> /g, "\n");
		var atts = {};
		text.replace(/([a-z0-9_\-]+)=\"([^\"\]]*)"/g, function(m, key, value){
			atts[key] = value;
		});
		return atts;
	};
	/**
	 * Generate shortcode string
	 * @param {String} name Shortcode name
	 * @param {{}} atts
	 * @param {{}} attsDefaults
	 * @return {String}
	 */
	$nba.fn.generateShortcode = function(name, atts, attsDefaults){
		var shortcode = '[' + name,
			htmlContent = ($nba.elements[name] && $nba.elements[name].params.content && $nba.elements[name].params.content.type == 'html');
		atts = atts || {};
		attsDefaults = attsDefaults || {};
		$.each(atts, function(att, value){
			if (htmlContent && att == 'content') return;
			if (attsDefaults[att] !== undefined && attsDefaults[att] !== value) shortcode += ' ' + att + '="' + value + '"';
		});
		shortcode += ']';
		if (htmlContent) shortcode += (atts.content || '') + '[/' + name + ']';
		return shortcode;
	};
	/**
	 * Handle "nootheme" action within a plain text and determine what will be the new selection and the way it should
	 * be handled (insert / edit)
	 *
	 * @param {String} html Initial html text with shortcodes
	 * @param {Number} startOffset Selection start offset
	 * @param {Number} endOffset
	 * @return {{}} action, new selection, shortcode data (if found)
	 */
	$nba.fn.handleShortcodeCall = function(html, startOffset, endOffset){
		var handler = {};
		if (typeof html != 'string') html = '';
		if (startOffset == -1) startOffset = 0;
		if (endOffset == -1) endOffset = startOffset;
		if (endOffset < startOffset) {
			// Swapping start and end positions
			endOffset = startOffset + (startOffset = endOffset) - endOffset;
		}
		// If user selected a shortcode or its part
		if (startOffset < endOffset && html[endOffset - 1] == ']') {
			endOffset--;
		}
		var prevOpen = html.lastIndexOf('[', endOffset - 1),
			prevClose = html.lastIndexOf(']', endOffset - 1),
			nextOpen = html.indexOf('[', endOffset),
			nextClose = html.indexOf(']', endOffset),
		// We may fall back to insert at any time, so creating a separate variable for this
			insertHandler = {
				action: 'insert',
				selection: [startOffset, endOffset]
			};
		// Checking out if we're inside of some tag at all
		if (prevOpen == -1 || nextClose == -1 || prevOpen < prevClose || (nextOpen != -1 && nextOpen < nextClose)) {
			return insertHandler;
		}
		// If we're still here, the cursor is inside of some shorcode, so in case of insertion, we'll insert right after it
		insertHandler.selection = [nextClose + 1, nextClose + 1];
		var isOpener = (html.charAt(prevOpen + 1) != '/'),
			editHandler = {
				action: 'edit',
				shortcode: html.substring(prevOpen + (isOpener ? 1 : 2), nextClose + 1).replace(/^([a-zA-Z0-9\-\_]+)[^\[]+/, '$1')
			};
		// Handling only known shortcodes
		if ($nba.elements[editHandler.shortcode] === undefined) return insertHandler;
		var nestingLevel = 1,
			regexp = new RegExp('\\[(\\/?)' + editHandler.shortcode.replace(/\-/g, '\\$&') + '((?=\\])| [^\\]]+)', 'ig'),
			matches;
		if (isOpener) {
			// Opening shortcode: searching forward
			editHandler.values = $nba.fn.shortcodeParseAtts(html.substring(prevOpen, nextClose + 1));
			regexp.lastIndex = nextClose;
			while (matches = regexp.exec(html)) {
				nestingLevel += (matches[1] ? -1 : 1);
				if (nestingLevel == 0) {
					// Found the relevant closer
					editHandler.selection = [prevOpen, html.indexOf(']', regexp.lastIndex - matches[0].length + 1) + 1];
					editHandler.values.content = html.substring(nextClose + 1, regexp.lastIndex - matches[0].length);
					break;
				}
			}
			if (nestingLevel != 0) {
				// No shortcode closer
				editHandler.selection = [prevOpen, nextClose + 1];
			}
		} else {
			// Closing shortcode: searching backward
			var nestingChange = [],
				matchesPos = [];
			while (matches = regexp.exec(html)) {
				if (regexp.lastIndex >= prevOpen) break;
				nestingChange.push(matches[1] ? 1 : -1);
				matchesPos.push(regexp.lastIndex - matches[0].length);
			}
			for (var i = nestingChange.length - 1; i >= 0; i--) {
				nestingLevel += nestingChange[i];
				if (nestingLevel == 0) {
					var openerClose = html.indexOf(']', matchesPos[i]);
					editHandler.selection = [matchesPos[i], nextClose + 1];
					editHandler.values = $nba.fn.shortcodeParseAtts(html.substring(matchesPos[i], openerClose));

					editHandler.values.content = html.substring(openerClose + 1, prevOpen);
					break;
				}
			}
			if (nestingLevel != 0) {
				// Closing shortcode with no opening one: inserting right after it
				return insertHandler;
			}
		}

		return editHandler;
	};
	/**
	 * Parse ajax HTML, insert the needed assets and filter html from them
	 * @param {String} html
	 * @returns {String}
	 * TODO Rework this function to properly handle load-scripts.php
	 */
	$nba.fn.enqueueAssets = function(html){
		var regexp = /(\<link rel=\'stylesheet\' id=\'([^\']+)\'[^\>]+?\>)|(\<style type\=\"text\/css\"\>([^\<]*)\<\/style\>)|(\<script type=\'text\/javascript\' src=\'([^\']+)\'\><\/script\>)|(\<script type\=\'text\/javascript\'\>([^`]*?)\<\/script\>)/g;
		var $head = $(document.head),
			$internalStyles = $('style'),
			$externalScripts = $('script[src]'),
			$internalScripts = $('script:not([src])'),
			i;
		// Inserting only the assets that are not exist on a page yet
		return html.replace(regexp, function(m, m1, styleId, m2, styleContent, m3, scriptSrc, m4, scriptContent){
			if (m.indexOf('<link rel=\'stylesheet\'') == 0) {
				// External style
				if ($('link[rel="stylesheet"]#' + styleId).length != 0) return '';
			} else if (m.indexOf('<style') == 0) {
				// Internal style
				styleContent = styleContent.trim();
				for (i = 0; i < $internalStyles.length; i++) {
					if ($internalStyles[i].innerHTML.trim() == styleContent) return '';
				}
			} else if (m.indexOf('<script type=\'text/javascript\' src=\'') == 0) {
				// External script
				scriptSrc = scriptSrc.replace(/&_=[0-9]+/, '');
				for (i = 0; i < $externalScripts.length; i++) {
					if ($externalScripts[i].src.indexOf(scriptSrc) === 0) return '';
				}
			} else {
				// Internal script
				scriptContent = scriptContent.trim();
				for (i = 0; i < $internalScripts.length; i++) {
					if ($internalScripts[i].innerHTML.trim() == scriptContent) return '';
				}
			}
			$(m).appendTo($head);
			return '';
		});
	};

    $nba.fn.rawurldecode = function(str) {
        return decodeURIComponent(str + '');
    };
    $nba.fn.rawurlencode = function(str) {
        str = (str + '').toString();
        return encodeURIComponent(str).replace(/!/g, '%21').replace(/'/g, '%27').replace(/\(/g, '%28').replace(/\)/g, '%29').replace(/\*/g, '%2A');
    };
    $nba.fn.utf8_decode = function(str_data) {
        var tmp_arr = [],
            i = 0,
            ac = 0,
            c1 = 0,
            c2 = 0,
            c3 = 0;
        str_data += '';
        while (i < str_data.length) {
            c1 = str_data.charCodeAt(i);
            if (c1 < 128) {
                tmp_arr[ac++] = String.fromCharCode(c1);
                i++;
            } else if (c1 > 191 && c1 < 224) {
                c2 = str_data.charCodeAt(i + 1);
                tmp_arr[ac++] = String.fromCharCode(((c1 & 31) << 6) | (c2 & 63));
                i += 2;
            } else {
                c2 = str_data.charCodeAt(i + 1);
                c3 = str_data.charCodeAt(i + 2);
                tmp_arr[ac++] = String.fromCharCode(((c1 & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
                i += 3;
            }
        }
        return tmp_arr.join('');
    };
    $nba.fn.utf8_encode = function(argString) {
        if (argString === null || typeof argString === "undefined") {
            return "";
        }
        var string = (argString + '');
        var utftext = "",
            start, end, stringl = 0;
        start = end = 0;
        stringl = string.length;
        for (var n = 0; n < stringl; n++) {
            var c1 = string.charCodeAt(n);
            var enc = null;
            if (c1 < 128) {
                end++;
            } else if (c1 > 127 && c1 < 2048) {
                enc = String.fromCharCode((c1 >> 6) | 192) + String.fromCharCode((c1 & 63) | 128);
            } else {
                enc = String.fromCharCode((c1 >> 12) | 224) + String.fromCharCode(((c1 >> 6) & 63) | 128) + String.fromCharCode((c1 & 63) | 128);
            }
            if (enc !== null) {
                if (end > start) {
                    utftext += string.slice(start, end);
                }
                utftext += enc;
                start = end = n + 1;
            }
        }
        if (end > start) {
            utftext += string.slice(start, stringl);
        }
        return utftext;
    };
    $nba.fn.base64_decode = function(data) {
        var b64 = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";
        var o1, o2, o3, h1, h2, h3, h4, bits, i = 0,
            ac = 0,
            dec = "",
            tmp_arr = [];
        if (!data) {
            return data;
        }
        data += '';
        do {
            h1 = b64.indexOf(data.charAt(i++));
            h2 = b64.indexOf(data.charAt(i++));
            h3 = b64.indexOf(data.charAt(i++));
            h4 = b64.indexOf(data.charAt(i++));
            bits = h1 << 18 | h2 << 12 | h3 << 6 | h4;
            o1 = bits >> 16 & 0xff;
            o2 = bits >> 8 & 0xff;
            o3 = bits & 0xff;
            if (h3 == 64) {
                tmp_arr[ac++] = String.fromCharCode(o1);
            } else if (h4 == 64) {
                tmp_arr[ac++] = String.fromCharCode(o1, o2);
            } else {
                tmp_arr[ac++] = String.fromCharCode(o1, o2, o3);
            }
        } while (i < data.length);
        dec = tmp_arr.join('');
        dec = $nba.fn.utf8_decode(dec);
        return dec;
    };
    $nba.fn.base64_encode = function(data) {
        var b64 = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";
        var o1, o2, o3, h1, h2, h3, h4, bits, i = 0,
            ac = 0,
            enc = "",
            tmp_arr = [];
        if (!data) {
            return data;
        }
        data = $nba.fn.utf8_encode(data + '');
        do {
            o1 = data.charCodeAt(i++);
            o2 = data.charCodeAt(i++);
            o3 = data.charCodeAt(i++);
            bits = o1 << 16 | o2 << 8 | o3;
            h1 = bits >> 18 & 0x3f;
            h2 = bits >> 12 & 0x3f;
            h3 = bits >> 6 & 0x3f;
            h4 = bits & 0x3f;
            tmp_arr[ac++] = b64.charAt(h1) + b64.charAt(h2) + b64.charAt(h3) + b64.charAt(h4);
        } while (i < data.length);
        enc = tmp_arr.join('');
        var r = data.length % 3;
        return (r ? enc.slice(0, r - 3) : enc) + '==='.slice(r || 3);
    };
}(jQuery);
