<div id="page-wrapper" class="gray-bg">
    <div class="row border-bottom">
        <nav class="navbar navbar-static-top  " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
            </div>
            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <span class="m-r-sm text-muted welcome-message">Welcome to Admin Area.</span>
                </li>
                <li>
                    <a href="<?=SITEURLADM?>system/logout/?ref=console">
                        <button class="btn btn-primary btn-rounded btn-sm" ><i class="fa fa-sign-out"></i> Log out</button>
                    </a>
                </li>
            </ul>

        </nav>
    </div>
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2><?=ucwords($page_title)?></h2>
            <ol class="breadcrumb">
                <li <?=($current['method']=='dashboard' || $current['method']=='index') ? 'class="active"' : ''?>>
                    <?=($current['method']=='dashboard' || $current['method']=='index') ? '<strong>' : '<a href="'.SITEURLADM.'console/">'?>
                        Dashboard
					<?=($current['method']=='dashboard' || $current['method']=='index') ? '</strong>' : '</a>'?>
                </li>
                <?php
                    if($current['method']!='dashboard' && $current['method']!='index')
                    {
                        if($page_title==ucwords($current['method']))
                        {
                            ?>
                            <li class="active">
                                <strong><?=ucwords($current['method'])?></strong>
                            </li>
                            <?php
                        }
                        else
                        {
                            ?>
                                <li>
                                    <a href="<?=SITEURLADM?>console/<?=$current['method']?>"><?=ucwords($current['method'])?></a>
                                </li>
                                <li class="active">
                                    <strong><?=ucwords($page_title)?></strong>
                                </li>
                            <?php
                        }
					}
                ?>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>