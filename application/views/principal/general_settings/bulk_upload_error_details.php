<table class="bordered striped highlight responsive-table">
    <thead>
        <tr>
            <th data-field="name" width="5%">#</th>
            <th data-field="price" width="95%">Error Details</th>
        </tr>
    </thead>

    <tbody>
        <?php $count = 1;
        foreach ($messages as $msg) {
            ?>
            <tr>
                <td><div><label><?php echo $count++ ;?></label></div></td>
                <td><div><label><span class="error" style="color: red;font-size: 14px !important;"> <?php echo $msg;?></span></label></div></td>

            </tr>
        <?php } ?>
    </tbody>
</table>