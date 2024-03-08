   <!-- DataTales Example -->
   <div class="card shadow mb-4">
       <div class="card-header py-3">
           <h6 class="m-0 font-weight-bold text-black">จัดการข้อมูลประวัติความเป็นมา</h6>
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
                           <th style="width: 30%;">รูปภาพ</th>
                           <th style="width: 53%;">รายละเอียด</th>
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
                                   <?php if (!empty($rs->history_img)) : ?>
                                       <img src="<?php echo base_url('docs/img/' . $rs->history_img); ?>" width="160px" height="100px">
                                   <?php else : ?>
                                       <img src="<?php echo base_url('docs/k.logo.png'); ?>" width="160px" height="100px">
                                   <?php endif; ?>
                               </td>
                               <td class="limited-text"><?= $rs->history_name; ?></td>
                               <td><?= $rs->history_by; ?></td>
                               <td><?= date('d/m/Y H:i', strtotime($rs->history_datesave . '+543 years')) ?> น.</td>
                               <td><a href="<?= site_url('history_backend/editing/' . $rs->history_id); ?>"><i class="bi bi-pencil-square fa-lg "></i></a></td>
                           </tr>
                       <?php
                            $Index++;
                        } ?>
                   </tbody>
               </table>
           </div>
       </div>
   </div>