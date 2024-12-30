jQuery(document).ready(function ($) {

    let debounceTimer;

    $(window).on('scroll', function() {

        // This clears the timer for the previous event when a new scroll event registers quickly enough. 
        clearTimeout(debounceTimer);

        debounceTimer = setTimeout(function() {
            const scrollTop = $(window).scrollTop();
            const docHeight = $(document).height();
            const winHeight = $(window).height();
            const scrollPercent = scrollTop / (docHeight - winHeight);
            const scrollPercentRounded = Math.round(scrollPercent * 100);
        
            // Parse scroll percentage setting (string to integer)
            const showPercentage = parseInt(neatwpSettings.scrollPercentage || '0', 10);
            const scrollThreshold = parseInt(neatwpSettings.scrollThreshold || '10', 10);
        
            // Cache the "to top" button and scroll amount elements
            const $toTopLink = $("a.to-top");
            const $scrollAmount = $toTopLink.find(".scroll-amount");
        
            // Show or hide the "to top" button based on scroll position
            $toTopLink.toggle(scrollPercentRounded >= scrollThreshold);
        
            // Generate gradient color dynamically
            const gradientColor = `linear-gradient(90deg, var(--n-brand-secondary-color) ${scrollPercentRounded}%, var(--n-brand-primary-color) ${scrollPercentRounded}%)`;
        
            if (showPercentage) {
                if (!$scrollAmount.length) {
                    $toTopLink.html('<span class="scroll-amount"></span> <i class="fas fa-angle-double-up"></i>');
                }

                // Using find() instead of $scrollAmount because it could just have been added during the previous if condition.
                $toTopLink.find(".scroll-amount").text(scrollPercentRounded + '%');
            } else {
                $toTopLink.html('<i class="fas fa-angle-double-up"></i>');
            }
        
            // Apply the gradient background
            $toTopLink.css("background", gradientColor);
        }, 100);

    });
    

  $('a[href*=\\#]:not([href=\\#])').click(function() {
      if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') 
          || location.hostname == this.hostname) {
  
          var target = $(this.hash);
          target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
             if (target.length) {
               $('html,body').animate({
                   scrollTop: target.offset().top
              }, 400);
              return false;
          }
      }
  });

});