function DuAnEffect(ishow, selector)
{
    $(selector).find(".nav-list span").removeClass("active");
    $(selector).find(".nav-list span:nth-child(" + (ishow) + ")").addClass("active");
    $(selector).find("ul").css("z-index", 0).fadeOut(500);
    $(selector).find("ul:nth-child(" + ishow + ")").css("z-index", 2).show();      
}

function TabScroll(selector)
{
    $(selector).find("a").click(function (event) {
        event.preventDefault();            
        $('html, body').stop().animate({ 'scrollTop': $($(this).attr("href")).offset().top }, 1000);
    });
    $(window).scroll(function () {
        
        $(selector).find("a").each(function () {                   
            if ($(window).scrollTop() >= $($(this).attr("href")).offset().top - 50) {
                $(selector).find("li").removeClass("active");
                $(this).parent().addClass("active");
            }
            if ($(window).scrollTop() + $(window).height() == $(document).height()) {
                $(selector).find("li").removeClass("active");
                $(selector).find("li:last-child").addClass("active");
            }
        });
        
    });
}
function Slide_ShowDuAnEffect(selector)
{
    $(selector).find("ul").each(function () {
        $(selector).find(".nav-list").append("<span>"+ ($(this).index()+1) +"</span>");
    });
    DuAnEffect(1, selector);
    var ishow = 2;
    var slideInterval = setInterval(function () {
        DuAnEffect(ishow, selector);
        ishow++;
        if (ishow > $(selector).find("ul").length)
            ishow = 1;                       
    }, 5000);
    $(selector).stop(true,true).hover(function () {
        clearInterval(slideInterval);
    }, function () {
        slideInterval = setInterval(function () {
            DuAnEffect(ishow, selector);
            ishow++;
            if (ishow > $(selector).find("ul").length)
                ishow = 1;
        }, 5000);
    });

    // Su kien click 
    $(selector).find(".nav-list span").stop(true).click(function () {
        
        if (ishow != ($(this).index() + 1)) {
            ishow = ($(this).index() + 1);
            DuAnEffect(ishow, selector);
        }
    });
}

