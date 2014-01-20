/*
 * jQuery Cookie Plugin v1.3.1
 * https://github.com/carhartl/jquery-cookie
 *
 * Copyright 2013 Klaus Hartl
 * Released under the MIT license
 */
(function (factory) {
	if (typeof define === 'function' && define.amd) {
		// AMD. Register as anonymous module.
		define(['jquery'], factory);
	} else {
		// Browser globals.
		factory(jQuery);
	}
}(function ($) {

	var pluses = /\+/g;

	function raw(s) {
		return s;
	}

	function decoded(s) {
		return decodeURIComponent(s.replace(pluses, ' '));
	}

	function converted(s) {
		if (s.indexOf('"') === 0) {
			// This is a quoted cookie as according to RFC2068, unescape
			s = s.slice(1, -1).replace(/\\"/g, '"').replace(/\\\\/g, '\\');
		}
		try {
			return config.json ? JSON.parse(s) : s;
		} catch(er) {}
	}

	var config = $.cookie = function (key, value, options) {

		// write
		if (value !== undefined) {
			options = $.extend({}, config.defaults, options);

			if (typeof options.expires === 'number') {
				var days = options.expires, t = options.expires = new Date();
				t.setDate(t.getDate() + days);
			}

			value = config.json ? JSON.stringify(value) : String(value);

			return (document.cookie = [
				config.raw ? key : encodeURIComponent(key),
				'=',
				config.raw ? value : encodeURIComponent(value),
				options.expires ? '; expires=' + options.expires.toUTCString() : '', // use expires attribute, max-age is not supported by IE
				options.path    ? '; path=' + options.path : '',
				options.domain  ? '; domain=' + options.domain : '',
				options.secure  ? '; secure' : ''
			].join(''));
		}

		// read
		var decode = config.raw ? raw : decoded;
		var cookies = document.cookie.split('; ');
		var result = key ? undefined : {};
		for (var i = 0, l = cookies.length; i < l; i++) {
			var parts = cookies[i].split('=');
			var name = decode(parts.shift());
			var cookie = decode(parts.join('='));

			if (key && key === name) {
				result = converted(cookie);
				break;
			}

			if (!key) {
				result[name] = converted(cookie);
			}
		}

		return result;
	};

	config.defaults = {};

	$.removeCookie = function (key, options) {
		if ($.cookie(key) !== undefined) {
			// Must not alter options, thus extending a fresh object...
			$.cookie(key, '', $.extend({}, options, { expires: -1 }));
			return true;
		}
		return false;
	};

}));


jQuery(document).ready(function($){
	var fireDisclaimer = function($){
		var that = this;//set this context to that when out of scope
		var body = $('body');
		this.disclaimerWrap = $('<div id="disclaimer-wrap"/>');
		disclaimerWrap.width = '625px';
		disclaimerWrap.height = '225px';
		this.disclaimerText = $('<h1 id="disclaimer-text">I AM OF\
								 LEGAL DRINKING<br/>AGE IN MY COUNTRY</h1>');
		this.disclaimerBtnWrap = $('<div id ="disc-btn-wrap"/>');
		this.disclaimerBtn = $('<button class="discBtn" id="agree-btn" \
							 type="button">ENTER</button>');
		this.exitBtn = $('<button class="discBtn" id="exit-btn" type="button">\
					   EXIT</button>');
		this.legalText = $('<h4 class="legal-text">BY CLICKING THE BUTTON YOU\
							AGREE TO <a href="#">THE TERMS AND CONDITIONS</a>.\
							</h4><h4 class="legal-text">READ THE <a href="#">\
							VODKA.COM RESPONSIBILITY STATEMENT</a>.</h4>');
		this.overlay = $('<div id="disclaimer-overlay"/>');
		this.overlayBox = $('<div id="overlay-box"/>');
		
		this.styleDisclaimer = function(){
			var discWrapWidth = 55 + $('#agree-btn').outerWidth() + $('#exit-btn').outerWidth();
			$('#disclaimer-text').css({
				color:'#fff',
				fontSize:'26px',
				textAlign:'center',
				margin:'15px'
			});

			$('.legal-text').css({
				color:'#fff',
				fontSize:'12px',
				textAlign:'center',
				margin: '5px'
			});

			$('#disc-btn-wrap').css({
				margin:'20px auto 20px auto',
				width: discWrapWidth + 'px'
			});

			$('.discBtn').css({
				color: '#fff',
				padding: '4px 15px',
				background: '-moz-linear-gradient(\
					top,#ffffff 0%,#000000 0%,#4a4a4a 44%,\
					#000000 92%,#000000)',
				background:'-webkit-gradient(\
					linear, left top, left bottom,from(#ffffff),\
					color-stop(0.0, #000000),color-stop(0.44, #4a4a4a),\
					color-stop(0.92, #000000),to(#000000))',
				border:'1px solid #9d9d9d'
			});
			$('.discBtn').css('background','-moz-linear-gradient(top,#ffffff 0%\
			,#000000 0%,#4a4a4a 44%,#000000 92%,#000000)');
			$('.discBtn').css('-webkit-box-shadow','0px 1px 3px rgba(000,000,000,0.5,\
			inset 0px 0px 3px rgba(255,255,255,1)');
			$('.discBtn').css('-moz-box-shadow','0px 1px 3px rgba(000,000,000,0.5,\
			inset 0px 0px 3px rgba(255,255,255,1)');
			$('.discBtn').css('box-shadow','0px 1px 3px rgba(000,000,000,0.5,\
			inset 0px 0px 3px rgba(255,255,255,1)');
			$('.discBtn').css('text-shadow','0px -1px 0px rgba(0,0,0,0.2),\
			0px 1px 0px rgba(163,163,163,1)');

			that.overlay.css({
				width:'100%',
				height:'100%',
				background:'url(' +window.templateDir + '/disclaimer_bg.png)',
				position:'absolute',
				top:'0',
				left:'0',
				zIndex:'999999'

			});

			that.disclaimerWrap.css({
				width: disclaimerWrap.width,
				height: disclaimerWrap.height,
				background:'#171717',
				border:'1px solid #fff',
				margin:'200px auto'
			});
		}

		this.showDisclaimer = function(body){
			body.append(that.overlay);
			that.disclaimerWrap.append(that.disclaimerText);
			that.disclaimerBtnWrap.append(that.disclaimerBtn);
			that.disclaimerBtnWrap.append(that.exitBtn);
			that.disclaimerWrap.append(that.disclaimerBtnWrap);
			that.disclaimerWrap.append(that.legalText);
			overlay.append(disclaimerWrap);
		}

		this.getWindowHeight= function(){
			var docDimensions = {};
			var docHeight = $(document).height();
			var docWidth = $(document).width();
			docDimensions.height = docHeight;
			docDimensions.width = docWidth;
			return docDimensions;
		}

		this.setCookie = function(){
			$.cookie('age_rest', 'confirmed', {path:'/'});
		}

		this.buttonListeners = function(){
			$('#agree-btn').click(function(){
				that.setCookie();
				$('#disclaimer-overlay').animate({
					opacity:'0'
				}, 1000);

				$('#disclaimer-wrap').animate({
					opacity:'0'
				}, 2000, function(){
					$('#disclaimer-overlay').remove();
					$('#disclaimer-wrap').remove();
					}
				);
			});
			$('#exit-btn').click(function(){
				 history.back();
            	return false;
			});

		}

		this.showDisclaimer(body);
		this.styleDisclaimer();
		this.buttonListeners();
	}//end setAgeCookie

	function init(){
		if($.cookie('age_rest')!=="confirmed"){
			//fireDisclaimer($);
		}
	}
	init();
})//end doc.ready()


jQuery(document).ready(function(){
	function styleContactForm(){	
		var contactForm = $('#wpcf7-f53-p36-o1').parent();
		var fields = $('.wpcf7-form').children('p');
		var inputs = $('.wpcf7-form-control');
		var name_ = $(fields[0]);
		var nameInpt = $(inputs[0]);
		var email = $(fields[1]);
		var emailInpt = $(inputs[1]);
		var subject = $(fields[2]);
		var subjectInpt = $(inputs[2]);
		var msg = $(fields[3]);
		contactForm.css({
			float:'left',
			width: '560px',
			margin: '0px 0 0 0'
		});
		
		name_.css({
			width:'120px',
			float:'left',
			margin:'0 0 0 0px'
		})

		nameInpt.css({
			width:'120px',
		})
		email.css({
			width:'120px',
			float:'left',
			margin:'0 0 0 20px'
		})
		emailInpt.css({
			width:'100px'
		})
		subject.css({
			width:'120px',
			float:'left',
			margin:'0 0 0 20px',
		})
		subjectInpt.css({
			width:'100px'
		})
		msg.css({
			clear:'left'
		})
	}

	styleContactForm();	
});