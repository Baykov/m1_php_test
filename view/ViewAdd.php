<?php

?>
<div class="container">
    <div class="row clearfix">
        <div class="col-md-12 table-responsive">
            <table class="table table-bordered table-hover table-sortable" id="tab_logic">
                <thead>
                <tr >
                    <th class="text-center">
                        Title
                    </th>
                    <th class="text-center">
                        Text
                    </th>
                    <th class="text-center">
                        Image
                    </th>
                    <th class="text-center" style="border-top: 1px solid #ffffff; border-right: 1px solid #ffffff;">
                    </th>
                </tr>
                </thead>
                <tbody>
                    <tr class="">
                        <form enctype="multipart/form-data" action="/index.php" method="post">
                            <input type="hidden" name="task" value="savearticle"/>
                            <td >
                                <input type="text" name='title'  class="form-control"/>
                            </td>
                            <td >
                                <textarea name="description" class="form-control"></textarea>
                            </td>
                            <td >
                                <input type="file" name='mainimage' class="form-control"/>
                            </td>
                            <td >
                                <button type="submit"  name="save" class='btn btn-success glyphicon glyphicon-save row-save'></button>
                            </td>
                        </form>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