function Article_Slideshow(selector)
{
    var left = $(selector).find(".leftboxes");
    var right = $(selector).find(".rightboxes");

    left.find("li:first-child").css("z-index", "1").show();        
    right.find("li:first-child").addClass("active");
    function slideAcitcle(show, hiden) {
        if (show != hiden) {
            left.find("li:nth-child(" + show + ")").css("z-index", "1").fadeIn(1500);
            left.find("li:nth-child(" + hiden + ")").fadeOut(1500, "swing", function () {
                $(this).css("z-index", "0");
            });
            right.find("li").removeClass("active");
            right.find("li:nth-child(" + show + ")").addClass("active");
        }
    }
    var lengthActicle = left.find("ul:first-child li").length;
    var showActicle = 1, hidenActicle;
    left.find(".next").stop(true, true).click(function () {
        hidenActicle = showActicle;
        showActicle++;
        if (showActicle > lengthActicle)
            showActicle = 1;
        slideAcitcle(showActicle, hidenActicle);
    });

    left.find(".prev").stop(true,true).click(function () {
        hidenActicle = showActicle;
        showActicle--;
        if (showActicle < 1)
            showActicle = lengthActicle;

        slideAcitcle(showActicle, hidenActicle);
    });

    var slideVarlue = setInterval(function () {
        left.find(".next").trigger("click");
    }, 5000);
    
    var timer;
    right.find("li").hover(function () {
        var liHover = $(this);
        timer = window.setTimeout(function () {
            hidenActicle = showActicle;
            showActicle = liHover.index() + 1;
            slideAcitcle(showActicle, hidenActicle);
        }, 500);
    }, function () {
        clearTimeout(timer);
    });

    $(selector).hover(function () {
        clearInterval(slideVarlue);
        left.find(".prev").fadeIn();
        left.find(".next").fadeIn();
    }, function () {
        left.find(".prev").fadeOut();
        left.find(".next").fadeOut();
        slideVarlue = setInterval(function () {
            left.find(".next").trigger("click");
        },5000);
    });    
}
function DuAn_slideShow(selector)
{
    // tinh toan chieu rong
    var widthContain = 0;        
    $(selector).find("li").each(function () {
        $(this).width($(this).width()).css("marginRight",$(this).css("marginRight"));
        widthContain += $(this).outerWidth(true, true);
    });
    $(selector).find("ul").width(widthContain);
    var widthItem = $(selector).find("li:first-child").outerWidth(true, true);
    $(selector).find(".next").click(function () {
        $(this).parent().find("ul").animate({ "marginLeft": (-1) * widthItem }, 1000, "swing", function () {
            $(this).append($(this).find("li:first-child")).css("marginLeft", 0);
        });
    });
    $(selector).find(".prev").click(function () {
        var item = $(this).parent().find("li:last-child");
        $(this).parent().find("ul").prepend(item).css("marginLeft", (-1) * widthItem).animate({ "marginLeft": 0 }, 1000, "swing");
    });
    var Slider = setInterval(function () {
        $(selector).find(".next").trigger("click");
    }, 4000);

    $(selector).hover(function () {
        clearInterval(Slider);
    }, function () {
        Slider = setInterval(function () {
            $(selector).find(".next").trigger("click");
        }, 4000);
    });
}
function Article_NewsSlideshow(selector)
{
    if ($(selector).find("ul").length > 1) {
        // Tinh toan chieu rong            
        var widthContain = $(selector)[0].getBoundingClientRect().width;
        $(selector).find("ul").width(widthContain);
        // Them vao danh sach bai viet ao            
        $(selector).find(".listArticle").append($(selector).find("ul:first-child").clone());
        // Tinh toan chieu rong vung chua
        var nUL = $(selector).find("ul").length;
        $(selector).find(".listArticle").width(function () { return widthContain * nUL; });
        var index = 0;
        var slideVarlue = setInterval(function () {
            index++;
            if (index != nUL-1) 
                $(selector).find(".listArticle").animate({ "marginLeft": (-1) * index * widthContain }, 1500, "swing");
            else {
                $(selector).find(".listArticle").animate({ "marginLeft": (-1) * index * widthContain }, 1500, "swing", function () {
                    $(this).css("marginLeft", 0);
                });                    
                index = 0;
            }
        }, 5000);
        $(selector).hover(function(){
            clearInterval(slideVarlue);
        },function(){
            slideVarlue = setInterval(function () {
                index++;
                if (index != nUL-1) 
                    $(selector).find(".listArticle").animate({ "marginLeft": (-1) * index * widthContain }, 1500, "swing");
                else {
                    $(selector).find(".listArticle").animate({ "marginLeft": (-1) * index * widthContain }, 1500, "swing", function () {
                        $(this).css("marginLeft", 0);
                    });                    
                    index = 0;
                }
            }, 5000);				
        });
        
    }
}   
function Videos_SlideShow(selector) {
    $(selector).find(".listVideo li:first-child").show();
    if ($(selector).find(".listVideo li").length > 1) {
        var show = 1;
        $(selector).find(".next").click(function () {
            $(selector).find(".listVideo li:nth-child(" + show + ")").fadeOut("slow");
            show++;
            if (show == $(selector).find(".listVideo li").length)
                show = 1;
            $(selector).find(".listVideo li:nth-child(" + show + ")").fadeIn("slow");
        });
        
        var slideVarlue = setInterval(function () {
            $(selector).find(".listVideo li:nth-child(" + show + ")").fadeOut("slow");
            show++;
            if (show > $(selector).find(".listVideo li").length)
                show = 1;
            $(selector).find(".listVideo li:nth-child(" + show + ")").fadeIn("slow");
            $(selector).find(".navVideo li").removeClass("active");
            $(selector).find(".navVideo li:nth-child(" + show + ")").addClass("active");
        },"5000");
        $(selector).hover(function () {
            clearInterval(slideVarlue);                
        }, function () {
            slideVarlue = setInterval(function () {
                $(selector).find(".listVideo li:nth-child(" + show + ")").fadeOut("slow");
                show++;
                if (show > $(selector).find(".listVideo li").length)
                    show = 1;
                $(selector).find(".listVideo li:nth-child(" + show + ")").fadeIn("slow");
                $(selector).find(".navVideo li").removeClass("active");
                $(selector).find(".navVideo li:nth-child(" + show + ")").addClass("active");
            }, "5000");
        });        
    }        
}
function MarqueeVertical(selector)
{
    var heightUL = 0;        
    $(selector).find("li").each(function () {
        heightUL += $(this).outerHeight(true, true);
    });

    if (heightUL > $(selector).height()) {
        $(selector).append(function () {
            return $(this).find("ul").clone();
        });

        var imargin = 0;
        var slideMarquee = setInterval(function () {
            imargin ++;
            if (imargin >= heightUL)
                imargin = 0;
            $(selector).find("ul:first-child").css("marginTop",(-1)*imargin);
        }, 40);
        $(selector).hover(function(){
            clearInterval(slideMarquee);
        },function(){
            slideMarquee = setInterval(function () {
            imargin += 2;
            if (imargin >= heightUL)
                imargin = 0;
            $(selector).find("ul:first-child").css("marginTop",(-1)*imargin);
        }, 40);
        });
    }
}
function Slide_Feature(selector)
{
    var widthContain = 0;        
    // Set lai chieu rong cho cac item va vung chua
    $(selector).find(".listFeatue li").each(function () {
        $(this).width($(this).width());
        $(this).css("marginRight", $(this).css("margin-right"));

        widthContain += $(this).outerWidth(true, true);
    });
    $(selector).find(".listFeatue").width(widthContain);
    $(selector).find(".listThumbnail li:first-child").addClass("active");
    $(selector).find(".listThumbnail li:nth-child(2)").addClass("active");

    var widthItem = $(selector).find(".listFeatue li:first-child").outerWidth(true, true);        
    function SlideShowBanner(index) {
        $(selector).find(".listFeatue").animate({ "marginLeft": (-1) * index * widthItem },1000, "swing");
        $(selector).find(".listThumbnail li").removeClass("active");
        $(selector).find(".listThumbnail li:nth-child(" + (index + 1) + ")").addClass("active");
        $(selector).find(".listThumbnail li:nth-child(" + (index + 2) + ")").addClass("active");
    }
    var iIndex = 1;
    $(selector).find(".next").click(function () {
        iIndex++;           
        if (iIndex == $(selector).find(".listFeatue li").length - 1) {                
            iIndex = 0;
        }
        SlideShowBanner(iIndex);
    });
    $(selector).find(".prev").click(function () {
        iIndex--;
        //alert(iIndex);
        if (iIndex <= -1) {
            iIndex = $(selector).find(".listFeatue li").length - 2;

        }
        SlideShowBanner(iIndex);
    });
    var slideArticle = setInterval(function () {
        $(selector).find(".next").trigger("click");
    }, 5000);
    $(selector).hover(function () {
        $(this).find(".next").fadeIn();
        $(this).find(".prev").fadeIn();
        clearInterval(slideArticle);
    }, function () {
        $(this).find(".next").fadeOut();
        $(this).find(".prev").fadeOut();
        slideArticle = setInterval(function () {
            $(selector).find(".next").trigger("click");
        }, 5000);
    });
}
function Slider_DuAnPhotos(selector)
{
    var PhotoSlider = $(selector).find(".sliderPhotos");
    var ThumbnailSlider = $(selector).find(".thumbnail");
    // add thêm 2 item vào đầu và cuối
    PhotoSlider.find("ul").prepend(PhotoSlider.find("li:last-child").clone());
    PhotoSlider.find("ul").append(PhotoSlider.find("li:nth-child(2)").clone());
    //tính toán chiều rộng cho từng item.        
    PhotoSlider.find("li").css("width", PhotoSlider.width());
    PhotoSlider.find("ul").css("width", PhotoSlider.width() * PhotoSlider.find("li").length);
    
    ThumbnailSlider.find("li:first-child").addClass("active");
    // tính toán lại margin cho đúng
    PhotoSlider.find("ul").css("marginLeft", (-1) * PhotoSlider.width());

    function SlideShowBanner(index) {
        PhotoSlider.find("ul").animate({ "marginLeft": (-1) * index * PhotoSlider.width() }, 1000, "swing");
        ThumbnailSlider.find("li").removeClass("active");
        ThumbnailSlider.find("li:nth-child(" + index + ")").addClass("active");            
    }
    var indexSlide = 1;
    $(selector).find(".next").click(function () {
        indexSlide++;
        if (indexSlide == PhotoSlider.find("li").length - 1) {
            PhotoSlider.find("ul").animate({ "marginLeft": (-1) * indexSlide * PhotoSlider.width() }, 1000, "swing", function () {
                PhotoSlider.find("ul").css("marginLeft", (-1) * PhotoSlider.width());
            });

            ThumbnailSlider.find("li").removeClass("active");
            ThumbnailSlider.find("li:first-child").addClass("active");                
            indexSlide = 1;
        }
        else SlideShowBanner(indexSlide);
    });
    $(selector).find(".prev").click(function () {
        indexSlide--;
        if (indexSlide == 0) {
            PhotoSlider.find("ul").animate({ "marginLeft": 0 }, 2000, "swing", function () {
                PhotoSlider.find("ul").css("marginLeft", (-1) * (PhotoSlider.find("li").length - 2) * PhotoSlider.width());
            });

            ThumbnailSlider.find("li").removeClass("active");
            ThumbnailSlider.find("li:last-child").addClass("active");                
            indexSlide = PhotoSlider.find("li").length - 2;
        }
        else SlideShowBanner(indexSlide);
    });
    var slideShow = setInterval(function () {
        $(selector).find(".next").trigger("click");
    }, 5000);
    $(selector).hover(function () {
        $(selector).find(".next").fadeIn();
        $(selector).find(".prev").fadeIn();
        clearInterval(slideShow);
    }, function () {
        slideShow = setInterval(function () {
            $(selector).find(".next").fadeOut();
            $(selector).find(".prev").fadeOut();
            $(selector).find(".next").trigger("click");
        }, 5000);
    });
    ThumbnailSlider.find("li").click(function () {
        indexSlide = $(this).index() + 1;
        SlideShowBanner(indexSlide);
    });
    ThumbnailSlider.find("li").click(function () {
        indexSlide = $(this).index() + 1;
        SlideShowBanner(indexSlide);
    });
}
function DoiTacSlide(selector) {
    // Đối tác        
    var widthContain = 0;
    $(selector).find("li").each(function () {
        widthContain += $(this).outerWidth(true, true) + 2;
    });
    $(selector).find("ul").width(widthContain);
    var widthItem = $(selector).find("li:first-child").outerWidth(true, true);
    $(selector).find(".next").stop(true).click(function () {
        $(selector).find("ul").animate({ "marginLeft": (-1) * widthItem },500, "swing", function () {
            $(this).append($(this).find("li:first-child")).css("marginLeft", 0);
        });
    });
    $(selector).find(".prev").stop(true).click(function () {
        $(selector).find("ul").prepend($(selector).find("li:last-child")).css({ "marginLeft": (-1) * widthItem });
        $(selector).find("ul").animate({ "marginLeft": 0 },500);
    });
    var Slider = setInterval(function () {
        $(selector).find(".next").trigger("click");
    }, 4000);

    $(selector).stop(true,true).hover(function () {
        clearInterval(Slider);
    }, function () {
        $(selector).find(".next").trigger("click");
    });
}

