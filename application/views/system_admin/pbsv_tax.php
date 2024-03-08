   <!-- DataTales Example -->
   <div class="card shadow mb-4">
       <div class="card-header py-3">
           <h6 class="m-0 font-weight-bold text-black">จัดการข้อมูลการชำระภาษี</h6>
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
                           <th style="width: 55%;">สิ่งที่ต้องปฏิบัติ</th>
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
                                   <?php if (!empty($rs->pbsv_tax_img)) : ?>
                                       <img src="<?php echo base_url('docs/img/' . $rs->pbsv_tax_img); ?>" width="180px" height="120px">
                                   <?php else : ?>
                                       <img src="<?php echo base_url('docs/k.logo.png'); ?>" width="180px" height="120px">
                                   <?php endif; ?>
                               </td>
                               <td><?= $rs->pbsv_tax_text; ?></td>
                               <td><?= $rs->pbsv_tax_by; ?></td>
                               <td><?= date('d/m/Y H:i', strtotime($rs->pbsv_tax_datesave . '+543 years')) ?> น.</td>
                               <td><a href="<?= site_url('pbsv_tax_backend/editing/' . $rs->pbsv_tax_id); ?>"><i class="bi bi-pencil-square fa-lg "></i></a></td>
                           </tr>
                       <?php
                            $Index++;
                        } ?>
                   </tbody>
               </table>
           </div>
       </div>
   </div>