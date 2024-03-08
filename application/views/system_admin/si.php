   <!-- DataTales Example -->
   <div class="card shadow mb-4">
       <div class="card-header py-3">
           <h6 class="m-0 font-weight-bold text-black">จัดการข้อมูลยุทธศาสตร์</h6>
       </div>
       <div class="card-body">
           <div class="table-responsive">

               <?php
                $Index = 1;
                ?>
               <table id="newdataTables" class="table">
                   <thead>
                       <tr>
                           <th style="width: 3%;">ลำดับ</th>
                           <th style="width: 20%;">ชื่อยุทธศาสตร์</th>
                           <th style="width: 18%;">เป้าหมาย</th>
                           <th style="width: 18%;">แนวทางการพัฒนา</th>
                           <th style="width: 18%;">ตัวชี้วัด</th>
                           <th style="width: 13%;">อัพโหลด</th>
                           <th style="width: 7%;">วันที่</th>
                           <th style="width: 3%;">จัดการ</th>
                       </tr>
                   </thead>
                   <tbody>
                       <?php foreach ($query as $rs) { ?>
                           <tr role="row">
                               <td align="center"><?= $Index; ?></td>
                               <td class="limited-text"><?= $rs->si_topic; ?></td>
                               <td class="limited-text"><?= $rs->si_target; ?></td>
                               <td class="limited-text"><?= $rs->si_guide; ?></td>
                               <td class="limited-text"><?= $rs->si_indicators; ?></td>
                               <td><?= $rs->si_by; ?></td>
                               <td><?= date('d/m/Y H:i', strtotime($rs->si_datesave . '+543 years')) ?> น.</td>
                               <td><a href="<?= site_url('si_backend/editing/' . $rs->si_id); ?>"><i class="bi bi-pencil-square fa-lg "></i></a></td>
                           </tr>
                       <?php
                            $Index++;
                        } ?>
                   </tbody>
               </table>
           </div>
       </div>
   </div>