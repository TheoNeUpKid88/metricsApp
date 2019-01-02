<script>
//PASSWORD RESET & NAVBAR ROLE VIEW
$(document).ready(function () {
    $('.pass_show').append('<span class="ptxt">Show</span>');
    role = '<?php echo $role; ?>';
        if (role === 'User') {
            //document.write(role);
            $('#superuser').hide();
            $('#superuser-2').hide();
            $('#manager').hide();
        }
        if (role === 'Manager') {
            //document.write(role);
            $('#user').hide();
            $('#user-2').hide();
        }
});
$(document).on('click', '.pass_show .ptxt', function () {
    $(this).text($(this).text() == "Show" ? "Hide" : "Show");
    $(this).prev().attr('type', function (index, attr) {
        return attr == 'password' ? 'text' : 'password';
    });
});

//TO TOP BUTTON
    // When the user scrolls down 20px from the top of the document, show the button
    window.onscroll = function () {
        scrollFunction()
    };

    function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            document.getElementById("myBtn").style.display = "block";
        } else {
            document.getElementById("myBtn").style.display = "none";
        }
    }
    // When the user clicks on the button, scroll to the top of the document
    function topFunction() {
        document.body.scrollTop = 0; // For Safari
        document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
    }
    
    //NAVBAR DATEPICKER
       $( function() {
    $( "#datepicker" ).datepicker({
        showOn: "both",
        showAnim: "slideDown",
        buttonText: "<i class='far fa-calendar-alt'></i>"
    });
  } );

  //EDIT TABLE 
$(document).ready(function(){
  $('.editbtn').click(function () {
              var currentTD = $(this).parents('tr').find('td');
              //alert('this '+$(this).html() );
              if ($(this).text().trim() == 'Edit') {
                  currentTD = $(this).parents('tr').find($("td").not(":nth-child(1)"));
                  //alert("first if "+currentTD.html());
                  $.each(currentTD, function () {
                      $(this).prop('contenteditable', true).css({
                        'background':'#fff',
                        'color':'#000'

                    })
                  });
              } else {
               // alert("second if "+currentTD.html());
                 $.each(currentTD, function () {
                    //alert("second if "+currentTD.html());
                      $(this).prop('contenteditable', false).removeAttr("style");
                  });
              }
    
              $(this).html($(this).html() == 'Edit' ? 'Save' : 'Edit')
              if ($(this).html() == 'Save'){
               // alert("third if "+currentTD.html());
                $(this).prop('contenteditable',false)
              }
    
          });
          });
</script>

    
    