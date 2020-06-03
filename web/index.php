<?php include("includes/header.php"); ?>


<!-- Page Heading -->
  <div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">INSERT</h1>
    </div>

    <form method="post" action="./result.php">

    <div class="input-group">
      <input type="text" class="form-control border-2 big" placeholder="예시) 김남곤은 광운대학교에 다닌다." aria-label="Search" aria-describedby="basic-addon2" style="width:80pt;height:100pt;"
      name = "t_data" >
    </div>
        
    <br><br>
    
    <input type="submit" name="btn" id="btn" style="width:100pt;height:30pt;" value="실행"/ >

    </form>
    <br><br>
  </div>
  <br><br>
<?php include("includes/footer.php");  ?>
