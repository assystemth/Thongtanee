<div class="bg-pages">
    <div class="row pad-path">
        <div class="path1-1">
            <span class="font-path-1 underline"><a href="<?php echo site_url('Home'); ?>">หน้าแรก</a></span>
        </div>
        <div class="path2-2">
            <span class="font-path-2 underline"><a href="#">ข่าว e-GP</a></span>
        </div>
    </div>
    <div class="container-pages-news">
        <div class="page-center">
            <div class="head-pages">
                <span class="font-pages-head">ข่าวจัดซื้อจัดจ้าง e-GP</span>
            </div>
        </div>
        <!-- <div style="padding-top: 30px;"></div> -->
        <div class="scrollable-container">
            <?php foreach ($json_data as $key1 => $value1) : ?>
                <?php if (is_array($value1)) : ?>
                    <?php foreach ($value1 as $key2 => $value2) : ?>
                        <?php if (is_array($value2)) : ?>
                            <?php foreach ($value2 as $key3 => $value3) : ?>
                                <?php if ($key3 === 'project_id') : ?>
                                    <?php
                                    $url = 'https://process3.gprocurement.go.th/egp2procmainWeb/jsp/procsearch.sch?servlet=gojsp&proc_id=ShowHTMLFile&processFlows=Procure&projectId=' . $value3 . '&templateType=W2&temp_Announ=A&temp_itemNo=0&seqNo=1';
                                    ?>
                                    <div class="pages-select-e-gp underline">
                                        <div class="row">
                                            <div class="col-2" style="padding-left: 30px;">
                                                <img src="<?php echo base_url("docs/e-gp.png"); ?>" style="width: 94px; height:63px;">
                                            </div>
                                            <div class="col-10">
                                                <span class="font-egp">
                                                <?php endif; ?>
                                                <?php if ($key3 === 'project_name') : ?>
                                                    <a href="<?= htmlspecialchars($url) ?>" target="_blank"><?= htmlspecialchars($value3) ?></a>
                                                <?php endif; ?>
                                                <?php if ($key3 === 'transaction_date') : ?>
                                                    <br><span><strong><?= "เผยแพร่เมื่อวันที่" ?>:</strong> <?= htmlspecialchars($value3) ?></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php else : ?>
                <?php endif; ?>
                <br> <!-- Add a new line after each subarray at the first level -->
            <?php endforeach; ?>
        </div>
    </div>
</div>