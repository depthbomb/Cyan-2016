function time2human(s) {
	var h = Math.floor(s/3600); //Get whole hours
	s -= h*3600;
	var m = Math.floor(s/60); //Get remaining minutes
	s -= m*60;
	var s = s.toString().substr(0,2);
	var time = h+":"+(m < 10 ? '0'+m : m)+":"+(s < 10 ? '0'+s : s);
	var time = time.toString().replace(/\./g, "");
	return time; //zero padding on minutes and seconds
}

$(function()
{
	LoadServerStatus();
});
function LoadServerStatus()
{
	$('.server-bar .container').html('<div class="text-center"><span class="fa fa-spinner fa-2x fa-spin text-info"></span></div>');
	$.ajax("/api/server/?info",{
		dataType: "json",
		error:function()
		{
			$('.server-bar .container').html('<div class="text-center text-danger"><span class="fa fa-warning"></span> Could not fetch server results for some reason. Try again later.</div>');
		},
		success:function(data)
		{
			if(data.online == true)
			{
				$('.server-bar .container').html('<div class="row"><div id="player-count" class="col-lg-4">Players: <b><a href="#modal-large" data-toggle="modal" data-remote="/static/modals/players.html" onclick="playersModal()">' + data.current_players + '/32</a></b></div><div class="col-lg-4 text-center map">Map: <b>' + data.map + '</b></div><div id="connect-button" class="col-lg-4 text-right"><a href="/?connect" class="btn btn-lg btn-info">Connect Now!</a></div></div>');
			}
			else
			{
				$('.server-bar .container').html('<div class="text-center text-warning"><span class="fa fa-warning"></span> The server is either offline or changing maps. <a href="javascript:;" onclick="LoadServerStatus()">Click here to try again.</a></div>');
			}
		}
	});
}

function playersModal()
{
	$('#players-table').addClass("dimmed");
	$('#refresh-button').attr("disabled",true);

	$('#refresh-button').html('<span class="fa fa-refresh"></span>');
	$('#refresh-button .fa').addClass("fa-spin");
	$('#modal-status').html('Refreshing&hellip;');
	$.ajax("/api/server/?players",{
		dataType: "json",
		error:function()
		{
			
		},
		success:function(data)
		{
			$('#players-table').removeClass("dimmed");
			$('#refresh-button').removeAttr("disabled");
			$('#refresh-button').html('<span class="fa fa-refresh"></span> Refresh');
			$('#modal-status').empty();
			$('#refresh-button .fa').removeClass("fa-spin");
			var player_data = '';
			$.each(data, function (i, item){
				player_data += '<tr><td>' + item.name + '</td><td>' + item.score + '</td><td>' + time2human(item.time) + '</td></tr>';
			});
			$('#players-table tbody').html(player_data);
		}
	});
}


(function(){
	var parallax = document.querySelectorAll(".parallax"),
		speed = 0.25;
	window.onscroll = function()
	{
		[].slice.call(parallax).forEach(function(el, i){
			var windowYOffset = window.pageYOffset,
				elBackgrounPos = "0% -" + (windowYOffset * speed) + "px";
			el.style.backgroundPosition = elBackgrounPos;
		});
	};
})();


/*==================================*/


$(function() {
	$('[data-toggle="tooltip"]').tooltip();
});


/*==================================*/


new Clipboard('[clipboard]');


/*==================================*/

cheet('↑ ↑ ↓ ↓ ← → ← → b a', function() {
	window.location.href = "https://www.youtube.com/watch?v=oHg5SJYRHA0";
});

/*==================================*/


jQuery('img.svg').each(function() {
	var $img = jQuery(this);
	var imgID = $img.attr('id');
	var imgClass = $img.attr('class');
	var imgURL = $img.attr('src');
	jQuery.get(imgURL, function(data) {
		var $svg = jQuery(data).find('svg');
		if (typeof imgID !== 'undefined') {
			$svg = $svg.attr('id', imgID);
		}
		if (typeof imgClass !== 'undefined') {
			$svg = $svg.attr('class', imgClass + ' replaced-svg');
		}
		$svg = $svg.removeAttr('xmlns:a');
		if (!$svg.attr('viewBox') && $svg.attr('height') && $svg.attr('width')) {
			$svg.attr('viewBox', '0 0 ' + $svg.attr('height') + ' ' + $svg.attr('width'))
		}
		$img.replaceWith($svg);
	}, 'xml');
});


