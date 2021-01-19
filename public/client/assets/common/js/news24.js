function buttonUp() { var valux = $('.sb-search-input').val(); valux = $.trim(valux).length; if (valux !== 0) { $('.sb-search-submit').css('z-index', '99'); } else { $('.sb-search-input').val(''); $('.sb-search-submit').css('z-index', '999'); } } $(document).ready(function () { var submitIcon = $('.sb-icon-search'); var submitInput = $('.sb-search-input'); var searchBox = $('.sb-search'); var isOpen = false; $(document).mouseup(function () { if (isOpen == true) { submitInput.val(''); $('.sb-search-submit').css('z-index', '-999'); submitIcon.click(); } }); submitIcon.mouseup(function () { return false; }); searchBox.mouseup(function () { return false; }); submitIcon.click(function () { if (isOpen == false) { searchBox.addClass('sb-search-open'); isOpen = true; } else { searchBox.removeClass('sb-search-open'); isOpen = false; } }); $(function () { $(".dropdown").hover(function () { $('.dropdown-menu', this).stop(true, true).fadeIn("fast"); $(this).toggleClass('open'); $('i', this).toggleClass("fa-caret-up"); }, function () { $('.dropdown-menu', this).stop(true, true).fadeOut("fast"); $(this).toggleClass('open'); $('i', this).toggleClass("fa-caret-up"); }); }); $(function () { $(document).on('scroll', function () { if ($(window).scrollTop() > 100) { $('.scroll-top-wrapper').addClass('show'); } else { $('.scroll-top-wrapper').removeClass('show'); } }); $('.scroll-top-wrapper').on('click', scrollToTop); }); function scrollToTop() { verticalOffset = typeof (verticalOffset) != 'undefined' ? verticalOffset : 0; element = $('body'); offset = element.offset(); offsetTop = offset.top; $('html, body').animate({ scrollTop: offsetTop }, 500, 'linear'); } }); $(document).ready(function () { $(function () { $(document).on('scroll', function () { if ($(window).scrollTop() > 100) { $('.scroll-top-wrapper').addClass('show'); } else { $('.scroll-top-wrapper').removeClass('show'); } }); $('.scroll-top-wrapper').on('click', scrollToTop); }); function scrollToTop() { verticalOffset = typeof (verticalOffset) != 'undefined' ? verticalOffset : 0; element = $('body'); offset = element.offset(); offsetTop = offset.top; $('html, body').animate({ scrollTop: offsetTop }, 500, 'linear'); } $("#nav .navbar-toggle").click(function () { $(".icon-bar").toggle(); $(".fa-close").toggle(); }); $("#search").click(function () { $("#form").fadeIn(); }); $("#search-close").click(function () { $("#form").fadeOut(); }); $(".btn-toggle").click(function () { $(".footer-ad").slideUp("slow"); }); });

if (window.location.pathname === "/m") {
    let containers = document.querySelectorAll('.container-fluid');
    containers[4].style.padding = 0;
}

window.onload = function () {

    if (window.location.href.indexOf("/m/") != -1) {

        if (window.location.href.substring(window.location.href.lastIndexOf('/') + 1).includes("%E0%A6%95%E0%A6%B0%E0%A7%8B%E0%A6%A8%E0%A6%BE%E0%A6%AD%E0%A6%BE%E0%A6%87%E0%A6%B0%E0%A6%BE%E0%A6%B8") ||
            window.location.href.substring(window.location.href.lastIndexOf('/') + 1).includes("করোনাভাইরাস")) {
            let d = document.querySelector(".neday");
            let p = d.parentNode;
            let rm = p.querySelector(".btn-block");
            console.log(rm);
            p.removeChild(rm);
        }
    }

    if (window.location.href.indexOf("/breaking-headlines") != -1) {
        var d = document.querySelector(".catTitle");
        var data = d.innerHTML;
        var items = data.split("&nbsp;");

        var a = document.createElement('a');
        a.href = '/bd';
        a.target = '_blank';
        a.appendChild(document.createTextNode(data[0]));
        d.innerText = "";

        d.innerHTML = "<a href='/topic/করোনাভাইরাস' target='_blank'>" + items[0] + "</a> &nbsp;" + items[1];
    }
};