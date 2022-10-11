jQuery(document).ready(function(){
    menu_event()
    set_slide();
    set_video();
    set_package_price();
    contact_state()
    faq_event()
    term_condition_event()
    //reveal_event()
    about_us_event();

    //scroll_header()
    set_position_header()

    var timeoutId;
    jQuery(window).scroll(function(){
        jQuery("#header-scroll").css('top',-100);
        if(timeoutId ){
            clearTimeout(timeoutId);  
        }
        timeoutId = setTimeout(function(){
            //scroll_header()
            set_position_header()
            scroll_hover_menu()
        }, 150);
    })  

})

function see_details_package(event){
    var id = jQuery(event.target).attr('data-rel');
    var ww = jQuery(window).width()

    var list_id = '';
    if(ww<=480) list_id = '#list-price ';
    
    jQuery(list_id+'#details-package-'+id).slideToggle(600,function(){
        if(jQuery('#list-price #details-package-'+id).is(':visible')){
            jQuery(event.target).text('Hide Details');
        }else{
            jQuery(event.target).text('See Details');
        }    
    })

    
}

function set_package_price(){
    if(jQuery('#section-price-list').length==0) return;
    var ww = jQuery(window).width();
    if(ww<=480){
        
        var lp = jQuery('#list-price .item-price').length;

        for(i=0; i<=lp; i++){
            var idx = lp - i;
            var temp = jQuery('#list-price .item-price:eq('+idx+')').clone();
            jQuery('#list-price-clone').append(temp);
        }
        var content = jQuery('#list-price-clone').children().clone()
        jQuery('#list-price .item-price').remove();
        jQuery('#list-price').append(content);
    }
}

function about_us_event(){
    if(jQuery('#section-about-us').length==0) return;
    var ww = jQuery(window).width();
    if(ww<=480){
        hh = 114;

        if(ww<=360) hh = 120;

        jQuery('#section-about-us td:nth-child(2)').readmore({
            collapsedHeight: hh,
            moreLink: '<a href="#" class="navigate-more">Read more...</a>',
            lessLink: '<a href="#" class="navigate-more">Close</a>',
            speed:300,
            afterToggle: function(trigger, element, expanded) {
                if(! expanded) { // The "Close" link was clicked
                    jQuery('body').removeClass('show-about-detail')
                }else{
                    jQuery('body').addClass('show-about-detail')
                }
            }
        });
    }

    
}

var timeoutId2;

function set_position_header(){
    var $header   = $("#header-scroll"), 
        $window    = $(window);

    var pos_top = jQuery(window).scrollTop();
    var top_state = 300;
    var ww = jQuery(window).width();
    if(ww<=480) top_state = 100;
    $header.css('top',$window.scrollTop() - 100);

    var d = 300;



    if(pos_top>=top_state){
        if(!$header.hasClass('pos_fix')){            
            var top3 = $window.scrollTop();
            $header.stop().animate({top: top3},d);
            setTimeout(function(){
               $header.addClass('pos_fix') 
            },300)            
            jQuery('body').addClass('view-small-menu').removeClass('view-large-menu');
        }
    }else{
        $header.stop().animate({top: -100},d);
        $header.removeClass('pos_fix')
        jQuery('body').removeClass('view-small-menu').addClass('view-large-menu');
    }
}


function set_position_header2(){
    var $header   = $("#header-scroll"), 
        $window    = $(window);

    var pos_top = jQuery(window).scrollTop();
    var top_state = 300;
    var ww = jQuery(window).width();
    if(ww<=360) top_state = 290;

    $header.css('top',$window.scrollTop() - 100);

    var d = 300;
    if(pos_top>=top_state){
        if(!$header.hasClass('pos_fix')){
            var top1 = $window.scrollTop() + 20;
            var top2 = $window.scrollTop() - 20;
            var top3 = $window.scrollTop();

            $header.stop().animate({top: top1},d)
                            .animate({top: top2},d-150)
                            .animate({top: top3},d-150,function (){
                            });

            setTimeout(function(){
               $header.addClass('pos_fix') 
            },1500)                
            
            jQuery('body').addClass('view-small-menu').removeClass('view-large-menu');
        }
    }else{
        $header.stop().animate({top: -100},d);
        $header.removeClass('pos_fix')
        jQuery('body').removeClass('view-small-menu').addClass('view-large-menu');
    }
}


