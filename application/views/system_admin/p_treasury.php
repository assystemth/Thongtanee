   <!-- <a class="btn add-btn" href="<?= site_url('p_treasury_backend/adding_p_treasury'); ?>" role="button">
       <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
           <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
           <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
       </svg> เพิ่มข้อมูล</a> -->
   <a class="btn btn-light" href="<?= site_url('p_treasury_backend'); ?>" role="button">
       <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
           <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z" />
           <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z" />
       </svg> Refresh Data</a>

   <!-- <h5 class="border border-#f5f5f5 p-2 mb-2 font-black" style="background-color: #f5f5f5;">จัดการข้อมูลข่าวสารประจำเดือน</h5> -->
   <!-- DataTales Example -->
   <div class="card shadow mb-4">
       <div class="card-header py-3">
           <h6 class="m-0 font-weight-bold text-black">จัดการข้อมูลกองคลัง</h6>
       </div>
       <div class="card-body">
           <div class="d-flex justify-content-center">
               <?php foreach ($query_one as $rs) { ?>
                   <div class="col-sm-4 mb-4 d-flex justify-content-center">
                       <a href="<?= site_url('p_treasury_backend/editing_p_treasury/' . $rs->p_treasury_id); ?>" class="underline">
                           <div class="card-personnel">
                               <?php if (!empty($rs->p_treasury_img)) : ?>
                                   <img src="<?php echo base_url('docs/img/' . $rs->p_treasury_img); ?>" width="216px" height="180px">
                               <?php else : ?>
                                   <img src="<?php echo base_url('docs/ex_personnel.png'); ?>" width="216px" height="220px">
                               <?php endif; ?>
                               <br>
                               <span>
                                   <?= $rs->p_treasury_name; ?>
                                   <br>
                                   <?= $rs->p_treasury_rank; ?>
                                   <br>
                                   <?= $rs->p_treasury_phone; ?>
                               </span>
                           </div>
                       </a>
                   </div>
               <?php } ?>
           </div>
           <div class="row ">
               <?php foreach ($query_under_one as $rs) { ?>
                   <div class="col-sm-4 mb-4 d-flex justify-content-center">
                       <a href="<?= site_url('p_treasury_backend/editing_p_treasury/' . $rs->p_treasury_id); ?>" class="underline">
                           <div class="card-personnel">
                               <?php if (!empty($rs->p_treasury_img)) : ?>
                                   <img src="<?php echo base_url('docs/img/' . $rs->p_treasury_img); ?>" width="216px" height="180px">
                               <?php else : ?>
                                   <img src="<?php echo base_url('docs/ex_personnel.png'); ?>" width="216px" height="220px">
                               <?php endif; ?>
                               <br>
                               <span>
                                   <?php if (!empty($rs->p_treasury_name)) : ?>
                                       <?= $rs->p_treasury_name; ?>
                                   <?php else : ?>
                                       ว่าง
                                   <?php endif; ?>
                                   <br>
                                   <?= $rs->p_treasury_rank; ?>
                                   <br>
                                   <?= $rs->p_treasury_phone; ?>
                               </span>
                           </div>
                       </a>
                   </div>
               <?php } ?>
           </div>
           <!-- <div class="table-responsive">
               <?php
                $Index = 1;
                ?>
               <table id="newdataTables" class="table">
                   <thead>
                       <tr>
                           <th style="width: 5%;">ลำดับ</th>
                           <th style="width: 13%;">รูปภาพ</th>
                           <th style="width: 28%;">ชื่อ</th>
                           <th style="width: 30%;">ตำแหน่ง</th>
                           <th style="width: 13%;">โทรศัพท์</th>
                           <th style="width: 7%;">วันที่</th>
                           <th style="width: 7%;">จัดการ</th>
                       </tr>
                   </thead>
                   <tbody>
                       <?php
                        foreach ($query as $rs) {
                            $isDirector = ($rs->p_treasury_id === '1');
                        ?>
                           <tr role="row">
                               <td align="center"><?= $Index; ?></td>
                               <td>
                                   <?php if (!empty($rs->p_treasury_img)) : ?>
                                       <img src="<?php echo base_url('docs/img/' . $rs->p_treasury_img); ?>" width="120px" height="80px">
                                   <?php else : ?>
                                       <img src="<?php echo base_url('docs/coverphoto.jpg'); ?>" width="120px" height="80px">
                                   <?php endif; ?>
                               </td>
                               <td class="limited-text"><?= $rs->p_treasury_name; ?></td>
                               <td class="limited-text"><?= $rs->p_treasury_rank; ?></td>
                               <td class="limited-text"><?= $rs->p_treasury_phone; ?></td>
                               <td><?= date('d/m/Y H:i', strtotime($rs->p_treasury_datesave . '+543 years')) ?> น.</td>
                               <td>
                                   <a href="<?= site_url('p_treasury_backend/editing_p_treasury/' . $rs->p_treasury_id); ?>"><i class="bi bi-pencil-square fa-lg "></i></a>
                                   <?php if (!($isDirector)) : ?>
                                       <a href="#" role="button" onclick="confirmDelete('<?= $rs->p_treasury_id; ?>');"><i class="bi bi-trash fa-lg "></i></a>
                                   <?php endif; ?>
                                   <script>
                                       function confirmDelete(p_treasury_id) {
                                           Swal.fire({
                                               title: 'กดเพื่อยืนยัน?',
                                               text: "คุณจะไม่สามรถกู้คืนได้อีก!",
                                               icon: 'warning',
                                               showCancelButton: true,
                                               confirmButtonColor: '#3085d6',
                                               cancelButtonColor: '#d33',
                                               confirmButtonText: 'ใช่, ต้องการลบ!',
                                               cancelButtonText: 'ยกเลิก' // เปลี่ยนข้อความปุ่ม Cancel เป็นภาษาไทย
                                           }).then((result) => {
                                               if (result.isConfirmed) {
                                                   window.location.href = "<?= site_url('p_treasury_backend/del_p_treasury/'); ?>" + p_treasury_id;
                                               }
                                           });
                                       }
                                   </script>
                               </td>
                           </tr>
                       <?php
                            $Index++;
                        } ?>
                   </tbody>
               </table> 
       </div> -->
   </div>