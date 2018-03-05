/**
* Plugin: jQuery AJAX-ZOOM, jquery.axZm.expButton.js
* Copyright: Copyright (c) 2010-2017 Vadim Jacobi
* License Agreement: http://www.ajax-zoom.com/index.php?cid=download
* Extension Version: 2.3
* Extension Date: 2017-08-09
* URL: http://www.ajax-zoom.com
* Documentation: http://www.ajax-zoom.com/index.php?cid=docs
*/

;(function($) {

	$.axZmEb = function(opt) {

		var def = {
			title: null, // title of the button, can be omited - opens instantly in this case. 
			descr: null, // description when opened, can be omited - does not open then. Shortcuts - iframe:scr and ajax:url
			gravity: 'top', // possible values: topLeft, top, topRight, bottomLeft, bottom, bottomRight, center
			iframeHeader: false,
			marginX: 5, // horizontal margin depending on gravity
			marginY: 5, // vertical margin depending on gravity
			openSpeed: 300, // duration of open animation in ms
			closeSpeed: 300, // duration of close animation in ms
			fadeInSpeed: 200, // fadein duration of the button
			autoOpen: false, // button opens instantly; if no tilte but descr is defined, autoOpen executes instantly
			removeOnClose: false, // removes button when extended state is closed
			zoomSpinPanRemove: false, // removes button / layer when there is some action inside AJAX-ZOOM
			classPref: 'axZmEb_', // prefix for the css classes, see jquery.axZm.buttonDescr.css
			arrow: true, // show arrow inside button indicating that it is expandable
			single: true, // closeses other instances instantly
			thumbSlider: true, // uses axZmThumbSlider content mode for overflow text (requires axZmThumbSlider JS and CSS files)
			tapHide: true, // temporary disables all other layers inside AJAX-ZOOM player
			dblClickClose: true, // closes expanded / opened state on double click
			par: '#axZm_zoomLayer', // layer to place the button
			parO: '#axZm_zoomLayer', // layer to attach when opened; if body it will be fullscreen
			// options passed to axZmThumbSlider when thumbSlider option is enabled
			// here thumbSlider is used to scroll long content (descr)

			dynText: true,
			dynTextBtn: [
				{'base': 0.016, 'min': 12, 'max': 24, 'important': true}
			],
			dynTextTitle: [
				{'base': 0.016, 'min': 18, 'max': 28, 'important': true}
			],
			dynTextDescr: [
				['*', {'base': 0.012, 'min': 12, 'max': 24, 'important': true}],
				['h3', {'base': 0.016, 'min': 16, 'max': 32, 'important': true}]
			],
			hideScrlBar: true,
			thumbSliderOpt: { 
				contentMode: true,
				centerNoScroll: false,
				outerWrapPosition: 'absolute',
				contentStyle: {background: 'none', padding: 0, paddingRight: 25},
				scrollbarTrackStyle: {background: 'none'},
				wrapStyle: {borderWidth: 0},
				btn: false,
				orientation: 'vertical',
				scrollbar: true // apply thumb slider
			},
			onCloseEnd: null, // callback on close
			onOpenEnd: null, // callback when button openes / expands
			onAjaxLoad: null // if descr is ajax call - the callback on success
		};

		var isObject = function(x) {
			return (typeof x === 'object') && !(x instanceof Array) && (x !== null);
		};

		var o = $.extend(true, {}, def, opt, window.axZmEbOpt || {}),
			classPref = o.classPref,
			overflow = {},
			overflowPar = {},
			top = '', 
			left = '', 
			bottom = '',
			right = '', 
			marginTop = '', 
			marginLeft = '',
			noTitle = false,
			ajx = false,
			mOverThis = 0,
			clM = {
				Wrap: classPref+'Wrap',
				InnerClick: classPref+'InnerClick',
				Inner: classPref+'Inner',
				Text: classPref+'Text',
				TextOpened: classPref+'TextOpened',
				Drop: classPref+'Drop',
				Drop_down: classPref+'Drop_down',
				Drop_up: classPref+'Drop_up',
				Descr: classPref+'Descr',
				DescrScroll: classPref+'DescrScroll',
				DescrIframe: classPref+(o.iframeHeader ? 'DescrIframe' : 'DescrIframeNoHeader'),
				DescrAjax: classPref+'DescrAjax',
				DescrNoTitle: classPref+'DescrNoTitle',
				WrapClose: classPref+'WrapClose',
				WrapClose_over: classPref+'WrapClose_over',
				WrapCloseIframe: classPref+'WrapCloseIframe',
				WrapCloseIframe_over: classPref+'WrapCloseIframe_over',
				Lock: classPref+'Lock'
			};

		if (o.title) {
			o.title = o.title.replace(/&#34;/g,'\"');
		}

		if (o.descr) {
			o.descr = o.descr.replace(/&#34;/g,'\"');
		}

		var _tButton;

		var round = function(a, b) {
			if (b) {
				var c = Math.pow(10, b); 
				return (round(a * c) / c);
			} else {
				a = (a + ((a > 0) ? 0.5 : -0.5)) >> 0;
				return a;
			}
		};

		var supportFixed = function() {
			var elem = document.createElement('div');
			elem.style.cssText = 'position:fixed';
			if (elem.style.position.match('fixed')) {
				return true;
			} else {
				return false;
			}
		};

		var closeOne = function(e) {
			if (e.keyCode == 27 && mOverThis) {
				$(document).unbind('keyup.axZmEb', closeOne);
				if (o.tapHide && $.axZm && $.axZm.fsi && ($('body').hasClass('axZmLock') || $('body').hasClass('az_fancybox'))) {
					$.fn.axZm.tapShow();
				}
				closeDescr();
			}
		};

		if (o.single) {
			var toRemove = $('.'+clM.Wrap);
			if (toRemove.length > 0) {
				toRemove.each(function() {
					var _this = $(this),
					_thisDataO = _this.data('overflow');
					if (!$.isEmptyObject(_thisDataO) && o.hideScrlBar) {
						$('body').removeClass(Lock);
					}
					_this.remove();
				});
			}
		}

		var onZoomSpinPanOnce = function() {
			if (!_tButton) {
				return;
			}
			$('.'+clM.Wrap, o.par).remove();
			$('.'+clM.Wrap, o.parO).remove();

			if (typeof o.zoomSpinPanRemove == 'string') {
				if (o.zoomSpinPanRemove.indexOf('#') || o.zoomSpinPanRemove.indexOf('.')) {
					try {
						$('li', $(o.zoomSpinPanRemove)).removeClass('selected');
					}
					catch(err) {}
				} else {
					$('li', $('#'+o.zoomSpinPanRemove)).removeClass('selected');
				}
			}
			_tButton = null;
		};

		if (o.zoomSpinPanRemove && $.axZm) {
			$.fn.axZm.addCallback('onZoomSpinPanOnce', onZoomSpinPanOnce);
		}

		if (!o.title && o.descr) {
			o.title = " ";
			o.autoOpen = true;
			o.removeOnClose = true;
			noTitle = true;
		} else if (!o.title) {
			return false;
		}

		if (o.autoOpen) {
			o.fadeInSpeed = 0;
		}

		var grav = o.gravity;

		if (typeof grav == 'string') {
			grav = grav.toLowerCase();
		}

		switch (grav) {
			case 'topleft':
				left = o.marginX;
				top = o.marginY;
				break;
			case 'top':
				left = '50%';
				top = o.marginY;
				break;
			case 'topright':
				right = o.marginX;
				top = o.marginY;
				break;
			case 'bottomright':
				right = o.marginX;
				bottom = o.marginY;
				break;
			case 'bottom':
				left = '50%';
				bottom = o.marginY;
				break;
			case 'bottomleft':
				left = o.marginX;
				bottom = o.marginY;
				break;
			case 'center':
				top = '50%';
				left = '50%';
				break;
		}

		if ($.isFunction(grav)) {
			grav = grav();
		} else {
			if (/(bottom)/gm.test(o.gravity)) {
				clM.Drop_down = clM.Drop_up;
			}
		}

		if (isObject(grav) && grav.left != 'undefined' && grav.top != 'undefined') {
			top = grav.top;
			left = grav.left;
		}

		if (o.parO == 'body' || o.parO == 'window') {
			o.parO = 'body';

			overflow = {
				x: $('body').css('overflowX'),
				y: $('body').css('overflowY')
			};

			var sF = supportFixed();

			if (sF) {
				overflowPar = {position: 'fixed'};
			} else {
				overflowPar = {top: true};
			}

			if (o.par == 'body') {
				o.par = 'body';
				o.removeOnClose = true;
				o.autoOpen = true;
			}
		}

		var _Text = $('<div />').addClass(clM.Text).html(o.title);
		var _Inner = $('<div />').addClass(clM.Inner)
			.append(_Text);

		if (!o.arrow) {
			_Text.addClass(classPref+'Text_no_arrow');
		}

		if (grav != 'top' && grav != 'bottom' && grav != 'center' && !isObject(grav)) {
			_Inner.addClass(classPref+'InnerCorner');
		}

		// Add button
		_tButton = $('<div />')
		.addClass(clM.Wrap)
		.data('overflow', overflow)
		.append(_Inner)
		.css({
			'opacity': 0,
			'top': top,
			'right': right,
			'bottom': bottom,
			'left': left
		})
		.appendTo(o.par)
		.animate({
			opacity: 1
			}, {
				duration: o.fadeInSpeed,
				complete: function() {
					$(this).css('opacity', '')
				}
		});

		if (o.par == '#axZm_zoomLayer') {
			$(o.par)
			.axZmEbResize(function() {
				addDynFontSize();
			});
		}

		_tButton.data('axZmEb', {});

		var closeDescr = function(event, cclb) {
			if (event) {
				event.preventDefault();
				event.stopPropagation();
			}

			if ($.axZm && o.tapHide) {
				$.fn.axZm.tapShow();
			}
			$(document).unbind('keyup.axZmEb', closeOne);
			mOverThis = 0;
			if (!_tButton.length) {
				return;
			}

			if (o.par != o.parO) {
				_tButton.appendTo(o.par).css('position', 'absolute');
			}
			_Text.removeClass(clM.TextOpened);

			$('[class^='+clM.WrapClose+']', _tButton).remove();
			$('.'+clM.Descr, _tButton).fadeOut(o.closeSpeed/2, function() {
				$(this).remove();
			});
			if (!noTitle && o.arrow) {
				$('.'+clM.Drop, _tButton).css('display', '').removeClass(clM.Drop_down);
			}

			var d = _tButton.data();

			var anmCss = {
				width: d.w,
				height: d.h
			};

			if (top) {anmCss.top = top;}
			if (right) {anmCss.right = right;}
			if (bottom) {anmCss.bottom = bottom;}
			if (left) {anmCss.left = left;}

			_tButton.animate(anmCss, {
				duration: o.closeSpeed
			});

			var anmBkP = {
				width: d.w1,
				height: d.h1,
				left: d.l,
				paddingTop: d.pT,
				paddingRight: d.pR, 
				paddingBottom: d.pB, 
				paddingLeft: d.pL,
				borderTopLeftRadius: d.bRa,
				borderTopRightRadius: d.bRa,
				borderBottomLeftRadius: d.bRa,
				borderBottomRightRadius: d.bRa
			};

			if (o.removeOnClose) {
				anmBkP.opacity = 0.05;
			}

			$('div:eq(0)', _tButton)
			//.css('overflowY', 'hidden')
			.animate(anmBkP, {
				duration: o.closeSpeed,
				complete: function() {
					$(this).removeAttr('style');
					_tButton.css({
						width: '',
						height: '',
						'top': top,
						'right': right,
						'bottom': bottom,
						'left': left,
						'zIndex': d.zI
					});

					if (o.removeOnClose) {
						_tButton.axZmRemove();
					}

					if (!$.isEmptyObject(overflow) && o.hideScrlBar) {
						$('body').removeClass(Lock);
					}

					if (!noTitle && o.arrow) { // IE < 9
						$('.'+clM.Drop, _tButton).css('display', '').removeClass(clM.Drop_down);
					}

					return cclb ? cclb() : null;
				}
			});

			return false;
		};

		var addDynFontSize = function() {
			if (!o.dynText || !_tButton || !_tButton.length) {
				return;
			}

			var head = document.head || document.getElementsByTagName('head')[0];

			if (head) {
				$('head>#axZmEb_dynFontSize').remove();
			} else {
				$('body>#axZmEb_dynFontSize').remove();
			}

			var tw = parseInt($(o.parO).innerWidth());
			var newCss = '<style id="axZmEb_dynFontSize">';

			if (o.dynTextBtn && isObject(o.dynTextBtn[0])) {
				var ttlCss = o.dynTextBtn[0];
				if (ttlCss.base && ttlCss.min && ttlCss.max) {
					newCss += !ttlCss ? '' : '.'+classPref+'Text.size-dynFontSize {font-size: '+round(Math.min(ttlCss.max, Math.max(ttlCss.min, tw * ttlCss.base)),1)+'px'+(ttlCss.important ? ' !important' : '')+';} ';
				}
			}

			if (o.dynTextTitle && isObject(o.dynTextTitle[0])) {
				var ttlCss = o.dynTextTitle[0];
				if (ttlCss.base && ttlCss.min && ttlCss.max) {
					newCss += !ttlCss ? '' : '.'+classPref+'TextOpened.size-dynFontSize {font-size: '+round(Math.min(ttlCss.max, Math.max(ttlCss.min, tw * ttlCss.base)),1)+'px'+(ttlCss.important ? ' !important' : '')+';} ';
				}
			}

			if (o.dynTextDescr && $.isArray(o.dynTextDescr[0])) {
				$.each(o.dynTextDescr, function(k, v) {
					if ($.isArray(v)) {
						var prop = v[0];
						var val = v[1];
						if (typeof prop == 'string' && isObject(val) && val.base && val.min && val.max) {
							newCss += '.'+classPref+'Descr.size-dynFontSize '+prop+'{font-size: '+round(Math.min(val.max, Math.max(val.min, tw * val.base)),1)+'px'+(val.important ? ' !important' : '')+';} ';
						}
					}
				});
			}

			newCss += '</style>';

			if (head) {
				$(newCss).appendTo('head');
			} else {
				$(newCss).appendTo('body');
			}

			$('.'+clM.TextOpened+',.'+clM.Descr+',.'+clM.Text, o.parO).addClass('size-dynFontSize');
		};

		if (o.descr) {

			if (!noTitle && o.arrow) {
				$('<div />').addClass(clM.Drop).prependTo(_Text);
			} 

			$('.'+clM.Inner, _tButton)
			.addClass(clM.InnerClick)
			.bind('mousedown', function(e) {
				e.stopPropagation();
			})
			.bind('mouseover', function() {
				if (!noTitle && o.arrow) {
					$('.'+clM.Drop, _tButton).addClass(clM.Drop_down);
				}
			})
			.bind('mouseout', function() {
				if (!noTitle && o.arrow) {
					$('.'+clM.Drop, _tButton).removeClass(clM.Drop_down);
				}
			})
			.bind('mouseenter', function() {
				mOverThis = 1;
			})
			.bind('mouseleave', function() {
				mOverThis = 0;
			})
			.bind('click', function(e) {
				e.stopPropagation();
				// Expand
				if (_tButton.css('zIndex') < 10) {

					if ($.axZm && o.tapHide) {
						$.fn.axZm.tapHide([clM.Wrap]);
					}
					var _bC = $('div:eq(0)',_tButton);
					var isIframe = false; 

					if (!_tButton.data('w')) {
						_tButton.data({
							w: _tButton.width(), 
							h: _tButton.height(), 
							l: _bC.css('left'),
							w1: _bC.width(), 
							h1: _bC.height(), 
							zI: _tButton.css('zIndex'), 
							pT: _bC.css('paddingTop'), 
							pR: _bC.css('paddingRight'), 
							pB: _bC.css('paddingBottom'), 
							pL: _bC.css('paddingLeft'),
							bRa: _bC.css('borderTopLeftRadius')
						});
					}

					_Text.addClass(clM.TextOpened);
					$('.'+clM.Drop, _tButton).css('display', 'none');

					var anmCss = {
						height: '100%',
						width: '100%'
					};

					if (top) {anmCss.top = 0;}
					if (right) {anmCss.right = 0;}
					if (bottom) {anmCss.bottom = 0;}
					if (left) {anmCss.left = 0;}

					// fixed not supported
					if (overflowPar.top >= 0) {
						overflowPar.top = $(window).scrollTop()
						if (anmCss.top >= 0) {
							anmCss.top = overflowPar.top;
						} else {
							anmCss.bottom = -overflowPar.top;
						}
					}

					// fixed
					if (o.parO == 'body' && o.par != 'body') {

						var ofs = _tButton.offset();
						var scrT = $(window).scrollTop();
						var scrL = $(window).scrollLeft();

						if (!overflowPar.position) {
							scrT = 0;
							scrL = 0;
						}

						if (top) {_tButton.css('top', ofs.top - scrT)}
						if (right) {_tButton.css('right', $(window).width() - ofs.left + scrL - _tButton.outerWidth())}
						if (bottom) {_tButton.css('bottom', $(window).height() - ofs.top + scrT - _tButton.outerHeight())}
						if (left) {_tButton.css('left', ofs.left - scrL)}
					}

					if (o.parO == 'body' && o.hideScrlBar) {
						$('body').addClass(Lock);
						_tButton.appendTo('body');
					}

					if (overflowPar.position) {
						_tButton.css('position', overflowPar.position)
					}

					//o.descr = tDescr.replace(/\n/g, "<br />")
					o.descr.replace(/\\"/g, '"');

					// Iframe shortcut
					if (o.descr.indexOf('iframe:') == 0) {
						o.descr = o.descr.replace('iframe:', '');
						o.descr = "<iframe src='"+o.descr+"' allowfullscreen></iframe>";
					}

					// AJAX
					if (o.descr.indexOf('ajax:') == 0) {
						o.descr = o.descr.replace('ajax:', '');
						_descrContent = $('<div class="'+clM.Descr+'"><div class="'+classPref+'DescrInner" style="width: 100%; height: 100%; position: relative;"></div></div>')
						.addClass(clM.DescrAjax);
						ajx = true;
						$.ajax({
							url: o.descr,
							type: 'GET',
							cache: false,
							error: function() {
								$('.'+classPref+'DescrInner', _descrContent)
								.html('Error<br><br>AJAX request:<br><br>'+o.descr+'<br><br>could not be loaded')
								_descrContent.removeClass(clM.DescrAjax);
							},
							success: function(data) {
								$('.'+classPref+'DescrInner', _descrContent).html(data);
								_descrContent.removeClass(clM.DescrAjax);
								if ($.isFunction(o.onAjaxLoad)) {
									o.onAjaxLoad(data)
								}
							}
						});
					}

					if (!ajx) {
						var _descrContent = $('<div class="'+clM.Descr+'"><div class="'+classPref+'DescrInner" style="width: 100%; height: 100%; position: relative;">'+o.descr+'</div></div>');

						// check iframe
						var descrLen = _descrContent.children().length;

						if (descrLen == 1) {
							var _testIframe = $('iframe', _descrContent);
							if (_testIframe.length == 1) {
								isIframe = true;
								_descrContent.addClass(clM.DescrIframe);

								_testIframe
								.attr('frameborder', 0)
								.css({width: '100%', height: '100%'});
							}
						}

					}

					var _WrapClose = $('<div />').addClass(isIframe && !o.iframeHeader ? clM.WrapCloseIframe : clM.WrapClose)
					.bind('click', closeDescr)
					.bind('mouseover', function() {
						$(this).addClass(isIframe && !o.iframeHeader ? clM.WrapCloseIframe_over : clM.WrapClose_over)
					})
					.bind('mouseout', function() {
						$(this).removeClass(isIframe && !o.iframeHeader ? clM.WrapCloseIframe_over : clM.WrapClose_over)
					});

					if (noTitle) {
						_descrContent.addClass(clM.DescrNoTitle);
					}

					_bC
					.append(_descrContent)
					.append(_WrapClose)
					.css({
						left: 0,
						top: 0,
						height: '100%',
						width: '100%'
					})
					.animate(
						{'border-radius': 0, padding: 0},
						{duration: o.openSpeed}
					);

					_tButton
					.css({zIndex: 2147483647})
					.animate(anmCss,{
						duration: o.openSpeed,
						complete: function() {
							_bC.css({
								overflowY: 'auto',
								cursor: 'auto'
							});

							if (o.dblClickClose) {
								_bC.unbind('dblclick', closeDescr).bind('dblclick', closeDescr);
							}

							// Scroller ?
							if (!isIframe && o.thumbSlider && $.isFunction($.fn.axZmThumbSlider)) {
								_descrContent.axZmThumbSlider(o.thumbSliderOpt);
							} else if (!isIframe) {
								_descrContent.addClass(clM.DescrScroll)
								.mousewheel(function(event) {
									event.stopPropagation();
								});
							}

							if (o.parO != '#axZm_zoomLayer') {
								$('.'+classPref+'DescrInner', _descrContent)
								.axZmEbResize(function() {
									addDynFontSize();
								});
							} else {
								addDynFontSize();
							}
							if ($.isFunction(o.onOpenEnd)) {
								o.onOpenEnd(_tButton);
							}
						}
					});

					addDynFontSize();

					$(document).unbind('keyup.axZmEb', closeOne).bind('keyup.axZmEb', closeOne);
				}
			});

			addDynFontSize();

			if (o.autoOpen) {
				$('.'+clM.Inner, _tButton).trigger('click');
			}
		}

		_tButton.data('axZmEb', {
			close: function(a) {
				return closeDescr(null, a)
			}, 
			open: function() {
				$('.'+clM.Inner, _tButton).trigger('click')
			},
			remove: onZoomSpinPanOnce,
			addDynFontSize: addDynFontSize
		});

		return _tButton;
	};

	$.fn.axZmEb = function(opt, arg) {
		return this.each(function() {
			opt.par = $(this);
			if (!opt.parO) {
				opt.parO = $(this);
			}
			$.axZmEb(opt);
		});
	};

})(jQuery);


/*!
* Detect Element Resize
*
* https://github.com/sdecima/javascript-detect-element-resize
* Sebastian Decima
*
* version: 0.5.3
*/

(function ( $ ) {
	var attachEvent = document.attachEvent,
		stylesCreated = false,
		jQuery_resize = $.fn.axZmEbResize;

	$.fn.axZmEbResize = function(callback) {
		return this.each(function() {
			$('.axZmEb-resize-triggers', $(this)).remove();
			this.__resizeTriggers__ = null;
			if (this == window) {
				jQuery_resize.call($(this), callback);
			} else {
				axZmEbAddResizeListener(this, callback);
			}
		});
	}

	$.fn.axZmEbRemoveResize = function(callback) {
		return this.each(function() {
			axZmEbRemoveResizeListener(this, callback);
		});
	}

	if (!attachEvent) {
		var requestFrame = (function() {
			var raf = window.requestAnimationFrame 
			|| window.mozRequestAnimationFrame 
			|| window.webkitRequestAnimationFrame 
			|| function(fn) {
				return window.setTimeout(fn, 20);
			};

			return function(fn) {
				return raf(fn);
			};
		})();

		var cancelFrame = (function() {
			var cancel = 
			window.cancelAnimationFrame 
			|| window.mozCancelAnimationFrame 
			|| window.webkitCancelAnimationFrame 
			|| window.clearTimeout;
			return function(id) {
				return cancel(id);
			};
		})();

		function resetTriggers(element) {
			var triggers = element.__resizeTriggers__,
			expand = triggers.firstElementChild,
			contract = triggers.lastElementChild,
			expandChild = expand.firstElementChild;

			contract.scrollLeft = contract.scrollWidth;
			contract.scrollTop = contract.scrollHeight;
			expandChild.style.width = expand.offsetWidth + 1 + 'px';
			expandChild.style.height = expand.offsetHeight + 1 + 'px';
			expand.scrollLeft = expand.scrollWidth;
			expand.scrollTop = expand.scrollHeight;
		};

		function checkTriggers(element) {
			return element.offsetWidth != element.__resizeLast__.width ||
			element.offsetHeight != element.__resizeLast__.height;
		}

		function scrollListener(e) {
			var element = this;
			resetTriggers(this);
			if (this.__resizeRAF__) {
				cancelFrame(this.__resizeRAF__);
			}
			this.__resizeRAF__ = requestFrame(function() {
				if (checkTriggers(element)) {
					element.__resizeLast__.width = element.offsetWidth;
					element.__resizeLast__.height = element.offsetHeight;
					element.__resizeListeners__.forEach(function(fn) {
						fn.call(element, e);
					});
				}
			});
		};

		// Detect CSS Animations support to detect element display/re-attach 
		var animation = false,
			animationstring = 'animation',
			keyframeprefix = '',
			animationstartevent = 'animationstart',
			domPrefixes = 'Webkit Moz O ms'.split(' '),
			startEvents = 'webkitAnimationStart animationstart oAnimationStart MSAnimationStart'.split(' '),
			pfx = '';

		var elm = document.createElement('fakeelement');
		if (elm.style.animationName !== undefined) {
			animation = true;
		}

		if( animation === false ) {
			for( var i = 0; i < domPrefixes.length; i++ ) {
				if( elm.style[ domPrefixes[i] + 'AnimationName' ] !== undefined ) {
					pfx = domPrefixes[ i ];
					animationstring = pfx + 'Animation';
					keyframeprefix = '-' + pfx.toLowerCase() + '-';
					animationstartevent = startEvents[ i ];
					animation = true;
					break;
				}
			}
		}

		var animationName = 'axZmEb-resizeAnim';
		var animationKeyframes = '@' + keyframeprefix + 'keyframes ' + animationName + ' { from { opacity: 0; } to { opacity: 0; } } ';
		var animationStyle = keyframeprefix + 'animation: 1ms ' + animationName + '; ';
	}

	function createStyles() {
		if (!stylesCreated) {
			//opacity:0 works around a chrome bug https://code.google.com/p/chromium/issues/detail?id=286360
			var css = (animationKeyframes ? animationKeyframes : '') +
			'.axZmEb-resize-triggers { ' + (animationStyle ? animationStyle : '') + 
			'visibility: hidden; opacity: 0; } ' +
			'.axZmEb-resize-triggers, .axZmEb-resize-triggers > div, .axZmEb-contract-trigger:before { content: \" \"; display: block; position: absolute; top: 0; left: 0; height: 100%; width: 100%; overflow: hidden; } .axZmEb-resize-triggers > div { background: #eee; overflow: auto; } .axZmEb-contract-trigger:before { width: 200%; height: 200%; }',
			head = document.head || document.getElementsByTagName('head')[0],
			style = document.createElement('style');

			style.type = 'text/css';
			if (style.styleSheet) {
				style.styleSheet.cssText = css;
			} else {
				style.appendChild(document.createTextNode(css));
			}

			if (head) {
				head.appendChild(style);
			} else {
				var body = document.body || document.getElementsByTagName('body')[0];
				body.appendChild(style);
			}

			stylesCreated = true;
		}
	}

	var axZmEbAddResizeListener = function(element, fn) {
		if (attachEvent) {
			element.attachEvent('onresize', fn);
		} else {
			if (!element.__resizeTriggers__) {
				if (getComputedStyle(element).position == 'static') {
					element.style.position = 'relative';
				}
				createStyles();
				element.__resizeLast__ = {};
				element.__resizeListeners__ = [];
				(element.__resizeTriggers__ = document.createElement('div')).className = 'axZmEb-resize-triggers';
				element.__resizeTriggers__.innerHTML = '<div class="axZmEb-expand-trigger"><div></div></div>' + 
				'<div class="axZmEb-contract-trigger"></div>';
				element.appendChild(element.__resizeTriggers__);
				resetTriggers(element);
				element.addEventListener('scroll', scrollListener, true);

				// Listen for a css animation to detect element display/re-attach 
				animationstartevent && element.__resizeTriggers__.addEventListener(animationstartevent, function(e) {
					if(e.animationName == animationName) {
						resetTriggers(element);
					}
				});
			}
			element.__resizeListeners__.push(fn);
		}
	};

	var axZmEbRemoveResizeListener = function(element, fn) {
		if (attachEvent) {
			element.detachEvent('onresize', fn);
		} else {
			element.__resizeListeners__.splice(element.__resizeListeners__.indexOf(fn), 1);
			if (!element.__resizeListeners__.length) {
				element.removeEventListener('scroll', scrollListener);
				element.__resizeTriggers__ = !element.removeChild(element.__resizeTriggers__);
			}
		}
	}
}( jQuery ));
