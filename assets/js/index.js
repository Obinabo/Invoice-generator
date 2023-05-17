
    function printPage() {
        window.print();
    }
    
    $(document).ready(function() {
        $('.mobile').click(function() {
            $('div.nav-cont').toggleClass('show');
        });
    
        $('.close').click(function(){
            $('.success').fadeOut();
        })
        /*$('a').click(function(e) {
            e.preventDefault();
            alert('This is a demo link that leads nowhere');
        });**/
    });
    
    
    
    
    
    
    