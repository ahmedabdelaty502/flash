// 'use strict';
(function ($) {
  $(document).ready(function () {
    let mainNavigation = document.querySelector(".layout-header");
    let initialScroll = window.scrollY;
    window?.addEventListener("scroll", handelScrolling);

    function handelScrolling() {
      let curScroll = window.scrollY;
      console.log(curScroll);
      curScroll > 70 &&
        curScroll > initialScroll &&
        mainNavigation?.classList.add("scroll_down");
      curScroll == 0 && mainNavigation?.classList.remove("scroll_down");
      initialScroll = curScroll;
    }

    // function hideUserBar() {
    //   userBar.style.top = '-7rem';
    //   navToggle.style.inset = '3rem -2rem auto auto';
    //   navToggle.style.transition = 'inset .3s ease .3s'
    // }
    // function showUserBar() {
    //   userBar.style.top = '0';
    //   navToggle.style.inset = '8rem -2rem auto auto';
    //   navToggle.style.transition = 'inset .3s ease';
    // }
    // const resizeObserver = new ResizeObserver(function (mutations) {
    //   mutations.forEach(function (mutation) {
    //     if (mainNavigation.classList.contains('collapsed') && mutation.contentRect.width > 700) {
    //       userData.classList.remove('show');
    //     }
    //     if (!mainNavigation.classList.contains('collapsed') && mutation.contentRect.width > 850) {
    //       userData.classList.remove('show');
    //     }
    //   });
    // });

    // resizeObserver.observe(document.documentElement, {});
    // document.documentElement.addEventListener('click', function (e) {
    //   if (e.target.classList.contains('user') || e.target.closest('.user') != null) return;
    //   userData.classList.remove('show');
    // });
    // user.addEventListener('click', function (e) {
    //   if (e.target.classList.contains('user') || e.target.classList.contains('user__image')) {
    //     if (mainNavigation.classList.contains('collapsed')) {
    //       if (document.documentElement.clientWidth <= 750) {
    //         e.preventDefault();
    //         userData.classList.toggle('show');
    //       } else {
    //         userData.classList.remove('show');
    //       }
    //     } else if (!mainNavigation.classList.contains('collapsed')) {
    //       if (document.documentElement.clientWidth <= 850) {
    //         e.preventDefault();
    //         userData.classList.toggle('show');
    //       } else {
    //         userData.classList.remove('show');
    //       }
    //     }
    //   }
    // })
  });
})(jQuery);