$(document).ready(function () {
    var isMobile = {
        Android: function () { return navigator.userAgent.match(/Android/i); },
        BlackBerry: function () { return navigator.userAgent.match(/BlackBerry/i); },
        iOS: function () { return navigator.userAgent.match(/iPhone|iPad|iPod/i); },
        Opera: function () { return navigator.userAgent.match(/Opera Mini/i); },
        Windows: function () { return navigator.userAgent.match(/IEMobile/i); },
        any: function () { return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows()); }
    };
    if (!isMobile.any()) {
        $("header .content").scrollToFixed();
    }else {
        $("#product-link").attr("href", "javascript:void(0)");
        $("#price-link").attr("href", "javascript:void(0)");
        $("#sub-product-link").hide();
        $("#sub-price-link").hide();
        $("#price-link").click(function() {
            $('#sub-price-link').toggle();
        });
        $("#product-link").click(function() {
            $('#sub-product-link').toggle();
        });
    }
    $(".fixed").stick_in_parent({ offset_top: 100 });
    $(".detail img").click(function () {
        $.fancybox.open({
            'href': this.src,
            helpers: {
                title: {
                    type: 'inside'
                },
                buttons: {}
            },

        });
    });
    $(".youtube").click(function () {
        $.fancybox({
            transitionIn: "elastic",
            transitionOut: "elastic",
            speedIn: 1500,
            speedOut: 1500,
            'title': this.title,
            'maxWidth': 800,
            'maxHeight': 450,
            'width': '80%',
            'height': $(window).width() * 0.8 * 9 / 16,
            'autoSize': false,
            'href': this.href.replace(new RegExp("watch\\?v=", "i"), 'v/index.html'),
            'type': 'swf',
            'swf': {
                'wmode': 'transparent',
                'allowfullscreen': 'true'
            }
        });

        return false;
    });
    $(".hotline-icon").click(function () {
        $(this).parent().find(".hotline-number").slideDown();
        $(this).hide();
    });
    $(".hotline-fixed .close").click(function () {
        $(this).closest(".hotline-fixed").find(".hotline-number").slideUp();
        $(".hotline-icon").fadeIn();
    });
    $(".booking").fancybox({
        padding: 0,
        margin: [0, 0, 0, 0],
        maxWidth: 800,
        maxHeight: 600,
        width: '70%',
        height: '70%',
        autoSize: false,
        transitionIn: "elastic",
        transitionOut: "elastic",
        type: "iframe",
        speedIn: 1500,
        speedOut: 1500,
    });

    $(".various").fancybox({
        padding: 0,
        margin: [0, 0, 0, 0],
        fitToView: false,
        width: '90%',
        height: '90%',
        autoSize: false,
        closeClick: false,
        openEffect: 'none',
        closeEffect: 'none',
        'iframe': { 'scrolling': 'no' }
    });

    $('.fancybox').fancybox();

    $(".havesub").hover(function () {
        $(this).children(".menuSub").stop(true, true).addClass("animation").slideDown("slow");
    }, function () {
        $(this).children(".menuSub").stop(true, true).removeClass("animation").slideUp("slow");
    });
    Videos_SlideShow("#Videos_Slideshow");
    $("#show-menu").click(function () {
        $("nav").toggle("slide");
        $("header .close").toggleClass("active");
    });
    $("header .close").click(function () {
        $("nav").toggle("slide");
        $(this).toggleClass("active");
    });

});

