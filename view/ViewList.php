<?php

?>
<div class="container">
    <div class="row clearfix">
        <div class="col-md-12 table-responsive">
            <table class="table table-bordered table-hover table-sortable" id="tab_logic">
                <thead>
                <tr >
                    <th class="text-center">
                        id
                    </th>
                    <th class="text-center">
                        Title
                    </th>
                    <th class="text-center">
                        Text
                    </th>
                    <th class="text-center">
                        Date Created
                    </th>
                    <th class="text-center">
                        Date Modified
                    </th>
                    <th class="text-center">
                        Image
                    </th>
                    <th class="text-center" style="border-top: 1px solid #ffffff; border-right: 1px solid #ffffff;">
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($this->result as $i => $article) { ?>
                        <tr id='addr<?php echo $i;?>' data-id="<?php echo $i;?>" class="">
                            <form enctype="multipart/form-data" action="" method="post">
                                <input type="hidden" name="task" value="savearticle"/>
                                <input type="hidden" name="id" value="<?php echo $article->id;?>"/>
                                <td data-name="id<?php echo $i;?>">
                        <?php echo $article->id;?>
                    </td>
                    <td data-name="title<?php echo $i;?>">
                        <input type="text" name='title' value="<?php echo $article->title;?>" class="form-control"/>
                    </td>
                    <td data-name="desc<?php echo $i;?>">
                        <textarea name="description" class="form-control"><?php echo $article->description;?></textarea>
                    </td>
                    <td data-name="modified<?php echo $i;?>">
                        <?php echo $article->created;?>
                    </td>
                    <td data-name="modified<?php echo $i;?>">
                        <?php echo $article->modified;?>
                    </td>
                    <td data-name="del<?php echo $i;?>">
                        <?php if(!empty($article->mainimage)){
                           // echo '<img src="img.php?id='.$article->id.'" />';
                            echo '<img style="max-width: 200px; max-height: 200px;" src="images/'.$article->mainimage.'""/>';
                        //} else {?>
                        <?php } ?>
                       Сменить  <input type="file" name='mainimage' class="form-control"/>
                    </td>
                    <td data-name="del<?php echo $i;?>">
                        <button name="delete" param="<?php echo $article->id;?>" class='btn btn-danger glyphicon glyphicon-remove row-remove'></button>
                        <button name="save"  class='btn btn-success glyphicon glyphicon-save row-save'></button>
                        <a href="index.php?view=Item&id=<?php echo $article->id;?>" class="btn btn-warning">View</a>
                    </td>
                            </form>
                </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <a href="index.php?view=Add" class="btn btn-default pull-right">Add Row</a>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $(".row-remove").on("click", function() {
            $(this).form.submit();
        });
        $(".row-save").on("click", function() {
            $(this).parent().parent().children()[6].submit()
        });
    });
</script>