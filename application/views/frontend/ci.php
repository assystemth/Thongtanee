<div class="bg-pages">
    <div class="row pad-path">
        <div class="path1-1">
            <span class="font-path-1 underline"><a href="<?php echo site_url('Home'); ?>">หน้าแรก</a></span>
        </div>
        <div class="path2-1">
            <span class="font-path-2 underline"><a href="#">ข้อมูลทั่วไป</a></span>
        </div>
    </div>
        <div class="page-center">
            <div class="head-pages">
                <span class="font-pages-head">ข้อมูลชุมชน</span>
            </div>
        </div>
        
        <div class="bg-pages-in">
            <div class="scrollable-container-gi">
                <div class="pages-content break-word text-center">
                    <span class="font-pages-content-head">ตารางแสดงจำนวนประชากรในเขตองค์การบริหารส่วนตำบลกาเกาะ</span><br>
                    <table class="table table-bordered mt-5">
                        <thead>
                            <tr>
                                <th><b>ชื่อหมู่บ้าน</b></th>
                                <th><b>จำนวนประชากรรวม</b></th>
                                <th><b>จำนวนประชากรชาย</b></th>
                                <th><b>จำนวนประชากรหญิง</b></th>
                                <th><b>จำนวนบ้าน</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($qCi as $rs) { ?>
                                <tr>
                                    <td><?= $rs->ci_name; ?></td>
                                    <td><?= $rs->ci_total; ?></td>
                                    <td><?= $rs->ci_man; ?></td>
                                    <td><?= $rs->ci_woman; ?></td>
                                    <td><?= $rs->ci_home; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <!-- <p>ที่มา : </p> -->
                </div>
            </div>
        </div>
</div>