   <!-- DataTales Example -->
   <div class="card shadow mb-4">
       <div class="card-header py-3">
           <h6 class="m-0 font-weight-bold text-black">จัดการข้อมูลสารจากนายก</h6>
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
                           <th style="width: 13%;">ไฟล์ PDF</th>
                           <th style="width: 55%;">เรื่อง</th>
                           <th style="width: 13%;">อัพโหลด</th>
                           <th style="width: 7%;">วันที่</th>
                           <th style="width: 7%;">จัดการ</th>
                       </tr>
                   </thead>
                   <tbody>
                       <?php foreach ($query as $rs) { ?>
                           <tr role="row">
                               <td align="center"><?= $Index; ?></td>
                               <td><a class="btn btn-info btn-sm mb-2" href="<?= base_url('docs/file/' . $rs->msg_pres_pdf); ?>" target="_blank">ดูไฟล์ <?= $rs->msg_pres_pdf; ?></a></td>
                               <td><?= $rs->msg_pres_name; ?></td>
                               <td><?= $rs->msg_pres_by; ?></td>
                               <td><?= date('d/m/Y H:i', strtotime($rs->msg_pres_datesave . '+543 years')) ?> น.</td>
                               <td><a href="<?= site_url('msg_pres_backend/editing/' . $rs->msg_pres_id); ?>"><i class="bi bi-pencil-square fa-lg "></i></a></td>
                           </tr>
                       <?php
                            $Index++;
                        } ?>
                   </tbody>
               </table>
           </div>
       </div>
   </div>