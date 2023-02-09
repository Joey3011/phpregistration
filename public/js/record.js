$(document).ready(function(){
    //fetch
    $("#searchbar").keyup(function(){
        var input = $(this).val();
        if(input != ""){
            $.ajax({
                url: "/../myPage/public_src_select/select",
                method: "POST",
                data: {input: input},
                success: function(data){
                    $('#table-responsive').html(data);
                }
            });
        }else{
            fetch_data();
        }
    });
    function fetch_data(){
    $.ajax({
        url: "/../myPage/public_src_fetch/fetch",
        method: "POST",
        success: function(data){
            $('#table-responsive').html(data);
        }
    });
    }
    fetch_data();
    //add
    $(document).on('click','#addOne', function(e){
        $('#Add').modal().show();
              $('#add').click(function(){
                $.ajax({
                    url: "/../myPage/add",
                    method: "POST",
                    data: {
                     movie:  $('#Add').find('#movie').val(),
                     actor:  $('#Add').find('#actor').val(),
                     actress:  $('#Add').find('#actress').val(),
                     hobby:  $('#Add').find('#hobby').val(),
                    },
                    cache: false,
                    success: function(data){
                        var dataResult = JSON.parse(data);
                if(dataResult.statusCode == 200){
                         $('#Add').find('input:text').val('');
                         $('#Add').find('textarea').val('');
                         fetch_data()
                        alert("Content successfully added to record!");
                    }else if(dataResult.statusCode == 201){
                        alert("All field are required!");
                    }
                 }
              });
        });
        $('.close').click(function(){
            $('#Add').modal().hide();
            location.reload();
        });
     });
    //update
        $(document).on('click','#update', function(e){
            $('#Update').modal().show();
                    $('#Update').find('#id').val($(this).data('id'));
                    $('#Update').find('#movie').val($(this).data('t1'));
                    $('#Update').find('#actor').val($(this).data('t2'));
                    $('#Update').find('#actress').val($(this).data('t3'));
                    $('#Update').find('#hobby').val($(this).data('t4'));
        
                  $('#edit').click(function(){
            if(confirm("Continue to update record?")){
                    $.ajax({
                        url: "/../myPage/update",
                        method: "POST",
                        data: {
                            id: $('#Update').find('#id').val(),
                        movie: $('#Update').find('#movie').val(),
                         actor:  $('#Update').find('#actor').val(),
                         actress:  $('#Update').find('#actress').val(),
                         hobby:  $('#Update').find('#hobby').val(),
                        },
                        cache: false,
                        success: function(data){
                            var dataResult = JSON.parse(data);
                        if(dataResult.statusCode == 200){
                            $('#Update').find('input:text').val('');
                            $('#Update').find('textarea').val('');
                            fetch_data()
                            $('#Update').modal().hide();
                            alert("Content successfully updated!");
                            location.reload();
                        }else if(dataResult.statusCode == 201){
                            alert("All field are required!");
                        }
                     }
                  });
                }else{
                    location.reload(); 
                }
            });
            $('.close1').click(function(){
                $('#Update').modal().hide();
                location.reload();
            });
         });
      // DELETE ONE
      $(document).on('click', '#delete', function(){
        var id = $(this).data("id");
        if(id != ""){
            if(confirm("Continue to remove the record")){
                $.ajax({
                    url: "/../myPage/delete",
                    method: "POST",
                    data: {id: id},
                    success: function(data){
                        var dataResult = JSON.parse(data);
                     if(dataResult.statusCode == 200){
                        fetch_data();
                        alert("Record successfuly deleted!");
                    }
                    }
                });
            }
        }
    });    
    });