<?php
include_once('./pub/top.php');//every page needs this include;
// member.php/wx_config.php/config.php,you can include one of them with 'include()',it depends on your needs,for example ,if you need to use '文字回复', you can fid it is in 'config.php' , DO NOT CHOOSE IT WRONG
include_once('./pub/fans_config.php');
?>
<div class="col-xs-12 col-sm-9 col-lg-10">
<style>
    .trade .page-header{border:none; border-left:0.3em #333 solid; padding-left:1em;}
    .trade .tile{display:block; float:left; margin:0.4em;padding:.2em 1em .5em 1em; width:8em; text-align:center; background:#EEE; color:#333; text-decoration:none;}
    .trade .tile.tile-2x{width:10em;}
    .trade .tile.tile-3x{width:15em;}
    .trade .tile:hover{background:#7dacdd; color:#FFF;}
    .trade .tile > i{display:block; font-size:2em; margin:0.3em auto 0 auto;}
    .trade .tile > span{display:block;}
</style>
<div class="clearfix">
    <div class="alert alert-info">
        <i class="fa fa-info-circle"></i>
        会员消费时，会根据会员所在的会员组和会员卡里的这口设置进行折扣计算，并且可使用会员卡的积分抵消金额功能。
        <br/>
        <i class="fa fa-info-circle"></i>
        现金统计只统计实际收取的现金总额
    </div>
    <div class="clearfix trade">
        <h5 class="page-header">快捷交易</h5>
        <div class="clearfix">
            <a href="javascript:" data-type="consume" class="tile img-rounded modal-trade">
                <i class="fa fa-usd"></i>
                <span>消费</span>
            </a>
            <a href="?r=make/vip_user"  data-type="credit2" class="tile img-rounded modal-trade">
                <i class="fa fa-cny"></i>
                <span>手动修改余额</span>
            </a>
            <a href="?r=make/vip_user"  data-type="credit1" class="tile img-rounded modal-trade">
                <i class="fa fa-money"></i>
                <span>手动修改积分</span>
            </a>
<!--            <a href="javascript:;"  data-type="card" class="tile img-rounded modal-trade">-->
<!--                <i class="fa fa-credit-card"></i>-->
<!--                <span>发放会员卡</span>-->
<!--            </a>-->
        </div>
        <h5 class="page-header">交易统计</h5>
        <div class="clearfix">
            <a href="javascript:void(0)" class="tile img-rounded bye">
                <i class="fa fa-bar-chart"></i>
                <span>现金统计</span>
            </a>
            <a href="javascript:void(0)" target="_blank"  class="tile img-rounded bye">
                <i class="fa fa-bar-chart"></i>
                <span>余额统计</span>
            </a>
            <a href="javascript:void(0)" target="_blank"  class="tile img-rounded bye">
                <i class="fa fa-bar-chart"></i>
                <span>积分统计</span>
            </a>
        </div>
        <h5 class="page-header">交易明细查询</h5>
        <div class="clearfix">
            <a href="javascript:void(0)"  target="_blank"  class="tile img-rounded bye">
                <i class="fa fa-search"></i>
                <span>现金明细</span>
            </a>
            <a href="javascript:void(0)"  target="_blank"  class="tile img-rounded bye">
                <i class="fa fa-search"></i>
                <span>余额明细</span>
            </a>
            <a href="javascript:void(0)" target="_blank" class="tile img-rounded bye">
                <i class="fa fa-search"></i>
                <span>积分明细</span>
            </a>
        </div>
    </div>
</div>
</div>
<script>
$(function(){
    $('.bye').click(function(){
        alert('功能暂未开放')
    });
})
</script>

	