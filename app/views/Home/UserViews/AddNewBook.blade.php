@extends('layouts.home_master')
@section('title')
同人坊--燃草同人社区
@stop
@section('content')
@include('layouts.header')
@include('layouts.nav')
<div id="user_section">
    @include('layouts.authorLeft')
    <div class="user_section_right">

        <div class="user_info_modify_content">
            <span class="nick_modify_explain btn_activate_author"><b style="color:darkred;"><h3>创建新作品</h3></b></span><br><br><br>
            <form class="form-horizontal" action="/doAddNewBook" method="post">


                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">书名：</label>
                    <div class="col-sm-10">
                        <input type="text" name="book_name" class="form-control input_m_cls" id="inputPassword3" placeholder="" value=""><span class="author_reg_tips">*限12字（汉字、字母、数字），不得用特殊符号</span>
                    </div>
                </div>


                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">作品类型：</label>
                    <div class="col-sm-10">
                        <select name="book_type" id="" class="form-control input_m_cls">
                            <option value="0">---</option>
                            @foreach($type as $v)
                            <option value="{{$v->type_id}}">{{ViewSpalls_AdminViewSpallsModel::showBookType($v->type_id)}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>


                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">作品状态：</label>
                    <div class="col-sm-10">
                        <select name="" id="" class="form-control input_m_cls" disabled>
                            <option value="0">新书上传</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">首发状态：</label>
                    <div class="col-sm-10">
                        <input type="radio" name="book_from_status" value="0" checked/>
                        燃草中文网首发
                        <input type="radio" name="book_from_status" value="2"/>
                        起点
                        <input type="radio" name="book_from_status" value="3"/>
                        纵横
                        <input type="radio" name="book_from_status" value="4"/>
                        创世
                        <input type="radio" name="book_from_status" value="5"/>
                        飞卢
                        <input type="radio" name="book_from_status" value="1"/>
                        其它
                    </div><br>
                    <span class="author_reg_tips">*一经选择，无法修改</span>
                </div>
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">他站首发连接：</label>
                    <div class="col-sm-10">
                        <input type="text" name="book_from_url" class="form-control input_m_cls"/>
                        <span class="author_reg_tips">*选择燃草中文网首发的作品可以不用填写</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">作品简介：</label>
                    <div class="col-sm-10">
                        <textarea name="detail" class="form-control text_detail"></textarea>
                        <span class="author_reg_tips">*限400字作品介绍，请勿上传章节内容</span>
                    </div>
                </div>

                <input type="hidden" name="author" value="{{$author_info->pen_name}}"/>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <input type="submit" value="创建作品" class="btn btn-primary"/>
                    </div>
                </div>



                <div class="form-group">
                    <div class="col-sm-10">
                        <div class="text_explain">
                            <p>新建作品后请尽快上传满2000字的第一章内容，管理员会根据内容进行审核，审核通过后方可以对书籍进行浏览。</p>
                            <p>审核周期一般为48小时工作日内（节假日顺延）。</p>
                            <p>其它说明：</p>
                            <p>1.作品创建请按要求进行填写，如有疑问请通过“<a href="">联系管理员</a>”处咨询，或点击“<a href="">新建作品说明</a>”。</p>
                            <p>2.书名长度限12字以下，选择该类别将会经过编辑审核。</p>
                            <p>4.作品名字应与内容相符，不具有文学性、故意夸大其词的广告性、政治性、恶搞性或淫亵性作品名将会被删除。</p>
                            <p>5.上传的作品内容必须符合燃草中文网收录标准，不符合收录标准的作品将被禁阅或删除。</p>
                            <p>6.穿越类别作品中穿越的手段不提倡比较血腥、极端的手法（比如车祸、跳楼、自杀等），防止对于判断能力较弱的青少年产生不良影响</p>
                            <p>7.新建作品审核周期为48小时内（节假日顺延）。</p>
                            <p>8.新建作品但未审核通过可以对作品的基本信息进行修改，如简介，封面等，请新建完后点击-操作本书-</p>
                            <p>*根据国家相关规定， 以下内容不允许出现在作品中，审核将不予通过，请注意规避：涉及党派、军队、政治、宗教、时事热点、少数民族等现实题材， 情色、暴力、帮派，真实素材（人名、地名、事例）、不和谐因素等内容，以及全文或部分抄袭，已出让版权的作品等</p>
                            <p>*2015·扫黄打非·净网行动正在紧密进行中，本站将积极配合相关部门，提交资料。 请作者们写作时务必警醒：不要出现违规违法内容，不要怀有侥幸心理。后果严重，请勿自误。</p>
                            <p>*创建作品请慎重，已有外站作者，判刑三年半</p>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div>

</div>
@include('layouts.footer')
@stop