function set_position_header_1(){
    var $sidebar   = $("#header-scroll"), 
        $window    = $(window),
        offset     = $sidebar.offset(),
        topPadding = 15;

    //console.log($window.scrollTop())
    
    var pos_top = jQuery(window).scrollTop();
    var top_state = 300;
    var ww = jQuery(window).width();
    if(ww<=360) top_state = 290;

    $sidebar.css('top',$window.scrollTop() - 100);

    var d = 500;
    if(pos_top>=top_state){
        var top1 = $window.scrollTop() + 20;
        var top2 = $window.scrollTop() - 20;
        var top3 = $window.scrollTop();

        $sidebar.stop().animate({top: top1},d)
                        .animate({top: top2},d-200)
                        .animate({top: top3},d-200);
        jQuery('body').addClass('view-small-menu').removeClass('view-large-menu');
    }else{
        $sidebar.stop().animate({top: -100},d);
        jQuery('body').removeClass('view-small-menu').addClass('view-large-menu');
    }
}



/*function scroll_header(){alert(woii);
    var pos_top = jQuery(window).scrollTop();
    var top_state = 300;
    var ww = jQuery(window).width();
    if(ww<=360) top_state = 290;
    //console.log(pos_top);
    if(pos_top>=top_state){
        if(jQuery('#header-scroll').hasClass('hide') || !jQuery('#header-scroll').hasClass('show')) {
            jQuery('#header-scroll').removeClass('hide').addClass('show');
        }
        jQuery('body').addClass('view-small-menu').removeClass('view-large-menu');
    }else{
        jQuery('#header-scroll').removeClass('show').addClass('hide');
        jQuery('body').removeClass('view-small-menu').addClass('view-large-menu');
    }
}*/


function term_condition_event(){
    if(jQuery('#tbl-term-condition').length==0) return;
    /*var ww  = jQuery(window).width();
    if(ww<=1024){
        var td = jQuery('#tbl-term-condition tr td:last-child').clone();
        jQuery('#tbl-term-condition tr td:last-child').remove();
        jQuery('#tbl-term-condition tr td:first-child').before(td);
    }*/

}


function faq_event(){
    if(jQuery('#section-faq').length==0) return
    var ww = jQuery(window).width()
    if(ww<=1024){
        jQuery('#section-faq h4').click(function(){
            var next = jQuery(this).next('blockquote');
            var ele = jQuery(this);
            jQuery('#section-faq blockquote').slideUp(600,function(){
                setTimeout(function(){
                    jQuery('#section-faq h4').removeClass('show-detail');
                    ele.addClass('show-detail');
                    next.slideDown(600);    
                },150)
                
            });
            
        })
    }

    
}

function reveal_event(){
    // Changing the defaults
    window.sr = ScrollReveal({ reset: true });
    sr.reveal('.reveal', { duration: 1000 });
}



function contact_state(){
    if(jQuery('#section-contact-us').length==0) return;
    var ww = jQuery(window).width();
    /*if(ww<=1024){
        jQuery("#package").html(jQuery("#package option").sort(function (a, b) {
            return a.text == b.text ? 0 : a.text < b.text ? -1 : 1
        }))

        var opt = jQuery("#package option:last-child").clone()
        jQuery("#package option:last-child").remove()
        jQuery('#package option:first-child').before(opt)

        jQuery('#package').select2();
    }*/

    jQuery('#package').select2();
    $("#package").val('').trigger('change')

    $( "#date" ).datepicker({minDate:0, dateFormat: 'dd MM yy'});
}

