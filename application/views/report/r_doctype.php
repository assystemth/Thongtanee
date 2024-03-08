<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>แสดงรายงานจำนวนเอกสารแยกตามประเภทเอกสาร</h2>
            <h4>จำนวนเอกสารที่มีทั้งหมดในระบบ</h4>
        </div>
        <div class="col-sm-5">

            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th style="width: 60%;">ประเภท</th>
                        <th style="width: 40%;">
                            <center>จำนวนเอกสาร</center>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($query as $rs) { ?>
                        <tr>
                            <td><?php echo $rs->dname;?></td>
                            <td align="center"><?php echo $rs->dtotal; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>