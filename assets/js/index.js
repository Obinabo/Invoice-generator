
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

        $('.dropdown-content').hide();
        $('.action-button').click(function(e) { 
            e.preventDefault(); 
            $(this).next('.dropdown-content').slideToggle();
        })
        $('#add-items').click(function(e) {
            e.preventDefault();
            var newItem = '<input type="text" name="item[]" placeholder="Item Description">';
            var newQuantity = '<input type="number" name="quantity[]" placeholder="Quantity">';
            var newAmount = '<input type="number" name="amount[]" placeholder="Amount">';
            var newTamount = '<input type="number" name="tamount[]" placeholder="Total Amount">';

            $('.item-outline').append(newItem).append(newQuantity).append(newAmount).append(newTamount);
           
          });
        
        
            /*$('a').click(function(e) {
            e.preventDefault();
            alert('This is a demo link that leads nowhere');
        });**/
    });
    
    
    
    
    
    
    