$(document).ready(function () {
    function SlideLeftOject(nitem, element) {
        var widthOver = element.find(".overHide").width();
        var widthUL = 0;
        element.find("li").each(function () {
            $(this).css({
                "width": widthOver / nitem - widthOver / 100,
                "marginRight": widthOver / 100 + widthOver / 100 / (nitem - 1)
            });
            widthUL += widthOver / nitem - widthOver / 100 + widthOver / 100 + widthOver / 100 / (nitem - 1);
        });
        element.find("ul").width(widthUL);
        var nLeft = 0;
        element.find(".next").click(function () {
            if (nLeft >= element.find("li").length - nitem)
                nLeft = 0;
            else {
                if (nLeft < element.find("li").length - 2 * nitem)
                    nLeft += nitem;
                else nLeft += element.find("li").length - nitem - nLeft;
            }

            element.find("ul").animate({ "left": -1 * nLeft * element.find("li:first-child").outerWidth(true, true) }, 500);
        });

        element.find(".prev").click(function () {
            if (nLeft == 0)
                nLeft = element.find("li").length - nitem;
            else {
                if (nLeft > nitem)
                    nLeft -= nitem;
                else
                    nLeft = 0;
            }
            element.find("ul").animate({ "left": -1 * nLeft * element.find("li:first-child").outerWidth(true, true) }, 500);
        });
    }
    if ($(window).width() > 1023)
        $(".SlideLeftOject").each(function () {
            SlideLeftOject(4, $(this));
        });
    else if ($(window).width() > 467)
        $(".SlideLeftOject").each(function () {
            SlideLeftOject(3, $(this));
        });
})

$(document).ready(function () {
    $('.pix_diapo').diapo({
        time: '3000',
        loaderBgColor: "transparent",
        loaderColor: '#2c4379',
        pieDiameter: 30,
        commands: false,
        mobileCommands: false,
        piePosition: 'top:10px; right:5px',
        pauseOnClick: false,
        pagination: true,
        mobilePagination: false
    });
});