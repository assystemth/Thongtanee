<div class="bg-pages ">
    <div class="container-pages-detail">
        <div class="page-center">
            <div class="head-pages">
                <span class="font-pages-head">อำนาจหน้าที่ อบต.สว่าง</span>
            </div>
        </div>
        <div class="row">
            <div class="path1-1">
                <span class="font-path-1 underline"><a href="<?php echo site_url('Home'); ?>">หน้าแรก</a></span>
            </div>
            <div class="path2-1">
                <span class="font-path-2 underline"><a href="#">ข้อมูลทั่วไป</a></span>
            </div>
        </div>
        <div class="bg-pages-in ">
            <?php foreach ($qAuthority as $rs) { ?>
                <div class="page-center-gi">
                    <div>
                        <?php if (!empty($rs->authority_img)) : ?>
                            <img src="<?php echo base_url('docs/img/' . $rs->authority_img); ?>" width="545px" height="352px">
                        <?php else : ?>
                            <img src="<?php echo base_url('docs/logo.png'); ?>" width="545px" height="352px">
                        <?php endif; ?>
                    </div>
                </div>
                <div class="scrollable-container-gi">
                    <div class="pages-content break-word mt-5">
                        <!-- <span class="font-pages-content-head">พระราชบัญญัติกำหนดแผนและขั้นตอนการกระจายอำนาจให้แก่องค์กรปกครองท้องถิ่น พ.ศ. 2542 กำหนดให้ อบต.มีอำนาจและหน้าที่ในการจัดระบบการบริการสาธารณะ <br> เพื่อประโยชน์ของประชาชนในท้องถิ่นของตนเองตามมาตรา 16 ดังนี้</span><br> -->
                        <span class="font-gi-content"><?= $rs->authority_detail; ?></span>
                    </div>
                </div>
                <div class="margin-top-delete-topic d-flex justify-content-end">
                    <a href="<?php echo site_url('Home'); ?>"><img src="<?php echo base_url("docs/s.btn-back.png"); ?>"></a>
                </div>
            <?php } ?>
        </div>
    </div>
</div>