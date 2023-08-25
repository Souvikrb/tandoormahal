

function updateOrderStatus(id,status){
  var y = confirm('Do you want to '+status+'?');
  if(y){
    $.ajax({
        url: baseurl+'/admin/order/updateOrderStatus',
        type: 'POST',              
        data: {'id':id,'status':status},
        dataType : 'JSON',
        success: function(result)
        {
          location.reload();
        }
    });
  }
          
}

$('.btn-tool ')