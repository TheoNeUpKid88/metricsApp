<script>
if ($(this).html() == 'Save'){
    // alert("third if "+currentTD.html());
    $(this).prop('contenteditable',false)
    /* set all the vars you want to post on here */
  var parameters = { 
        df_id=df_id,
        df_date=df_date,
        pr_name=pr_name,
        tcs_type=tcs_type,
        df_round=df_round,
        Conten54tGrammarCritical=ContentGrammarCritical,
        ContentGrammarMajor=ContentGrammarMajor,
        ContentGrammarMinor=ContentGrammarMinor,
        functionalCritical=functionalCritical,
        functionalMajor=functionalMajor
        functionalMinor=functionalMinor
        NonfunctionalCritical=NonfunctionalCritical,
        NonfunctionalMajor=NonfunctionalMajor,
        NonfunctionalMinor=NonfunctionalMinor
  };
        $.ajax({        
            type:"POST",
            url:'postSQL/defect/edit_defect.php',
            data:{data u wanna pass},
            dataType:"json", //better to use json encode
            success:function(data)
            {
                //do sth after data returned
            }
            error:function(e)
            {
                    // do sth else
            }
            });
}
function deleteRow () {
   $(document).ready(function(){
    var deleteBtn = document.getElementsByClassName("deletebtn");
    deleteBtn.addEventListener('click', function () {
        $.ajax({
            url: 'postSQL/defect/edit_defect.php',
            method:'POST',
            data: df_id
            }
        alert(df_id);
    });
}); 
}


});
</script>
