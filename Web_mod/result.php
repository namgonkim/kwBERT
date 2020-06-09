<?php include("includes/header.php"); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?php
function get_time() {
  list($usec, $sec) = explode(" ", microtime());
  return ((float)$usec + (float)$sec);
}

function test(){

  $myfile = @fopen("C:\Users\cine\Desktop\HanBert-54kN\Preprocess_mod\input_text.txt", "w");

  fwrite($myfile, $_POST["t_data"]);
  fclose($myfile);

  passthru('C:\Users\cine\AppData\Local\Programs\Python\Python36\python.exe C:\Users\cine\Desktop\HanBert-54kN\Preprocess_mod\input_preprocess.py');


  passthru('C:\Users\cine\AppData\Local\Programs\Python\Python36\python.exe C:\Users\cine\Desktop\HanBert-54kN\make_bert_model\run_ner.py --data_dir=C:\Users\cine\Desktop\HanBert-54kN\data --task_name="NER" --vocab_file=C:\Users\cine\Desktop\HanBert-54kN\conf_base\vocab.txt --bert_config_file=C:\Users\cine\Desktop\HanBert-54kN\conf_base\bert_config.json --do_lower_case=False --crf=False --do_train=False --do_eval=False --do_predict=True --output_dir=C:\Users\cine\Desktop\HanBert-54kN\output\NER_output_b16_lr5e-5_e22_w5 --max_seq_length=128 --train_batch_size=16 --learning_rate=5e-5 --num_train_epochs=5.0 --init_checkpoint=C:\Users\cine\Desktop\HanBert-54kN\p_model_base\model.ckpt-3000000');

}

$start = get_time();
if(array_key_exists('btn',$_POST)){
  test();
}
$end = get_time();
$time = $end - $start;


?>

<?php $t_data = $_POST['t_data']; ?>
<?php
$eval_res_file = @fopen("C:\\Users\\cine\\Desktop\\HanBert-54kN\\output\\NER_output_b16_lr5e-5_e22_w5\\eval_res_file.txt", "r");
if(!$eval_res_file) 
{
  $prec = 0;
  $recall = 0;
  $f1_sc = 0;
}
else{
  for ($i=0 ; !feof($eval_res_file) ; $i++) { 
      $buffer[$i] = fgets($eval_res_file);
  }
  fclose($eval_res_file);
  $prec = (double)($buffer[0]);
  $prec = $prec * 100;
  $prec = round($prec,2);
  $recall = (double)($buffer[1]);
  $recall = $recall * 100;
  $recall = round($recall,2);
  $f1_sc = (double)($buffer[2]);
  $f1_sc = $f1_sc * 100;
  $f1_sc = round($f1_sc,2);
}
?>
<?php
// bert 작동이 끝나고 결과가 나왔다면 이를 확인하도록 함.
// 1. test.txt에서 mecab으로 짤린 어절 가져오기.
// 2. label_test.txt에서 각 어절에 대한 예측 태그 가져오기.
// 3. 태그 설명 부착하기
  $word = @fopen("C:\\Users\\cine\\Desktop\\HanBert-54kN\\data\\test.txt", "r");
  $tag = @fopen("C:\\Users\\cine\\Desktop\\HanBert-54kN\\output\\NER_output_b16_lr5e-5_e22_w5\\label_test.txt","r");

  if(!$word) die("Not Found!");
  if(!$tag) die("Not Found!");

  $PS=0;
  $OG=0;
  $LC=0;
  $DT=0;
  $TI=0;
  $i=0;
  for ($i=0 ; !feof($tag) ; $i++) { 
    $buffer[$i] = fgets($word, 1000);
    $buffer_temp[$i] = fgets($tag, 1000);
    $buf_word[$i] = strtok($buffer[$i], " ");
    strtok($buffer_temp[$i], "\t");
    strtok("\t");
    $buf_tag[$i] = strtok("\n");
    //print($buf_tag[$i]);
    if($buf_tag[$i][0]=='P') $PS++;
    else if($buf_tag[$i][1]=='G') $OG++;
    else if($buf_tag[$i][0]=='L') $LC++;
    else if($buf_tag[$i][0]=='D') $DT++;
    else if($buf_tag[$i][0]=='T') $TI++;
    //$buf_tag[$i] = strtok(" ");
    //echo $buf_word[$i]."cnt=".$i."<br/>";
  }

  fclose($word);
  fclose($tag);