function get_mt(id){
    var ww = jQuery(window).width()

    var vr = 0;
    if(ww>1440){
        if(id=='#header') vr = 0;
        if(id=='#section-about-us') vr = 85;
        if(id=='#section-video') vr = 85;
        if(id=='#section-price-list') vr = 95;
        if(id=='#section-term-condition') vr = 50;
        if(id=='#section-faq') vr = 85;
        if(id=='#section-contact-us') vr = 75;
    }

    if(ww>1366 && ww<=1440){
        if(id=='#header') vr = 0;
        if(id=='#section-about-us') vr = 80;
        if(id=='#section-video') vr = 90;
        if(id=='#section-price-list') vr = 95;
        if(id=='#section-term-condition') vr = 0;
        if(id=='#section-faq') vr = 95;
        if(id=='#section-contact-us') vr = 95;
    }

    if(ww>768 && ww<=1024){
        if(id=='#header') vr = 0;
        if(id=='#section-about-us') vr = (+80);
        if(id=='#section-video') vr = (+115);
        if(id=='#section-price-list') vr = 70;
        if(id=='#section-term-condition') vr = (-80);
        if(id=='#section-faq') vr = 110;
        if(id=='#section-contact-us') vr = 130;
    }

    if(ww>480 && ww<=768){
        if(id=='#header') vr = 0;
        if(id=='#section-about-us') vr = 50;
        if(id=='#section-video') vr = 70;
        if(id=='#section-price-list') vr = 50;
        if(id=='#section-term-condition') vr = (-360);
        if(id=='#section-faq') vr = 70;
        if(id=='#section-contact-us') vr = 70;
    }


    if(ww <=480){
        if(id=='#header') vr = 0;
        if(id=='#section-about-us') vr = 30;
        if(id=='#section-video') vr = 63;
        if(id=='#section-price-list') vr = (50);
        if(id=='#section-term-condition') vr = (-390);
        if(id=='#section-faq') vr = 90;
        if(id=='#section-contact-us') vr = 75;
    }

    if(ww <=360){
        if(id=='#header') vr = 0;
        if(id=='#section-about-us') vr = 50;
        if(id=='#section-video') vr = 63;
        if(id=='#section-price-list') vr = (50);
        if(id=='#section-term-condition') vr = (-390);
        if(id=='#section-faq') vr = 90;
        if(id=='#section-contact-us') vr = 75;
    }


    return vr;
}


function scroll_to_id(target,mt,id){
    jQuery('html, body').stop().animate({
        scrollTop: target.offset().top - mt
    }, 1000,function (){
        var strId = id.replace('#','');
        setTimeout('scroll_hover_menu',150)
        
    });   
}

function scroll_hover_menu(){
    var arr = ['#section-about-us','#section-video','#section-price-list','#section-term-condition','#section-faq','#section-contact-us'];

    var curr_top = getScrollTop();
    var has_section = 0;
    var pos_about = 0;
    var ww = jQuery(window).width();
    jQuery.each( arr, function( key, id ) {
        var mt = get_mt(id);
        var target = jQuery(id).offset()

        var top_section = target.top - mt;
        if(id=='#section-about-us') pos_about = top_section;

        var height_section = jQuery(id).height();
        var bottom_section = top_section + height_section;

        if(id=='#section-price-list' && ww<=480){
            top_section = 2985;
            bottom_section = target.top - (mt + 30);
        } 
        //console.log(curr_top);

        if(ww<=375){
            if(id=='#section-price-list'){
                top_section = 2509;
                //if(jQuery('body').hasClass('show-about-detail')) top_section = 2707;
                bottom_section = top_section + height_section;
            } 
        }



        if(ww<=360){
            if(id=='#section-price-list'){
                top_section = 2432;
                bottom_section = top_section + height_section;
            }

            if(id=='#section-term-condition'){
                top_section = 3504;
                bottom_section = 4221;
            }

            if(id=='#section-faq'){
                top_section = 4228;
            }

            if(id=='#section-contact-us'){
                top_section = 5150;
            }
        }

        if(ww<=320){
            if(id=='#section-price-list'){
                top_section = 2243;
                bottom_section = top_section + height_section;
            }

            if(id=='#section-term-condition'){
                top_section = 3315;
                bottom_section = top_section + height_section;
            }

            if(id=='#section-faq'){
                top_section = 4083;
            }

            if(id=='#section-contact-us'){
                top_section = 5031;
            }
        }

        
        if(curr_top >= top_section && curr_top < bottom_section){
            var id_body = id.replace('#','');
            jQuery('body').attr('id',id_body);
            has_section++;
        }
    });

    var height_header_slide = (jQuery('#header').height() + jQuery('#slide').height()) - 100;

    if(curr_top < height_header_slide){
        jQuery('body').attr('id','header');
    }
    
}

