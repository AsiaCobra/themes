(function($){
    // Short Call Console.log() 
    const log = console.log;

    $(document).ready(function(){
        MWD.init();
    })
    $(window).on('load',function(){

        MWD.refreshTotop();

        $('#metaslider_80').flexslider({
            animation: "slide",
            start: function (slider) {
                $('body').removeClass('loading');
            }
        });
        
    });
    var MWD = {
        init : function(){
           

            // Hide all Collapsible
            
            $('.collapsible-content').hide();

            // Wordpress Default effect changes
            MWD.galleryEffect($('dt.gallery-icon'));

            MWD.galleryGrid($('.gallery_grid .gallery'),"1,5");

            // Scroll Top 
            $(".scroll").click(function (event) {
                event.preventDefault();
                $('html,body').animate({
                    scrollTop: $(this.hash).offset().top
                }, 900);
            })

            // here stars scrolling icon 
            var defaults = {
                containerID: 'toTop', // fading element id
                containerHoverID: 'toTopHover', // fading element hover id
                scrollSpeed: 1200,
                easingType: 'linear'
            };
            $().UItoTop({
                easingType: 'easeOutQuart'
            })
            $('.counter').countUp();

            // Get id from url
            var url_ID = window.location.hash;
            // Call the function and Open Accordion
            if(url_ID && $(document).has(url_ID)[0] )
                MWD.accordion(url_ID);

            $('.accordion>dt').click(function () {
                $('.accordion>dt').not($(this)).find('i.fa-minus').toggleClass('fa-plus fa-minus').closest('dt').siblings().slideToggle();               
                $(this).find('i').toggleClass('fa-plus fa-minus').closest('dt').siblings().slideToggle();
                

            });
            $('.scroll_dropdown').each(function(){
                var parent_url = $(this).parents('li').find('[data-toggle="dropdown"]')[0].pathname,
                     current_url = window.location.pathname;
                if (parent_url.replace(/\//g, '') !== current_url.replace(/\//g, '')) {

                    $(this).find('li a').each(function(){
                        $(this)[0].href = parent_url + $(this)[0].hash;
                        // log(parent_url + $(this)[0].hash);
                    })

                } else {
                    $(this).find('li a').click(function(){
                         var id = $(this)[0].hash;
                         MWD.accordion(id);
                    })
                }
                
            })
   

        },
        galleryEffect : function(el){
            el.each(function(){
                var mainDiv = $('<div></div>').attr('class', 'content'),
                imgAlt = $(this).find('img').attr('alt'),
                wrapA = $('<a></a>').attr({
                    href: (srcset = $(this).find('img').attr('srcset').split(','), srcset[srcset.length - 1].trim().split(' ')[0]),
                    'data-lightbox' : 'example-set',
                    'data-title': imgAlt,
                }), 
                overlayDiv = $('<div></div>').attr('class','content-overlay'), 
                detailDiv = $('<div></div>').attr('class', 'content-details fadeIn-bottom')
                        .append('<h3 class="content-title">' + MWD.siteTitle() + '</h3>', '<p class="content-text">' + imgAlt+'</p>'),
                outputTag = wrapA.append(overlayDiv, '<img src=" ' + wrapA[0].href + ' "> ', detailDiv);
                var test = $(this).html(outputTag.wrapInner(mainDiv));
                console.assert(test,'ok');
                // $('footer').append()
            })
        },
        galleryGrid : function(Gallery,grid ="1,4"){
            $(Gallery[0].childNodes).each(function (item) {
                if ($(this)[0].nodeName == "DL") {
                    log($(this));
                }
            });
        },
        siteTitle : function(){
            var index = 1;
            if($(document.body).hasClass('home'))
                index = 0;

            return $('title').text().split(' | ')[index].replace('and',' & ');
        },
        accordion: function (url_ID) {
                // close opened accordions and open the clicked one
                $('.accordion .collapsible-content').css('display', 'none');
                $('.fa').removeClass('fa-minus').addClass('fa-plus');

                $(url_ID).siblings('dd').css('display', 'block');
                $(url_ID + ' .fa').removeClass('fa-plus').addClass('fa-minus');

                // scroll animation
                $('html, body').animate({
                    scrollTop: $(url_ID).offset().top
                }, 1000);
        },
        refreshTotop : function(){
            if(!window.location.hash) {
                log('Refresh To Top');
                $('html,body').animate({
                    scrollTop : $('html,body').offset().top
                },500);
            }
        }


    }
}(jQuery));