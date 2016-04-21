<?php
/**
 * Created by PhpStorm.
 * User: 12
 * Date: 21.04.2016
 * Time: 19:23
 */
?>

<div class="container">
    <div class="row">
        <div class="col-md-3">

            <div id="demo" class="collapse in">
                <hr>
                <div class="list-group list-group">
                    <h4 class="">Меню</h4>
                    <a href="/" class="list-group-item">Главная</a>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <hr>
            <div class="row">
                <div class="col-sm-4"><a href="#" class=""><img src="images/<?php echo $this->result['mainimage'];?>" class="img-responsive"></a>
                </div>
                <div class="col-sm-8">
                    <h3 class="title"><?php echo $this->result['title'];?></h3>
                    <p class="text-muted"><span class="glyphicon glyphicon-calendar"></span>Modified <?php echo $this->result['modified'];?></p>
                    <p><?php echo $this->result['description'];?>
                    </p><p class="text-muted">Created <a href="#"><?php echo $this->result['created'];?></a></p>

                </div>
            </div>
            <hr>
        </div>
    </div>
</div>
<!-- End container -->

