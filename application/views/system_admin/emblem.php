   <!-- DataTales Example -->
   <div class="card shadow mb-4">
       <div class="card-header py-3">
           <h6 class="m-0 font-weight-bold text-black">จัดการข้อมูลตราสัญลักษณ์</h6>
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
                           <th style="width: 15%;">ลักษณะของดวงตราและเครื่องหมาย</th>
                           <th style="width: 10%;">เหตุผลประกอบ</th>
                           <th style="width: 15%;">ความหมาย</th>
                           <th style="width: 15%;">ประวัติความเป็นมาตำบลกาบเชิง</th>
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
                                   <?php if (!empty($rs->emblem_img)) : ?>
                                       <img src="<?php echo base_url('docs/img/' . $rs->emblem_img); ?>" width="180px" height="120px">
                                   <?php else : ?>
                                       <img src="<?php echo base_url('docs/k.logo.png'); ?>" width="180px" height="120px">
                                   <?php endif; ?>
                               </td>
                               <td class="limited-text"><?= $rs->emblem_text1; ?></td>
                               <td class="limited-text"><?= $rs->emblem_text2; ?></td>
                               <td class="limited-text"><?= $rs->emblem_text3; ?></td>
                               <td class="limited-text"><?= $rs->emblem_text4; ?></td>
                               <td><?= $rs->emblem_by; ?></td>
                               <td><?= date('d/m/Y H:i', strtotime($rs->emblem_datesave . '+543 years')) ?> น.</td>
                               <td><a href="<?= site_url('emblem_backend/editing/' . $rs->emblem_id); ?>"><i class="bi bi-pencil-square fa-lg "></i></a></td>
                           </tr>
                       <?php
                            $Index++;
                        } ?>
                   </tbody>
               </table>
           </div>
       </div>
   </div>