/*==================================*/


// $(document).ready(function()
// {
// 	$('#summernote').summernote({
// 		toolbar: [
// 			['para',['style','ol','ul','paragraph','height']],
// 			['style',['fontsize','color','bold','italic','underline','strikethrough','clear']],
// 			['insert',['hr','link','picture','video']],
// 			['misc',['fullscreen','codeview','undo','redo']]
// 		],
// 		height: 300,
// 		focus: true,
// 		placeholder: 'Post content'
// 	});
// });


/*==================================*/


(function(){
	var parallax = document.querySelectorAll(".parallax"),
		speed = 0.10;
	window.onscroll = function() {
		[].slice.call(parallax).forEach(function(el, i) {
			var windowYOffset = window.pageYOffset,
				elBackgrounPos = "0% -" + (windowYOffset * speed) + "px";
			el.style.backgroundPosition = elBackgrounPos;
		});
	};
})();


/*==================================*/


(function($) {
	var BrowserClass = {
		init: function() {
			this.classes = [];
			this.agent = navigator.userAgent.toLowerCase();
			this.checkBrowser();
			this.checkPlatform();
			if (this.isMobile(this.classes)) {
				this.classes.push('mobile');
			} else {
				this.classes.push('desktop');
			}
		},

		checkBrowser: function() {
			var matches = Array();
			var aresult = '';
			var aversion = '';
			var resultant = '';

			var iePattern = /(?:\b(ms)?ie\s+|\btrident\/7\.0;.*\s+rv:)(\d+)/;
			var ieMatch = this.agent.match(iePattern);

			if (ieMatch) {
				this.classes.push('ie');

				if (typeof ieMatch[2] !== 'undefined') {
					this.classes.push('ie' + ieMatch[2]);
				}
			}

			if (this.agent.match(/opera/)) {
				this.classes.push('opera');

				aresult = this.stristr(this.agent, 'version').split('/');
				if (aresult[1]) {
					aversion = aresult[1].split(' ');
					this.classes.push('opera' + this.clearVersion(aversion[0]));
				}
			}
			if (this.agent.match(/chrome/)) {
				this.classes.push('chrome');

				aresult = this.stristr(this.agent, 'chrome').split('/');
				aversion = aresult[1].split(' ');
				this.classes.push('chrome' + this.clearVersion(aversion[0]));
			} else if (this.agent.match(/crios/)) {
				this.classes.push('chrome');
				aresult = this.stristr(this.agent, 'crios').split('/');

				if (aresult[1]) {
					aversion = aresult[1].split(' ');
					this.classes.push('chrome' + this.clearVersion(aversion[0]));
				}
			} else if (this.agent.match(/safari/)) {
				this.classes.push('safari');
				aresult = this.stristr(this.agent, 'version').split('/');

				if (aresult[1]) {
					aversion = aresult[1].split(' ');
					this.classes.push('safari' + this.clearVersion(aversion[0]));
				}
			}

			if (this.agent.match(/netscape/)) {
				this.classes.push('netscape');

				matches = this.agent.match(/navigator\/([^ ]*)/);
				if (matches) {
					this.classes.push('netscape' + this.clearVersion(matches[1]));
				} else {
					matches = this.agent.match(/netscape6?\/([^ ]*)/);
					if (matches) {
						this.classes.push('netscape' + this.clearVersion(matches[1]));
					}
				}
			}
			if (this.agent.match(/firefox/)) {
				this.classes.push('ff');
				matches = this.agent.match(/firefox[\/ \(]([^ ;\)]+)/);
				if (matches) {
					this.classes.push('ff' + this.clearVersion(matches[1]));
				}
			}
			if (this.agent.match(/konqueror/)) {
				this.classes.push('konqueror');

				aresult = this.stristr(this.agent, 'konqueror').split(' ');
				aversion = aresult[0].split('/');
				this.classes.push('konqueror' + this.clearVersion(aversion[1]));
			}
			if (this.agent.match(/dillo/)) {
				this.classes.push('dillo');
			}
			if (this.agent.match(/chimera/)) {
				this.classes.push('chimera');
			}
			if (this.agent.match(/beonex/)) {
				this.classes.push('beonex');
			}
			if (this.agent.match(/aweb/)) {
				this.classes.push('aweb');
			}
			if (this.agent.match(/amaya/)) {
				this.classes.push('amaya');
			}
			if (this.agent.match(/icab/)) {
				this.classes.push('icab');
			}
			if (this.agent.match(/lynx/)) {
				this.classes.push('lynx');
			}
			if (this.agent.match(/galeon/)) {
				this.classes.push('galeon');
			}
			if (this.agent.match(/opera mini/)) {
				this.classes.push('operamini');

				resultant = this.stristr(this.agent, 'opera mini');
				if (resultant.match('/\//')) {
					aresult = resultant.split('/');
					aversion = aresult[1].split(' ');
					this.classes.push('operamini' + this.clearVersion(aversion[0]));
				} else {
					aversion = this.stristr(resultant, 'opera mini').split(' ');
					this.classes.push('operamini' + this.clearVersion(aversion[1]));
				}
			}
		},
		checkPlatform: function() {
			if (this.agent.match(/windows/)) {
				this.classes.push('win');
			}

			if (this.agent.match(/ipad/)) {
				this.classes.push('ipad');
			}

			if (this.agent.match(/ipod/)) {
				this.classes.push('ipod');
			}

			if (this.agent.match(/iphone/)) {
				this.classes.push('iphone');
			}

			if (this.agent.match(/mac/)) {
				this.classes.push('mac');
			}

			if (this.agent.match(/android/)) {
				this.classes.push('android');
			}

			if (this.agent.match(/linux/)) {
				this.classes.push('linux');
			}

			if (this.agent.match(/nokia/)) {
				this.classes.push('nokia');
			}

			if (this.agent.match(/blackberry/)) {
				this.classes.push('blackberry');
			}

			if (this.agent.match(/freebsd/)) {
				this.classes.push('freebsd');
			}

			if (this.agent.match(/openbsd/)) {
				this.classes.push('openbsd');
			}

			if (this.agent.match(/netbsd/)) {
				this.classes.push('netbsd');
			}
		},

		isMobile: function(classes) {
			var mobile_devices = ['ipad', 'ipod', 'iphone', 'android', 'blackberry', 'operamini'];
			var mobile_devices_test = false;

			$.each(mobile_devices, function(index, value) {
				if ($.inArray(value, classes) != -1) {
					mobile_devices_test = true;

					return false;
				}
			});

			if (mobile_devices_test || this.agent.match(/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|vodafone|o2|pocket|kindle|mobile|pda|psp|treo)/)) {
				return true;
			}
		},

		clearVersion: function(version) {
			version = version.replace('/[^0-9,.,a-z,A-Z-]/', '');
			var find = (version + '').indexOf('.');
			return version.substr(0, find);
		},

		stristr: function(haystack, needle, bool) {
			var pos = 0;

			haystack += '';
			pos = haystack.toLowerCase().indexOf((needle + '').toLowerCase());
			if (pos == -1) {
				return false;
			} else {
				if (bool) {
					return haystack.substr(0, pos);
				} else {
					return haystack.slice(pos);
				}
			}
		}
	};
	BrowserClass.init();
	$('body').addClass(BrowserClass.classes.join(' '));
})(jQuery);


