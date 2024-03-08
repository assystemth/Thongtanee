   <!-- DataTales Example -->
   <div class="card shadow mb-4">
       <div class="card-header py-3">
           <h6 class="m-0 font-weight-bold text-black">จัดการข้อมูลสภาพทั่วไป</h6>
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
                           <th style="width: 15%;">ลักษณะที่ตั้งตำบล</th>
                           <th style="width: 10%;">อาณาเขต</th>
                           <th style="width: 15%;">ลักษณะภูมิประเทศ</th>
                           <th style="width: 15%;">พื้นที่องค์การบริหารส่วนตำบล</th>
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
                                   <?php if (!empty($rs->gci_img)) : ?>
                                       <img src="<?php echo base_url('docs/img/' . $rs->gci_img); ?>" width="180px" height="120px">
                                   <?php else : ?>
                                       <img src="<?php echo base_url('docs/coverphoto.jpg'); ?>" width="180px" height="120px">
                                   <?php endif; ?>
                               </td>
                               <td class="limited-text"><?= $rs->gci_location; ?></td>
                               <td class="limited-text"><?= $rs->gci_territory; ?></td>
                               <td class="limited-text"><?= $rs->gci_terrain; ?></td>
                               <td class="limited-text"><?= $rs->gci_area; ?></td>
                               <td><?= $rs->gci_by; ?></td>
                               <td><?= date('d/m/Y H:i', strtotime($rs->gci_datesave . '+543 years')) ?> น.</td>
                               <td><a href="<?= site_url('gci_backend/editing/' . $rs->gci_id); ?>"><i class="bi bi-pencil-square fa-lg "></i></a></td>
                           </tr>
                       <?php
                            $Index++;
                        } ?>
                   </tbody>
               </table>
           </div>
       </div>
   </div>