function getScrollTop()
{
    var scrollTop;
    if(typeof(window.pageYOffset) == 'number')
    {
        // DOM compliant, IE9+
        scrollTop = window.pageYOffset;
    }
    else
    {
        // IE6-8 workaround
        if(document.body && document.body.scrollTop)
        {
            // IE quirks mode
            scrollTop = document.body.scrollTop;
        }
        else if(document.documentElement && document.documentElement.scrollTop)
        {
            // IE6+ standards compliant mode
            scrollTop = document.documentElement.scrollTop;
        }
    }
    return scrollTop;
}

/*Default Start*/
function menu_event(){
    $('.menu a[href^="#"]').on('click', function(event) {
        var target = $(this.getAttribute('href'));
        if( target.length ) {
            var id = this.getAttribute('href');
            //scroll_to_id(target,0,id)
            var mt = get_mt(id)
            scroll_to_id(target,mt,id)
            event.preventDefault();
            
        }
    });

    jQuery('#menu-header-scroll a[href^="#"]').on('click', function(event) {
        var target = $(this.getAttribute('href'));
        if( target.length ) {
            var id = this.getAttribute('href');
            var mt = get_mt(id)
            scroll_to_id(target,mt,id)
            event.preventDefault();
        }
    });

    $('#menu-mobile a[href^="#"]').on('click', function(event) {
        var target = $(this.getAttribute('href'));
        if( target.length ) {
            var ww = jQuery(window).width()
            $(".top-menu").removeClass("top-animate");
            $("body").removeClass("nnoscroll");
            $(".mid-menu").removeClass("mid-animate");
            $(".bottom-menu").removeClass("bottom-animate");
            var id = this.getAttribute('href');

            $("#mobilenav").slideUp(500,function(){
                /*if(id='#section-price-list'){
                    jQuery("img.lazy").each(function(){
                        $("img.lazy").show().lazyload();    
                    })
                }else{*/
                    var mt = get_mt(id)
                    scroll_to_id(target,mt,id)    
                //}

                

                /*$('html, body').stop().animate({
                    scrollTop: target.offset().top
                }, 1000,function (){
                    jQuery('body').removeClass('nnoscroll');

                });*/ 
            });
            event.preventDefault();
            
        }
    });
}

function set_slide(){
    if(jQuery('#slide input').length>0){
        var slide = [];
        jQuery('#slide input').each(function(){
            var src = jQuery(this).val();
            var slide_object = new Object();
            slide_object.src = src;
            slide.push(slide_object);
        })


        var np = jQuery('#slide input').length;
        if(np > 1){
            var btn = '';
            for(i=0; i<np; i++){
                btn += '<button onClick="goto_slide(event)" data-i="'+i+'"></button>';
                
            }
            jQuery('#slide').append('<div id="pagging-slide" class="pagging-slide">'+btn+'</div>');
        }

        //console.log(slide)
        jQuery("#slide").vegas({
            delay: 5000,
            slides:slide,
            transition: 'fade',
            timer: false,
            walk: function (nb) {
                //console.log(nb)
                jQuery('#pagging-slide button').removeClass('active').eq(nb).addClass('active');
            },
            init: function (globalSettings) {},
        });

        //if(jQuery('#ul-pagging-slide li').length>0) jQuery('#ul-pagging-slide li').fadeIn(300);
    }
}