/*==================================*/


(function() {
	var a, b, c, d, e, f, g, h, i, j;
	b = window.device, a = {}, window.device = a, d = window.document.documentElement, j = window.navigator.userAgent.toLowerCase(), a.ios = function() {
		return a.iphone() || a.ipod() || a.ipad()
	}, a.iphone = function() {
		return e("iphone")
	}, a.ipod = function() {
		return e("ipod")
	}, a.ipad = function() {
		return e("ipad")
	}, a.android = function() {
		return e("android")
	}, a.androidPhone = function() {
		return a.android() && e("mobile")
	}, a.androidTablet = function() {
		return a.android() && !e("mobile")
	}, a.blackberry = function() {
		return e("blackberry") || e("bb10") || e("rim")
	}, a.blackberryPhone = function() {
		return a.blackberry() && !e("tablet")
	}, a.blackberryTablet = function() {
		return a.blackberry() && e("tablet")
	}, a.windows = function() {
		return e("windows")
	}, a.windowsPhone = function() {
		return a.windows() && e("phone")
	}, a.windowsTablet = function() {
		return a.windows() && e("touch") && !a.windowsPhone()
	}, a.fxos = function() {
		return (e("(mobile;") || e("(tablet;")) && e("; rv:")
	}, a.fxosPhone = function() {
		return a.fxos() && e("mobile")
	}, a.fxosTablet = function() {
		return a.fxos() && e("tablet")
	}, a.meego = function() {
		return e("meego")
	}, a.cordova = function() {
		return window.cordova && "file:" === location.protocol
	}, a.nodeWebkit = function() {
		return "object" == typeof window.process
	}, a.mobile = function() {
		return a.androidPhone() || a.iphone() || a.ipod() || a.windowsPhone() || a.blackberryPhone() || a.fxosPhone() || a.meego()
	}, a.tablet = function() {
		return a.ipad() || a.androidTablet() || a.blackberryTablet() || a.windowsTablet() || a.fxosTablet()
	}, a.desktop = function() {
		return !a.tablet() && !a.mobile()
	}, a.portrait = function() {
		return window.innerHeight / window.innerWidth > 1
	}, a.landscape = function() {
		return window.innerHeight / window.innerWidth < 1
	}, a.noConflict = function() {
		return window.device = b, this
	}, e = function(a) {
		return -1 !== j.indexOf(a)
	}, g = function(a) {
		var b;
		return b = new RegExp(a, "i"), d.className.match(b)
	}, c = function(a) {
		g(a) || (d.className += " " + a)
	}, i = function(a) {
		g(a) && (d.className = d.className.replace(" " + a, ""))
	}, a.ios() ? a.ipad() ? c("ios ipad tablet") : a.iphone() ? c("ios iphone mobile") : a.ipod() && c("ios ipod mobile") : c(a.android() ? a.androidTablet() ? "android tablet" : "android mobile" : a.blackberry() ? a.blackberryTablet() ? "blackberry tablet" : "blackberry mobile" : a.windows() ? a.windowsTablet() ? "windows tablet" : a.windowsPhone() ? "windows mobile" : "desktop" : a.fxos() ? a.fxosTablet() ? "fxos tablet" : "fxos mobile" : a.meego() ? "meego mobile" : a.nodeWebkit() ? "node-webkit" : "desktop"), a.cordova() && c("cordova"), f = function() {
		a.landscape() ? (i("portrait"), c("landscape")) : (i("landscape"), c("portrait"))
	}, h = window.hasOwnProperty("onorientationchange") ? "orientationchange" : "resize", window.addEventListener ? window.addEventListener(h, f, !1) : window.attachEvent ? window.attachEvent(h, f) : window[h] = f, f(), "function" == typeof define && "object" == typeof define.amd && define.amd ? define(function() {
		return a
	}) : "undefined" != typeof module && module.exports ? module.exports = a : window.device = a
}).call(this);


