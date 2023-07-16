<?php include 'functions.php'; ?>
<!DOCTYPE html>
<html>
    <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style.css">
    </head>
<body>

<?php  
  $treeCategories= new treeCategories;
  $mergeCategoriesFiles = $treeCategories->mergeCategoriesFiles();
  $get_tree_cat = $treeCategories->tree( $mergeCategoriesFiles );
?>
<div class="row">
    <div class="split left">
        <ul class="category">
            <?php echo $treeCategories->categoriesToString( $get_tree_cat );?>
        </ul>
    </div>

    <div class="split right">
        <div id="result"></div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script>
  
  $('.clic-btn').on("click", function(e){
    e.preventDefault();
    let data_table = $(this).attr('data-table');
    let data_id = $(this).attr('data-id');
    let data = {
      'data_table': data_table,
      'data_id': data_id,
    }

    $.ajax({
        type        : 'POST',
        url         : 'ajax_search.php',
        data        :  data,
        dataType    : 'json',
        encode      : true
    })
    .done(function(data) {
      console.log(data);
        $('#result').html(data);    
    })

  });
</script>
</body>
</html> 



