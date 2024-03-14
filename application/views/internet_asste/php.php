<script>
    $(document).ready(function() {
        var obj = {
            values: [
                <?php echo $total_complain_year; ?>,
                <?php echo $total_complain_success; ?>,
                <?php echo $total_complain_operation; ?>,
                <?php echo $total_complain_accept; ?>,
                <?php echo $total_complain_doing; ?>,
                <?php echo $total_complain_wait; ?>,
                <?php echo $total_complain_cancel; ?>
            ],
            colors: ['#F5900A', '#DBFFDD', '#FFA085', '#CFE5FF', '#CFD7FE', '#FFD361', '#FFE3E3'],
            animation: true,
            animationSpeed: 10,
            fillTextData: false,
            fillTextColor: '#fff',
            fillTextAlign: 1.35,
            fillTextPosition: 'inner',
            doughnutHoleSize: 50,
            doughnutHoleColor: '#fff',
            offset: 0,
            pie: 'normal',
            isStrokePie: {
                stroke: 20,
                overlayStroke: true,
                overlayStrokeColor: '#eee',
                strokeStartEndPoints: 'Yes',
                strokeAnimation: true,
                strokeAnimationSpeed: 40,
                fontSize: '60px',
                textAlignement: 'center',
                fontFamily: 'Arial',
                fontWeight: 'bold'
            }
        };

        var values = obj.values;
        var colors = obj.colors;

        for (var i = 0; i < values.length; i++) {
            var cardId = "card" + values[i];
            var card = $("#" + cardId);
            if (card) {
                card.css("background-color", colors[i]);
            }
        }


        generatePieGraph('myCanvas', obj);
    });
</script>