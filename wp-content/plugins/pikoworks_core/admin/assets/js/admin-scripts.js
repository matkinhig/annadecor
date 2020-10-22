jQuery(document).ready(function($){
    "use strict";
   // Coming Soon Countdown
    $('.piko-countdown-wrap').each(function(){
        var $this = $(this);
        var coming_soon_countdown = $this.attr('data-countdown');
        
        if ( typeof coming_soon_countdown == 'undefined' || typeof coming_soon_countdown == false ) {
            var cd_class = $this.attr('class');
            if ( $.trim(cd_class) != '' ) {
                cd_class = cd_class.split('piko-cms-date_');
                if ( typeof cd_class[1] != 'undefined' && typeof cd_class[1] != false ) {
                    coming_soon_countdown = cd_class[1];
                }
            }
        }
        
        if ( typeof coming_soon_countdown != 'undefined' && typeof coming_soon_countdown != false ) {
            if ( $this.hasClass('countdown-admin-menu') ) { // For admin login
                $this.find('a').countdown(coming_soon_countdown, function(event) {
                    $this.find('a').html(
                        event.strftime(pikoCountdown['html']['countdown_admin_menu'])
                    );
                }); 
            }
            else{
                $this.countdown(coming_soon_countdown, function(event) {
                    $this.html(
                        event.strftime(pikoCountdown['html']['countdown'])
                    );
                });    
            }  
        }
        
    });
    
    
});