function goto_slide(event){
    var idx = jQuery(event.target).attr('data-i');
    jQuery("#slide").vegas('jump',idx);
}


function set_video(){
    if(jQuery('#list-video input').length>0){
        var ww = jQuery(window).width();
        if(ww>480)
            set_video_dekstop()            
        else
            set_video_mobile()
    }
}

function set_video_mobile(){
    var videos ='';
    jQuery('#list-video input').each(function(n){
        var img = jQuery(this).attr('data-image');
        var video = jQuery(this).val();

        videos += '<a id="item-video-'+n+'" class="item-video" href="'+video+'"><img class="lazy" src="'+img+'"  /></a>';

    })
    jQuery('#section-video').append('<div id="container-video" class="container-video">'+videos+'</div>');    
    jQuery("img.lazy").lazyload();

    jQuery('.item-video').lightcase();
    /*jQuery('.item-video').magnificPopup({
        disableOn: 320,
        type: 'iframe',
        mainClass: 'mfp-fade',
        removalDelay: 160,
        preloader: false,

        fixedContentPos: false
    });*/
}


function temp_video(n,video,img){
    //return '<a id="item-video-'+n+'" class="item-video" href="'+video+'"><img data-lazy="'+img+'" /></a>';
    return '<a id="item-video-'+n+'" class="item-video html5lightbox" href="'+video+'"><div class="bg-video" style="background-image:url('+img+');"  data-rel="lightcase:myCollection"></div></a>';
}

//function 

function set_video_dekstop(){
    var p = 4;
    var ww = jQuery(window).width()
    if(ww<=1024) p =3;

    var temp_video_1 = '';
    var temp_video_2 = '';
    var ntv1 = 0; var ntv2 = 0; var n = 1;
    var vl = jQuery('#list-video input').length;

    jQuery('#list-video input').each(function(){
        var img = jQuery(this).attr('data-image');
        var video = jQuery(this).val();

        if(ntv1<p){
            //console.log('vid-1 => '+n);
            temp_video_1 += temp_video(n,video,img);
            ntv1++;
            n++;
            if(ntv1==p){
                ntv2=0;
                return true;  
            } 
        }

        if(ntv2<p && ntv1==p){
            //console.log('vid-2 => '+n);   
            temp_video_2 += temp_video(n,video,img)
            ntv2++;
            n++;
            if(ntv2==p){
               ntv1=0;
               var vlcurr = (vl-1);
               //console.log(vlcurr);
               if( vlcurr < p){
                    //console.log(vlcurr);
                    //return;
               }
               return true;   
            } 
        }
        vl--;
    })






    jQuery('#section-video').append('<div id="container-video" class="container-video"></div>');
    jQuery('#container-video').append('<div id="video" class="video">'+temp_video_1+'</div>');
    jQuery('#container-video').append('<div id="video-2" class="video">'+temp_video_2+'</div>');

    var hv = jQuery('#video').height();
    jQuery('.video a').css('height',hv+'px');


    //harus 3 slide video-1
    var v1 = jQuery('#video a').length;
    //console.log(v1);
    var min_v1 = 0;
    

    var num_v1 = jQuery('#video a').length;
    var min_v2 = v1 - jQuery('#video-2 a').length;
    if(min_v2>0){
        for(i=0; i<min_v2; i++){
            var dummy = '<a class="item-video item-dummy" ></a>';
            jQuery('#video-2 a:last-child').after(dummy);
        }    
    }

    if(num_v1>p){
        var nav = '<button class="navigation navigation-prev" onClick="navigation_video(event)" data-event="slickPrev"></button>'
                    +'<button class="navigation navigation-next" onClick="navigation_video(event)" data-event="slickNext"></button>';
        jQuery('#container-video').append(nav);
    }
    


    $('#video').slick({
         // lazyLoad: 'ondemand',
          slidesToShow: p,
          slidesToScroll: 1
    });
    $('#video-2').slick({
          //lazyLoad: 'ondemand',
          slidesToShow: p,
          slidesToScroll: 1
    });

    /*$('.item-video').magnificPopup({
        disableOn: 320,
        type: 'iframe',
        mainClass: 'mfp-fade',
        removalDelay: 160,
        preloader: false,

        fixedContentPos: false
    });*/
    var opt = new Object();
        opt.width = 700;
        opt.height = 700;
    jQuery('.item-video').lightcase(opt);
}

