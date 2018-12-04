/* global twentyseventeenScreenReaderText */
(function( $ ) {

	var scrPos=0;

	$(document).ready(function(){

		$(window).scroll(function(){ // sets scroll position variable to reuse
			scrPos=$(window).scrollTop();
		})
		//setup loading
		if($('[data-load]').length) ImgLoader.init();
	});

	/*

		image loader

	*/

	var ImgLoader={
		init: function(){
			var __this=this;
			this.runLoad();
			this.winHeight=0;
			this.thumbInit=0;
			this.isLoad=0;
			$(window)
				.resize(function(){
					__this.calcHeight();
				}).scroll(function(){

				}).trigger('resize').trigger('scroll');
		},
		runLoad: function() { // sets up each thumbnail
			var __this=this;
			$('[data-load]').each(function(){
				$(this).data('obj', $(this));
				$.extend($(this).data('obj'), Img)
				$(this).data('obj').init(__this);
			})
		},
		checkCount: function(){ // counts the thumbnail images loaded
			var __this=this;
			if($('[data-load]').length==$('[data-thumb-init]').length && !$('body').is('[data-init]')){
				this.thumbInit=1;
				$('body').attr('data-init', 1);
				this.initLoad();
			}
		},
		initLoad: function(){ // checks to see if all thumbs are loaded and there's still a fullsize image to load
			var __this=this;
			var intObj=$('[data-load]:not([data-scroll]):not([data-full-init])');
			if($('body').is('[data-init]') && intObj.length){
				this.isLoad=1;
				intObj.first().data('obj').initFull();
			}
		},
		calcHeight: function(){ // calculates the window size
			var __this=this;
			this.winHeight=$(window).height();
		},
		releaseLoad: function(){
			this.isLoad=0;
		}
	}

	/*

		Each image

	*/

	var Img={
		init: function(root){
			var __this=this;
			this.root=root;
			this.elPos=0;
			this.isDone=0;
			if (this.is('img')) this.initThumb(); // if it's an image that needs loading (it probably always will be)
			else { // if it's not an image it skips all the loading
				this.attr('data-thumb-init', 1);
				this.root.checkCount();
			}
			$(window)
				.resize(function(){ // only gets the top position on resize / init
					__this.elPos=__this.offset().top-$(window).height();
				})
				.scroll(function(){
					__this.initScroll();
				})
				.trigger('resize')
				.trigger('scroll');
		},
		initThumb: function(){ // initialises the thumb loading process
			var __this=this;
			this
				.on('load', function(){
					$(this).attr('data-thumb-init', 1);
					__this.root.checkCount();
				}).each(function(){
					if(this.complete) $(this).trigger('load');
				})
		},
		initFull: function(){ // sets up the fullsize image
			var __this=this;
			if(!this.isDone){
				this.isDone=1;
				intImg=$('<img></img>');
				intImg
					.addClass('fullsize')
					.addClass('full-size')
					.attr('src', this.attr('data-src'))
				intImg[0].offsetHeight;
				intImg
					.appendTo(this.parent())
					.on('load', function(){ // once loaded, it re-triggers the root init procedure (ie. checks if there are other elements to load)
						__this
							.attr('data-full-init', 1)
							.addClass('init');
						$(this).addClass("init")

						__this.root.releaseLoad();
						__this.root.initLoad();
					})
					.each(function(){ // checks to see if it's in memory
						if(this.complete) $(this).trigger('load');
					})
			}
		},
		initScroll: function(){
			var __this=this;
			if(scrPos>this.elPos && this.is('[data-scroll]') && !this.isDone){
				this.removeAttr('data-scroll'); // removes the scroll attribute and won't retrigger
				this.root.initLoad();
			}
		}
	}
})( jQuery );
