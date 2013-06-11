
        <div id="content-alert">
            <?php if (Param::isEmpty(Param::getSystemErrors())): ?>
            <div class="system error">
                <?php foreach(Param::getSystemErrors() as $strLine ): ?>
              *  <?php echo $strLine; ?><br/>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
            <?php if (Param::isEmpty(Param::getSystemNotices())): ?>
            <div class="system notice">
                <?php foreach(Param::getSystemNotices() as $strLine ): ?>
               * <?php echo $strLine; ?><br/>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
            <?php if (Param::isEmpty(Param::getSystemMessages())): ?>
            <div class="system message">
                <?php foreach(Param::getSystemMessages() as $strLine ): ?>
                * <?php echo $strLine; ?><br/>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
            <?php if (Param::isEmpty(Param::getFormErrors())): ?>
            <div class="form error">
                <?php foreach(Param::getFormErrors() as $strLine ): ?>
               * <?php echo $strLine; ?><br/>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
            <?php if (Param::isEmpty(Param::getFormNotices())): ?>
            <div class="form notice">
                <?php foreach(Param::getFormNotices() as $strLine ): ?>
               * <?php echo $strLine; ?><br/>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
            <?php if (Param::isEmpty(Param::getFormMessages())): ?>
            <div class="form message">
                <?php foreach(Param::getFormMessages() as $strLine ): ?>
               * <?php echo $strLine; ?><br/>
                <?php endforeach; ?>
            </div>
             <?php endif; ?>
        </div>