function navigation_video(event){
    var event = jQuery(event.target).attr('data-event');
    $('#video').slick(event)
    $('#video-2').slick(event)
}



function select_package(event){
    var package = jQuery(event.target).attr('data-package');
    jQuery("#package").val(package).trigger("change");

    var target = jQuery('#section-contact-us').offset()

    jQuery('html, body').stop().animate({
        scrollTop: target.top
    }, 1000);
}



/*function set_section_style(){
    if(jQuery('.custom-h1'))
}

Object.prototype.styleFirstWord = function (styleHook, styleElem) {
    styleHook = styleHook || 'secondWord';
    styleElem = styleElem || 'span';
    var open = '<' + styleElem + ' class="' + styleHook + '">',
        close = '</' + styleElem + '>',
        text = '',
        words = [];
    for (var i = 0, len = this.length; i < len; i++) {
        words = (this[i].textContent || this[i].innerText).split(/\s+/);
        if (words[0]) {
            words[0] = open + words[0] + close;
            this[i].innerHTML = words.join(' ');
        }
    }
};

document.getElementsByTagName('h2').styleFirstWord('classNameToUse', 'em');*/


var scroll = true

// HAMBURGLERv2
function togglescroll () {
  $('body').on('touchstart', function(e){
    if ($('body').hasClass('nnoscroll')) {
        //scroll = false
        //e.preventDefault();
    }
  });
}

$(document).ready(function () {
    togglescroll()
   
    var timeoutId;
    $(".icon").click(function () {
        if(timeoutId ){
            clearTimeout(timeoutId );  
        }
        timeoutId = setTimeout(function(){
            if(!jQuery('body').hasClass('nnoscroll')){
                jQuery("#mobilenav").removeAttr( 'style' ); 
                jQuery(".mobilenav").slideDown(500);
                jQuery('.header').addClass('hashowmobile');
            }else{
                jQuery(".mobilenav").slideUp(500);
                jQuery('.header').removeClass('hashowmobile');
            }

            $(".top-menu").toggleClass("top-animate");
            $("body").toggleClass("nnoscroll");
            if ($('body').hasClass('nnoscroll')) scroll = false
            else scroll = true
        

            $(".mid-menu").toggleClass("mid-animate");
            $(".bottom-menu").toggleClass("bottom-animate");        
        }, 250);
    });

    jQuery('.mobilenav li').mouseenter(function(event){
        var index = jQuery('.mobilenav li').index(this);
        if(index>0) jQuery('.mobilenav li:eq('+(index-1)+')').addClass('has-hover');
    }).mouseleave(function (event){
        jQuery('.mobilenav li.has-hover').removeClass('has-hover');
    });

    

    $(document).bind('touchmove', function(){
        scroll = false
    }).unbind('touchmove', function(){
        scroll = true
    })

    $(window).scroll(function() {
        //console.log(scroll)
        if ($('body').hasClass('nnoscroll') && scroll == false) {
            $(document).scrollTop(0);
        }
    })

});



// PUSH ESC KEY TO EXIT

$(document).keydown(function(e) {
    if (e.keyCode == 27) {
        $(".mobilenav").slideUp(500);
        $(".top-menu").removeClass("top-animate");
        $("body").removeClass("nnoscroll");
        $(".mid-menu").removeClass("mid-animate");
        $(".bottom-menu").removeClass("bottom-animate");
    }
});

/*Default End*/