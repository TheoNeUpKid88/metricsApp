<script>
//PASSWORD RESET & NAVBAR ROLE VIEW
$(document).ready(function () {
    $('.pass_show').append('<span class="ptxt">Show</span>');
    role = '<?php echo $role; ?>';
        if (role === 'User') {
            //document.write(role);
            $('#superuser').hide();
            $('#manager').hide();
        }
        if (role === 'Manager') {
            //document.write(role);
            $('#user').hide();
            $('#user-2').hide();
            $('#user-3').hide();
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
        buttonText: "<i class='far fa-calendar-alt'></i>",
        showButtonPanel: true,
        firstDay: 1,
        maxDate: "+0d"
        
    });
  } );

  //EDIT TABLE 

$(document).ready(function(){
    
    $('.savebtn').hide();
    $('.cancelbtn').hide();
  $('.editbtn').click(function () {
      $('.editbtn').hide();
      $('.savebtn').show();
      $('.cancelbtn').show();
              var currentTD = $(this).parents('tr').find('td');
              //alert('this '+$(this).html() );
              if ($(this).text().trim() == 'Edit') {
                  currentTD = $(this).parents('tr').find($("td").not(":nth-child(1), :nth-child(2), :nth-child(3), :nth-child(4)"));
                  //alert("first if "+currentTD.html());
                  $.each(currentTD, function () {
                      $(this).prop('contenteditable', true).css({
                        'background':'#fff',
                        'color':'#000'

                    })
                  });
              }
    $('.cancelbtn').click(function () {
              $.each(currentTD, function () {
                    //alert("second if "+currentTD.html());
                      $(this).prop('contenteditable', false).removeAttr("style");
                    $('.editbtn').show();
                    $('.savebtn').hide();
                    $('.cancelbtn').hide();
                    })
                  });
           $('.savebtn').click(function () {
              $.each(currentTD, function () {
                    //alert("second if "+currentTD.html());
                      $(this).prop('contenteditable', false).removeAttr("style");
                      //var df_id = $(this).('#pr_name');
                      var df_id2 = $(this).parent("td").text;
                      var df_id3 = "45" ;
                      console.log(df_id2);
                      $.post("DB/defect/edit_defect.php", {df_id: df_id2, day_date: df_id3}, function(data){console.log(data);
                      });
                      
                $('.editbtn').show();
                    $('.savebtn').hide();
                    $('.cancelbtn').hide();
                  });
                    })
               
    
          });
          });

        function deleletconfig(){

        var del=confirm("Are you sure you want to delete this record?");
        if (del==true){
        alert ("Record deleted")
        }else{
            alert("Record Not Deleted");
            return false;
        }
        return del;
        }
        $(document).ready(function(){
            $(".btn").click(function(){
                $("#myModal").modal('show');
            });
        });
        function showAlerts(){
        document.getElementById('bootstrap-alert').style.display = 'block';
        setTimeout(function(){document.getElementById('bootstrap-alert').style.display = 'none'}, 1700);
        
        
        }
		 $(document).ready(function (){
             
			 $("#test-content").append("<p>Testing Ajax with PHP <?php echo $user_id; ?></p>");
             $("#test-content").css("border", "3px solid red");
             $("#test-content").load("test_ajax.html")
              
		 });
</script>


    
    