?>


 <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">RESULT</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> 결과 다운로드</a>
          </div>

          <!-- Content Row -->
          <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Precision</div>

                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $prec ?>%</div>
                    </div>
                    <!-- <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div> -->
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Recall</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $recall ?>%</div>
                    </div>
                    <!-- <div class="col-auto">
                      <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div> -->
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">F1 Score</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $f1_sc ?>%</div>
                        </div>
                        <div class="col">
                          <div class="progress progress-sm mr-2">
                            <div class="progress-bar bg-info" role="progressbar" style="width:<?php echo $f1_sc ?>%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div> -->
                  </div>
                </div>
              </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">경과 시간</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo ''.number_format($time,4).' 초'?></div>
                    </div>
                    <!-- <div class="col-auto">
                      <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div> -->
                  </div>
                </div>
              </div>
            </div>
          </div>

<!-- 테이블 빌드 -->

<!-- Content Row -->
          <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">PS   (PERSON): </div>

                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $PS?></div>
                    </div>
                    <!-- <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div> -->
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">OG   (ORGANIZATION): </div>

                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $OG ?></div>
                    </div>
                    <!-- <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div> -->
                  </div>
                </div>
              </div>
            </div>


            <!-- Earnings (Monthly) Card Example -->
            <div class="col">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">LC   (LOCATION): </div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $LC ?></div>
                    </div>
                    <!-- <div class="col-auto">
                      <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div> -->
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">DT   (DATE): </div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $DT ?></div>
                    </div>
                    <!-- <div class="col-auto">
                      <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div> -->
                  </div>
                </div>
              </div>
            </div>


            <!-- Pending Requests Card Example -->
            <div class="col">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">TI   (TIME): </div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $TI ?></div>
                    </div>
                    <!-- <div class="col-auto">
                      <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div> -->
                  </div>
                </div>
              </div>
            </div>
          </div>
<br>
<!-- 테이블 빌드 -->

         

            <div class="col-lg-12 mb-4">
              <!-- Illustrations -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Result table</h6>
                </div>
                <div class="card-body">
                  <div class="text-center">
                    <table class="table">
                      <thead class="thead-white">
                        <tr>
                          <th scope="col"><h4><?php echo $_POST["t_data"]; ?></h4> </th>
                        </tr>
                      </thead>
                    </table>
                    
                    <table class="table">
                      <thead class="thead-dark">
                        <tr>
                          <th scope="col">No</th>
                            <th scope="col">어절</th>
                            <th scope="col">태그</th>
                            <th scope="col">설명</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                          for($j=0;$j<$i;$j++) {
                          ?>
		<?php
			if($buf_tag[$j][0]=='P')
				$buf_tag[$j] = $buf_tag[$j]."(PERSON)";
			else if($buf_tag[$j][0]=='L')
				$buf_tag[$j] = $buf_tag[$j]."(LOCATION)";
			else if($buf_tag[$j][1]=='G')
				$buf_tag[$j] = $buf_tag[$j]."(ORGANIZATION)";
			else if($buf_tag[$j][0]=='D')
				$buf_tag[$j] = $buf_tag[$j]."(DATE)";
			else if($buf_tag[$j][0]=='T')
				$buf_tag[$j] = $buf_tag[$j]."(TIME)";
		?>
                          <tr>
                            <th scope="row"><?php echo ($j+1) ?></th>
                            <td><?php echo $buf_word[$j] ?></td>
                            <td><?php echo $buf_tag[$j] ?></td>
                            <td><a href="https://namu.wiki/w/<?php echo $buf_word[$j] ?>"><?php echo $buf_word[$j] ?></a></td>
                          </tr>
                          <?php
                          }
                          ?>
                        </tbody>
                      </table>
                  </div>
                </div>
              </div>

              <!-- Approach -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Development Approach</h6>
                </div>
                <div class="card-body">
                  
                  <p> 1. Input text를 mecab사용하여 test.txt 파일로 알맞게 저장</p>
                  <p> 2. Running Module </p>
                  <p> 3. 결과 파일을 load</p>
                  <p> 4. 포맷에 맞게 result table 및 성능 지표 출력</p>
                  
                  <p>Made by 시조.</p>
                  <p>We have a github site.</p>
                  <a href="http://github.com/namgonkim/kwbert">http://github.com/namgonkim/kwbert</a>

                </div>
              </div>

            </div>
          </div>
<?php include("includes/footer.php");  ?>