/*==================================*/

window.App = new function(){
	var self = this;
	this.MESSAGE_INFO = 0;
	this.MESSAGE_SUCCESS = 1;
	this.MESSAGE_WARNING = 2;
	this.MESSAGE_ERROR = 3;
	this.pages = {};
	this.init = function() {
		var Base64={_keyStr:"ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",encode:function(e){var t="";var n,r,i,s,o,u,a;var f=0;e=Base64._utf8_encode(e);while(f<e.length){n=e.charCodeAt(f++);r=e.charCodeAt(f++);i=e.charCodeAt(f++);s=n>>2;o=(n&3)<<4|r>>4;u=(r&15)<<2|i>>6;a=i&63;if(isNaN(r)){u=a=64}else if(isNaN(i)){a=64}t=t+this._keyStr.charAt(s)+this._keyStr.charAt(o)+this._keyStr.charAt(u)+this._keyStr.charAt(a)}return t},decode:function(e){var t="";var n,r,i;var s,o,u,a;var f=0;e=e.replace(/[^A-Za-z0-9\+\/\=]/g,"");while(f<e.length){s=this._keyStr.indexOf(e.charAt(f++));o=this._keyStr.indexOf(e.charAt(f++));u=this._keyStr.indexOf(e.charAt(f++));a=this._keyStr.indexOf(e.charAt(f++));n=s<<2|o>>4;r=(o&15)<<4|u>>2;i=(u&3)<<6|a;t=t+String.fromCharCode(n);if(u!=64){t=t+String.fromCharCode(r)}if(a!=64){t=t+String.fromCharCode(i)}}t=Base64._utf8_decode(t);return t},_utf8_encode:function(e){e=e.replace(/\r\n/g,"\n");var t="";for(var n=0;n<e.length;n++){var r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r)}else if(r>127&&r<2048){t+=String.fromCharCode(r>>6|192);t+=String.fromCharCode(r&63|128)}else{t+=String.fromCharCode(r>>12|224);t+=String.fromCharCode(r>>6&63|128);t+=String.fromCharCode(r&63|128)}}return t},_utf8_decode:function(e){var t="";var n=0;var r=c1=c2=0;while(n<e.length){r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r);n++}else if(r>191&&r<224){c2=e.charCodeAt(n+1);t+=String.fromCharCode((r&31)<<6|c2&63);n+=2}else{c2=e.charCodeAt(n+1);c3=e.charCodeAt(n+2);t+=String.fromCharCode((r&15)<<12|(c2&63)<<6|c3&63);n+=3}}return t}}
		var windowElem = $(window);
		var documentElem = $(document);
		var bodyElem = $('body');
		var navbars = $('.navbar-pages, .navbar:not(.navbar-mobile) .navbar-brand');
		var navbarPagesElem = $('.navbar-pages');
		var navbarUserElem = $('.navbar-user');
		var navbarPagesToggleElem = $('.navbar-pages-toggle');
		var navbarUserToggleElem = $('.navbar-user-toggle');
		var footerElem = $('footer.footer');
		var footerMobileElem = $('footer.mobile-footer');	
		$(".switch").bootstrapSwitch({size:'small'});	
		$('#donate-with-items').on('show.bs.collapse', function(){
			$('#donate-with-cash').collapse('hide');
		});
		$('#donate-with-cash').on('show.bs.collapse', function(){
			$('#donate-with-items').collapse('hide');
		});
		$('#donate [data-toggle="popover"]').popover({
			trigger:"hover",
			placement:"top",
			html:true
		});
		$(".disabled a, a[disabled]").click(function(){
			return false;
		});
		$('a[clipboard]').attr({
			'data-toggle':'tooltip',
			'title':'Link Copied!',
			'data-trigger':'click',
			'data-container':'body'
		});
		$('a[clipboard]').on('click', function(){
			$(this).tooltip('show');
		});
		$('#ticket-section-selector').change(function(){
			if($(this).val() === '1'){	// General Support
				$('#section-explanations>h2#section-explanation-title').html('General Support');
				$('#section-explanations>p#section-explanation-description').html('This section is used for help/inquiries that don\'t fit into any other section.');
			}
			else if($(this).val() === '2'){	// Report a Player
				$('#section-explanations>h2#section-explanation-title').html('Report a Player');
				$('#section-explanations>p#section-explanation-description').html('This section is used to report misbehaving players. To properly report a player, either record a video of them causing problems or take screenshots (if said screenshot(s) show their misbehavings). Make sure to also provide the player\'s Steam Profile URL in the report.<br>Before reporting a player, please read the rules to make sure they aren\'t doing something allowed.');
			}
			else if($(this).val() === '3'){	// Punishment Appeal
				$('#section-explanations>h2#section-explanation-title').html('Punishment Appeal');
				$('#section-explanations>p#section-explanation-description').html('This section is used to appeal any punishment you have received in the server or on the website. To properly appeal a punishment, name the admin who punished you and their reasoning (you can find ban info on the bans site) as well as what you were doing at the time of the punishment.<br>If you were banned by SMAC for <b>aimbotting</b> then you will <u>not be unbanned.</u>');
			}
			else if($(this).val() === '4'){	// Admin Application
				$('#section-explanations>h2#section-explanation-title').html('Admin Applications');
				$('#section-explanations>p#section-explanation-description').html('This section will allow you to submit an admin application to get a staff position on the server. For the best chance at being reviewed, make sure you meet these prerequisites:<br><br><ol><li>Be 15 years old or older</li><li>Have been playing on the server for at least one month</li><li>Be nice and helpful to other players</li><ul><li>Admins are the voice of authority and no one likes a meanie in charge</li></ul><li>Be willing to help others and keep order in the server</li><li>Know and follow the server rules</li><li>Though not required, donating helps out a lot</li><li>Getting to know the server owner can help out</li></ol><br>When submitting the application, please format it in the following manner:<ul><li><b>Name:</b> <i>Your Username</i></li><li><b>Steam Profile:</b> <i>Your Steam Profile URL</i></li><li><b>Age:</b> <i>Your Age</i></li><li><b>Time on Server:</b> <i>How long you have been playing on the server</i></li><li><b>Why I want to be an admin:</b> <i>Long, detailed explanation on why you should be considered for an admin</i></li></ul><br>After submitting an application, it will be reviewed manually. If interest is showed in you, you will be contacted and the next step to the application process will begin.<br>The whole admin application process can take up to a month before the fate of your application is given so be patient and be a good example of how an admin should be!');

			}
			else if($(this).val() === '5'){	// Website Bugs
				$('#section-explanations>h2#section-explanation-title').html('Website Bugs');
				$('#section-explanations>p#section-explanation-description').html('This section is used to report website bugs you encounter. When reporting a bug, please include the URL to the page where the bug occurred and explain what you were doing when it happened.');
			}
		});
		documentElem.ready(function(){
			if(windowElem.width() < 974){
				bodyElem.addClass("is-broken");
				navbarPagesElem.css("display","none");
			}
		});
		documentElem.ready(function(){
			if($('#adblock').length === 0)
			{
				$(".ad-box.leaderboard").addClass("has-adblock").wrap('<a href="/adblock" target="_blank"></a>');
			}
		});
		documentElem.ready(function(){
			$('.tickets textarea#summernote').summernote({
				height: 400,
				toolbar:[
					['style',['bold','italic','underline']],
					['font',['strikethrough','superscript','subscript']],
					['para',['ul','ol','paragraph']],
					['misc',['fullscreen','codeview','undo','redo']]
				]
			});
		});
		documentElem.ready(function(){
			$('.admin-posts textarea#summernote, .tickets textarea#summernote_admin').summernote({
				height: 400,
				toolbar:[
					['style',['bold','italic','underline']],
					['font',['color','strikethrough','superscript','subscript']],
					['para',['ul','ol','paragraph']],
					['insert', ['picture','link','video','table','hr']],
					['misc',['fullscreen','codeview','undo','redo']]
				]
			});
		});
		documentElem.ready(function(){
			$('textarea#summernote_reply').summernote({
				placeholder: 'Reply here...',
				height: 400,
				toolbar:[
					['style',['bold','italic','underline']],
					['font',['strikethrough','superscript','subscript']],
					['para',['ul','ol','paragraph']],
					['misc',['fullscreen','codeview','undo','redo']]
				]
			});
		});
		documentElem.ready(function(){
			$('.help textarea#summernote').summernote({
				placeholder: 'Article content',
				height: 400,
				toolbar:[
					['style',['bold','italic','underline']],
					['font',['color','strikethrough','superscript','subscript']],
					['para',['ul','ol','paragraph']],
					['insert', ['picture','link','video','table','hr']],
					['misc',['fullscreen','codeview','undo','redo']]
				]
			});
		});
		documentElem.ready(function(){
			$('#modal-terms').on('shown.bs.modal', function(){
				$("#modal-terms .btn-group").delay(36500).fadeIn(500);
				$("#modal-terms #check").delay(36000).fadeOut(500);
				(function(){
					var timeLeft = 36,cinterval;
					var timeDec = function (){
						timeLeft--;
						document.getElementById('countdown').innerHTML = timeLeft;
						if(timeLeft === 0){
							clearInterval(cinterval);
						}
					};
					cinterval = setInterval(timeDec, 1000);
				})();
			})
		});
		documentElem.on('click', 'time', function(){
			var timeElem = $(this);
			var toggleData = timeElem.data('toggle');
			var oldData = timeElem.html();
			if(toggleData){
				timeElem.html(toggleData);
				timeElem.data('toggle', oldData);
			}
		});
		windowElem.on('resize', function(){
			if(windowElem.width() < 974){
				if(!bodyElem.hasClass("is-broken"))
				{
					bodyElem.addClass("is-broken");
				}
			}
			else if(windowElem.width() > 974){
				bodyElem.removeClass("is-broken");

			}
			if(!bodyElem.hasClass("is-broken")){
				navbarPagesElem.css("display","block");
				navbarUserElem.css("display","none");
			}
			else if(bodyElem.hasClass("is-broken") && windowElem.width() > 974){
				navbarPagesElem.css("display","none");
			}
		});
		navbarPagesToggleElem.on('click', function(){
			if(navbarUserElem.is(':visible')){
				navbarUserElem.slideUp(200);
			}
			if(navbarPagesElem.is(':visible')){
				navbarPagesElem.slideUp(200);
			}
			else{
				navbarPagesElem.slideDown(200);
			}
		});
		navbarUserToggleElem.on('click', function(){
			if(navbarPagesElem.is(':visible')){
				navbarPagesElem.slideUp(200);
			}
			if(navbarUserElem.is(':visible')){
				navbarUserElem.slideUp(200);
			}
			else{
				navbarUserElem.slideDown(200);
			}
		});
		documentElem.on('scroll', function(){
			var windowHeight = windowElem.height();
			var bottomDistance = documentElem.height() - documentElem.scrollTop() - windowHeight;
			var footerHeight = footerElem.height() + 100;
			var footerOffset = footerElem.offset().top - 50;
			if(bottomDistance < footerHeight){
				if(windowHeight > footerOffset + footerHeight){
					navbarPagesElem.css({
						top: 81,
						bottom: windowHeight - footerOffset
					});
				}
				else if(windowHeight > footerOffset){
					navbarPagesElem.css({
						top: bottomDistance - footerHeight + (windowHeight - footerOffset) + 81,
						bottom: footerHeight - bottomDistance
					});
				}
				else{
					navbarPagesElem.css({
						top: bottomDistance - footerHeight + 81,
						bottom: footerHeight - bottomDistance
					});
				}
			}
			else{
				navbarPagesElem.css({
					top: 81,
					bottom: 0
				});
			}
		});
		windowElem.on('resize', function(){
			documentElem.trigger('scroll');
		});
		documentElem.ready(function(){
			$("a[data-remote]").each(function()
			{
				var re = $(this).attr("data-remote");
				$(this).attr("data-remote", Base64.decode(re));
			})
		});
		documentElem.ready(function(){
			$('a[scroll=true]').on('click',function (e){
				e.preventDefault();
				var target = this.hash,
				$target = $(target);

				$('html, body').stop().animate({
					'scrollTop': $target.offset().top
				}, 550, 'easeOutCirc');
			})
		});
		bodyElem.tooltip({
			selector: '[data-tooltip]',
			container: 'body',
			trigger: 'hover',
			html: true,
			delay: 0,
			placement: 'auto bottom',
			animation: false,
			title: function() {
				var elem = $(this);
				var title = elem.data('tooltip');
				return title;
			}
		});
		bodyElem.on('hidden.bs.modal', '.modal', function (){
			$(this).removeData('bs.modal');
		});
		navbarPagesElem.tooltip({
			selector: 'a',
			container: 'body',
			trigger: 'hover',
			html: true,
			delay: 0,
			placement: 'auto right',
			animation: false,
			template: '<div class="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner tooltip-navbar"></div></div>',
			title: function(){
				var elem = $(this);
				var title = elem.find('.navbar-label').text();
				return title;
			}
		});
		documentElem.trigger('scroll');
		
	};
};
App.user = new function(){
	var self = this;
	this.steamid = null;
	this.username = null;
	this.avatar = null;
	this.avatarMed = null;
	this.avatarSmall = null;
	this.updateinfo = function(){
		var userArea = $('.navbar-user-area');
		var userAvatar = userArea.find('.navbar-avatar');
		var avatarImg = userAvatar.find('img');
		userAvatar.addClass('navbar-avatar-updating');
		$.ajax("/api/user/?user_info="+this.steamid,{
			dataType: "json",
			error:function()
			{
				
			},
			success:function(data)
			{
				if(data.success == true)
				{
					if(avatarImg.attr('src') !== data.user_data.avatar_med){
						avatarImg.attr('src', data.user_data.avatar_med);
					}
					if(avatarImg.attr('alt') !== data.user_data.personaname){
						avatarImg.attr('alt', data.user_data.personaname);
					}
					userAvatar.removeClass('navbar-avatar-updating');
				}
				else
				{

				}
			}
		});
	};
};
App.updateserverbar = new function(){

}
$(App.init);