<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Destinations</title>
  <script src="http://code.jquery.com/jquery-2.2.0.min.js"></script>
</head>
<body>
  <ul class="city_list">
  <?php foreach($destinations as $ville):?>
    <li class="city" id="city-<?php echo $ville['id']?>">
    <?php echo $ville["name"];?>
    <a class="city-delete" href="#" data-cityid="<?php echo $ville['id']?>">X</a>
    </li>
  <?php endforeach;?>
  </ul>

  <form class="city-add">
    Nom : <input type="name" name="city_name"><br>
    <input type="submit" value="Add">
  </form>

<script>
$(document).on('click','.city-delete', function(e){

  var city_id = $(this).data('cityid');

  $.post('/city/delete',{'city_id':city_id},function(data){
    if(typeof(data.error) != "undefined"){
      alert(data.error);
    }else{
      var deleted_city = data.city_id
      $('#city-'+deleted_city).remove();
    }
  },'json')

  e.preventDefault();
})

$(document).on('submit','.city-add', function(e){

  $.post("/city/create",$(this).serialize(),function(data){
    if(typeof(data.error) != "undefined"){
      alert(data.error);
    }else{
      var newli = $('<li class="city" id="city-'+data.city_id+'">'
                    +data.city_name
                    +' <a class="city-delete" href="#" data-cityid="'
                    +data.city_id+'">X</a></li>');
      $('.city_list').append(newli);
      $('.city-add input[name=city_name]').val("");
    }
  },'json');

  return false;
});
</script>

</body>
</html>