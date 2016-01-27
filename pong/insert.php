<?php   require('db.php'); 

	$x = 10 ;

 if ($_POST['mode']=='check_code'){
    $card = $_POST['card'];
    
 	 

 	 $sql = "SELECT * FROM card WHERE id = '".$card."' limit 1";

     $result = $conn->query($sql) or die($conn->error());

        if($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $point = $row['value']*10;
            $current_point = $row['value']*10;
            $new_point = $row['value']*10;

            $new_point = $_SESSION['wallet']+$new_point;

            $sql_point = 'update cus set wallet= "'.$new_point.'" where cus_id= "'.$_SESSION['cus_id'].'"  ';
            $query = $conn->query($sql_point);

            $sql_h = 'insert into history (cus_id,point,type,date) values("'.$_SESSION['cus_id'].'" ,"'.$current_point.'" ,"1" ,"'.date('Y-m-d H:s:i').'")   ';
            $query = $conn->query($sql_h);

        } else {
             //echo "รหัสผ่านไม่ถูกต้อง";
            $text = "<center><FONT COLOR=red>**รหัสบัตรเติมเงินไม่ถูกต้อง**</FONT></center>";
            }

    }
    if($_POST['mode']=='login'){
      
      $name=  $_POST['name'];
      $sql = 'select * from cus where cus_name= "'.$name.'" limit 1 ';
      
      $query = $conn->query($sql);
      if($query->num_rows == 1){
        $row = $query->fetch_assoc();
        $_SESSION['cus_id'] = $row['cus_id']  ;
        $_SESSION['name'] = $_POST['name'] ;
      }else{
        $sql = 'insert into cus (cus_name,wallet) values("'.$_POST['name'].'" , "0")';
        $query = $conn->query($sql);
        $sql = 'select * from cus where cus_name= "'.$_POST['name'].'" limit 1 ';
        
        $query = $conn->query($sql);
        $row = $query->fetch_assoc();

        $_SESSION['cus_id'] = $row['cus_id']  ;
        $_SESSION['name'] = $_POST['name'] ;
      }
    }
      
      
      if($_GET['mode']=='logout'){
        session_destroy();
        header('location: insert.php');
        exit();
      }

  if($_POST['mode']=='random_item'){
    if($_SESSION['wallet']>50){

    $sql  = "select * from item order by id";
    $query = $conn->query($sql);
    $List2 = [];
    $tmp2 = [];
    while($rec = $query->fetch_assoc()){

      //echo $rec['id']." ".$rec['probability'];
      //echo "<br>";
      array_push($List2,$rec['probability']);
      array_push($tmp2,$rec['name']);


    }
    //print_r($List2);
    //echo "<br>";
    //print_r($tmp2);

    $List = [];
    $tmp = [];
    foreach($List2 as $index=>$item)
    {
      for($i=0; $i<$item*100; $i++)
      {
      array_push($List,$item);
      array_push($tmp,$tmp2[$index]);
      }
    }
    $random_keys=array_rand($List,1);

    $item = $tmp[$random_keys];

    $new_point = $_SESSION['wallet']-50;
    $sql_point = 'update cus set wallet= "'.$new_point.'" where cus_id= "'.$_SESSION['cus_id'].'"  ';
    $query = $conn->query($sql_point);

    $sql_h = 'insert into history (cus_id,point,type,date) values("'.$_SESSION['cus_id'].'" ,"50" ,"0" ,"'.date('Y-m-d H:s:i').'")   ';
    $query = $conn->query($sql_h);


    //echo "id:".$tmp[$random_keys]."<br> "."prob: ".$List[$random_keys];

}else{
  $no_item = "<center><FONT COLOR=red>**คุณมี Point ไม่เพียงพอ**</FONT></center>";
}

  }

 ?>	

<?php require 'head.php'; ?>

<div class="container">
  <div class="row">
    <div class="col-md-3"style="margin-top:80px;">
        <?php if(empty($_SESSION['name'])){  ?>
        <form action="" method="post">
            <input class="form-control" name="name" type="text" placeholder="ลงชื่อเข้าสู่ระบบ">
    </div>
    <div class="col-md-3" style="margin-top:80px;">
            <input class="btn btn-info" name="mode" value="login" type="submit">
    </div>
        </form>
        <?php  }else{ ?>
    
        <?php  } ?>
    

  </div>

</div>


<div class="container">


	<div class="row">
		
	<div class="col-lg-12"> <h2 class="page-header">เติมเงิน</h2></div>

	<form class="form-signin" id="form1" name="form1" method="post" action="">

			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 " >
			     <label>รหัสบัตรเติมเงิน</label>
				<input name="card" class="form-control" maxlength="8" placeholder="กรุณากรอกรหัสบัตรเติมเงิน" type="text" > 
				
        
            <?php if(!empty($text)){
                        echo $text;
                    }  ?>
        
				<br> 
				<center> <button type="submit" class="btn btn-info "> ตรวจสอบบัตรเติมเงิน </button></center>
                <br>

					<!--<?php $point = $row['value'] * $x ; ?> -->
                    <label>แต้มที่ได้รับ</label>

                   <center> <h4> <?php echo $current_point; ?> point </h4>
                    <input class="form-control" name="point"  type="hidden" value="<?php echo $point; ?> point">
                    <br>
                    <input type="hidden" name="mode" value="check_code">
                     <br>
			</div>
	</form>





        	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 " >

        	<table class="table  table-hover table-bordered">
                    <thead>
                        <tr>
                            <th class="info" style="text-align:center " >ราคาบัตร</th>
                            <th class="info" style="text-align:center " >แต้ม</th>
                        </tr>
                    </thead>
                    <tbody>
                                  <tr>
                                     <td style="text-align:center">50 Baht</td>
                                     <td style="text-align:center">500 Point</td>
                                  </tr>

                                  <tr>
                                    <td style="text-align:center">150 Baht</td>
                                    <td style="text-align:center">1500 Point</td>
                                  </tr>

                                  <tr>
                                    <td style="text-align:center">300 Baht</td>
                                     <td style="text-align:center">3000 Point</td>
                                  </tr>
                                  <tr>
                                    <td style="text-align:center">500 Baht</td>
                                     <td style="text-align:center">5000 Point</td>
                                  </tr>
                                  <tr>
                                    <td style="text-align:center">1000 Baht</td>
                                     <td style="text-align:center">10000 Point</td>
                                 </tr>
                	</tbody>
                </table>
        		
        	</div>




	<div class="row">

            <div class="col-md-12 col-sm-12 col-xs-12">
                <h3 class="page-header">Item Box </h3>(สุ่มไอเท็ม)
            </div>
            <div class="col-md-4 col-sm-3 col-xs-2 ">
              
            </div>


          
      <div class="col-md-4 col-sm-6 col-xs-10" style=" padding-bottom:20px;">
        
        <form action="" method="post">
          <input type="hidden" name="mode" value="random_item">
         <center><input type="submit" class="btn btn-info" value="Random Item" >
        </form>
        <p>(สามารถทำการสุ่ม ไอเท็ม โดยใช้ 50 p. / 1 ครั้ง)</p></center> 
        <?php
          if(!empty($item)){
            echo $item;
          }elseif(!empty($no_item)){
            echo $no_item;
          }

        ?>
            
</div>
       
          
  </div>
</div> 
</div>

