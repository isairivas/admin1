
</section>

</div> <!--  END div element whith id=content -->
</div> <!-- END div element whith id=content-wrap -->
</div> <!--  END div element whith id=content -->
</div> <!-- END div element whith id=content-wrap -->
        <footer id="footer">
            <div class="footer-left"> </div>
            <div class="footer-right"><p>Copyright 2013. All Rights Reserved.</p></div>
        </footer>
 </div>

    <!-- Core Scripts -->
    
    <script src="<?php echo HOME; ?>bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo HOME; ?>assets/js/libs/jquery.placeholder.min.js"></script>
    <script src="<?php echo HOME; ?>assets/js/libs/jquery.mousewheel.min.js"></script>
    
    <!-- Template Script -->
    <script src="<?php echo HOME; ?>assets/js/template.js"></script>
    <script src="<?php echo HOME; ?>assets/js/setup.js"></script>

    <!-- Customizer, remove if not needed -->
    <script src="<?php echo HOME; ?>assets/js/customizer.js"></script>

    <!-- Uniform Script -->
    <script src="<?php echo HOME; ?>plugins/uniform/jquery.uniform.min.js"></script>
    
    <!-- jquery-ui Scripts -->
    <script src="<?php echo HOME; ?>assets/jui/js/jquery-ui-1.9.1.min.js"></script>
    <script src="<?php echo HOME; ?>assets/jui/jquery-ui.custom.min.js"></script>
    <script src="<?php echo HOME; ?>assets/jui/timepicker/jquery-ui-timepicker.min.js"></script>
    <script src="<?php echo HOME; ?>assets/jui/jquery.ui.touch-punch.min.js"></script>
    
    <!-- Plugin Scripts -->
    
    <!-- Flot -->
    <!--[if lt IE 9]>
    <script src="assets/js/libs/excanvas.min.js"></script>
    <![endif]-->
    <script src="<?php echo HOME; ?>plugins/flot/jquery.flot.min.js"></script>
    <script src="<?php echo HOME; ?>plugins/flot/plugins/jquery.flot.tooltip.min.js"></script>
    <script src="<?php echo HOME; ?>plugins/flot/plugins/jquery.flot.pie.min.js"></script>
    <script src="<?php echo HOME; ?>plugins/flot/plugins/jquery.flot.resize.min.js"></script>

    <!-- Circular Stat -->
    <script src="<?php echo HOME; ?>custom-plugins/circular-stat/circular-stat.min.js"></script>

    <!-- SparkLine -->
    <script src="<?php echo HOME; ?>plugins/sparkline/jquery.sparkline.min.js"></script>
    
    <!-- iButton -->
    <script src="<?php echo HOME; ?>plugins/ibutton/jquery.ibutton.min.js"></script>

    <!-- Full Calendar -->
    <script src="<?php echo HOME; ?>plugins/fullcalendar/fullcalendar.min.js"></script>
    
    <!-- DataTables -->
    <script src="<?php echo HOME; ?>plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo HOME; ?>plugins/datatables/TableTools/js/TableTools.min.js"></script>
    <script src="<?php echo HOME; ?>plugins/datatables/dataTables.bootstrap.js"></script>
    <!-- msgBox --><!-- pnotify -->
    <script src="<?php echo HOME; ?>plugins/msgbox/jquery.msgbox.min.js"></script>
    <script src="<?php echo HOME; ?>plugins/pnotify/jquery.pnotify.min.js"></script>
    
    <!-- jquery-ui Scripts -->
    <script src="<?php echo HOME; ?>assets/jui/js/jquery-ui-1.9.1.min.js"></script>
    <script src="<?php echo HOME; ?>assets/jui/jquery-ui.custom.min.js"></script>
    <script src="<?php echo HOME; ?>plugins/zebradp/zebra_datepicker.min.js"></script>
    <script src="<?php echo HOME; ?>assets/jui/timepicker/jquery-ui-timepicker.min.js"></script>
    <script src="<?php echo HOME; ?>assets/jui/jquery.ui.touch-punch.min.js"></script>
    <script src="<?php echo HOME; ?>assets/jui/js/i18n/jquery.ui.datepicker-es.js"></script>
    
    <script src="<?php echo HOME; ?>assets/js/demo/ui_comps.js"></script>
    <!-- Demo Scripts -->
    <script src="<?php echo HOME; ?>assets/js/demo/dashboard.js"></script>
    
    <script type="text/javascript">
        jQuery(document).ready(function(){
            <?php if(isset($_GET['add']) ): ?>
                <?php if($_GET['add'] == 'true' ): ?>
                    $.pnotify({
                        title: 'Enhorabuena',
                        text: 'Se ha agregado correctamente el registro.',
                        type: 'success'
                    });
                    <?php else:  ?>
                    $.pnotify({
                        title: ' Disculpe :(',
                        text: 'Ha ocurrido un problema y no se ha podido insertar el registro. ',
                        type: 'error'
                    });
                <?php endif; ?>
            <?php endif; ?>
            <?php if(isset($_GET['update']) ): ?>
                <?php if($_GET['update'] == 'true' ): ?>
                    $.pnotify({
                        title: 'Enhorabuena',
                        text: 'Se ha actualizado correctamente el registro.',
                        type: 'success'
                    });
                    <?php else:  ?>
                    $.pnotify({
                        title: ' Disculpe :(',
                        text: 'Ha ocurrido un problema y no se ha podido actualizado el registro. ',
                        type: 'error'
                    });
                <?php endif; ?>
            <?php endif; ?>
            <?php if(isset($_GET['delete']) ): ?>
                <?php if($_GET['delete'] == 'true' ): ?>
                    $.pnotify({
                        title: 'Enhorabuena',
                        text: 'Se ha eliminado correctamente el registro.',
                        type: 'success'
                    });
                    <?php else:  ?>
                    $.pnotify({
                        title: ' Disculpe :(',
                        text: 'Ha ocurrido un problema al eliminar el registro. ',
                        type: 'error'
                    });
                <?php endif; ?>
            <?php endif; ?>
        });
    </script>
    
</body>

</html>
