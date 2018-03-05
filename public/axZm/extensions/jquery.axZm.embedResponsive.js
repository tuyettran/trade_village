/**
* Plugin: jQuery AJAX-ZOOM, jquery.axZm.embedResponsive.js
* Copyright: Copyright (c) 2010-2017 Vadim Jacobi
* License Agreement: http://www.ajax-zoom.com/index.php?cid=download
* Extension Version: 1.0
* Extension Date: 2017-08-15
* URL: http://www.ajax-zoom.com
* Documentation: http://www.ajax-zoom.com/index.php?cid=docs
*/

;(function($){
	$.fn.axZmEmbedResponsive = function(opt) {

		var makeid = function() {
			var t = '';
			var p = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
			var l = p.length;
			for (var i = 0; i < 32; i++) {
				t += p.charAt(Math.floor(Math.random() * l));
			}
			return t;
		};

		var def = {
			ratio: false, //  e.g. 16:9
			prc: 100, // defines padding bottom
			heightLimit: 90, // limit from window browser height
			maxWidthArr: [/*{
				maxWidth: 768,
				orientaion: 'landscape', // portrait or landscape or false
				ratio: false,
				prc: 50,
				heightLimit: 40
			}*/]
		};

		return this.each(function() {
			var _this = $(this);
			var prc;
			var heightLimit;
			var ratio;
			var o = {};

			var thisId = _this.attr('data-azErMh');
			if (!thisId) {
				thisId = makeid() + (new Date()).getTime();
				_this.attr('data-azErMh', thisId);
			}

			var destroy = function() {
				$(window).unbind('resize.'+thisId+' orientationchange.'+thisId);
			};

			if (!$.isPlainObject(opt)) {
				if (opt == 'destroy') {
					destroy();
					return;
				}
				console.log('azEmbedResponsiveMaxHeight: options object is not passed');
				return;
			} else {
				o = $.extend(true, {}, def, opt);
			}

			var calcPar = function() {
				var ref = o;
				if (o.maxWidthArr && o.maxWidthArr.length) {
					$.each(o.maxWidthArr, function(k, obj) {
						if (window.innerWidth <= parseInt(obj.maxWidth)) {
							var ort = obj.orintation;
							if (ort) {
								if (ort == 'landscape' && window.innerWidth > window.innerHeight) {
									ref = obj;
									return false;
								} else if (ort == 'portrait' && window.innerWidth < window.innerHeight) {
									ref = obj;
									return false;
								}
							} else {
								ref = obj;
								return false;
							}
						}
					});
				}

				ratio = ref.ratio;
				if (typeof ratio == 'string') {
					var spl = ratio.split(':');
					if (spl[0] && spl[1]) {
						prc = parseFloat(spl[1]) / parseFloat(spl[0]) * 100;
					}
				}

				if (!prc) {
					prc = parseFloat(ref.prc);
				}

				heightLimit = parseFloat(ref.heightLimit);
				if (heightLimit <= 1) {
					heightLimit *= 100;
				}

				if (prc <= 2) {
					prc *= 100;
				}
			};

			calcPar();

			var adjustHeight = function(e) {
				if (!_this.length) {
					destroy();
					return;
				}

				if (!e && $('#zFsO', _this).length) {
					$.fn.axZm.resizeStart(0);
				} else {
					if (o.maxWidthArr && o.maxWidthArr.length) {
						calcPar();
					}
				}

				_this.css('paddingBottom', prc+'%');
				var winH = $(window).height();
				var ww = _this.width();
				var hh = _this.children().first().height();
				var hr = hh / winH;
				if (hr * 100 > heightLimit) {
					var px = winH * (heightLimit / 100);
					_this.css('paddingBottom', px + 'px');
				}
			};

			adjustHeight();

			destroy();
			$(window).bind('resize.'+thisId+' orientationchange.'+thisId, adjustHeight);
		});
	};
})(jQuery);
