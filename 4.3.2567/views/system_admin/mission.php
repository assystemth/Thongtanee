   <!-- DataTales Example -->
   <div class="card shadow mb-4">
       <div class="card-header py-3">
           <h6 class="m-0 font-weight-bold text-black">จัดการข้อมูลภารกิจและความรับผิดชอบ</h6>
       </div>
       <div class="card-body">
           <div class="table-responsive">

               <?php
                $Index = 1;
                ?>
               <table id="newdataTables" class="table">
                   <thead>
                       <tr>
                           <th style="width: 5%;">ลำดับ</th>
                           <th style="width: 13%;">รูปภาพ</th>
                           <th style="width: 55%;">รายละเอียด</th>
                           <th style="width: 13%;">อัพโหลด</th>
                           <th style="width: 7%;">วันที่</th>
                           <th style="width: 7%;">จัดการ</th>
                       </tr>
                   </thead>
                   <tbody>
                       <?php foreach ($query as $rs) { ?>
                           <tr role="row">
                               <td align="center"><?= $Index; ?></td>
                               <td>
                                   <?php if (!empty($rs->mission_img)) : ?>
                                       <img src="<?php echo base_url('docs/img/' . $rs->mission_img); ?>" width="180px" height="120px">
                                   <?php else : ?>
                                       <img src="<?php echo base_url('docs/coverphoto.jpg'); ?>" width="180px" height="120px">
                                   <?php endif; ?>
                               </td>
                               <td class="limited-text"><?= $rs->mission_detail; ?></td>
                               <td><?= $rs->mission_by; ?></td>
                               <td><?= date('d/m/Y H:i', strtotime($rs->mission_datesave . '+543 years')) ?> น.</td>
                               <td><a href="<?= site_url('mission_backend/editing/' . $rs->mission_id); ?>"><i class="bi bi-pencil-square fa-lg "></i></a></td>
                           </tr>
                       <?php
                            $Index++;
                        } ?>
                   </tbody>
               </table>
           </div>
       </div>
   </div>