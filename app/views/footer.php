<div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="confirm">Confirm</button>
      </div>
    </div>
  </div>
</div>

    <!-- javascripts -->
    <script src="<?php echo base_url(); ?>theme/js/jquery-ui-1.10.4.min.js"></script>
    <script src="<?php echo base_url(); ?>theme/js/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>theme/js/jquery-ui-1.9.2.custom.min.js"></script>
    <!-- bootstrap -->
    <script src="<?php echo base_url(); ?>theme/js/bootstrap.min.js"></script>
    <!-- nice scroll -->
    <script src="<?php echo base_url(); ?>theme/js/jquery.scrollTo.min.js"></script>
    <script src="<?php echo base_url(); ?>theme/js/jquery.nicescroll.js" type="text/javascript"></script>
    <!-- charts scripts -->
    <script src="<?php echo base_url(); ?>theme/assets/jquery-knob/js/jquery.knob.js"></script>
    <script src="<?php echo base_url(); ?>theme/js/jquery.sparkline.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>theme/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js"></script>
    <script src="<?php echo base_url(); ?>theme/js/owl.carousel.js" ></script>
    <!-- jQuery full calendar -->
    <<script src="<?php echo base_url(); ?>theme/js/fullcalendar.min.js"></script> <!-- Full Google Calendar - Calendar -->
    <script src="<?php echo base_url(); ?>theme/assets/fullcalendar/fullcalendar/fullcalendar.js"></script>
    <!--script for this page only-->
    <script src="<?php echo base_url(); ?>theme/js/calendar-custom.js"></script>
    <script src="<?php echo base_url(); ?>theme/js/jquery.rateit.min.js"></script>
    <!-- custom select -->
    <script src="<?php echo base_url(); ?>theme/js/jquery.customSelect.min.js" ></script>
    <script src="<?php echo base_url(); ?>theme/assets/chart-master/Chart.js"></script>

    <!--custome script for all page-->
    <script src="<?php echo base_url(); ?>theme/js/scripts.js"></script>
    <!-- custom script for this page-->
    <script src="<?php echo base_url(); ?>theme/js/sparkline-chart.js"></script>
    <script src="<?php echo base_url(); ?>theme/js/easy-pie-chart.js"></script>
    <script src="<?php echo base_url(); ?>theme/js/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="<?php echo base_url(); ?>theme/js/jquery-jvectormap-world-mill-en.js"></script>
    <script src="<?php echo base_url(); ?>theme/js/xcharts.min.js"></script>
    <script src="<?php echo base_url(); ?>theme/js/jquery.autosize.min.js"></script>
    <script src="<?php echo base_url(); ?>theme/js/jquery.placeholder.min.js"></script>
    <script src="<?php echo base_url(); ?>theme/js/gdp-data.js"></script>
    <script src="<?php echo base_url(); ?>theme/js/morris.min.js"></script>
    <script src="<?php echo base_url(); ?>theme/js/sparklines.js"></script>
    <script src="<?php echo base_url(); ?>theme/js/charts.js"></script>
    <script src="<?php echo base_url(); ?>theme/js/jquery.slimscroll.min.js"></script>
    <script src="<?php echo base_url(); ?>theme/js/ajax-calls.js"></script>
  <script>

      //knob
      $(function() {
        $(".knob").knob({
          'draw' : function () {
            $(this.i).val(this.cv + '%')
          }
        })
      });

      //carousel
      $(document).ready(function() {
          $("#owl-slider").owlCarousel({
              navigation : true,
              slideSpeed : 300,
              paginationSpeed : 400,
              singleItem : true

          });
      });

      //custom select box

      $(function(){
          $('select.styled').customSelect();
      });

      /* ---------- Map ---------- */
    $(function(){
      $('#map').vectorMap({
        map: 'world_mill_en',
        series: {
          regions: [{
            values: gdpData,
            scale: ['#000', '#000'],
            normalizeFunction: 'polynomial'
          }]
        },
        backgroundColor: '#eef3f7',
        onLabelShow: function(e, el, code){
          el.html(el.html()+' (GDP - '+gdpData[code]+')');
        }
      });
    });

  </script>

  </body>
</html>
