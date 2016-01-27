<?php require('db.php'); ?>
<?php require('head.php'); ?>


<?php
  


?>
        


<div class="container" style="margin-top:50px;">
  <div class="row">
      <h3 class="page-header">ประวัติการซื้อ </h3>
      <div class="col-md-3 col-sm-6 col-xs-10">
        <div class="panel Panel with panel-info">
        <div class="panel-heading">ประวัติส่วนตัว</div>
          <div class="panel-body">

          <img class="img-responsive" src="img/noimage.png" alt="">

          <br>
          <p>ชื่อผู้ใช้ : <?php echo $_SESSION['name'] ?>
           <br>
           Point : <?php echo $_SESSION['wallet']?></p> 

          </div>
        </div>

      </div> 


    <div class="col-md-9 col-sm-12 col-xs-12">
         
          <table class="table  table-hover table-bordered">
           <h4>การเติมเงิน</h4>
                    <thead>
                        <tr>
                            <th class="info" style="text-align:center " >ID</th>
                            <th class="info" style="text-align:center " >วันที่</th>
                            <th class="info" style="text-align:center " >แต้ม</th>
                            <th class="info" style="text-align:center " >สถานะ</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php
                        $sql = 'select * from history inner join cus on history.cus_id = cus.cus_id where history.cus_id= "'.$_SESSION['cus_id'].'" ';
                        $query = $conn->query($sql);
                      ?>
                        <?php while($row = $query->fetch_assoc()){ ?>
                        <tr>
                          <td><?php echo $row['history_id'] ?></td>
                          <td><?php echo $row['date'] ?></td>
                          <td><?php echo $row['point'] ?></td>
                          <td><?php  if($row['type']==1)echo "เติมเงิน"; else echo "เปิดกล่อง"; ?></td>
                        </tr>
                        <?php  } ?>

                  </tbody>
                </table>








    </div>







  </div>
</div>



